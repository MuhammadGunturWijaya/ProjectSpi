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
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link highlight" href="{{ route('landingpage') }}">Beranda</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Profil
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">SEJARAH</a></li>
                        <li><a class="dropdown-item" href="#">VISI, MISI, DAN TUJUAN</a></li>
                        <li><a class="dropdown-item" href="#">STRUKTUR ORGANISASI</a></li>
                        <li><a class="dropdown-item" href="#">SUMBER DAYA MANUSIA</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Aktivitas</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Kegiatan</a></li>
                        <li><a class="dropdown-item" href="#">Agenda</a></li>
                    </ul>
                </li>
            </ul>
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
        top: 38px; /* tinggi top-nav */
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
        background-color: #1c2833;
        border: none;
        display: block;
        opacity: 0;
        transform: translateY(10px);
        visibility: hidden;
        transition: all 0.3s ease;
    }

    .navbar .dropdown-menu.show {
        opacity: 1;
        transform: translateY(0);
        visibility: visible;
        margin-top: 10px;
    }

    .navbar .dropdown-menu .dropdown-item {
        color: white;
    }

    .navbar .dropdown-menu .dropdown-item:hover {
        background-color: #0084ffff;
        color: #000;
    }

    .nav-item.dropdown:hover .dropdown-menu {
        display: block;
        margin-top: 0;
    }
</style>