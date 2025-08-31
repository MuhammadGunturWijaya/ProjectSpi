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
            background-color: #0d2d50;
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

        #heroCarousel .carousel-control-prev,
        #heroCarousel .carousel-control-next {
            top: 50%;
            transform: translateY(-50%);
            width: auto;
        }

        #heroCarousel .carousel-control-prev {
            left: 20px;
        }

        #heroCarousel .carousel-control-next {
            right: 20px;
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
            background-color: #0084ff;
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
    </style>
</head>

<script>
    document.querySelectorAll('.nav-item.dropdown').forEach(function (el) {
        el.addEventListener('mouseenter', function () {
            let dropdown = new bootstrap.Dropdown(el.querySelector('.dropdown-toggle'));
            dropdown.show();
        });
        el.addEventListener('mouseleave', function () {
            let dropdown = new bootstrap.Dropdown(el.querySelector('.dropdown-toggle'));
            dropdown.hide();
        });
    });

</script>

<body>

    <!-- Navbar Atas -->
    <div class="top-nav d-flex justify-content-between align-items-center px-3 py-1">
        <div>
            <a href="#">Polije</a>
            <a href="#">Perpustakaan</a>
            <a href="#">E-Learning</a>
            <a href="#">Research</a>
        </div>
        <form class="d-flex" role="search">
            <input class="form-control form-control-sm text-white border-0" style="background-color:#495057;"
                type="search" placeholder="Pencarian ..." aria-label="Search">
            <button class="btn btn-dark btn-sm ms-2" type="submit">🔍</button>
        </form>

    </div>

    <!-- Navbar Utama -->
    <nav class="main-nav navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('images/logoPolije.png') }}" alt="Logo" width="40" height="40">
                <span class="logo-text ms-2">
                    SATUAN PENGAWAS INTERNAL<br>
                    POLITEKNIK NEGERI JEMBER
                </span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav me-3">
                    <li class="nav-item"><a class="nav-link highlight" href="#">Beranda</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Profil
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Sejarah</a></li>
                            <li><a class="dropdown-item" href="{{ route('visi-misi.index') }}">Visi, Misi, Tujuan</a>
                            </li>

                            <li><a class="dropdown-item" href="{{ route('struktur.index') }}">Struktur Organisasi</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('profile.spi') }}">Tentang Kami</a></li>
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
    <div id="heroCarousel" class="carousel slide mt-4 mb-4" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://polije.ac.id/wp-content/uploads/2024/04/Web-Banner-Zona-Integritas.png"
                    class="carousel-img" alt="Banner 1">
            </div>
            <div class="carousel-item">
                <img src="https://i.ytimg.com/vi/TxJmgu6VaXw/maxresdefault.jpg" class="carousel-img" alt="Banner 2">
            </div>
            <div class="carousel-item">
                <img src="https://polije.ac.id/wp-content/uploads/2024/04/Web-Banner-Zona-Integritas.png"
                    class="carousel-img" alt="Banner 3">
            </div>
        </div>

        <!-- Tombol navigasi -->
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon p-1" style="width:30px; height:30px;" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon p-1" style="width:30px; height:30px;" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>

    </div>

    <!-- Sekilas Tentang Kami -->
    <section class="py-5 bg-light">
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
        <h2 class="fw-bold text-center mb-4">Berita Terbaru</h2>
        <p class="text-center text-muted mb-5">
            Dapatkan informasi terkini seputar kegiatan dan aktivitas SPI Politeknik Negeri Jember
        </p>

        <!-- Search Bar -->
        <div class="container my-5">
            <form action="{{ route('search') }}" method="GET" class="search-box d-flex align-items-center mx-auto">
                <input type="text" name="q" class="form-control search-input"
                    placeholder="🔍 Cari berita, artikel, atau profil..." value="{{ request('q') }}">
                <button type="submit" class="btn search-btn">Cari</button>
            </form>
        </div>

        <!-- Tombol Tambah Berita (hanya admin) -->
        @auth
            @if(Auth::user()->role === 'admin')
                <div class="text-end mb-3">
                    <a href="{{ route('berita.create') }}" class="btn btn-outline-primary rounded-pill shadow-sm">
                        + Tambah Berita
                    </a>
                </div>
            @endif
        @endauth

        <div class="row g-4">
            @foreach($beritas as $b)
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-lg rounded-4 overflow-hidden">
                        <img src="{{ $b->gambar }}" class="card-img-top" alt="berita"
                            style="height:200px; object-fit:cover;">
                        <div class="card-body d-flex flex-column">
                            <small class="text-muted">{{ $b->tanggal }}</small>
                            <h5 class="fw-bold mt-2">{{ Str::limit($b->judul, 60) }}</h5>
                            <p class="text-muted flex-grow-1">{{ Str::limit($b->isi, 100) }}</p>
                            <a href="{{ route('berita.show', $b->id) }}" class="btn btn-primary btn-sm mt-2 rounded-pill">
                                Baca Selengkapnya →
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Tombol Lihat Semua -->
        <div class="text-center mt-5">
            <a href="{{ route('berita.index') }}" class="btn btn-outline-primary btn-lg px-5 rounded-pill shadow-sm">
                Lihat Semua Berita
            </a>
        </div>
    </div>

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


    <!-- Footer -->
    <footer class="text-center text-white py-4" style="background-color: #0d2d50;">
        <div class="container">
            <!-- Logo -->
            <img src="{{ asset('images/logoPolije.png') }}" alt="Logo Polije" class="mb-3" style="max-height: 80px;">

            <!-- Alamat -->
            <p>
                Satuan Pengawas Internal Politeknik Negeri Jember <br>
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
-->