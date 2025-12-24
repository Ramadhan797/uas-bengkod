<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use App\Models\JadwalPeriksa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class JadwalPeriksaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwalPeriksa = JadwalPeriksa::all()->where('id_dokter', Auth::user()->id);
        return view('dokter.jadwal-periksa.index', compact('jadwalPeriksa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('dokter.jadwal-periksa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'hari' => 'required|string|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'is_aktif' => 'boolean',
        ]);

        // cek tabkrakan jadwal
       if (JadwalPeriksa::where('id_dokter', Auth::user()->id)
            ->where('hari', $validatedData['hari'])
            ->where(function ($query) use ($validatedData) {
                $query->whereBetween('jam_mulai', [$validatedData['jam_mulai'], $validatedData['jam_selesai']])
                    ->orWhereBetween('jam_selesai', [$validatedData['jam_mulai'], $validatedData['jam_selesai']])
                    ->orWhere(function ($q) use ($validatedData) {
                        $q->where('jam_mulai', '<=', $validatedData['jam_mulai'])
                            ->where('jam_selesai', '>=', $validatedData['jam_selesai']);
                    });
            })
            ->exists()
        ) { 
            return redirect()->back()->with('error', 'Jadwal periksa tabrakan!');
        }


        // Jika tidak ada tabrakan, simpan jadwal baru
        JadwalPeriksa::create([
            'id_dokter' => Auth::user()->id,
            'hari' => $validatedData['hari'],
            'jam_mulai' => $validatedData['jam_mulai'],
            'jam_selesai' => $validatedData['jam_selesai'],
            'is_aktif' => $validatedData['is_aktif'] ?? false,
        ]);

        return redirect()->route('dokter.jadwal-periksa.index')->with('success', 'Jadwal periksa berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jadwalPeriksa = JadwalPeriksa::findOrFail($id);

        // cek apakah hari ini adalah hari jadwal periksa
        $today = Carbon::now()->locale('id')->translatedFormat('l'); // hasil: 'Senin', 'Selasa', dll
        if (Str::lower($today) == $jadwalPeriksa->hari) {
            return back()->withErrors(['hari' => 'Tidak dapat mengubah jadwal pada hari H.']);
        }

        return view('dokter.jadwal-periksa.edit', compact('jadwalPeriksa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $validatedData = $request->validate([
            'hari' => 'required|string|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        // cek tabkrakan jadwal
        if (JadwalPeriksa::where('id_dokter', Auth::user()->id)
            ->where('hari', $validatedData['hari'])
            ->where(function ($query) use ($validatedData) {
                $query->whereBetween('jam_mulai', [$validatedData['jam_mulai'], $validatedData['jam_selesai']])
                    ->orWhereBetween('jam_selesai', [$validatedData['jam_mulai'], $validatedData['jam_selesai']])
                    ->orWhere(function ($q) use ($validatedData) {
                        $q->where('jam_mulai', '<=', $validatedData['jam_mulai'])
                            ->where('jam_selesai', '>=', $validatedData['jam_selesai']);
                    });
            })
            ->exists()
        ) {
            return redirect()->back()->with('error', 'Jadwal periksa tabrakan!');
        }

        $jadwalPeriksa = JadwalPeriksa::findOrFail($id);
        $jadwalPeriksa->update($validatedData);

        return redirect()->route('dokter.jadwal-periksa.index')->with('success', 'Jadwal periksa berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */

    public function toggleStatus(string $id)
    {
        $jadwalPeriksa = JadwalPeriksa::findOrFail($id);

        // Jika jadwal aktif, matikan semua jadwal periksa
        if (!$jadwalPeriksa->is_aktif) {
            JadwalPeriksa::where('id_dokter', Auth::user()->id)->update(['is_aktif' => false]);

            // Aktifkan jadwal yang dipilih
            $jadwalPeriksa->is_aktif = true;
            $jadwalPeriksa->save();
        } else {
            // Matikan jadwal yang dipilih
            $jadwalPeriksa->is_aktif = false;
            $jadwalPeriksa->save();
        }

        return redirect()->route('dokter.jadwal-periksa.index');
    }


    public function destroy(string $id)
    {
        //
    }
}
