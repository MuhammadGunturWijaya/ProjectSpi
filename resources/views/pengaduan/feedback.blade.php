@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="detail-card mx-auto" style="max-width: 900px;">
        <!-- Header -->
        <div class="page-header mb-4">
            <h1><i class="bi bi-chat-left-text-fill"></i> Feedback dari Admin</h1>
            <p class="subtitle">Laporan Anda memerlukan perbaikan</p>
        </div>

        <!-- Status Alert -->
        <div class="alert alert-warning" role="alert">
            <h5 class="alert-heading"><i class="bi bi-exclamation-triangle-fill"></i> Laporan Dikembalikan</h5>
            <p>Admin telah memeriksa laporan Anda dan meminta untuk melakukan perbaikan pada beberapa bagian.</p>
            <hr>
            <p class="mb-0">
                <strong>Dikembalikan pada:</strong> {{ $pengaduan->rejected_at ? \Carbon\Carbon::parse($pengaduan->rejected_at)->format('d M Y, H:i') : '-' }}<br>
                <strong>Oleh:</strong> {{ $pengaduan->rejectedBy->name ?? 'Admin' }}
            </p>
        </div>

        <!-- Catatan dari Admin -->
        @if($pengaduan->rejection_reason)
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-pencil-square"></i> Catatan dari Admin</h5>
            </div>
            <div class="card-body">
                <p style="white-space: pre-line;">{{ $pengaduan->rejection_reason }}</p>
            </div>
        </div>
        @endif

        <!-- Ringkasan Status Verifikasi -->
        @php
            $verificationChecks = json_decode($pengaduan->verification_checks, true) ?? [];
            $approvedFields = collect($verificationChecks)->filter(fn($v) => $v === 'yes')->count();
            $rejectedFields = collect($verificationChecks)->filter(fn($v) => $v === 'no')->count();
            $fieldsToFix = json_decode($pengaduan->fields_to_fix, true) ?? [];
        @endphp

        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="bi bi-clipboard-check"></i> Ringkasan Verifikasi</h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-6">
                        <div class="stat-box bg-success-light">
                            <h2 class="text-success">{{ $approvedFields }}</h2>
                            <p class="mb-0"><i class="bi bi-check-circle"></i> Field Sudah Benar</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="stat-box bg-danger-light">
                            <h2 class="text-danger">{{ $rejectedFields }}</h2>
                            <p class="mb-0"><i class="bi bi-x-circle"></i> Field Perlu Diperbaiki</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Field yang Perlu Diperbaiki -->
        <div class="card mb-4">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0"><i class="bi bi-exclamation-octagon"></i> Field yang Perlu Anda Perbaiki</h5>
            </div>
            <div class="card-body">
                @if(count($fieldsToFix) > 0)
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i> Anda hanya perlu memperbaiki <strong>{{ count($fieldsToFix) }} field</strong> yang ditandai di bawah ini.
                    Field lainnya sudah benar dan tidak perlu diubah.
                </div>
                
                <ul class="list-group">
                    @foreach($fieldsToFix as $field)
                    <li class="list-group-item list-group-item-danger">
                        <i class="bi bi-x-circle-fill text-danger"></i>
                        <strong>{{ ucwords(str_replace('_', ' ', $field)) }}</strong>
                    </li>
                    @endforeach
                </ul>
                @else
                <p class="text-muted mb-0">Tidak ada field yang perlu diperbaiki.</p>
                @endif
            </div>
        </div>

        <!-- Detail Field yang Sudah Benar -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="bi bi-check-circle"></i> Field yang Sudah Benar</h5>
            </div>
            <div class="card-body">
                @php
                    $approvedFieldsList = collect($verificationChecks)
                        ->filter(fn($v) => $v === 'yes')
                        ->keys()
                        ->toArray();
                @endphp
                
                @if(count($approvedFieldsList) > 0)
                <div class="alert alert-success">
                    <i class="bi bi-shield-check"></i> Field-field ini sudah disetujui admin dan <strong>tidak perlu diubah</strong>.
                </div>
                
                <ul class="list-group">
                    @foreach($approvedFieldsList as $field)
                    <li class="list-group-item list-group-item-success">
                        <i class="bi bi-check-circle-fill text-success"></i>
                        <strong>{{ ucwords(str_replace('_', ' ', $field)) }}</strong>
                    </li>
                    @endforeach
                </ul>
                @else
                <p class="text-muted mb-0">Belum ada field yang disetujui.</p>
                @endif
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex gap-3 justify-content-center mt-4">
            <a href="{{ route('pengaduan.edit', $pengaduan->id) }}" class="btn btn-primary btn-lg">
                <i class="bi bi-pencil-fill"></i> Mulai Perbaiki ({{ count($fieldsToFix) }} Field)
            </a>
            <a href="{{ route('pengaduan.create') }}" class="btn btn-secondary btn-lg">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>

<style>
.detail-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    padding: 30px;
}

.page-header h1 {
    color: #2c3e50;
    font-weight: 700;
    margin-bottom: 10px;
}

.subtitle {
    color: #7f8c8d;
    font-size: 1.1rem;
}

.stat-box {
    padding: 20px;
    border-radius: 10px;
    margin: 10px 0;
}

.bg-success-light {
    background-color: #d4edda;
    border: 2px solid #28a745;
}

.bg-danger-light {
    background-color: #f8d7da;
    border: 2px solid #dc3545;
}

.stat-box h2 {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 10px;
}

.list-group-item {
    font-size: 1.05rem;
    padding: 15px 20px;
}

.list-group-item i {
    margin-right: 10px;
    font-size: 1.2rem;
}

.btn-lg {
    padding: 12px 30px;
    font-weight: 600;
    border-radius: 8px;
}

.alert {
    border-radius: 8px;
}
</style>
@endsection