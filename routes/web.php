<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UploadController;
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

// Rute untuk halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Rute untuk dashboard, memerlukan autentikasi dan verifikasi email
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rute grup untuk pengelolaan profil, memerlukan autentikasi
Route::middleware('auth')->group(function () {
    // Tampilkan form edit profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    
    // Perbarui data profil
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Hapus akun profil
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Tambahkan rute upload (dari baris 20 di gambar)
    // Rute POST untuk menyimpan file upload
    Route::post('/upload', [UploadController::class, 'store'])->name('upload.store');
});

// File rute autentikasi yang disertakan (dari baris 24 di gambar)
require __DIR__ . '/auth.php';