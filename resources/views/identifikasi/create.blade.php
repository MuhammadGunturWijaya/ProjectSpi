<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Identifikasi Risiko - SPI Polije</title>
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
    </style>
</head>

<body>
    @include('layouts.navbar')

    <div class="container py-5">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0"><i class="fa fa-plus-circle"></i> Tambah Identifikasi Risiko</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('identifikasi.risiko.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Abjad <span class="text-danger">*</span></label>
                            <input type="text" name="abjad" class="form-control" maxlength="5" required
                                value="{{ old('abjad') }}">
                            @error('abjad')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Unit <span class="text-danger">*</span></label>
                            <select name="unit" class="form-select" required>
                                <option value="">-- Pilih Unit --</option>
                                @foreach($bagians as $bagian)
                                    <option value="{{ $bagian->nama_bagian }}" {{ old('unit') == $bagian->nama_bagian ? 'selected' : '' }}>
                                        {{ $bagian->nama_bagian }}
                                    </option>
                                @endforeach
                            </select>
                            @error('unit')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tujuan <span class="text-danger">*</span></label>
                        <input type="text" name="tujuan" class="form-control" required value="{{ old('tujuan') }}">
                        @error('tujuan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Proses Bisnis <span class="text-danger">*</span></label>
                        <input type="text" name="proses_bisnis" class="form-control" required
                            value="{{ old('proses_bisnis') }}">
                        @error('proses_bisnis')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori Risiko <span class="text-danger">*</span></label>
                        <input type="text" name="kategori_risiko" class="form-control"
                            placeholder="Masukkan kategori risiko" value="{{ old('kategori_risiko') }}" required>
                        @error('kategori_risiko')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Uraian Risiko <span class="text-danger">*</span></label>
                        <textarea name="uraian_risiko" class="form-control" rows="3"
                            required>{{ old('uraian_risiko') }}</textarea>
                        @error('uraian_risiko')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Penyebab Risiko <span class="text-danger">*</span></label>
                        <textarea name="penyebab_risiko" class="form-control" rows="3"
                            required>{{ old('penyebab_risiko') }}</textarea>
                        @error('penyebab_risiko')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Sumber Risiko <span class="text-danger">*</span></label>
                        <select name="sumber_risiko" class="form-select" required>
                            <option value="">-- Pilih Sumber --</option>
                            <option value="Internal" {{ old('sumber_risiko') == 'Internal' ? 'selected' : '' }}>Internal
                            </option>
                            <option value="Eksternal" {{ old('sumber_risiko') == 'Eksternal' ? 'selected' : '' }}>
                                Eksternal</option>
                        </select>
                        @error('sumber_risiko')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Akibat / Potensi Kerugian <span class="text-danger">*</span></label>
                        <textarea name="akibat" class="form-control" rows="3" required>{{ old('akibat') }}</textarea>
                        @error('akibat')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pemilik Risiko <span class="text-danger">*</span></label>
                        <input type="text" name="pemilik_risiko" class="form-control" required
                            value="{{ old('pemilik_risiko') }}">
                        @error('pemilik_risiko')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save"></i> Simpan
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