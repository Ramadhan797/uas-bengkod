<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
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



        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'no_ktp' => $request->no_ktp,
            'no_hp' => $request->no_hp,
            'no_rm' => $no_rm,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
