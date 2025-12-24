<?php

namespace Database\Seeders;

use App\Models\DetailPeriksa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailPeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DetailPeriksa::insert([
            [
                'id_periksa' => 1,
                'id_obat' => 1
            ],
            [
                'id_periksa' => 1,
                'id_obat' => 2
            ]
        ]);
    }
}
