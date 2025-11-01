<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Identifikasi Risiko - SPI Polije</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background: linear-gradient(90deg, #007bff, #00c6ff);
            color: #fff;
            font-weight: 600;
        }
        .form-label {
            font-weight: 500;
        }
        .required {
            color: #dc3545;
        }
    </style>
</head>
<body>
    @include('layouts.navbar')

    <div class="container py-5">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0"><i class="fa fa-edit"></i> Edit Identifikasi Risiko</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('identifikasi.risiko.update', $risiko->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Abjad <span class="required">*</span></label>
                            <input type="text" name="abjad" class="form-control @error('abjad') is-invalid @enderror" 
                                   maxlength="5" required value="{{ old('abjad', $risiko->abjad) }}">
                            @error('abjad')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Unit <span class="required">*</span></label>
                            <select name="unit" class="form-select @error('unit') is-invalid @enderror" required>
                                <option value="">-- Pilih Unit --</option>
                                @foreach($bagians as $bagian)
                                    <option value="{{ $bagian->nama_bagian }}" 
                                            {{ old('unit', $risiko->bagian) == $bagian->nama_bagian ? 'selected' : '' }}>
                                        {{ $bagian->nama_bagian }}
                                    </option>
                                @endforeach
                            </select>
                            @error('unit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tujuan <span class="required">*</span></label>
                        <input type="text" name="tujuan" class="form-control @error('tujuan') is-invalid @enderror" 
                               required value="{{ old('tujuan', $risiko->tujuan) }}">
                        @error('tujuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Proses Bisnis <span class="required">*</span></label>
                        <input type="text" name="proses_bisnis" class="form-control @error('proses_bisnis') is-invalid @enderror" 
                               required value="{{ old('proses_bisnis', $risiko->proses_bisnis) }}">
                        @error('proses_bisnis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
    <label class="form-label">Kategori Risiko <span class="text-danger">*</span></label>
    <input 
        type="text" 
        name="kategori_risiko" 
        class="form-control" 
        placeholder="Masukkan kategori risiko" 
        value="{{ old('kategori_risiko') }}" 
        required
    >
    @error('kategori_risiko')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>


                    <div class="mb-3">
                        <label class="form-label">Uraian Risiko <span class="required">*</span></label>
                        <textarea name="uraian_risiko" class="form-control @error('uraian_risiko') is-invalid @enderror" 
                                  rows="3" required>{{ old('uraian_risiko', $risiko->uraian_risiko) }}</textarea>
                        @error('uraian_risiko')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Penyebab Risiko <span class="required">*</span></label>
                        <textarea name="penyebab_risiko" class="form-control @error('penyebab_risiko') is-invalid @enderror" 
                                  rows="3" required>{{ old('penyebab_risiko', $risiko->penyebab_risiko) }}</textarea>
                        @error('penyebab_risiko')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Sumber Risiko <span class="required">*</span></label>
                        <select name="sumber_risiko" class="form-select @error('sumber_risiko') is-invalid @enderror" required>
                            <option value="">-- Pilih Sumber --</option>
                            <option value="Internal" 
                                    {{ old('sumber_risiko', $risiko->sumber_risiko) == 'Internal' ? 'selected' : '' }}>
                                Internal
                            </option>
                            <option value="Eksternal" 
                                    {{ old('sumber_risiko', $risiko->sumber_risiko) == 'Eksternal' ? 'selected' : '' }}>
                                Eksternal
                            </option>
                        </select>
                        @error('sumber_risiko')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Akibat / Potensi Kerugian <span class="required">*</span></label>
                        <textarea name="akibat" class="form-control @error('akibat') is-invalid @enderror" 
                                  rows="3" required>{{ old('akibat', $risiko->akibat) }}</textarea>
                        @error('akibat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pemilik Risiko <span class="required">*</span></label>
                        <input type="text" name="pemilik_risiko" class="form-control @error('pemilik_risiko') is-invalid @enderror" 
                               required value="{{ old('pemilik_risiko', $risiko->pemilik_risiko) }}">
                        @error('pemilik_risiko')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save"></i> Update Data
                        </button>
                        <a href="{{ route('identifikasi.risiko.index') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('layouts.NavbarBawah')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>