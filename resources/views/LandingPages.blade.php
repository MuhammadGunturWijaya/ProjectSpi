<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page SPI Polije</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Navbar atas */
        .top-nav {
            background-color: #1c2833;
            font-size: 14px;
        }

        .top-nav a {
            color: white;
            text-decoration: none;
            margin: 0 8px;
        }

        .top-nav a:hover {
            color: #0084ffff;
        }

        /* Navbar utama */
        .main-nav {
            background: transparent;
            transition: background-color 0.4s ease, box-shadow 0.4s ease;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        /* Saat discroll */
        .main-nav.scrolled {
            background-color: #650c16ff;
            /* warna solid */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }


        .main-nav .nav-link {
            color: white !important;
            margin: 0 10px;
        }

        .main-nav .nav-link:hover {
            color: #0084ffff !important;
        }

        .logo-text {
            color: white;
            font-size: 14px;
            margin-left: 10px;
            line-height: 1.2;
        }

        .highlight {
            color: #0084ffff !important;
            font-weight: bold;
        }

        /* Hero Banner */
        #heroCarousel {
            position: relative;
            max-width: 1200px;
            margin: auto;
        }

        .carousel-img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 10px;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 20px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 5px;
        }

        .card img {
            max-height: 150px;
            object-fit: cover;
        }

        .report-section {
            background: url('https://polije.ac.id/wp-content/uploads/2021/09/Polije-scaled.jpg') no-repeat center center;
            background-size: cover;
            color: #fff;
            text-align: center;
            padding: 50px 20px;
        }

        .report-box {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            color: #000;
            max-width: 600px;
            margin: auto;
        }

        footer {
            background-color: #0d2d50;
            color: #fff;
            padding: 20px 0;
            font-size: 14px;
        }

        /* Dropdown background */
        .navbar .dropdown-menu {
            background-color: #ffffff;
            border: none;
            border-radius: 3px;
            box-shadow: 0px 6px 18px rgba(0, 0, 0, 0.15);
            opacity: 0;
            transform: translateY(10px);
            visibility: hidden;
            transition: all 0.3s ease;
            padding: 8px 0;
            min-width: 220px;
            /* biar konsisten */
        }

        /* Efek muncul */
        .navbar .dropdown-menu.show {
            opacity: 1;
            transform: translateY(0);
            visibility: visible;
        }

        /* Item dropdown */
        .navbar .dropdown-menu .dropdown-item {
            color: #0d2d50;
            padding: 10px 16px;
            font-size: 14px;
            transition: all 0.2s ease;
            border-radius: 6px;
        }

        /* Hover effect */
        .navbar .dropdown-menu .dropdown-item:hover {
            background-color: #bc0016ff;
            color: #fff;
            transform: translateX(5px);
            /* efek geser halus */
        }

        /* Supaya muncul saat hover (desktop) */
        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
            opacity: 1;
            transform: translateY(0);
            visibility: visible;
        }

        .btn-login {
            background: linear-gradient(135deg, #0066ff, #0099ff);
            border: none;
            color: #fff !important;
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #0052cc, #0088cc);
            transform: scale(1.05);
        }

        .nav-link.fw-bold.text-white.ms-2:hover {
            color: #0084ff !important;
            text-decoration: underline;
            transition: all 0.3s ease;
        }

        .carousel-img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 10px;
        }


        @media (max-width: 768px) {
            .carousel-img {
                height: 200px;
                /* tinggi tetap */
                border-radius: 0;
                /* hilangkan border-radius */
            }
        }

        .dropdown-submenu {
            position: relative;
        }

        /* Submenu muncul ke kanan */
        .dropdown-submenu>.dropdown-menu {
            top: 0;
            left: 100%;
            /* geser ke kanan parent */
            margin-top: -1px;
            display: none;
            opacity: 0;
            visibility: hidden;
            transform: translateX(10px);
            transition: all 0.3s ease;
        }

        /* Saat hover submenu tampil */
        .dropdown-submenu:hover>.dropdown-menu {
            display: block;
            opacity: 1;
            visibility: visible;
            transform: translateX(0);
        }

        #loading-overlay {
            position: fixed;
            /* Membuat overlay tetap di tempatnya saat di-scroll */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            /* Warna putih transparan */
            display: none;
            /* Awalnya disembunyikan */
            justify-content: center;
            /* Pusatkan spinner secara horizontal */
            align-items: center;
            /* Pusatkan spinner secara vertikal */
            z-index: 9999;
            /* Pastikan overlay berada di atas semua elemen lain */
            transition: opacity 0.3s ease;
        }

        /* Gaya untuk spinner (contoh spinner sederhana) */
        .spinner {
            border: 8px solid #f3f3f3;
            /* Light grey */
            border-top: 8px solid #0084ff;
            /* Blue */
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 1s linear infinite;
            /* Animasi berputar */
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Submenu dasar */
        .dropdown-menu1 {
            background-color: #ffffff;
            border: none;
            border-radius: 3px;
            box-shadow: 0px 6px 18px rgba(0, 0, 0, 0.15);
            display: none;
            position: absolute;
            top: 0;
            left: 100%;
            margin-top: -1px;
            min-width: 220px;
            opacity: 0;
            visibility: hidden;
            transform: translateX(10px);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        /* Saat hover parent submenu */
        .dropdown-submenu:hover>.dropdown-menu1 {
            display: block;
            opacity: 1;
            visibility: visible;
            transform: translateX(0);
        }

        /* Item submenu */
        .dropdown-menu1 .dropdown-item {
            color: #0d2d50;
            padding: 10px 16px;
            font-size: 14px;
            transition: all 0.2s ease;
            border-radius: 6px;
        }

        /* Hover effect */
        .dropdown-menu1 .dropdown-item:hover {
            background-color: #0084ff;
            color: #fff;
            transform: translateX(5px);
        }
    </style>
</head>

<script>
    document.addEventListener("scroll", function () {
        const navbar = document.querySelector(".main-nav");
        if (window.scrollY > 50) {
            navbar.classList.add("scrolled");
        } else {
            navbar.classList.remove("scrolled");
        }
    });
</script>


<body>
    <div id="loading-overlay">
        <div class="spinner"></div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Fungsi untuk menampilkan overlay
            function showLoadingOverlay() {
                const overlay = document.getElementById('loading-overlay');
                if (overlay) {
                    overlay.style.display = 'flex';
                }
            }

            // Fungsi untuk menyembunyikan overlay setelah halaman dimuat
            function hideLoadingOverlay() {
                const overlay = document.getElementById('loading-overlay');
                if (overlay) {
                    overlay.style.display = 'none';
                }
            }

            // Tangkap semua link yang mengarah ke halaman lain
            const navLinks = document.querySelectorAll('a[href]:not([href^="#"])');

            navLinks.forEach(link => {
                link.addEventListener('click', function (event) {
                    if (this.href && this.href !== window.location.href) {
                        event.preventDefault(); // cegah pindah halaman langsung
                        showLoadingOverlay();   // tampilkan overlay

                        // delay 3 detik sebelum pindah
                        setTimeout(() => {
                            window.location.href = this.href;
                        }, 1500);
                    }
                });
            });

            // Sembunyikan overlay setelah halaman selesai dimuat
            window.addEventListener('load', hideLoadingOverlay);
            window.addEventListener('pageshow', function (event) {
                if (event.persisted) {
                    hideLoadingOverlay();
                }
            });
        });
    </script>




    <!-- Navbar Utama -->
    <nav class="main-nav navbar navbar-expand-lg">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Logo kiri -->
            <a class="navbar-brand d-flex align-items-center ms-2" href="#">
                 <img src="{{ asset('images/logoPolije.png') }}" alt="Logo" height="40">
                <span class="logo-text ms-2">
                    SATUAN PENGAWAS INTERNAL<br>
                    POLITEKNIK NEGERI JEMBER
                </span>
            </a>

            <!-- Toggler untuk mobile -->
            <button class="navbar-toggler me-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>



            <!-- Menu kanan -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav me-2">
                    <li class="nav-item"><a class="nav-link highlight" href="#">Beranda</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Profil</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Sejarah</a></li>
                            <li><a class="dropdown-item" href="{{ route('visi-misi.index') }}">Visi, Misi, Tujuan</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('struktur.index') }}">Struktur Organisasi</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('profile.spi') }}">Tentang Kami</a></li>
                            <li><a class="dropdown-item" href="{{ route('sdm.index') }}">Sumber Daya Manusia</a></li>
                            <li><a class="dropdown-item" href="{{ route('proses-bisnis-spi') }}">Proses Bisnis SPI</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('search.searchPedomanPengawasan') }}">Kode Etik SPI</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Dokumen Kerja
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('piagam-spi') }}">Piagam SPI</a></li>
                            <!-- Submenu Pedoman Pengawasan -->
                            <li class="dropdown-submenu"><a class="dropdown-item" href="{{ route('pedoman.pengawasan') }}">Pedoman Pengawasan</a></li>
                            <li class="dropdown-submenu"><a class="dropdown-item" href="{{ route('profile.spi') }}">POS AP Pengaawasan</a></li>
                            <li><a class="dropdown-item" href="{{ route('instrumen.pengawasan') }}">Instrumen
                                    Pengawasan</a></li>
                            <li><a class="dropdown-item" href="{{ route('program.kerja') }}">Program Kerja SPI</a></li>
                            <li><a class="dropdown-item" href="{{ route('konsideran-spi') }}">Konsideran SPI</a></li>

                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Manajemen Risiko
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Pedoman MR </a>
                            </li>
                            <li><a class="dropdown-item" href="#">Identifikasi Risiko </a>
                            </li>
                            <li><a class="dropdown-item" href="#">Penilaian , Evaluasi MR dan
                                    Mitigasi</a></li>
                            <li><a class="dropdown-item" href="#">Pelaporan</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Zona integritas
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Manajemen Perubahan </a>
                            </li>
                            <li><a class="dropdown-item" href="#">Penataan Tata Kelola </a>
                            </li>
                            <li><a class="dropdown-item" href="#">Penataan Sistem
                                    Manajemen SDM
                                    dan Aparatur</a></li>
                            <li><a class="dropdown-item" href="#">Penguatan
                                    Akuntabilitas</a></li>
                            <li><a class="dropdown-item" href="#">Penguatan Pengawasaan
                                </a></li>
                            <li><a class="dropdown-item" href="#">Peningkatan Kualitas
                                    Pelayanan Publik</a></li>
                        </ul>
                    </li>
                </ul>

                @guest
                    <!-- Jika belum login -->
                    <a href="{{ route('login') }}" class="nav-link fw-bold text-white ms-2">
                        Login
                    </a>
                @endguest

                @auth
                    <!-- Jika sudah login -->
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-bold text-white ms-2" href="#" id="profileDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            👤 {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        </div>
    </nav>



    <!-- Hero Banner -->
    <section class="hero-banner d-flex align-items-center justify-content-center text-center">
        <div class="hero-text text-white">
            <h1 class="fw-bold display-4">SATUAN PENGAWAS INTERNAL</h1>
            <p class="lead">Politeknik Negeri Jember</p>
            <a href="#tentang-kami" class="scroll-down-btn">
                ⌄
            </a>
        </div>
    </section>

    <style>
        .hero-banner {
            width: 100%;
            height: 100vh;
            /* full layar */
            background: url('https://tender-indonesia.com/newsrectory/events/15(6).png') no-repeat center center;
            background-size: cover;
            background-attachment: fixed;
            /* ini bikin parallax */
            position: relative;
        }

        .hero-banner::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            /* overlay gelap biar teks kontras */
        }


        .hero-banner .hero-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(70%);
            /* agak gelap biar teks kontras */
        }

        .hero-banner .hero-text {
            position: relative;
            z-index: 2;
        }

        .hero-text h1 {
            font-size: 3rem;
            font-weight: 800;
            animation: fadeInDown 1.2s ease-in-out;
        }

        .hero-text p {
            font-size: 1.3rem;
            margin-top: 10px;
            animation: fadeInUp 1.5s ease-in-out;
        }

        .hero-btn {
            margin-top: 30px;
            padding: 12px 35px;
            font-size: 1.1rem;
            border-radius: 50px;
            background: linear-gradient(135deg, #0066ff, #00c3ff);
            border: none;
            color: #fff;
            font-weight: 600;
            transition: all 0.3s;
        }

        .hero-btn:hover {
            transform: translateY(-3px) scale(1.05);
            background: linear-gradient(135deg, #0052cc, #0099ff);
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .scroll-down-btn {
            display: inline-block;
            margin-top: 40px;
            font-size: 40px;
            color: #fff;
            text-decoration: none;
            animation: bounce 1.5s infinite;
            transition: color 0.3s ease;
        }

        .scroll-down-btn:hover {
            color: #0084ff;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(8px);
            }

            60% {
                transform: translateY(4px);
            }
        }

        html {
            scroll-behavior: smooth;
        }
    </style>


    </div>

    <!-- Sekilas Tentang Kami -->
    <section class="py-5 bg-light" id="tentang-kami">
        <div class="container text-center">
            <!-- Judul -->
            <h2 class="fw-bold mb-3">Sekilas Tentang Kami</h2>
            <p class="text-muted mb-5">
                Piagam Audit SPI menetapkan fungsi dan tanggung jawab sebagai berikut
            </p>

            <!-- Isi Card -->
            <div class="row g-4">
                <!-- Card 1 -->
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0 rounded-4 p-4">
                        <div class="mb-3">
                            <img src="https://cdn-icons-png.flaticon.com/512/1041/1041916.png" alt="Ikon 1"
                                class="img-fluid" style="max-height: 80px;">
                        </div>
                        <h4 class="fw-bold">01.</h4>
                        <p class="text-muted">
                            Memberikan penilaian mengenai kecukupan dan efektivitas proses
                            manajemen dalam mengendalikan kegiatannya dan pengelolaan risiko.
                        </p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0 rounded-4 p-4">
                        <div class="mb-3">
                            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Ikon 2"
                                class="img-fluid" style="max-height: 80px;">
                        </div>
                        <h4 class="fw-bold">02.</h4>
                        <p class="text-muted">
                            Melaporkan hal-hal penting terkait proses pengendalian manajemen,
                            termasuk kemungkinan peningkatan pada proses tersebut.
                        </p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0 rounded-4 p-4">
                        <div class="mb-3">
                            <img src="https://cdn-icons-png.flaticon.com/512/1828/1828911.png" alt="Ikon 3"
                                class="img-fluid" style="max-height: 80px;">
                        </div>
                        <h4 class="fw-bold">03.</h4>
                        <p class="text-muted">
                            Memberikan informasi mengenai perkembangan (progress) dan hasil audit,
                            serta kecukupan sumber daya audit tahunan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <style>
        /* Wrapper */
        .search-box {
            max-width: 600px;
            background: #fff;
            border-radius: 50px;
            padding: 5px 10px;
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .search-box:hover {
            box-shadow: 0 10px 18px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        /* Input */
        .search-input {
            border: none;
            box-shadow: none;
            border-radius: 50px;
            padding: 12px 20px;
            font-size: 16px;
        }

        .search-input:focus {
            outline: none;
            box-shadow: none;
        }

        /* Tombol */
        .search-btn {
            background: linear-gradient(135deg, #0066ff, #0099ff);
            border: none;
            color: #fff;
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .search-btn:hover {
            background: linear-gradient(135deg, #0052cc, #0088cc);
            transform: scale(1.05);
        }
    </style>



    <!-- Berita -->
    <div class="container my-5">
        <!-- Judul Section -->
        <div class="text-center mb-5">
            <h2 class="fw-bold display-6">📰 Berita Terbaru</h2>
            <p class="text-muted fs-5">
                Dapatkan informasi terkini seputar kegiatan dan aktivitas
                <span class="fw-semibold text-primary">SPI Politeknik Negeri Jember</span>
            </p>
        </div>

        <!-- Search Bar -->
        <div class="search-wrapper mb-5">
            <form action="{{ route('search') }}" method="GET" class="d-flex justify-content-center">
                <div class="input-group shadow-lg rounded-pill" style="max-width: 600px;">
                    <input type="text" name="q" class="form-control border-0 rounded-start-pill ps-4 py-3"
                        placeholder="🔍 Cari berita, artikel, atau profil..." value="{{ request('q') }}">
                    <button type="submit" class="btn btn-primary rounded-end-pill px-4 fw-bold">
                        Cari
                    </button>
                </div>
            </form>
        </div>

        <!-- Tombol Tambah Berita (hanya admin) -->
        @auth
            @if(Auth::user()->role === 'admin')
                <div class="text-end mb-4">
                    <a href="{{ route('berita.create') }}" class="btn btn-outline-primary rounded-pill shadow-sm px-4 fw-bold">
                        + Tambah Berita
                    </a>
                </div>
            @endif
        @endauth

        <!-- Grid Berita -->
        <div class="row g-4">
            @foreach($beritas as $b)
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-lg rounded-4 overflow-hidden berita-card">
                        <div class="card-img-wrapper">
                            <img src="{{ $b->gambar }}" class="card-img-top" alt="berita"
                                style="height:220px; object-fit:cover;">
                            <div class="overlay">
                                <a href="{{ route('berita.show', $b->id) }}" class="btn btn-light rounded-pill">
                                    Baca Selengkapnya →
                                </a>
                            </div>
                        </div>
                        <div class="card-body d-flex flex-column p-4">
                            <small class="text-muted">{{ $b->tanggal }}</small>
                            <h5 class="fw-bold mt-2">{{ Str::limit($b->judul, 60) }}</h5>
                            <p class="text-muted flex-grow-1">{{ Str::limit($b->isi, 100) }}</p>
                            <a href="{{ route('berita.show', $b->id) }}"
                                class="btn btn-outline-primary btn-sm mt-2 rounded-pill align-self-start">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Tombol Lihat Semua -->
        <div class="text-center mt-5">
            <a href="{{ route('berita.index') }}"
                class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow-lg fw-bold">
                📚 Lihat Semua Berita
            </a>
        </div>
    </div>
    <!-- Styling Custom -->
    <style>
        /* Hover Card */
        .berita-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .berita-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.15);
        }

        /* Overlay Image */
        .card-img-wrapper {
            position: relative;
        }

        .card-img-wrapper .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            opacity: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.3s ease;
        }

        .card-img-wrapper:hover .overlay {
            opacity: 1;
        }

        .overlay .btn {
            font-weight: bold;
        }

        /* Search Input */
        .search-wrapper input:focus {
            box-shadow: none;
            outline: none;
        }
    </style>

    </div>

    <!-- PENGADUAN MASYARAKAT -->
    <section class="report-section py-5 bg-light">
        <div class="container text-center">
            <div class="report-box p-5 rounded-4 shadow-lg text-white"
                style="background: #0d2d50; max-width: 700px; margin: auto; transition: transform 0.3s;">

                <!-- Ikon -->
                <div class="mb-3">
                    <img src="https://cdn-icons-png.flaticon.com/512/564/564619.png" alt="Warning Icon"
                        style="width:80px;">
                </div>

                <!-- Judul -->
                <h2 class="fw-bold mb-3">Pengaduan Masyarakat</h2>

                <!-- Deskripsi -->
                <p class="mb-4">
                    Temukan indikasi pelanggaran? Laporkan segera agar proses pengawasan dapat berjalan dengan tepat dan
                    cepat.
                </p>

                <!-- Tombol untuk masyarakat -->
                <a href="{{ route('pengaduan.create') }}" class="btn btn-lg btn-danger fw-bold px-5 py-3 mb-2"
                    style="border-radius:50px; box-shadow: 0 5px 15px rgba(0,0,0,0.3); transition: all 0.3s;">
                    Laporkan Sekarang!
                </a>

                <!-- Tombol tambahan untuk admin -->
                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('pengaduan.index') }}" class="btn btn-lg btn-primary fw-bold px-5 py-3 mt-2"
                            style="border-radius:50px; box-shadow: 0 5px 15px rgba(0,0,0,0.3); transition: all 0.3s;">
                            Lihat Pengaduan
                        </a>
                    @endif
                @endauth


            </div>
        </div>
    </section>


    <style>
        /* Animasi hover pada box */
        .report-box:hover {
            transform: translateY(-10px);
            background: rgba(0, 0, 0, 0.6);
        }

        /* Animasi hover pada tombol */
        .report-box .btn-danger:hover {
            background-color: #ff4b4b;
            transform: scale(1.05);
        }

        /* Animasi hover pada tombol Lihat Pengaduan */
        .report-box .btn-primary:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
    </style>

    <!-- SURVEY KEPUASAN -->
    <section class="survey-section py-5" id="survey">
        <div class="container">
            <!-- Header -->
            <div class="text-center mb-5">
                <h2 class="fw-bold display-6 text-gradient">📊 Survey Kepuasan</h2>
                <p class="text-muted fs-5">
                    Pendapat Anda sangat berharga untuk peningkatan layanan <br>
                    <span class="fw-semibold text-dark">Satuan Pengawas Internal Politeknik Negeri Jember</span>.
                </p>
            </div>

            <!-- Card Survey -->
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card survey-card border-0 shadow-lg rounded-4">
                        <div class="card-body p-5">
                            @guest
                                <!-- Jika belum login -->
                                <div class="text-center">
                                    <img src="https://cdn-icons-png.flaticon.com/512/747/747376.png" width="100"
                                        class="mb-3 opacity-75">
                                    <p class="fs-5 text-muted mb-4">Anda harus login terlebih dahulu untuk mengisi survey.
                                    </p>
                                    <button class="btn btn-primary px-4 py-2 rounded-pill shadow-sm fw-bold"
                                        data-bs-toggle="modal" data-bs-target="#loginModal">
                                        <i class="bi bi-box-arrow-in-right me-2"></i> Isi Survey
                                    </button>
                                </div>
                            @endguest

                            @auth
                                <!-- Jika sudah login -->
                                <form action="{{ route('survey.store') }}" method="POST" class="animate-fade">
                                    @csrf
                                    <!-- Pertanyaan 1 -->
                                    <div class="mb-4">
                                        <label class="form-label fw-bold fs-5 mb-2">
                                            Bagaimana tingkat kepuasan Anda terhadap layanan SPI?
                                        </label>
                                        <select name="kepuasan" class="form-select form-select-lg shadow-sm rounded-pill"
                                            required>
                                            <option value="">-- Pilih Jawaban --</option>
                                            <option value="Sangat Puas">🌟 Sangat Puas</option>
                                            <option value="Puas">😊 Puas</option>
                                            <option value="Cukup Puas">😐 Cukup Puas</option>
                                            <option value="Kurang Puas">🙁 Kurang Puas</option>
                                        </select>
                                    </div>

                                    <!-- Pertanyaan 2 -->
                                    <div class="mb-4">
                                        <label class="form-label fw-bold fs-5 mb-2">Saran atau masukan Anda</label>
                                        <textarea name="saran" rows="4" class="form-control shadow-sm rounded-4"
                                            placeholder="✍️ Tuliskan saran Anda di sini..."></textarea>
                                    </div>

                                    <!-- Tombol Kirim -->
                                    <div class="text-center">
                                        <button type="submit"
                                            class="btn btn-gradient btn-lg px-5 py-2 rounded-pill shadow fw-bold">
                                            <i class="bi bi-send-fill me-2"></i> Kirim Survey
                                        </button>
                                    </div>
                                </form>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Login -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold text-primary" id="loginModalLabel">🔒 Login Diperlukan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <p class="text-muted mb-4">Silakan login terlebih dahulu untuk mengisi survey kepuasan.</p>
                    <a href="{{ route('login') }}" class="btn btn-gradient px-4 py-2 rounded-pill">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Login Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Terima Kasih -->
    <div class="modal fade" id="thankYouModal" tabindex="-1" aria-labelledby="thankYouLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 shadow text-center p-4">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold text-success" id="thankYouLabel">🎉 Terima Kasih!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="fs-5">Survey Anda sudah terkirim. Pendapat Anda sangat berharga bagi kami 🙏</p>
                    <button type="button" class="btn btn-gradient px-4 py-2 rounded-pill" data-bs-dismiss="modal">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk modal sukses -->
    @if(session('survey_success'))
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var thankYouModal = new bootstrap.Modal(document.getElementById('thankYouModal'));
                thankYouModal.show();
            });
        </script>
    @endif

    <!-- Custom CSS -->
    <style>
        .text-gradient {
            background: linear-gradient(45deg, #0d6efd, #20c997);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .survey-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .survey-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .btn-gradient {
            background: linear-gradient(45deg, #0d6efd, #20c997);
            color: white;
            border: none;
        }

        .btn-gradient:hover {
            opacity: 0.9;
            color: #fff;
        }

        .animate-fade {
            animation: fadeInUp 0.6s ease-in-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>




    <!-- Footer -->
    <footer class="text-center text-white py-4" style="background-color: #0d2d50;">
        <div class="container">
            <!-- Logo -->
            <img src="{{ asset('images/logoPolije.webp') }}" alt="Logo Polije" class="mb-3" style="max-height: 80px;">

            <!-- Alamat -->
            <p>
                Satuan Pengawas Internal Politeknik Negeri Jember <br>logo
                Jl. Mastrip PO BOX 164, Jember - Jawa Timur, Indonesia
            </p>

            <!-- Kontak -->
            <p>
                <a href="mailto:politeknik@polije.ac.id" class="text-white text-decoration-none">
                    politeknik@polije.ac.id
                </a> | +62331333533, +62331333531
            </p>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<!--
 commit baru:

git add .
git commit -m "pesan commit"
git push
php -S localhost:8000
-->