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
    <title>Daftar Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
            border-radius: 12px 12px 0 0;
        }

        .btn-outline-primary {
            border-radius: 50px;
        }
    </style>
</head>

<body>
    {{-- Navbar Atas --}}
    @include('layouts.navbar')

    <div class="container py-5">
        <h3 class="mb-4 text-center fw-bold text-primary" style="font-family:'Poppins', sans-serif;">Daftar Berita</h3>

        @if(session('success'))
            <div class="alert alert-success shadow-sm rounded-pill px-4">{{ session('success') }}</div>
        @endif

        <!-- Tombol Tambah Berita (hanya admin) -->
        @auth
            @if(Auth::user()->role === 'admin')
                <div class="text-end mb-3">
                    <a href="{{ route('berita.create') }}" class="btn btn-outline-primary rounded-pill shadow-sm">
                        + Tambah Berita
                    </a>
                </div>
            @endif
        @endauth


        @if($beritas->count())
            <div class="row g-4">
                @foreach($beritas as $berita)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm border-0">
                            <img src="{{ asset($berita->gambar) }}" class="card-img-top" alt="{{ $berita->judul }}">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold text-dark" style="font-family:'Poppins', sans-serif;">
                                    {{ Str::limit($berita->judul, 50) }}
                                </h5>
                                <p class="text-muted mb-2" style="font-size: 0.9rem;">
                                    <i class="bi bi-calendar-event me-1"></i> {{ $berita->tanggal }}
                                </p>
                                <div class="mt-auto d-flex justify-content-between align-items-center gap-1">
                                    <a href="{{ route('berita.show', $berita->id) }}"
                                        class="btn btn-outline-primary btn-sm px-3">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>

                                    @if(Auth::user() && Auth::user()->role === 'admin')
                                        <a href="{{ route('berita.edit', $berita->id) }}" class="btn btn-warning btn-sm px-3">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>

                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('berita.destroy', $berita->id) }}" method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm px-3">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-secondary text-center shadow-sm rounded-3">
                Belum ada berita.
            </div>
        @endif
    </div>

    {{-- Navbar Bawah --}}
    @include('layouts.NavbarBawah')
</body>

</html>
