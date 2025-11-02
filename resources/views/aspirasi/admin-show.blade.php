<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Detail Aspirasi</title>
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

        .admin-container {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            padding: 60px 0 80px;
        }

        .breadcrumb-custom {
            background: white;
            border-radius: 12px;
            padding: 15px 20px;
            margin-bottom: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .breadcrumb-custom a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .breadcrumb-custom a:hover {
            text-decoration: underline;
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
            position: relative;
            overflow: hidden;
        }

        .detail-header::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        }

        .admin-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            border: 2px solid rgba(255, 255, 255, 0.3);
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

        .detail-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 15px;
            position: relative;
            z-index: 2;
        }

        .detail-meta {
            display: flex;
            gap: 25px;
            flex-wrap: wrap;
            color: rgba(255, 255, 255, 0.95);
            position: relative;
            z-index: 2;
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
            display: flex;
            align-items: center;
            gap: 10px;
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
            border-left: 4px solid #667eea;
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

        .btn-back-admin {
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

        .btn-back-admin:hover {
            border-color: #cbd5e0;
            background: #f8f9fa;
            color: #2d3748;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .btn-delete-admin {
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

        .btn-delete-admin:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(245, 101, 101, 0.4);
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .timestamp-box {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 12px;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
        }

        .timestamp-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #4a5568;
        }

        .timestamp-item i {
            color: #667eea;
            font-size: 1.2rem;
        }

        @media (max-width: 768px) {
            .admin-container {
                padding: 30px 0 50px;
            }

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

            .btn-back-admin,
            .btn-download,
            .btn-delete-admin {
                width: 100%;
                text-align: center;
            }

            .admin-badge {
                position: static;
                display: inline-block;
                margin-bottom: 15px;
            }
        }

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
    <div class="bg-decoration">
        <div class="bg-shape bg-shape-1"></div>
        <div class="bg-shape bg-shape-2"></div>
    </div>

    @include('layouts.navbar')

    <div class="admin-container">
        <div class="container">
            <!-- Breadcrumb -->
            <div class="breadcrumb-custom">
                <a href="{{ route('aspirasi.admin') }}">
                    <i class="bi bi-house-door"></i> Dashboard Admin
                </a>
                <span class="mx-2">/</span>
                <span class="text-muted">Detail Aspirasi</span>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="detail-card">
                        <div class="detail-header">
                            <span class="admin-badge">
                                <i class="bi bi-shield-check me-1"></i>Admin View
                            </span>
                            <span class="kategori-badge">{{ $aspirasi->kategori_lengkap }}</span>
                            <h1 class="detail-title">{{ $aspirasi->judul }}</h1>
                            <div class="detail-meta">
                                <span>
                                    <i class="bi bi-calendar-event"></i>
                                    {{ $aspirasi->tanggal->format('d F Y') }}
                                </span>
                                <span>
                                    <i class="bi bi-clock-history"></i>
                                    {{ $aspirasi->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>

                        <div class="detail-body">
                            <!-- Informasi Pelapor -->
                            <div class="info-section">
                                <h5>
                                    <i class="bi bi-person-badge"></i>
                                    Informasi Pelapor
                                </h5>
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
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="bi bi-tag-fill"></i> Kategori
                                        </div>
                                        <div class="info-value">{{ $aspirasi->kategori_lengkap }}</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="bi bi-calendar-check"></i> Tanggal Laporan
                                        </div>
                                        <div class="info-value">{{ $aspirasi->tanggal->format('d F Y') }}</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Keterangan Detail -->
                            <div class="info-section">
                                <h5>
                                    <i class="bi bi-card-text"></i>
                                    Keterangan Detail
                                </h5>
                                <div class="keterangan-box">
                                    {{ $aspirasi->keterangan }}
                                </div>
                            </div>

                            <!-- Lampiran -->
                            @if($aspirasi->lampiran)
                                <div class="info-section">
                                    <h5>
                                        <i class="bi bi-paperclip"></i>
                                        Lampiran Dokumen
                                    </h5>
                                    <div class="lampiran-box">
                                        <div class="lampiran-icon">
                                            <i class="bi bi-file-earmark-arrow-down"></i>
                                        </div>
                                        <p class="mb-2"><strong>File Lampiran Tersedia</strong></p>
                                        <p class="text-muted mb-3">
                                            {{ basename($aspirasi->lampiran) }}
                                        </p>
                                        <a href="{{ asset('storage/' . $aspirasi->lampiran) }}" target="_blank"
                                            class="btn-download">
                                            <i class="bi bi-download me-2"></i>Download Lampiran
                                        </a>
                                    </div>
                                </div>
                            @endif

                            <!-- Timestamp Information -->
                            <div class="info-section">
                                <h5>
                                    <i class="bi bi-clock"></i>
                                    Informasi Waktu
                                </h5>
                                <div class="timestamp-box">
                                    <div class="timestamp-item">
                                        <i class="bi bi-plus-circle"></i>
                                        <div>
                                            <small class="d-block text-muted">Dibuat</small>
                                            <strong>{{ $aspirasi->created_at->format('d M Y, H:i') }}</strong>
                                        </div>
                                    </div>
                                    <div class="timestamp-item">
                                        <i class="bi bi-arrow-repeat"></i>
                                        <div>
                                            <small class="d-block text-muted">Terakhir Diupdate</small>
                                            <strong>{{ $aspirasi->updated_at->format('d M Y, H:i') }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="action-buttons">
                                <a href="{{ route('aspirasi.admin') }}" class="btn-back-admin">
                                    <i class="bi bi-arrow-left me-2"></i>Kembali ke Dashboard
                                </a>
                                <form action="{{ route('aspirasi.destroy', $aspirasi->id) }}" method="POST"
                                    class="form-hapus-aspirasi" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-delete-admin btn-konfirmasi-hapus">
                                        <i class="bi bi-trash me-2"></i>Hapus Aspirasi
                                    </button>
                                </form>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                        const btnsHapus = document.querySelectorAll('.btn-konfirmasi-hapus');

                                        btnsHapus.forEach(button => {
                                            button.addEventListener('click', function (e) {
                                                e.preventDefault();

                                                const form = this.closest('form');

                                                Swal.fire({
                                                    title: 'Yakin ingin menghapus?',
                                                    text: "Aspirasi ini akan dihapus secara permanen!",
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonColor: '#d33',
                                                    cancelButtonColor: '#6c757d',
                                                    confirmButtonText: 'Ya, hapus!',
                                                    cancelButtonText: 'Batal',
                                                    reverseButtons: true,
                                                    customClass: {
                                                        popup: 'rounded-4 shadow-lg',
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
                                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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