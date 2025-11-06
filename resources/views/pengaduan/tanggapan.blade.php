@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
    }

    .detail-card {
        background: white;
        border-radius: 30px;
        padding: 40px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        max-width: 900px;
        margin: 0 auto;
    }

    .page-header {
        text-align: center;
        margin: 40px 0;
        color: white;
    }

    .page-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        text-shadow: 2px 4px 8px rgba(0,0,0,0.2);
    }

    .timeline-tanggapan {
        position: relative;
        padding-left: 50px;
    }

    .timeline-tanggapan::before {
        content: '';
        position: absolute;
        left: 20px;
        top: 0;
        bottom: 0;
        width: 3px;
        background: linear-gradient(to bottom, #667eea, #764ba2);
    }

    .timeline-item {
        position: relative;
        margin-bottom: 30px;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 15px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: -38px;
        top: 25px;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: white;
        border: 4px solid #667eea;
        box-shadow: 0 0 0 4px white;
    }

    .timeline-item.from-admin::before {
        border-color: #0d6efd;
    }

    .timeline-item.from-pelapor::before {
        border-color: #198754;
    }

    .timeline-item.from-admin {
        background: linear-gradient(135deg, #e7f1ff, #f8f9fa);
        border-left: 4px solid #0d6efd;
    }

    .timeline-item.from-pelapor {
        background: linear-gradient(135deg, #d4edda, #f8f9fa);
        border-left: 4px solid #198754;
    }

    .timeline-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid rgba(0,0,0,0.1);
    }

    .timeline-header i {
        font-size: 1.5rem;
    }

    .timeline-content {
        color: #212529;
        line-height: 1.8;
    }

    .info-box {
        background: #f8f9fa;
        padding: 15px 20px;
        border-radius: 12px;
        margin-bottom: 15px;
        border-left: 4px solid #667eea;
    }

    .btn-back {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 15px 40px;
        border: none;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        transition: all 0.3s ease;
    }

    .btn-back:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(102, 126, 234, 0.5);
        color: white;
    }

    .status-badge {
        display: inline-block;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .status-selesai {
        background: #198754;
        color: white;
    }

    .status-tanggapan {
        background: #0d6efd;
        color: white;
    }

    .status-tindak {
        background: #ffc107;
        color: #000;
    }
</style>

<div class="container py-5">
    <div class="page-header">
        <h1><i class="bi bi-chat-dots-fill"></i> Detail Tanggapan Pengaduan</h1>
        <p>Komunikasi antara pelapor dan pihak berwenang</p>
    </div>

    <div class="detail-card">
        <!-- Info Pengaduan -->
        <div class="mb-4">
            <h5 class="fw-bold text-primary mb-3">Informasi Pengaduan</h5>
            <div class="info-box">
                <strong>Perihal:</strong> {{ $pengaduan->perihal }}
            </div>
            <div class="info-box">
                <strong>Kode Aduan:</strong> {{ $pengaduan->kode_aduan }}
            </div>
            <div class="info-box">
                <strong>Status:</strong> 
                <span class="status-badge 
                    @if($pengaduan->status == 'selesai') status-selesai
                    @elseif($pengaduan->status == 'tanggapan_pelapor') status-tanggapan
                    @else status-tindak
                    @endif">
                    {{ str_replace('_', ' ', ucfirst($pengaduan->status)) }}
                </span>
            </div>
            @if($pengaduan->bidangPengaduan)
                <div class="info-box">
                    <strong>Ditangani oleh Bidang:</strong> {{ $pengaduan->bidangPengaduan->nama_bidang }}
                </div>
            @endif
            @if($pengaduan->roleBidang)
                <div class="info-box">
                    <strong>Role Penanganan:</strong> {{ $pengaduan->roleBidang->nama_role }}
                </div>
            @endif
        </div>

        <!-- Timeline Tanggapan -->
        @if($pengaduan->history_tanggapan && count($pengaduan->history_tanggapan) > 0)
            <div class="mb-4">
                <h5 class="fw-bold text-primary mb-4">Riwayat Komunikasi</h5>
                <div class="timeline-tanggapan">
                    @foreach($pengaduan->history_tanggapan as $history)
                        <div class="timeline-item {{ $history['type'] === 'admin' ? 'from-admin' : 'from-pelapor' }}">
                            <div class="timeline-header">
                                <i class="bi {{ $history['type'] === 'admin' ? 'bi-person-badge-fill text-primary' : 'bi-person-fill text-success' }}"></i>
                                <strong>{{ $history['type'] === 'admin' ? 'Pihak Berwenang' : 'Pelapor' }}</strong>
                                <span class="ms-auto text-muted">
                                    {{ \Carbon\Carbon::parse($history['created_at'])->format('d M Y, H:i') }}
                                </span>
                            </div>
                            <div class="timeline-content">
                                {{ $history['content'] }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> Belum ada riwayat tanggapan untuk pengaduan ini.
            </div>
        @endif

        <!-- Tanggapan Terbaru -->
        @if($pengaduan->tanggapan_admin && $pengaduan->status === 'tanggapan_pelapor')
            <div class="alert alert-primary">
                <h6 class="fw-bold mb-2"><i class="bi bi-chat-left-text-fill"></i> Tanggapan Terbaru</h6>
                <p class="mb-1">{{ $pengaduan->tanggapan_admin }}</p>
                <small class="text-muted">
                    Diberikan pada {{ $pengaduan->tanggapan_admin_at->format('d M Y, H:i') }}
                </small>
            </div>
        @endif

        <!-- Status Selesai -->
        @if($pengaduan->status === 'selesai')
            <div class="alert alert-success">
                <i class="bi bi-check-circle-fill"></i>
                <strong>Pengaduan Telah Selesai</strong>
                @if($pengaduan->status_kepuasan === 'puas')
                    <br>Pelapor telah menyatakan puas dengan penanganan yang diberikan.
                @endif
            </div>
        @endif

        <!-- Tombol Kembali -->
        <div class="text-center mt-4">
            <a href="{{ route('pengaduan.create') }}" class="btn-back">
                <i class="bi bi-arrow-left-circle"></i> Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection