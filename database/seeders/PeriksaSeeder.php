<?php

namespace Database\Seeders;

use App\Models\Periksa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Periksa::create([
            'id_daftar_poli' => 1,
            'tanggal_periksa' => now(),
            'biaya_periksa' => 0,
            'status' => false,
        ]);
    }
}
