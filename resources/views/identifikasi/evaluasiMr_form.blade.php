<!DOCTYPE html>
<html lang="id">
<style>
    body {
        overflow-x: hidden;
    }

    .section-header {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        border: 1px solid #dee2e6;
    }

    .history-card {
        background-color: #f8f9fa;
        border-left: 4px solid #6c757d;
        margin-bottom: 15px;
        padding: 15px;
        border-radius: 5px;
    }

    .history-badge {
        background-color: #6c757d;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 0.85rem;
        display: inline-block;
        margin-bottom: 10px;
    }

    .history-section {
        margin-top: 40px;
        padding-top: 30px;
        border-top: 3px solid #dee2e6;
    }

    .history-title {
        color: #495057;
        font-weight: 600;
        margin-bottom: 20px;
    }

    /* Unit List Styles */
    .unit-list-section {
        margin-top: 40px;
        padding: 25px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .unit-list-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid rgba(255, 255, 255, 0.3);
    }

    .unit-list-title {
        color: white;
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .unit-count-badge {
        background: rgba(255, 255, 255, 0.25);
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .unit-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 15px;
        margin-top: 20px;
    }

    .unit-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .unit-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 5px;
        height: 100%;
        background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
    }

    .unit-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .unit-card-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
    }

    .unit-info {
        flex: 1;
        min-width: 0;
    }

    .unit-name {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 8px;
        word-wrap: break-word;
    }

    .unit-meta {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .unit-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 10px;
        background: #f7fafc;
        border-radius: 6px;
        font-size: 0.75rem;
        color: #718096;
    }

    .btn-delete-unit {
        padding: 10px 15px;
        background: linear-gradient(135deg, #fc5c7d 0%, #6a82fb 100%);
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        box-shadow: 0 4px 10px rgba(252, 92, 125, 0.3);
    }

    .btn-delete-unit:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 15px rgba(252, 92, 125, 0.4);
    }

    .btn-delete-unit:active {
        transform: scale(0.98);
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .empty-state-icon {
        font-size: 4rem;
        color: #cbd5e0;
        margin-bottom: 20px;
    }

    .empty-state-text {
        font-size: 1.1rem;
        color: #718096;
        margin-bottom: 10px;
    }

    .empty-state-subtext {
        font-size: 0.9rem;
        color: #a0aec0;
    }

    @media (max-width: 768px) {
        .unit-grid {
            grid-template-columns: 1fr;
        }
        
        .unit-list-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($risiko) ? 'Edit Evaluasi MR' : 'Tambah Evaluasi MR' }} - SPI Polije</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-light">

    @include('layouts.navbar')

    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">{{ isset($risiko) ? 'Edit Evaluasi Risiko MR' : 'Form Evaluasi Risiko MR' }}</h4>
            </div>
            <div class="card-body">
                {{-- Notifikasi Error / Success --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <h5 class="mb-2">Terjadi kesalahan:</h5>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Modal Tambah Bagian -->
                <div class="modal fade" id="modalTambahBagian" tabindex="-1" aria-labelledby="modalTambahBagianLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title" id="modalTambahBagianLabel">
                                    <i class="fas fa-plus-circle"></i> Tambah Unit Baru
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="formTambahBagian">
                                    <div class="mb-3">
                                        <label for="namaBagian" class="form-label">Nama Unit</label>
                                        <input type="text" class="form-control" id="namaBagian" 
                                               placeholder="Contoh: Bagian Akademik" required>
                                    </div>
                                    <button type="submit" class="btn btn-success w-100">
                                        <i class="fas fa-save"></i> Simpan Unit
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- FORM UTAMA DIMULAI DI SINI --}}
                <form
                    action="{{ isset($risiko) ? route('evaluasiMr.update', $risiko->id) : route('evaluasiMr.store') }}"
                    method="POST">
                    @csrf
                    @if(isset($risiko))
                        @method('PUT')
                    @endif

                    {{-- Input Tanggal Evaluasi --}}
                    <div class="mb-3">
                        <label for="tanggal_evaluasi" class="form-label">Tanggal Evaluasi <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="tanggal_evaluasi" name="tanggal_evaluasi"
                            value="{{ old('tanggal_evaluasi', isset($risiko) ? $risiko->tanggal_evaluasi?->format('Y-m-d') : date('Y-m-d')) }}" required>
                    </div>

                    {{-- Bagian Section - Unit/Bagian --}}
                    <div class="section-header">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <button type="button" class="btn btn-success w-100" id="btnTambahBagian">
                                    <i class="fas fa-plus"></i> Tambah Unit
                                </button>
                            </div>
                            <div class="col-md-9">
                                <label for="unit" class="form-label">Pilih Unit <span class="text-danger">*</span></label>
                                <select class="form-select" id="unit" name="unit" required>
                                    <option value="">-- Pilih Unit --</option>
                                    @foreach($bagians as $bagian)
                                        <option value="{{ $bagian->nama_bagian }}" 
                                                data-id="{{ $bagian->id }}"
                                                {{ old('unit', $risiko->bagian ?? '') == $bagian->nama_bagian ? 'selected' : '' }}>
                                            {{ $bagian->nama_bagian }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Identifikasi Awal --}}
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="abjad" class="form-label">Kode Unit</label>
                            <input type="text" class="form-control" id="abjad" name="abjad"
                                value="{{ old('abjad', $risiko->abjad ?? '') }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="tujuan" class="form-label">Tujuan</label>
                        <input type="text" class="form-control" id="tujuan" name="tujuan"
                            value="{{ old('tujuan', $risiko->tujuan ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="departemen" class="form-label">Departemen</label>
                        <input type="text" name="departemen" class="form-control"
                            value="{{ old('departemen', $risiko->departemen ?? '') }}"
                            placeholder="Masukkan Departemen" required>
                    </div>

                    <div class="mb-3">
                        <label for="proses_bisnis" class="form-label">Proses Bisnis</label>
                        <input type="text" class="form-control" id="proses_bisnis" name="proses_bisnis"
                            value="{{ old('proses_bisnis', $risiko->proses_bisnis ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="kategori_risiko" class="form-label">Kategori Risiko</label>
                        <input type="text" class="form-control" id="kategori_risiko" name="kategori_risiko"
                            value="{{ old('kategori_risiko', $risiko->kategori_risiko ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="uraian_risiko" class="form-label">Uraian Risiko</label>
                        <textarea class="form-control" id="uraian_risiko" name="uraian_risiko" rows="3"
                            required>{{ old('uraian_risiko', $risiko->uraian_risiko ?? '') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="penyebab_risiko" class="form-label">Penyebab Risiko</label>
                        <textarea class="form-control" id="penyebab_risiko" name="penyebab_risiko" rows="2"
                            required>{{ old('penyebab_risiko', $risiko->penyebab_risiko ?? '') }}</textarea>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="sumber_risiko" class="form-label">Sumber Risiko</label>
                            <select class="form-select" id="sumber_risiko" name="sumber_risiko" required>
                                <option value="" disabled {{ !isset($risiko) ? 'selected' : '' }}>Pilih</option>
                                <option value="internal" {{ old('sumber_risiko', $risiko->sumber_risiko ?? '') == 'internal' ? 'selected' : '' }}>Internal</option>
                                <option value="eksternal" {{ old('sumber_risiko', $risiko->sumber_risiko ?? '') == 'eksternal' ? 'selected' : '' }}>Eksternal</option>
                                <option value="internal_eksternal" {{ old('sumber_risiko', $risiko->sumber_risiko ?? '') == 'internal_eksternal' ? 'selected' : '' }}>Internal & Eksternal</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="pemilik_risiko" class="form-label">Pemilik Risiko</label>
                            <input type="text" class="form-control" id="pemilik_risiko" name="pemilik_risiko"
                                value="{{ old('pemilik_risiko', $risiko->pemilik_risiko ?? '') }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="akibat" class="form-label">Akibat / Potensi Kerugian</label>
                        <textarea class="form-control" id="akibat" name="akibat" rows="2"
                            required>{{ old('akibat', $risiko->akibat ?? '') }}</textarea>
                    </div>

                    {{-- Skor Awal --}}
                    <h5 class="mt-4">Skor Awal</h5>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="skor_likelihood" class="form-label">Likelihood</label>
                            <input type="number" min="1" max="5" class="form-control" id="skor_likelihood"
                                name="skor_likelihood"
                                value="{{ old('skor_likelihood', $risiko->skor_likelihood ?? '') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="skor_impact" class="form-label">Impact</label>
                            <input type="number" min="1" max="5" class="form-control" id="skor_impact"
                                name="skor_impact" value="{{ old('skor_impact', $risiko->skor_impact ?? '') }}"
                                required>
                        </div>
                        <div class="col-md-4">
                            <label for="skor_level" class="form-label">Level</label>
                            <input type="number" class="form-control" id="skor_level" name="skor_level"
                                value="{{ old('skor_level', $risiko->skor_level ?? '') }}" readonly>
                        </div>
                    </div>

                    <h5 class="mt-4">Pengendalian Intern</h5>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Ada</label>
                            <select class="form-select" name="pengendalian_intern_ada" required>
                                <option value="ya" {{ old('pengendalian_intern_ada', $risiko->pengendalian_intern_ada ?? '') == 'ya' ? 'selected' : '' }}>Ya</option>
                                <option value="tidak" {{ old('pengendalian_intern_ada', $risiko->pengendalian_intern_ada ?? '') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                            <input type="text" class="form-control mt-1" name="pengendalian_intern_ada_keterangan"
                                value="{{ old('pengendalian_intern_ada_keterangan', $risiko->pengendalian_intern_ada_keterangan ?? '') }}"
                                placeholder="Tulis keterangan tentang keberadaan pengendalian intern">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Memadai</label>
                            <select class="form-select" name="pengendalian_intern_memadai" required>
                                <option value="ya" {{ old('pengendalian_intern_memadai', $risiko->pengendalian_intern_memadai ?? '') == 'ya' ? 'selected' : '' }}>Ya</option>
                                <option value="tidak" {{ old('pengendalian_intern_memadai', $risiko->pengendalian_intern_memadai ?? '') == 'tidak' ? 'selected' : '' }}>Tidak
                                </option>
                            </select>
                            <input type="text" class="form-control mt-1" name="pengendalian_intern_memadai_keterangan"
                                value="{{ old('pengendalian_intern_memadai_keterangan', $risiko->pengendalian_intern_memadai_keterangan ?? '') }}"
                                placeholder="Tulis keterangan tentang kelayakan pengendalian intern">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Dijalankan (%)</label>
                            <input type="number" min="0" max="100" class="form-control"
                                name="pengendalian_intern_dijalankan"
                                value="{{ old('pengendalian_intern_dijalankan', $risiko->pengendalian_intern_dijalankan ?? '') }}"
                                placeholder="Isi dalam %" required>
                            <input type="text" class="form-control mt-1"
                                name="pengendalian_intern_dijalankan_keterangan"
                                value="{{ old('pengendalian_intern_dijalankan_keterangan', $risiko->pengendalian_intern_dijalankan_keterangan ?? '') }}"
                                placeholder="Tulis keterangan tentang pelaksanaan pengendalian intern (%)">
                        </div>
                    </div>

                    {{-- Nilai Residu --}}
                    <h5 class="mt-4">Nilai Residu</h5>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="residu_likelihood" class="form-label">Likelihood</label>
                            <input type="number" min="1" max="5" class="form-control" id="residu_likelihood"
                                name="residu_likelihood"
                                value="{{ old('residu_likelihood', $risiko->residu_likelihood ?? '') }}">
                        </div>
                        <div class="col-md-4">
                            <label for="residu_impact" class="form-label">Impact</label>
                            <input type="number" min="1" max="5" class="form-control" id="residu_impact"
                                name="residu_impact" value="{{ old('residu_impact', $risiko->residu_impact ?? '') }}">
                        </div>
                        <div class="col-md-4">
                            <label for="residu_level" class="form-label">Level</label>
                            <input type="number" class="form-control" id="residu_level" name="residu_level"
                                value="{{ old('residu_level', $risiko->residu_level ?? '') }}" readonly>
                        </div>
                    </div>

                    {{-- Mitigasi Risiko --}}
                    <h5 class="mt-4">Mitigasi Risiko</h5>
                    <div class="mb-3">
                        <label for="mitigasi_opsi" class="form-label">Opsi Mitigasi</label>
                        <select class="form-select" id="mitigasi_opsi" name="mitigasi_opsi">
                            <option value="" disabled {{ !isset($risiko) ? 'selected' : '' }}>Pilih</option>
                            <option value="hindari" {{ old('mitigasi_opsi', $risiko->mitigasi_opsi ?? '') == 'hindari' ? 'selected' : '' }}>Hindari</option>
                            <option value="kurangi" {{ old('mitigasi_opsi', $risiko->mitigasi_opsi ?? '') == 'kurangi' ? 'selected' : '' }}>Kurangi</option>
                            <option value="alih" {{ old('mitigasi_opsi', $risiko->mitigasi_opsi ?? '') == 'alih' ? 'selected' : '' }}>Alihkan</option>
                            <option value="terima" {{ old('mitigasi_opsi', $risiko->mitigasi_opsi ?? '') == 'terima' ? 'selected' : '' }}>Terima</option>
                        </select>
                        <input type="text" class="form-control mt-1" name="mitigasi_opsi_keterangan"
                            value="{{ old('mitigasi_opsi_keterangan', $risiko->mitigasi_opsi_keterangan ?? '') }}"
                            placeholder="Tulis keterangan tambahan untuk opsi mitigasi">
                    </div>

                    <div class="mb-3">
                        <label for="mitigasi_deskripsi" class="form-label">Deskripsi Mitigasi</label>
                        <textarea class="form-control" id="mitigasi_deskripsi" name="mitigasi_deskripsi"
                            rows="2">{{ old('mitigasi_deskripsi', $risiko->mitigasi_deskripsi ?? '') }}</textarea>
                    </div>

                    {{-- Skor Akhir --}}
                    <h5 class="mt-4">Skor Akhir</h5>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="akhir_likelihood" class="form-label">Likelihood</label>
                            <input type="number" min="1" max="5" class="form-control" id="akhir_likelihood"
                                name="akhir_likelihood"
                                value="{{ old('akhir_likelihood', $risiko->akhir_likelihood ?? '') }}">
                        </div>
                        <div class="col-md-4">
                            <label for="akhir_impact" class="form-label">Impact</label>
                            <input type="number" min="1" max="5" class="form-control" id="akhir_impact"
                                name="akhir_impact" value="{{ old('akhir_impact', $risiko->akhir_impact ?? '') }}">
                        </div>
                        <div class="col-md-4">
                            <label for="akhir_level" class="form-label">Level</label>
                            <input type="number" class="form-control" id="akhir_level" name="akhir_level"
                                value="{{ old('akhir_level', $risiko->akhir_level ?? '') }}" readonly>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> {{ isset($risiko) ? 'Update Risiko' : 'Simpan Risiko' }}
                    </button>
                    <a href="{{ route('evaluasiMr.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </form>

                {{-- SECTION DAFTAR UNIT --}}
                <div class="unit-list-section">
                    <div class="unit-list-header">
                        <h4 class="unit-list-title">
                            <i class="fas fa-building"></i>
                            Daftar Unit Tersedia
                        </h4>
                        <span class="unit-count-badge" id="unitCountBadge">
                            <i class="fas fa-layer-group"></i> {{ $bagians->count() }} Unit
                        </span>
                    </div>

                    <div class="unit-grid" id="unitGrid">
                        @forelse($bagians as $bagian)
                            <div class="unit-card" data-unit-id="{{ $bagian->id }}">
                                <div class="unit-card-content">
                                    <div class="unit-info">
                                        <div class="unit-name">{{ $bagian->nama_bagian }}</div>
                                        <div class="unit-meta">
                                            <span class="unit-badge">
                                                <i class="fas fa-hashtag"></i> ID: {{ $bagian->id }}
                                            </span>
                                            <span class="unit-badge">
                                                <i class="fas fa-calendar"></i> 
                                                {{ $bagian->created_at->format('d M Y') }}
                                            </span>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-delete-unit" 
                                            onclick="deleteUnit({{ $bagian->id }}, '{{ $bagian->nama_bagian }}')">
                                        <i class="fas fa-trash-alt"></i>
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        @empty
                            <div class="empty-state" style="grid-column: 1/-1;">
                                <div class="empty-state-icon">
                                    <i class="fas fa-inbox"></i>
                                </div>
                                <div class="empty-state-text">Belum Ada Unit</div>
                                <div class="empty-state-subtext">
                                    Klik tombol "Tambah Unit" untuk menambahkan unit baru
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

                <style>
.btn-delete-unit {
    background-color: #dc3545;
    color: #fff;
    border: none;
    border-radius: 6px;
    padding: 6px 12px;
    transition: background-color 0.3s ease, transform 0.2s ease;
}
.btn-delete-unit:hover {
    background-color: #c82333;
    transform: scale(1.05);
}
.unit-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.unit-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 4px 14px rgba(0,0,0,0.1);
}
</style>


                <!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function deleteUnit(id, nama) {
    Swal.fire({
        title: 'Hapus Unit?',
        html: `
            <div style="font-size: 15px;">
                Anda akan menghapus <b>${nama}</b> dari daftar unit.<br>
                Tindakan ini tidak dapat dibatalkan.
            </div>
        `,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        customClass: {
            popup: 'rounded-4 shadow-lg',
            confirmButton: 'btn btn-danger px-4',
            cancelButton: 'btn btn-secondary px-4'
        },
        buttonsStyling: false,
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/bagian/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Terhapus!',
                        text: `Unit ${nama} berhasil dihapus.`,
                        icon: 'success',
                        timer: 1600,
                        showConfirmButton: false
                    });
                    // Hapus elemen dari tampilan secara animasi
                    const unitCard = document.querySelector(`.unit-card[data-unit-id="${id}"]`);
                    if (unitCard) {
                        unitCard.style.transition = "all 0.4s ease";
                        unitCard.style.opacity = "0";
                        setTimeout(() => unitCard.remove(), 400);
                    }
                } else {
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Unit tidak dapat dihapus.',
                        icon: 'error',
                    });
                }
            })
            .catch(() => {
                Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat menghapus data.',
                    icon: 'error',
                });
            });
        }
    });
}
</script>


                {{-- SECTION HISTORY --}}
                @if(isset($risiko) && $risiko->histories->count() > 0)
                <div class="history-section">
                    <h4 class="history-title">
                        <i class="fas fa-history"></i> History Evaluasi ({{ $risiko->histories->count() }} Versi)
                    </h4>
                    
                    @foreach($risiko->histories->sortByDesc('created_at') as $index => $history)
                    <div class="history-card">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <span class="history-badge">
                                    <i class="fas fa-calendar-alt"></i> 
                                    {{ $history->tanggal_evaluasi->format('d M Y') }}
                                </span>
                                <span class="badge bg-secondary ms-2">Versi #{{ $risiko->histories->count() - $index }}</span>
                            </div>
                            <small class="text-muted">Disimpan: {{ $history->created_at->format('d M Y H:i') }}</small>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <strong>Unit:</strong> {{ $history->bagian }}<br>
                                <strong>Departemen:</strong> {{ $history->departemen }}<br>
                                <strong>Kode Unit:</strong> {{ $history->abjad }}
                            </div>
                            <div class="col-md-6">
                                <strong>Pemilik Risiko:</strong> {{ $history->pemilik_risiko }}<br>
                                <strong>Sumber Risiko:</strong> {{ ucfirst($history->sumber_risiko) }}
                            </div>
                        </div>

                        <hr>

                        <div class="mb-2">
                            <strong>Tujuan:</strong><br>
                            <p class="mb-1">{{ $history->tujuan }}</p>
                        </div>

                        <div class="mb-2">
                            <strong>Uraian Risiko:</strong><br>
                            <p class="mb-1">{{ $history->uraian_risiko }}</p>
                        </div>

                        <div class="mb-2">
                            <strong>Penyebab Risiko:</strong><br>
                            <p class="mb-1">{{ $history->penyebab_risiko }}</p>
                        </div>

                        <hr>

                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body p-2">
                                        <h6 class="card-title mb-2">Skor Awal</h6>
                                        <div class="d-flex justify-content-between">
                                            <span>L: {{ $history->skor_likelihood }}</span>
                                            <span>I: {{ $history->skor_impact }}</span>
                                            <span><strong>Level: {{ $history->skor_level }}</strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body p-2">
                                        <h6 class="card-title mb-2">Residu</h6>
                                        <div class="d-flex justify-content-between">
                                            <span>L: {{ $history->residu_likelihood ?? '-' }}</span>
                                            <span>I: {{ $history->residu_impact ?? '-' }}</span>
                                            <span><strong>Level: {{ $history->residu_level ?? '-' }}</strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body p-2">
                                        <h6 class="card-title mb-2">Skor Akhir</h6>
                                        <div class="d-flex justify-content-between">
                                            <span>L: {{ $history->akhir_likelihood ?? '-' }}</span>
                                            <span>I: {{ $history->akhir_impact ?? '-' }}</span>
                                            <span><strong>Level: {{ $history->akhir_level ?? '-' }}</strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($history->mitigasi_deskripsi)
                        <div class="mt-3">
                            <strong>Mitigasi ({{ ucfirst($history->mitigasi_opsi) }}):</strong><br>
                            <p class="mb-0">{{ $history->mitigasi_deskripsi }}</p>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>

    @include('layouts.NavbarBawah')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const btnTambahBagian = document.getElementById('btnTambahBagian');
        const modalTambahBagian = new bootstrap.Modal(document.getElementById('modalTambahBagian'));
        const formTambahBagian = document.getElementById('formTambahBagian');
        const selectUnit = document.getElementById('unit');

        btnTambahBagian.addEventListener('click', () => {
            modalTambahBagian.show();
        });

        formTambahBagian.addEventListener('submit', function (e) {
            e.preventDefault();
            const namaBagian = document.getElementById('namaBagian').value.trim();
            if (namaBagian === '') return;

            const btnSubmit = formTambahBagian.querySelector('button[type="submit"]');
            const originalText = btnSubmit.textContent;
            btnSubmit.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...';
            btnSubmit.disabled = true;

            fetch("{{ route('bagian.store') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ nama_bagian: namaBagian })
            })
                .then(res => res.json())
                .then(res => {
                    if (res.success) {
                        const option = document.createElement('option');
                        option.value = res.data.nama_bagian;
                        option.textContent = res.data.nama_bagian;
                        option.selected = true;
                        selectUnit.appendChild(option);

                        formTambahBagian.reset();
                        modalTambahBagian.hide();

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: `Bagian "${res.data.nama_bagian}" berhasil ditambahkan.`,
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: res.message || 'Bagian gagal ditambahkan.'
                        });
                    }
                })
                .catch(err => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan server.'
                    });
                })
                .finally(() => {
                    btnSubmit.innerHTML = originalText;
                    btnSubmit.disabled = false;
                });
        });

        // Script untuk kalkulasi level risiko dengan warna
        (function () {
            const riskColors = {
                1: { 1: '#099DDE', 2: '#9ED26A', 3: '#9ED26A', 4: '#2F8B3A', 5: '#E6DE2F' },
                2: { 1: '#9ED26A', 2: '#9ED26A', 3: '#2F8B3A', 4: '#E6DE2F', 5: '#9B4FF0' },
                3: { 1: '#9ED26A', 2: '#2F8B3A', 3: '#E6DE2F', 4: '#9B4FF0', 5: '#9B4FF0' },
                4: { 1: '#2F8B3A', 2: '#E6DE2F', 3: '#9B4FF0', 4: '#C83218', 5: '#C83218' },
                5: { 1: '#E6DE2F', 2: '#9B4FF0', 3: '#9B4FF0', 4: '#C83218', 5: '#C83218' }
            };

            const textColorMap = {
                '#099DDE': 'white',
                '#9ED26A': 'black',
                '#2F8B3A': 'white',
                '#E6DE2F': 'black',
                '#9B4FF0': 'white',
                '#C83218': 'white'
            };

            function applyColor(levelInput, likelihood, impact) {
                if (likelihood >= 1 && likelihood <= 5 && impact >= 1 && impact <= 5) {
                    const color = riskColors[likelihood][impact];
                    levelInput.value = likelihood * impact;
                    levelInput.style.backgroundColor = color;
                    levelInput.style.color = textColorMap[color] || 'white';
                    levelInput.style.fontWeight = '700';
                    levelInput.style.textAlign = 'center';
                } else {
                    levelInput.value = '';
                    levelInput.style.backgroundColor = '';
                    levelInput.style.color = '';
                    levelInput.style.fontWeight = '';
                    levelInput.style.textAlign = '';
                }
            }

            function setupCalculator(lhId, imId, lvId) {
                const lh = document.getElementById(lhId);
                const im = document.getElementById(imId);
                const lv = document.getElementById(lvId);

                const handler = () => {
                    const l = parseInt(lh.value) || 0;
                    const i = parseInt(im.value) || 0;
                    applyColor(lv, l, i);
                };

                lh.addEventListener('input', handler);
                im.addEventListener('input', handler);
                handler();
            }

            window.addEventListener('DOMContentLoaded', () => {
                setupCalculator('skor_likelihood', 'skor_impact', 'skor_level');
                setupCalculator('residu_likelihood', 'residu_impact', 'residu_level');
                setupCalculator('akhir_likelihood', 'akhir_impact', 'akhir_level');
            });
        })();
    </script>
</body>

</html