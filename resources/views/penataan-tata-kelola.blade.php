<!DOCTYPE html>
<html lang="id">
    <style>
        body {
                   overflow-x: hidden;
        }
    </style>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Penataan Tata Kelola - Zona Integritas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <style>
    body { background:#f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
    .content-wrapper { background:#fff; border-radius:10px; padding:32px; margin:32px auto; max-width:1100px; box-shadow:0 6px 16px rgba(0,0,0,0.06); }
    h2 { color:#0d2d50; font-weight:700; }
    .small-muted { font-size:.9rem; color:#6c757d; }
  </style>
</head>
<body>

    {{-- Navbar Atas --}}
    @include('layouts.navbar')

    <div class="container">
        <div class="content-wrapper">
            <h2 class="mb-3">⚙️ Penataan Tata Kelola</h2>
            <p class="small-muted mb-3">Perbaikan tata kelola, SOP, peta proses, dan pemanfaatan teknologi informasi untuk meningkatkan layanan publik dan akuntabilitas.</p>

            <!-- Tabs -->
            <ul class="nav nav-tabs" id="penataanTab" role="tablist">
                <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#dokumen">📄 Dokumen & Kebijakan</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#proses">🔄 Proses Bisnis</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#ti">💻 Teknologi Informasi</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#transparansi">🌐 Keterbukaan</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#monitoring">📊 Monitoring</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#capaian">🏆 Capaian</button></li>
            </ul>

            <div class="tab-content mt-4">
                <div class="tab-pane fade show active" id="dokumen">
                    <h5>📄 Dokumen & Kebijakan</h5>
                    <p>Unggah & publikasi SOP, Roadmap, Peta Proses, dan kebijakan tata kelola.</p>
                </div>

                <div class="tab-pane fade" id="proses">
                    <h5>🔄 Penyederhanaan Proses Bisnis</h5>
                    <ul>
                        <li>Peta proses pelayanan administrasi</li>
                        <li>Penyederhanaan alur perizinan internal</li>
                        <li>Analisis titik risiko dan rekomendasi</li>
                    </ul>
                </div>

                <div class="tab-pane fade" id="ti">
                    <h5>💻 Pemanfaatan Teknologi Informasi</h5>
                    <p>Penggunaan sistem/aplikasi internal untuk mendukung tata kelola yang efisien.</p>
                    <ul>
                        <li>E-SPI (sistem audit & tindak lanjut)</li>
                        <li>Sistem arsip digital</li>
                        <li>Integrasi data antar unit</li>
                    </ul>
                </div>

                <div class="tab-pane fade" id="transparansi">
                    <h5>🌐 Keterbukaan Informasi</h5>
                    <ul>
                        <li>Publikasi SOP di website</li>
                        <li>Standar pelayanan publik</li>
                        <li>Laporan keterbukaan informasi</li>
                    </ul>
                </div>

                <div class="tab-pane fade" id="monitoring">
                    <h5>📊 Monitoring & Evaluasi</h5>
                    <ul>
                        <li>Indikator kepatuhan SOP</li>
                        <li>Laporan audit implementasi</li>
                        <li>Rekap temuan & tindak lanjut</li>
                    </ul>
                </div>

                <div class="tab-pane fade" id="capaian">
                    <h5>🏆 Capaian</h5>
                    <ul>
                        <li>Pengurangan waktu pelayanan</li>
                        <li>Penerapan SOP di semua unit</li>
                        <li>Peningkatan kepuasan layanan</li>
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
