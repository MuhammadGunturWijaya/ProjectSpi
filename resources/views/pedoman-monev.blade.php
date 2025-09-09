<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedoman Monev</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #f8f9fa, #eef4ff);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .monev-container {
            max-width: 1000px;
            margin: 60px auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .monev-container h1 {
            font-weight: 700;
            margin-bottom: 20px;
            text-align: center;
            color: #198754;
        }

        .subtitle {
            text-align: center;
            font-size: 1.1rem;
            color: #6c757d;
            margin-bottom: 30px;
        }

        .monev-item {
            background: #f8fbff;
            border-left: 5px solid #198754;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 15px;
            transition: all 0.2s ease-in-out;
        }

        .monev-item:hover {
            background: #e6f5ec;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body>
    {{-- Navbar Atas --}}
    @include('layouts.navbar')

    <div class="container monev-container">
        <!-- Logo Polije -->
        <div class="text-center mb-4">
            <img src="{{ asset('images/logoPolije.png') }}" alt="Logo Polije" style="max-height: 120px;">
        </div>

        <h1>Pedoman Monev</h1>
        <p class="subtitle">
            Pedoman Monitoring dan Evaluasi (Monev) memberikan panduan dalam melaksanakan kegiatan pengawasan,
            pengendalian, dan evaluasi terhadap program serta kegiatan di lingkungan Politeknik Negeri Jember.
        </p>

        <!-- Detail Isi Pedoman Monev -->
        <div class="monev-item">
            <b>1. Tujuan</b>
            <p>Menjamin ketercapaian target program dan kegiatan sesuai dengan perencanaan yang telah ditetapkan.</p>
        </div>

        <div class="monev-item">
            <b>2. Ruang Lingkup</b>
            <p>Seluruh program, kegiatan, serta proses pengelolaan yang berlangsung di Politeknik Negeri Jember.</p>
        </div>

        <div class="monev-item">
            <b>3. Mekanisme</b>
            <p>Proses monitoring dilakukan secara periodik dengan laporan tertulis, sedangkan evaluasi dilakukan pada
                akhir periode kegiatan.</p>
        </div>

        <div class="monev-item">
            <b>4. Indikator</b>
            <p>Efektivitas, efisiensi, relevansi, dan keberlanjutan dari setiap program atau kegiatan.</p>
        </div>

        <div class="monev-item">
            <b>5. Tindak Lanjut</b>
            <p>Hasil Monev digunakan sebagai dasar pengambilan keputusan, perbaikan kebijakan, dan penyusunan rencana
                berikutnya.</p>
        </div>
    </div>

    {{-- Navbar Bawah --}}
    @include('layouts.NavbarBawah')
</body>

</html>
