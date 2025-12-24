<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periksa extends Model
{
    protected $table = 'periksas';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'id_daftar_poli',
        'tanggal_periksa',
        'catatan',
        'biaya_periksa',
        'status',
    ];


    public function detailPeriksa(){
        return $this->hasMany(DetailPeriksa::class, 'id_periksa');
    }
    public function daftarPoli(){
        return $this->belongsTo(DaftarPoli::class, 'id_daftar_poli');
    }
}
