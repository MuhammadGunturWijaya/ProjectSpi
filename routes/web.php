<?php
use App\Http\Controllers\InstrumenPengawasanController;
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
use App\Http\Controllers\ProsesBisnisSPIController;
use App\Http\Controllers\KodeEtikSPIController;
use App\Http\Controllers\KonsideranSPIController;
use App\Http\Controllers\PiagamSPIController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\ProgramKerjaController;
use App\Http\Controllers\SDMAparaturController;
use App\Http\Controllers\AkuntabilitasController;
use App\Http\Controllers\PedomanPengawasanController;
use App\Http\Controllers\detailPedomanController;
use App\Http\Controllers\DetailPengawasanController;
use App\Http\Controllers\SearchPedomanController;
use App\Http\Controllers\PosApPengawasanController;
use App\Http\Controllers\TambahPedomanController;
use App\Http\Controllers\PiagamController;

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
Route::middleware(['auth'])->group(function () {
    Route::get('/berita/{id}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
    Route::put('/berita/{id}', [BeritaController::class, 'update'])->name('berita.update');
});

// Struktur organisasi - halaman publik
Route::get('/struktur-organisasi', [StrukturController::class, 'index'])->name('struktur.index');

// Profil SPI
Route::get('/profile-spi', [App\Http\Controllers\PageController::class, 'ProfileSpi'])->name('profile.spi');

// Pencarian
Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::get('/search/pedoman-pengawasan', function () {
    return view('search.searchPedomanPengawasan');
})->name('search.searchPedomanPengawasan');

Route::get('/search-pedoman', [SearchPedomanController::class, 'index'])->name('search.pedoman');

Route::get('/search-pedoman', [SearchPedomanController::class, 'index'])->name('search.searchPedomanPengawasan');

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

// Route ke halaman Proses Bisnis SPI
Route::get('/proses-bisnis-spi', [ProsesBisnisSPIController::class, 'index'])
    ->name('proses-bisnis-spi');

// Route ke halaman Kode Etik SPI
Route::get('/kode-etik-spi', [KodeEtikSPIController::class, 'index'])
    ->name('kode-etik-spi');

// Route Ke halaman Konsideran SPI
Route::get('/konsideran-spi', [KonsideranSPIController::class, 'index'])
    ->name('konsideran-spi');


// Route Ke halaman pedoman audit SPI
Route::get('/pedoman-audit', [PedomanAuditController::class, 'index'])
    ->name('pedoman-audit');

// Route Ke halaman pedoman monev SPI
Route::get('/pedoman-monev', [PedomanMonevController::class, 'index'])->name('pedoman-monev');

// Route Ke halaman pedoman reviu SPI
Route::get('/pedoman-reviu', [PedomanReviuController::class, 'index'])->name('pedoman-reviu');

// Route Ke halaman POS AP Audit
Route::get('/pos-ap-audit', [PosApAuditController::class, 'index'])->name('pos-ap-audit');

// Route Ke halaman pedoman mr 
Route::get('/pedoman/mr', [PedomanMRController::class, 'index'])->name('pedoman.mr');

// Route Ke halaman manajemen perubahan
Route::get('/manajemen-perubahan', [ManajemenPerubahanController::class, 'index'])->name('manajemen-perubahan');

// Route Ke halaman PenataanTataKelola
Route::get('/penataan-tata-kelola', [PenataanTataKelolaController::class, 'index'])->name('penataan.index');

// Route Ke halaman PenguatanPengawasan
Route::get('/penguatan-pengawasan', [PenguatanPengawasanController::class, 'index'])->name('pengawasan.index');

// Route Ke halaman PeningkatanPelayanan
Route::get('/pelayanan', [PeningkatanPelayananController::class, 'index'])->name('pelayanan');

// Route Ke halaman SURVEY
Route::post('/survey', [SurveyController::class, 'store'])->name('survey.store');

Route::middleware('auth')->group(function () {
    Route::post('/survey', [SurveyController::class, 'store'])->name('survey.store');
});

// route ke halaman instrumen pengawasan
Route::get('/instrumen-pengawasan', [InstrumenPengawasanController::class, 'index'])->name('instrumen.pengawasan');
// route ke halaman program kerja SPI
Route::get('/program-kerja', [ProgramKerjaController::class, 'index'])->name('program.kerja');
// route ke halaman penataan sdm aparatur
Route::get('/penataan-sdm-aparatur', [SDMAparaturController::class, 'index'])
    ->name('penataan.sdm.aparatur');
// route ke halaman penguatan akuntabilitas
Route::get('/penguatan-akuntabilitas', [AkuntabilitasController::class, 'index'])
    ->name('penguatan.akuntabilitas');

// Halaman utama Pedoman Pengawasan
Route::get('/pedoman-pengawasan', [PedomanPengawasanController::class, 'index'])
    ->name('pedoman.pengawasan');



// Halaman detail pedoman
Route::get('/pedoman/{id}', [PedomanPengawasanController::class, 'show'])->name('pedoman.show');

// 
Route::get('/pedoman/detail/{id}', [PedomanPengawasanController::class, 'getDetail'])->name('pedoman.detail');
Route::get('/pedoman/detail/{id}', [PedomanPengawasanController::class, 'getDetail']);
Route::get('/pedoman/detail/{id}', [PedomanPengawasanController::class, 'detailJson']);

//route ke halaman tambah pedoman
Route::post('/pedoman', [TambahPedomanController::class, 'store'])
    ->name('pedoman.store');

// Route untuk Detail Pengawasan
Route::get('/detail-pengawasan', [DetailPengawasanController::class, 'index'])
    ->name('detail.pengawasan');

// Route detail pedoman pengawasan
Route::get('/pedoman-pengawasan/{id}', [DetailPengawasanController::class, 'show'])
    ->name('pedoman.detail');

Route::delete('/pedoman/{id}', [PedomanPengawasanController::class, 'destroy'])->name('pedoman.destroy');
Route::delete('/pedoman/audit', [PedomanController::class, 'destroyAll'])->name('pedoman.destroyAll');

Route::get('/pedoman/{id}/edit', [PedomanPengawasanController::class, 'edit'])->name('pedoman.edit');
Route::put('/pedoman/{id}', [PedomanPengawasanController::class, 'update'])->name('pedoman.update');

// Halaman detail pedoman (Blade)
Route::get('/pedoman-pengawasan/{id}', [PedomanPengawasanController::class, 'show'])
    ->name('pedoman.show');

// API detail lengkap (JSON)
Route::get('/pedoman-pengawasan/{id}/detail', [PedomanPengawasanController::class, 'getDetail'])
    ->name('pedoman.detail.json');

// API detail ringkas (JSON)
Route::get('/pedoman-pengawasan/{id}/json', [PedomanPengawasanController::class, 'detailJson'])
    ->name('pedoman.json');

// Halaman detail pedoman audit (lihat lebih / list audit)
Route::get('/pedoman-audit', [DetailPengawasanController::class, 'index'])
    ->name('pedoman.audit');


Route::get('/pedoman/{id}', [App\Http\Controllers\PedomanController::class, 'show'])->name('pedoman.show');

//HALAMAN POS AP PENGAWASAN 
Route::get('/pos-ap-pengawasan', [PosApPengawasanController::class, 'index'])->name('pos.ap.pengawasan');
Route::post('/pos-ap/store', [PosApPengawasanController::class, 'store'])->name('posap.store');
Route::get('/pos-ap/{id}', [PosApPengawasanController::class, 'show'])->name('posap.show');

// Untuk AJAX detail
Route::get('/pos-ap/detail/{id}', [PosApPengawasanController::class, 'detailJson']);
// Route untuk AJAX detail PosAp
Route::get('/posap/detail/{id}', [PosApPengawasanController::class, 'getDetail'])->name('posap.detail');
Route::get('/posap/audit', [PosApPengawasanController::class, 'showByJenis'])
    ->name('posap.audit');

Route::post('/upload-piagam', [PiagamSPIController::class, 'store'])->name('piagam.store');
Route::get('/piagam', [PiagamSPIController::class, 'index'])->name('piagam.index');
Route::get('/piagam/{id}', [PiagamSPIController::class, 'show'])->name('piagam.show');

// Route Ke halaman piagam SPI
Route::get('/piagam-spi', [PiagamSPIController::class, 'index'])->name('piagam-spi');


