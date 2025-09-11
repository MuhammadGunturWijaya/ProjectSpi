<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Penguatan Pengawasan - Zona Integritas</title>
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
            <h2 class="mb-3">🔎 Penguatan Pengawasan</h2>
            <p class="small-muted mb-3">Upaya memperkuat sistem pengawasan internal untuk mencegah penyalahgunaan wewenang, meningkatkan transparansi, dan akuntabilitas.</p>

            <!-- Tabs -->
            <ul class="nav nav-tabs" id="pengawasanTab" role="tablist">
                <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#whistleblowing">📢 Whistleblowing System</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#gratifikasi">🎁 Pengendalian Gratifikasi</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#laporan">📑 Laporan Pengaduan</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#spip">🛡️ SPIP (Sistem Pengendalian Internal)</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#monitoring">📊 Monitoring & Evaluasi</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#capaian">🏆 Capaian</button></li>
            </ul>

            <div class="tab-content mt-4">
                <div class="tab-pane fade show active" id="whistleblowing">
                    <h5>📢 Whistleblowing System</h5>
                    <p>Implementasi sistem pelaporan pelanggaran (WBS) yang dapat diakses internal/eksternal secara rahasia dan aman.</p>
                </div>

                <div class="tab-pane fade" id="gratifikasi">
                    <h5>🎁 Pengendalian Gratifikasi</h5>
                    <ul>
                        <li>Pedoman penerimaan gratifikasi</li>
                        <li>Pelaporan gratifikasi online</li>
                        <li>Kampanye anti-gratifikasi</li>
                    </ul>
                </div>

                <div class="tab-pane fade" id="laporan">
                    <h5>📑 Laporan Pengaduan</h5>
                    <p>Mekanisme penerimaan dan tindak lanjut laporan masyarakat terkait penyalahgunaan kewenangan.</p>
                    <ul>
                        <li>Form pengaduan online</li>
                        <li>Proses tindak lanjut</li>
                        <li>Laporan hasil investigasi</li>
                    </ul>
                </div>

                <div class="tab-pane fade" id="spip">
                    <h5>🛡️ SPIP (Sistem Pengendalian Internal Pemerintah)</h5>
                    <ul>
                        <li>Evaluasi risiko unit kerja</li>
                        <li>Pemetaan kontrol internal</li>
                        <li>Audit kepatuhan</li>
                    </ul>
                </div>

                <div class="tab-pane fade" id="monitoring">
                    <h5>📊 Monitoring & Evaluasi</h5>
                    <ul>
                        <li>Indikator efektivitas pengawasan</li>
                        <li>Laporan tindak lanjut pengaduan</li>
                        <li>Evaluasi rutin & perbaikan</li>
                    </ul>
                </div>

                <div class="tab-pane fade" id="capaian">
                    <h5>🏆 Capaian</h5>
                    <ul>
                        <li>Peningkatan jumlah laporan yang ditindaklanjuti</li>
                        <li>Penurunan kasus gratifikasi</li>
                        <li>SPIP level maturitas meningkat</li>
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
