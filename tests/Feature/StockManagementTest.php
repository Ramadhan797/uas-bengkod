<?php

namespace Tests\Feature;

use App\Models\DetailPeriksa;
use App\Models\Obat;
use App\Models\Periksa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StockManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_stock_decreases_and_increases_with_qty()
    {
        // buat obat dengan stok 10
        $obat = Obat::create([
            'nama_obat' => 'TestMed',
            'kemasan' => 'Botol',
            'harga' => 10000,
            'stok' => 10,
        ]);

        // create jadwal, daftar_poli, periksa yang valid (foreign keys)
        $dokter = \App\Models\User::factory()->create(['role' => 'dokter']);
        $pasien = \App\Models\User::factory()->create(['role' => 'pasien']);
        $jadwal = \App\Models\JadwalPeriksa::create([
            'id_dokter' => $dokter->id,
            'hari' => 'senin',
            'jam_mulai' => '08:00:00',
            'jam_selesai' => '10:00:00',
            'is_aktif' => true,
        ]);
        $daftar = \App\Models\DaftarPoli::create([
            'id_pasien' => $pasien->id,
            'id_jadwal' => $jadwal->id,
            'keluhan' => 'Demam',
            'no_antrian' => 1,
        ]);
        $periksa = Periksa::create([
            'id_daftar_poli' => $daftar->id,
            'tanggal_periksa' => now()->format('Y-m-d'),
            'status' => false,
        ]);

        // tambahkan detail periksa qty=3 (simulasi penyimpanan)
        DetailPeriksa::create([
            'id_periksa' => $periksa->id,
            'id_obat' => $obat->id,
            'qty' => 3,
        ]);

        // kurangi stok
        $obat->refresh();
        $obat->decrement('stok', 3);
        $this->assertDatabaseHas('obats', [
            'id' => $obat->id,
            'stok' => 7,
        ]);

        // kembalikan stok (seperti ketika resep diubah)
        $obat->increment('stok', 3);
        $this->assertDatabaseHas('obats', [
            'id' => $obat->id,
            'stok' => 10,
        ]);
    }
}
