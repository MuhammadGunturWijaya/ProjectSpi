<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Visi, Misi & Tujuan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <h2>Edit Tujuan, Visi & Misi</h2>

        {{-- Notifikasi Berhasil --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Notifikasi Gagal (Validation Errors) --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Gagal menyimpan perubahan:</strong>
                <ul class="mt-2 mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('visi-misi.update') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="tujuan" class="form-label">Tujuan</label>
                <textarea name="tujuan" id="tujuan" class="form-control" rows="5"
                    required>{{ old('tujuan', $visimisi->tujuan ?? '') }}</textarea>
                
                @error('tujuan')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="visi" class="form-label">Visi</label>
                <textarea name="visi" id="visi" class="form-control" rows="5"
                    required>{{ old('visi', $visimisi->visi ?? '') }}</textarea>

                @error('visi')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="misi" class="form-label">Misi</label>
                <textarea name="misi" id="misi" class="form-control" rows="5"
                    required>{{ old('misi', $visimisi->misi ?? '') }}</textarea>

                @error('misi')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control"
                    value="{{ old('tanggal', $visimisi->tanggal ?? '') }}">

                @error('tanggal')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="jam" class="form-label">Jam</label>
                <input type="time" name="jam" id="jam" class="form-control"
                    value="{{ old('jam', $visimisi->jam ?? '') }}">

                @error('jam')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('visi-misi.index') }}" class="btn btn-secondary ms-2">Batal</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
