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
    <title>{{ isset($risiko) ? 'Edit Risiko' : 'Tambah Risiko' }} - SPI Polije</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-light">

    @include('layouts.navbar')

    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">{{ isset($risiko) ? 'Edit Identifikasi Risiko' : 'Form Identifikasi Risiko' }}</h4>
            </div>
            <div class="card-body">
                <form
                    action="{{ isset($risiko) ? route('identifikasi.risiko.update', $risiko->id) : route('identifikasi.risiko.store') }}"
                    method="POST">
                    @csrf
                    @if(isset($risiko))
                        @method('PUT')
                    @endif

                    <div class="row mb-3">
                        <div class="col-md-2">
                            <label for="abjad" class="form-label">Abjad</label>
                            <input type="text" class="form-control" id="abjad" name="abjad"
                                value="{{ old('abjad', $risiko->abjad ?? '') }}" required>
                        </div>

                        {{-- kolom No dihapus, tidak perlu ditampilkan lagi --}}

                        <div class="col-md-10">
                            <label for="tujuan" class="form-label">Tujuan</label>
                            <input type="text" class="form-control" id="tujuan" name="tujuan"
                                value="{{ old('tujuan', $risiko->tujuan ?? '') }}" required>
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

                    <div class="mb-3">
                        <label for="sumber_risiko" class="form-label">Sumber Risiko</label>
                        <select class="form-select" id="sumber_risiko" name="sumber_risiko" required>
                            <option value="" disabled {{ !isset($risiko) ? 'selected' : '' }}>Pilih Sumber Risiko
                            </option>
                            <option value="internal" {{ old('sumber_risiko', $risiko->sumber_risiko ?? '') == 'internal' ? 'selected' : '' }}>Internal</option>
                            <option value="eksternal" {{ old('sumber_risiko', $risiko->sumber_risiko ?? '') == 'eksternal' ? 'selected' : '' }}>Eksternal</option>
                            <option value="internal_eksternal" {{ old('sumber_risiko', $risiko->sumber_risiko ?? '') == 'internal_eksternal' ? 'selected' : '' }}>Internal & Eksternal</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="akibat" class="form-label">Akibat / Potensi Kerugian</label>
                        <textarea class="form-control" id="akibat" name="akibat" rows="2"
                            required>{{ old('akibat', $risiko->akibat ?? '') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="pemilik_risiko" class="form-label">Pemilik Risiko</label>
                        <input type="text" class="form-control" id="pemilik_risiko" name="pemilik_risiko"
                            value="{{ old('pemilik_risiko', $risiko->pemilik_risiko ?? '') }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        {{ isset($risiko) ? 'Update Risiko' : 'Simpan Risiko' }}
                    </button>
                    <a href="{{ route('identifikasi.risiko.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>

    @include('layouts.NavbarBawah')
</body>

</html>