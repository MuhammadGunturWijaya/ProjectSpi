<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Aspirasi - {{ $aspirasi->judul }}</title>
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

        .detail-card {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06);
            border: 1px solid rgba(102, 126, 234, 0.08);
        }

        .detail-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px;
            color: white;
        }

        .detail-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .kategori-badge {
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            display: inline-block;
            margin-bottom: 15px;
            text-transform: capitalize;
        }

        .detail-meta {
            display: flex;
            gap: 25px;
            flex-wrap: wrap;
            color: rgba(255, 255, 255, 0.95);
        }

        .detail-meta i {
            margin-right: 8px;
        }

        .detail-body {
            padding: 40px;
        }

        .info-section {
            margin-bottom: 35px;
        }

        .info-section h5 {
            color: #2d3748;
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e2e8f0;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .info-item {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 12px;
            border-left: 4px solid #667eea;
        }

        .info-label {
            color: #718096;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            color: #2d3748;
            font-size: 1rem;
            font-weight: 600;
        }

        .keterangan-box {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 25px;
            line-height: 1.8;
            color: #4a5568;
        }

        .lampiran-box {
            background: linear-gradient(135deg, #f0f4ff 0%, #e6edff 100%);
            border: 2px dashed #667eea;
            border-radius: 16px;
            padding: 30px;
            text-align: center;
        }

        .lampiran-icon {
            font-size: 3rem;
            color: #667eea;
            margin-bottom: 15px;
        }

        .btn-download {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 14px 35px;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-download:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(102, 126, 234, 0.4);
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

        .btn-delete {
            background: linear-gradient(135deg, #fc8181, #f56565);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 14px 35px;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s ease;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(245, 101, 101, 0.3);
        }

        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(245, 101, 101, 0.4);
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        @media (max-width: 768px) {
            .detail-header {
                padding: 30px 20px;
            }

            .detail-title {
                font-size: 1.5rem;
            }

            .detail-body {
                padding: 30px 20px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-back,
            .btn-download,
            .btn-delete {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <div class="bg-decoration">
        <div class="bg-shape bg-shape-1"></div>
        <div class="bg-shape bg-shape-2"></div>
    </div>

    @include('layouts.navbar')

    <div class="aspirasi-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="detail-card">
                        <div class="detail-header">
                            <span class="kategori-badge">{{ $aspirasi->kategori_lengkap }}</span>
                            <h1 class="detail-title">{{ $aspirasi->judul }}</h1>
                            <div class="detail-meta">
                                <span>
                                    <i class="bi bi-calendar-event"></i>
                                    {{ $aspirasi->tanggal->format('d F Y') }}
                                </span>
                                <span>
                                    <i class="bi bi-clock"></i>
                                    Dibuat {{ $aspirasi->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>

                        <div class="detail-body">
                            <!-- Informasi Pelapor -->
                            <div class="info-section">
                                <h5><i class="bi bi-person-badge me-2"></i>Informasi Pelapor</h5>
                                <div class="info-grid">
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="bi bi-person-fill"></i> Nama Pelapor
                                        </div>
                                        <div class="info-value">{{ $aspirasi->asal_pelapor }}</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="bi bi-building"></i> Instansi
                                        </div>
                                        <div class="info-value">{{ $aspirasi->instansi }}</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Keterangan -->
                            <div class="info-section">
                                <h5><i class="bi bi-card-text me-2"></i>Keterangan Detail</h5>
                                <div class="keterangan-box">
                                    {{ $aspirasi->keterangan }}
                                </div>
                            </div>

                            <!-- Lampiran -->
                            @if($aspirasi->lampiran)
                                <div class="info-section">
                                    <h5><i class="bi bi-paperclip me-2"></i>Lampiran Dokumen</h5>
                                    <div class="lampiran-box">
                                        <div class="lampiran-icon">
                                            <i class="bi bi-file-earmark-arrow-down"></i>
                                        </div>
                                        <p class="mb-3"><strong>File Lampiran Tersedia</strong></p>
                                        <a href="{{ asset('storage/' . $aspirasi->lampiran) }}" target="_blank"
                                            class="btn-download">
                                            <i class="bi bi-download me-2"></i>Download Lampiran
                                        </a>
                                    </div>
                                </div>
                            @endif

                            <!-- Action Buttons -->
                            <div class="action-buttons">
                                <a href="{{ route('aspirasi.index') }}" class="btn-back">
                                    <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar
                                </a>
                                <form action="{{ route('aspirasi.destroy', $aspirasi->id) }}" method="POST"
                                    class="form-hapus" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-delete btn-hapus">
                                        <i class="bi bi-trash me-1"></i>Hapus Aspirasi
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
                </div>
            </div>
        </div>
    </div>

    @include('layouts.NavbarBawah')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>