<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedoman Manajemen Risiko | SPI POLIJE</title>
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
        h2 {
            font-weight: 700;
            color: #0d2d50;
            margin-bottom: 20px;
        }
        .content-wrapper p {
            text-align: justify;
            line-height: 1.7;
            color: #333;
        }
    </style>
</head>
<body>
    {{-- Navbar --}}
    @include('layouts.navbar')

    <div class="container">
        <div class="content-wrapper">
            <!-- Breadcrumb -->
            <nav style="--bs-breadcrumb-divider: '›';" aria-label="breadcrumb">
                <ol class="breadcrumb mb-3">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="#">Pedoman</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Manajemen Risiko</li>
                </ol>
            </nav>

            <h2>Pedoman Manajemen Risiko</h2>
            <p>
                Pedoman Manajemen Risiko SPI POLIJE disusun sebagai acuan dalam mengidentifikasi, menganalisis,
                mengevaluasi, serta mengendalikan risiko yang mungkin terjadi dalam pelaksanaan kegiatan non akademik
                maupun akademik. Tujuan dari pedoman ini adalah untuk meningkatkan efektivitas tata kelola, pengendalian internal, dan budaya sadar risiko di lingkungan POLIJE.
            </p>

            <h5>Prinsip Utama:</h5>
            <ol>
                <li>Integrasi manajemen risiko dalam setiap proses kegiatan.</li>
                <li>Penerapan pengendalian internal yang konsisten.</li>
                <li>Evaluasi berkelanjutan atas efektivitas manajemen risiko.</li>
                <li>Peningkatan kesadaran dan kapasitas seluruh unit kerja terkait risiko.</li>
            </ol>

            <p>
                Dengan adanya Pedoman Manajemen Risiko ini, diharapkan setiap unit kerja di POLIJE dapat secara aktif
                berpartisipasi dalam mengelola risiko sesuai dengan standar dan ketentuan yang berlaku.
            </p>
        </div>
    </div>

    {{-- Navbar bawah --}}
    @include('layouts.navbarbawah')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
