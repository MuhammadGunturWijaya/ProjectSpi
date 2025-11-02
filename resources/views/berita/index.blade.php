<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #f5f5f5;
            color: #1a1a1a;
            overflow-x: hidden;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
        }

        /* Header */
        .page-header {
            padding: 2.5rem 0 2rem;
            margin-bottom: 2rem;
        }

        .page-header h3 {
            font-size: 1.75rem;
            font-weight: 600;
            color: #1a1a1a;
            margin: 0;
            letter-spacing: -0.02em;
        }

        /* Alert */
        .alert-success {
            background-color: #ffffff;
            border: 1px solid #e5e5e5;
            border-left: 3px solid #2e7d32;
            color: #1a1a1a;
            border-radius: 8px;
            padding: 1rem 1.25rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        /* Button Tambah */
        .btn-tambah {
            background-color: #1a1a1a;
            color: #ffffff;
            border: none;
            padding: 0.65rem 1.5rem;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-tambah:hover {
            background-color: #2d2d2d;
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        /* Card */
        .card {
            background: #ffffff;
            border: 1px solid #e5e5e5;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.25s ease;
            height: 100%;
        }

        .card:hover {
            border-color: #d4d4d4;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }

        .card-img-wrapper {
            position: relative;
            overflow: hidden;
            background-color: #f5f5f5;
            height: 200px;
        }

        .card-img-top {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .card:hover .card-img-top {
            transform: scale(1.03);
        }

        .card-body {
            padding: 1.25rem;
        }

        .card-title {
            font-size: 1rem;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 0.75rem;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .card-date {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.85rem;
            color: #737373;
            margin-bottom: 1rem;
        }

        .card-date i {
            font-size: 0.9rem;
            color: #a3a3a3;
        }

        /* Action Buttons */
        .card-actions {
            display: flex;
            gap: 0.5rem;
            margin-top: auto;
        }

        .btn-card {
            flex: 1;
            padding: 0.5rem 0.75rem;
            font-size: 0.85rem;
            font-weight: 500;
            border-radius: 6px;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
            border: none;
            text-decoration: none;
        }

        .btn-card i {
            font-size: 0.9rem;
        }

        .btn-detail {
            background-color: #1a1a1a;
            color: #ffffff;
        }

        .btn-detail:hover {
            background-color: #2d2d2d;
            color: #ffffff;
            transform: translateY(-1px);
        }

        .btn-edit {
            background-color: #f5f5f5;
            color: #1a1a1a;
            border: 1px solid #e5e5e5;
        }

        .btn-edit:hover {
            background-color: #e5e5e5;
            color: #1a1a1a;
        }

        .btn-hapus {
            background-color: #f5f5f5;
            color: #dc2626;
            border: 1px solid #e5e5e5;
        }

        .btn-hapus:hover {
            background-color: #dc2626;
            color: #ffffff;
        }

        /* Empty State */
        .empty-state {
            background: #ffffff;
            border: 1px solid #e5e5e5;
            border-radius: 10px;
            padding: 3rem 2rem;
            text-align: center;
        }

        .empty-state i {
            font-size: 3rem;
            color: #d4d4d4;
            margin-bottom: 1rem;
        }

        .empty-state p {
            color: #737373;
            margin: 0;
            font-size: 0.95rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page-header h3 {
                font-size: 1.5rem;
            }

            .card-actions {
                flex-wrap: wrap;
            }

            .btn-card {
                min-width: calc(50% - 0.25rem);
            }

            .btn-detail {
                flex: 1 1 100%;
            }
        }

        /* Admin Actions Group */
        .admin-actions {
            display: flex;
            gap: 0.5rem;
            flex: 1;
        }
    </style>
</head>

<body>
    {{-- Navbar Atas --}}
    @include('layouts.navbar')

    <div class="container py-4">
        <!-- Header -->
        <div class="page-header">
            <h3>Daftar Berita</h3>
        </div>

        @if(session('success'))
            <div class="alert alert-success mb-4">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif

        <!-- Tombol Tambah Berita (hanya admin) -->
        @auth
            @if(Auth::user()->role === 'admin')
                <div class="text-end mb-4">
                    <a href="{{ route('admin.berita.create') }}" class="btn-tambah">
                        <i class="bi bi-plus-lg"></i>
                        <span>Tambah Berita</span>
                    </a>
                </div>
            @endif
        @endauth

        @if($beritas->count())
            <div class="row g-4">
                @foreach($beritas as $berita)
                    <div class="col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-img-wrapper">
                                <img src="{{ asset($berita->gambar) }}" class="card-img-top" alt="{{ $berita->judul }}">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">
                                    {{ Str::limit($berita->judul, 50) }}
                                </h5>
                                <div class="card-date">
                                    <i class="bi bi-calendar3"></i>
                                    <span>{{ $berita->tanggal }}</span>
                                </div>
                                <div class="card-actions">
                                    <a href="{{ route('berita.show', $berita->id) }}" class="btn-card btn-detail">
                                        <i class="bi bi-eye"></i>
                                        <span>Detail</span>
                                    </a>

                                    @if(Auth::user() && Auth::user()->role === 'admin')
                                        <div class="admin-actions">
                                            <a href="{{ route('berita.edit', $berita->id) }}" class="btn-card btn-edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <form action="{{ route('berita.destroy', $berita->id) }}" method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus berita ini?')" 
                                                  style="display: flex; flex: 1;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-card btn-hapus" style="width: 100%;">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <i class="bi bi-newspaper"></i>
                <p>Belum ada berita tersedia</p>
            </div>
        @endif
    </div>

    {{-- Navbar Bawah --}}
    @include('layouts.NavbarBawah')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>