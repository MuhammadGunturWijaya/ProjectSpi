@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h3 class="mb-4 fw-bold text-center" style="font-family: 'Poppins', sans-serif; font-size: 2rem; color: #fdfdfdff;">
            Detail Pengaduan
        </h3>


        <div class="card glass-card shadow-lg p-4 rounded-4 mx-auto" style="max-width: 700px;">
            <div class="mb-3">
                <strong>Nama Pelapor:</strong> {{ $pengaduan->nama }}
            </div>
            <div class="mb-3">
                <strong>Email:</strong> {{ $pengaduan->email }}
            </div>
            <div class="mb-3">
                <strong>Kategori:</strong>
                <span class="badge 
                        @if($pengaduan->kategori == 'Urgent') bg-danger
                        @elseif($pengaduan->kategori == 'Penting') bg-warning text-dark
                        @else bg-info text-dark
                        @endif
                        px-3 py-2 rounded-pill fw-semibold">
                    {{ $pengaduan->kategori }}
                </span>
            </div>
            <div class="mb-3">
                <strong>Judul:</strong> {{ $pengaduan->judul }}
            </div>
            <div class="mb-3">
                <strong>Isi Pengaduan:</strong>
                <p class="text-muted" style="font-size: 0.95rem;">{{ $pengaduan->kritik_saran }}</p>
            </div>
            @if($pengaduan->bukti_foto)
                <div class="mb-3 text-center">
                    <strong>Bukti Foto:</strong>
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $pengaduan->bukti_foto) }}" alt="Bukti Foto"
                            class="img-fluid rounded-3 shadow-sm" style="max-width: 100%; height: auto;">
                    </div>
                </div>
            @endif
            <div class="mb-3">
                <strong>Tanggal Pengaduan:</strong> {{ $pengaduan->created_at->format('d M Y H:i') }}
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('pengaduan.index') }}"
                    class="btn btn-gradient-primary rounded-pill px-4 py-2 d-flex align-items-center justify-content-center gap-2 mx-auto">
                    <i class="bi bi-arrow-left-circle fs-5"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <style>
        /* Glassmorphism card */
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.4s ease;
        }

        /* Gradient button */
        .btn-gradient-primary {
            background: linear-gradient(90deg, #4e54c8, #8f94fb);
            color: #fff;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-gradient-primary:hover {
            background: linear-gradient(90deg, #3b40a4, #6f72e8);
            box-shadow: 0 6px 14px rgba(78, 84, 200, 0.5);
        }
    </style>
@endsection