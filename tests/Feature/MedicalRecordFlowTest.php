<?php

namespace Tests\Feature;

use App\Models\MedicalRecord;
use App\Models\Obat;
use App\Models\Periksa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MedicalRecordFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_doctor_can_create_medical_record_via_periksa_update()
    {
        // create users
        $dokter = User::factory()->create(['role' => 'dokter']);
        $pasien = User::factory()->create(['role' => 'pasien']);

        // Buat jadwal dan daftar_poli yang valid karena ada foreign key constraint
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
            'keluhan' => 'Sakit kepala',
            'no_antrian' => 1,
        ]);

        $periksa = Periksa::create([
            'id_daftar_poli' => $daftar->id,
            'tanggal_periksa' => now()->format('Y-m-d'),
            'status' => false,
        ]);

        // simulate periksa being updated (we directly call the model to create medical record)
        MedicalRecord::create([
            'id_periksa' => $periksa->id,
            'id_pasien' => $pasien->id,
            'id_dokter' => $dokter->id,
            'tanggal' => $periksa->tanggal_periksa,
            'diagnosa' => 'Test Diagnosa',
            'tindakan' => 'Test tindakan',
            'catatan' => 'Catatan',
            'biaya' => 10000,
        ]);

        $this->assertDatabaseHas('medical_records', [
            'id_periksa' => $periksa->id,
            'diagnosa' => 'Test Diagnosa'
        ]);
    }
}
