<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin Sistem',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Ganti di production
            'role' => 'admin',
        ]);

        // Dokter
        User::create([
            'name' => 'Dr. Budi',
            'email' => 'dokter1@example.com',
            'password' => Hash::make('password'),
            'alamat' => 'Jl. Melati No. 2',
            'no_ktp' => '9876543210987654',
            'id_poli' => 1, 
            'no_hp' => '081234567890',
            'role' => 'dokter',
        ]);
        User::create([
            'name' => 'Dr. andi',
            'email' => 'dokter2@example.com',
            'password' => Hash::make('password'),
            'alamat' => 'Jl. Melati No. 1',
            'no_ktp' => '3578012304920001',
            'id_poli' => 2, 
            'no_hp' => '089672944224',
            'role' => 'dokter',
        ]);

        // Pasien
        User::create([
            'name' => 'Ani Pasien',
            'email' => 'pasien@example.com',
            'password' => Hash::make('password'),
            'alamat' => 'Jl. Mawar No. 1',
            'no_ktp' => '1234567890123456',
            'no_hp' => '082345678901',
            'no_rm' => 'RM001',
            'role' => 'pasien',
        ]);
    }
}
