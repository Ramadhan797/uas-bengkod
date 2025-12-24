<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\DetailPeriksa;
use App\Models\Obat;
use App\Models\Periksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeriksaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $periksas = Periksa::select('periksas.*')
        //     ->join('daftar_polis', 'periksas.id_daftar_poli', '=', 'daftar_polis.id')
        //     ->with(['daftarPoli.pasien'])
        //     ->orderBy('daftar_polis.no_antrian', 'asc')
        //     ->get();

        $daftarPolis = DaftarPoli::whereHas('jadwalPeriksa', function ($query) {
            $query->where('id_dokter', Auth::user()->id);
        })->with(['periksa', 'pasien']) // relasi yang akan kamu akses di view
            ->get();
        return view('dokter.periksa.index', compact('daftarPolis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $periksa = Periksa::findOrFail($id);
        $detailPeriksas = DetailPeriksa::where('id_periksa', $periksa->id)->with('obat')->get();
        return view('dokter.periksa.show', compact('detailPeriksas', 'periksa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $periksa = Periksa::findOrFail($id);
        $obats = Obat::all();
        return view('dokter.periksa.edit', compact('periksa', 'obats'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'obat' => 'array|required',
            'obat.*' => 'exists:obats,id',
            'catatan' => 'nullable|string',
            
        ]);

        $periksa = Periksa::findOrFail($id);
        $periksa->update([
            'catatan' => $request->catatan,
        ]);

        // Hapus obat lama
        DetailPeriksa::where('id_periksa', $periksa->id)->delete();

        // Tambah obat baru
        foreach ($request->obat as $id_obat) {
            DetailPeriksa::create([
                'id_periksa' => $periksa->id,
                'id_obat' => $id_obat,
            ]);
        }

        // 💰 Hitung total harga obat
        $totalHargaObat = Obat::whereIn('id', $request->obat)->sum(column: 'harga');

        // Tambahkan jika ada biaya jasa dokter (opsional)
        $biayaJasa = 150000; // kamu bisa sesuaikan atau ambil dari config
        $totalBiaya = $totalHargaObat + $biayaJasa;

        // Update kolom biaya_periksa
        $periksa->update([
            'biaya_periksa' => $totalBiaya,
            'status' => true, 
        ]);

        return redirect()->route('dokter.periksa.index')->with('success', 'Data pemeriksaan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
