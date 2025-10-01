<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengaduan Masyarakat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;500;700;900&display=swap" rel="stylesheet">


    <style>
        :root {
            --primary: #0d6efd;
            --secondary: #1b2a49;
            --success: #198754;
            --danger: #dc3545;
            --warning: #ffc107;
            --light: #f8f9fa;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #e9f2fb, #f8f9fa);
            color: var(--secondary);
        }

        /* Glass Card */
        .form-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 18px;
            padding: 40px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(10px);
            transition: transform 0.3s ease;
        }

        .form-card:hover {
            transform: translateY(-5px);
        }

        h3 {
            font-weight: 800;
            color: var(--secondary);
        }

        /* Input & Select */
        .form-control,
        .form-select {
            border-radius: 12px;
            padding: 12px 15px;
            border: 1px solid #dee2e6;
            transition: 0.3s;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(45deg, var(--primary), #0056d2);
            border: none;
            border-radius: 12px;
            padding: 10px 28px;
            font-weight: 600;
            transition: 0.3s;
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 20px rgba(13, 110, 253, 0.4);
        }

        .btn-outline-secondary {
            border-radius: 12px;
            transition: 0.3s;
        }

        .btn-outline-secondary:hover {
            background: #dee2e6;
            color: var(--secondary);
        }

        /* Timeline */
        .process-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin: 60px auto;
            max-width: 1200px;
            position: relative;
        }

        .process-step {
            text-align: center;
            position: relative;
            flex: 1;
            padding: 0 15px;
        }

        .process-icon-container {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.7rem;
            font-weight: bold;
            color: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.15);
            margin-bottom: 12px;
            transition: transform 0.3s ease, box-shadow 0.3s ease, opacity 0.3s ease;
            opacity: 0.6;
        }

        .process-step.active .process-icon-container {
            transform: scale(1.15);
            opacity: 1;
            box-shadow: 0 6px 20px rgba(13, 110, 253, 0.18);
            border: 3px solid rgba(13, 110, 253, 0.12);
        }

        .process-title {
            font-weight: 700;
            margin-top: 10px;
        }

        .process-detail {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .process-row::before {
            content: "";
            position: absolute;
            top: 32px;
            left: 8%;
            right: 8%;
            height: 4px;
            background: #dee2e6;
            z-index: -1;
            border-radius: 2px;
        }

        .process-row::after {
            content: "";
            position: absolute;
            top: 32px;
            left: 8%;
            height: 4px;
            background: var(--primary);
            z-index: -1;
            border-radius: 2px;
            width: 0%;
            transition: width 0.5s;
        }

        @media (max-width: 767px) {
            .process-row {
                flex-direction: column;
            }

            .process-row::before,
            .process-row::after {
                display: none;
            }

            .process-step {
                margin-bottom: 40px;
            }
        }

        /* Step colors */
        .step-1 .process-icon-container {
            background: var(--warning);
        }

        .step-2 .process-icon-container {
            background: #0dcaf0;
        }

        .step-3 .process-icon-container {
            background: var(--primary);
        }

        .step-4 .process-icon-container {
            background: var(--secondary);
        }

        .step-5 .process-icon-container {
            background: var(--success);
        }
    </style>
</head>

<body>
    @include('layouts.navbar')

    {{-- Timeline Alur Pengaduan --}}
    @php
        $steps = [
            'laporan_dikirim' => ['title' => 'Tulis Laporan', 'detail' => 'Laporkan keluhan Anda dengan jelas dan lengkap', 'icon' => 'bi-pencil-square', 'class' => 'step-1'],
            'diverifikasi' => ['title' => 'Verifikasi', 'detail' => 'Dalam 3 hari laporan diverifikasi & diteruskan', 'icon' => 'bi-arrow-right-circle', 'class' => 'step-2'],
            'tindak_lanjut' => ['title' => 'Tindak Lanjut', 'detail' => 'Instansi menindaklanjuti dalam 5 hari', 'icon' => 'bi-chat-dots', 'class' => 'step-3'],
            'tanggapan_pelapor' => ['title' => 'Tanggapan Pelapor', 'detail' => 'Anda bisa menanggapi balasan hingga 10 hari', 'icon' => 'bi-chat-text', 'class' => 'step-4'],
            'selesai' => ['title' => 'Selesai', 'detail' => 'Pengaduan selesai ditindaklanjuti', 'icon' => 'bi-check-circle-fill', 'class' => 'step-5'],
        ];
        $currentStep = array_search($pengaduan->status ?? 'laporan_dikirim', array_keys($steps)) + 1;
        $totalSteps = count($steps);
        $progressWidth = ($currentStep - 1) / ($totalSteps - 1) * 100;
    @endphp

    <div class="container">
        <h2 class="text-center fw-bold mt-5">Alur Proses Pengaduan</h2>
        <div class="position-relative mt-5 process-row">
            <!-- Garis aktif -->
            <div class="position-absolute top-50 start-0"
                style="height:4px;background:var(--primary);z-index:1;transform: translateY(-50%);border-radius:2px;width: {{ $progressWidth }}%; transition: width 0.5s;">
            </div>

            @foreach($steps as $key => $step)
                <div
                    class="process-step {{ $step['class'] }} text-center flex-fill position-relative {{ $currentStep >= $loop->index + 1 ? 'active' : '' }}">
                    <div class="process-icon-container">
                        <i class="bi {{ $step['icon'] }}"></i>
                    </div>
                    <p class="process-title fw-semibold">{{ $step['title'] }}</p>
                    <small class="process-detail text-muted">{{ $step['detail'] }}</small>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Button Lihat Laporan Saya -->
    <div class="text-center mt-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#laporanModal">
            <i class="bi bi-journal-text me-1"></i> Lihat Laporan Saya
        </button>

    </div>

    <div class="modal fade" id="laporanModal" tabindex="-1" aria-labelledby="laporanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white p-4">
                    <h5 class="modal-title fw-bold" id="laporanModalLabel"><i
                            class="bi bi-journal-text me-3 fs-4"></i>Daftar Laporan Saya</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">

                    @forelse($userLaporans as $laporan)
                        <div class="card mb-4 shadow-sm border-2 border-light rounded-4">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h5 class="mb-1 fw-bolder text-dark">{{ $laporan->judul }}</h5>
                                        <span
                                            class="badge {{ $laporan->status === 'selesai' ? 'bg-success' : ($laporan->status === 'tindak_lanjut' ? 'bg-warning text-dark' : 'bg-secondary') }} text-uppercase">{{ str_replace('_', ' ', $laporan->status) }}</span>
                                        <div class="mt-2 text-muted">
                                            <i class="bi bi-calendar me-1"></i>
                                            <small>{{ $laporan->created_at->format('d M Y, H:i') }}</small>
                                        </div>
                                    </div>

                                    <!-- Alert Flash Message -->
                                    @if(session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif

                                    <!-- Form Laporan -->
                                    <form method="POST" action="{{ route('pengaduan.destroy', $laporan->id) }}">
                                        @csrf
                                        <button class="btn btn-sm btn-outline-primary toggle-detail" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#detail-{{ $laporan->id }}"
                                            aria-expanded="false" aria-controls="detail-{{ $laporan->id }}">
                                            <i class="bi bi-chevron-down me-1"></i>
                                            <span class="btn-text">Lihat Detail</span>
                                        </button>

                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');">
                                            <i class="bi bi-trash me-1"></i> Hapus
                                        </button>
                                    </form>

                                </div>

                                <div class="collapse mt-4 pt-3 border-top" id="detail-{{ $laporan->id }}">
                                    <div class="card card-body bg-light border-0 shadow-sm rounded-3 p-4">
                                        <h6 class="fw-bold text-primary mb-3">Detail Laporan</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <p class="mb-1 text-secondary">Kategori:</p>
                                                <p class="fw-semibold">{{ $laporan->kategori }}</p>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <p class="mb-1 text-secondary">Uraian:</p>
                                                <p>{{ $laporan->kritik_saran }}</p>
                                            </div>
                                        </div>

                                        @if($laporan->bukti_foto)
                                            <p class="mb-1 text-secondary">Bukti Foto:</p>
                                            <a href="{{ asset('storage/' . $laporan->bukti_foto) }}" target="_blank">
                                                <img src="{{ asset('storage/' . $laporan->bukti_foto) }}"
                                                    class="img-thumbnail rounded"
                                                    style="max-height: 200px; max-width: 300px; object-fit: cover;" alt="Bukti">
                                            </a>
                                        @endif

                                        @php
                                            $steps = [
                                                'laporan_dikirim' => ['title' => 'Tulis Laporan', 'detail' => 'Laporkan keluhan', 'icon' => 'bi-pencil-square', 'class' => 'step-1'],
                                                'diverifikasi' => ['title' => 'Verifikasi', 'detail' => 'Diverifikasi & diteruskan', 'icon' => 'bi-arrow-right-circle', 'class' => 'step-2'],
                                                'tindak_lanjut' => ['title' => 'Tindak Lanjut', 'detail' => 'Ditindaklanjuti', 'icon' => 'bi-chat-dots', 'class' => 'step-3'],
                                                'tanggapan_pelapor' => ['title' => 'Tanggapan Pelapor', 'detail' => 'Beri tanggapan', 'icon' => 'bi-chat-text', 'class' => 'step-4'],
                                                'selesai' => ['title' => 'Selesai', 'detail' => 'Selesai ditindaklanjuti', 'icon' => 'bi-check-circle-fill', 'class' => 'step-5'],
                                            ];
                                            $currentStep = array_search($laporan->status, array_keys($steps)); // Mengambil index 0-based
                                            $currentStepDisplay = $currentStep + 1; // Untuk tampilan 1-based
                                            $totalSteps = count($steps);
                                            // Hitung progress width (totalSteps - 1 untuk jarak antar langkah)
                                            $progressWidth = ($totalSteps > 1) ? ($currentStep / ($totalSteps - 1) * 100) : 0;
                                        @endphp

                                        <h6 class="fw-bold text-primary mb-4 mt-4 pt-3 border-top">Status Proses</h6>

                                        <div class="position-relative process-row">
                                            <div
                                                style="position:absolute; top:32px; left:5%; right:5%; height:4px; background:#dee2e6; border-radius:2px; z-index:0;">
                                            </div>
                                            <div
                                                style="position:absolute; top:32px; left:5%; height:4px; background:#0d6efd; width:{{ $progressWidth }}%; border-radius:2px; z-index:1; transition:width 0.5s;">
                                            </div>

                                            @foreach($steps as $key => $step)
                                                <div
                                                    class="process-step {{ $step['class'] }} active text-center flex-fill position-relative">
                                                    <div class="process-icon-container bg-white shadow-sm mb-2">
                                                        <i class="bi {{ $step['icon'] }}" style="color: #0d6efd;"></i>
                                                    </div>
                                                    <p class="process-title fw-bolder mb-1">{{ $step['title'] }}</p>
                                                    <small class="text-muted">{{ $step['detail'] }}</small>
                                                </div>

                                            @endforeach
                                        </div>

                                        <div class="mt-4 pt-3 border-top">
                                            <span class="badge bg-primary fs-6 fw-bold">Status Saat Ini:
                                                {{ $steps[array_keys($steps)[$currentStep]]['title'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-info text-center py-4 rounded-3 shadow-sm">
                            <i class="bi bi-box-seam fs-3 d-block mb-2"></i>
                            <p class="mb-0 fw-semibold">Belum ada laporan yang Anda kirimkan.</p>
                            <small>Mulai laporkan keluhan atau saran Anda sekarang!</small>
                        </div>
                    @endforelse

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Fungsi untuk memperbarui teks tombol collapse dan styling
            document.querySelectorAll('.toggle-detail').forEach(button => {
                const targetId = button.getAttribute('data-bs-target');
                const collapseEl = document.querySelector(targetId);

                // Atur status awal tombol jika detail sudah terbuka (misalnya setelah refresh jika state disimpan)
                if (collapseEl && collapseEl.classList.contains('show')) {
                    button.innerHTML = '<i class="bi bi-chevron-up"></i> Tutup Detail';
                    button.classList.remove('btn-outline-primary');
                    button.classList.add('btn-primary');
                }

                if (collapseEl) {
                    collapseEl.addEventListener('show.bs.collapse', () => {
                        button.innerHTML = '<i class="bi bi-chevron-up"></i> Tutup Detail';
                        button.classList.remove('btn-outline-primary');
                        button.classList.add('btn-primary');
                    });
                    collapseEl.addEventListener('hide.bs.collapse', () => {
                        button.innerHTML = '<i class="bi bi-chevron-down"></i> Lihat Detail';
                        button.classList.remove('btn-primary');
                        button.classList.add('btn-outline-primary');
                    });
                }
            });
        });
    </script>



    {{-- Form Pengaduan --}}
    <div class="container my-5" style="max-width: 850px;">
        <div class="form-card">
            <div class="d-flex align-items-center justify-content-center mb-4">
                <i class="bi bi-envelope-paper-fill text-primary me-2 fs-2"></i>
                <h3 class="mb-0">Form Pengaduan Masyarakat 📝</h3>
            </div>

            <form method="POST" action="{{ route('pengaduan.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="nama" class="form-label">Nama Pelapor <span class="text-danger">*</span></label>
                        <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama lengkap"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="email@contoh.com"
                            required>
                    </div>
                </div>

                <div class="mt-4">
                    <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                    <select class="form-select" id="kategori" name="kategori" required>
                        <option value="" disabled selected>Pilih kategori...</option>
                        <option>Pelanggaran Etika</option>
                        <option>Gratifikasi</option>
                        <option>Penyalahgunaan Wewenang</option>
                        <option>Kualitas Layanan</option>
                        <option>Lainnya</option>
                    </select>
                </div>

                <div class="mt-4">
                    <label for="judul" class="form-label">Judul Pengaduan <span class="text-danger">*</span></label>
                    <input type="text" id="judul" name="judul" class="form-control" placeholder="Ringkasan judul"
                        required>
                </div>

                <div class="mt-4">
                    <label for="kritik_saran" class="form-label">Uraian <span class="text-danger">*</span></label>
                    <textarea id="kritik_saran" name="kritik_saran" class="form-control" rows="6"
                        placeholder="Tulis detail pengaduan..." required></textarea>
                </div>

                <div class="mt-4">
                    <label for="bukti_foto" class="form-label">Bukti Foto (opsional)</label>
                    <input type="file" id="bukti_foto" name="bukti_foto" class="form-control" accept="image/*">
                </div>

                <p class="text-muted small mt-3"><span class="text-danger">*</span> Wajib diisi</p>

                <!-- Pilihan Anonim / Rahasia -->
                <div class="mt-3">
                    <label class="form-label fw-semibold">Opsi Privasi Pengaduan</label>
                    <div class="d-flex gap-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="privasi" id="anonim" value="anonim"
                                checked>
                            <label class="form-check-label" for="anonim">
                                Anonim
                            </label>
                            <small class="d-block text-muted">Nama Anda tidak akan terpublish di laporan</small>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="privasi" id="rahasia" value="rahasia">
                            <label class="form-check-label" for="rahasia">
                                Rahasia
                            </label>
                            <small class="d-block text-muted">Laporan Anda tidak dapat dilihat oleh publik</small>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4 gap-2">
                    <button type="reset" class="btn btn-outline-secondary"><i class="bi bi-x-circle me-1"></i>
                        Reset</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-send-fill me-1"></i>
                        Kirim</button>
                </div>
            </form>
        </div>
    </div>
    @if(session('success'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080;">
            {{-- Toast menggunakan text-bg-success (hijau terang) --}}
            <div id="successToast" class="toast text-bg-success rounded-3 shadow-sm border-0" role="alert"
                aria-live="assertive" aria-atomic="true">

                <div class="toast-body d-flex align-items-center p-3 pb-2">

                    {{-- Icon SVG --}}
                    <svg class="bi flex-shrink-0 me-2" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </svg>

                    {{-- Message Content --}}
                    <div class="me-auto text-white fw-semibold">
                        {{ session('success') }}
                    </div>

                    {{-- Dismiss Button --}}
                    <button type="button" class="btn-close btn-close-white ms-2" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>

                {{-- Progress Bar Container (LANE/TRACK) --}}
                {{-- Mengubah background progress menjadi warna hijau tua (dark green) untuk kontras --}}
                <div class="progress" style="height: 3px; border-radius: 0; background-color: #127439;">
                    <div id="toastProgress" class="progress-bar bg-white" role="progressbar"
                        style="width: 100%; transition: none;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>
            </div>
        </div>
    @endif

    ---

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toastEl = document.getElementById('successToast');
            const progressEl = document.getElementById('toastProgress');
            const delay = 5000; // 5 seconds (must match the CSS transition duration)

            if (toastEl && progressEl) {

                // Inisialisasi Toast
                const toast = new bootstrap.Toast(toastEl, { delay: delay });

                // 1. Terapkan transisi CSS untuk animasi bilah progres
                progressEl.style.transition = `width ${delay}ms linear`;

                // 2. Event Listener saat toast ditampilkan
                toastEl.addEventListener('show.bs.toast', () => {
                    progressEl.style.width = '100%';
                    setTimeout(() => {
                        // Memicu animasi bilah progres dari 100% ke 0%
                        progressEl.style.width = '0%';
                    }, 10);
                });

                // 3. Event Listener setelah toast selesai disembunyikan
                toastEl.addEventListener('hidden.bs.toast', () => {
                    // Atur ulang progres bar agar siap untuk tampilan berikutnya
                    progressEl.style.transition = 'none';
                    progressEl.style.width = '100%';
                    setTimeout(() => {
                        progressEl.style.transition = `width ${delay}ms linear`;
                    }, 50);
                });

                // 4. Tampilkan toast
                toast.show();
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @include('layouts.NavbarBawah')
</body>

</html>