<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Aspirasi Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e8ecf1 100%);
            overflow-x: hidden;
            position: relative;
            min-height: 100vh;
        }

        /* Background decorations */
        .bg-decoration {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }

        .bg-shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.4;
            filter: blur(80px);
        }

        .bg-shape-1 {
            width: 500px;
            height: 500px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            top: -10%;
            left: -5%;
            animation: floatSlow 25s ease-in-out infinite;
        }

        .bg-shape-2 {
            width: 400px;
            height: 400px;
            background: linear-gradient(135deg, #f093fb, #f5576c);
            top: 40%;
            right: -8%;
            animation: floatSlow 30s ease-in-out infinite reverse;
        }

        .bg-shape-3 {
            width: 350px;
            height: 350px;
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            bottom: -5%;
            left: 30%;
            animation: floatSlow 28s ease-in-out infinite;
        }

        @keyframes floatSlow {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(30px, -30px) scale(1.05);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.95);
            }
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image:
                linear-gradient(rgba(102, 126, 234, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(102, 126, 234, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
            pointer-events: none;
            z-index: 0;
        }

        .aspirasi-container {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            padding: 60px 0 80px;
        }

        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 24px;
            padding: 40px;
            text-align: center;
            margin-bottom: 40px;
            box-shadow: 0 10px 40px rgba(102, 126, 234, 0.3);
        }

        .page-header h2 {
            color: white;
            font-size: 2rem;
            font-weight: 700;
            margin: 0 0 10px 0;
        }

        .page-header p {
            color: rgba(255, 255, 255, 0.95);
            margin: 0;
        }

        .aspirasi-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            border: 1px solid rgba(102, 126, 234, 0.08);
        }

        .aspirasi-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .aspirasi-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 15px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .aspirasi-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #2d3748;
            margin: 0;
            flex: 1;
        }

        .kategori-badge {
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: capitalize;
        }

        .kategori-agama {
            background: #fef3c7;
            color: #92400e;
        }

        .kategori-kesehatan {
            background: #dbeafe;
            color: #1e40af;
        }

        .kategori-keuangan {
            background: #d1fae5;
            color: #065f46;
        }

        .kategori-pendidikan {
            background: #e0e7ff;
            color: #3730a3;
        }

        .kategori-infrastruktur {
            background: #fce7f3;
            color: #9f1239;
        }

        .kategori-lainnya {
            background: #f3f4f6;
            color: #374151;
        }

        .aspirasi-meta {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 15px;
            color: #718096;
            font-size: 0.9rem;
        }

        .aspirasi-meta i {
            margin-right: 5px;
        }

        .aspirasi-content {
            color: #4a5568;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .aspirasi-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 1px solid #e2e8f0;
        }

        .btn-detail {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px 25px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-detail:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            color: white;
        }

        .btn-delete {
            background: #fee;
            color: #c53030;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-delete:hover {
            background: #fc8181;
            color: white;
        }

        .btn-back {
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px 35px;
            font-weight: 700;
            font-size: 1rem;
            color: #4a5568;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-back:hover {
            border-color: #cbd5e0;
            background: #f8f9fa;
            color: #2d3748;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .btn-add-new {
            background: linear-gradient(135deg, #48bb78, #38a169);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 14px 35px;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 4px 15px rgba(72, 187, 120, 0.3);
        }

        .btn-add-new:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(72, 187, 120, 0.4);
            color: white;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
        }

        .empty-state i {
            font-size: 4rem;
            color: #cbd5e0;
            margin-bottom: 20px;
        }

        .empty-state h4 {
            color: #4a5568;
            margin-bottom: 10px;
        }

        .empty-state p {
            color: #718096;
            margin-bottom: 25px;
        }

        .alert-custom {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            border: none;
            border-radius: 12px;
            padding: 18px 24px;
            color: white;
            font-weight: 600;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(72, 187, 120, 0.25);
        }

        .alert-danger-custom {
            background: linear-gradient(135deg, #fc8181 0%, #f56565 100%);
            border: none;
            border-radius: 12px;
            padding: 18px 24px;
            color: white;
            font-weight: 600;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(245, 101, 101, 0.25);
        }

        .action-buttons {
            margin-bottom: 30px;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .lampiran-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: #667eea;
            font-size: 0.9rem;
            text-decoration: none;
            font-weight: 600;
        }

        .lampiran-link:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .aspirasi-container {
                padding: 30px 0 50px;
            }

            .page-header {
                padding: 30px 20px;
            }

            .page-header h2 {
                font-size: 1.5rem;
            }

            .aspirasi-card {
                padding: 20px;
            }

            .aspirasi-header {
                flex-direction: column;
            }

            .aspirasi-footer {
                flex-direction: column;
                gap: 10px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-back,
            .btn-add-new {
                width: 100%;
                text-align: center;
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #5568d3, #653a8b);
        }
    </style>
</head>

<body>
    <!-- Animated Background Decoration -->
    <div class="bg-decoration">
        <div class="bg-shape bg-shape-1"></div>
        <div class="bg-shape bg-shape-2"></div>
        <div class="bg-shape bg-shape-3"></div>
    </div>

    @include('layouts.navbar')

    <div class="aspirasi-container">
        <div class="container">
            <div class="page-header">
                <h2><i class="bi bi-list-check me-2"></i>Daftar Aspirasi Saya</h2>
                <p>Pantau dan kelola semua aspirasi yang telah Anda kirimkan</p>
            </div>

            @if(session('success'))
                <div class="alert-custom">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert-danger-custom">
                    <i class="bi bi-x-circle-fill me-2"></i>{{ session('error') }}
                </div>
            @endif

            <div class="action-buttons">
                <a href="{{ route('aspirasi.create') }}" class="btn-add-new">
                    <i class="bi bi-plus-circle-fill me-2"></i>Tambah Aspirasi Baru
                </a>
                <a href="{{ route('aspirasi.create') }}" class="btn-back">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>

            @if($aspirasis->count() > 0)
                @foreach($aspirasis as $aspirasi)
                    <div class="aspirasi-card">
                        <div class="aspirasi-header">
                            <h3 class="aspirasi-title">{{ $aspirasi->judul }}</h3>
                            <span class="kategori-badge kategori-{{ $aspirasi->kategori }}">
                                {{ $aspirasi->kategori_lengkap }}
                            </span>
                        </div>

                        <div class="aspirasi-meta">
                            <span>
                                <i class="bi bi-person-fill"></i>
                                {{ $aspirasi->asal_pelapor }}
                            </span>
                            <span>
                                <i class="bi bi-building"></i>
                                {{ $aspirasi->instansi }}
                            </span>
                            <span>
                                <i class="bi bi-calendar-event"></i>
                                {{ $aspirasi->tanggal->format('d M Y') }}
                            </span>
                        </div>

                        <div class="aspirasi-content">
                            {{ Str::limit($aspirasi->keterangan, 200) }}
                        </div>

                        @if($aspirasi->lampiran)
                            <div class="mb-3">
                                <a href="{{ asset('storage/' . $aspirasi->lampiran) }}" target="_blank" class="lampiran-link">
                                    <i class="bi bi-paperclip"></i>
                                    Lihat Lampiran
                                </a>
                            </div>
                        @endif

                        <div class="aspirasi-footer">
                            <small class="text-muted">
                                <i class="bi bi-clock"></i>
                                Dibuat {{ $aspirasi->created_at->diffForHumans() }}
                            </small>
                            <div class="d-flex gap-2">
                                <a href="{{ route('aspirasi.show', $aspirasi->id) }}" class="btn-detail">
                                    <i class="bi bi-eye me-1"></i>Detail
                                </a>
                                <form action="{{ route('aspirasi.destroy', $aspirasi->id) }}" method="POST" class="form-hapus"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-delete btn-hapus">
                                        <i class="bi bi-trash me-1"></i>Hapus
                                    </button>
                                </form>
                                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                        const btnHapusList = document.querySelectorAll('.btn-hapus');

                                        btnHapusList.forEach(button => {
                                            button.addEventListener('click', function () {
                                                const form = this.closest('.form-hapus');

                                                Swal.fire({
                                                    title: 'Hapus Aspirasi?',
                                                    text: "Data ini akan dihapus secara permanen!",
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonColor: '#e74c3c',
                                                    cancelButtonColor: '#6c757d',
                                                    confirmButtonText: 'Ya, Hapus',
                                                    cancelButtonText: 'Batal',
                                                    reverseButtons: true,
                                                    customClass: {
                                                        popup: 'rounded-4 shadow-lg',
                                                        title: 'fw-bold',
                                                        confirmButton: 'px-4 py-2',
                                                        cancelButton: 'px-4 py-2'
                                                    }
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        form.submit();
                                                    }
                                                });
                                            });
                                        });
                                    });
                                </script>

                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $aspirasis->links() }}
                </div>
            @else
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <h4>Belum Ada Aspirasi</h4>
                    <p>Anda belum mengirimkan aspirasi apapun</p>
                    <a href="{{ route('aspirasi.create') }}" class="btn-add-new">
                        <i class="bi bi-plus-circle-fill me-2"></i>Kirim Aspirasi Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>

    @include('layouts.NavbarBawah')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>