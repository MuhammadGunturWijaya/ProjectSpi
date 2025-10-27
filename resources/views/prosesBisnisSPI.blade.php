<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Bisnis SPI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            overflow-x: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .hero-section {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 60px 0;
            margin-bottom: 40px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            color: #fff;
            text-shadow: 2px 2px 20px rgba(0, 0, 0, 0.3);
            margin-bottom: 20px;
            animation: fadeInDown 1s ease;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.95);
            max-width: 800px;
            margin: 0 auto;
            line-height: 1.8;
            animation: fadeInUp 1s ease 0.2s both;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .process-container {
            position: relative;
            padding: 40px 0;
        }

        .process-step {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: visible;
            opacity: 0;
            transform: translateX(-50px);
            animation: slideIn 0.6s ease forwards;
        }

        .process-step:nth-child(1) {
            animation-delay: 0.1s;
        }

        .process-step:nth-child(2) {
            animation-delay: 0.2s;
        }

        .process-step:nth-child(3) {
            animation-delay: 0.3s;
        }

        .process-step:nth-child(4) {
            animation-delay: 0.4s;
        }

        .process-step:nth-child(5) {
            animation-delay: 0.5s;
        }

        @keyframes slideIn {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .process-step:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
        }

        .process-step::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background: linear-gradient(180deg, #667eea, #764ba2);
            transition: width 0.3s ease;
            border-radius: 20px 0 0 20px;
        }

        .process-step:hover::before {
            width: 8px;
        }

        .step-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 15px;
        }

        .step-left {
            display: flex;
            align-items: center;
            gap: 20px;
            flex: 1;
        }

        .step-number {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            font-weight: bold;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            flex-shrink: 0;
        }

        .step-info {
            flex: 1;
        }

        .step-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2d3748;
            margin: 0 0 5px 0;
        }

        .step-label {
            font-size: 0.85rem;
            color: #667eea;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .step-actions {
            display: flex;
            gap: 10px;
            flex-shrink: 0;
            z-index: 10;
            position: relative;
        }

        .btn-action {
            padding: 8px 16px;
            border-radius: 10px;
            border: none;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.9rem;
        }

        .btn-edit {
            background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(253, 160, 133, 0.3);
        }

        .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(253, 160, 133, 0.5);
        }

        .btn-delete {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(245, 87, 108, 0.3);
        }

        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(245, 87, 108, 0.5);
        }

        .step-description {
            color: #4a5568;
            line-height: 1.8;
            font-size: 1.05rem;
            padding-left: 80px;
            margin-top: 10px;
        }

        .step-icon-decoration {
            position: absolute;
            right: 30px;
            bottom: 30px;
            font-size: 4rem;
            color: rgba(102, 126, 234, 0.08);
            transition: all 0.3s ease;
            z-index: 1;
        }

        .process-step:hover .step-icon-decoration {
            color: rgba(102, 126, 234, 0.15);
            transform: scale(1.1) rotate(5deg);
        }

        .diagram-section {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 50px 30px;
            margin: 60px 0;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        }

        .diagram-title {
            font-size: 2rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 40px;
            text-align: center;
        }

        .diagram {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            position: relative;
        }

        .diagram-box {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 15px;
            padding: 25px 20px;
            text-align: center;
            width: 180px;
            font-weight: 600;
            color: white;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
            transition: all 0.3s ease;
            position: relative;
            cursor: pointer;
        }

        .diagram-box:hover {
            transform: translateY(-10px) scale(1.05);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.5);
        }

        .diagram-box::after {
            content: '→';
            position: absolute;
            right: -25px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.5rem;
            color: rgba(255, 255, 255, 0.6);
        }

        .diagram-box:last-child::after {
            content: '';
        }

        .add-button-container {
            text-align: center;
            margin: 40px 0;
        }

        .btn-add {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 15px 40px;
            border-radius: 50px;
            border: none;
            font-weight: 700;
            font-size: 1.1rem;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-add:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.6);
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: white;
        }

        .empty-state i {
            font-size: 5rem;
            margin-bottom: 20px;
            opacity: 0.8;
        }

        .empty-state h3 {
            font-size: 1.8rem;
            margin-bottom: 10px;
        }

        .empty-state p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .step-header {
                flex-direction: column;
            }

            .step-left {
                width: 100%;
            }

            .step-actions {
                width: 100%;
                justify-content: flex-start;
                margin-left: 80px;
            }

            .step-description {
                padding-left: 0;
                margin-top: 15px;
            }

            .step-icon-decoration {
                font-size: 3rem;
                right: 20px;
                bottom: 20px;
            }

            .diagram-box::after {
                content: '↓';
                right: 50%;
                top: auto;
                bottom: -30px;
                transform: translateX(50%);
            }

            .diagram-box:last-child::after {
                content: '';
            }
        }

        .pulse {
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
            }

            50% {
                box-shadow: 0 8px 40px rgba(102, 126, 234, 0.6);
            }
        }
    </style>
</head>

<body>
     @include('layouts.navbar')
    <div class="hero-section">
        <div class="container text-center">
            <h1 class="hero-title">Proses Bisnis SPI</h1>
            <p class="hero-subtitle">
                Satuan Pengawasan Internal (SPI) menjalankan proses bisnis yang sistematis dan terstruktur
                untuk memastikan pengawasan berjalan efektif, transparan, dan akuntabel di seluruh organisasi.
            </p>
        </div>
    </div>

    <div class="container process-container">
        @forelse ($processes as $process)
            <div class="process-step">
                <div class="step-header">
                    <div class="step-left">
                        <div class="step-number">{{ $process->step_number }}</div>
                        <div class="step-info">
                            <div class="step-label">Langkah {{ $process->step_number }}</div>
                            <h5 class="step-title">{{ $process->title }}</h5>
                        </div>
                    </div>

                    <div class="text-center mt-3">
                        @auth
                            @if (Auth::user()->role === 'admin')
                                <div class="step-actions">
                                    <a href="{{ route('processes.edit', $process->id) }}" class="btn btn-warning btn-sm edit-btn">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>

                                    <form action="{{ route('processes.destroy', $process->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>

                </div>

                <p class="step-description">{{ $process->description }}</p>

                <i class="{{ $process->icon }} step-icon-decoration"></i>
            </div>
        @empty
            <p class="text-center text-muted">Belum ada data proses yang ditambahkan.</p>
        @endforelse
    </div>

    @auth
        @if (Auth::user()->role === 'admin')
            <div class="text-center mt-4">
                <a href="{{ route('processes.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Langkah Baru
                </a>
            </div>
        @endif
    @endauth

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Konfirmasi Hapus
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const form = this.closest('form');

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data ini tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    background: '#fefefe',
                    customClass: {
                        title: 'fw-bold',
                        popup: 'rounded-4 shadow-lg',
                        confirmButton: 'rounded-pill px-4 py-2',
                        cancelButton: 'rounded-pill px-4 py-2'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // SweetAlert untuk Edit (animasi & transisi halus)
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const href = this.getAttribute('href');

                Swal.fire({
                    title: 'Edit Data',
                    text: 'Apakah kamu ingin mengedit langkah ini?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#4CAF50',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, edit',
                    cancelButtonText: 'Batal',
                    background: '#ffffff',
                    customClass: {
                        title: 'fw-bold',
                        popup: 'rounded-4 shadow-lg',
                        confirmButton: 'rounded-pill px-4 py-2',
                        cancelButton: 'rounded-pill px-4 py-2'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = href;
                    }
                });
            });
        });
    </script>


    <!-- <div class="container">
        <div class="diagram-section">
            <h3 class="diagram-title">Diagram Alur Proses</h3>
            <div class="diagram">
                <div class="diagram-box pulse">
                    <i class="bi bi-1-circle-fill d-block mb-2" style="font-size: 2rem;"></i>
                    Perencanaan
                </div>
                <div class="diagram-box pulse">
                    <i class="bi bi-2-circle-fill d-block mb-2" style="font-size: 2rem;"></i>
                    Pelaksanaan
                </div>
                <div class="diagram-box pulse">
                    <i class="bi bi-3-circle-fill d-block mb-2" style="font-size: 2rem;"></i>
                    Pelaporan
                </div>
                <div class="diagram-box pulse">
                    <i class="bi bi-4-circle-fill d-block mb-2" style="font-size: 2rem;"></i>
                    Tindak Lanjut
                </div>
                <div class="diagram-box pulse">
                    <i class="bi bi-5-circle-fill d-block mb-2" style="font-size: 2rem;"></i>
                    Evaluasi
                </div>
            </div>
        </div>
    </div> -->

    <div style="height: 60px;"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>