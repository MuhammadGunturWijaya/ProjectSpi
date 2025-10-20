<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit SDM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            background: #f4f6f9;
        }

        .card {
            border-radius: 15px;
        }

        .card-header {
            border-radius: 15px 15px 0 0;
        }

        .form-control,
        .btn {
            border-radius: 10px;
        }

        label {
            font-weight: 600;
        }

        .btn-success {
            background: linear-gradient(135deg, #28a745, #218838);
            border: none;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #218838, #1c7430);
        }

        .btn-secondary {
            background: #6c757d;
            border: none;
        }

        img.preview {
            border: 3px solid #ddd;
            padding: 5px;
            border-radius: 10px;
            background: #fff;
        }
    </style>
</head>

<body>
    @include('layouts.navbar')

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                {{-- Alert success --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Alert error --}}
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Alert validasi error --}}
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-x-circle-fill me-2"></i>
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card shadow-lg">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0"><i class="bi bi-pencil-square"></i> Edit Sumber Daya Manusia</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('sdm.update', $sdm->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') <!-- tambahkan ini -->

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control"
                                    value="{{ old('nama', $sdm->nama) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <input type="text" name="jabatan" class="form-control"
                                    value="{{ old('jabatan', $sdm->jabatan) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="bidang" class="form-label">Bidang</label>
                                <input type="text" name="bidang" class="form-control"
                                    value="{{ old('bidang', $sdm->bidang) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="biodata" class="form-label">Biodata</label>
                                <textarea name="biodata" class="form-control" rows="3"
                                    required>{{ old('biodata', $sdm->biodata) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="pengalaman" class="form-label">Pengalaman</label>
                                <input type="text" name="pengalaman" class="form-control"
                                    value="{{ old('pengalaman', $sdm->pengalaman) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control"
                                    value="{{ old('tanggal_lahir', $sdm->tanggal_lahir ? $sdm->tanggal_lahir->format('Y-m-d') : '') }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto (opsional)</label>
                                <input type="file" name="foto" class="form-control">
                                @if($sdm->foto)
                                    <p class="mt-2">Foto saat ini:</p>
                                    <img src="{{ asset('images/' . $sdm->foto) }}" width="150" class="preview">
                                @endif
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('sdm.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left-circle"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-save"></i> Update
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.NavbarBawah')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>