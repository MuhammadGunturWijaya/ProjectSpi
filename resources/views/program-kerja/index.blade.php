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
        <!-- FORM PENCARIAN UTAMA -->
        <form action="{{ route('program-kerja.search') }}" method="GET" class="search-form" style="display: contents;">
            <div class="input-group">
                <input type="text" name="keyword" placeholder="Cari Program Kerja ..." value="{{ request('keyword') }}">
            </div>
            <button type="submit" class="search-btn"><i class="fa fa-search"></i> Cari</button>
            <button type="button" class="adv-btn" id="openAdvModal"><i class="fa fa-sliders-h"></i> Adv. Search</button>
        </form>
    </div>

    <!-- MODAL ADVANCED SEARCH -->
    <div id="advModal" class="modal">
        <div class="modal-box">
            <span class="close">&times;</span>
            <h2 class="modal-title"><i class="fa fa-sliders-h"></i> Advanced Search</h2>

            <form class="adv-form" action="{{ route('program-kerja.search') }}" method="GET">
                <div class="form-group">
                    <label for="keyword">Tentang</label>
                    <input type="text" name="keyword" id="keyword" placeholder="Masukkan kata kunci ..."
                        value="{{ request('keyword') }}">
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
                    <label for="bidang">Bidang</label>
                    <input type="text" name="bidang" id="bidang" placeholder="Contoh: Keuangan, Operasional ..."
                        value="{{ request('bidang') }}">
                </div>

                <div class="form-group">
                    <label for="subjek">Subjek</label>
                    <input type="text" name="subjek" id="subjek" placeholder="Contoh: Audit, Pengawasan ..."
                        value="{{ request('subjek') }}">
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
            <button id="carousel-prev" class="carousel-btn prev-btn">
                <i class="fas fa-chevron-left"></i>
            </button>
            <div class="carousel-track-container">
                <div class="carousel-track">
                    @foreach($popular as $item)
                        <a href="{{ route('programKerja.show', $item->id) }}" class="card-link">
                            <div class="card-item-new">
                                <div class="card-glow"></div>
                                <div class="card-icon-new">
                                    <i
                                        class="{{ $item->jenis == 'undang-undang' ? 'fas fa-gavel' : 'fas fa-file-invoice' }}"></i>
                                </div>
                                <div class="card-content-new">
                                    <span class="card-title-new">{{ $item->judul }}</span>
                                    <small class="card-subtitle-new">{{ $item->tahun }}</small>
                                    <!-- <span class="card-type-new">📜 {{ strtoupper($item->jenis) }}</span> -->
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            <button id="carousel-next" class="carousel-btn next-btn">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </section>

    <style>
        /* === SECTION === */
        .popular {
            padding: 3rem 1rem;
            background: linear-gradient(135deg, #eef3ff 0%, #ffffff 100%);
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
        }

        .popular::before {
            content: "";
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.1), transparent 60%);
            transform: rotate(25deg);
            z-index: 0;
        }

        .popular h2 {
            font-size: 1.9rem;
            font-weight: 800;
            text-align: center;
            color: #1e293b;
            margin-bottom: 2rem;
            position: relative;
            z-index: 2;
        }

        .popular h2::after {
            content: "";
            display: block;
            width: 90px;
            height: 4px;
            background: linear-gradient(to right, #2563eb, #0ea5e9);
            margin: 0.6rem auto 0;
            border-radius: 2px;
        }

        /* === CAROUSEL === */
        .carousel-wrapper {
            display: flex;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .carousel-track-container {
            overflow: hidden;
            flex: 1;
        }

        .carousel-track {
            display: flex;
            gap: 1.5rem;
            transition: transform 0.4s ease;
            padding: 0.5rem;
        }

        /* === CARD === */
        .card-link {
            text-decoration: none;
            color: inherit;
        }

        .card-item-new {
            width: 270px;
            min-height: 280px;
            background: color: var(--primary);
            /* warna card  */
            border-radius: 16px;
            position: relative;
            padding: 1.4rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(37, 99, 235, 0.12);
            overflow: hidden;
            transition: all 0.35s ease;
        }

        .card-item-new:hover {
            transform: translateY(-10px) scale(1.03);
            box-shadow: 0 12px 28px rgba(37, 99, 235, 0.25);
            border-color: transparent;
        }

        .card-glow {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 30% 30%, rgba(37, 99, 235, 0.15), transparent 70%);
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: 0;
        }

        .card-item-new:hover .card-glow {
            opacity: 1;
        }

        .card-icon-new {
            font-size: 2rem;
            color: #2563eb;
            background: #f1f5ff;
            padding: 0.7rem;
            border-radius: 14px;
            box-shadow: inset 0 0 8px rgba(37, 99, 235, 0.15);
            margin-bottom: 0.8rem;
            z-index: 1;
        }

        .card-content-new {
            z-index: 1;
        }

        .card-title-new {
            font-weight: 700;
            font-size: 1.05rem;
            color: #1e293b;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 0.4rem;
        }

        .card-subtitle-new {
            font-size: 0.9rem;
            color: #475569;
            margin-bottom: 0.6rem;
            display: block;
        }

        .card-type-new {
            font-size: 0.85rem;
            background: linear-gradient(to right, #2563eb, #0ea5e9);
            color: #fff;
            padding: 0.4rem 0.7rem;
            border-radius: 10px;
            font-weight: 500;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
            align-self: flex-start;
        }

        /* === BUTTONS === */
        .carousel-btn {
            background: linear-gradient(135deg, #2563eb, #0ea5e9);
            border: none;
            color: #fff;
            font-size: 1.3rem;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 5px 12px rgba(37, 99, 235, 0.3);
        }

        .carousel-btn:hover {
            background: linear-gradient(135deg, #1d4ed8, #0284c7);
            transform: scale(1.1);
        }

        .carousel-btn:active {
            transform: scale(0.96);
        }
    </style>

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


    <section class="classification" id="program-kerja-spi">
        <div class="classification-header">
            <h2>Program Kerja <span class="spi-text">SPI</span></h2>
            <div class="header-actions">
                <a href="{{ route('programKerja.lihat') }}">
                    <i class="fa fa-chart-bar"></i> Lihat Lebih
                </a>
                @if(Auth::check() && Auth::user()->role === 'admin')
                    <a href="#" id="btnTambahProgramKerjaSPI">
                        <i class="fa fa-plus"></i> Tambah Program Kerja
                    </a>
                @endif
            </div>
        </div>

        <div class="grid">
            @forelse($programKerjaList as $ProgramKerjaSPI)
                <div class="card">
                    <div class="card-icon-wrapper">
                        <i class="fa fa-file-alt"></i>
                    </div>
                    <div class="card-content">
                        <h3>{{ $ProgramKerjaSPI->judul }}</h3>
                        <p>Tahun: {{ $ProgramKerjaSPI->tahun ?? '-' }}</p>
                    </div>
                    <a href="{{ route('programKerja.show', $ProgramKerjaSPI->id) }}" class="card-link">
                        Lihat Detail →
                    </a>
                </div>
            @empty
                <p>Tidak ada Program Kerja SPI.</p>
            @endforelse
        </div>
    </section>

    <section class="classification" id="kinerja-spi">
        <div class="classification-header">
            <h2>Kinerja <span class="spi-text">SPI</span></h2>
            <div class="header-actions">
                <a href="{{ route('kinerjaSPI.lihat') }}">
                    <i class="fa fa-chart-bar"></i> Lihat Lebih
                </a>
                @if(Auth::check() && Auth::user()->role === 'admin')
                    <a href="#" id="btnTambahKinerjaSPI">
                        <i class="fa fa-plus"></i> Tambah Kinerja
                    </a>
                @endif
            </div>
        </div>

        <div class="grid">
            @forelse($kinerjaList as $kinerjaSPI)
                <div class="card">
                    <div class="card-icon-wrapper">
                        <i class="fa fa-chart-line"></i>
                    </div>
                    <div class="card-content">
                        <h3>{{ $kinerjaSPI->judul }}</h3>
                        <p>Tahun: {{ $kinerjaSPI->tahun ?? '-' }}</p>
                    </div>
                    <a href="{{ route('kinerjaSPI.show', $kinerjaSPI->id) }}" class="card-link">
                        Lihat Detail →
                    </a>
                </div>
            @empty
                <p>Tidak ada Kinerja SPI.</p>
            @endforelse
        </div>
    </section>


    <div id="modalTambahProgramKerja" class="modal">
        <div class="modal-box">
            <button class="close" id="closeModalTambah" aria-label="Close modal">&times;</button>
            <h2 class="modal-title">Tambah Dokumen Program Kerja SPI</h2>

            {{-- Pesan error umum --}}
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Pesan validasi Laravel --}}
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

            <form id="formTambahProgramKerja" action="{{ route('programKerja.store') }}" method="POST"
                enctype="multipart/form-data" novalidate>
                @csrf

                <section class="step-content active" data-step="1" id="step1-content">
                    <div class="form-section-header">
                        <h4>Materi Pokok Dokumen</h4>
                    </div>
                    <!-- <div class="form-group">
                        <label>Pilih Jenis Program Kerja <span class="required">*</span></label>
                        <div class="button-group">
                            <button type="button" class="btn btn-outline" data-jenis="audit">Audit</button>
                        </div>
                        <input type="hidden" name="jenis" id="jenisProgramKerja" required>
                    </div> -->

                    <div class="form-group">
                        <label for="judul">Judul <span class="required">*</span></label>
                        <input type="text" id="judul" name="judul" required placeholder="Masukkan judul dokumen">
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
                            placeholder="Tuliskan ringkasan isi dokumen"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="catatan">Catatan</label>
                        <textarea id="catatan" name="catatan" rows="2"
                            placeholder="Catatan atau informasi tambahan"></textarea>
                    </div>
                </section>

                <section class="step-content" data-step="2" id="step2-content">
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
                            <input type="text" id="nomor" name="nomor" placeholder="Nomor dokumen">
                        </div>
                        <div class="form-group">
                            <label for="bentuk">Bentuk</label>
                            <input type="text" id="bentuk" name="bentuk" placeholder="Bentuk dokumen">
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
                            <input type="text" id="sumber" name="sumber" placeholder="Sumber dokumen">
                        </div>
                        <div class="form-group">
                            <label for="subjek">Subjek</label>
                            <input type="text" id="subjek" name="subjek" placeholder="Subjek terkait">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <input type="text" id="status" name="status" placeholder="Status dokumen">
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

                <section class="step-content" data-step="3" id="step3-content">
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
                        <input type="text" id="mencabut" name="mencabut" placeholder="Tuliskan dokumen yang dicabut">
                    </div>
                </section>

                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" id="prevStep" style="display:none;">
                        Kembali
                    </button>
                    <button type="button" class="btn btn-primary" id="nextStep">
                        Lanjut
                    </button>
                    <button type="submit" class="btn btn-submit" id="submitBtn" style="display:none">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalTambahKinerja" class="modal">
        <div class="modal-box">
            <button class="close" id="closeModalTambahKinerja" aria-label="Close modal">&times;</button>
            <h2 class="modal-title">Tambah Dokumen Kinerja SPI</h2>

            @if (session('error_kinerja'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error_kinerja') }}
                </div>
            @endif

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
                    aria-controls="step1-content-kinerja" id="step1-kinerja">
                    <span class="step-number">1</span> Materi Pokok
                </button>
                <button class="step-nav-item" data-step="2" role="tab" aria-selected="false"
                    aria-controls="step2-content-kinerja" id="step2-kinerja">
                    <span class="step-number">2</span> Metadata
                </button>
                <button class="step-nav-item" data-step="3" role="tab" aria-selected="false"
                    aria-controls="step3-content-kinerja" id="step3-kinerja">
                    <span class="step-number">3</span> Berkas & Status
                </button>
            </div>

            <form id="formTambahKinerja" action="{{ route('kinerjaSPI.store') }}" method="POST"
                enctype="multipart/form-data" novalidate>
                @csrf

                <section class="step-content active" data-step="1" id="step1-content-kinerja">
                    <div class="form-section-header">
                        <h4>Materi Pokok Dokumen</h4>
                    </div>

                    <div class="form-group">
                        <label for="judul-kinerja">Judul <span class="required">*</span></label>
                        <input type="text" id="judul-kinerja" name="judul" required
                            placeholder="Masukkan judul dokumen">
                    </div>
                    <div class="form-group">
                        <label for="tahun-kinerja">Tahun <span class="required">*</span></label>
                        <select id="tahun-kinerja" name="tahun" required>
                            <option value="">Pilih Tahun</option>
                            @for ($y = date('Y'); $y >= 1900; $y--)
                                <option value="{{ $y }}">{{ $y }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kata_kunci-kinerja">Kata Kunci</label>
                        <input type="text" id="kata_kunci-kinerja" name="kata_kunci"
                            placeholder="Pisahkan dengan koma, contoh: pajak, bea cukai">
                    </div>
                    <div class="form-group">
                        <label for="abstrak-kinerja">Abstrak</label>
                        <textarea id="abstrak-kinerja" name="abstrak" rows="4"
                            placeholder="Tuliskan ringkasan isi dokumen"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="catatan-kinerja">Catatan</label>
                        <textarea id="catatan-kinerja" name="catatan" rows="2"
                            placeholder="Catatan atau informasi tambahan"></textarea>
                    </div>
                </section>

                <section class="step-content" data-step="2" id="step2-content-kinerja">
                    <div class="form-section-header">
                        <h4>Metadata Dokumen</h4>
                        <p class="section-desc">Detail teknis dokumen seperti nomor, tanggal, dan sumber.</p>
                    </div>
                    <div class="grid-2">
                        <div class="form-group">
                            <label for="tipe_dokumen-kinerja">Tipe Dokumen</label>
                            <input type="text" id="tipe_dokumen-kinerja" name="tipe_dokumen"
                                placeholder="Contoh: Laporan Kinerja">
                        </div>
                        <div class="form-group">
                            <label for="judul_meta-kinerja">Judul Metadata</label>
                            <input type="text" id="judul_meta-kinerja" name="judul_meta" placeholder="Judul metadata">
                        </div>
                        <div class="form-group">
                            <label for="teu-kinerja">T.E.U.</label>
                            <input type="text" id="teu-kinerja" name="teu" placeholder="Tanda Efektif Umum">
                        </div>
                        <div class="form-group">
                            <label for="nomor-kinerja">Nomor</label>
                            <input type="text" id="nomor-kinerja" name="nomor" placeholder="Nomor dokumen">
                        </div>
                        <div class="form-group">
                            <label for="bentuk-kinerja">Bentuk</label>
                            <input type="text" id="bentuk-kinerja" name="bentuk" placeholder="Bentuk dokumen">
                        </div>
                        <div class="form-group">
                            <label for="bentuk_singkat-kinerja">Bentuk Singkat</label>
                            <input type="text" id="bentuk_singkat-kinerja" name="bentuk_singkat"
                                placeholder="Singkatan bentuk">
                        </div>
                        <div class="form-group">
                            <label for="tahun_meta-kinerja">Tahun Metadata</label>
                            <select id="tahun_meta-kinerja" name="tahun_meta">
                                <option value="">Pilih Tahun</option>
                                @for ($y = date('Y'); $y >= 1900; $y--)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tempat_penetapan-kinerja">Tempat Penetapan</label>
                            <input type="text" id="tempat_penetapan-kinerja" name="tempat_penetapan"
                                placeholder="Lokasi penetapan">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_penetapan-kinerja">Tanggal Penetapan</label>
                            <input type="date" id="tanggal_penetapan-kinerja" name="tanggal_penetapan">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_pengundangan-kinerja">Tanggal Pengundangan</label>
                            <input type="date" id="tanggal_pengundangan-kinerja" name="tanggal_pengundangan">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_berlaku-kinerja">Tanggal Berlaku</label>
                            <input type="date" id="tanggal_berlaku-kinerja" name="tanggal_berlaku">
                        </div>
                        <div class="form-group">
                            <label for="sumber-kinerja">Sumber</label>
                            <input type="text" id="sumber-kinerja" name="sumber" placeholder="Sumber dokumen">
                        </div>
                        <div class="form-group">
                            <label for="subjek-kinerja">Subjek</label>
                            <input type="text" id="subjek-kinerja" name="subjek" placeholder="Subjek terkait">
                        </div>
                        <div class="form-group">
                            <label for="status-kinerja">Status</label>
                            <input type="text" id="status-kinerja" name="status" placeholder="Status dokumen">
                        </div>
                        <div class="form-group">
                            <label for="bahasa-kinerja">Bahasa</label>
                            <input type="text" id="bahasa-kinerja" name="bahasa" placeholder="Bahasa dokumen">
                        </div>
                        <div class="form-group">
                            <label for="lokasi-kinerja">Lokasi</label>
                            <input type="text" id="lokasi-kinerja" name="lokasi" placeholder="Lokasi penyimpanan">
                        </div>
                        <div class="form-group">
                            <label for="bidang-kinerja">Bidang</label>
                            <input type="text" id="bidang-kinerja" name="bidang" placeholder="Bidang terkait">
                        </div>
                    </div>
                </section>

                <section class="step-content" data-step="3" id="step3-content-kinerja">
                    <div class="form-section-header">
                        <h4>Berkas Dokumen & Status</h4>
                        <p class="section-desc">Unggah file dokumen dan isi informasi status.</p>
                    </div>
                    <div class="form-group file-upload-group">
                        <label for="file_pdf-kinerja" class="file-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon-upload">
                                <path
                                    d="M4 14.899V20a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-5.101M16 16l-4-4-4 4M12 12.5V2.5" />
                            </svg>
                            Pilih Berkas PDF
                        </label>
                        <input type="file" id="file_pdf-kinerja" name="file_pdf" accept="application/pdf"
                            aria-describedby="fileHelp-kinerja" />
                        <span id="file-name-kinerja" class="file-name-display">Belum ada file yang dipilih.</span>
                        <small id="fileHelp-kinerja" class="file-help">Format: PDF, maksimal 10MB.</small>
                    </div>

                    <div class="form-group">
                        <label for="mencabut-kinerja">Mencabut</label>
                        <input type="text" id="mencabut-kinerja" name="mencabut"
                            placeholder="Tuliskan dokumen yang dicabut">
                    </div>
                </section>

                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" id="prevStep-kinerja" style="display:none;">
                        Kembali
                    </button>
                    <button type="button" class="btn btn-primary" id="nextStep-kinerja">
                        Lanjut
                    </button>
                    <button type="submit" class="btn btn-submit" id="submitBtn-kinerja" style="display:none">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Modal Kinerja
            const modalKinerja = document.getElementById("modalTambahKinerja");
            const btnOpenModalKinerja = document.getElementById("btnTambahKinerjaSPI");
            const btnCloseModalKinerja = document.getElementById("closeModalTambahKinerja");

            const stepsKinerja = document.querySelectorAll("#modalTambahKinerja .step-nav-item");
            const contentsKinerja = document.querySelectorAll("#modalTambahKinerja .step-content");
            const nextBtnKinerja = document.getElementById("nextStep-kinerja");
            const prevBtnKinerja = document.getElementById("prevStep-kinerja");
            const submitBtnKinerja = document.getElementById("submitBtn-kinerja");
            let currentStepKinerja = 0;

            function showStepKinerja(index) {
                contentsKinerja.forEach((c, i) => c.classList.toggle("active", i === index));
                stepsKinerja.forEach((s, i) => s.classList.toggle("active", i === index));

                prevBtnKinerja.style.display = index === 0 ? "none" : "inline-flex";
                nextBtnKinerja.style.display = index === contentsKinerja.length - 1 ? "none" : "inline-flex";
                submitBtnKinerja.style.display = index === contentsKinerja.length - 1 ? "inline-flex" : "none";
            }

            function validateStepKinerja(index) {
                const currentContent = contentsKinerja[index];
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

            if (btnOpenModalKinerja) {
                btnOpenModalKinerja.addEventListener("click", function (e) {
                    e.preventDefault();
                    modalKinerja.style.display = "block";
                    currentStepKinerja = 0;
                    showStepKinerja(currentStepKinerja);
                });
            }

            if (btnCloseModalKinerja) {
                btnCloseModalKinerja.addEventListener("click", function () {
                    modalKinerja.style.display = "none";
                });
            }

            window.addEventListener("click", function (e) {
                if (e.target === modalKinerja) {
                    modalKinerja.style.display = "none";
                }
            });

            stepsKinerja.forEach((step, idx) => {
                step.addEventListener("click", () => {
                    if (idx < currentStepKinerja) {
                        currentStepKinerja = idx;
                        showStepKinerja(currentStepKinerja);
                    } else if (idx > currentStepKinerja) {
                        if (validateStepKinerja(currentStepKinerja)) {
                            currentStepKinerja = idx;
                            showStepKinerja(currentStepKinerja);
                        }
                    }
                });
            });

            nextBtnKinerja.addEventListener("click", () => {
                if (validateStepKinerja(currentStepKinerja)) {
                    if (currentStepKinerja < contentsKinerja.length - 1) {
                        currentStepKinerja++;
                        showStepKinerja(currentStepKinerja);
                    }
                }
            });

            prevBtnKinerja.addEventListener("click", () => {
                if (currentStepKinerja > 0) {
                    currentStepKinerja--;
                    showStepKinerja(currentStepKinerja);
                }
            });

            showStepKinerja(currentStepKinerja);

            // File input display untuk Kinerja
            const fileInputKinerja = document.getElementById("file_pdf-kinerja");
            const fileNameDisplayKinerja = document.getElementById("file-name-kinerja");

            if (fileInputKinerja && fileNameDisplayKinerja) {
                fileInputKinerja.addEventListener("change", function () {
                    if (this.files.length > 0) {
                        fileNameDisplayKinerja.textContent = this.files[0].name;
                    } else {
                        fileNameDisplayKinerja.textContent = "Belum ada file yang dipilih.";
                    }
                });
            }
        });
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const modalTambah = document.getElementById("modalTambahProgramKerja");
            const btnOpenModal = document.querySelectorAll("#btnTambahProgramKerjaSPI, #btnTambahProgramKerjaReviu, #btnTambahProgramKerjaMonev");
            const btnCloseModal = document.getElementById("closeModalTambah");

            const steps = document.querySelectorAll(".step-nav-item");
            const contents = document.querySelectorAll(".step-content");
            const nextBtn = document.getElementById("nextStep");
            const prevBtn = document.getElementById("prevStep");
            const submitBtn = document.getElementById("submitBtn");
            let currentStep = 0;

            // --- Button Jenis Program Kerja ---
            const jenisButtons = document.querySelectorAll('.button-group .btn-outline');


            jenisButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    // Hapus active dari semua tombol
                    jenisButtons.forEach(b => b.classList.remove('active'));
                    // Aktifkan tombol yang diklik
                    btn.classList.add('active');
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