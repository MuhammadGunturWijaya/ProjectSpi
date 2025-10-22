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


    <section class="classification" id="penataan-tata-kelola">
        <div class="classification-header">
            <h2>Penataan Tata Kelola</h2>
            <div class="header-actions">
                <a href="{{ route('penataan.lihat') }}">
                    <i class="fa fa-chart-bar"></i> Lihat Lebih
                </a>
                @if(Auth::check() && Auth::user()->role === 'admin')
                    <a href="#" id="btnTambahPenataan">
                        <i class="fa fa-plus"></i> Tambah Dokumen
                    </a>
                @endif
            </div>
        </div>

        <div class="grid">
            @forelse($penataans as $penataan)
                <div class="card">
                    <div class="card-icon-wrapper">
                        <i class="fa fa-file-alt"></i>
                    </div>
                    <div class="card-content">
                        <h3>{{ $penataan->judul }}</h3>
                        <p>Tahun: {{ $penataan->tahun ?? '-' }}</p>
                    </div>
                    <a href="{{ route('penataan.show', $penataan->id) }}" class="card-link">
                        Lihat Dokumen →
                    </a>
                </div>
            @empty
                <p>Tidak ada dokumen Penataan Tata Kelola.</p>
            @endforelse
        </div>
    </section>

    <!-- Modal Tambah Penataan Tata Kelola -->
    <div id="modalTambahPenataan" class="modal">
        <div class="modal-box">
            <button class="close" id="closeModalTambahPenataan" aria-label="Close modal">&times;</button>
            <h2 class="modal-title">Tambah Dokumen Penataan Tata Kelola</h2>

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

            {{-- Stepper --}}
            <div class="stepper-nav" role="tablist" aria-label="Form Steps">
                <button class="step-nav-item active" data-step="1" id="step1-penataan">
                    <span class="step-number">1</span> Materi Pokok
                </button>
                <button class="step-nav-item" data-step="2" id="step2-penataan">
                    <span class="step-number">2</span> Metadata
                </button>
                <button class="step-nav-item" data-step="3" id="step3-penataan">
                    <span class="step-number">3</span> Berkas & Status
                </button>
            </div>

            <form id="formTambahPenataan" action="{{ route('penataan.store') }}" method="POST"
                enctype="multipart/form-data" novalidate>
                @csrf

                {{-- STEP 1 --}}
                <section class="step-content active" data-step="1" id="step1-content-penataan">
                    <h4>Materi Pokok Dokumen</h4>
                    <div class="form-group">
                        <label for="judul-penataan">Judul <span class="required">*</span></label>
                        <input type="text" id="judul-penataan" name="judul" required
                            placeholder="Masukkan judul dokumen">
                    </div>
                    <div class="form-group">
                        <label for="tahun-penataan">Tahun <span class="required">*</span></label>
                        <select id="tahun-penataan" name="tahun" required>
                            <option value="">Pilih Tahun</option>
                            @for ($y = date('Y'); $y >= 1900; $y--)
                                <option value="{{ $y }}">{{ $y }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kata_kunci-penataan">Kata Kunci</label>
                        <input type="text" id="kata_kunci-penataan" name="kata_kunci"
                            placeholder="Pisahkan dengan koma">
                    </div>
                    <div class="form-group">
                        <label for="abstrak-penataan">Abstrak</label>
                        <textarea id="abstrak-penataan" name="abstrak" rows="4"
                            placeholder="Ringkasan isi dokumen"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="catatan-penataan">Catatan</label>
                        <textarea id="catatan-penataan" name="catatan" rows="2"
                            placeholder="Catatan tambahan"></textarea>
                    </div>
                </section>

                {{-- STEP 2 --}}
                <section class="step-content" data-step="2" id="step2-content-penataan">
                    <h4>Metadata Dokumen</h4>
                    <div class="grid-2">
                        <div class="form-group">
                            <label for="tipe_dokumen-penataan">Tipe Dokumen</label>
                            <input type="text" id="tipe_dokumen-penataan" name="tipe_dokumen">
                        </div>
                        <div class="form-group">
                            <label for="judul_meta-penataan">Judul Metadata</label>
                            <input type="text" id="judul_meta-penataan" name="judul_meta">
                        </div>
                        <div class="form-group">
                            <label for="teu-penataan">T.E.U</label>
                            <input type="text" id="teu-penataan" name="teu">
                        </div>
                        <div class="form-group">
                            <label for="nomor-penataan">Nomor</label>
                            <input type="text" id="nomor-penataan" name="nomor">
                        </div>
                        <div class="form-group">
                            <label for="bentuk-penataan">Bentuk</label>
                            <input type="text" id="bentuk-penataan" name="bentuk">
                        </div>
                        <div class="form-group">
                            <label for="bentuk_singkat-penataan">Bentuk Singkat</label>
                            <input type="text" id="bentuk_singkat-penataan" name="bentuk_singkat">
                        </div>
                        <div class="form-group">
                            <label for="tahun_meta-penataan">Tahun Metadata</label>
                            <select id="tahun_meta-penataan" name="tahun_meta">
                                <option value="">Pilih Tahun</option>
                                @for ($y = date('Y'); $y >= 1900; $y--)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tempat_penetapan-penataan">Tempat Penetapan</label>
                            <input type="text" id="tempat_penetapan-penataan" name="tempat_penetapan">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_penetapan-penataan">Tanggal Penetapan</label>
                            <input type="date" id="tanggal_penetapan-penataan" name="tanggal_penetapan">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_pengundangan-penataan">Tanggal Pengundangan</label>
                            <input type="date" id="tanggal_pengundangan-penataan" name="tanggal_pengundangan">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_berlaku-penataan">Tanggal Berlaku</label>
                            <input type="date" id="tanggal_berlaku-penataan" name="tanggal_berlaku">
                        </div>
                        <div class="form-group">
                            <label for="sumber-penataan">Sumber</label>
                            <input type="text" id="sumber-penataan" name="sumber">
                        </div>
                        <div class="form-group">
                            <label for="subjek-penataan">Subjek</label>
                            <input type="text" id="subjek-penataan" name="subjek">
                        </div>
                        <div class="form-group">
                            <label for="status-penataan">Status</label>
                            <input type="text" id="status-penataan" name="status">
                        </div>
                        <div class="form-group">
                            <label for="bahasa-penataan">Bahasa</label>
                            <input type="text" id="bahasa-penataan" name="bahasa">
                        </div>
                        <div class="form-group">
                            <label for="lokasi-penataan">Lokasi</label>
                            <input type="text" id="lokasi-penataan" name="lokasi">
                        </div>
                        <div class="form-group">
                            <label for="bidang-penataan">Bidang</label>
                            <input type="text" id="bidang-penataan" name="bidang">
                        </div>
                    </div>
                </section>

                {{-- STEP 3 --}}
                <section class="step-content" data-step="3" id="step3-content-penataan">
                    <h4>Berkas Dokumen & Status</h4>
                    <div class="form-group file-upload-group">
                        <label for="file_pdf-penataan" class="file-label">Pilih Berkas PDF</label>
                        <input type="file" id="file_pdf-penataan" name="file_pdf" accept="application/pdf">
                        <span id="file-name-penataan">Belum ada file.</span>
                    </div>
                    <div class="form-group">
                        <label for="mencabut-penataan">Mencabut</label>
                        <input type="text" id="mencabut-penataan" name="mencabut">
                    </div>
                </section>

                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" id="prevStep-penataan"
                        style="display:none;">Kembali</button>
                    <button type="button" class="btn btn-primary" id="nextStep-penataan">Lanjut</button>
                    <button type="submit" class="btn btn-submit" id="submitBtn-penataan"
                        style="display:none;">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const modal = document.getElementById("modalTambahPenataan");
            const openBtns = document.querySelectorAll("#btnTambahPenataan");
            const closeBtn = document.getElementById("closeModalTambahPenataan");

            const steps = document.querySelectorAll(".step-nav-item");
            const contents = document.querySelectorAll(".step-content");
            const nextBtn = document.getElementById("nextStep-penataan");
            const prevBtn = document.getElementById("prevStep-penataan");
            const submitBtn = document.getElementById("submitBtn-penataan");
            let currentStep = 0;

            function showStep(idx) {
                contents.forEach((c, i) => c.classList.toggle("active", i === idx));
                steps.forEach((s, i) => s.classList.toggle("active", i === idx));
                prevBtn.style.display = idx === 0 ? "none" : "inline-flex";
                nextBtn.style.display = idx === contents.length - 1 ? "none" : "inline-flex";
                submitBtn.style.display = idx === contents.length - 1 ? "inline-flex" : "none";
            }

            function validateStep(idx) {
                const required = contents[idx].querySelectorAll("[required]");
                let valid = true;
                required.forEach(input => {
                    if (!input.value) { input.classList.add("is-invalid"); valid = false; }
                    else { input.classList.remove("is-invalid"); }
                });
                return valid;
            }

            openBtns.forEach(btn => btn.addEventListener("click", e => {
                e.preventDefault(); modal.style.display = "block"; currentStep = 0; showStep(currentStep);
            }));
            closeBtn.addEventListener("click", () => modal.style.display = "none");
            window.addEventListener("click", e => { if (e.target === modal) modal.style.display = "none"; });

            nextBtn.addEventListener("click", () => {
                if (validateStep(currentStep) && currentStep < contents.length - 1) {
                    currentStep++; showStep(currentStep);
                }
            });
            prevBtn.addEventListener("click", () => { if (currentStep > 0) { currentStep--; showStep(currentStep); } });

            const fileInput = document.getElementById("file_pdf-penataan");
            const fileName = document.getElementById("file-name-penataan");
            fileInput.addEventListener("change", function () {
                fileName.textContent = this.files.length ? this.files[0].name : "Belum ada file.";
            });

            showStep(currentStep);
        });
    </script>


    @include('layouts.NavbarBawah')
</body>

</html>