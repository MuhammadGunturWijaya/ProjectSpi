<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedoman Audit SPI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #f8f9fa, #eef4ff);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .audit-container {
            max-width: 1000px;
            margin: 60px auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }
        .audit-container h1 {
            font-weight: 700;
            margin-bottom: 20px;
            text-align: center;
            color: #0d6efd;
        }
        .subtitle {
            text-align: center;
            font-size: 1.1rem;
            color: #6c757d;
            margin-bottom: 30px;
        }
        .audit-item {
            background: #f8fbff;
            border-left: 5px solid #0d6efd;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 15px;
            transition: all 0.2s ease-in-out;
        }
        .audit-item:hover {
            background: #e9f2ff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body>
    {{-- Navbar Atas --}}
    @include('layouts.navbar')

    <div class="container audit-container">
        <!-- Logo Polije -->
        <div class="text-center mb-4">
            <img src="{{ asset('images/logoPolije.png') }}" alt="Logo Polije" style="max-height: 120px;">
        </div>
        <h1>Pedoman Audit SPI</h1>


        <p class="subtitle">
            Pedoman Audit SPI Politeknik Negeri Jember memberikan arahan dan standar dalam pelaksanaan kegiatan audit internal,
            untuk menjamin akuntabilitas, efektivitas, efisiensi, serta transparansi tata kelola institusi.
        </p>

        <div class="audit-item">
            <b>1. Tujuan</b>
            <p>Menjadi panduan dalam pelaksanaan audit internal sehingga proses berjalan terarah, sistematis, dan konsisten sesuai standar pengawasan.</p>
        </div>

        <div class="audit-item">
            <b>2. Ruang Lingkup</b>
            <p>Mencakup audit kepatuhan, audit kinerja, audit keuangan, audit sistem informasi, dan audit khusus sesuai kebutuhan organisasi.</p>
        </div>

        <div class="audit-item">
            <b>3. Prinsip Audit</b>
            <p>Integritas, objektivitas, kerahasiaan, kompetensi, independensi, dan profesionalisme dalam setiap tahapan audit.</p>
        </div>

        <div class="audit-item">
            <b>4. Tahapan Audit</b>
            <ul>
                <li>Perencanaan Audit</li>
                <li>Pelaksanaan Audit</li>
                <li>Penyusunan Laporan Audit</li>
                <li>Tindak Lanjut Audit</li>
            </ul>
        </div>

        <div class="audit-item">
            <b>5. Tanggung Jawab SPI</b>
            <p>SPI bertanggung jawab menyampaikan rekomendasi perbaikan kepada pimpinan, serta memantau pelaksanaan tindak lanjut atas rekomendasi tersebut.</p>
        </div>
    </div>

    {{-- Navbar Bawah --}}
    @include('layouts.NavbarBawah')
</body>
</html>
