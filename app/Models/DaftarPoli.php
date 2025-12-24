<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarPoli extends Model
{
    use HasFactory;

    // Nama tabel (opsional, sesuai konvensi)
    protected $table = 'daftar_polis';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'id_pasien',
        'id_jadwal',
        'keluhan',
        'no_antrian',
    ];

    public function periksa(){
        return $this->hasMany(Periksa::class, 'id_daftar_poli');
    }

    public function pasien(){
        return $this->belongsTo(User::class, 'id_pasien');
    }

    public function jadwalPeriksa(){
        return $this->belongsTo(JadwalPeriksa::class, 'id_jadwal');
    }
}
