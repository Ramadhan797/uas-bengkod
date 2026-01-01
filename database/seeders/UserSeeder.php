<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin Sistem',
                'email' => 'admin@example.com',
                'password' => 'password', // Ganti di production
                'role' => 'admin',
            ]
        );

        // Dokter
        User::updateOrCreate(
            ['email' => 'dokter1@example.com'],
            [
                'name' => 'Dr. Budi',
                'email' => 'dokter1@example.com',
                'password' => 'password',
                'alamat' => 'Jl. Melati No. 2',
                'no_ktp' => '9876543210987654',
                'id_poli' => 1, 
                'no_hp' => '081234567890',
                'role' => 'dokter',
            ]
        );
        User::updateOrCreate(
            ['email' => 'dokter2@example.com'],
            [
                'name' => 'Dr. andi',
                'email' => 'dokter2@example.com',
                'password' => 'password',
                'alamat' => 'Jl. Melati No. 1',
                'no_ktp' => '3578012304920001',
                'id_poli' => 2, 
                'no_hp' => '089672944224',
                'role' => 'dokter',
            ]
        );

        // Pasien
        User::updateOrCreate(
            ['email' => 'pasien@example.com'],
            [
                'name' => 'Ani Pasien',
                'email' => 'pasien@example.com',
                'password' => 'password',
                'alamat' => 'Jl. Mawar No. 1',
                'no_ktp' => '1234567890123456',
                'no_hp' => '082345678901',
                'no_rm' => 'RM001',
                'role' => 'pasien',
            ]
        );
    }
}
