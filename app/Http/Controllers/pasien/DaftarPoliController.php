<?php

namespace App\Http\Controllers\pasien;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use App\Models\Periksa;
use App\Models\Poli;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DaftarPoliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $jadwalPeriksa = JadwalPeriksa::all();
        $polis = Poli::all();

        return view('pasien.daftar-poli.index', compact('jadwalPeriksa'), compact('polis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $jadwalPeriksa = JadwalPeriksa::findOrFail($id);
        // Ambil semua daftar_poli terkait jadwal ini, beserta relasi ke periksa
        $daftarPoliList = DaftarPoli::where('id_jadwal', $id)->with('periksa')->get();

        // Hitung jumlah periksa yang status = 0
        $jumlahAntrian = 0;
        foreach ($daftarPoliList as $daftarPoli) {
            foreach ($daftarPoli->periksa as $periksa) {
                if ($periksa->status == 0) {
                    $jumlahAntrian++;
                }
            }
        }

        return view('pasien.daftar-poli.create', compact('jadwalPeriksa', 'jumlahAntrian'));
     
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
        $request->validate([
            'keluhan' => 'required|string|max:255',
            'no_antrian' => 'required|integer|min:1',
        ]);

        // Cek apakah sudah pernah daftar ke jadwal ini
        $cekDaftar = DaftarPoli::where('id_pasien', auth()->user()->id)
            ->where('id_jadwal', $id)
            ->whereHas('periksa', function ($query) {
                $query->where('status', false);
            })
            ->exists();  
        

        if ($cekDaftar) {
            return redirect()->route('pasien.daftar-poli.create', $id)
                ->withErrors(['error' => 'Anda sudah terdaftar untuk jadwal ini!']);
        }

        // Simpan data
        DaftarPoli::create([
            'id_pasien' => Auth::user()->id,
            'id_jadwal' => $id,
            'keluhan' => $request->keluhan,
            'no_antrian' => $request->no_antrian,
        ]);

        Periksa::create([
            'id_daftar_poli' => DaftarPoli::latest()->first()->id,
            'tanggal_periksa' => Carbon::now()->format('Y-m-d'),

        ]);

        return redirect()->route('pasien.daftar-poli.index')->with('success', 'Pendaftaran berhasil!');
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
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
