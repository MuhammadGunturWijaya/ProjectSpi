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
    <title>Peningkatan Kualitas Pelayanan Publik - SPI POLIJE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .content-wrapper {
            background: #fff;
            border-radius: 10px;
            padding: 40px;
            margin: 40px auto;
            max-width: 950px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
        }

        .content-wrapper h1 {
            font-weight: 700;
            color: #0d2d50;
            margin-bottom: 20px;
        }

        .section-title {
            font-weight: 600;
            margin-top: 25px;
            margin-bottom: 10px;
        }

        p {
            text-align: justify;
            line-height: 1.7;
            color: #333;
        }

        ol li {
            margin-bottom: 8px;
        }
    </style>
</head>

<body>
    {{-- Navbar Atas --}}
    @include('layouts.navbar')

    <div class="container">
        <div class="content-wrapper">
            <!-- Breadcrumb -->
            <nav style="--bs-breadcrumb-divider: '›';" aria-label="breadcrumb">
                <ol class="breadcrumb mb-3">
                    <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Peningkatan Kualitas Pelayanan Publik</li>
                </ol>
            </nav>

            <!-- Judul -->
            <h1>Peningkatan Kualitas Pelayanan Publik</h1>

            <!-- Konten -->
            <p>
                Peningkatan kualitas pelayanan publik merupakan komitmen SPI POLIJE untuk menghadirkan pelayanan yang
                transparan, akuntabel, dan berorientasi pada kepuasan masyarakat.
            </p>

            <h2 class="section-title">Tujuan</h2>
            <ol>
                <li>Mewujudkan pelayanan publik yang cepat, tepat, dan transparan.</li>
                <li>Meningkatkan kepuasan pengguna layanan melalui inovasi berkelanjutan.</li>
                <li>Menjamin akuntabilitas dan integritas dalam setiap proses pelayanan.</li>
            </ol>

            <h2 class="section-title">Strategi</h2>
            <ol>
                <li>Pemanfaatan teknologi informasi untuk mempercepat layanan.</li>
                <li>Peningkatan kompetensi sumber daya manusia.</li>
                <li>Penerapan standar pelayanan publik yang konsisten.</li>
                <li>Evaluasi rutin terhadap kinerja pelayanan.</li>
            </ol>

            <h2 class="section-title">Indikator Keberhasilan</h2>
            <ol>
                <li>Peningkatan kepuasan masyarakat terhadap layanan SPI POLIJE.</li>
                <li>Berkurangnya keluhan dan laporan terkait pelayanan.</li>
                <li>Tercapainya standar waktu dan kualitas layanan sesuai regulasi.</li>
            </ol>
        </div>
    </div>

    {{-- Navbar Bawah --}}
    @include('layouts.NavbarBawah')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
