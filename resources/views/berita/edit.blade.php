<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('layouts.navbar')

    <div class="container py-5">
        <h3 class="mb-4 text-center fw-bold text-primary">✏️ Edit Berita</h3>

        <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data" class="card shadow p-4">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" name="judul" class="form-control" value="{{ old('judul', $berita->judul) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Isi Berita</label>
                <textarea name="isi" rows="5" class="form-control" required>{{ old('isi', $berita->isi) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $berita->tanggal) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar</label><br>
                <img src="{{ asset($berita->gambar) }}" alt="Gambar Lama" class="mb-2 rounded shadow-sm" style="max-width: 200px;">
                <input type="file" name="gambar" class="form-control mt-2">
                <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar</small>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('berita.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>

    @include('layouts.NavbarBawah')
</body>
</html>
