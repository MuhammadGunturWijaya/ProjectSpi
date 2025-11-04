@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="detail-card mx-auto" style="max-width: 900px;">
        
        <div class="page-header mb-4">
            <h1><i class="bi bi-pencil-square"></i> Perbaiki Laporan</h1>
            <p class="subtitle">Perbaiki field yang ditandai admin</p>
        </div>

        <div class="alert alert-info" role="alert">
            <h5 class="alert-heading"><i class="bi bi-info-circle-fill"></i> Instruksi Perbaikan</h5>
            <p>Field yang <strong class="text-success">berwarna hijau (✓)</strong> sudah benar dan tidak perlu diperbaiki.</p>
            <p>Field yang <strong class="text-danger">berwarna merah (✗)</strong> perlu Anda perbaiki.</p>
            <p class="mb-0"><strong>Hanya field merah yang bisa diedit!</strong></p>
        </div>

        @if($pengaduan->rejection_reason)
        <div class="alert alert-warning mb-4">
            <h6><i class="bi bi-chat-left-text"></i> Catatan dari Admin:</h6>
            <p class="mb-0" style="white-space: pre-line;">{{ $pengaduan->rejection_reason }}</p>
        </div>
        @endif

        @php
            $verificationChecks = json_decode($pengaduan->verification_checks, true) ?? [];
            $fieldsToFix = json_decode($pengaduan->fields_to_fix, true) ?? [];
            
            // Helper function untuk cek apakah field perlu diperbaiki
            function needsFix($field, $fieldsToFix) {
                return in_array($field, $fieldsToFix);
            }
            
            // Helper function untuk cek status verifikasi
            function getVerificationStatus($field, $verificationChecks) {
                return $verificationChecks[$field] ?? null;
            }
        @endphp

        <form action="{{ route('pengaduan.update', $pengaduan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group mb-3 {{ getVerificationStatus('tanggal_pengaduan', $verificationChecks) === 'yes' ? 'field-approved' : 'field-rejected' }}">
                <label class="form-label">
                    <i class="bi bi-calendar-check"></i> Tanggal Pengaduan
                    @if(getVerificationStatus('tanggal_pengaduan', $verificationChecks) === 'yes')
                        <span class="badge bg-success ms-2"><i class="bi bi-check-lg"></i> Sudah Benar</span>
                    @else
                        <span class="badge bg-danger ms-2"><i class="bi bi-x-lg"></i> Perlu Diperbaiki</span>
                    @endif
                </label>
                <input type="date" 
                        class="form-control" 
                        name="tanggal_pengaduan" 
                        value="{{ $pengaduan->tanggal_pengaduan->format('Y-m-d') }}"
                        {{ needsFix('tanggal_pengaduan', $fieldsToFix) ? '' : 'readonly disabled' }}>
            </div>

            <div class="form-group mb-3 {{ getVerificationStatus('perihal', $verificationChecks) === 'yes' ? 'field-approved' : 'field-rejected' }}">
                <label class="form-label">
                    <i class="bi bi-file-text"></i> Perihal
                    @if(getVerificationStatus('perihal', $verificationChecks) === 'yes')
                        <span class="badge bg-success ms-2"><i class="bi bi-check-lg"></i> Sudah Benar</span>
                    @else
                        <span class="badge bg-danger ms-2"><i class="bi bi-x-lg"></i> Perlu Diperbaiki</span>
                    @endif
                </label>
                <input type="text" 
                        class="form-control" 
                        name="perihal" 
                        value="{{ $pengaduan->perihal }}"
                        {{ needsFix('perihal', $fieldsToFix) ? '' : 'readonly disabled' }}>
            </div>

            <div class="form-group mb-3 {{ getVerificationStatus('uraian', $verificationChecks) === 'yes' ? 'field-approved' : 'field-rejected' }}">
                <label class="form-label">
                    <i class="bi bi-card-text"></i> Uraian Pengaduan
                    @if(getVerificationStatus('uraian', $verificationChecks) === 'yes')
                        <span class="badge bg-success ms-2"><i class="bi bi-check-lg"></i> Sudah Benar</span>
                    @else
                        <span class="badge bg-danger ms-2"><i class="bi bi-x-lg"></i> Perlu Diperbaiki</span>
                    @endif
                </label>
                <textarea class="form-control" 
                            name="uraian" 
                            rows="5"
                            {{ needsFix('uraian', $fieldsToFix) ? '' : 'readonly disabled' }}>{{ $pengaduan->uraian }}</textarea>
            </div>

            <div class="form-group mb-3 {{ getVerificationStatus('usia', $verificationChecks) === 'yes' ? 'field-approved' : 'field-rejected' }}">
                <label class="form-label">
                    <i class="bi bi-person"></i> Usia
                    @if(getVerificationStatus('usia', $verificationChecks) === 'yes')
                        <span class="badge bg-success ms-2"><i class="bi bi-check-lg"></i> Sudah Benar</span>
                    @else
                        <span class="badge bg-danger ms-2"><i class="bi bi-x-lg"></i> Perlu Diperbaiki</span>
                    @endif
                </label>
                <input type="number" 
                        class="form-control" 
                        name="usia" 
                        value="{{ $pengaduan->usia }}"
                        {{ needsFix('usia', $fieldsToFix) ? '' : 'readonly disabled' }}>
            </div>

            <div class="form-group mb-3 {{ getVerificationStatus('pendidikan', $verificationChecks) === 'yes' ? 'field-approved' : 'field-rejected' }}">
                <label class="form-label">
                    <i class="bi bi-mortarboard"></i> Pendidikan
                    @if(getVerificationStatus('pendidikan', $verificationChecks) === 'yes')
                        <span class="badge bg-success ms-2"><i class="bi bi-check-lg"></i> Sudah Benar</span>
                    @else
                        <span class="badge bg-danger ms-2"><i class="bi bi-x-lg"></i> Perlu Diperbaiki</span>
                    @endif
                </label>
                <select class="form-select" 
                        name="pendidikan"
                        {{ needsFix('pendidikan', $fieldsToFix) ? '' : 'disabled' }}>
                    <option value="SD" {{ $pengaduan->pendidikan == 'SD' ? 'selected' : '' }}>SD</option>
                    <option value="SMP" {{ $pengaduan->pendidikan == 'SMP' ? 'selected' : '' }}>SMP</option>
                    <option value="SMA" {{ $pengaduan->pendidikan == 'SMA' ? 'selected' : '' }}>SMA</option>
                    <option value="D3" {{ $pengaduan->pendidikan == 'D3' ? 'selected' : '' }}>D3</option>
                    <option value="S1" {{ $pengaduan->pendidikan == 'S1' ? 'selected' : '' }}>S1</option>
                    <option value="S2" {{ $pengaduan->pendidikan == 'S2' ? 'selected' : '' }}>S2</option>
                    <option value="S3" {{ $pengaduan->pendidikan == 'S3' ? 'selected' : '' }}>S3</option>
                </select>
            </div>

            <div class="form-group mb-3 {{ getVerificationStatus('pekerjaan', $verificationChecks) === 'yes' ? 'field-approved' : 'field-rejected' }}">
                <label class="form-label">
                    <i class="bi bi-briefcase"></i> Pekerjaan
                    @if(getVerificationStatus('pekerjaan', $verificationChecks) === 'yes')
                        <span class="badge bg-success ms-2"><i class="bi bi-check-lg"></i> Sudah Benar</span>
                    @else
                        <span class="badge bg-danger ms-2"><i class="bi bi-x-lg"></i> Perlu Diperbaiki</span>
                    @endif
                </label>
                <select class="form-select" 
                        name="pekerjaan"
                        {{ needsFix('pekerjaan', $fieldsToFix) ? '' : 'disabled' }}>
                    <option value="PNS" {{ $pengaduan->pekerjaan == 'PNS' ? 'selected' : '' }}>PNS</option>
                    <option value="Swasta" {{ $pengaduan->pekerjaan == 'Swasta' ? 'selected' : '' }}>Swasta</option>
                    <option value="Wiraswasta" {{ $pengaduan->pekerjaan == 'Wiraswasta' ? 'selected' : '' }}>Wiraswasta</option>
                    <option value="Lainnya" {{ $pengaduan->pekerjaan == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                @if($pengaduan->pekerjaan == 'Lainnya')
                <input type="text" 
                        class="form-control mt-2" 
                        name="pekerjaan_lain" 
                        placeholder="Sebutkan pekerjaan lainnya"
                        value="{{ $pengaduan->pekerjaan_lain }}"
                        {{ needsFix('pekerjaan', $fieldsToFix) ? '' : 'readonly disabled' }}>
                @endif
            </div>

            <div class="form-group mb-3 {{ getVerificationStatus('nama_pelapor', $verificationChecks) === 'yes' ? 'field-approved' : 'field-rejected' }}">
                <label class="form-label">
                    <i class="bi bi-person-badge"></i> Nama Pelapor
                    @if(getVerificationStatus('nama_pelapor', $verificationChecks) === 'yes')
                        <span class="badge bg-success ms-2"><i class="bi bi-check-lg"></i> Sudah Benar</span>
                    @else
                        <span class="badge bg-danger ms-2"><i class="bi bi-x-lg"></i> Perlu Diperbaiki</span>
                    @endif
                </label>
                <input type="text" 
                        class="form-control" 
                        name="nama_pelapor" 
                        value="{{ $pengaduan->nama_pelapor }}"
                        {{ needsFix('nama_pelapor', $fieldsToFix) ? '' : 'readonly disabled' }}>
            </div>

            <div class="form-group mb-3 {{ getVerificationStatus('alamat', $verificationChecks) === 'yes' ? 'field-approved' : 'field-rejected' }}">
                <label class="form-label">
                    <i class="bi bi-geo-alt"></i> Alamat Pelapor
                    @if(getVerificationStatus('alamat', $verificationChecks) === 'yes')
                        <span class="badge bg-success ms-2"><i class="bi bi-check-lg"></i> Sudah Benar</span>
                    @else
                        <span class="badge bg-danger ms-2"><i class="bi bi-x-lg"></i> Perlu Diperbaiki</span>
                    @endif
                </label>
                <textarea class="form-control" 
                            name="alamat" 
                            rows="3"
                            {{ needsFix('alamat', $fieldsToFix) ? '' : 'readonly disabled' }}>{{ $pengaduan->alamat }}</textarea>
            </div>
            
            <div class="form-group mb-3 {{ getVerificationStatus('lampiran', $verificationChecks) === 'yes' ? 'field-approved' : 'field-rejected' }}">
                <label class="form-label">
                    <i class="bi bi-paperclip"></i> Lampiran / Bukti
                    @if(getVerificationStatus('lampiran', $verificationChecks) === 'yes')
                        <span class="badge bg-success ms-2"><i class="bi bi-check-lg"></i> Sudah Benar</span>
                    @else
                        <span class="badge bg-danger ms-2"><i class="bi bi-x-lg"></i> Perlu Diperbaiki</span>
                    @endif
                </label>

                {{-- Tampilkan file lama --}}
                @if ($pengaduan->lampiran)
                <p class="text-muted small">File saat ini: <a href="{{ asset('storage/' . $pengaduan->lampiran) }}" target="_blank">Lihat Lampiran</a></p>
                @endif
                
                <input type="file" 
                        class="form-control" 
                        name="lampiran" 
                        {{ needsFix('lampiran', $fieldsToFix) ? '' : 'readonly disabled' }}>

                @if(!needsFix('lampiran', $fieldsToFix))
                    <small class="text-muted mt-1 d-block">Untuk mengganti lampiran, admin harus menandai field ini perlu diperbaiki.</small>
                @endif
            </div>

            <div class="d-flex gap-3 justify-content-center mt-4">
                <button type="submit" class="btn btn-success btn-lg">
                    <i class="bi bi-check-circle"></i> Kirim Perbaikan
                </button>
                <a href="{{ route('pengaduan.create') }}" class="btn btn-secondary btn-lg">
                    <i class="bi bi-x-circle"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>

<style>
.field-approved {
    background-color: #d4edda;
    padding: 15px;
    border-radius: 8px;
    border-left: 4px solid #28a745;
}

.field-rejected {
    background-color: #f8d7da;
    padding: 15px;
    border-radius: 8px;
    border-left: 4px solid #dc3545;
}

.field-approved input:disabled,
.field-approved textarea:disabled,
.field-approved select:disabled {
    background-color: #e9f7ef;
    cursor: not-allowed;
    opacity: 0.8;
}

.field-rejected input,
.field-rejected textarea,
.field-rejected select {
    border: 2px solid #dc3545;
}

.field-rejected input:focus,
.field-rejected textarea:focus,
.field-rejected select:focus {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
}

.form-label {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 8px;
}

.btn-lg {
    padding: 12px 30px;
    font-weight: 600;
}
</style>
@endsection