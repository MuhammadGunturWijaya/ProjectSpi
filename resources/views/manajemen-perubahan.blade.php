<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Perubahan - Zona Integritas</title>
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
            max-width: 1100px;
            box-shadow: 0 6px 16px rgba(0,0,0,0.08);
        }
        h2 {
            font-weight: 700;
            color: #0d2d50;
        }
        .nav-tabs .nav-link {
            font-weight: 500;
        }
    </style>
</head>
<body>
    {{-- Navbar Atas --}}
    @include('layouts.navbar')

    <div class="container">
        <div class="content-wrapper">
            <h2 class="mb-4">📌 Manajemen Perubahan</h2>
            <p>
                Manajemen Perubahan adalah area pengungkit pertama dalam pembangunan Zona Integritas.
                Fokusnya mengubah pola pikir (mindset) dan budaya kerja (culture set) aparatur
                untuk mewujudkan birokrasi yang bersih, profesional, transparan, dan melayani.
            </p>

            <!-- Tabs -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item"><button class="nav-link active" id="roadmap-tab" data-bs-toggle="tab" data-bs-target="#roadmap" type="button" role="tab">📄 Roadmap</button></li>
                <li class="nav-item"><button class="nav-link" id="tim-tab" data-bs-toggle="tab" data-bs-target="#tim" type="button" role="tab">👥 Tim</button></li>
                <li class="nav-item"><button class="nav-link" id="agen-tab" data-bs-toggle="tab" data-bs-target="#agen" type="button" role="tab">🌟 Agen Perubahan</button></li>
                <li class="nav-item"><button class="nav-link" id="kegiatan-tab" data-bs-toggle="tab" data-bs-target="#kegiatan" type="button" role="tab">📢 Kegiatan</button></li>
                <li class="nav-item"><button class="nav-link" id="monitoring-tab" data-bs-toggle="tab" data-bs-target="#monitoring" type="button" role="tab">📊 Monitoring</button></li>
                <li class="nav-item"><button class="nav-link" id="capaian-tab" data-bs-toggle="tab" data-bs-target="#capaian" type="button" role="tab">🏆 Capaian</button></li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content mt-4" id="myTabContent">
                <!-- Roadmap -->
                <div class="tab-pane fade show active" id="roadmap" role="tabpanel">
                    <h4>📄 Roadmap & Dokumen</h4>
                    <ul>
                        <li><a href="#">📌 SK Tim Pembangunan ZI (PDF)</a></li>
                        <li><a href="#">📌 Roadmap ZI SPI</a></li>
                        <li><a href="#">📌 Rencana Kerja Tahunan</a></li>
                    </ul>
                </div>

                <!-- Tim -->
                <div class="tab-pane fade" id="tim" role="tabpanel">
                    <h4>👥 Tim Pembangunan Zona Integritas</h4>
                    <img src="{{ asset('images/tim-zi.png') }}" alt="Struktur Tim" class="img-fluid rounded shadow">
                </div>

                <!-- Agen -->
                <div class="tab-pane fade" id="agen" role="tabpanel">
                    <h4>🌟 Agen Perubahan</h4>
                    <ul>
                        <li>Nama Agen 1 – Unit A</li>
                        <li>Nama Agen 2 – Unit B</li>
                        <li>Nama Agen 3 – Unit C</li>
                    </ul>
                </div>

                <!-- Kegiatan -->
                <div class="tab-pane fade" id="kegiatan" role="tabpanel">
                    <h4>📢 Kegiatan Sosialisasi</h4>
                    <ul>
                        <li>Workshop Budaya Kerja</li>
                        <li>Sosialisasi Kode Etik & Anti Korupsi</li>
                        <li>Pelatihan Agen Perubahan</li>
                    </ul>
                </div>

                <!-- Monitoring -->
                <div class="tab-pane fade" id="monitoring" role="tabpanel">
                    <h4>📊 Monitoring & Evaluasi</h4>
                    <ul>
                        <li>Laporan Triwulan I</li>
                        <li>Laporan Triwulan II</li>
                        <li>Laporan Akhir Tahun</li>
                    </ul>
                </div>

                <!-- Capaian -->
                <div class="tab-pane fade" id="capaian" role="tabpanel">
                    <h4>🏆 Capaian</h4>
                    <ul>
                        <li>Peningkatan disiplin pegawai</li>
                        <li>Inovasi layanan publik</li>
                        <li>Peningkatan kepuasan pengguna layanan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Navbar Bawah --}}
    @include('layouts.NavbarBawah')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
