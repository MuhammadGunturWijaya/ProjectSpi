<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedoman Reviu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #f8f9fa, #eef4ff);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .reviu-container {
            max-width: 1000px;
            margin: 60px auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .reviu-container h1 {
            font-weight: 700;
            margin-bottom: 20px;
            text-align: center;
            color: #dc3545;
        }

        .subtitle {
            text-align: center;
            font-size: 1.1rem;
            color: #6c757d;
            margin-bottom: 30px;
        }

        .reviu-item {
            background: #fff8f8;
            border-left: 5px solid #dc3545;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 15px;
            transition: all 0.2s ease-in-out;
        }

        .reviu-item:hover {
            background: #fdeaea;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body>
    {{-- Navbar Atas --}}
    @include('layouts.navbar')

    <div class="container reviu-container">
        <!-- Logo Polije -->
        <div class="text-center mb-4">
            <img src="{{ asset('images/logoPolije.png') }}" alt="Logo Polije" style="max-height: 120px;">
        </div>

        <h1>Pedoman Reviu</h1>
        <p class="subtitle">
            Pedoman Reviu memberikan arahan dalam pelaksanaan kegiatan reviu laporan keuangan dan laporan kinerja di lingkungan Politeknik Negeri Jember.
        </p>

        <!-- Detail Isi Pedoman Reviu -->
        <div class="reviu-item">
            <b>1. Tujuan</b>
            <p>Memberikan keyakinan terbatas atas kewajaran laporan keuangan dan kesesuaian laporan kinerja.</p>
        </div>

        <div class="reviu-item">
            <b>2. Ruang Lingkup</b>
            <p>Reviu terhadap laporan keuangan, laporan kinerja, serta dokumen pendukung lainnya.</p>
        </div>

        <div class="reviu-item">
            <b>3. Mekanisme</b>
            <p>Proses reviu dilakukan dengan telaah analitis, permintaan keterangan, dan prosedur lain sesuai standar reviu.</p>
        </div>

        <div class="reviu-item">
            <b>4. Indikator</b>
            <p>Kelengkapan, akurasi, kepatuhan, dan keandalan informasi yang disajikan dalam laporan.</p>
        </div>

        <div class="reviu-item">
            <b>5. Tindak Lanjut</b>
            <p>Hasil reviu digunakan sebagai dasar rekomendasi perbaikan laporan sebelum diaudit oleh pihak eksternal.</p>
        </div>
    </div>

    {{-- Navbar Bawah --}}
    @include('layouts.NavbarBawah')
</body>

</html>
