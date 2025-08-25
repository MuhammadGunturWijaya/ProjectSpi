<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struktur Organisasi SPI</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .org-chart {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .box {
            border: 1px solid black;
            padding: 10px 20px;
            margin: 10px;
            text-align: center;
            background-color: #f9f9f9;
            border-radius: 5px;
        }

        .line-container {
            display: flex;
            justify-content: center;
        }

        .vertical-line {
            width: 2px;
            height: 30px;
            background-color: black;
        }

        .line-container.multiple {
            height: 50px;
            position: relative;
            width: 100%;
        }

        .line-container.multiple .horizontal-line {
            position: absolute;
            top: 0;
            left: 20%;
            right: 20%;
            height: 2px;
            background-color: black;
        }

        .line-container.multiple .vertical-line.down {
            position: absolute;
            top: 0;
            left: 50%;
            height: 50px;
            transform: translateX(-50%);
        }

        .middle-level {
            display: flex;
            justify-content: center;
        }

        .bottom-level {
            display: flex;
            justify-content: center;
            width: 100%;
        }

        .bottom-level .box {
            position: relative;
            margin: 10px;
            flex: 1;
        }

        .bottom-level .box::before {
            content: '';
            position: absolute;
            top: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 2px;
            height: 10px;
            background-color: black;
        }

        .sub-box {
            border: 1px solid black;
            padding: 8px;
            margin-top: 15px;
            background-color: #fff;
        }

        /* CSS sebelumnya untuk memusatkan gambar */
        .img-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
            /* Jarak antara gambar dan teks di bawahnya */
        }

        /* CSS baru untuk membuat gambar responsif */
        .img-container img {
            max-width: 100%;
            /* Gambar tidak akan melebihi lebar kontainer induknya */
            height: auto;
            /* Ketinggian akan diatur otomatis sesuai rasio lebar */
            display: block;
            /* Opsional: Memastikan gambar berperilaku seperti blok untuk pemusatan yang konsisten */
        }
    </style>
</head>

<body>
    @include('layouts.navbar')

    <div class="container mt-5"> {{-- Tambahkan container dan margin top untuk memberi jarak dari navbar --}}
        <h2 class="text-center">Struktur Organisasi Satuan Pengawas Internal (SPI)</h2>
        <div class="img-container">
            <img src="{{ asset('images/organisasi.png') }}" alt="Struktur Organisasi">
        </div>
        <div class="container mt-5 content-section">
            <p>Melaksanakan langkah yang telah disusun Deputi Pengawasan atau ketua tim terkait dalam penugasan
                pengawasan.
                Tim SPI UB yang terlibat dalam organisasi dapat dilihat di halaman <a href="URL_KE_HALAMAN_SDM">Sumber
                    Daya Manusia</a></p>

            <p>Sesuai struktur organisasi SPI UB menetapkan tugas pokok dan fungsi masing-masing personil sebagai
                berikut:</p>

            <h4>Ketua SPI</h4>
            <ul>
                <li>Koordinasi dan penyusunan rencana, program, dan anggaran SPI;</li>
                <li>Mewakili Ketua SPI dalam hal berhalangan atau ditugaskan;</li>
                <li>Fasilitasi pelaksanaan penataan kelembagaan dan reformasi birokrasi, serta pemantauan, evaluasi, dan
                    pelaporan SPI;</li>
                <li>Pelaksanaan hubungan masyarakat;</li>
                <li>Pelaksanaan urusan kepegawaian di lingkungan SPI;</li>
                <li>Pelaksanaan urusan keuangan di lingkungan SPI;</li>
                <li>Pengelolaan barang milik UB atau milik negara di lingkungan SPI;</li>
                <li>Pelaksanaan hubungan masyarakat dan tata usaha SPI; dan</li>
                <li>Melaksanakan tugas lainnya dari Ketua SPI.</li>
            </ul>

            <h4>Sekretaris SPI</h4>
            <ul>
                <li>Koordinasi dan penyusunan rencana, program, dan anggaran SPI;</li>
                <li>Mewakili Ketua SPI dalam hal berhalangan atau ditugaskan;</li>
                <li>Fasilitasi pelaksanaan penataan kelembagaan dan reformasi birokrasi, serta pemantauan, evaluasi, dan
                    pelaporan SPI;</li>
                <li>Pelaksanaan hubungan masyarakat;</li>
                <li>Pelaksanaan urusan kepegawaian di lingkungan SPI;</li>
                <li>Pelaksanaan urusan keuangan di lingkungan SPI;</li>
                <li>Pengelolaan barang milik UB atau milik negara di lingkungan SPI; dan</li>
                <li>Pelaksanaan hubungan masyarakat dan tata usaha SPI.</li>
            </ul>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @include('layouts.NavbarBawah')
</body>

</html>