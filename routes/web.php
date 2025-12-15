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
use App\Http\Controllers\GuestReportController;
use App\Http\Controllers\ProfileController;
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
use App\Http\Controllers\Admin\TimelineController;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\BagianController;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\BidangPengaduanController;
use App\Http\Controllers\RoleBidangController;
use App\Http\Controllers\UserListController;
use App\Http\Controllers\SPI\KinerjaSPIController;
use App\Http\Controllers\Auth\PasswordResetOtpController;

// Halaman landing
Route::get('/', [LandingPageController::class, 'index'])->name('landingpage');
Route::get('/landing', [LandingPageController::class, 'index'])->name('landing');

// Berita
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/search', [BeritaController::class, 'search'])->name('berita.search');
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.show');

// Group admin middleware
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('timeline', TimelineController::class);
});

Route::get('/spi/sejarah', [TimelineController::class, 'index'])->name('spi.sejarah');
Route::get('/sejarah', function () {
    return redirect()->route('spi.sejarah');
})->name('sejarah');

Route::middleware(['auth'])->prefix('admin/berita')->group(function () {
    Route::get('create', [BeritaController::class, 'create'])->name('admin.berita.create');
    Route::post('store', [BeritaController::class, 'store'])->name('berita.store');
    Route::get('{id}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
    Route::put('{id}', [BeritaController::class, 'update'])->name('berita.update');
});

// Struktur organisasi - halaman publik
Route::get('/struktur-organisasi', [StrukturController::class, 'index'])->name('struktur.index');

// Profil SPI
Route::get('/profile-spi', [App\Http\Controllers\PageController::class, 'ProfileSpi'])->name('profile.spi');

// Pencarian
Route::get('/search/pedoman-pengawasan', function () {
    return view('search.searchPedomanPengawasan');
})->name('search.searchPedomanPengawasan');

Route::get('/search-pedoman', [SearchPedomanController::class, 'index'])->name('search.pedoman');

// Pengaduan - Routes untuk semua user (guest & authenticated)
Route::get('/pengaduan/create', [PengaduanController::class, 'create'])->name('pengaduan.create');
Route::get('/pengaduan/{id}', [PengaduanController::class, 'show'])->name('pengaduan.show');

// Routes untuk authenticated users
Route::middleware(['auth'])->group(function () {
    // Store pengaduan
    Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');

    // Feedback & Edit untuk pelapor
    Route::get('/pengaduan/{id}/feedback', [PengaduanController::class, 'viewFeedback'])->name('pengaduan.feedback');
    Route::get('/pengaduan/{id}/edit', [PengaduanController::class, 'edit'])->name('pengaduan.edit');
    Route::put('/pengaduan/{id}', [PengaduanController::class, 'update'])->name('pengaduan.update');
    Route::delete('/pengaduan/{id}', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');

    // Verifikasi & Tanggapan
    Route::get('/pengaduan/{id}/verify', [PengaduanController::class, 'verify'])->name('pengaduan.verify');
    Route::post('/pengaduan/{id}/verify', [PengaduanController::class, 'processVerification'])->name('pengaduan.processVerification');
    Route::post('/pengaduan/{id}/auto-save-verification', [PengaduanController::class, 'autoSaveVerification'])->name('pengaduan.autoSaveVerification');
    Route::get('/pengaduan/{id}/tanggapan', [PengaduanController::class, 'viewTanggapan'])->name('pengaduan.tanggapan');
    Route::post('/pengaduan/{id}/tanggapan', [PengaduanController::class, 'storeTanggapan'])->name('pengaduan.tanggapan.store');
    Route::post('/pengaduan/{id}/tanggapan-admin', [PengaduanController::class, 'submitTanggapanAdmin'])->name('pengaduan.tanggapanAdmin');
    Route::post('/pengaduan/{id}/tanggapan-pelapor', [PengaduanController::class, 'submitTanggapanPelapor'])->name('pengaduan.tanggapanPelapor');

    // Admin only routes
    Route::middleware([IsAdmin::class])->prefix('admin')->group(function () {
        Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
        Route::patch('/pengaduan/{id}/update-status', [PengaduanController::class, 'updateStatus'])->name('pengaduan.updateStatus');
        Route::post('/pengaduan/{id}/verifikasi', [PengaduanController::class, 'verifikasi'])->name('pengaduan.verifikasi');
    });
});

Route::get('/lapor-guest', [GuestReportController::class, 'createGuest'])->name('pengaduan.createGuest');

// Visi Misi
Route::get('/visi-misi', [VisiMisiController::class, 'index'])->name('visi-misi.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/visi-misi/edit', [VisiMisiController::class, 'edit'])->name('visi-misi.edit');
    Route::post('/admin/visi-misi/update', [VisiMisiController::class, 'update'])->name('visi-misi.update');
});

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

    // Pengurus
    Route::get('/pengurus', [PengurusController::class, 'index'])->name('pengurus.index');
    Route::get('/pengurus/create', [PengurusController::class, 'create'])->name('pengurus.create');
    Route::post('/pengurus/store', [PengurusController::class, 'store'])->name('pengurus.store');
    Route::get('/pengurus/{id}/edit', [PengurusController::class, 'edit'])->name('pengurus.edit');
    Route::post('/pengurus/{id}/update', [PengurusController::class, 'update'])->name('pengurus.update');
    Route::delete('/pengurus/{id}', [PengurusController::class, 'destroy'])->name('pengurus.destroy');

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/pendaftar/check', [ProfileController::class, 'checkPendaftar'])->name('pendaftar.check');
    Route::post('/pendaftar/verify', [ProfileController::class, 'verifyPendaftar'])->name('pendaftar.verify');
});

// Sumber daya manusia
Route::get('/sumber-daya-manusia', [SdmController::class, 'index'])->name('sdm.index');
Route::get('/sumber-daya-manusia/create', [SdmController::class, 'create'])->name('sdm.create');
Route::post('/sumber-daya-manusia/store', [SdmController::class, 'store'])->name('sdm.store');
Route::get('/sumber-daya-manusia/{id}/edit', [SdmController::class, 'edit'])->name('sdm.edit');
Route::post('/sumber-daya-manusia/{id}/update', [SdmController::class, 'update'])->name('sdm.update');
Route::delete('/sumber-daya-manusia/{id}', [SdmController::class, 'destroy'])->name('sdm.destroy');

// Route ke halaman Kode Etik SPI
Route::get('/kode-etik-spi', [KodeEtikSPIController::class, 'index'])->name('kode-etik-spi');

// Route Ke halaman Konsideran SPI
Route::get('/konsideran-spi', [KonsideranSPIController::class, 'index'])->name('konsideran-spi');

// Route Ke halaman pedoman mr 
Route::get('/pedoman/mr', [PedomanMRController::class, 'index'])->name('pedoman.mr');

// Route Ke halaman PenguatanPengawasan
Route::get('/penguatan-pengawasan', [PenguatanPengawasanController::class, 'index'])->name('pengawasan.index');

// Route Ke halaman SURVEY
Route::middleware('auth')->group(function () {
    Route::post('/survey', [SurveyController::class, 'store'])->name('survey.store');
});

Route::delete('/surveys/{survey}', [SurveyController::class, 'destroy'])->name('surveys.destroy');
Route::get('/survey', [SurveyController::class, 'index'])->name('survey.index');

// route ke halaman program kerja SPI
Route::get('/program-kerja', [ProgramKerjaController::class, 'index'])->name('program.kerja');

// route ke halaman penataan sdm aparatur
Route::get('/penataan-sdm-aparatur', [SDMAparaturController::class, 'index'])->name('penataan.sdm.aparatur');

// route ke halaman penguatan akuntabilitas
Route::get('/penguatan-akuntabilitas', [AkuntabilitasController::class, 'index'])->name('penguatan.akuntabilitas');

// Halaman utama Pedoman Pengawasan
Route::get('/pedoman-pengawasan', [PedomanPengawasanController::class, 'index'])->name('pedoman.pengawasan');

// Halaman detail pedoman
Route::get('/pedoman/{id}', [PedomanPengawasanController::class, 'show'])->name('pedoman.show');
Route::get('/pedoman/detail/{id}', [PedomanPengawasanController::class, 'getDetail'])->name('pedoman.detail');

// route ke halaman tambah pedoman
Route::post('/pedoman', [TambahPedomanController::class, 'store'])->name('pedoman.store');

// Route untuk Detail Pengawasan
Route::get('/detail-pengawasan', [DetailPengawasanController::class, 'index'])->name('detail.pengawasan');

Route::delete('/pedoman/{id}', [PedomanPengawasanController::class, 'destroy'])->name('pedoman.destroy');
Route::delete('/pedoman/destroy-all', [PedomanPengawasanController::class, 'destroyAll'])->name('pedoman.destroyAll')->middleware('auth');

Route::get('/pedoman/{id}/edit', [PedomanPengawasanController::class, 'edit'])->name('pedoman.edit');
Route::put('/pedoman/{id}', [PedomanPengawasanController::class, 'update'])->name('pedoman.update');

// API detail lengkap (JSON)
Route::get('/pedoman-pengawasan/{id}/detail', [PedomanPengawasanController::class, 'getDetail'])->name('pedoman.detail.json');

// API detail ringkas (JSON)
Route::get('/pedoman-pengawasan/{id}/json', [PedomanPengawasanController::class, 'detailJson'])->name('pedoman.json');

// Halaman detail pedoman audit (lihat lebih / list audit)
Route::get('/pedoman-audit', [DetailPengawasanController::class, 'index'])->name('pedoman.audit');

// Search pedoman
Route::get('/pedoman/search', [PedomanPengawasanController::class, 'search'])->name('pedoman.search');

// Untuk AJAX detail
Route::get('/pos-ap/detail/{id}', [PosApPengawasanController::class, 'detailJson']);

// Route untuk AJAX detail PosAp
Route::get('/posap/detail/{id}', [PosApPengawasanController::class, 'getDetail'])->name('posap.detail');
Route::get('/posap/audit', [PosApPengawasanController::class, 'showByJenis'])->name('posap.audit');
Route::get('/posAp/{id}/edit', [PosApPengawasanController::class, 'edit'])->name('posAp.edit');
Route::delete('/posAp/{id}', [PosApPengawasanController::class, 'destroy'])->name('posAp.destroy');
Route::put('/posAp/{id}', [PosApPengawasanController::class, 'update'])->name('posAp.update');

// Piagam SPI
Route::post('/upload-piagam', [PiagamSPIController::class, 'store'])->name('piagam.store');
Route::get('/piagam', [PiagamSPIController::class, 'index'])->name('piagam.index');
Route::get('/piagam/{id}', [PiagamSPIController::class, 'show'])->name('piagam.show');
Route::get('/piagam-spi', [PiagamSPIController::class, 'index'])->name('piagam-spi');

// PosAp
Route::prefix('posap')->name('posap.')->group(function () {
    Route::get('/', [PosApPengawasanController::class, 'index'])->name('index');
    Route::post('/store', [PosApPengawasanController::class, 'store'])->name('store');
    Route::delete('/{id}', [PosApPengawasanController::class, 'destroy'])->name('destroy');
    Route::get('/{id}/edit', [PosApPengawasanController::class, 'edit'])->name('edit');
    Route::put('/{id}', [PosApPengawasanController::class, 'update'])->name('update');
    Route::get('/show/{id}', [PosApPengawasanController::class, 'show'])->name('show');
    Route::get('/lihat/{jenis}', [PosApPengawasanController::class, 'lihat'])->name('lihat');
});

// Search Pos AP
Route::get('/search/posappengawasan', [PosApPengawasanController::class, 'searchPosApPengawasan'])->name('search.searchPosApPengawasan');
Route::get('/posap/search', [PosApPengawasanController::class, 'search'])->name('posap.search');

// Instrumen
Route::get('/instrumen/lihat/{jenis}', [InstrumenController::class, 'lihat'])->name('instrumen.lihat');
Route::get('/instrumen/search', [InstrumenController::class, 'search'])->name('instrumen.search');
Route::get('/instrumen', [InstrumenController::class, 'index'])->name('instrumen.index');
Route::get('/instrumen/{id}', [InstrumenController::class, 'show'])->name('instrumen.show');
Route::get('/instrumen/detail/{id}', [InstrumenController::class, 'getDetail'])->name('instrumen.getDetail');
Route::post('/instrumen', [InstrumenController::class, 'store'])->name('instrumen.store');
Route::delete('/instrumen/{id}', [InstrumenController::class, 'destroy'])->name('instrumen.destroy');
Route::get('/instrumen/{id}/edit', [InstrumenController::class, 'edit'])->name('instrumen.edit');


// Program Kerja SPI
Route::prefix('spi')->name('programKerja.')->group(function () {
    Route::get('/', [ProgramKerjaSPIController::class, 'index'])->name('index');
    Route::get('/lihat/{jenis?}', [ProgramKerjaSPIController::class, 'lihat'])->name('lihat');
    Route::get('/create', [ProgramKerjaSPIController::class, 'create'])->name('create');
    Route::post('/store', [ProgramKerjaSPIController::class, 'store'])->name('store');
    Route::get('/{id}', [ProgramKerjaSPIController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [ProgramKerjaSPIController::class, 'edit'])->name('edit');
    Route::put('/{id}', [ProgramKerjaSPIController::class, 'update'])->name('update');
    Route::delete('/{id}', [ProgramKerjaSPIController::class, 'destroy'])->name('destroy');
});

Route::get('/program-kerja/search', [ProgramKerjaSPIController::class, 'search'])->name('program-kerja.search');
Route::get('/program-kerja/{id}', [ProgramKerjaSPIController::class, 'show'])->name('program-kerja.show');

// Konsideran SPI
Route::get('/konsideran/{jenis?}', [KonsideranSPIController::class, 'index'])->name('konsideran.index');
Route::get('/konsideran/detail/{id}', [KonsideranSPIController::class, 'show'])->name('konsideran.show');
Route::get('/konsideran/tambah', [KonsideranSPIController::class, 'create'])->name('konsideran.create');
Route::post('/konsideran/store', [KonsideranSPIController::class, 'store'])->name('konsideran.store');
Route::get('/konsideran/edit/{id}', [KonsideranSPIController::class, 'edit'])->name('konsideran.edit');
Route::put('/konsideran/update/{id}', [KonsideranSPIController::class, 'update'])->name('konsideran.update');
Route::delete('/konsideran/destroy/{id}', [KonsideranSPIController::class, 'destroy'])->name('konsideran.destroy');
Route::get('/KonsideranSPI/lihat/', [KonsideranSPIController::class, 'lihat'])->name('konsideran.lihat');
Route::get('/konsideranspi/search', [KonsideranSPIController::class, 'search'])->name('konsideranspi.search');
Route::get('/KonsideranSPI/{id}', [KonsideranSPIController::class, 'show'])->name('konsideranspi.show');

// Piagam SPI (Detail)
Route::get('/piagam', [PiagamSPIController::class, 'index'])->name('piagam.index');
Route::get('/piagam/{id}', [PiagamSPIController::class, 'show'])->name('piagam.show');
Route::get('/piagam/create', [PiagamSPIController::class, 'create'])->middleware('auth')->name('piagam.create');

Route::get('/piagam/{id}/edit', [PiagamSPIController::class, 'edit'])->middleware('auth')->name('piagam.edit');
Route::put('/piagam/{id}', [PiagamSPIController::class, 'update'])->middleware('auth')->name('piagam.update');
Route::delete('/piagam/{id}', [PiagamSPIController::class, 'destroy'])->middleware('auth')->name('piagam.destroy');
Route::get('/PiagamSPI/lihat', [PiagamSPIController::class, 'lihat'])->name('piagam.lihat');
Route::get('/piagam/search', [PiagamSPIController::class, 'search'])->name('piagam.search');
Route::get('/piagamspi/detail/{id}', [PiagamSPIController::class, 'showJson']);
Route::get('/piagamspi/search', [PiagamSPIController::class, 'search'])->name('piagamspi.search');

Route::prefix('piagamspi')->group(function () {
    Route::get('/', [PiagamSPIController::class, 'index'])->name('piagamspi.index');
    Route::get('/{id}', [PiagamSPIController::class, 'show'])->name('piagamspi.show');
});

// Perubahan
Route::resource('perubahan', PerubahanController::class);
Route::get('/Perubahan/lihat', [PerubahanController::class, 'lihat'])->name('perubahan.lihat');
Route::get('/Perubahan/{id}', [PerubahanController::class, 'show'])->name('Perubahan.show');

// Penataan
Route::resource('penataan', PenataanTataKelolaController::class);
Route::get('/Penataan/lihat', [PenataanTataKelolaController::class, 'lihat'])->name('penataan.lihat');
Route::get('/penataan_tata_kelola/{id}', [PenataanTataKelolaController::class, 'show'])->name('penataan_tata_kelola.show');

Route::resource('penataanSistem', PenataanSistemController::class);
Route::get('/PenataanSistem/lihat', [PenataanSistemController::class, 'lihat'])->name('penataanSistem.lihat');
Route::get('/penataan_sistem/{id}', [PenataanSistemController::class, 'show'])->name('penataan_sistem.show');

// SURVEY KEPUASAN
Route::get('/survey-kepuasan', function () {
    return view('SurveyKepuasan.Survey-Kepuasan');
})->name('survey.kepuasan');

Route::post('/survey-kepuasan', [SurveyController::class, 'store'])->name('survey.kepuasan.store');
Route::get('/survey-kepuasan/data', [SurveyController::class, 'showAll'])->name('survey.kepuasan.data');
Route::delete('/survey/{survey}', [SurveyController::class, 'destroy'])->name('survey.destroy');
Route::get('/surveys/download', [SurveyController::class, 'download'])->name('surveys.download');

// Routes Baru untuk Kelola Pertanyaan Custom (hanya admin)
Route::middleware(['auth'])->group(function () {
    Route::get('/survey/questions/manage', [SurveyController::class, 'manageQuestions'])->name('survey.questions.manage');
    Route::post('/survey/questions', [SurveyController::class, 'storeQuestion'])->name('survey.question.store');
    Route::put('/survey/questions/{question}', [SurveyController::class, 'updateQuestion'])->name('survey.question.update');
    Route::delete('/survey/questions/{question}', [SurveyController::class, 'deleteQuestion'])->name('survey.question.delete');
});

// Identifikasi Risiko
Route::get('/identifikasi-risiko', [IdentifikasiRisikoController::class, 'index'])->name('identifikasi.risiko.index');
Route::get('/identifikasi-risiko/create', [IdentifikasiRisikoController::class, 'create'])->name('identifikasi.risiko.create');
Route::post('/identifikasi-risiko', [IdentifikasiRisikoController::class, 'store'])->name('identifikasi.risiko.store');
Route::get('/identifikasi-risiko/{id}/edit', [IdentifikasiRisikoController::class, 'edit'])->name('identifikasi.risiko.edit');
Route::put('/identifikasi-risiko/{id}', [IdentifikasiRisikoController::class, 'update'])->name('identifikasi.risiko.update');
Route::delete('/identifikasi-risiko/{id}', [IdentifikasiRisikoController::class, 'destroy'])->name('identifikasi.risiko.destroy');
Route::get('/identifikasi/evaluasi-mr', [IdentifikasiRisikoController::class, 'evaluasiMr'])->name('identifikasi.risiko.evaluasiMr');

// Evaluasi MR
Route::prefix('evaluasiMr')->name('evaluasiMr.')->group(function () {
    Route::get('/', [IdentifikasiRisikoController::class, 'evaluasiMr'])->name('index');
    Route::get('/create', [IdentifikasiRisikoController::class, 'createEvaluasiMr'])->name('create');
    Route::post('/store', [IdentifikasiRisikoController::class, 'storeEvaluasiMr'])->name('store');
    Route::get('/edit/{id}', [IdentifikasiRisikoController::class, 'editEvaluasiMr'])->name('edit');
    Route::put('/update/{id}', [IdentifikasiRisikoController::class, 'updateEvaluasiMr'])->name('update');
    Route::delete('/delete/{id}', [IdentifikasiRisikoController::class, 'destroyEvaluasiMr'])->name('destroy');
    Route::post('/update-order', [IdentifikasiRisikoController::class, 'updateOrder'])->name('updateOrder')->middleware('auth');
    Route::post('/tambah-bagian', [IdentifikasiRisikoController::class, 'ajaxTambahBagian'])->name('ajaxTambahBagian');
});

// route untuk menyimpan unit via AJAX
Route::post('/unit/store', [IdentifikasiRisikoController::class, 'storeUnit'])->name('unit.store');
Route::post('/bagian/store', [BagianController::class, 'store'])->name('bagian.store');
Route::get('/bagian/list', [BagianController::class, 'list'])->name('bagian.list');
Route::delete('/bagian/{id}', [IdentifikasiRisikoController::class, 'destroy'])->name('bagian.destroy');
Route::put('/bagian/{id}', [IdentifikasiRisikoController::class, 'updateBagian'])->name('bagian.update');

// Penguatan Pengawasan
Route::get('/penguatan-pengawasan', [PenguatanPengawasanController::class, 'index'])->name('penguatanPengawasan.index');
Route::get('/penguatan-pengawasan/create', [PenguatanPengawasanController::class, 'create'])->name('penguatanPengawasan.create');
Route::post('/penguatan-pengawasan', [PenguatanPengawasanController::class, 'store'])->name('penguatanPengawasan.store');
Route::get('/penguatan-pengawasan/{id}', [PenguatanPengawasanController::class, 'show'])->name('penguatanPengawasan.show');
Route::get('/penguatan-pengawasan/{id}/edit', [PenguatanPengawasanController::class, 'edit'])->name('penguatanPengawasan.edit');
Route::put('/penguatan-pengawasan/{id}', [PenguatanPengawasanController::class, 'update'])->name('penguatanPengawasan.update');
Route::delete('/penguatan-pengawasan/{id}', [PenguatanPengawasanController::class, 'destroy'])->name('penguatanPengawasan.destroy');
Route::get('/PenguatanPengawasan/lihat', [PenguatanPengawasanController::class, 'lihat'])->name('penguatanPengawasan.lihat');
Route::get('/penguatan_pengawasan/{id}', [PenguatanPengawasanController::class, 'show'])->name('penguatan_pengawasan.show');

// Peningkatan Kualitas
Route::get('/PeningkatanKualitas', [PeningkatanKualitasController::class, 'index'])->name('peningkatanKualitas.index');
Route::get('/PeningkatanKualitas/lihat', [PeningkatanKualitasController::class, 'lihat'])->name('peningkatanKualitas.lihat');
Route::get('/PeningkatanKualitas/show/{id}', [PeningkatanKualitasController::class, 'show'])->name('peningkatanKualitas.show');
Route::post('/PeningkatanKualitas/store', [PeningkatanKualitasController::class, 'store'])->name('peningkatanKualitas.store');
Route::get('/PeningkatanKualitas/edit/{id}', [PeningkatanKualitasController::class, 'edit'])->name('peningkatanKualitas.edit');
Route::put('/PeningkatanKualitas/update/{id}', [PeningkatanKualitasController::class, 'update'])->name('peningkatanKualitas.update');
Route::delete('/PeningkatanKualitas/destroy/{id}', [PeningkatanKualitasController::class, 'destroy'])->name('peningkatanKualitas.destroy');
Route::get('/PeningkatanKualitas/json/{id}', [PeningkatanKualitasController::class, 'showJson'])->name('peningkatanKualitas.showJson');
Route::get('/peningkatan_kualitas/{id}', [PeningkatanKualitasController::class, 'show'])->name('peningkatan_kualitas.show');

// Penguatan Akuntabilitas
Route::resource('penguatanAkuntabilitas', PenguatanAkuntabilitasController::class);
Route::get('/PenguatanAkuntabilitas/lihat', [PenguatanAkuntabilitasController::class, 'lihat'])->name('penguatanAkuntabilitas.lihat');
Route::get('/penguatan_akuntabilitas/{id}', [PenguatanAkuntabilitasController::class, 'show'])->name('penguatan_akuntabilitas.show');

// Pedoman MR
Route::resource('pedomanmr', PedomanMRController::class);
Route::get('/PedomanMR/lihat', [PedomanMRController::class, 'lihat'])->name('pedomanmr.lihat');
Route::get('/pedomanmr/detail/{id}', [PedomanMRController::class, 'detail'])->name('pedomanmr.detail');
Route::get('/pedomanmr/{id}', [PedomanMRController::class, 'show'])->name('pedomanmr.show');

// Proses Bisnis SPI
Route::get('/processes', [ProcessController::class, 'index'])->name('processes.index');
Route::get('/processes/create', [ProcessController::class, 'create'])->name('processes.create');
Route::post('/processes', [ProcessController::class, 'store'])->name('processes.store');
Route::get('/processes/{process}/edit', [ProcessController::class, 'edit'])->name('processes.edit');
Route::put('/processes/{process}', [ProcessController::class, 'update'])->name('processes.update');
Route::delete('/processes/{process}', [ProcessController::class, 'destroy'])->name('processes.destroy');
Route::get('/proses-bisnis-spi', [ProcessController::class, 'index'])->name('proses-bisnis-spi');

// Resource Routes
Route::resource('berita', BeritaController::class);
Route::resource('sdm', SdmController::class);

// Aspirasi
Route::get('/aspirasi', [AspirasiController::class, 'index'])->name('aspirasi.index');
Route::get('/aspirasi/create', [AspirasiController::class, 'create'])->name('aspirasi.create');
Route::post('/aspirasi', [AspirasiController::class, 'store'])->name('aspirasi.store');
Route::get('/aspirasi/{aspirasi}', [AspirasiController::class, 'show'])->name('aspirasi.show');
Route::delete('/aspirasi/{aspirasi}', [AspirasiController::class, 'destroy'])->name('aspirasi.destroy');

// Routes untuk admin aspirasi
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/aspirasi', [AspirasiController::class, 'adminIndex'])->name('aspirasi.admin');
    Route::get('/admin/aspirasi/{aspirasi}', [AspirasiController::class, 'adminShow'])->name('aspirasi.admin.show');
});

// Bidang Pengaduan
Route::middleware(['auth'])->group(function () {
    Route::get('/bidang-pengaduan', [BidangPengaduanController::class, 'index'])->name('bidang.index');
    Route::post('/bidang-pengaduan', [BidangPengaduanController::class, 'store'])->name('bidang.store');
    Route::put('/bidang-pengaduan/{bidang}', [BidangPengaduanController::class, 'update'])->name('bidang.update');
    Route::delete('/bidang-pengaduan/{bidang}', [BidangPengaduanController::class, 'destroy'])->name('bidang.destroy');
    Route::patch('/bidang-pengaduan/{bidang}/toggle', [BidangPengaduanController::class, 'toggleStatus'])->name('bidang.toggleStatus');
});

// Role Bidang
Route::prefix('admin')->group(function () {
    Route::prefix('role-bidang')->group(function () {
        Route::resource('roleBidang', RoleBidangController::class);
        Route::get('/', [RoleBidangController::class, 'index'])->name('admin.roleBidang.index');
        Route::post('/', [RoleBidangController::class, 'store'])->name('admin.roleBidang.store');
        Route::put('/{id}', [RoleBidangController::class, 'update'])->name('admin.roleBidang.update');
        Route::delete('/{id}', [RoleBidangController::class, 'destroy'])->name('admin.roleBidang.destroy');
        Route::patch('/{id}/toggle', [RoleBidangController::class, 'toggleStatus'])->name('admin.roleBidang.toggleStatus');
    });
});

// Pendaftar Check (tanpa auth)
Route::post('/pendaftar/check', [App\Http\Controllers\PendaftarController::class, 'check'])
    ->name('pendaftar.check')
    ->withoutMiddleware('auth');

Route::middleware(['auth'])->group(function () {
    // ... route lainnya

    Route::get('/profile/add-member', [ProfileController::class, 'showAddMember'])->name('profile.add-member');
    Route::post('/profile/store-member', [ProfileController::class, 'storeMember'])->name('profile.store-member');
});

Route::middleware(['auth'])->group(function () {
    // Route yang sudah ada...

    // Route untuk daftar pengguna
    Route::get('/users', [UserListController::class, 'index'])->name('users.index');
    Route::get('/users/{id}/edit', [UserListController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserListController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserListController::class, 'destroy'])->name('users.destroy');
});

Route::middleware('guest')->group(function () {
    // Request OTP
    Route::get('/password/request-otp', [PasswordResetOtpController::class, 'showRequestForm'])
        ->name('password.request-otp');
    Route::post('/password/send-otp', [PasswordResetOtpController::class, 'sendOtp'])
        ->name('password.send-otp');
    
    // Verify OTP
    Route::get('/password/verify-otp', [PasswordResetOtpController::class, 'showVerifyForm'])
        ->name('password.verify-otp-form');
    Route::post('/password/verify-otp', [PasswordResetOtpController::class, 'verifyOtp'])
        ->name('password.verify-otp');
    
    // Reset Password
    Route::get('/password/reset-password', [PasswordResetOtpController::class, 'showResetForm'])
        ->name('password.reset-form');
    Route::post('/password/reset', [PasswordResetOtpController::class, 'resetPassword'])
        ->name('password.reset');
    
    // Resend OTP
    Route::post('/password/resend-otp', [PasswordResetOtpController::class, 'resendOtp'])
        ->name('password.resend-otp');
});

// Kinerja SPI Routes
Route::post('/kinerja-spi/store', [KinerjaSPIController::class, 'store'])->name('kinerjaSPI.store');
Route::get('/kinerja-spi/{id}', [KinerjaSPIController::class, 'show'])->name('kinerjaSPI.show');
Route::get('/kinerja-spi/{id}/detail', [KinerjaSPIController::class, 'getDetail'])->name('kinerjaSPI.detail');
Route::get('/kinerja-spi/{id}/edit', [KinerjaSPIController::class, 'edit'])->name('kinerjaSPI.edit');
Route::put('/kinerja-spi/{id}', [KinerjaSPIController::class, 'update'])->name('kinerjaSPI.update');
Route::delete('/kinerja-spi/{id}', [KinerjaSPIController::class, 'destroy'])->name('kinerjaSPI.destroy');
Route::get('/kinerja-spi-lihat', [KinerjaSPIController::class, 'lihat'])->name('kinerjaSPI.lihat');
Route::get('/kinerja-spi/search', [KinerjaSPIController::class, 'search'])->name('kinerjaSPI.search');