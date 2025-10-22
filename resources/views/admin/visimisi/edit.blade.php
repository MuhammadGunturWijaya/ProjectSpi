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

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('visi-misi.update') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="tujuan" class="form-label">Tujuan</label>
            <textarea name="tujuan" id="tujuan" class="form-control" rows="5" required>{{ old('tujuan', $visimisi->tujuan ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="visi" class="form-label">Visi</label>
            <textarea name="visi" id="visi" class="form-control" rows="5" required>{{ old('visi', $visimisi->visi ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="misi" class="form-label">Misi</label>
            <textarea name="misi" id="misi" class="form-control" rows="5" required>{{ old('misi', $visimisi->misi ?? '') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('visi-misi.index') }}" class="btn btn-secondary ms-2">Batal</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
