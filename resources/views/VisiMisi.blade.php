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
    <title>Visi, Misi, dan Tujuan SPI POLIJE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #0d2d50;
            --primary-light: #1a4d7a;
            --primary-dark: #051f35;
            --accent: #00d4ff;
            --accent-2: #ff6b9d;
            --accent-3: #ffa502;
            --text-dark: #1a1a1a;
            --text-light: #666;
            --bg-light: #f8f9fb;
            --white: #ffffff;
        }

        body {
            background: linear-gradient(135deg, #0f0f1e 0%, #1a1a2e 50%, #16213e 100%);
            font-family: 'Inter', 'Segoe UI', sans-serif;
            color: var(--text-dark);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ===== NAVBAR ===== */
        .navbar-custom {
            background: rgba(13, 45, 80, 0.95);
            backdrop-filter: blur(10px);
            padding: 1.2rem 0;
            border-bottom: 1px solid rgba(0, 212, 255, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .navbar-custom .navbar-brand {
            font-weight: 800;
            font-size: 1.6rem;
            background: linear-gradient(135deg, #00d4ff 0%, #0099ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: 1px;
        }

        .navbar-custom .navbar-brand i {
            margin-right: 12px;
            font-size: 1.8rem;
        }

        /* ===== HERO SECTION ===== */
        .hero {
            position: relative;
            padding: 100px 20px;
            overflow: hidden;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 50%, #2a6ba8 100%);
            min-height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(0, 212, 255, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 8s ease-in-out infinite;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -5%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255, 107, 157, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 10s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(40px) rotate(5deg);
            }
        }

        .hero-grid {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.05;
            background-image:
                linear-gradient(0deg, transparent 24%, rgba(255, 255, 255, 0.1) 25%, rgba(255, 255, 255, 0.1) 26%, transparent 27%, transparent 74%, rgba(255, 255, 255, 0.1) 75%, rgba(255, 255, 255, 0.1) 76%, transparent 77%, transparent),
                linear-gradient(90deg, transparent 24%, rgba(255, 255, 255, 0.1) 25%, rgba(255, 255, 255, 0.1) 26%, transparent 27%, transparent 74%, rgba(255, 255, 255, 0.1) 75%, rgba(255, 255, 255, 0.1) 76%, transparent 77%, transparent);
            background-size: 50px 50px;
            pointer-events: none;
        }

        .hero-content {
            position: relative;
            z-index: 10;
            text-align: center;
            color: white;
            max-width: 900px;
        }

        .hero-content h1 {
            font-size: 4rem;
            font-weight: 900;
            margin-bottom: 20px;
            line-height: 1.1;
            text-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            animation: slideInDown 0.8s ease;
        }

        .hero-content .subtitle {
            font-size: 1.3rem;
            opacity: 0.95;
            font-weight: 300;
            margin-bottom: 30px;
            animation: slideInUp 0.8s ease 0.2s both;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(0, 212, 255, 0.2);
            border: 1px solid rgba(0, 212, 255, 0.4);
            color: #00d4ff;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 20px;
            animation: slideInUp 0.8s ease 0.1s both;
            backdrop-filter: blur(10px);
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

        /* ===== MAIN CONTENT ===== */
        .main-wrapper {
            position: relative;
            z-index: 5;
        }

        .container-custom {
            max-width: 1200px;
            margin: -80px auto 0;
            padding: 0 20px;
            position: relative;
            z-index: 5;
        }

        /* ===== BREADCRUMB ===== */
        .breadcrumb-custom {
            background: transparent;
            padding: 0;
            margin-bottom: 40px;
        }

        .breadcrumb-custom .breadcrumb-item a,
        .breadcrumb-custom .breadcrumb-item.active {
            color: var(--text-light);
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .breadcrumb-custom .breadcrumb-item a:hover {
            color: var(--accent);
        }

        .breadcrumb-custom .breadcrumb-item.active {
            color: var(--primary);
            font-weight: 600;
        }

        /* ===== META INFO ===== */
        .meta-info {
            display: flex;
            gap: 30px;
            margin-bottom: 50px;
            flex-wrap: wrap;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.95rem;
            color: var(--text-light);
        }

        .meta-item i {
            font-size: 1.3rem;
            color: var(--accent);
        }

        /* ===== CARDS ===== */
        .card-intro {
            background: var(--white);
            border-radius: 20px;
            padding: 50px;
            margin-bottom: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(0, 212, 255, 0.05);
            transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
            position: relative;
            overflow: hidden;
        }

        .card-intro::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--accent), var(--accent-2), var(--accent-3));
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .card-intro:hover {
            transform: translateY(-10px);
            box-shadow: 0 40px 80px rgba(0, 0, 0, 0.15);
        }

        .card-intro:hover::before {
            opacity: 1;
        }

        .card-intro p {
            text-align: justify;
            line-height: 1.9;
            color: var(--text-light);
            font-size: 1.05rem;
            margin-bottom: 20px;
            letter-spacing: 0.3px;
        }

        .card-intro p:last-child {
            margin-bottom: 0;
        }

        /* ===== SECTION CARDS ===== */
        .section-card {
            margin-bottom: 50px;
            animation: fadeInUp 0.8s ease;
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

        .section-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .section-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .section-card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .section-card:nth-child(4) {
            animation-delay: 0.4s;
        }

        /* ===== CONTENT CARDS ===== */
        .content-card {
            background: var(--white);
            border-radius: 25px;
            padding: 60px;
            margin-bottom: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 212, 255, 0.05);
            position: relative;
            overflow: hidden;
            transition: all 0.4s ease;
        }

        .content-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at center, rgba(0, 212, 255, 0.05) 0%, transparent 70%);
            transition: left 0.4s ease;
            pointer-events: none;
        }

        .content-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 40px 80px rgba(0, 0, 0, 0.12);
        }

        .content-card:hover::before {
            left: 0;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 40px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .section-title i {
            font-size: 2.5rem;
            background: linear-gradient(135deg, var(--accent), var(--accent-2));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ===== LIST ITEMS ===== */
        .list-container {
            margin: 0;
        }

        /* Style untuk list dengan nomor (Misi) */
        .list-container ol.numbered-list {
            list-style: none;
            counter-reset: item;
            margin: 0;
            padding: 0;
        }

        .list-container ol.numbered-list li {
            counter-increment: item;
            margin-bottom: 35px;
            padding-left: 80px;
            position: relative;
        }

        .list-container ol.numbered-list li::before {
            content: counter(item);
            position: absolute;
            left: 0;
            top: 5px;
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1.3rem;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-2) 100%);
            color: white;
            box-shadow: 0 10px 30px rgba(0, 212, 255, 0.3);
            transition: all 0.3s ease;
        }

        .list-container ol.numbered-list li:hover::before {
            transform: scale(1.1) rotateZ(5deg);
            box-shadow: 0 15px 40px rgba(0, 212, 255, 0.4);
        }

        /* Style untuk list tanpa nomor (Visi) */
        .list-container ul.no-number-list {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .list-container ul.no-number-list li {
            margin-bottom: 25px;
            padding-left: 40px;
            position: relative;
            line-height: 1.8;
            color: var(--text-light);
            font-size: 1.05rem;
        }

        .list-container ul.no-number-list li::before {
            content: '●';
            position: absolute;
            left: 0;
            top: 0;
            font-size: 1.5rem;
            color: var(--accent);
            font-weight: bold;
        }

        .list-container li p {
            margin: 0;
            line-height: 1.8;
            color: var(--text-light);
            font-size: 1.05rem;
            letter-spacing: 0.3px;
        }

        /* ===== FOOTER ===== */
        footer {
            background: linear-gradient(135deg, #1c2833 0%, #0d2d50 100%);
            color: white;
            padding: 60px 0 30px;
            margin-top: 100px;
            border-top: 1px solid rgba(0, 212, 255, 0.1);
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

        footer p {
            color: rgba(255, 255, 255, 0.85);
            line-height: 1.8;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.5rem;
            }

            .hero-content .subtitle {
                font-size: 1.1rem;
            }

            .hero {
                padding: 60px 20px;
                min-height: 350px;
            }

            .container-custom {
                margin: -60px auto 0;
                padding: 0 15px;
            }

            .card-intro,
            .content-card {
                padding: 35px 25px;
            }

            .section-title {
                font-size: 1.6rem;
                gap: 10px;
            }

            .section-title i {
                font-size: 2rem;
            }

            .list-container ol.numbered-list li {
                padding-left: 70px;
            }

            .list-container ol.numbered-list li::before {
                width: 50px;
                height: 50px;
                font-size: 1.1rem;
            }

            .meta-info {
                gap: 20px;
            }

            .meta-item {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            .hero-content h1 {
                font-size: 1.8rem;
            }

            .section-title {
                font-size: 1.3rem;
            }

            .card-intro,
            .content-card {
                padding: 25px 20px;
            }

            .list-container ol.numbered-list li {
                padding-left: 65px;
            }
        }

        /* ===== HERO ANIMATIONS ===== */
        @keyframes bgGradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .hero {
            background: linear-gradient(-45deg, #0d2d50, #1a4d7a, #2a6ba8, #0d2d50);
            background-size: 400% 400%;
            animation: bgGradientShift 15s ease infinite;
        }

        @keyframes textShimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }

        .hero-content h1 {
            background: linear-gradient(90deg, #ffffff, #00d4ff, #ffffff, #ff6b9d, #ffffff);
            background-size: 1000px 100%;
            background-position: 0 0;
            animation: slideInDown 1s cubic-bezier(0.34, 1.56, 0.64, 1) 0.2s both,
                textShimmer 6s ease-in-out 1.2s infinite;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>

<body>
    <!-- NAVBAR -->
    @include('layouts.navbar')

    <!-- HERO SECTION -->
    <section class="hero">
        <div class="hero-grid"></div>
        <div class="hero-content">
            <div class="hero-badge">
                <i class="bi bi-rocket-takeoff"></i> Satuan Pengawasan Internal
            </div>
            <h1>Visi, Misi & Tujuan</h1>
            <p class="subtitle">Komitmen kami untuk Good Governance dan Profesionalisme</p>
        </div>
    </section>

    <!-- MAIN CONTENT -->
    <div class="main-wrapper">
        <div class="container-custom">
            <!-- BREADCRUMB -->
            <nav aria-label="breadcrumb" class="breadcrumb-custom" style="padding-top: 40px;">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#" style="color: white;"><i class="bi bi-house"></i> Beranda</a></li>
                    <li class="breadcrumb-item"><a href="#" style="color: white;">Profil</a></li>
                    <li class="breadcrumb-item active" style="color: grey;">Visi, Misi, Tujuan</li>
                </ol>
            </nav>

            <!-- META INFO -->
            <div class="meta-info">
                <div class="meta-item">
                    <i class="bi bi-calendar-event"></i>
                    <span style="color: white;">
                        {{ \Carbon\Carbon::parse($visimisi->tanggal)->translatedFormat('d F Y') ?? '-' }}
                    </span>
                </div>
                <div class="meta-item">
                    <i class="bi bi-clock"></i>
                    <span style="color: white;">
                       {{ $visimisi->jam ? \Carbon\Carbon::parse($visimisi->jam)->format('H:i') . ' WIB' : '-' }}
                    </span>
                </div>
                <div class="meta-item">
                    <i class="bi bi-person-badge"></i>
                    <span style="color: white;">Satuan Pengawasan Internal</span>
                </div>
            </div>

            <!-- VISI (Teks Biasa) -->
            <div class="card-intro section-card">
                <h2 class="section-title"><i class="bi bi-eye"></i> Visi</h2>
                <div style="color: var(--text-light); line-height: 1.9;">
                    @if($visimisi && $visimisi->visi)
                        <p style="margin: 0; text-align: justify;">{{ $visimisi->visi }}</p>
                    @else
                        <p>Belum ada data visi.</p>
                    @endif
                </div>
            </div>

            <!-- MISI (Dengan Nomor) -->
            <div class="content-card section-card">
                <h2 class="section-title"><i class="bi bi-flag"></i> Misi</h2>
                <div class="list-container">
                    @if($visimisi && $visimisi->misi)
                        <ol class="numbered-list">
                            @foreach(explode("\n", trim($visimisi->misi)) as $item)
                                @if(trim($item))
                                    <li><p>{{ trim($item) }}</p></li>
                                @endif
                            @endforeach
                        </ol>
                    @else
                        <p style="color: var(--text-light);">Belum ada data misi.</p>
                    @endif
                </div>
            </div>

            <!-- TUJUAN (Dengan Nomor) -->
            <div class="content-card section-card">
                <h2 class="section-title"><i class="bi bi-bullseye"></i> Tujuan</h2>
                <div class="list-container">
                    @if($visimisi && $visimisi->tujuan)
                        <ol class="numbered-list">
                            @foreach(explode("\n", trim($visimisi->tujuan)) as $item)
                                @if(trim($item))
                                    <li><p>{{ trim($item) }}</p></li>
                                @endif
                            @endforeach
                        </ol>
                    @else
                        <p style="color: var(--text-light);">Belum ada data tujuan.</p>
                    @endif
                </div>
            </div>

            <!-- Tombol Edit (hanya untuk admin) -->
            @auth
                @if(Auth::user()->role === 'admin')
                    <div class="text-center mb-5">
                        <a href="{{ route('visi-misi.edit') }}" class="btn btn-warning btn-lg">
                            <i class="bi bi-pencil-square me-2"></i>Edit Visi, Misi & Tujuan
                        </a>
                    </div>
                @endif
            @endauth
        </div>
    </div>

    <!-- FOOTER -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <img src="{{ asset('images/logoPolije.png') }}" alt="Logo Polije" class="footer-logo">
                    <p class="mt-3">Satuan Pengawas Internal Politeknik Negeri Jember berkomitmen untuk menjaga integritas dan akuntabilitas institusi melalui pengawasan yang profesional dan independen.</p>
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
                        <p><i class="bi bi-geo-alt-fill me-2" style="color: var(--accent);"></i>Jl. Mastrip PO BOX 164<br>Jember, Jawa Timur, Indonesia</p>
                        <p><i class="bi bi-envelope-fill me-2" style="color: var(--accent);"></i>
                            <a href="mailto:politeknik@polije.ac.id" class="text-white text-decoration-none">politeknik@polije.ac.id</a>
                        </p>
                        <p><i class="bi bi-telephone-fill me-2" style="color: var(--accent);"></i>+62 331 333533</p>
                        <p><i class="bi bi-telephone-fill me-2" style="color: var(--accent);"></i>+62 331 333531</p>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4 pt-4" style="border-top: 1px solid rgba(255,255,255,0.1);">
                <p class="mb-0" style="color: rgba(255,255,255,0.7);">© 2025 Satuan Pengawas Internal - Politeknik Negeri Jember. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>