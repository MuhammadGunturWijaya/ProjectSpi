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
    <title>{{ $berita->judul }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .berita-container {
            max-width: 900px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .berita-image {
            max-height: 400px;
            width: 100%;
            object-fit: cover;
            border-radius: 8px;
        }

        .berita-title {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .berita-date {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 20px;
        }

        .berita-content {
            line-height: 1.8;
        }

        .btn-back {
            margin-top: 30px;
        }
    </style>
</head>

<body>
@include('layouts.navbar')


    <div class="container berita-container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('landingpage') }}">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $berita->judul }}</li>
            </ol>
        </nav>

        <!-- Judul -->
        <h1 class="berita-title">{{ $berita->judul }}</h1>

        <!-- Info kecil -->
        <div class="berita-meta d-flex align-items-center flex-wrap mb-3">
            <span class="me-3"><i class="bi bi-clock"></i> {{ $berita->tanggal }}</span>
            <span class="me-3"><i class="bi bi-person"></i> {{ $berita->penulis ?? 'spi' }}</span>
            <span><i class="bi bi-chat"></i> 0</span>
        </div>

        <!-- Gambar -->
        <img src="{{ asset($berita->gambar) }}" alt="Gambar Berita" class="berita-image my-3">

        <!-- Konten -->
        <div class="berita-content">
            {!! nl2br(e($berita->isi)) !!}
        </div>

        <!-- Tombol kembali -->
        <a href="{{ url()->previous() }}" class="btn btn-secondary btn-back">Kembali</a>
    </div>

    <!-- Tambahkan di head -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .breadcrumb {
            background: none;
            padding: 0;
            margin-bottom: 10px;
            font-size: 0.9rem;
        }

        .berita-meta i {
            margin-right: 4px;
        }
    </style>
 @include('layouts.NavbarBawah')
</body>

</html>