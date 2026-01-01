<?php

namespace App\Http\Controllers\pasien;

use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekamMedisController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $records = MedicalRecord::where('id_pasien', $user->id)->with('dokter', 'periksa')->orderBy('tanggal', 'desc')->get();
        return view('pasien.rekam-medis.index', compact('records'));
    }

    public function show(string $id)
    {
        $record = MedicalRecord::where('id_pasien', Auth::user()->id)->where('id', $id)->with('dokter', 'periksa')->firstOrFail();
        return view('pasien.rekam-medis.show', compact('record'));
    }
}
