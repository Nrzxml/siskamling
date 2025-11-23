<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JadwalRondaController;
use App\Http\Controllers\Auth\PetugasController;
use App\Http\Controllers\Petugas\AbsensiController;


Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'petugas') {
            return redirect()->route('petugas.dashboard');
        } else {
            return redirect()->route('warga.dashboard');
        }
    }

    // Kalau belum login, tampilkan halaman utama Siskamling
    return view('welcome_siskamling');
});


Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'petugas') {
        return redirect()->route('petugas.dashboard');
    } else {
        return redirect()->route('warga.dashboard');
    }
})->middleware(['auth'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('laporan', LaporanController::class);
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::get('/berita', function () {
    return "<h1>Halaman Berita / Peringatan RT (sementara)</h1>";
})->name('berita.index');

Route::get('/berita', [App\Http\Controllers\BeritaController::class, 'index'])
    ->name('berita.index')
    ->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::resource('jadwal', JadwalRondaController::class);
});

// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/admin/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
//     Route::post('/admin/users/{user}/role', [App\Http\Controllers\Admin\UserController::class, 'updateRole'])->name('admin.users.updateRole');
// });

// Dashboard Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/users', [App\Http\Controllers\Admin\AdminUserController::class, 'index'])->name('admin.users.index');
    Route::post('/admin/users/{user}/role', [App\Http\Controllers\Admin\AdminUserController::class, 'updateRole'])->name('admin.users.updateRole');
});

// Dashboard Petugas
Route::middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('/petugas/dashboard', function () {
        return view('petugas.dashboard');
    })->name('petugas.dashboard');
});

// Dashboard Warga
Route::middleware(['auth', 'role:warga'])->group(function () {
    Route::get('/warga/dashboard', function () {
        return view('warga.dashboard');
    })->name('warga.dashboard');
});

Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {
        Route::get('/jadwal-ronda', [JadwalRondaController::class, 'index'])->name('jadwal.index');
        Route::post('/jadwal-ronda', [JadwalRondaController::class, 'store'])->name('jadwal.store');
    });

Route::get('/jadwal', [JadwalRondaController::class, 'index'])->name('jadwal.index');

Route::prefix('petugas')
    ->middleware(['auth', 'role:petugas'])
    ->name('petugas.')
    ->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Auth\PetugasController::class, 'index'])->name('dashboard');
        Route::get('/jadwal', [App\Http\Controllers\Auth\PetugasController::class, 'jadwal'])->name('jadwal');
        Route::get('/laporan', [App\Http\Controllers\Auth\PetugasController::class, 'laporan'])->name('laporan');

        // ✅ ubah ini
        Route::get('/absensi', [App\Http\Controllers\Petugas\AbsensiController::class, 'index'])->name('absensi');
        Route::get('/absensi/{id}/form', [App\Http\Controllers\Petugas\AbsensiController::class, 'form'])->name('absensi.form');
        Route::post('/absensi/store', [App\Http\Controllers\Petugas\AbsensiController::class, 'store'])->name('absensi.store');
    });

Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/absensi', [\App\Http\Controllers\Petugas\AbsensiController::class, 'index'])->name('absensi.index');
    Route::get('/absensi/{id}/form', [\App\Http\Controllers\Petugas\AbsensiController::class, 'form'])->name('absensi.form');
    Route::post('/absensi/store', [\App\Http\Controllers\Petugas\AbsensiController::class, 'store'])->name('absensi.store');
});



