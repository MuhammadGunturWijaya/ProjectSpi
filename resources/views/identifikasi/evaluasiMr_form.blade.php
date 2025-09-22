<!DOCTYPE html>
<html lang="id">

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
                <form
                    action="{{ isset($risiko) ? route('evaluasiMr.update', $risiko->id) : route('evaluasiMr.store') }}"
                    method="POST">
                    @csrf
                    @if(isset($risiko))
                        @method('PUT')
                    @endif


                    {{-- Identifikasi Awal --}}
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <label for="abjad" class="form-label">Abjad</label>
                            <input type="text" class="form-control" id="abjad" name="abjad"
                                value="{{ old('abjad', $risiko->abjad ?? '') }}" required>
                        </div>
                        <div class="col-md-5">
                            <label for="tujuan" class="form-label">Tujuan</label>
                            <input type="text" class="form-control" id="tujuan" name="tujuan"
                                value="{{ old('tujuan', $risiko->tujuan ?? '') }}" required>
                        </div>
                        <div class="col-md-5">
                            <label for="departemen" class="form-label">Departemen</label>
                            <input type="text" class="form-control" id="departemen" name="departemen"
                                value="{{ old('departemen', $risiko->departemen ?? '') }}" required>
                        </div>
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
                                name="likelihood" value="{{ old('likelihood', $risiko->likelihood ?? '') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="skor_impact" class="form-label">Impact</label>
                            <input type="number" min="1" max="5" class="form-control" id="skor_impact" name="impact"
                                value="{{ old('impact', $risiko->impact ?? '') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="skor_level" class="form-label">Level</label>
                            <input type="number" class="form-control" id="skor_level" name="skor_level"
                                value="{{ old('skor_level', $risiko->skor_level ?? '') }}" readonly>
                        </div>
                    </div>

                    {{-- Pengendalian Intern --}}
                    <h5 class="mt-4">Pengendalian Intern</h5>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Ada</label>
                            <select class="form-select" name="pengendalian_intern_ada" required>
                                <option value="ya" {{ old('pengendalian_intern_ada', $risiko->pengendalian_intern_ada ?? '') == 'ya' ? 'selected' : '' }}>Ya</option>
                                <option value="tidak" {{ old('pengendalian_intern_ada', $risiko->pengendalian_intern_ada ?? '') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Memadai</label>
                            <select class="form-select" name="pengendalian_intern_memadai" required>
                                <option value="ya" {{ old('pengendalian_intern_memadai', $risiko->pengendalian_intern_memadai ?? '') == 'ya' ? 'selected' : '' }}>Ya</option>
                                <option value="tidak" {{ old('pengendalian_intern_memadai', $risiko->pengendalian_intern_memadai ?? '') == 'tidak' ? 'selected' : '' }}>Tidak
                                </option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Dijalankan</label>
                            <select class="form-select" name="pengendalian_intern_dijalankan" required>
                                <option value="ya" {{ old('pengendalian_intern_dijalankan', $risiko->pengendalian_intern_dijalankan ?? '') == 'ya' ? 'selected' : '' }}>Ya
                                </option>
                                <option value="tidak" {{ old('pengendalian_intern_dijalankan', $risiko->pengendalian_intern_dijalankan ?? '') == 'tidak' ? 'selected' : '' }}>Tidak
                                </option>
                            </select>
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
                        {{ isset($risiko) ? 'Update Risiko' : 'Simpan Risiko' }}
                    </button>
                    <a href="{{ route('evaluasiMr.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>

    @include('layouts.NavbarBawah')
</body>

</html>