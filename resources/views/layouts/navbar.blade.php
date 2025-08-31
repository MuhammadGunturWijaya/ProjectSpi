<!-- Navbar Atas -->
<div class="top-nav d-flex justify-content-between align-items-center px-3 py-1">
    <div>
        <a href="#">Polije</a>
        <a href="#">Perpustakaan</a>
        <a href="#">E-Learning</a>
        <a href="#">Research</a>
    </div>
    <form class="d-flex" role="search">
        <input class="form-control form-control-sm text-white border-0" style="background-color:#495057;" type="search"
            placeholder="Pencarian ..." aria-label="Search">
        <button class="btn btn-dark btn-sm ms-2" type="submit">🔍</button>
    </form>
</div>

<!-- Navbar Utama -->
<nav class="main-nav navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('landingpage') }}">
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
                <li class="nav-item"><a class="nav-link highlight" href="{{ route('landingpage') }}">Beranda</a></li>
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
                    <a class="nav-link dropdown-toggle fw-bold text-white ms-2" href="#" id="profileDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
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

<style>
    /* Navbar atas */
    .top-nav {
        background-color: #1c2833;
        font-size: 14px;
        position: sticky;
        top: 0;
        z-index: 1030;
        /* supaya di atas konten */
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
        position: sticky;
        top: 38px;
        /* tinggi top-nav */
        z-index: 1020;
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
</style>