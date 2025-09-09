<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS AP Audit</title>
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

        <h1>POS AP Audit</h1>
        <p class="subtitle">
            Prosedur Operasional Standar Audit/Pengawasan Internal (POS AP Audit) berisi langkah-langkah pelaksanaan audit yang dilakukan oleh SPI untuk menjamin efektivitas, efisiensi, dan kepatuhan kegiatan di lingkungan Politeknik Negeri Jember.
        </p>

        <!-- Detail Isi POS AP Audit -->
        <div class="audit-item">
            <b>1. Tujuan</b>
            <p>Memberikan pedoman bagi auditor SPI dalam melaksanakan audit internal secara sistematis, objektif, dan profesional.</p>
        </div>

        <div class="audit-item">
            <b>2. Ruang Lingkup</b>
            <p>Audit meliputi perencanaan, pelaksanaan, pelaporan, dan tindak lanjut pada seluruh unit kerja di Politeknik Negeri Jember.</p>
        </div>

        <div class="audit-item">
            <b>3. Tahapan Audit</b>
            <ul>
                <li>Perencanaan Audit</li>
                <li>Pelaksanaan Audit</li>
                <li>Penyusunan Laporan Hasil Audit</li>
                <li>Rekomendasi dan Tindak Lanjut</li>
            </ul>
        </div>

        <div class="audit-item">
            <b>4. Kewenangan dan Tanggung Jawab</b>
            <p>Auditor SPI berwenang mengakses data, dokumen, serta melakukan konfirmasi dengan pihak terkait. Unit yang diaudit wajib memberikan data dan menindaklanjuti rekomendasi.</p>
        </div>

        <div class="audit-item">
            <b>5. Output</b>
            <p>Laporan Hasil Audit (LHA) yang memuat temuan, analisis, kesimpulan, dan rekomendasi perbaikan.</p>
        </div>
    </div>

    {{-- Navbar Bawah --}}
    @include('layouts.NavbarBawah')
</body>

</html>
