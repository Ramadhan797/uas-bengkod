<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;


class AdminPasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pasiens = User::where('role', 'pasien')->get();
        return view('admin.pasien.index', compact('pasiens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pasien.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'alamat' => 'required|string',
            'no_ktp' => 'required|digits:16|unique:users,no_ktp',
            'no_hp' => 'required|string|max:15',
        ]);

        // Cek apakah pasien sudah terdaftar (berdasarkan no_ktp)
        $existingPasien = User::where('no_ktp', $request->no_ktp)->first();

        if ($existingPasien) {
            return back()->with('error', 'Pasien dengan No KTP ini sudah terdaftar.');
        }

        $now = Carbon::now();
        $bulanIni = $now->format('Ym'); // 202506
        $jumlahPasienBulanIni = User::where('role', 'pasien')->where('created_at', 'like', $now->format('Y-m') . '%')
            ->where('role', 'pasien')
            ->count();

        $no_rm = $bulanIni . '-' . ($jumlahPasienBulanIni + 1);



        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'no_ktp' => $request->no_ktp,
            'no_hp' => $request->no_hp,
            'no_rm' => $no_rm,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.pasien.index')->with('success', 'Pasien Behasil Ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.pasien.edit', [
            'pasien' => User::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $pasien = User::findOrFail($id);


        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($pasien->id)
            ],
            'password' => 'nullable|string|min:8',
            'alamat' => 'required|string',
            'no_ktp' => [
                'required',
                'digits:16',
                Rule::unique('users', 'no_ktp')->ignore($pasien->id)
            ],
            'no_hp' => 'required|string|max:15',
        ]);


        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'no_ktp' => $request->no_ktp,
            'no_hp' => $request->no_hp,
        ];

        // Hanya update password jika field-nya diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $pasien->update($data);

        return redirect()->route('admin.pasien.index')->with('success', 'Data pasien berhasil diperbarui.');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pasien = User::findOrFail($id);
        $pasien->delete();
        return redirect()->route('admin.pasien.index')->with('success', 'Pasien Berhasil Dihapus.');
    }
}
