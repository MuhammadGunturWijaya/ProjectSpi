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
    <title>Kode Etik SPI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .kode-etik-container {
            max-width: 900px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .kode-etik-container h1 {
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }
        .kode-etik-item {
            background: #f1f7ff;
            border-left: 5px solid #0d6efd;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    {{-- Navbar Atas --}}
    @include('layouts.navbar')

    <div class="container kode-etik-container">
        <h1>Kode Etik SPI</h1>
        <p class="text-center mb-4">
            Kode Etik Satuan Pengawasan Internal (SPI) merupakan pedoman sikap, perilaku, dan etika kerja 
            yang harus dijunjung tinggi oleh seluruh auditor internal.
        </p>

        <div class="kode-etik-item">
            <b>1. Integritas</b>
            <p>Menjunjung tinggi kejujuran, kebenaran, dan komitmen dalam menjalankan setiap tugas pengawasan.</p>
        </div>

        <div class="kode-etik-item">
            <b>2. Objektivitas</b>
            <p>Melaksanakan tugas secara independen, bebas dari pengaruh pihak manapun, serta berdasarkan fakta.</p>
        </div>

        <div class="kode-etik-item">
            <b>3. Kerahasiaan</b>
            <p>Menjaga kerahasiaan informasi yang diperoleh selama proses audit dan tidak digunakan untuk kepentingan pribadi.</p>
        </div>

        <div class="kode-etik-item">
            <b>4. Kompetensi</b>
            <p>Selalu meningkatkan pengetahuan, keahlian, dan keterampilan agar hasil pengawasan lebih berkualitas.</p>
        </div>

        <div class="kode-etik-item">
            <b>5. Profesionalisme</b>
            <p>Melaksanakan tugas dengan penuh tanggung jawab, disiplin, dan menjunjung tinggi etika profesi.</p>
        </div>
    </div>

    {{-- Navbar Bawah --}}
    @include('layouts.NavbarBawah')
</body>
</html>
