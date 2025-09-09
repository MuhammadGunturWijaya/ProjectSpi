<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Piagam SPI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #f8f9fa, #eef4ff);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .piagam-container {
            max-width: 1000px;
            margin: 60px auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .piagam-container h1 {
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

        .card-piagam {
            border: none;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            overflow: hidden;
            margin-bottom: 40px;
        }

        .card-piagam img {
            width: 100%;
            object-fit: cover;
        }

        .card-body {
            padding: 20px;
            text-align: center;
        }

        .card-body h5 {
            font-weight: bold;
            color: #0d6efd;
        }

        .piagam-item {
            background: #f8fbff;
            border-left: 5px solid #0d6efd;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 15px;
            transition: all 0.2s ease-in-out;
        }

        .piagam-item:hover {
            background: #e9f2ff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body>
    {{-- Navbar Atas --}}
    @include('layouts.navbar')

    <div class="container piagam-container">
        <!-- Logo Polije -->
        <div class="text-center mb-4">
            <img src="{{ asset('images/logoPolije.png') }}" alt="Logo Polije" style="max-height: 120px;">
        </div>

        <h1>Piagam SPI</h1>
        <p class="subtitle">
            Piagam Satuan Pengawasan Internal (SPI) adalah dokumen resmi yang menetapkan visi, misi, tujuan, kedudukan,
            fungsi, dan kewenangan SPI di Politeknik Negeri Jember.
        </p>

        <!-- Card untuk Gambar Piagam -->
        <div class="card card-piagam">
            <!-- <img src="{{ asset('images/piagam-spi.jpg') }}" alt="Piagam SPI"> -->
            <img src="https://th.bing.com/th/id/R.719307e9d17427eb8fd143cc6be4edb9?rik=5M04MI352KWFIg&riu=http%3a%2f%2frsimadiun.com%2fimages%2fsertifikat%2fimg427.jpg&ehk=K4KIQO%2fkzKyqNWtXw8ZtLw7C6TlEe6jdO6KP1V61UNw%3d&risl=&pid=ImgRaw&r=0"
                alt="Piagam SPI" style="max-height: 400px;">

            <div class="card-body">
                <h5>Piagam SPI Politeknik Negeri Jember</h5>
                <p class="text-muted mb-1"><i class="bi bi-calendar-event"></i> Ditetapkan: 10 Januari 2024</p>
                <p class="mb-0">Dokumen ini menjadi landasan resmi pelaksanaan fungsi pengawasan internal di lingkungan
                    Politeknik Negeri Jember.</p>
            </div>
        </div>

        <!-- Detail Isi Piagam -->
        <div class="piagam-item">
            <b>1. Kedudukan</b>
            <p>SPI merupakan unit pengawasan internal yang berada langsung di bawah Direktur Politeknik Negeri Jember
                dan bertanggung jawab langsung kepada Direktur.</p>
        </div>

        <div class="piagam-item">
            <b>2. Tujuan</b>
            <p>Memberikan keyakinan yang memadai atas kepatuhan, efisiensi, efektivitas, dan keandalan pelaksanaan tugas
                di lingkungan Politeknik Negeri Jember.</p>
        </div>

        <div class="piagam-item">
            <b>3. Fungsi</b>
            <p>Melakukan audit, reviu, evaluasi, pemantauan, dan kegiatan pengawasan lainnya untuk meningkatkan tata
                kelola, manajemen risiko, dan pengendalian internal.</p>
        </div>

        <div class="piagam-item">
            <b>4. Kewenangan</b>
            <p>SPI memiliki kewenangan untuk mengakses dokumen, data, aset, dan sumber daya lain yang diperlukan dalam
                rangka pelaksanaan tugas pengawasan.</p>
        </div>

        <div class="piagam-item">
            <b>5. Nilai-Nilai</b>
            <p>Menjunjung tinggi integritas, objektivitas, kerahasiaan, kompetensi, dan profesionalisme dalam
                menjalankan tugas pengawasan.</p>
        </div>
    </div>

    {{-- Navbar Bawah --}}
    @include('layouts.NavbarBawah')
</body>

</html>