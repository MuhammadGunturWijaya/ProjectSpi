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
    <title>SPI Polije - Satuan Pengawas Internal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #BC0016;
            --dark: #1c2833;
            --light: #f8f9fa;
            --gradient: linear-gradient(135deg, #BC0016 0%, #650c16 100%);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        /* Loading Overlay */
        #loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.95);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.3s ease;
        }

        .spinner {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #BC0016;
            border-radius: 50%;
            width: 70px;
            height: 70px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Navbar */
        .main-nav {
            /* background: rgba(28, 40, 51, 0.95); */
            /* backdrop-filter: blur(10px); */
            padding: 0.8rem 0;
            transition: all 0.4s ease;
            /* box-shadow: 0 2px 20px rgba(0,0,0,0.1); */
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .main-nav.scrolled {
            background: rgba(188, 0, 22, 0.95);
            padding: 0.5rem 0;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-text {
            color: white;
            font-size: 13px;
            line-height: 1.3;
            font-weight: 600;
        }

        .nav-link {
            color: white !important;
            position: relative;
            padding: 0.5rem 1rem !important;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--secondary);
            transform: translateX(-50%);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 80%;
        }

        .highlight {
            color: var(--secondary) !important;
            font-weight: 600;
        }

        /* Dropdown Menu */
        .dropdown-menu {
            background-color: #ffffff;
            border: none;
            border-radius: 12px;
            box-shadow: 0px 8px 24px rgba(0, 0, 0, 0.15);
            opacity: 0;
            transform: translateY(10px);
            visibility: hidden;
            transition: all 0.3s ease;
            padding: 12px 0;
            min-width: 240px;
        }

        .dropdown-menu.show {
            opacity: 1;
            transform: translateY(0);
            visibility: visible;
        }

        .dropdown-menu .dropdown-item {
            color: #0d2d50;
            padding: 12px 20px;
            font-size: 14px;
            transition: all 0.2s ease;
            border-radius: 8px;
            margin: 2px 8px;
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: var(--primary);
            color: #fff;
            transform: translateX(5px);
        }

        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
            opacity: 1;
            transform: translateY(0);
            visibility: visible;
        }

        /* Dropdown Submenu */
        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu>.dropdown-menu1 {
            background-color: #ffffff;
            border: none;
            border-radius: 12px;
            box-shadow: 0px 8px 24px rgba(0, 0, 0, 0.15);
            display: none;
            position: absolute;
            top: 0;
            left: 100%;
            margin-left: 5px;
            min-width: 220px;
            opacity: 0;
            visibility: hidden;
            transform: translateX(10px);
            transition: all 0.3s ease;
        }

        .dropdown-submenu:hover>.dropdown-menu1 {
            display: block;
            opacity: 1;
            visibility: visible;
            transform: translateX(0);
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            height: 100vh;
            background: linear-gradient(135deg, rgba(28, 40, 51, 0.85), rgba(82, 27, 27, 0.75)),
                url('https://tender-indonesia.com/newsrectory/events/15(6).png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 50% 50%, transparent 0%, rgba(0, 0, 0, 0.3) 100%);
        }

        .hero-content {
            text-align: center;
            z-index: 2;
            animation: fadeInUp 1s ease;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 1rem;
            text-shadow: 3px 3px 20px rgba(0, 0, 0, 0.4);
            animation: slideInDown 1s ease;
            letter-spacing: 1px;
        }

        .hero-subtitle {
            font-size: 1.8rem;
            margin-bottom: 2.5rem;
            opacity: 0.95;
            animation: slideInUp 1s ease 0.3s both;
            font-weight: 300;
            letter-spacing: 0.5px;
        }

        .scroll-down-btn {
            display: inline-block;
            margin-top: 30px;
            font-size: 40px;
            color: #fff;
            text-decoration: none;
            animation: bounce 2s infinite;
            transition: color 0.3s ease;
        }

        .scroll-down-btn:hover {
            color: var(--secondary);
        }

        /* Quick Access Cards */
        .quick-access {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 30px;
            z-index: 10;
            flex-wrap: wrap;
            justify-content: center;
            max-width: 90%;
        }

        .quick-card {
            background: white;
            padding: 35px 25px;
            border-radius: 20px;
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.15);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            cursor: pointer;
            text-align: center;
            min-width: 160px;
            text-decoration: none;
        }

        .quick-card:hover {
            transform: translateY(-20px) scale(1.05);
        }

        .quick-card i {
            font-size: 3.5rem;
            color: var(--primary);
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }

        .quick-card:hover i {
            transform: scale(1.2) rotate(5deg);
            color: var(--secondary);
        }

        .quick-card h4 {
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--dark);
            margin: 0;
        }

        /* Carousel Section */
        .carousel-section {
            padding: 80px 0 80px;
            background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);
            margin-top: 100px;
        }

        .carousel-img {
            max-height: 500px;
            object-fit: cover;
            border-radius: 20px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
        }

        /* Stats Section */
        .stats-section {
            padding: 80px 0;
            background: white;
        }

        .stat-card {
            text-align: center;
            padding: 40px 20px;
            border-radius: 20px;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            margin-bottom: 30px;
            border: 2px solid transparent;
        }

        .stat-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(188, 0, 22, 0.15);
            border-color: var(--primary);
        }

        .stat-number {
            font-size: 3.5rem;
            font-weight: 800;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
        }

        .stat-label {
            font-size: 1.1rem;
            color: #666;
            font-weight: 600;
        }

        /* News Section */
        .news-section {
            padding: 80px 0;
            background: linear-gradient(180deg, #ffffff 0%, #f8f9fa 100%);
        }

        .section-title {
            font-size: 2.8rem;
            font-weight: 800;
            text-align: center;
            margin-bottom: 1rem;
            color: var(--dark);
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: var(--gradient);
            border-radius: 2px;
        }

        .search-wrapper {
            margin: 40px 0;
        }

        .search-box {
            max-width: 700px;
            margin: 0 auto;
        }

        .search-input {
            border: 2px solid #e0e0e0;
            border-radius: 50px;
            padding: 15px 25px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(188, 0, 22, 0.1);
            outline: none;
        }

        .search-btn {
            background: var(--gradient);
            border: none;
            color: white;
            padding: 15px 35px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-left: -50px;
        }

        .search-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 25px rgba(188, 0, 22, 0.3);
        }

        .news-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
            height: 100%;
            text-decoration: none;
            display: block;
        }

        .news-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.15);
        }

        .news-img-wrapper {
            position: relative;
            overflow: hidden;
            height: 250px;
        }

        .news-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .news-card:hover .news-img {
            transform: scale(1.15);
        }

        .news-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, transparent 0%, rgba(0, 0, 0, 0.7) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .news-card:hover .news-overlay {
            opacity: 1;
        }

        .news-content {
            padding: 30px;
        }

        .news-date {
            color: var(--primary);
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .news-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 15px;
            line-height: 1.4;
        }

        .news-excerpt {
            color: #666;
            margin-bottom: 20px;
            line-height: 1.7;
        }

        .btn-read-more {
            background: var(--gradient);
            color: white;
            padding: 12px 28px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
            border: none;
        }

        .btn-read-more:hover {
            transform: scale(1.05);
            color: white;
            box-shadow: 0 10px 25px rgba(188, 0, 22, 0.3);
        }

        /* Report Section */
        .report-section {
            padding: 100px 0;
            background: linear-gradient(135deg, rgba(188, 0, 22, 0.95), rgba(101, 12, 22, 0.95)),
                url('https://polije.ac.id/wp-content/uploads/2021/09/Polije-scaled.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: white;
            text-align: center;
            position: relative;
        }

        .report-content {
            position: relative;
            z-index: 2;
        }

        .report-icon {
            font-size: 5rem;
            margin-bottom: 30px;
            animation: bounce 2s infinite;
        }

        .report-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 20px;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
        }

        .report-text {
            font-size: 1.3rem;
            margin-bottom: 40px;
            opacity: 0.95;
        }

        .btn-report {
            background: white;
            color: var(--primary);
            padding: 18px 50px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.2rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }

        .btn-report:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, #1c2833 0%, #0d2d50 100%);
            color: white;
            padding: 60px 0 30px;
        }

        .footer-logo {
            max-height: 100px;
            margin-bottom: 20px;
        }

        .footer-section h4 {
            font-weight: 700;
            margin-bottom: 20px;
            font-size: 1.3rem;
            color: white;
        }

        .footer-link {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
            transition: all 0.3s ease;
        }

        .footer-link:hover {
            color: white;
            padding-left: 10px;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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
                transform: translateY(-20px);
            }

            60% {
                transform: translateY(-10px);
            }
        }

        /* Scroll Animation */
        .scroll-animate {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease;
        }

        .scroll-animate.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.2rem;
            }

            .quick-access {
                flex-direction: column;
                gap: 15px;
                bottom: -280px;
                padding: 0 20px;
            }

            .quick-card {
                width: 100%;
            }

            .carousel-section {
                padding: 50px 0 50px;
                margin-top: 320px;
            }

            .section-title {
                font-size: 2rem;
            }

            .report-title {
                font-size: 2rem;
            }

            .carousel-img {
                max-height: 300px;
            }
        }

        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body>
    <!-- Loading Overlay -->
    <div id="loading-overlay">
        <div class="spinner"></div>
    </div>

    <!-- Navbar -->
    <nav class="main-nav navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/logoPolije.png') }}" alt="Logo" height="50">
                <img src="{{ asset('images/logo/blu.png') }}" alt="Logo" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                style="background: white;">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link highlight" style="color: white !important;" href="#">Beranda</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Profil</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('spi.sejarah') }}">Sejarah</a></li>
                            <li><a class="dropdown-item" href="{{ route('visi-misi.index') }}">Visi, Misi, Tujuan</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('struktur.index') }}">Struktur Organisasi</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('sdm.index') }}">Sumber Daya Manusia</a></li>
                            <li><a class="dropdown-item" href="{{ route('proses-bisnis-spi') }}">Proses Bisnis SPI</a>
                            </li>
                            <!-- <li><a class="dropdown-item" href="{{ route('search.searchPedomanPengawasan') }}">Kode Etik
                                    SPI</a></li> -->
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Dokumen Kerja</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('piagam.index') }}">Piagam SPI</a></li>
                            <li><a class="dropdown-item" href="{{ route('pedoman.pengawasan') }}">Pedoman Pengawasan</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('posAp.index') }}">POS AP Pengawasan</a></li>
                            <li><a class="dropdown-item" href="{{ route('instrumen.index') }}">Instrumen Pengawasan</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('programKerja.index') }}">Program Kerja SPI</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('konsideran.index') }}">Konsideran SPI</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Manajemen Risiko</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('pedomanmr.index') }}">Pedoman MR</a></li>
                            <li><a class="dropdown-item" href="{{ route('identifikasi.risiko.index') }}">Identifikasi
                                    Risiko</a></li>
                            <li><a class="dropdown-item" href="{{ route('evaluasiMr.index') }}">Penilaian, Evaluasi MR
                                    dan Mitigasi</a></li>
                            <!-- <li><a class="dropdown-item" href="{{ route('pengaduan.create') }}">Pelaporan</a></li> -->
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Zona Integritas</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('perubahan.index') }}">Manajemen Perubahan</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('penataan.index') }}">Penataan Tata Kelola</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('penataanSistem.index') }}">Penataan Sistem
                                    Manajemen SDM</a></li>
                            <li><a class="dropdown-item" href="{{ route('penguatanAkuntabilitas.index') }}">Penguatan
                                    Akuntabilitas</a></li>
                            <li><a class="dropdown-item" href="{{ route('penguatanPengawasan.index') }}">Penguatan
                                    Pengawasan</a></li>
                            <li><a class="dropdown-item" href="{{ route('peningkatanKualitas.index') }}">Peningkatan
                                    Kualitas Pelayanan Publik</a></li>
                            <li><a class="dropdown-item" href="{{ route('survey.kepuasan') }}">Survey Kepuasan</a></li>
                        </ul>
                    </li>
                </ul>

                @guest
                    <a href="{{ route('login') }}" class="nav-link fw-bold text-white ms-2">Login</a>
                @endguest

                @auth
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-bold text-white ms-2" href="#" data-bs-toggle="dropdown">
                            👤 {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a href="{{ route('profile.show') }}" class="dropdown-item"><i
                                        class="bi bi-person-fill me-2"></i> Profil Saya</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right me-2"></i>
                                        Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="hero-section" style="position: relative;">
        <div class="hero-content">
            <h1 class="hero-title">SATUAN PENGAWAS INTERNAL</h1>
            <p class="hero-subtitle">
                <span style="font-size: 2.2rem; font-weight: 400; color: #ffffffff;">
                    Politeknik Negeri Jember
                </span>
            </p>
            <a href="#carousel" class="scroll-down-btn">⌄</a>
        </div>

        <!-- Quick Access -->
        <div class="quick-access">
            <a href="#BeritaTerbaru" class="quick-card">
                <img src="{{ asset('images/logo/news.png') }}" alt="Berita" class="news-img1">
                <h4 style="color: white;"> Berita</h4>
            </a>

            <a href="#PengaduanMasyarakat" class="quick-card">
                <img src="{{ asset('images/logo/megaphone.png') }}" alt="Berita" class="news-img1">
                <h4 style="color: white;"> Pengaduan </h4>
                <h4 style="color: white;"> Lapor Di Sini</h4>
            </a>

            <a href="#PengaduanMasyarakat" class="quick-card">
                <img src="{{ asset('images/logo/laporan.png') }}" alt="Berita" class="news-img1">
                <h4 style="color: white;"> Aspirasi / Kritik </h4>
                <h4 style="color: white;"> Klik Disini</h4>
            </a>

            <!-- {{ route('survey.kepuasan') }} -->
            <a href="#PenilaianMasyarakat" class="quick-card">
                <img src="{{ asset('images/logo/survey2.png') }}" alt="Berita" class="news-img1">
                <h4 style="color: white;"> Survey Kepuasan Masyarakat</h4>
                <h4 style="color: white;"> Klik Disini</h4>
            </a>
        </div>

        <!-- Stat Card (Tingkat Kepuasan) -->
        <div class="stat-card2">
            <i class="bi bi-star-fill"></i>
            <div class="stat-info">
                <h3>{{ $ikm }}%</h3>
                <p>Tingkat Kepuasan Hari Ini</p>
            </div>
        </div>

        <style>
            .quick-card {
                display: flex;
                flex-direction: column;
                align-items: center;
                text-decoration: none;
                color: inherit;
                background: transparent;
                box-shadow: none;
            }

            .news-img1 {
                width: 100px;
                height: 100px;
                object-fit: contain;
                border-radius: 10px;
                margin-bottom: 10px;
                background: transparent;
            }

            .stat-card2 {
                position: absolute;
                bottom: 20px;
                /* jarak dari bawah */
                right: 20px;
                /* jarak dari kanan */
                background: rgba(0, 0, 0, 0.6);
                color: white;
                padding: 15px 20px;
                border-radius: 10px;
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .stat-card2 i {
                font-size: 2rem;
                color: gold;
            }
        </style>
    </section>

    <!-- Carousel Section -->
    <section id="carousel" class="carousel-section">
        <div class="container">
            <div id="tentangKamiCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://tse3.mm.bing.net/th/id/OIP.IHBoHa-ktdGJkEIvMgv0YwHaE7?o=7rm=3&rs=1&pid=ImgDetMain"
                            class="d-block w-100 carousel-img" alt="Banner 1">
                    </div>
                    <div class="carousel-item">
                        <img src="https://img-s-msn-com.akamaized.net/tenant/amp/entityid/AA1I4jGQ.img?w=768&h=512&m=6"
                            class="d-block w-100 carousel-img" alt="Banner 2">
                    </div>
                    <div class="carousel-item">
                        <img src="https://img-s-msn-com.akamaized.net/tenant/amp/entityid/AA1NpXMJ.img?w=768&h=514&m=6"
                            class="d-block w-100 carousel-img" alt="Banner 3">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#tentangKamiCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#tentangKamiCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#tentangKamiCarousel" data-bs-slide-to="0"
                        class="active"></button>
                    <button type="button" data-bs-target="#tentangKamiCarousel" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#tentangKamiCarousel" data-bs-slide-to="2"></button>
                </div>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section id="berita" class="news-section">
        <div class="container">
            <div class="text-center mb-5" id="BeritaTerbaru">
                <h2 class="section-title">📰 Berita Terbaru</h2>
                <p class="mt-4 text-muted" style="font-size: 1.50rem;">
                    Dapatkan informasi terkini seputar kegiatan dan aktivitas <span class="fw-semibold text-primary">SPI
                        Politeknik Negeri Jember</span>
                </p>
            </div>

            <!-- Tombol Tambah Berita (Admin Only) -->
            @auth
                @if(Auth::user()->role === 'admin')
                    <div class="text-end mb-4">
                        <a href="{{ route('admin.berita.create') }}" class="btn btn-read-more">
                            <i class="bi bi-plus-circle me-2"></i>Tambah Berita
                        </a>
                    </div>
                @endif
            @endauth

            <!-- News Grid -->
            <div class="row mt-5">
                @foreach($beritas as $b)
                    <div class="col-md-4 mb-4">
                        <div class="news-card scroll-animate">
                            <div class="news-img-wrapper">
                                <img src="{{ $b->gambar }}" class="news-img" alt="{{ $b->judul }}">
                                <div class="news-overlay"></div>
                            </div>
                            <div class="news-content">
                                <div class="news-date">
                                    <i class="bi bi-calendar3"></i>
                                    {{ $b->tanggal }}
                                </div>
                                <h3 class="news-title">{{ Str::limit($b->judul, 60) }}</h3>
                                <p class="news-excerpt">{{ Str::limit($b->isi, 100) }}</p>
                                <a href="{{ route('berita.show', $b->id) }}" class="btn-read-more">
                                    Baca Selengkapnya <i class="bi bi-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- View All Button -->
            <div class="text-center mt-5">
                <a href="{{ route('berita.index') }}" class="btn-report"
                    style="background: var(--gradient); color: white;">
                    <i class="bi bi-collection me-2"></i>Lihat Semua Berita
                </a>
            </div>
        </div>
    </section>

    <!-- Report Section -->
    <section class="report-section" id="PengaduanMasyarakat">
        <div class="report-content">
            <div class="report-icon">
                <i class="bi bi-megaphone-fill"></i>
            </div>
            <h2 class="report-title">Pengaduan Masyarakat</h2>
            <p class="report-text">
                Temukan indikasi pelanggaran? Laporkan segera agar proses pengawasan dapat berjalan dengan tepat dan
                cepat.<br>
                <strong>Identitas Anda dijamin kerahasiaannya ✅</strong>
            </p>

            @auth
                <a href="{{ route('pengaduan.create') }}" class="btn-report">
                    <i class="bi bi-send-fill me-2"></i>Laporkan Sekarang!
                </a>
            @else
                <button class="btn-report" data-bs-toggle="modal" data-bs-target="#laporModal">
                    <i class="bi bi-send-fill me-2"></i>Laporkan Sekarang!
                </button>
            @endauth

            @if(Auth::user()?->role === 'admin')
                <a href="{{ route('pengaduan.index') }}" class="btn-report ms-3"
                    style="background: white; color: var(--primary);">
                    <i class="bi bi-list-check me-2"></i>Lihat Pengaduan
                </a>
            @endif
        </div>
    </section>

    <!-- Modal Laporan -->
    <div class="modal fade" id="laporModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden;">
                <div class="modal-header text-white"
                    style="background: linear-gradient(135deg, #ff4d4f, #ff7a45); border: none;">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-exclamation-triangle-fill fs-2 me-3"></i>
                        <h5 class="modal-title fw-bold">Pilih Opsi Pelaporan 🚨</h5>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-5 bg-light">
                    <h4 class="mb-3 text-dark fw-semibold text-center">Bagaimana Anda ingin melaporkan?</h4>
                    <p class="text-muted text-center mb-5">Identitas Anda sebagai pelapor atau terlapor dijamin
                        kerahasiaannya ✅</p>

                    <div class="d-grid gap-4">
                        <div class="p-4 border rounded-4 bg-white shadow-sm text-start"
                            style="transition: all 0.3s ease;">
                            <div class="text-danger mb-3">
                                <i class="bi bi-eye-slash-fill fs-1"></i>
                            </div>
                            <a href="{{ route('pengaduan.createGuest') }}"
                                class="btn btn-danger btn-lg w-100 fw-bold py-3 mb-2" style="border-radius: 50px;">
                                <i class="bi bi-mask-fill me-2"></i> Lapor Sebagai Tamu (Anonim)
                            </a>
                            <p class="text-muted small m-0 px-3">
                                ✅ Cepat dan Rahasia, Tidak memerlukan akun.<br>
                            </p>
                        </div>

                        <div class="p-4 border rounded-4 bg-white shadow-sm text-start"
                            style="transition: all 0.3s ease;">
                            <div class="text-success mb-3">
                                <i class="bi bi-shield-lock-fill fs-1"></i>
                            </div>
                            <a href="{{ route('login') }}" class="btn btn-success btn-lg w-100 fw-bold py-3 mb-2"
                                style="border-radius: 50px;">
                                <i class="bi bi-person-check-fill me-2"></i> Lapor Dengan Akun
                            </a>
                            <p class="text-muted small m-0 px-3">
                                ✅ Dapat menelusuri status laporan dengan akun.<br>
                                🔒 Privasi Anda tetap dijaga, laporan diprioritaskan.
                            </p>
                        </div>

                        <a href="{{ route('register') }}"
                            class="btn btn-link fw-bold text-primary mt-3 py-3 border-top text-decoration-none">
                            <i class="bi bi-person-plus-fill me-2"></i> Belum punya akun? <strong>Daftar
                                sekarang!</strong>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Survey Kepuasan Section -->
    <section class="survey-section" id="PenilaianMasyarakat">
        <div class="survey-overlay"></div>

        <div class="survey-container">
            <div class="survey-content">
                <div class="survey-icon">
                    <i class="bi bi-clipboard-heart"></i>
                </div>

                <h2 class="survey-title">Survey Kepuasan Masyarakat</h2>
                <p class="survey-subtitle">
                    Kami menghargai setiap umpan balik Anda ❤️ <br />
                    <span class="highlight">Bantu kami meningkatkan kualitas layanan SPI Polije.</span>
                </p>

                <a href="{{ route('survey.kepuasan') }}" class="btn-survey">
                    <i class="bi bi-send-fill me-2"></i> Ikuti Survey Sekarang
                </a>

                <div class="survey-stats">
                    <div class="stat-card">
                        <i class="bi bi-people-fill"></i>
                        <div class="stat-info">
                            <h3>{{ $totalRespondents }}</h3>
                            <p>Responden Tahun Ini</p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <i class="bi bi-star-fill"></i>
                        <div class="stat-info">
                            <h3>{{ $ikm }}%</h3>
                            <p>Tingkat Kepuasan Hari Ini</p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <i class="bi bi-shield-check"></i>
                        <div class="stat-info">
                            <h3>100%</h3>
                            <p>Data Aman & Rahasia</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* ======= Survey Section ======= */
        .survey-section {
            position: relative;
            background: url('https://polije.ac.id/wp-content/uploads/2021/09/Polije-scaled.jpg') center/cover no-repeat;
            background-attachment: fixed;
            color: white;
            padding: 120px 0;
            overflow: hidden;
        }

        .survey-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(0, 100, 255, 0.75), rgba(0, 0, 120, 0.85));
            backdrop-filter: blur(6px);
        }

        .survey-container {
            position: relative;
            z-index: 2;
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
            padding: 0 20px;
            animation: fadeInUp 1.2s ease forwards;
        }

        /* ======= Icon & Title ======= */
        .survey-icon {
            font-size: 6rem;
            margin-bottom: 20px;
            color: #ffffff;
            animation: bounce 2s infinite;
        }

        .survey-subtitle .highlight {
            color: #ffffff !important;
            /* paksa putih */
            font-weight: 600;
            text-shadow: 0 0 8px rgba(255, 255, 255, 0.5);
            /* opsional: efek glow halus */
        }


        .survey-title {
            font-size: 3rem;
            font-weight: 800;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            margin-bottom: 15px;
        }

        .survey-subtitle {
            font-size: 1.3rem;
            opacity: 0.9;
            margin-bottom: 45px;
        }

        .survey-subtitle .highlight {
            color: #ffeb3b;
            font-weight: 600;
        }

        /* ======= Button ======= */
        .btn-survey {
            background: linear-gradient(90deg, #fff, #e0f3ff);
            color: #0056d2;
            padding: 16px 45px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.1rem;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.4s ease;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }

        .btn-survey:hover {
            transform: translateY(-6px);
            background: linear-gradient(90deg, #e0f3ff, #ffffff);
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.4);
        }

        /* ======= Stats Cards ======= */
        .survey-stats {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 70px;
            flex-wrap: wrap;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.25);
            padding: 25px 35px;
            border-radius: 20px;
            backdrop-filter: blur(12px);
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.25);
            text-align: center;
            width: 220px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-8px) scale(1.03);
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.4);
        }

        .stat-card i {
            font-size: 2.2rem;
            margin-bottom: 12px;
            color: #ffd700;
        }

        .stat-info h3 {
            font-size: 1.5rem;
            font-weight: 800;
            margin: 0;
        }

        .stat-info p {
            font-size: 0.95rem;
            opacity: 0.85;
            margin: 5px 0 0;
        }

        /* ======= Animations ======= */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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
                transform: translateY(-20px);
            }

            60% {
                transform: translateY(-10px);
            }
        }

        /* ======= Responsive ======= */
        @media (max-width: 768px) {
            .survey-title {
                font-size: 2.2rem;
            }

            .survey-subtitle {
                font-size: 1.1rem;
            }

            .btn-survey {
                padding: 14px 35px;
                font-size: 1rem;
            }

            .stat-card {
                width: 90%;
            }
        }
    </style>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <img src="{{ asset('images/logoPolije.png') }}" alt="Logo Polije" class="footer-logo">
                    <p class="mt-3">Satuan Pengawas Internal Politeknik Negeri Jember berkomitmen untuk menjaga
                        integritas dan akuntabilitas institusi melalui pengawasan yang profesional dan independen.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="footer-section">
                        <h4>Tautan Cepat</h4>
                        <a href="{{ route('sejarah') }}" class="footer-link">Sejarah</a>
                        <a href="{{ route('visi-misi.index') }}" class="footer-link">Visi & Misi</a>
                        <a href="{{ route('struktur.index') }}" class="footer-link">Struktur Organisasi</a>
                        <a href="{{ route('sdm.index') }}" class="footer-link">SDM</a>
                        <a href="{{ route('piagam.index') }}" class="footer-link">Piagam SPI</a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="footer-section">
                        <h4>Kontak Kami</h4>
                        <p><i class="bi bi-geo-alt-fill me-2" style="color: var(--secondary);"></i>Jl. Mastrip PO BOX
                            164<br>Jember, Jawa Timur, Indonesia</p>
                        <p><i class="bi bi-envelope-fill me-2" style="color: var(--secondary);"></i>
                            <a href="mailto:politeknik@polije.ac.id"
                                class="text-white text-decoration-none">politeknik@polije.ac.id</a>
                        </p>
                        <p><i class="bi bi-telephone-fill me-2" style="color: var(--secondary);"></i>+62 331 333533</p>
                        <p><i class="bi bi-telephone-fill me-2" style="color: var(--secondary);"></i>+62 331 333531</p>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4 pt-4" style="border-top: 1px solid rgba(255,255,255,0.1);">
                <p class="mb-0" style="color: rgba(255,255,255,0.7);">© 2025 Satuan Pengawas Internal - Politeknik
                    Negeri Jember. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar scroll effect
        document.addEventListener("scroll", function () {
            const navbar = document.querySelector(".main-nav");
            if (window.scrollY > 50) {
                navbar.classList.add("scrolled");
            } else {
                navbar.classList.remove("scrolled");
            }
        });

        // Loading overlay
        document.addEventListener("DOMContentLoaded", function () {
            function showLoadingOverlay() {
                const overlay = document.getElementById('loading-overlay');
                if (overlay) {
                    overlay.style.display = 'flex';
                }
            }

            function hideLoadingOverlay() {
                const overlay = document.getElementById('loading-overlay');
                if (overlay) {
                    overlay.style.display = 'none';
                }
            }

            const navLinks = document.querySelectorAll('a[href]:not([href^="#"])');
            navLinks.forEach(link => {
                link.addEventListener('click', function (event) {
                    if (this.href && this.href !== window.location.href) {
                        event.preventDefault();
                        showLoadingOverlay();
                        setTimeout(() => {
                            window.location.href = this.href;
                        }, 1500);
                    }
                });
            });

            window.addEventListener('load', hideLoadingOverlay);
            window.addEventListener('pageshow', function (event) {
                if (event.persisted) {
                    hideLoadingOverlay();
                }
            });
        });

        // Scroll animation
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.scroll-animate').forEach(element => {
            observer.observe(element);
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>

</html>