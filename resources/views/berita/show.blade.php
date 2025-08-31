<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $berita->judul }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
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
            display: block;
            width: 100%;
            /* tetap full mengikuti lebar konten */
            max-height: 400px;
            /* atur tinggi maksimal, bisa 300-400px sesuai kebutuhan */
            object-fit: cover;
            /* biar gambar dipotong proporsional, tidak gepeng */
            margin: 0 auto;
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
    <div class="container py-5">
        <div class="row">
            <!-- Bagian Konten Utama -->
            <div class="col-lg-9 mx-auto">

                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('landing') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('berita.index') }}">Berita</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $berita->judul }}</li>
                    </ol>
                </nav>

                <!-- Judul -->
                <h2 class="fw-bold mb-2" style="font-family: 'Poppins', sans-serif;">
                    {{ $berita->judul }}
                </h2>

                <!-- Meta Info -->
                <div class="d-flex flex-wrap align-items-center mb-4 text-muted" style="font-size: 0.9rem;">
                    <span class="me-3"><i class="bi bi-folder2"></i> Uncategorized</span>
                    <span class="me-3"><i class="bi bi-calendar-event"></i> {{ $berita->tanggal }}</span>
                    <span class="me-3"><i class="bi bi-person"></i> Admin</span>
                    <span><i class="bi bi-chat"></i> 0</span>
                </div>

                <!-- Gambar -->
                <div class="mb-4 text-center">
                    <img src="{{ asset($berita->gambar) }}" alt="{{ $berita->judul }}"
                        class="berita-image img-fluid  shadow-sm">
                </div>

                <!-- Isi Berita -->
                <div class="content" style="font-size: 1.05rem; line-height: 1.8; text-align: justify;">
                    {!! nl2br(e($berita->isi)) !!}
                </div>

                <!-- Tombol Kembali -->
                <div class="mt-5">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-primary rounded-pill px-4">
                        <i class="bi bi-arrow-left-circle"></i> Kembali
                    </a>
                </div>
            </div>

            <!-- Bagian Tombol Share (Floating di kiri) -->
            <div class="col-lg-1 d-none d-lg-block">
                <div class="position-sticky" style="top: 100px;">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="https://facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                                target="_blank" class="btn btn-primary btn-sm rounded-circle">
                                <i class="bi bi-facebook"></i>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}"
                                target="_blank" class="btn btn-info btn-sm rounded-circle text-white">
                                <i class="bi bi-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($berita->judul . ' - ' . request()->fullUrl()) }}"
                                target="_blank" class="btn btn-success btn-sm rounded-circle">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    @include('layouts.NavbarBawah')
</body>

</html>