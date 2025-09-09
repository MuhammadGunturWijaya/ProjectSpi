<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Bisnis SPI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .process-step {
            background: #fff;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0px 4px 6px rgba(0,0,0,0.1);
        }
        .step-number {
            font-size: 22px;
            font-weight: bold;
            color: #0d6efd;
        }
        .diagram {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
        }
        .diagram-box {
            background: #e9f2ff;
            border: 2px solid #0d6efd;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            width: 220px;
            font-weight: 500;
        }
    </style>
</head>
<body>
    {{-- Navbar Atas --}}
    @include('layouts.navbar')

    <div class="container py-5">
        <h1 class="text-center mb-4">Proses Bisnis SPI</h1>
        <p class="text-center">
            Proses Bisnis Satuan Pengawasan Internal (SPI) meliputi tahapan utama berikut yang memastikan
            fungsi pengawasan berjalan efektif, transparan, dan akuntabel.
        </p>

        <div class="process-step">
            <span class="step-number">1.</span> <b>Perencanaan</b>
            <p>Penyusunan program kerja pengawasan tahunan, identifikasi risiko, dan penentuan prioritas pengawasan.</p>
        </div>

        <div class="process-step">
            <span class="step-number">2.</span> <b>Pelaksanaan Pengawasan</b>
            <p>Audit, reviu, monitoring & evaluasi, serta pemeriksaan kepatuhan terhadap standar dan aturan.</p>
        </div>

        <div class="process-step">
            <span class="step-number">3.</span> <b>Pelaporan</b>
            <p>Penyusunan laporan hasil pengawasan yang disampaikan kepada pimpinan untuk ditindaklanjuti.</p>
        </div>

        <div class="process-step">
            <span class="step-number">4.</span> <b>Tindak Lanjut</b>
            <p>Pemantauan implementasi rekomendasi hasil pengawasan agar perbaikan dijalankan dengan baik.</p>
        </div>

        <div class="process-step">
            <span class="step-number">5.</span> <b>Evaluasi</b>
            <p>Review internal dan perbaikan proses untuk meningkatkan efektivitas SPI secara berkelanjutan.</p>
        </div>

        <hr class="my-5">

        <h3 class="text-center mb-4">Diagram Alur Proses</h3>
        <div class="diagram">
            <div class="diagram-box">Perencanaan</div>
            <div class="diagram-box">Pelaksanaan Pengawasan</div>
            <div class="diagram-box">Pelaporan</div>
            <div class="diagram-box">Tindak Lanjut</div>
            <div class="diagram-box">Evaluasi</div>
        </div>
    </div>

    {{-- Navbar Bawah --}}
    @include('layouts.NavbarBawah')

</body>
</html>
