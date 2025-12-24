<?php

namespace Database\Seeders;

use App\Models\DaftarPoli;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DaftarPoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DaftarPoli::create([
            'id_pasien' => 3,
            'id_jadwal' => 1,
            'keluhan' => 'Demam dan batuk',
            'no_antrian' => 1
        ]);
    }
}
