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
    <title>Konsideran SPI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #f8f9fa, #eef4ff);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .konsideran-container {
            max-width: 1000px;
            margin: 60px auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .konsideran-container h1 {
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

        .konsideran-list {
            list-style: none;
            padding: 0;
        }

        .konsideran-item {
            display: flex;
            align-items: flex-start;
            background: #f8fbff;
            border: 1px solid #dee2e6;
            border-radius: 12px;
            padding: 15px 20px;
            margin-bottom: 15px;
            transition: all 0.2s ease-in-out;
        }

        .konsideran-item:hover {
            background: #e9f2ff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .konsideran-icon {
            font-size: 1.5rem;
            color: #0d6efd;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .konsideran-text {
            flex: 1;
            font-size: 1rem;
            color: #333;
        }
    </style>
</head>

<body>
    {{-- Navbar Atas --}}
    @include('layouts.navbar')

    <div class="container konsideran-container">
        <div class="text-center mb-4">
            <img src="{{ asset('images/logoPolije.png') }}" alt="Logo Polije" style="max-height: 120px;">
        </div>
        <h1>Konsideran SPI</h1>
        <p class="subtitle">
            Dasar hukum dan landasan pelaksanaan tugas <br>
            <b>Satuan Pengawasan Internal (SPI) Politeknik Negeri Jember</b>:
        </p>

        <ul class="konsideran-list">
            <li class="konsideran-item">
                <i class="bi bi-book konsideran-icon"></i>
                <div class="konsideran-text">Undang-Undang Nomor 1 Tahun 2004 tentang Perbendaharaan Negara (Lembaran
                    Negara Republik Indonesia Tahun 2004 Nomor 5, Tambahan Lembaran Negara Republik Indonesia Nomor
                    4355);</div>
            </li>
            <li class="konsideran-item">
                <i class="bi bi-shield-check konsideran-icon"></i>
                <div class="konsideran-text">Peraturan Pemerintah Nomor 60 Tahun 2008 tentang Sistem Pengendalian Intern
                    Pemerintah;</div>
            </li>
            <li class="konsideran-item">
                <i class="bi bi-building konsideran-icon"></i>
                <div class="konsideran-text">Peraturan Presiden (Perpres) Nomor 29 Tahun 2014 tentang Sistem
                    Akuntabilitas Kinerja Instansi Pemerintah;</div>
            </li>
            <li class="konsideran-item">
                <i class="bi bi-mortarboard konsideran-icon"></i>
                <div class="konsideran-text">Peraturan Menteri Pendidikan dan Kebudayaan Nomor 66 Tahun 2015 tentang
                    Manajemen Risiko di Lingkungan Kementerian Pendidikan dan Kebudayaan;</div>
            </li>
            <li class="konsideran-item">
                <i class="bi bi-mortarboard-fill konsideran-icon"></i>
                <div class="konsideran-text">Peraturan Menteri Pendidikan dan Kebudayaan Republik Indonesia Nomor 22
                    Tahun 2017 tentang Satuan Pengawasan Intern di Lingkungan Kementerian Pendidikan dan Kebudayaan;
                </div>
            </li>
            <li class="konsideran-item">
                <i class="bi bi-cash-coin konsideran-icon"></i>
                <div class="konsideran-text">Peraturan Menteri Keuangan Republik Indonesia Nomor 202/PMK.05/2022 tentang
                    perubahan atas Peraturan Menteri Keuangan Nomor 129/PMK.05/2020 tentang Pedoman Pengelolaan Badan
                    Layanan Umum;</div>
            </li>
            <li class="konsideran-item">
                <i class="bi bi-journal-text konsideran-icon"></i>
                <div class="konsideran-text">Peraturan Menteri Pendidikan, Kebudayaan, Riset, dan Teknologi Nomor 40
                    Tahun 2022 tentang Sistem Akuntabilitas Kinerja Instansi Pemerintah di Kementerian Pendidikan,
                    Kebudayaan, Riset, dan Teknologi;</div>
            </li>
            <li class="konsideran-item">
                <i class="bi bi-award konsideran-icon"></i>
                <div class="konsideran-text">Keputusan Menteri Pendidikan, Kebudayaan, Riset, dan Teknologi Republik
                    Indonesia Nomor 210/M/2023 tentang Indikator Kinerja Utama Perguruan Tinggi dan Lembaga Layanan
                    Pendidikan Tinggi di Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi;</div>
            </li>
            <li class="konsideran-item">
                <i class="bi bi-gear konsideran-icon"></i>
                <div class="konsideran-text">Peraturan Menteri Pendidikan, Kebudayaan, Riset, dan Teknologi Nomor 6
                    Tahun 2024 tentang Perubahan Atas Peraturan Menteri Pendidikan, Kebudayaan, Riset, dan Teknologi
                    Nomor 19 Tahun 2022 tentang Organisasi dan Tata Kerja Politeknik Negeri Jember;</div>
            </li>
            <li class="konsideran-item">
                <i class="bi bi-bank konsideran-icon"></i>
                <div class="konsideran-text">Peraturan Menteri Pendidikan, Kebudayaan, Riset dan Teknologi Republik
                    Indonesia Nomor 23 Tahun 2024 Tentang Statuta Politeknik Negeri Jember;</div>
            </li>
            <li class="konsideran-item">
                <i class="bi bi-journal-check konsideran-icon"></i>
                <div class="konsideran-text">Keputusan Direktur Politeknik Negeri Jember No 19846/PL17/PR/2024 tentang
                    Rencana Pengembangan Jangka Panjang Politeknik Negeri Jember Tahun 2045;</div>
            </li>
            <li class="konsideran-item">
                <i class="bi bi-clipboard-data konsideran-icon"></i>
                <div class="konsideran-text">Keputusan Direktur Politeknik Negeri Jember Nomor 719/PL17/PR/2025 tentang
                    Rencana Strategis Politeknik Negeri Jember 2025-2029.</div>
            </li>
        </ul>
    </div>

    {{-- Navbar Bawah --}}
    @include('layouts.NavbarBawah')
</body>

</html>