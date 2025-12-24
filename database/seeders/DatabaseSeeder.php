<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PoliSeeder::class,
            UserSeeder::class,
            JadwalPeriksaSeeder::class,
            DaftarPoliSeeder::class,
            PeriksaSeeder::class,
            ObatSeeder::class,
            DetailPeriksaSeeder::class,
        ]);
    }
}
