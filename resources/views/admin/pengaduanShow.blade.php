@extends('layouts.app')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            position: relative;
        }

        /* Floating shapes background */
        .floating-bg {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            overflow: hidden;
            z-index: 0;
            pointer-events: none;
        }

        .float-shape {
            position: absolute;
            opacity: 0.08;
            animation: floating 15s infinite ease-in-out;
        }

        .float-shape:nth-child(1) {
            top: 20%;
            left: 15%;
            width: 100px;
            height: 100px;
            background: white;
            border-radius: 50%;
            animation-delay: 0s;
        }

        .float-shape:nth-child(2) {
            top: 60%;
            right: 15%;
            width: 150px;
            height: 150px;
            background: white;
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            animation-delay: 3s;
        }

        .float-shape:nth-child(3) {
            bottom: 15%;
            left: 25%;
            width: 120px;
            height: 120px;
            background: white;
            border-radius: 20px;
            animation-delay: 6s;
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-30px) rotate(180deg);
            }
        }

        .container {
            position: relative;
            z-index: 1;
        }

        /* Header */
        .page-header {
            text-align: center;
            margin: 40px 0 50px;
            animation: fadeInDown 0.8s ease;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .page-header h1 {
            color: white;
            font-size: 2.5rem;
            font-weight: 700;
            text-shadow: 2px 4px 8px rgba(0, 0, 0, 0.2);
            margin-bottom: 10px;
        }

        .page-header .subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
            font-weight: 300;
        }

        /* Main Card */
        .detail-card {
            background: white;
            border-radius: 30px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: fadeInUp 0.8s ease;
            position: relative;
            overflow: hidden;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .detail-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #667eea, #764ba2, #f093fb);
        }

        /* Section Headers */
        .section-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin: 35px 0 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }

        .section-header .icon-box {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        .section-header h5 {
            margin: 0;
            color: #2d3748;
            font-size: 1.4rem;
            font-weight: 600;
        }

        /* Info Boxes */
        .info-box {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
            border-left: 4px solid #667eea;
            transition: all 0.3s ease;
        }

        .info-box:hover {
            transform: translateX(5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .info-box strong {
            color: #4a5568;
            display: block;
            margin-bottom: 8px;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-box .value {
            color: #2d3748;
            font-size: 1.05rem;
            font-weight: 500;
        }

        /* Grid Info */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin: 20px 0;
        }

        .info-item {
            background: white;
            border: 2px solid #e2e8f0;
            padding: 18px;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .info-item:hover {
            border-color: #667eea;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.2);
            transform: translateY(-3px);
        }

        .info-item strong {
            display: block;
            color: #667eea;
            font-size: 0.85rem;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .info-item .value {
            color: #2d3748;
            font-size: 1rem;
            font-weight: 500;
        }

        /* List Styles */
        .custom-list {
            list-style: none;
            padding: 0;
        }

        .custom-list li {
            padding: 12px 15px;
            background: linear-gradient(135deg, #f8fafc, #ffffff);
            margin-bottom: 10px;
            border-radius: 10px;
            border-left: 3px solid #667eea;
            transition: all 0.3s ease;
        }

        .custom-list li:hover {
            transform: translateX(5px);
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .custom-list li::before {
            content: '✓';
            color: #667eea;
            font-weight: bold;
            margin-right: 10px;
        }

        /* Table */
        .modern-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            overflow: hidden;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .modern-table thead {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .modern-table thead th {
            padding: 15px;
            font-weight: 600;
            text-align: left;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .modern-table tbody tr {
            background: white;
            transition: all 0.3s ease;
        }

        .modern-table tbody tr:nth-child(even) {
            background: #f8fafc;
        }

        .modern-table tbody tr:hover {
            background: #e0e7ff;
            transform: scale(1.01);
        }

        .modern-table tbody td {
            padding: 15px;
            border-bottom: 1px solid #e2e8f0;
            color: #2d3748;
        }

        /* Status Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .status-selesai {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        .status-tindak {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }

        .status-verifikasi {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
        }

        .status-laporan {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            color: white;
        }

        .status-tanggapan {
            background: linear-gradient(135deg, #ec4899, #db2777);
            color: white;
        }

        /* File Links */
        .file-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 15px;
        }

        .file-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px 20px;
            background: linear-gradient(135deg, #f8fafc, #ffffff);
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            color: #667eea;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .file-link:hover {
            border-color: #667eea;
            background: linear-gradient(135deg, #e0e7ff, #dbeafe);
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.2);
        }

        .file-link i {
            font-size: 1.5rem;
        }

        /* Buttons */
        .btn-back {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
            text-decoration: none;
        }

        .btn-back:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.5);
            background: linear-gradient(135deg, #5568d3, #6a3f8f);
            color: white;
        }

        .btn-container {
            text-align: center;
            margin-top: 50px;
            padding-top: 30px;
            border-top: 2px solid #f0f0f0;
        }

        /* Uraian Box */
        .uraian-box {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            padding: 25px;
            border-radius: 15px;
            border-left: 5px solid #f59e0b;
            margin: 20px 0;
        }

        .uraian-box p {
            margin: 0;
            color: #78350f;
            line-height: 1.8;
            font-size: 1rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .detail-card {
                padding: 25px;
            }

            .page-header h1 {
                font-size: 1.8rem;
            }

            .section-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .modern-table {
                font-size: 0.85rem;
            }

            .modern-table thead th,
            .modern-table tbody td {
                padding: 10px;
            }
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px;
            color: #94a3b8;
            font-style: italic;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 15px;
            opacity: 0.5;
        }
    </style>

    <!-- Floating Background -->
    <div class="floating-bg">
        <div class="float-shape"></div>
        <div class="float-shape"></div>
        <div class="float-shape"></div>
    </div>

    <div class="container py-5">
        <!-- Page Header -->
        <div class="page-header">
            <h1><i class="bi bi-file-text-fill"></i> Detail Pengaduan</h1>
            <p class="subtitle">Informasi lengkap laporan pengaduan masyarakat</p>
        </div>

        <!-- Main Detail Card -->
        <div class="detail-card mx-auto" style="max-width: 900px;">

            <!-- Info Dasar -->
            <div class="info-box">
                <strong><i class="bi bi-calendar-check me-2"></i>Tanggal Pengaduan</strong>
                <div class="value">{{ \Carbon\Carbon::parse($pengaduan->tanggal_pengaduan)->format('d M Y') }}</div>
            </div>

            <div class="info-box">
                <strong><i class="bi bi-file-earmark-text me-2"></i>Perihal</strong>
                <div class="value">{{ $pengaduan->perihal }}</div>
            </div>

            <div class="info-box">
                <strong><i class="bi bi-card-text me-2"></i>Uraian Pengaduan</strong>
                <div class="uraian-box">
                    <p>{{ $pengaduan->uraian }}</p>
                </div>
            </div>

            <!-- Informasi Pendukung -->
            <div class="section-header">
                <div class="icon-box">
                    <i class="bi bi-person-badge"></i>
                </div>
                <h5>Informasi Pendukung</h5>
            </div>

            <div class="info-grid">
                <div class="info-item">
                    <strong><i class="bi bi-person me-1"></i> Usia</strong>
                    <div class="value">{{ $pengaduan->usia }} tahun</div>
                </div>
                <div class="info-item">
                    <strong><i class="bi bi-mortarboard me-1"></i> Pendidikan</strong>
                    <div class="value">{{ $pengaduan->pendidikan }}</div>
                </div>
                <div class="info-item">
                    <strong><i class="bi bi-briefcase me-1"></i> Pekerjaan</strong>
                    <div class="value">
                        {{ $pengaduan->pekerjaan }}
                        @if($pengaduan->pekerjaan_lain)
                            <br><small class="text-muted">({{ $pengaduan->pekerjaan_lain }})</small>
                        @endif
                    </div>
                </div>
                <div class="info-item">
                    <strong><i class="bi bi-clock me-1"></i> Waktu Hubung</strong>
                    <div class="value">
                        {{ $pengaduan->waktu_hubung }}
                        @if($pengaduan->waktu_lain)
                            <br><small class="text-muted">({{ $pengaduan->waktu_lain }})</small>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Pelanggaran -->
            <div class="section-header">
                <div class="icon-box">
                    <i class="bi bi-exclamation-triangle"></i>
                </div>
                <h5>Jenis Pelanggaran</h5>
            </div>

            @if($pengaduan->pelanggaran || $pengaduan->pelanggaran_lain)
                <ul class="custom-list">
                    @foreach($pengaduan->pelanggaran ?? [] as $p)
                        <li>{{ $p }}</li>
                    @endforeach
                    @if($pengaduan->pelanggaran_lain)
                        <li>{{ $pengaduan->pelanggaran_lain }}</li>
                    @endif
                </ul>
            @else
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <p>Tidak ada data pelanggaran</p>
                </div>
            @endif

            <!-- Kontak -->
            <div class="section-header">
                <div class="icon-box">
                    <i class="bi bi-telephone"></i>
                </div>
                <h5>Kontak yang Bisa Dihubungi</h5>
            </div>

            @php
                $kontak = $pengaduan->kontak;

                // Jika ternyata masih string, coba decode manual
                if (is_string($kontak)) {
                    $kontak = json_decode($kontak, true);
                }

                // Pastikan array agar aman di foreach
                $kontak = is_array($kontak) ? $kontak : [];
            @endphp

            @if(!empty($kontak))
                <ul class="custom-list">
                    @foreach($kontak as $key => $value)
                        @if($value)
                            <li><strong>{{ ucfirst($key) }}:</strong> {{ $value }}</li>
                        @endif
                    @endforeach
                </ul>
            @else
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <p>Tidak ada data kontak</p>
                </div>
            @endif

            <!-- Detail Kejadian -->
            <div class="section-header">
                <div class="icon-box">
                    <i class="bi bi-geo-alt"></i>
                </div>
                <h5>Detail Kejadian</h5>
            </div>

            <div class="info-grid">
                <div class="info-item">
                    <strong><i class="bi bi-calendar-event me-1"></i> Tanggal Kejadian</strong>
                    <div class="value">{{ \Carbon\Carbon::parse($pengaduan->tanggal_kejadian)->format('d M Y') }}</div>
                </div>
                <div class="info-item">
                    <strong><i class="bi bi-clock-history me-1"></i> Waktu Kejadian</strong>
                    <div class="value">{{ $pengaduan->jam_kejadian }}</div>
                </div>
                <div class="info-item" style="grid-column: 1 / -1;">
                    <strong><i class="bi bi-pin-map me-1"></i> Tempat Kejadian</strong>
                    <div class="value">
                        {{ $pengaduan->tempat_kejadian }}
                        @if($pengaduan->tempat_lain)
                            <br><small class="text-muted">({{ $pengaduan->tempat_lain }})</small>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Data Terlapor -->
            <div class="section-header">
                <div class="icon-box">
                    <i class="bi bi-people"></i>
                </div>
                <h5>Data Terlapor</h5>
            </div>

            @if($pengaduan->terlapor)
                @php $terlapors = json_decode($pengaduan->terlapor, true); @endphp
                <div style="overflow-x: auto;">
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Satuan Kerja</th>
                                <th>Jabatan</th>
                                <th>Jenis Kelamin</th>
                            </tr>
                        </thead>
                       @php
    $terlapors = $pengaduan->terlapor ?? [];

    // Jika ternyata string JSON, decode manual
    if (is_string($terlapors)) {
        $decoded = json_decode($terlapors, true);
        $terlapors = is_array($decoded) ? $decoded : [];
    }
@endphp

<tbody>
    @forelse($terlapors as $t)
        <tr>
            <td>{{ $t['nama'] ?? '-' }}</td>
            <td>{{ $t['nip'] ?? '-' }}</td>
            <td>{{ $t['satuan_kerja'] ?? '-' }}</td>
            <td>{{ $t['jabatan'] ?? '-' }}</td>
            <td>{{ $t['jenis_kelamin'] ?? '-' }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center text-muted">Tidak ada data terlapor</td>
        </tr>
    @endforelse
</tbody>

                    </table>
                </div>
            @else
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <p>Tidak ada data terlapor</p>
                </div>
            @endif

            <!-- Pernyataan -->
            <div class="section-header">
                <div class="icon-box">
                    <i class="bi bi-shield-check"></i>
                </div>
                <h5>Pernyataan & Pihak Terkait</h5>
            </div>

            <div class="info-box">
                <strong><i class="bi bi-eye me-2"></i>Identitas Ingin Diketahui Terlapor?</strong>
                <div class="value">{{ $pengaduan->identitas_diketahui }}</div>
            </div>

            <div class="info-box">
                <strong><i class="bi bi-people-fill me-2"></i>Pihak Terkait</strong>
                <div class="value">{{ $pengaduan->pihak_terkait ?? 'Tidak ada' }}</div>
            </div>

            <!-- Bukti -->
           @if($pengaduan->bukti_file || $pengaduan->link_video)
    <div class="section-header">
        <div class="icon-box">
            <i class="bi bi-paperclip"></i>
        </div>
        <h5>Bukti Pendukung</h5>
    </div>

    {{-- Tampilkan file upload --}}
    @if($pengaduan->bukti_file)
        @php $files = json_decode($pengaduan->bukti_file, true); @endphp
        <div class="file-list mb-2">
            @foreach($files as $file)
                <a href="{{ asset('storage/' . $file) }}" target="_blank" class="file-link d-block mb-1">
                    <i class="bi bi-file-earmark-arrow-down"></i>
                    <span>{{ basename($file) }}</span>
                </a>
            @endforeach
        </div>
    @endif

    {{-- Tampilkan link video --}}
    @if($pengaduan->link_video)
        <div class="file-list">
            <a href="{{ $pengaduan->link_video }}" target="_blank" class="file-link d-block mb-1">
                <i class="bi bi-play-circle"></i>
                <span>Video Link</span>
            </a>
        </div>
    @endif
@endif

            <!-- Status -->
            <div class="section-header">
                <div class="icon-box">
                    <i class="bi bi-info-circle"></i>
                </div>
                <h5>Status Pengaduan</h5>
            </div>

            <div style="text-align: center; padding: 20px;">
                <span class="status-badge 
                            @if($pengaduan->status == 'selesai') status-selesai
                            @elseif($pengaduan->status == 'tindak_lanjut') status-tindak
                            @elseif($pengaduan->status == 'diverifikasi') status-verifikasi
                            @elseif($pengaduan->status == 'tanggapan_pelapor') status-tanggapan
                            @else status-laporan
                            @endif">
                    <i class="bi bi-circle-fill" style="font-size: 0.6rem;"></i>
                    {{ str_replace('_', ' ', $pengaduan->status) }}
                </span>
            </div>

            <!-- Back Button -->
            <div class="btn-container">
                <a href="{{ route('pengaduan.index') }}" class="btn-back">
                    <i class="bi bi-arrow-left-circle"></i>
                    Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>
@endsection