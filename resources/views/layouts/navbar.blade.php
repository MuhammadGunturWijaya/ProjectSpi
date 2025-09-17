<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar JDIH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        /* Logo & teks */
        .navbar-brand span {
            font-size: 14px;
            line-height: 1.1;
        }

        /* Link menu */
        .navbar-nav .nav-link {
            font-weight: 500;
            color: #4a4a4a;
            margin: 0 8px;
        }

        .navbar-nav .nav-link.active {
            font-weight: 700;
            color: #0d2d50;
        }

        /* Dropdown menu lebih modern */
        .dropdown-menu {
            border: none;
            border-radius: 12px;
            padding: 8px 0;
            background: #fff;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            /* Default state: hidden */
            opacity: 0;
            transform: translateY(10px);
            visibility: hidden;
            transition: all 0.25s ease;
            pointer-events: none;
            /* Mencegah klik saat tersembunyi */
            display: block;
            /* Penting untuk transisi CSS */
        }

        /* Dropdown terlihat saat di-hover */
        .nav-item.dropdown:hover .dropdown-menu {
            opacity: 1;
            transform: translateY(0);
            visibility: visible;
            pointer-events: auto;
            /* Memungkinkan klik saat terlihat */
        }

        /* Dropdown item styling */
        .dropdown-item {
            font-weight: 500;
            padding: 10px 22px;
            color: #4a4a4a;
            border-radius: 6px;
            transition: background 0.2s, color 0.2s;
        }

        /* Hover item */
        .dropdown-item:hover {
            background: #f3f5f8;
            color: #0d2d50;
        }

        /* Tombol login */
        .btn-login {
            background: #0d2d50;
            color: #fff;
            font-weight: 500;
            padding: 6px 16px;
            border-radius: 6px;
            transition: background-color 0.2s ease;
        }

        .btn-login:hover {
            background: #083566;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-white shadow-sm py-2">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('landingpage') }}">
                <img src="{{ asset('images/logoPolije.png') }}" alt="Logo" height="40">
                <span class="ms-2">
                    <strong>SATUAN PENGAWAS INTERNAL</strong><br>POLITEKNIK NEGERI JEMBER
                </span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Beranda</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profilDropdown">
                            Profil
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="profilDropdown">
                            <li><a class="dropdown-item" href="#">Sejarah</a></li>
                            <li><a class="dropdown-item" href="#">Visi & Misi</a></li>
                            <li><a class="dropdown-item" href="#">Struktur Organisasi</a></li>
                            <li><a class="dropdown-item" href="#">Sumber Daya Manusia</a></li>
                            <li><a class="dropdown-item" href="#">Proses Bisnis SPI</a></li>
                            <li><a class="dropdown-item" href="#">Kode Etik SPI</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dokumenDropdown">
                            Dokumen Kerja
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dokumenDropdown">
                            <li><a class="dropdown-item" href="#">Piagam SPI</a></li>
                            <li><a class="dropdown-item" href="#">Pedoman Pengawasan</a></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('pos.ap.pengawasan') }}">
                                    POS AP Pengawasan
                                </a>
                            </li>
                            <li><a class="dropdown-item" href="#">Instrumen Pengawasan</a></li>
                            <li><a class="dropdown-item" href="#">Program Kerja SPI</a></li>
                            <li><a class="dropdown-item" href="#">Konsideran SPI</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="mrDropdown">
                            Manajemen Risiko
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="mrDropdown">
                            <li><a class="dropdown-item" href="#">Pedoman MR</a></li>
                            <li><a class="dropdown-item" href="#">Identifikasi Risiko</a></li>
                            <li><a class="dropdown-item" href="#">Penilaian, Evaluasi MR & Mitigasi</a></li>
                            <li><a class="dropdown-item" href="#">Pelaporan</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="ziDropdown">
                            Zona Integritas
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="ziDropdown">
                            <li><a class="dropdown-item" href="#">Manajemen Perubahan</a></li>
                            <li><a class="dropdown-item" href="#">Penataan Tata Kelola</a></li>
                            <li><a class="dropdown-item" href="#">Penataan Sistem Manajemen SDM dan Aparatur</a></li>
                            <li><a class="dropdown-item" href="#">Penguatan Akuntabilitas</a></li>
                            <li><a class="dropdown-item" href="#">Penguatan Pengawasan</a></li>
                            <li><a class="dropdown-item" href="#">Peningkatan Kualitas Pelayanan Publik</a></li>
                        </ul>
                    </li>
                </ul>

                <a href="#" class="btn btn-login ms-lg-3 mt-2 mt-lg-0">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Login
                </a>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>