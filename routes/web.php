<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriBukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KoleksiController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [UserController::class, 'index'])->name('beranda');
Route::get('/buku/{id}', [UlasanController::class, 'index'])->name('buku.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware(['role:admin,petugas'])->group(function () {
        Route::get('/dashboard', function () { return view('admin.dashboard'); })->name('dashboard');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['role:admin,petugas'])->group(function () {
        Route::resource('dataBuku', BukuController::class);
        Route::resource('kategori', KategoriController::class);
        Route::resource('kategoriBuku', KategoriBukuController::class);

        Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
        Route::post('/peminjaman/{id}', [PeminjamanController::class, 'update'])->name('peminjaman.update');
        Route::delete('/peminjaman/{id}', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');

        Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota.index');
    });

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/petugas', [PetugasController::class, 'index'])->name('petugas.index');
        Route::post('/petugas', [PetugasController::class, 'store'])->name('petugas.store');
    });

    Route::post('/buku/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');

    Route::get('/koleksi', [KoleksiController::class, 'index'])->name('koleksi.index');
    Route::post('/koleksi', [KoleksiController::class, 'store'])->name('koleksi.store');

    Route::post('/buku/ulasan', [UlasanController::class, 'store'])->name('ulasan.store');
});

require __DIR__.'/auth.php';
