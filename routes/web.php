<?php
use App\Http\Controllers\InstrumenPengawasanController;
use App\Http\Controllers\Perubahan\PerubahanController;
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
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\ProgramKerjaController;
use App\Http\Controllers\SDMAparaturController;
use App\Http\Controllers\AkuntabilitasController;
use App\Http\Controllers\PedomanPengawasanController;
use App\Http\Controllers\detailPedomanController;
use App\Http\Controllers\DetailPengawasanController;
use App\Http\Controllers\SearchPedomanController;
use App\Http\Controllers\TambahPedomanController;
use App\Http\Controllers\Perubahan\ManajemenPerubahanController;
use App\Http\Controllers\posAp\PosApPengawasanController;
use App\Http\Controllers\Instrumen\InstrumenController;
use App\Http\Controllers\SPI\ProgramKerjaSPIController;
use App\Http\Controllers\Konsideran\KonsideranSPIController;
use App\Http\Controllers\Piagam\PiagamSPIController;
use App\Http\Controllers\Penataan\PenataanTataKelolaController;
use App\Http\Controllers\Penataan\PenataanSistemController;
use App\Http\Controllers\IdentifikasiRisikoController;
use App\Http\Controllers\Pengawasan\PenguatanPengawasanController;
use App\Http\Controllers\Peningkatan\PeningkatanKualitasController;
use App\Http\Controllers\Akuntabilitas\PenguatanAkuntabilitasController;
use App\Http\Controllers\MR\PedomanMRController;
use App\Http\Middleware\IsAdmin;


// Halaman landing
Route::get('/', [LandingPageController::class, 'index'])->name('landingpage');
Route::get('/landing', [LandingPageController::class, 'index'])->name('landing');

// Berita
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.show');



Route::middleware(['auth'])->prefix('admin/berita')->group(function () {
    Route::get('create', [BeritaController::class, 'create'])->name('berita.create');
    Route::post('store', [BeritaController::class, 'store'])->name('berita.store');
    Route::get('{id}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
    Route::put('{id}', [BeritaController::class, 'update'])->name('berita.update');
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

// Route umum (user biasa)
Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store'); // semua user
Route::get('/pengaduan/{id}', [PengaduanController::class, 'show'])->name('pengaduan.show'); // semua user

// Route admin (harus login & role admin)
Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/admin/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
    Route::delete('/admin/pengaduan/{id}', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');
    Route::patch('/admin/pengaduan/{id}/update-status', [PengaduanController::class, 'updateStatus'])->name('pengaduan.updateStatus');
});

Route::delete('/pengaduan/{id}', [PengaduanController::class, 'destroy'])
    ->name('pengaduan.destroy')
    ->middleware('auth'); // pastikan user login



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


// Route Ke halaman pedoman mr 
Route::get('/pedoman/mr', [PedomanMRController::class, 'index'])->name('pedoman.mr');

// Route Ke halaman manajemen perubahan
Route::get('/manajemen-perubahan', [ManajemenPerubahanController::class, 'index'])->name('manajemen-perubahan');



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

Route::get('/manajemen-perubahan', [ManajemenPerubahanController::class, 'index'])
    ->name('manajemen.perubahan');


Route::get('/manajemen-perubahan', [ManajemenPerubahanController::class, 'index'])->name('manajemen.perubahan');
Route::post('/upload-Manajemen', [ManajemenPerubahanController::class, 'store'])->name('manajemen.store');

//--------------------------------

// routes/web.php
Route::prefix('posAp')->name('posAp.')->group(function () {
    Route::get('/', [PosApPengawasanController::class, 'index'])->name('index');
    Route::post('/store', [PosApPengawasanController::class, 'store'])->name('store');
    Route::delete('/{id}', [PosApPengawasanController::class, 'destroy'])->name('destroy');
    Route::get('/{id}/edit', [PosApPengawasanController::class, 'edit'])->name('edit');
    Route::put('/{id}', [PosApPengawasanController::class, 'update'])->name('update');

    // detail per pos ap
    Route::get('/show/{id}', [PosApPengawasanController::class, 'show'])->name('show');

    // lihat lebih
    Route::get('/lihat/{jenis}', [PosApPengawasanController::class, 'lihat'])->name('lihat');
});


// -----------------------------------
// Halaman daftar instrumen berdasarkan jenis
Route::get('/instrumen/lihat/{jenis}', [InstrumenController::class, 'lihat'])
    ->name('instrumen.lihat');

// Halaman index instrumen
Route::get('/instrumen', [InstrumenController::class, 'index'])
    ->name('instrumen.index');

// Halaman detail instrumen
Route::get('/instrumen/{id}', [InstrumenController::class, 'show'])
    ->name('instrumen.show');

// Route untuk AJAX detail
Route::get('/instrumen/detail/{id}', [InstrumenController::class, 'getDetail'])
    ->name('instrumen.getDetail');

// Route untuk menyimpan data instrumen (store)
Route::post('/instrumen/store', [InstrumenController::class, 'store'])
    ->name('instrumen.store');

Route::resource('instrumen', InstrumenController::class);



//--------------------------------
Route::prefix('spi')->name('programKerja.')->group(function () {
    Route::get('/', [ProgramKerjaSPIController::class, 'index'])->name('index');   // programKerja.index
    Route::get('/lihat/{jenis?}', [ProgramKerjaSPIController::class, 'lihat'])->name('lihat');
    // programKerja.lihat
    Route::get('/create', [ProgramKerjaSPIController::class, 'create'])->name('create'); // programKerja.create
    Route::post('/store', [ProgramKerjaSPIController::class, 'store'])->name('store'); // programKerja.store
    Route::get('/{id}', [ProgramKerjaSPIController::class, 'show'])->name('show'); // programKerja.show
    Route::get('/{id}/edit', [ProgramKerjaSPIController::class, 'edit'])->name('edit'); // programKerja.edit
    Route::put('/{id}', [ProgramKerjaSPIController::class, 'update'])->name('update'); // programKerja.update
    Route::delete('/{id}', [ProgramKerjaSPIController::class, 'destroy'])->name('destroy'); // programKerja.destroy
});

//------------------------------------------
// Halaman daftar semua Konsideran SPI berdasarkan jenis
Route::get('/konsideran/{jenis?}', [KonsideranSPIController::class, 'index'])->name('konsideran.index');

// Halaman detail Konsideran SPI
Route::get('/konsideran/detail/{id}', [KonsideranSPIController::class, 'show'])->name('konsideran.show');

// Form tambah Konsideran SPI
Route::get('/konsideran/tambah', [KonsideranSPIController::class, 'create'])->name('konsideran.create');

// Simpan Konsideran SPI baru
Route::post('/konsideran/store', [KonsideranSPIController::class, 'store'])->name('konsideran.store');

// Form edit Konsideran SPI
Route::get('/konsideran/edit/{id}', [KonsideranSPIController::class, 'edit'])->name('konsideran.edit');

// Update Konsideran SPI
Route::put('/konsideran/update/{id}', [KonsideranSPIController::class, 'update'])->name('konsideran.update');

// Hapus Konsideran SPI
Route::delete('/konsideran/destroy/{id}', [KonsideranSPIController::class, 'destroy'])->name('konsideran.destroy');

Route::get('/KonsideranSPI/lihat/', [KonsideranSPIController::class, 'lihat'])->name('konsideran.lihat');

//------------------------------------------
// Halaman daftar semua Piagam SPI
Route::get('/piagam', [PiagamSPIController::class, 'index'])
    ->name('piagam.index');

// Halaman detail Piagam SPI
Route::get('/piagam/{id}', [PiagamSPIController::class, 'show'])
    ->name('piagam.show');

// Halaman form tambah Piagam SPI
Route::get('/piagam/create', [PiagamSPIController::class, 'create'])
    ->middleware('auth')
    ->name('piagam.create');

// Simpan data Piagam SPI baru
Route::post('/piagam', [PiagamSPIController::class, 'store'])
    ->middleware('auth')
    ->name('piagam.store');

// Halaman edit Piagam SPI
Route::get('/piagam/{id}/edit', [PiagamSPIController::class, 'edit'])
    ->middleware('auth')
    ->name('piagam.edit');

// Update data Piagam SPI
Route::put('/piagam/{id}', [PiagamSPIController::class, 'update'])
    ->middleware('auth')
    ->name('piagam.update');

// Hapus Piagam SPI
Route::delete('/piagam/{id}', [PiagamSPIController::class, 'destroy'])
    ->middleware('auth')
    ->name('piagam.destroy');

// Halaman daftar Piagam SPI (versi lihat)
Route::get('/PiagamSPI/lihat', [PiagamSPIController::class, 'lihat'])
    ->name('piagam.lihat');

// (Opsional) Route pencarian Piagam SPI
Route::get('/piagam/search', [PiagamSPIController::class, 'search'])
    ->name('piagam.search');

Route::get('/piagamspi/detail/{id}', [PiagamSPIController::class, 'showJson']);


//------------------------------
Route::resource('perubahan', PerubahanController::class);

// Tambahan untuk method lihat()
Route::get('/Perubahan/lihat', [PerubahanController::class, 'lihat'])
    ->name('perubahan.lihat');


Route::resource('penataan', PenataanTataKelolaController::class);

Route::get('/Penataan/lihat', [PenataanTataKelolaController::class, 'lihat'])
    ->name('penataan.lihat');

Route::resource('penataanSistem', PenataanSistemController::class);

// Route tambahan untuk halaman daftar/lihat
Route::get('/PenataanSistem/lihat', [PenataanSistemController::class, 'lihat'])
    ->name('penataanSistem.lihat');


//SURVEY KEPUASAN
Route::get('/survey-kepuasan', function () {
    return view('SurveyKepuasan.Survey-Kepuasan');
})->name('survey.kepuasan');

Route::post('/survey-kepuasan', [SurveyController::class, 'store'])
    ->name('survey.kepuasan.store');

Route::get('/survey-kepuasan/data', [SurveyController::class, 'showAll'])
    ->name('survey.kepuasan.data');

Route::get('/surveys/download', [SurveyController::class, 'download'])->name('surveys.download');


// Identifikasi Risiko (form edit)
Route::get('/identifikasi-risiko', function () {
    return view('identifikasi.editRisiko'); // sesuaikan dengan nama file baru
})->name('identifikasi.risiko');

// Tampilkan form
Route::get('/identifikasi-risiko', function () {
    return view('identifikasi.identifikasiRisiko');
})->name('identifikasi.risiko');

// Simpan data form
Route::post('/identifikasi-risiko', [App\Http\Controllers\IdentifikasiRisikoController::class, 'store'])
    ->name('identifikasi.risiko.store');

// Tampilkan daftar identifikasi risiko
Route::get('/identifikasi-risiko', [IdentifikasiRisikoController::class, 'index'])
    ->name('identifikasi.risiko.index');

// Halaman form tambah/edit risiko
Route::get('/identifikasi-risiko/create', [IdentifikasiRisikoController::class, 'create'])
    ->name('identifikasi.risiko.create');

// Route edit & update
Route::get('/identifikasi-risiko/{id}/edit', [IdentifikasiRisikoController::class, 'edit'])->name('identifikasi.risiko.edit');
Route::put('/identifikasi-risiko/{id}', [IdentifikasiRisikoController::class, 'update'])->name('identifikasi.risiko.update');

Route::delete('/identifikasi-risiko/{id}', [IdentifikasiRisikoController::class, 'destroy'])->name('identifikasi.risiko.destroy');

Route::get('/identifikasi/evaluasi-mr', [IdentifikasiRisikoController::class, 'evaluasiMr'])
    ->name('identifikasi.risiko.evaluasiMr');

Route::prefix('evaluasiMr')->name('evaluasiMr.')->group(function () {
    Route::get('/', [IdentifikasiRisikoController::class, 'evaluasiMr'])->name('index');
    Route::get('/create', [IdentifikasiRisikoController::class, 'createEvaluasiMr'])->name('create');
    Route::post('/store', [IdentifikasiRisikoController::class, 'storeEvaluasiMr'])->name('store');
    Route::get('/edit/{id}', [IdentifikasiRisikoController::class, 'editEvaluasiMr'])->name('edit');
    Route::put('/update/{id}', [IdentifikasiRisikoController::class, 'updateEvaluasiMr'])->name('update');
    Route::delete('/delete/{id}', [IdentifikasiRisikoController::class, 'destroyEvaluasiMr'])->name('destroy');
});


// Halaman utama daftar dokumen
Route::get('/penguatan-pengawasan', [PenguatanPengawasanController::class, 'index'])
    ->name('penguatanPengawasan.index');

// Halaman tambah dokumen
Route::get('/penguatan-pengawasan/create', [PenguatanPengawasanController::class, 'create'])
    ->name('penguatanPengawasan.create');

// Simpan dokumen baru
Route::post('/penguatan-pengawasan', [PenguatanPengawasanController::class, 'store'])
    ->name('penguatanPengawasan.store');

// Halaman detail dokumen
Route::get('/penguatan-pengawasan/{id}', [PenguatanPengawasanController::class, 'show'])
    ->name('penguatanPengawasan.show');

// Halaman edit dokumen
Route::get('/penguatan-pengawasan/{id}/edit', [PenguatanPengawasanController::class, 'edit'])
    ->name('penguatanPengawasan.edit');

// Update dokumen
Route::put('/penguatan-pengawasan/{id}', [PenguatanPengawasanController::class, 'update'])
    ->name('penguatanPengawasan.update');

// Hapus dokumen
Route::delete('/penguatan-pengawasan/{id}', [PenguatanPengawasanController::class, 'destroy'])
    ->name('penguatanPengawasan.destroy');

// Optional: Lihat lebih (misal untuk AJAX / popup daftar ringkas)
Route::get('/PenguatanPengawasan/lihat', [PenguatanPengawasanController::class, 'lihat'])
    ->name('penguatanPengawasan.lihat');





// Halaman index utama
Route::get('/PeningkatanKualitas', [PeningkatanKualitasController::class, 'index'])
    ->name('peningkatanKualitas.index');

// Halaman lihat lebih / daftar lengkap
Route::get('/PeningkatanKualitas/lihat', [PeningkatanKualitasController::class, 'lihat'])
    ->name('peningkatanKualitas.lihat');

// Halaman detail dokumen
Route::get('/PeningkatanKualitas/show/{id}', [PeningkatanKualitasController::class, 'show'])
    ->name('peningkatanKualitas.show');

// Simpan dokumen baru
Route::post('/PeningkatanKualitas/store', [PeningkatanKualitasController::class, 'store'])
    ->name('peningkatanKualitas.store');

// Halaman edit dokumen
Route::get('/PeningkatanKualitas/edit/{id}', [PeningkatanKualitasController::class, 'edit'])
    ->name('peningkatanKualitas.edit');

// Update dokumen
Route::put('/PeningkatanKualitas/update/{id}', [PeningkatanKualitasController::class, 'update'])
    ->name('peningkatanKualitas.update');

// Hapus dokumen
Route::delete('/PeningkatanKualitas/destroy/{id}', [PeningkatanKualitasController::class, 'destroy'])
    ->name('peningkatanKualitas.destroy');

// Optional: show JSON (misal AJAX)
Route::get('/PeningkatanKualitas/json/{id}', [PeningkatanKualitasController::class, 'showJson'])
    ->name('peningkatanKualitas.showJson');


// Resource route
Route::resource('penguatanAkuntabilitas', PenguatanAkuntabilitasController::class);

// Route tambahan untuk halaman daftar/lihat Penguatan Akuntabilitas
Route::get('/PenguatanAkuntabilitas/lihat', [PenguatanAkuntabilitasController::class, 'lihat'])
    ->name('penguatanAkuntabilitas.lihat');


// Resource utama Pedoman MR
Route::resource('pedomanmr', PedomanMRController::class);

// Route tambahan untuk halaman daftar/lihat Pedoman MR
Route::get('/PedomanMR/lihat', [PedomanMRController::class, 'lihat'])
    ->name('pedomanmr.lihat');

Route::get('/pedomanmr/detail/{id}', [PedomanMRController::class, 'detail'])->name('pedomanmr.detail');


Route::get('/sejarah', function () {
    return view('sejarah');
})->name('sejarah');