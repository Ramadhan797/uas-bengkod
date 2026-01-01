<?php

use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\AdminDokterController;
use App\Http\Controllers\admin\AdminObatController;
use App\Http\Controllers\admin\AdminPasienController;
use App\Http\Controllers\admin\AdminPoliController;
use App\Http\Controllers\dokter\JadwalPeriksaController;
use App\Http\Controllers\dokter\PeriksaController;
use App\Http\Controllers\dokter\RiwayatPeriksaController;
use App\Http\Controllers\pasien\DaftarPoliController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // dokter
    Route::middleware(['role:dokter'])->prefix('dokter')->group(function () {
        Route::resource('/jadwal-periksa', JadwalPeriksaController::class)->names('dokter.jadwal-periksa');
        Route::patch('/jadwal-periksa/{id}/toggle', [JadwalPeriksaController::class, 'toggleStatus'])
            ->name('dokter.jadwal-periksa.toggleStatus');
        Route::patch('/jadwal-periksa/activate-all', [JadwalPeriksaController::class, 'activateAll'])
            ->name('dokter.jadwal-periksa.activateAll');
        Route::patch('/jadwal-periksa/deactivate-all', [JadwalPeriksaController::class, 'deactivateAll'])
            ->name('dokter.jadwal-periksa.deactivateAll');
        Route::resource('/periksa', PeriksaController::class)->names('dokter.periksa');
        Route::resource('/riwayat', RiwayatPeriksaController::class)->names('dokter.riwayat');
    });

    // admin
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::resource('dashboard', AdminDashboardController::class)->names('admin.dashboard');
        Route::resource('/dokter', AdminDokterController::class)->names('admin.dokter');
        Route::resource('/pasien', AdminPasienController::class)->names('admin.pasien');
        Route::resource('/obat', AdminObatController::class)->names('admin.obat');
        // Stock management
        Route::get('/obat/{id}/stok', [AdminObatController::class, 'stockForm'])->name('admin.obat.stockForm');
        Route::patch('/obat/{id}/stok', [AdminObatController::class, 'addStock'])->name('admin.obat.addStock');
        Route::get('/obat/{id}/stok-decrease', [AdminObatController::class, 'stockDecreaseForm'])->name('admin.obat.stockDecreaseForm');
        Route::patch('/obat/{id}/stok-decrease', [AdminObatController::class, 'decreaseStock'])->name('admin.obat.decreaseStock');
        Route::resource('/poli', AdminPoliController::class)->names('admin.poli');
    });

    // pasien
    Route::middleware(['role:pasien'])->prefix('pasien')->group(function () {
        Route::get('/dashboard', function () {
            return view('pasien.dashboard');
        })->name('pasien.dashboard');
        Route::get('/daftar-poli', [DaftarPoliController::class, 'index'])->name('pasien.daftar-poli.index');
        Route::get('/daftar-poli/create/{id}', [DaftarPoliController::class, 'create'])->name('pasien.daftar-poli.create');
        Route::post('/daftar-poli/store/{id}', [DaftarPoliController::class, 'store'])->name('pasien.daftar-poli.store');

        // Rekam medis pasien
        Route::get('/rekam-medis', [\App\Http\Controllers\pasien\RekamMedisController::class, 'index'])->name('pasien.rekam-medis.index');
        Route::get('/rekam-medis/{id}', [\App\Http\Controllers\pasien\RekamMedisController::class, 'show'])->name('pasien.rekam-medis.show');
    });
});



// pasien


require __DIR__.'/auth.php';
