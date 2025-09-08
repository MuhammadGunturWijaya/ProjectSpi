<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\VisiMisiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\StrukturController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\SdmController;

// Halaman landing
Route::get('/', [LandingPageController::class, 'index'])->name('landingpage');
Route::get('/landing', [LandingPageController::class, 'index'])->name('landing');

// Berita
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.show');

// Berita (admin only)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/berita/create', [BeritaController::class, 'create'])->name('berita.create');
    Route::post('/admin/berita/store', [BeritaController::class, 'store'])->name('berita.store');
});

// Struktur organisasi - halaman publik
Route::get('/struktur-organisasi', [StrukturController::class, 'index'])->name('struktur.index');

// Profil SPI
Route::get('/profile-spi', [App\Http\Controllers\PageController::class, 'ProfileSpi'])->name('profile.spi');

// Pencarian
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Route admin (harus login & role admin)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
    Route::get('/admin/pengaduan/{id}', [PengaduanController::class, 'show'])->name('pengaduan.show');
    Route::delete('/admin/pengaduan/{id}', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');
});



// Pengaduan
Route::get('/pengaduan', [PengaduanController::class, 'create'])->name('pengaduan.create');
Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');

// Hanya user login yang boleh kirim
Route::middleware(['auth'])->group(function () {
    Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
});

// Visi Misi
Route::get('/visi-misi', [VisiMisiController::class, 'index'])->name('visi-misi.index');

// Login/Register
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Lupa Password
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Reset Password
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// Routes yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {
    // Edit struktur organisasi
    Route::get('/struktur/edit', [StrukturController::class, 'edit'])->name('struktur.edit');
    Route::post('/struktur/update', [StrukturController::class, 'update'])->name('struktur.update');

    // Edit pengurus
    Route::get('/pengurus/{id}/edit', [PengurusController::class, 'edit'])->name('pengurus.edit');
    Route::post('/pengurus/{id}/update', [PengurusController::class, 'update'])->name('pengurus.update');
    Route::get('/pengurus/create', [PengurusController::class, 'create'])->name('pengurus.create');
    Route::post('/pengurus/store', [PengurusController::class, 'store'])->name('pengurus.store');
    //  route delete 
    Route::delete('/pengurus/{id}', [PengurusController::class, 'destroy'])->name('pengurus.destroy');
    Route::get('/pengurus', [PengurusController::class, 'index'])->name('pengurus.index');

});

//Sumber daya manusia
Route::get('/SumberDayaManusia', function () {
    return view('Sumber-Daya-Manusia');
});

Route::get('/Sumber-Daya-Manusia', [SdmController::class, 'index'])->name('sdm.index');

Route::get('/sumber-daya-manusia', [SdmController::class, 'index'])->name('sdm.index');
Route::get('/sumber-daya-manusia/create', [SdmController::class, 'create'])->name('sdm.create');
Route::post('/sumber-daya-manusia/store', [SdmController::class, 'store'])->name('sdm.store');
Route::get('/sumber-daya-manusia/{id}/edit', [SdmController::class, 'edit'])->name('sdm.edit');
Route::post('/sumber-daya-manusia/{id}/update', [SdmController::class, 'update'])->name('sdm.update');
Route::delete('/sumber-daya-manusia/{id}', [SdmController::class, 'destroy'])->name('sdm.destroy');

Route::get('/sumber-daya-manusia/{id}/edit', [SdmController::class, 'edit'])->name('sdm.edit');
Route::post('/sumber-daya-manusia/{id}/update', [SdmController::class, 'update'])->name('sdm.update');
