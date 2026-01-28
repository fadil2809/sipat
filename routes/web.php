<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// DASHBOARD
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboard;
use App\Http\Controllers\Peminjam\DashboardController as PeminjamDashboard;

// ADMIN
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\AlatController;
use App\Http\Controllers\Admin\PeminjamanController;
use App\Http\Controllers\Admin\PengembalianController;
use App\Http\Controllers\Admin\LogAktivitasController;

// PEMINJAM
use App\Http\Controllers\Peminjam\PeminjamanController as PeminjamPeminjaman;

/*
|--------------------------------------------------------------------------
| LANDING & AUTH
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('landing');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| DASHBOARD BY ROLE (WAJIB UKK)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->get('/admin/dashboard', [AdminDashboard::class, 'index'])
    ->name('admin.dashboard');

Route::middleware(['auth', 'role:petugas'])
    ->get('/petugas/dashboard', [PetugasDashboard::class, 'index'])
    ->name('petugas.dashboard');

Route::middleware(['auth', 'role:peminjam'])
    ->get('/peminjam/dashboard', [PeminjamDashboard::class, 'index'])
    ->name('peminjam.dashboard');

/*
|--------------------------------------------------------------------------
| PEMINJAM (PINJAM & KEMBALIKAN ALAT)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:peminjam'])
    ->prefix('peminjam')
    ->name('peminjam.')
    ->group(function () {

        // LIHAT PEMINJAMAN
        Route::get('/peminjaman', [PeminjamPeminjaman::class, 'index'])
            ->name('peminjaman.index');

        // FORM PINJAM
        Route::get('/peminjaman/create', [PeminjamPeminjaman::class, 'create'])
            ->name('peminjaman.create');

        // SIMPAN PINJAM
        Route::post('/peminjaman', [PeminjamPeminjaman::class, 'store'])
            ->name('peminjaman.store');

        // KEMBALIKAN ALAT (HANYA PEMINJAM)
        Route::post(
            '/peminjaman/{id}/kembalikan',
            [PeminjamPeminjaman::class, 'kembalikan']
        )->name('peminjaman.kembalikan');
    });

/*
|--------------------------------------------------------------------------
| ADMIN (MASTER DATA + PEMINJAMAN + MONITOR PENGEMBALIAN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // MASTER DATA
        Route::resource('users', UserController::class);
        Route::resource('kategori', KategoriController::class);
        Route::resource('alat', AlatController::class);

        // PEMINJAMAN (CRUD)
        Route::resource('peminjaman', PeminjamanController::class);

        // PENGEMBALIAN (ADMIN HANYA LIHAT / KONFIRMASI)
        Route::get('/pengembalian', [PengembalianController::class, 'index'])
            ->name('pengembalian.index');

        Route::post('/pengembalian/{id}', [PengembalianController::class, 'kembalikan'])
            ->name('pengembalian.kembalikan');

        // LOG AKTIVITAS
        Route::get('admin/log-aktivitas', [LogAktivitasController::class, 'index'])
            ->name('admin.log.index');
    });
