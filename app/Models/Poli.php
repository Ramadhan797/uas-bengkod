<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    use HasFactory;

    // Nama tabel (opsional jika sesuai konvensi)
    protected $table = 'polis';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'nama_poli',
        'keterangan',
    ];

    public function dokter(){
        return $this->hasMany(User::class, 'id_poli');
    }
    
}
