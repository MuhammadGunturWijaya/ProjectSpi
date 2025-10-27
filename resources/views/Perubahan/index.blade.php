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


    <!-- <div class="search-wrapper">
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
    </div> -->


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
                        <a href="{{ route('Perubahan.show', $item->id) }}" class="card-link">
                            <div class="card-item-new">
                                <div class="card-glow"></div>
                                <div class="card-icon-new">
                                    <i
                                        class="{{ $item->jenis == 'undang-undang' ? 'fas fa-gavel' : 'fas fa-file-invoice' }}"></i>
                                </div>
                                <div class="card-content-new">
                                    <span class="card-title-new">{{ $item->judul }}</span>
                                    <small class="card-subtitle-new">{{ $item->tahun }}</small>
                                    <span class="card-type-new">📜 {{ strtoupper($item->jenis) }}</span>
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
            background:  color: var(--primary);
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




    <section class="classification" id="manajemen-perubahan">
        <div class="classification-header">
            <h2>Manajemen Perubahan</h2>
            <div class="header-actions">
                <a href="{{ route('perubahan.lihat') }}">
                    <i class="fa fa-chart-bar"></i> Lihat Lebih
                </a>
                @if(Auth::check() && Auth::user()->role === 'admin')
                    <a href="#" id="btnTambahPerubahan">
                        <i class="fa fa-plus"></i> Tambah Perubahan
                    </a>
                @endif
            </div>
        </div>

        <div class="grid">
            @forelse($perubahans as $perubahan)
                <div class="card">
                    <div class="card-icon-wrapper">
                        <i class="fa fa-file-alt"></i>
                    </div>
                    <div class="card-content">
                        <h3>{{ $perubahan->judul }}</h3>
                        <p>Tahun: {{ $perubahan->tahun ?? '-' }}</p>
                    </div>
                    <a href="{{ route('perubahan.show', $perubahan->id) }}" class="card-link">
                        Lihat Dokumen →
                    </a>
                </div>
            @empty
                <p>Tidak ada dokumen Perubahan.</p>
            @endforelse
        </div>
    </section>

    <!-- Modal Tambah Perubahan -->
    <div id="modalTambahPerubahan" class="modal">
        <div class="modal-box">
            <button class="close" id="closeModalTambahPerubahan" aria-label="Close modal">&times;</button>
            <h2 class="modal-title">Tambah Dokumen Manajemen Perubahan</h2>

            {{-- Pesan error umum --}}
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Pesan validasi --}}
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
                    aria-controls="step1-content" id="step1-perubahan">
                    <span class="step-number">1</span> Materi Pokok
                </button>
                <button class="step-nav-item" data-step="2" role="tab" aria-selected="false"
                    aria-controls="step2-content" id="step2-perubahan">
                    <span class="step-number">2</span> Metadata
                </button>
                <button class="step-nav-item" data-step="3" role="tab" aria-selected="false"
                    aria-controls="step3-content" id="step3-perubahan">
                    <span class="step-number">3</span> Berkas & Status
                </button>
            </div>

            <form id="formTambahPerubahan" action="{{ route('perubahan.store') }}" method="POST"
                enctype="multipart/form-data" novalidate>
                @csrf

                {{-- STEP 1 --}}
                <section class="step-content active" data-step="1" id="step1-content-perubahan">
                    <div class="form-section-header">
                        <h4>Materi Pokok Dokumen</h4>
                    </div>

                    <div class="form-group">
                        <label for="judul-perubahan">Judul <span class="required">*</span></label>
                        <input type="text" id="judul-perubahan" name="judul" required
                            placeholder="Masukkan judul dokumen">
                    </div>
                    <div class="form-group">
                        <label for="tahun-perubahan">Tahun <span class="required">*</span></label>
                        <select id="tahun-perubahan" name="tahun" required>
                            <option value="">Pilih Tahun</option>
                            @for ($y = date('Y'); $y >= 1900; $y--)
                                <option value="{{ $y }}">{{ $y }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kata_kunci-perubahan">Kata Kunci</label>
                        <input type="text" id="kata_kunci-perubahan" name="kata_kunci"
                            placeholder="Pisahkan dengan koma, contoh: pajak, bea cukai">
                    </div>
                    <div class="form-group">
                        <label for="abstrak-perubahan">Abstrak</label>
                        <textarea id="abstrak-perubahan" name="abstrak" rows="4"
                            placeholder="Tuliskan ringkasan isi dokumen"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="catatan-perubahan">Catatan</label>
                        <textarea id="catatan-perubahan" name="catatan" rows="2"
                            placeholder="Catatan atau informasi tambahan"></textarea>
                    </div>
                </section>

                {{-- STEP 2 --}}
                <section class="step-content" data-step="2" id="step2-content-perubahan" role="tabpanel"
                    aria-labelledby="step2-perubahan">
                    <div class="form-section-header">
                        <h4>Metadata Dokumen</h4>
                        <p class="section-desc">Detail teknis dokumen seperti nomor, tanggal, dan sumber.</p>
                    </div>
                    <div class="grid-2">
                        {{-- Field metadata, sama seperti Piagam SPI --}}
                        <div class="form-group">
                            <label for="tipe_dokumen-perubahan">Tipe Dokumen</label>
                            <input type="text" id="tipe_dokumen-perubahan" name="tipe_dokumen">
                        </div>
                        <div class="form-group">
                            <label for="judul_meta-perubahan">Judul Metadata</label>
                            <input type="text" id="judul_meta-perubahan" name="judul_meta">
                        </div>
                        <div class="form-group">
                            <label for="teu-perubahan">T.E.U.</label>
                            <input type="text" id="teu-perubahan" name="teu">
                        </div>
                        <div class="form-group">
                            <label for="nomor-perubahan">Nomor</label>
                            <input type="text" id="nomor-perubahan" name="nomor">
                        </div>
                        <div class="form-group">
                            <label for="bentuk-perubahan">Bentuk</label>
                            <input type="text" id="bentuk-perubahan" name="bentuk">
                        </div>
                        <div class="form-group">
                            <label for="bentuk_singkat-perubahan">Bentuk Singkat</label>
                            <input type="text" id="bentuk_singkat-perubahan" name="bentuk_singkat">
                        </div>
                        <div class="form-group">
                            <label for="tahun_meta-perubahan">Tahun Metadata</label>
                            <select id="tahun_meta-perubahan" name="tahun_meta">
                                <option value="">Pilih Tahun</option>
                                @for ($y = date('Y'); $y >= 1900; $y--)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tempat_penetapan-perubahan">Tempat Penetapan</label>
                            <input type="text" id="tempat_penetapan-perubahan" name="tempat_penetapan">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_penetapan-perubahan">Tanggal Penetapan</label>
                            <input type="date" id="tanggal_penetapan-perubahan" name="tanggal_penetapan">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_pengundangan-perubahan">Tanggal Pengundangan</label>
                            <input type="date" id="tanggal_pengundangan-perubahan" name="tanggal_pengundangan">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_berlaku-perubahan">Tanggal Berlaku</label>
                            <input type="date" id="tanggal_berlaku-perubahan" name="tanggal_berlaku">
                        </div>
                        <div class="form-group">
                            <label for="sumber-perubahan">Sumber</label>
                            <input type="text" id="sumber-perubahan" name="sumber">
                        </div>
                        <div class="form-group">
                            <label for="subjek-perubahan">Subjek</label>
                            <input type="text" id="subjek-perubahan" name="subjek">
                        </div>
                        <div class="form-group">
                            <label for="status-perubahan">Status</label>
                            <input type="text" id="status-perubahan" name="status">
                        </div>
                        <div class="form-group">
                            <label for="bahasa-perubahan">Bahasa</label>
                            <input type="text" id="bahasa-perubahan" name="bahasa">
                        </div>
                        <div class="form-group">
                            <label for="lokasi-perubahan">Lokasi</label>
                            <input type="text" id="lokasi-perubahan" name="lokasi">
                        </div>
                        <div class="form-group">
                            <label for="bidang-perubahan">Bidang</label>
                            <input type="text" id="bidang-perubahan" name="bidang">
                        </div>
                    </div>
                </section>

                {{-- STEP 3 --}}
                <section class="step-content" data-step="3" id="step3-content-perubahan" role="tabpanel"
                    aria-labelledby="step3-perubahan">
                    <div class="form-section-header">
                        <h4>Berkas Dokumen & Status</h4>
                    </div>
                    <div class="form-group file-upload-group">
                        <label for="file_pdf-perubahan" class="file-label">Pilih Berkas PDF</label>
                        <input type="file" id="file_pdf-perubahan" name="file_pdf" accept="application/pdf">
                        <small class="file-help">Format: PDF, maksimal 10MB.</small>
                    </div>

                    <div class="form-group">
                        <label for="mencabut-perubahan">Mencabut</label>
                        <input type="text" id="mencabut-perubahan" name="mencabut"
                            placeholder="Tuliskan dokumen yang dicabut">
                    </div>
                </section>

                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" id="prevStep-perubahan" style="display:none;">
                        Kembali
                    </button>
                    <button type="button" class="btn btn-primary" id="nextStep-perubahan">
                        Lanjut
                    </button>
                    <button type="submit" class="btn btn-submit" id="submitBtn-perubahan" style="display:none">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const modalTambah = document.getElementById("modalTambahPerubahan");
            const btnOpenModal = document.querySelectorAll("#btnTambahPerubahan");
            const btnCloseModal = document.getElementById("closeModalTambahperubahan");

            const steps = document.querySelectorAll(".step-nav-item");
            const contents = document.querySelectorAll(".step-content");
            const nextBtn = document.getElementById("nextStep-perubahan");
            const prevBtn = document.getElementById("prevStep-perubahan");
            const submitBtn = document.getElementById("submitBtn-perubahan");
            let currentStep = 0;

            // --- Show/Hide steps & buttons ---
            function showStep(index) {
                if (contents.length && steps.length) {
                    contents.forEach((c, i) => c.classList.toggle("active", i === index));
                    steps.forEach((s, i) => s.classList.toggle("active", i === index));
                }

                if (prevBtn) prevBtn.style.display = index === 0 ? "none" : "inline-flex";
                if (nextBtn) nextBtn.style.display = index === contents.length - 1 ? "none" : "inline-flex";
                if (submitBtn) submitBtn.style.display = index === contents.length - 1 ? "inline-flex" : "none";
            }

            // --- Validasi field wajib ---
            function validateStep(index) {
                const currentContent = contents[index];
                if (!currentContent) return true;

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

                if (!isValid) alert("Harap lengkapi semua bidang yang wajib diisi (*).");
                return isValid;
            }

            // --- Modal Control ---
            if (btnOpenModal.length && modalTambah) {
                btnOpenModal.forEach(btn => {
                    btn.addEventListener("click", function (e) {
                        e.preventDefault();
                        modalTambah.style.display = "block";
                        currentStep = 0;
                        showStep(currentStep);
                    });
                });
            }

            if (btnCloseModal && modalTambah) {
                btnCloseModal.addEventListener("click", function () {
                    modalTambah.style.display = "none";
                });
            }

            window.addEventListener("click", function (e) {
                if (modalTambah && e.target === modalTambah) {
                    modalTambah.style.display = "none";
                }
            });

            // --- Stepper ---
            if (steps.length) {
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
            }

            if (nextBtn) {
                nextBtn.addEventListener("click", () => {
                    if (validateStep(currentStep)) {
                        if (currentStep < contents.length - 1) {
                            currentStep++;
                            showStep(currentStep);
                        }
                    }
                });
            }

            if (prevBtn) {
                prevBtn.addEventListener("click", () => {
                    if (currentStep > 0) {
                        currentStep--;
                        showStep(currentStep);
                    }
                });
            }

            // Initial
            showStep(currentStep);

            // --- File input ---
            const fileInput = document.getElementById("file_pdf-manajemen");
            const fileNameDisplay = document.getElementById("file-name-manajemen");

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