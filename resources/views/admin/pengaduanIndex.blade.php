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
    <title>Daftar Pengaduan Masyarakat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(to bottom right, #667eea, #764ba2, #f093fb);
            min-height: 100vh;
            position: relative;
            padding-bottom: 100px;
        }

        /* Floating shapes background */
        .floating-shapes {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            overflow: hidden;
            z-index: 0;
            pointer-events: none;
        }

        .shape {
            position: absolute;
            opacity: 0.1;
            animation: float 20s infinite ease-in-out;
        }

        .shape:nth-child(1) {
            top: 10%;
            left: 10%;
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            top: 60%;
            right: 10%;
            width: 120px;
            height: 120px;
            background: white;
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            animation-delay: 3s;
        }

        .shape:nth-child(3) {
            bottom: 20%;
            left: 20%;
            width: 100px;
            height: 100px;
            background: white;
            border-radius: 20px;
            animation-delay: 6s;
        }

        .shape:nth-child(4) {
            top: 30%;
            right: 30%;
            width: 60px;
            height: 60px;
            background: white;
            border-radius: 50%;
            animation-delay: 9s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
            }
            25% {
                transform: translateY(-30px) rotate(90deg);
            }
            50% {
                transform: translateY(0) rotate(180deg);
            }
            75% {
                transform: translateY(-20px) rotate(270deg);
            }
        }

        .container {
            position: relative;
            z-index: 1;
        }

        /* Header */
        .page-header {
            text-align: center;
            margin: 40px 0;
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
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 2px 4px 8px rgba(0,0,0,0.2);
        }

        .page-header p {
            color: rgba(255,255,255,0.9);
            font-size: 1.2rem;
            font-weight: 300;
        }

        /* Status Tabs */
        .status-tabs {
            display: flex;
            gap: 15px;
            margin: 30px 0;
            flex-wrap: wrap;
            justify-content: center;
            animation: fadeIn 1s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .status-tab {
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255,255,255,0.3);
            padding: 12px 30px;
            border-radius: 50px;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
            text-transform: capitalize;
        }

        .status-tab:hover {
            background: rgba(255,255,255,0.3);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        .status-tab.active {
            background: white;
            color: #667eea;
            border-color: white;
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
        }

        /* Alert */
        .alert-custom {
            background: white;
            border: none;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            animation: slideInRight 0.5s ease;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Cards Container */
        .status-section {
            margin-bottom: 50px;
            animation: fadeInUp 0.6s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .status-section h3 {
            color: white;
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 25px;
            padding-left: 15px;
            position: relative;
        }

        .status-section h3::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 5px;
            height: 30px;
            background: white;
            border-radius: 10px;
        }

        /* Card Design */
        .pengaduan-card {
            background: white;
            border-radius: 25px;
            padding: 25px;
            height: 100%;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        
        .pengaduan-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.25);
        }

        .pengaduan-card:hover::before {
            width: 100%;
            opacity: 0.05;
        }

        .card-header-custom {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
            gap: 15px;
        }

        .card-title-custom {
            font-size: 1.3rem;
            font-weight: 600;
            color: #2d3748;
            margin: 0;
            line-height: 1.4;
        }

        .badge-status {
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }

        .badge-selesai {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        .badge-tindak {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }

        .badge-verifikasi {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
        }

        .badge-laporan {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            color: white;
        }

        .badge-tanggapan {
            background: linear-gradient(135deg, #ec4899, #db2777);
            color: white;
        }

        /* Info Items */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin: 20px 0;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px;
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .info-item:hover {
            background: linear-gradient(135deg, #e0e7ff, #dbeafe);
            transform: translateX(5px);
        }

        .info-icon {
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border-radius: 10px;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .info-content {
            font-size: 0.85rem;
            color: #4b5563;
            line-height: 1.3;
        }

        .info-content strong {
            color: #1f2937;
            display: block;
            margin-bottom: 2px;
        }

        /* Admin Form */
        .admin-form {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            padding: 15px;
            border-radius: 15px;
            margin: 20px 0;
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .admin-form select {
            flex: 1;
            border: 2px solid #f59e0b;
            border-radius: 12px;
            padding: 10px;
            font-weight: 500;
            background: white;
            transition: all 0.3s ease;
        }

        .admin-form select:focus {
            outline: none;
            border-color: #d97706;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
        }

        .admin-form button {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .admin-form button:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(245, 158, 11, 0.4);
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-action {
            flex: 1;
            padding: 12px 20px;
            border: none;
            border-radius: 15px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-view {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .btn-view:hover {
            background: linear-gradient(135deg, #5568d3, #6a3f8f);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-delete {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        .btn-delete:hover {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.4);
        }

        /* Back Button */
        .back-section {
            text-align: center;
            margin: 60px 0 40px;
        }

        .btn-back {
            background: white;
            color: #667eea;
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
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .btn-back:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.3);
            background: linear-gradient(135deg, white, #f8fafc);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 2rem;
            }

            .page-header p {
                font-size: 1rem;
            }

            .status-tabs {
                gap: 10px;
            }

            .status-tab {
                padding: 10px 20px;
                font-size: 0.9rem;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
            }
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: white;
        }

        .empty-state i {
            font-size: 4rem;
            opacity: 0.5;
            margin-bottom: 20px;
        }

        .empty-state p {
            font-size: 1.2rem;
            opacity: 0.8;
        }
    </style>
</head>

<body>
    <!-- Floating Shapes Background -->
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    {{-- Navbar Atas --}}
    @include('layouts.navbar')

    <div class="container py-5">
        <!-- Page Header -->
        <div class="page-header">
            <h1><i class="bi bi-megaphone-fill"></i> Pengaduan Masyarakat</h1>
            <p>Transparansi & Akuntabilitas Pelayanan Publik</p>
        </div>
<!-- Tambahkan setelah Page Header, sebelum Status Tabs -->

        <div class="text-center mb-4">
            <a href="{{ route('bidang.index') }}" class="btn-add">
                <i class="bi bi-grid-3x3-gap-fill"></i> Kelola Bidang
            </a>
        </div>
        <div class="text-center mb-4">
            <a href="{{ route('admin.roleBidang.index') }}" class="btn-add">
                <i class="bi bi-grid-3x3-gap-fill"></i> Kelola role
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-custom alert-dismissible fade show" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-check-circle-fill text-success fs-4 me-3"></i>
                    <div>
                        <strong>Berhasil!</strong> {{ session('success') }}
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Status Tabs -->
        <div class="status-tabs">
            <div class="status-tab active" data-status="all">Semua</div>
            <div class="status-tab" data-status="laporan_dikirim">Laporan Dikirim</div>
            <div class="status-tab" data-status="diverifikasi">Diverifikasi</div>
            <div class="status-tab" data-status="tindak_lanjut">Tindak Lanjut</div>
            <div class="status-tab" data-status="tanggapan_pelapor">Tanggapan Pelapor</div>
            <div class="status-tab" data-status="selesai">Selesai</div>
        </div>

        <!-- Laporan Dikirim Section -->
        <div class="status-section" data-section="laporan_dikirim">
            <h3><i class="bi bi-send-fill me-2"></i>Laporan Dikirim</h3>
            <div class="row g-4">
                @php
                    $laporanDikirim = $pengaduans->where('status', 'laporan_dikirim');
                @endphp
                @if($laporanDikirim->count() > 0)
                    @foreach($laporanDikirim as $p)
                        <div class="col-md-6 col-lg-4">
                            <div class="pengaduan-card">
                                <div class="card-header-custom">
                                    <h5 class="card-title-custom">{{ $p->perihal }}</h5>
                                    <span class="badge-status badge-laporan">Laporan</span>
                                </div>

                                <div class="info-grid">
                                    <div class="info-item">
                                        <div class="info-icon"><i class="bi bi-calendar-event"></i></div>
                                        <div class="info-content">
                                            <strong>Tanggal</strong>
                                            {{ \Carbon\Carbon::parse($p->tanggal_pengaduan)->format('d M Y') }}
                                        </div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-icon"><i class="bi bi-clock"></i></div>
                                        <div class="info-content">
                                            <strong>Dibuat</strong>
                                            {{ $p->created_at->format('d M Y') }}
                                        </div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-icon"><i class="bi bi-mortarboard"></i></div>
                                        <div class="info-content">
                                            <strong>Pendidikan</strong>
                                            {{ $p->pendidikan }}
                                        </div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-icon"><i class="bi bi-briefcase"></i></div>
                                        <div class="info-content">
                                            <strong>Pekerjaan</strong>
                                            {{ $p->pekerjaan }}
                                        </div>
                                    </div>
                                </div>

                               @auth
    @if(auth()->user()->role === 'admin')
        {{-- Kontainer dengan gaya background kuning dan sudut bulat --}}
        <div style="background-color: #ffeebf; padding: 30px 20px 20px; border-radius: 15px; position: relative; display: flex; align-items: center; gap: 15px;">

            <form action="{{ route('pengaduan.updateStatus', $p->id) }}" method="POST" style="display: flex; align-items: center; width: 100%; gap: 15px;">
                @csrf
                @method('PATCH')

                {{-- Label Melayang --}}
                <label for="status-select" style="background-color: #ff9933; color: white; padding: 5px 10px; border-radius: 8px; font-weight: bold; position: absolute; top: -15px; left: 10px; z-index: 10;">
                    status laporan saat ini :
                </label>

                {{-- Select Box --}}
                @php $currentStatus = $p->status ?? 'laporan_dikirim'; @endphp
                <select name="status" id="status-select" style="flex-grow: 1; padding: 10px 15px; border-radius: 8px; font-size: 16px; min-width: 200px; cursor: pointer;">
                    <option value="laporan_dikirim" @selected($currentStatus == 'laporan_dikirim')>Laporan Dikirim</option>
                    <option value="diverifikasi" @selected($currentStatus == 'diverifikasi')>Diverifikasi</option>
                    <option value="tindak_lanjut" @selected($currentStatus == 'tindak_lanjut')>Tindak Lanjut</option>
                    <option value="tanggapan_pelapor" @selected($currentStatus == 'tanggapan_pelapor')>Tanggapan Pelapor</option>
                    <option value="selesai" @selected($currentStatus == 'selesai')>Selesai</option>
                </select>

                {{-- Tombol Update --}}
                <button type="submit" style="background-color: #ff9933; color: white; border: none; padding: 10px 25px; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer;">
                    Update
                </button>
            </form>
        </div>
    @endif
@endauth
                                <div class="action-buttons">
                                    <button class="btn-action btn-view" onclick="window.location.href='{{ route('pengaduan.show', $p->id) }}'">
                                        <i class="bi bi-eye-fill"></i> Lihat
                                    </button>
                                    <button class="btn-action btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $p->id }}">
                                        <i class="bi bi-trash-fill"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="empty-state">
                            <i class="bi bi-inbox"></i>
                            <p>Tidak ada laporan yang dikirim</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Diverifikasi Section -->
        <div class="status-section" data-section="diverifikasi">
            <h3><i class="bi bi-check-circle-fill me-2"></i>Diverifikasi</h3>
            <div class="row g-4">
                @php
                    $diverifikasi = $pengaduans->where('status', 'diverifikasi');
                @endphp
                @if($diverifikasi->count() > 0)
                    @foreach($diverifikasi as $p)
                        <div class="col-md-6 col-lg-4">
                            <div class="pengaduan-card">
                                <div class="card-header-custom">
    <h5 class="card-title-custom">{{ $p->perihal }}</h5>
    <span class="badge-status {{ 
        $p->status === 'selesai' ? 'badge-selesai' : 
        ($p->status === 'tindak_lanjut' ? 'badge-tindak' : 
        ($p->status === 'diverifikasi' ? 'badge-verifikasi' :
        ($p->status === 'tanggapan_pelapor' ? 'badge-tanggapan' : 'badge-laporan')))
    }}">
        @if($p->status === 'tanggapan_pelapor' && $p->rejected_at)
            <i class="bi bi-arrow-return-left"></i> Dikembalikan
        @else
            {{ str_replace('_', ' ', ucfirst($p->status)) }}
        @endif
    </span>
</div>

@if($p->status === 'tanggapan_pelapor' && $p->rejected_at)
    <div class="alert alert-warning alert-sm mt-2 mb-2">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <small>
            <strong>Perlu Perbaikan:</strong> 
            {{ $p->rejected_fields_count ?? 0 }} field perlu dikoreksi
        </small>
    </div>
@endif

                                <div class="info-grid">
                                    <div class="info-item">
                                        <div class="info-icon"><i class="bi bi-calendar-event"></i></div>
                                        <div class="info-content">
                                            <strong>Tanggal</strong>
                                            {{ \Carbon\Carbon::parse($p->tanggal_pengaduan)->format('d M Y') }}
                                        </div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-icon"><i class="bi bi-clock"></i></div>
                                        <div class="info-content">
                                            <strong>Dibuat</strong>
                                            {{ $p->created_at->format('d M Y') }}
                                        </div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-icon"><i class="bi bi-mortarboard"></i></div>
                                        <div class="info-content">
                                            <strong>Pendidikan</strong>
                                            {{ $p->pendidikan }}
                                        </div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-icon"><i class="bi bi-briefcase"></i></div>
                                        <div class="info-content">
                                            <strong>Pekerjaan</strong>
                                            {{ $p->pekerjaan }}
                                        </div>
                                    </div>
                                </div>

                                @auth
    @if(auth()->user()->role === 'admin')
        {{-- Kontainer dengan gaya background kuning dan sudut bulat --}}
        <div style="background-color: #ffeebf; padding: 30px 20px 20px; border-radius: 15px; position: relative; display: flex; align-items: center; gap: 15px;">

            <form action="{{ route('pengaduan.updateStatus', $p->id) }}" method="POST" style="display: flex; align-items: center; width: 100%; gap: 15px;">
                @csrf
                @method('PATCH')

                {{-- Label Melayang --}}
                <label for="status-select" style="background-color: #ff9933; color: white; padding: 5px 10px; border-radius: 8px; font-weight: bold; position: absolute; top: -15px; left: 10px; z-index: 10;">
                    status laporan saat ini :
                </label>

                {{-- Select Box --}}
                @php $currentStatus = $p->status ?? 'laporan_dikirim'; @endphp
                <select name="status" id="status-select" style="flex-grow: 1; padding: 10px 15px; border-radius: 8px; font-size: 16px; min-width: 200px;">
                    
                    <option value="diverifikasi" @selected($currentStatus == 'diverifikasi')>Diverifikasi</option>
                  
                </select>

                {{-- Tombol Update --}}
                <button type="submit" style="background-color: #ff9933; color: white; border: none; padding: 10px 25px; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer;">
                    Update
                </button>
            </form>
        </div>
    @endif
@endauth

                                <div class="action-buttons">
                                    <button class="btn-action btn-view" onclick="window.location.href='{{ route('pengaduan.show', $p->id) }}'">
                                        <i class="bi bi-eye-fill"></i> Lihat
                                    </button>
                                    <button class="btn-action btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $p->id }}">
                                        <i class="bi bi-trash-fill"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="empty-state">
                            <i class="bi bi-inbox"></i>
                            <p>Tidak ada laporan yang diverifikasi</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Tindak Lanjut Section -->
        <div class="status-section" data-section="tindak_lanjut">
            <h3><i class="bi bi-arrow-repeat me-2"></i>Tindak Lanjut</h3>
            <div class="row g-4">
                @php
                    $tindakLanjut = $pengaduans->where('status', 'tindak_lanjut');
                @endphp
                @if($tindakLanjut->count() > 0)
                    @foreach($tindakLanjut as $p)
                        <div class="col-md-6 col-lg-4">
                            <div class="pengaduan-card">
                                <div class="card-header-custom">
                                    <h5 class="card-title-custom">{{ $p->perihal }}</h5>
                                    <span class="badge-status badge-tindak">Proses</span>
                                </div>

                                <div class="info-grid">
                                    <div class="info-item">
                                        <div class="info-icon"><i class="bi bi-calendar-event"></i></div>
                                        <div class="info-content">
                                            <strong>Tanggal</strong>
                                            {{ \Carbon\Carbon::parse($p->tanggal_pengaduan)->format('d M Y') }}
                                        </div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-icon"><i class="bi bi-clock"></i></div>
                                        <div class="info-content">
                                            <strong>Dibuat</strong>
                                            {{ $p->created_at->format('d M Y') }}
                                        </div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-icon"><i class="bi bi-mortarboard"></i></div>
                                        <div class="info-content">
                                            <strong>Pendidikan</strong>
                                            {{ $p->pendidikan }}
                                        </div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-icon"><i class="bi bi-briefcase"></i></div>
                                        <div class="info-content">
                                            <strong>Pekerjaan</strong>
                                            {{ $p->pekerjaan }}
                                        </div>
                                    </div>
                                </div>

                                @auth
    @if(auth()->user()->role === 'admin')
        {{-- Kontainer dengan gaya background kuning dan sudut bulat --}}
        <div style="background-color: #ffeebf; padding: 30px 20px 20px; border-radius: 15px; position: relative; display: flex; align-items: center; gap: 15px;">

            <form action="{{ route('pengaduan.updateStatus', $p->id) }}" method="POST" style="display: flex; align-items: center; width: 100%; gap: 15px;">
                @csrf
                @method('PATCH')

                {{-- Label Melayang --}}
                <label for="status-select" style="background-color: #ff9933; color: white; padding: 5px 10px; border-radius: 8px; font-weight: bold; position: absolute; top: -15px; left: 10px; z-index: 10;">
                    status laporan saat ini :
                </label>

                {{-- Select Box --}}
                @php $currentStatus = $p->status ?? 'laporan_dikirim'; @endphp
                <select name="status" id="status-select" style="flex-grow: 1; padding: 10px 15px; border-radius: 8px; font-size: 16px; min-width: 200px;">
                    <option value="laporan_dikirim" @selected($currentStatus == 'laporan_dikirim')>Laporan Dikirim</option>
                    <option value="diverifikasi" @selected($currentStatus == 'diverifikasi')>Diverifikasi</option>
                    <option value="tindak_lanjut" @selected($currentStatus == 'tindak_lanjut')>Tindak Lanjut</option>
                    <option value="tanggapan_pelapor" @selected($currentStatus == 'tanggapan_pelapor')>Tanggapan Pelapor</option>
                    <option value="selesai" @selected($currentStatus == 'selesai')>Selesai</option>
                </select>

                {{-- Tombol Update --}}
                <button type="submit" style="background-color: #ff9933; color: white; border: none; padding: 10px 25px; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer;">
                    Update
                </button>
            </form>
        </div>
    @endif
@endauth

                                <div class="action-buttons">
                                    <button class="btn-action btn-view" onclick="window.location.href='{{ route('pengaduan.show', $p->id) }}'">
                                        <i class="bi bi-eye-fill"></i> Lihat
                                    </button>
                                    <button class="btn-action btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $p->id }}">
                                        <i class="bi bi-trash-fill"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="empty-state">
                            <i class="bi bi-inbox"></i>
                            <p>Tidak ada laporan dalam tindak lanjut</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Tanggapan Pelapor Section -->
        <div class="status-section" data-section="tanggapan_pelapor">
            <h3><i class="bi bi-chat-dots-fill me-2"></i>Tanggapan Pelapor</h3>
            <div class="row g-4">
                @php
                    $tanggapanPelapor = $pengaduans->where('status', 'tanggapan_pelapor');
                @endphp
                @if($tanggapanPelapor->count() > 0)
                    @foreach($tanggapanPelapor as $p)
                        <div class="col-md-6 col-lg-4">
                            <div class="pengaduan-card">
                                <div class="card-header-custom">
                                    <h5 class="card-title-custom">{{ $p->perihal }}</h5>
                                    <span class="badge-status badge-tanggapan">Tanggapan</span>
                                </div>

                                <div class="info-grid">
                                    <div class="info-item">
                                        <div class="info-icon"><i class="bi bi-calendar-event"></i></div>
                                        <div class="info-content">
                                            <strong>Tanggal</strong>
                                            {{ \Carbon\Carbon::parse($p->tanggal_pengaduan)->format('d M Y') }}
                                        </div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-icon"><i class="bi bi-clock"></i></div>
                                        <div class="info-content">
                                            <strong>Dibuat</strong>
                                            {{ $p->created_at->format('d M Y') }}
                                        </div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-icon"><i class="bi bi-mortarboard"></i></div>
                                        <div class="info-content">
                                            <strong>Pendidikan</strong>
                                            {{ $p->pendidikan }}
                                        </div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-icon"><i class="bi bi-briefcase"></i></div>
                                        <div class="info-content">
                                            <strong>Pekerjaan</strong>
                                            {{ $p->pekerjaan }}
                                        </div>
                                    </div>
                                </div>

                                @auth
    @if(auth()->user()->role === 'admin')
        {{-- Kontainer dengan gaya background kuning dan sudut bulat --}}
        <div style="background-color: #ffeebf; padding: 30px 20px 20px; border-radius: 15px; position: relative; display: flex; align-items: center; gap: 15px;">

            <form action="{{ route('pengaduan.updateStatus', $p->id) }}" method="POST" style="display: flex; align-items: center; width: 100%; gap: 15px;">
                @csrf
                @method('PATCH')

                {{-- Label Melayang --}}
                <label for="status-select" style="background-color: #ff9933; color: white; padding: 5px 10px; border-radius: 8px; font-weight: bold; position: absolute; top: -15px; left: 10px; z-index: 10;">
                    status laporan saat ini :
                </label>

                {{-- Select Box --}}
                @php $currentStatus = $p->status ?? 'laporan_dikirim'; @endphp
                <select name="status" id="status-select" style="flex-grow: 1; padding: 10px 15px; border-radius: 8px; font-size: 16px; min-width: 200px;">
                    <option value="laporan_dikirim" @selected($currentStatus == 'laporan_dikirim')>Laporan Dikirim</option>
                    <option value="diverifikasi" @selected($currentStatus == 'diverifikasi')>Diverifikasi</option>
                    <option value="tindak_lanjut" @selected($currentStatus == 'tindak_lanjut')>Tindak Lanjut</option>
                    <option value="tanggapan_pelapor" @selected($currentStatus == 'tanggapan_pelapor')>Tanggapan Pelapor</option>
                    <option value="selesai" @selected($currentStatus == 'selesai')>Selesai</option>
                </select>

                {{-- Tombol Update --}}
                <button type="submit" style="background-color: #ff9933; color: white; border: none; padding: 10px 25px; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer;">
                    Update
                </button>
            </form>
        </div>
    @endif
@endauth

                                <div class="action-buttons">
                                    <button class="btn-action btn-view" onclick="window.location.href='{{ route('pengaduan.show', $p->id) }}'">
                                        <i class="bi bi-eye-fill"></i> Lihat
                                    </button>
                                    <button class="btn-action btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $p->id }}">
                                        <i class="bi bi-trash-fill"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="empty-state">
                            <i class="bi bi-inbox"></i>
                            <p>Tidak ada tanggapan pelapor</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Selesai Section -->
        <div class="status-section" data-section="selesai">
            <h3><i class="bi bi-check-circle-fill me-2"></i>Selesai</h3>
            <div class="row g-4">
                @php
                    $selesai = $pengaduans->where('status', 'selesai');
                @endphp
                @if($selesai->count() > 0)
                    @foreach($selesai as $p)
                        <div class="col-md-6 col-lg-4">
                            <div class="pengaduan-card">
                                <div class="card-header-custom">
                                    <h5 class="card-title-custom">{{ $p->perihal }}</h5>
                                    <span class="badge-status badge-selesai">Selesai</span>
                                </div>

                                <div class="info-grid">
                                    <div class="info-item">
                                        <div class="info-icon"><i class="bi bi-calendar-event"></i></div>
                                        <div class="info-content">
                                            <strong>Tanggal</strong>
                                            {{ \Carbon\Carbon::parse($p->tanggal_pengaduan)->format('d M Y') }}
                                        </div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-icon"><i class="bi bi-clock"></i></div>
                                        <div class="info-content">
                                            <strong>Dibuat</strong>
                                            {{ $p->created_at->format('d M Y') }}
                                        </div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-icon"><i class="bi bi-mortarboard"></i></div>
                                        <div class="info-content">
                                            <strong>Pendidikan</strong>
                                            {{ $p->pendidikan }}
                                        </div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-icon"><i class="bi bi-briefcase"></i></div>
                                        <div class="info-content">
                                            <strong>Pekerjaan</strong>
                                            {{ $p->pekerjaan }}
                                        </div>
                                    </div>
                                </div>

                               @auth
    @if(auth()->user()->role === 'admin')
        {{-- Kontainer dengan gaya background kuning dan sudut bulat --}}
        <div style="background-color: #ffeebf; padding: 30px 20px 20px; border-radius: 15px; position: relative; display: flex; align-items: center; gap: 15px;">

            <form action="{{ route('pengaduan.updateStatus', $p->id) }}" method="POST" style="display: flex; align-items: center; width: 100%; gap: 15px;">
                @csrf
                @method('PATCH')

                {{-- Label Melayang --}}
                <label for="status-select" style="background-color: #ff9933; color: white; padding: 5px 10px; border-radius: 8px; font-weight: bold; position: absolute; top: -15px; left: 10px; z-index: 10;">
                    status laporan saat ini :
                </label>

                {{-- Select Box --}}
                @php $currentStatus = $p->status ?? 'laporan_dikirim'; @endphp
                <select name="status" id="status-select" style="flex-grow: 1; padding: 10px 15px; border-radius: 8px; font-size: 16px; min-width: 200px;">
                    <option value="laporan_dikirim" @selected($currentStatus == 'laporan_dikirim')>Laporan Dikirim</option>
                    <option value="diverifikasi" @selected($currentStatus == 'diverifikasi')>Diverifikasi</option>
                    <option value="tindak_lanjut" @selected($currentStatus == 'tindak_lanjut')>Tindak Lanjut</option>
                    <option value="tanggapan_pelapor" @selected($currentStatus == 'tanggapan_pelapor')>Tanggapan Pelapor</option>
                    <option value="selesai" @selected($currentStatus == 'selesai')>Selesai</option>
                </select>

                {{-- Tombol Update --}}
                <button type="submit" style="background-color: #ff9933; color: white; border: none; padding: 10px 25px; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer;">
                    Update
                </button>
            </form>
        </div>
    @endif
@endauth

                                <div class="action-buttons">
                                    <button class="btn-action btn-view" onclick="window.location.href='{{ route('pengaduan.show', $p->id) }}'">
                                        <i class="bi bi-eye-fill"></i> Lihat
                                    </button>
                                    <button class="btn-action btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $p->id }}">
                                        <i class="bi bi-trash-fill"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="empty-state">
                            <i class="bi bi-inbox"></i>
                            <p>Tidak ada laporan yang selesai</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Back Button -->
        <div class="back-section">
            <a href="{{ route('landing') }}" class="btn-back">
                <i class="bi bi-arrow-left-circle"></i> Kembali ke Beranda
            </a>
        </div>
    </div>

    {{-- Navbar Bawah --}}
    @include('layouts.NavbarBawah')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Tab Filtering
        const tabs = document.querySelectorAll('.status-tab');
        const sections = document.querySelectorAll('.status-section');

        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                const status = this.getAttribute('data-status');
                
                // Remove active from all tabs
                tabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');

                // Show/hide sections
                if (status === 'all') {
                    sections.forEach(section => {
                        section.style.display = 'block';
                    });
                } else {
                    sections.forEach(section => {
                        const sectionStatus = section.getAttribute('data-section');
                        if (sectionStatus === status) {
                            section.style.display = 'block';
                        } else {
                            section.style.display = 'none';
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>