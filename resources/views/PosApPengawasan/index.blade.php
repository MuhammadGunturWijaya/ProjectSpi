<!DOCTYPE html>
<html lang="id">
<style>
    body {
                   overflow-x: hidden;
        }
</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Peraturan JDIH BPK</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/pedomanPengawasan.css') }}">
    <style>
    </style>
</head>

<body>
    @include('layouts.navbar')

    <header>
        <div class="header-text-container">
            <h1>{{ $title }}</h1>
        </div>
    </header>


    <div class="search-wrapper">
        <form action="{{ route('search.searchPedomanPengawasan') }}" method="GET" class="search-form"
            style="display: contents;">
            <div class="input-group">
                <i class="fa fa-search"></i>
                <input type="text" name="keyword" placeholder="Cari peraturan ..." value="{{ $keyword ?? '' }}">
            </div>
            <button type="submit" class="search-btn"><i class="fa fa-search"></i> Cari</button>
            <button type="button" class="adv-btn"><i class="fa fa-sliders-h"></i> Adv. Search</button>
        </form>
    </div>

    <div id="advModal" class="modal">
        <div class="modal-box">
            <span class="close">&times;</span>
            <h2 class="modal-title"><i class="fa fa-sliders-h"></i> Advanced Search</h2>
            <form class="adv-form" action="{{ route('search.searchPedomanPengawasan') }}" method="GET">
                <div class="form-group">
                    <label for="tentang">Tentang</label>
                    <input type="text" name="judul" id="tentang" placeholder="Masukkan kata kunci ..."
                        value="{{ request('judul') }}">
                </div>

                <div class="form-group">
                    <label for="nomor">Nomor</label>
                    <input type="text" name="nomor" id="nomor" placeholder="Contoh: 12" value="{{ request('nomor') }}">
                </div>

                <div class="form-group">
                    <label for="tahun">Tahun</label>
                    <input type="number" name="tahun" id="tahun" placeholder="2023" value="{{ request('tahun') }}">
                </div>

                <div class="form-group">
                    <label for="jenis">Jenis</label>
                    <input type="text" name="jenis" id="jenis" placeholder="Peraturan / UU / PP ..."
                        value="{{ request('jenis') }}">
                </div>

                <div class="form-group">
                    <label for="entitas">Entitas</label>
                    <input type="text" name="entitas" id="entitas" placeholder="Nama instansi ..."
                        value="{{ request('entitas') }}">
                </div>

                <div class="form-group">
                    <label for="tag">Tag</label>
                    <input type="text" name="kata_kunci" id="tag" placeholder="Pisahkan dengan koma"
                        value="{{ request('kata_kunci') }}">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <i class="fa fa-search"></i> Cari
                    </button>
                </div>
            </form>
        </div>
    </div>


    <script>
        const advBtn = document.querySelector('.adv-btn');
        const modal = document.getElementById('advModal');
        const closeBtn = document.querySelector('.close');
        const cancelBtn = document.getElementById('cancelBtn');

        advBtn.addEventListener('click', () => {
            modal.style.display = 'block';
        });

        closeBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        cancelBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
    </script>

    <section class="popular">
        <h2>Peraturan Terpopuler 2 Minggu Terakhir</h2>
        <div class="carousel-wrapper">
            <button id="carousel-prev" class="carousel-btn prev-btn"><i class="fas fa-chevron-left"></i></button>
            <div class="carousel-track-container">
                <div class="carousel-track">
                    <div class="card-item-new">
                        <div class="card-icon-new">
                            <i class="fas fa-gavel"></i>
                        </div>
                        <div class="card-content-new">
                            <span class="card-title-new">UU No. 1 Tahun 2023</span>
                            <small class="card-subtitle-new">Kitab Undang-Undang Hukum Pidana</small>
                            <span class="card-type-new">📜 Undang-Undang</span>
                        </div>
                    </div>
                    <div class="card-item-new">
                        <div class="card-icon-new">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <div class="card-content-new">
                            <span class="card-title-new">UU No. 11 Tahun 2020</span>
                            <small class="card-subtitle-new">Cipta Kerja</small>
                            <span class="card-type-new">📜 Undang-Undang</span>
                        </div>
                    </div>
                    <div class="card-item-new">
                        <div class="card-icon-new">
                            <i class="fas fa-gavel"></i>
                        </div>
                        <div class="card-content-new">
                            <span class="card-title-new">UU No. 1 Tahun 2023</span>
                            <small class="card-subtitle-new">Kitab Undang-Undang Hukum Pidana</small>
                            <span class="card-type-new">📜 Undang-Undang</span>
                        </div>
                    </div>
                    <div class="card-item-new">
                        <div class="card-icon-new">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <div class="card-content-new">
                            <span class="card-title-new">UU No. 11 Tahun 2020</span>
                            <small class="card-subtitle-new">Cipta Kerja</small>
                            <span class="card-type-new">📜 Undang-Undang</span>
                        </div>
                    </div>
                    <div class="card-item-new">
                        <div class="card-icon-new">
                            <i class="fas fa-gavel"></i>
                        </div>
                        <div class="card-content-new">
                            <span class="card-title-new">UU No. 1 Tahun 2023</span>
                            <small class="card-subtitle-new">Kitab Undang-Undang Hukum Pidana</small>
                            <span class="card-type-new">📜 Undang-Undang</span>
                        </div>
                    </div>
                    <div class="card-item-new">
                        <div class="card-icon-new">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <div class="card-content-new">
                            <span class="card-title-new">UUU No. 11 Tahun 2020</span>
                            <small class="card-subtitle-new">Cipta Kerja</small>
                            <span class="card-type-new">📜 Undang-Undang</span>
                        </div>
                    </div>

                </div>
            </div>
            <button id="carousel-next" class="carousel-btn next-btn"><i class="fas fa-chevron-right"></i></button>
        </div>
    </section>

    <script>
        const carouselTrack = document.querySelector('.carousel-track');
        const prevBtn = document.getElementById('carousel-prev');
        const nextBtn = document.getElementById('carousel-next');

        // Mengambil semua elemen kartu
        const cardItems = document.querySelectorAll('.card-item-new');

        // Menghitung lebar total satu kartu, termasuk gap
        const cardWidth = cardItems[0].offsetWidth + 25;

        // Indeks untuk melacak posisi
        let currentIndex = 0;
        let autoScroll;

        // Duplikasi kartu untuk menciptakan efek loop
        cardItems.forEach(card => {
            const clone = card.cloneNode(true);
            carouselTrack.appendChild(clone);
        });

        function updateCarousel() {
            carouselTrack.style.transform = `translateX(${-currentIndex * cardWidth}px)`;
        }

        function nextSlide() {
            currentIndex++;
            if (currentIndex >= cardItems.length) {
                // Jika sudah mencapai akhir, segera kembali ke awal tanpa transisi
                carouselTrack.style.transition = 'none';
                currentIndex = 0;
                updateCarousel();

                // Atur timeout untuk mengaktifkan kembali transisi dan geser ke slide pertama
                setTimeout(() => {
                    carouselTrack.style.transition = 'transform 0.5s ease';
                    currentIndex = 1;
                    updateCarousel();
                }, 10);

            } else {
                updateCarousel();
            }
        }

        function prevSlide() {
            if (currentIndex === 0) {
                // Jika di awal, geser ke akhir duplikat tanpa transisi
                carouselTrack.style.transition = 'none';
                currentIndex = cardItems.length;
                updateCarousel();

                // Atur timeout untuk mengaktifkan kembali transisi dan geser mundur
                setTimeout(() => {
                    carouselTrack.style.transition = 'transform 0.5s ease';
                    currentIndex--;
                    updateCarousel();
                }, 10);
            } else {
                currentIndex--;
                updateCarousel();
            }
        }

        // Tombol navigasi
        nextBtn.addEventListener('click', () => {
            nextSlide();
            resetAuto();
        });

        prevBtn.addEventListener('click', () => {
            prevSlide();
            resetAuto();
        });

        // Auto scroll
        function startAuto() {
            autoScroll = setInterval(nextSlide, 3000); // 3 detik
        }

        function resetAuto() {
            clearInterval(autoScroll);
            startAuto();
        }

        // Mulai otomatis saat halaman dimuat
        startAuto();
    </script>


    <div class="pedoman-buttons-wrapper">
        <h2>Pilih Pedoman</h2>
        <div class="pedoman-buttons">
            <a href="#posap-audit" class="pedoman-btn">
                <i class="fa fa-file-invoice-dollar"></i> Lihat POS AP Audit
            </a>
            <a href="#posap-reviu" class="pedoman-btn">
                <i class="fa fa-search-plus"></i> Lihat POS AP Reviu
            </a>
            <a href="#posap-monev" class="pedoman-btn">
                <i class="fa fa-tasks"></i> Lihat POS AP Monev
            </a>
        </div>
    </div>

    <!-- Pos Ap Audit -->
    <section class="classification" id="posap-audit">
        <div class="classification-header">
            <h2>POS AP <span class="audit-text">Audit</span></h2>
            <div class="header-actions">
                <a href="{{ route('posAp.lihat', 'audit') }}">
                    <i class="fa fa-chart-bar"></i> Lihat Lebih
                </a>
                @if(Auth::check() && Auth::user()->role === 'admin')
                    <a href="#" id="btnTambahPosApAudit">
                        <i class="fa fa-plus"></i> Tambah POS AP
                    </a>
                @endif
            </div>
        </div>

        <div class="grid">
            @forelse($PosApAudit as $PosAp)
                <div class="card">
                    <div class="card-icon-wrapper">
                        <i class="fa fa-file-alt"></i>
                    </div>
                    <div class="card-content">
                        <h3>{{ $PosAp->judul }}</h3>
                        <p>Tahun: {{ $PosAp->tahun ?? '-' }}</p>
                    </div>
                    <a href="{{ route('posAp.show', $PosAp->id) }}" class="card-link">
                        Lihat Dokumen →
                    </a>
                </div>
            @empty
                <p>Tidak ada POS AP Audit.</p>
            @endforelse
        </div>
    </section>

    <!-- Pos Ap Reviu -->
    <section class="classification" id="posap-reviu">
        <div class="classification-header">
            <h2>POS AP <span class="audit-text">Reviu</span></h2>
            <div class="header-actions">
                <a href="{{ route('posAp.lihat', 'reviu') }}">
                    <i class="fa fa-chart-bar"></i> Lihat Lebih
                </a>
                @if(Auth::check() && Auth::user()->role === 'admin')
                    <a href="#" id="btnTambahPosApAudit">
                        <i class="fa fa-plus"></i> Tambah POS AP
                    </a>
                @endif
            </div>
        </div>

        <div class="grid">
            @forelse($PosApReviu as $PosAp)
                <div class="card">
                    <div class="card-icon-wrapper">
                        <i class="fa fa-file-alt"></i>
                    </div>
                    <div class="card-content">
                        <h3>{{ $PosAp->judul }}</h3>
                        <p>Tahun: {{ $PosAp->tahun ?? '-' }}</p>
                    </div>
                    <a href="{{ route('posAp.show', $PosAp->id) }}" class="card-link">
                        Lihat Dokumen →
                    </a>
                </div>
            @empty
                <p>Tidak ada POS AP Audit.</p>
            @endforelse
        </div>
    </section>

    <!-- Pos Ap monev -->
    <section class="classification" id="posap-monev">
        <div class="classification-header">
            <h2>POS AP <span class="audit-text">Monev</span></h2>
            <div class="header-actions">
                <a href="{{ route('posAp.lihat', 'monev') }}">
                    <i class="fa fa-chart-bar"></i> Lihat Lebih
                </a>
                @if(Auth::check() && Auth::user()->role === 'admin')
                    <a href="#" id="btnTambahPosApAudit">
                        <i class="fa fa-plus"></i> Tambah POS AP
                    </a>
                @endif
            </div>
        </div>

        <div class="grid">
            @forelse($PosApMonev as $PosAp)
                <div class="card">
                    <div class="card-icon-wrapper">
                        <i class="fa fa-file-alt"></i>
                    </div>
                    <div class="card-content">
                        <h3>{{ $PosAp->judul }}</h3>
                        <p>Tahun: {{ $PosAp->tahun ?? '-' }}</p>
                    </div>
                    <a href="{{ route('posAp.show', $PosAp->id) }}" class="card-link">
                        Lihat Dokumen →
                    </a>
                </div>
            @empty
                <p>Tidak ada POS AP Audit.</p>
            @endforelse
        </div>
    </section>

    <!-- Modal Tambah POS AP -->
    <div id="modalTambahPosAp" class="modal">
        <div class="modal-box">
            <button class="close" id="closeModalTambah" aria-label="Close modal">&times;</button>
            <h2 class="modal-title">Tambah Dokumen POS AP</h2>

            {{-- Pesan error umum (misal gagal simpan) --}}
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Pesan validasi dari Laravel --}}
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul style="margin:0; padding-left:20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="stepper-nav" role="tablist" aria-label="Form Steps">
                <button class="step-nav-item active" data-step="1" role="tab" aria-selected="true"
                    aria-controls="step1-content" id="step1">
                    <span class="step-number">1</span> Materi Pokok
                </button>
                <button class="step-nav-item" data-step="2" role="tab" aria-selected="false"
                    aria-controls="step2-content" id="step2">
                    <span class="step-number">2</span> Metadata
                </button>
                <button class="step-nav-item" data-step="3" role="tab" aria-selected="false"
                    aria-controls="step3-content" id="step3">
                    <span class="step-number">3</span> Berkas & Status
                </button>
            </div>

            <form id="formTambahPosAp" action="{{ route('posAp.store') }}" method="POST" enctype="multipart/form-data"
                novalidate>
                @csrf

                <section class="step-content active" data-step="1" id="step1-content">
                    <div class="form-section-header">
                        <h4>Materi Pokok Dokumen</h4>
                    </div>
                    <div class="form-group">
                        <label>Pilih Jenis POS AP <span class="required">*</span></label>
                        <div class="button-group">
                            <button type="button" class="btn btn-outline" data-jenis="audit">POS AP Audit</button>
                            <button type="button" class="btn btn-outline" data-jenis="reviu">POS AP Reviu</button>
                            <button type="button" class="btn btn-outline" data-jenis="monev">POS AP Monev</button>
                        </div>
                        <input type="hidden" name="jenis" id="jenisPosAp" required>
                    </div>

                    <div class="form-group">
                        <label for="judul">Judul <span class="required">*</span></label>
                        <input type="text" id="judul" name="judul" required placeholder="Masukkan judul peraturan">
                    </div>
                    <div class="form-group">
                        <label for="tahun">Tahun <span class="required">*</span></label>
                        <select id="tahun" name="tahun" required>
                            <option value="">Pilih Tahun</option>
                            @for ($y = date('Y'); $y >= 1900; $y--)
                                <option value="{{ $y }}">{{ $y }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kata_kunci">Kata Kunci</label>
                        <input type="text" id="kata_kunci" name="kata_kunci"
                            placeholder="Pisahkan dengan koma, contoh: pajak, bea cukai">
                    </div>
                    <div class="form-group">
                        <label for="abstrak">Abstrak</label>
                        <textarea id="abstrak" name="abstrak" rows="4"
                            placeholder="Tuliskan ringkasan isi peraturan"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="catatan">Catatan</label>
                        <textarea id="catatan" name="catatan" rows="2"
                            placeholder="Catatan atau informasi tambahan"></textarea>
                    </div>
                </section>

                <section class="step-content" data-step="2" id="step2-content" role="tabpanel" aria-labelledby="step2">
                    <div class="form-section-header">
                        <h4>Metadata Dokumen</h4>
                        <p class="section-desc">Detail teknis dokumen seperti nomor, tanggal, dan sumber.</p>
                    </div>
                    <div class="grid-2">
                        <div class="form-group">
                            <label for="tipe_dokumen">Tipe Dokumen</label>
                            <input type="text" id="tipe_dokumen" name="tipe_dokumen"
                                placeholder="Contoh: Peraturan Pemerintah">
                        </div>
                        <div class="form-group">
                            <label for="judul_meta">Judul Metadata</label>
                            <input type="text" id="judul_meta" name="judul_meta" placeholder="Judul metadata">
                        </div>
                        <div class="form-group">
                            <label for="teu">T.E.U.</label>
                            <input type="text" id="teu" name="teu" placeholder="Tanda Efektif Umum">
                        </div>
                        <div class="form-group">
                            <label for="nomor">Nomor</label>
                            <input type="text" id="nomor" name="nomor" placeholder="Nomor peraturan">
                        </div>
                        <div class="form-group">
                            <label for="bentuk">Bentuk</label>
                            <input type="text" id="bentuk" name="bentuk" placeholder="Bentuk peraturan">
                        </div>
                        <div class="form-group">
                            <label for="bentuk_singkat">Bentuk Singkat</label>
                            <input type="text" id="bentuk_singkat" name="bentuk_singkat" placeholder="Singkatan bentuk">
                        </div>
                        <div class="form-group">
                            <label for="tahun_meta">Tahun Metadata</label>
                            <select id="tahun_meta" name="tahun_meta">
                                <option value="">Pilih Tahun</option>
                                @for ($y = date('Y'); $y >= 1900; $y--)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tempat_penetapan">Tempat Penetapan</label>
                            <input type="text" id="tempat_penetapan" name="tempat_penetapan"
                                placeholder="Lokasi penetapan">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_penetapan">Tanggal Penetapan</label>
                            <input type="date" id="tanggal_penetapan" name="tanggal_penetapan">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_pengundangan">Tanggal Pengundangan</label>
                            <input type="date" id="tanggal_pengundangan" name="tanggal_pengundangan">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_berlaku">Tanggal Berlaku</label>
                            <input type="date" id="tanggal_berlaku" name="tanggal_berlaku">
                        </div>
                        <div class="form-group">
                            <label for="sumber">Sumber</label>
                            <input type="text" id="sumber" name="sumber" placeholder="Sumber peraturan">
                        </div>
                        <div class="form-group">
                            <label for="subjek">Subjek</label>
                            <input type="text" id="subjek" name="subjek" placeholder="Subjek terkait">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <input type="text" id="status" name="status" placeholder="Status peraturan">
                        </div>
                        <div class="form-group">
                            <label for="bahasa">Bahasa</label>
                            <input type="text" id="bahasa" name="bahasa" placeholder="Bahasa dokumen">
                        </div>
                        <div class="form-group">
                            <label for="lokasi">Lokasi</label>
                            <input type="text" id="lokasi" name="lokasi" placeholder="Lokasi penyimpanan">
                        </div>
                        <div class="form-group">
                            <label for="bidang">Bidang</label>
                            <input type="text" id="bidang" name="bidang" placeholder="Bidang terkait">
                        </div>
                    </div>
                </section>

                <section class="step-content" data-step="3" id="step3-content" role="tabpanel" aria-labelledby="step3">
                    <div class="form-section-header">
                        <h4>Berkas Dokumen & Status</h4>
                        <p class="section-desc">Unggah file dokumen dan isi informasi status.</p>
                    </div>
                    <div class="form-group file-upload-group">
                        <label for="file_pdf" class="file-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon-upload">
                                <path
                                    d="M4 14.899V20a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-5.101M16 16l-4-4-4 4M12 12.5V2.5" />
                            </svg>
                            Pilih Berkas PDF
                        </label>
                        <input type="file" id="file_pdf" name="file_pdf" accept="application/pdf"
                            aria-describedby="fileHelp" />
                        <span id="file-name" class="file-name-display">Belum ada file yang dipilih.</span>
                        <small id="fileHelp" class="file-help">Format: PDF, maksimal 10MB.</small>
                    </div>

                    <div class="form-group">
                        <label for="mencabut">Mencabut</label>
                        <input type="text" id="mencabut" name="mencabut" placeholder="Tuliskan peraturan yang dicabut">
                    </div>
                </section>

                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" id="prevStep"
                        aria-label="Kembali ke langkah sebelumnya" style="display:none;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon-arrow">
                            <line x1="19" y1="12" x2="5" y2="12"></line>
                            <polyline points="12 19 5 12 12 5"></polyline>
                        </svg>
                        Kembali
                    </button>
                    <button type="button" class="btn btn-primary" id="nextStep"
                        aria-label="Lanjut ke langkah berikutnya">
                        Lanjut
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon-arrow">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </button>
                    <button type="submit" class="btn btn-submit" id="submitBtn" style="display:none"
                        aria-label="Simpan data">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon-save">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 3 7 8 15 8"></polyline>
                        </svg>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const modalTambah = document.getElementById("modalTambahPosAp");
            const btnOpenModal = document.querySelectorAll("#btnTambahPosApAudit, #btnTambahPosApReviu, #btnTambahPosApMonev");
            const btnCloseModal = document.getElementById("closeModalTambah");

            const steps = document.querySelectorAll(".step-nav-item");
            const contents = document.querySelectorAll(".step-content");
            const nextBtn = document.getElementById("nextStep");
            const prevBtn = document.getElementById("prevStep");
            const submitBtn = document.getElementById("submitBtn");
            let currentStep = 0;

            // --- Button Jenis Pedoman ---
            const jenisButtons = document.querySelectorAll('.button-group .btn-outline');
            const jenisInput = document.getElementById('jenisPosAp');

            jenisButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    // Hapus active dari semua tombol
                    jenisButtons.forEach(b => b.classList.remove('active'));
                    // Aktifkan tombol yang diklik
                    btn.classList.add('active');
                    // Set value hidden input
                    jenisInput.value = btn.getAttribute('data-jenis');
                });
            });

            // Function to show/hide steps and buttons
            function showStep(index) {
                contents.forEach((c, i) => c.classList.toggle("active", i === index));
                steps.forEach((s, i) => s.classList.toggle("active", i === index));

                prevBtn.style.display = index === 0 ? "none" : "inline-flex";
                nextBtn.style.display = index === contents.length - 1 ? "none" : "inline-flex";
                submitBtn.style.display = index === contents.length - 1 ? "inline-flex" : "none";
            }

            // Function to validate the current step
            function validateStep(index) {
                const currentContent = contents[index];
                const requiredInputs = currentContent.querySelectorAll("[required]");
                let isValid = true;

                requiredInputs.forEach(input => {
                    if (!input.value) {
                        input.classList.add("is-invalid");
                        isValid = false;
                    } else {
                        input.classList.remove("is-invalid");
                    }
                });

                if (!isValid) {
                    alert("Harap lengkapi semua bidang yang wajib diisi (*).");
                }
                return isValid;
            }

            // --- Event Listeners for Modal Control ---
            btnOpenModal.forEach(btn => {
                btn.addEventListener("click", function (e) {
                    e.preventDefault();
                    modalTambah.style.display = "block";
                    currentStep = 0;
                    showStep(currentStep);
                });
            });

            if (btnCloseModal) {
                btnCloseModal.addEventListener("click", function () {
                    modalTambah.style.display = "none";
                });
            }

            window.addEventListener("click", function (e) {
                if (e.target === modalTambah) {
                    modalTambah.style.display = "none";
                }
            });

            // --- Event Listeners for Stepper ---
            steps.forEach((step, idx) => {
                step.addEventListener("click", () => {
                    if (idx < currentStep) {
                        currentStep = idx;
                        showStep(currentStep);
                    } else if (idx > currentStep) {
                        if (validateStep(currentStep)) {
                            currentStep = idx;
                            showStep(currentStep);
                        }
                    }
                });
            });

            nextBtn.addEventListener("click", () => {
                if (validateStep(currentStep)) {
                    if (currentStep < contents.length - 1) {
                        currentStep++;
                        showStep(currentStep);
                    }
                }
            });

            prevBtn.addEventListener("click", () => {
                if (currentStep > 0) {
                    currentStep--;
                    showStep(currentStep);
                }
            });

            // Initial state
            showStep(currentStep);

            // --- File input display ---
            const fileInput = document.getElementById("file_pdf");
            const fileNameDisplay = document.getElementById("file-name");

            if (fileInput && fileNameDisplay) {
                fileInput.addEventListener("change", function () {
                    if (this.files.length > 0) {
                        fileNameDisplay.textContent = this.files[0].name;
                    } else {
                        fileNameDisplay.textContent = "Belum ada file yang dipilih.";
                    }
                });
            }
        });
    </script>

    @include('layouts.NavbarBawah')
</body>

</html>