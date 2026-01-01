<?php

namespace Database\Seeders;

use App\Models\JadwalPeriksa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JadwalPeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat jadwal aktif untuk dokter di masing-masing poli agar pasien dapat mendaftar
        JadwalPeriksa::create([
            'id_dokter' => 1,
            'hari' => 'senin',
            'jam_mulai' => '08:00:00',
            'jam_selesai' => '10:00:00',
            'is_aktif' => true,
        ]);

        JadwalPeriksa::create([
            'id_dokter' => 2,
            'hari' => 'selasa',
            'jam_mulai' => '10:00:00',
            'jam_selesai' => '12:00:00',
            'is_aktif' => true,
        ]);
    }
}
