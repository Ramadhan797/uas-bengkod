<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\DetailPeriksa;
use App\Models\Obat;
use App\Models\Periksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            'qty' => 'array',
            'qty.*' => 'integer|min:1',
            'diagnosa' => 'nullable|string',
            'tindakan' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);

        $periksa = Periksa::findOrFail($id);
        $periksa->update([
            'catatan' => $request->catatan,
        ]);

        // Gunakan transaksi untuk memastikan stok dan detail diperbarui atomically
        try {
            DB::transaction(function () use ($periksa, $request) {
                // Kembalikan stok obat lama ke inventory (menggunakan qty sebelumnya)
                $previousDetails = DetailPeriksa::where('id_periksa', $periksa->id)->get();
                foreach ($previousDetails as $prev) {
                    $ob = Obat::find($prev->id_obat);
                    if ($ob) {
                        $ob->increment('stok', $prev->qty ?? 1);
                    }
                }

                // Hapus obat lama
                DetailPeriksa::where('id_periksa', $periksa->id)->delete();

                // Ambil qty yang diminta
                $qtys = $request->input('qty', []);

                // Cek stok untuk setiap obat baru sesuai qty
                foreach ($request->obat as $id_obat) {
                    $requestedQty = isset($qtys[$id_obat]) ? (int) $qtys[$id_obat] : 1;
                    $obatItem = Obat::findOrFail($id_obat);
                    if ($obatItem->stok < $requestedQty) {
                        throw new \Exception('Stok untuk ' . $obatItem->nama_obat . ' tidak cukup.');
                    }
                }

                // Tambah obat baru dan kurangi stok sesuai qty
                foreach ($request->obat as $id_obat) {
                    $assignedQty = isset($qtys[$id_obat]) ? (int) $qtys[$id_obat] : 1;

                    DetailPeriksa::create([
                        'id_periksa' => $periksa->id,
                        'id_obat' => $id_obat,
                        'qty' => $assignedQty,
                    ]);

                    $obatItem = Obat::findOrFail($id_obat);
                    $obatItem->decrement('stok', $assignedQty);
                }
            });
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
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

        // Buat atau perbarui medical record terkait periksa ini
        $medicalData = [
            'id_periksa' => $periksa->id,
            'id_pasien' => $periksa->daftarPoli->id_pasien,
            'id_dokter' => Auth::user()->id,
            'tanggal' => $periksa->tanggal_periksa,
            'diagnosa' => $request->diagnosa ?? null,
            'tindakan' => $request->tindakan ?? null,
            'catatan' => $request->catatan ?? null,
            'biaya' => $totalBiaya,
        ];

        // update existing record if ada
        $existing = \App\Models\MedicalRecord::where('id_periksa', $periksa->id)->first();
        if ($existing) {
            $existing->update($medicalData);
        } else {
            \App\Models\MedicalRecord::create($medicalData);
        }

        return redirect()->route('dokter.periksa.index')->with('success', 'Data pemeriksaan berhasil diperbarui dan rekam medis disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
