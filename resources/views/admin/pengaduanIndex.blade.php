<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengaduan Masyarakat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Glassmorphism card */
        .glass-card {
            background: rgba(225, 225, 235, 0.75);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }

        .shadow-hover:hover {
            transform: translateY(-8px) scale(1.03);
            box-shadow: 0 20px 35px rgba(0, 0, 0, 0.15);
        }

        /* Gradient buttons */
        .btn-view {
            background: linear-gradient(90deg, #4e54c8, #8f94fb);
            color: #fff;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-view:hover {
            background: linear-gradient(90deg, #3b40a4, #6f72e8);
            box-shadow: 0 6px 14px rgba(78, 84, 200, 0.5);
        }

        .btn-delete {
            background: linear-gradient(90deg, #ff416c, #ff4b2b);
            color: #fff;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-delete:hover {
            background: linear-gradient(90deg, #d91f4f, #d9361e);
            box-shadow: 0 6px 14px rgba(255, 65, 108, 0.5);
        }

        .btn-back {
            background: linear-gradient(90deg, #36d1dc, #5b86e5);
            color: #fff;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background: linear-gradient(90deg, #22a7b8, #3a63d1);
            box-shadow: 0 6px 14px rgba(54, 209, 220, 0.5);
        }

        /* Badge modern */
        .badge {
            font-size: 0.8rem;
            letter-spacing: 0.05em;
            transition: transform 0.3s ease;
        }

        .badge:hover {
            transform: scale(1.1);
        }

        /* Responsive font sizes */
        @media (max-width: 576px) {
            h3 {
                font-size: 1.8rem;
            }

            .card-title {
                font-size: 1.1rem;
            }
        }
    </style>
</head>

<body>
    {{-- Navbar Atas --}}
    @include('layouts.navbar')

    <div class="container py-5">

        <h3 class="mb-5 text-center fw-bold"
            style="font-family: 'Poppins', sans-serif; font-size: 2.2rem; letter-spacing: 1px; color: #333;">
            Daftar Pengaduan Masyarakat
        </h3>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif




        <div class="row g-4">
            @foreach($pengaduans as $i => $p)
                <div class="col-md-6 col-lg-4">
                    <div class="card glass-card shadow-hover h-100 rounded-4 p-3">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h5 class="card-title mb-0 text-truncate" title="{{ $p->judul }}">
                                    {{ $p->judul }}
                                </h5>
                                <span class="badge 
                            @if($p->kategori == 'Urgent') bg-danger
                            @elseif($p->kategori == 'Penting') bg-warning text-dark
                            @else bg-info text-dark
                            @endif
                            px-3 py-2 rounded-pill fw-semibold shadow-sm">
                                    {{ $p->kategori }}
                                </span>
                            </div>

                            <ul class="list-unstyled mb-4 text-muted small">
                                <li class="mb-2"><i class="bi bi-person-fill me-2 text-primary"></i>{{ $p->nama }}</li>
                                <li class="mb-2"><i class="bi bi-envelope-fill me-2 text-primary"></i>{{ $p->email }}</li>
                                <li><i
                                        class="bi bi-calendar-fill me-2 text-primary"></i>{{ $p->created_at->format('d M Y') }}
                                </li>
                            </ul>

                            {{-- Form update status untuk admin --}}
                          
 @auth
    @if(auth()->user()->role === 'admin')
        <form action="{{ route('pengaduan.updateStatus', $p->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <select name="status">
                <option value="laporan_dikirim" {{ $p->status == 'laporan_dikirim' ? 'selected' : '' }}>Tulis Laporan</option>
                <option value="diverifikasi" {{ $p->status == 'diverifikasi' ? 'selected' : '' }}>Verifikasi</option>
                <option value="tindak_lanjut" {{ $p->status == 'tindak_lanjut' ? 'selected' : '' }}>Tindak Lanjut</option>
                <option value="tanggapan_pelapor" {{ $p->status == 'tanggapan_pelapor' ? 'selected' : '' }}>Tanggapan Pelapor</option>
                <option value="selesai" {{ $p->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
            <button type="submit">Update</button>
        </form>
    @endif
@endauth

                    

                            <div class="mt-auto d-flex gap-2">
                                <a href="{{ route('pengaduan.show', $p->id) }}"
                                    class="btn btn-view flex-grow-1 rounded-pill fw-semibold d-flex align-items-center justify-content-center gap-2">
                                    <i class="bi bi-eye-fill fs-5"></i> Lihat
                                </a>

                                <button type="button"
                                    class="btn btn-delete flex-grow-1 rounded-pill fw-semibold d-flex align-items-center justify-content-center gap-2"
                                    data-bs-toggle="modal" data-bs-target="#deleteModal{{ $p->id }}">
                                    <i class="bi bi-trash-fill fs-5"></i> Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach



            <!-- Tombol Kembali -->
            <div class="col-12 d-flex justify-content-center mt-4">
                <a href="{{ route('landing') }}"
                    class="btn btn-back rounded-pill px-4 py-2 fw-semibold d-flex align-items-center gap-2 shadow-sm">
                    <i class="bi bi-arrow-left-circle fs-5"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    {{-- Navbar Bawah --}}
    @include('layouts.NavbarBawah')
</body>

</html>