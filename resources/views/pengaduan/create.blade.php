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
            overflow-x: hidden;
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
            position: relative;
            z-index: 2;
            background: white;
            border: 3px solid white;
        }

        .process-step.active .process-icon-container {
            transform: scale(1.15);
            opacity: 1;
            box-shadow: 0 6px 20px rgba(13, 110, 253, 0.18);
            border: 3px solid white;
        }

        .process-title {
            font-weight: 700;
            margin-top: 10px;
            position: relative;
            z-index: 3;
        }

        .process-detail {
            font-size: 0.9rem;
            color: #6c757d;
            position: relative;
            z-index: 3;
        }

        /* Garis background (abu-abu) */
        .process-row::before {
            content: "";
            position: absolute;
            top: 32px;
            left: 8%;
            right: 8%;
            height: 4px;
            background: #dee2e6;
            z-index: 0;
            border-radius: 2px;
        }

        /* Garis aktif (biru) */
        .process-row::after {
            content: "";
            position: absolute;
            top: 32px;
            left: 8%;
            height: 4px;
            background: var(--primary);
            z-index: 0;
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
    @auth
        {{-- Tombol Lihat Laporan Saya --}}
        <div class="text-center mt-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#laporanModal">
                <i class="bi bi-journal-text me-1"></i> Lihat Laporan Saya
            </button>
        </div>

        {{-- Modal Daftar Laporan --}}
        <div class="modal fade" id="laporanModal" tabindex="-1" aria-labelledby="laporanModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white p-4">
                        <h5 class="modal-title fw-bold" id="laporanModalLabel">
                            <i class="bi bi-journal-text me-3 fs-4"></i>Daftar Laporan Saya
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        @forelse($userLaporans as $laporan)
                            <div class="card mb-4 shadow-sm border-2 border-light rounded-4">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h5 class="mb-1 fw-bolder text-dark">{{ $laporan->perihal }}</h5>
                                            <span
                                                class="badge {{ $laporan->status === 'selesai' ? 'bg-success' : ($laporan->status === 'tindak_lanjut' ? 'bg-warning text-dark' : 'bg-secondary') }} text-uppercase">
                                                {{ str_replace('_', ' ', $laporan->status) }}
                                            </span>
                                            <div class="mt-2 text-muted">
                                                <i class="bi bi-calendar me-1"></i>
                                                <small>{{ $laporan->tanggal_pengaduan }} |
                                                    {{ $laporan->created_at->format('d M Y, H:i') }}</small>
                                            </div>
                                        </div>

                                        {{-- Tombol Aksi --}}
                                        <form method="POST" action="{{ route('pengaduan.destroy', $laporan->id) }}">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-sm btn-outline-primary toggle-detail" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#detail-{{ $laporan->id }}"
                                                aria-expanded="false" aria-controls="detail-{{ $laporan->id }}">
                                                <i class="bi bi-chevron-down me-1"></i>
                                                <span class="btn-text">Lihat Detail</span>
                                            </button>

                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');">
                                                <i class="bi bi-trash me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>

                                    {{-- Detail Laporan --}}
                                    <div class="collapse mt-4 pt-3 border-top" id="detail-{{ $laporan->id }}">
                                        <div class="card card-body bg-light border-0 shadow-sm rounded-3 p-4">
                                            <h6 class="fw-bold text-primary mb-3">Detail Laporan</h6>

                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <p class="mb-1 text-secondary">Perihal:</p>
                                                    <p class="fw-semibold">{{ $laporan->perihal }}</p>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <p class="mb-1 text-secondary">Uraian:</p>
                                                    <p>{{ $laporan->uraian }}</p>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <p class="mb-1 text-secondary">Usia:</p>
                                                    <p>{{ $laporan->usia }}</p>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <p class="mb-1 text-secondary">Pendidikan:</p>
                                                    <p>{{ $laporan->pendidikan }}</p>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <p class="mb-1 text-secondary">Pekerjaan:</p>
                                                    <p>{{ $laporan->pekerjaan }}
                                                        {{ $laporan->pekerjaan_lain ? '(' . $laporan->pekerjaan_lain . ')' : '' }}
                                                    </p>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <p class="mb-1 text-secondary">Waktu Hubung:</p>
                                                    <p>{{ $laporan->waktu_hubung }}
                                                        {{ $laporan->waktu_lain ? '(' . $laporan->waktu_lain . ')' : '' }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <p class="mb-1 text-secondary">Pelanggaran:</p>
                                                <ul>
                                                    @php
                                                        $pelanggaranList = $laporan->pelanggaran;
                                                        if (is_string($pelanggaranList)) {
                                                            $pelanggaranList = json_decode($pelanggaranList, true) ?? [];
                                                        }
                                                        $pelanggaranList = $pelanggaranList ?? [];
                                                    @endphp

                                                    @foreach($pelanggaranList as $p)
                                                        <li>{{ $p }}</li>
                                                    @endforeach

                                                    @if(!empty($laporan->pelanggaran_lain))
                                                        <li>lainnya ({{ $laporan->pelanggaran_lain }})</li>
                                                    @endif
                                                </ul>
                                            </div>


                                            <div class="mt-3">
                                                <p class="mb-1 text-secondary">Kontak yang bisa dihubungi:</p>
                                                <ul>
                                                    @php
                                                        $kontakList = $laporan->kontak;
                                                        if (is_string($kontakList)) {
                                                            $kontakList = json_decode($kontakList, true) ?? [];
                                                        }
                                                        $kontakList = $kontakList ?? [];
                                                    @endphp
                                                    @foreach($kontakList as $k)
                                                        <li>{{ $k }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                            <div class="mt-3">
                                                <p class="mb-1 text-secondary">Kejadian:</p>
                                                <p>{{ $laporan->tanggal_kejadian }} | {{ $laporan->jam_kejadian }}</p>
                                                <p>Tempat: {{ $laporan->tempat_kejadian }}
                                                    {{ $laporan->tempat_lain ? '(' . $laporan->tempat_lain . ')' : '' }}
                                                </p>
                                            </div>

                                            {{-- Data Terlapor --}}
                                            <div class="mt-3">
                                                <p class="mb-1 text-secondary">Terlapor:</p>
                                                @php
                                                    $terlapors = [];

                                                    if (!empty($laporan->terlapor)) {
                                                        $decoded = json_decode($laporan->terlapor, true);
                                                        if (is_array($decoded)) {
                                                            $terlapors = $decoded;
                                                        }
                                                    }
                                                @endphp

                                                @if(count($terlapors) > 0)
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Nama</th>
                                                                <th>NIP</th>
                                                                <th>Satuan Kerja</th>
                                                                <th>Jabatan</th>
                                                                <th>Jenis Kelamin</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($terlapors as $t)
                                                                <tr>
                                                                    <td>{{ $t['nama'] ?? '-' }}</td>
                                                                    <td>{{ $t['nip'] ?? '-' }}</td>
                                                                    <td>{{ $t['satuan_kerja'] ?? '-' }}</td>
                                                                    <td>{{ $t['jabatan'] ?? '-' }}</td>
                                                                    <td>{{ $t['jenis_kelamin'] ?? '-' }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <p class="text-muted">Tidak ada data terlapor</p>
                                                @endif
                                            </div>

                                            {{-- Identitas & Pihak Terkait --}}
                                            <div class="mt-3">
                                                <p class="mb-1 text-secondary">Identitas Anda ingin diketahui terlapor?</p>
                                                <p>{{ $laporan->identitas_diketahui }}</p>
                                            </div>

                                            <div class="mt-3">
                                                <p class="mb-1 text-secondary">Pihak Terkait:</p>
                                                <p>{{ $laporan->pihak_terkait ?? '-' }}</p>
                                            </div>

                                            {{-- Bukti File --}}
                                            @if($laporan->bukti_file || $laporan->link_video)
                                                <div class="mt-3">
                                                    <p class="mb-1 text-secondary">Bukti:</p>

                                                    {{-- Tampilkan file upload --}}
                                                    @if($laporan->bukti_file)
                                                        @php $files = json_decode($laporan->bukti_file, true); @endphp
                                                        @foreach($files as $file)
                                                            <a href="{{ asset('storage/' . $file) }}" target="_blank" class="d-block mb-2">
                                                                <i class="bi bi-paperclip"></i> {{ basename($file) }}
                                                            </a>
                                                        @endforeach
                                                    @endif

                                                    {{-- Tampilkan link video --}}
                                                    @if($laporan->link_video)
                                                        <a href="{{ $laporan->link_video }}" target="_blank" class="d-block mb-2">
                                                            <i class="bi bi-play-circle"></i> Video Link
                                                        </a>
                                                    @endif
                                                </div>
                                            @endif

                                            {{-- Status Proses --}}
                                            @php
                                                $steps = [
                                                    'laporan_dikirim' => ['title' => 'Tulis Laporan', 'detail' => 'Laporkan keluhan', 'icon' => 'bi-pencil-square', 'class' => 'step-1'],
                                                    'diverifikasi' => ['title' => 'Verifikasi', 'detail' => 'Diverifikasi & diteruskan', 'icon' => 'bi-arrow-right-circle', 'class' => 'step-2'],
                                                    'tindak_lanjut' => ['title' => 'Tindak Lanjut', 'detail' => 'Ditindaklanjuti', 'icon' => 'bi-chat-dots', 'class' => 'step-3'],
                                                    'tanggapan_pelapor' => ['title' => 'Tanggapan Pelapor', 'detail' => 'Beri tanggapan', 'icon' => 'bi-chat-text', 'class' => 'step-4'],
                                                    'selesai' => ['title' => 'Selesai', 'detail' => 'Selesai ditindaklanjuti', 'icon' => 'bi-check-circle-fill', 'class' => 'step-5'],
                                                ];
                                                $currentStep = array_search($laporan->status, array_keys($steps));
                                                $totalSteps = count($steps);
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
    @endauth


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

            <form id="formPengaduan" method="POST" action="{{ route('pengaduan.store') }}"
                enctype="multipart/form-data">
                @csrf

                <!-- STEP 1 -->
                <div id="step1">
                    <!-- Bagian 1: Uraian Pengaduan -->
                    <h5 class="mb-3">Uraian Pengaduan</h5>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <label for="tanggal_pengaduan" class="form-label">Tanggal Pengaduan <span
                                    class="text-danger">*</span></label>
                            <input type="date" id="tanggal_pengaduan" name="tanggal_pengaduan" class="form-control"
                                required>
                        </div>
                        <div class="col-md-8">
                            <label for="perihal" class="form-label">Perihal <span class="text-danger">*</span></label>
                            <input type="text" id="perihal" name="perihal" class="form-control"
                                placeholder="Tuliskan perihal pengaduan..." required>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="uraian" class="form-label">Uraian Aduan <span class="text-danger">*</span></label>
                        <textarea id="uraian" name="uraian" class="form-control" rows="5"
                            placeholder="Tuliskan uraian aduan secara detail (apa, siapa, kapan, dimana, mengapa, bagaimana kejadian) "
                            required></textarea>
                    </div>

                    <div class="mt-4">
                        <label for="bukti_file" class="form-label">Upload File / Foto / Video (maksimal 100 MB per
                            file)</label>
                        <input type="file" id="bukti_file" name="bukti_file[]" class="form-control"
                            accept="image/*,video/*,.pdf,.doc,.docx" multiple>
                        <small class="text-muted">Anda dapat mengupload lebih dari satu file</small>
                    </div>

                    <div class="mt-3">
                        <label for="link_video" class="form-label">Link Video (YouTube, Vimeo, dll)</label>
                        <input type="url" id="link_video" name="link_video" class="form-control"
                            placeholder="Masukkan URL video, misal: https://www.youtube.com/watch?v=XXXX"
                            value="{{ old('link_video') }}">
                        <small class="text-muted">Opsional: jika video di-upload dari link</small>
                    </div>


                    <hr class="my-5">

                    <!-- Bagian 2: Informasi Pendukung -->
                    <h5 class="mb-3">Informasi Pendukung</h5>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <label for="usia" class="form-label">Usia Anda <span class="text-danger">*</span></label>
                            <input type="number" id="usia" name="usia" class="form-control" min="10" max="100"
                                placeholder="Contoh: 25" required>
                        </div>
                        <div class="col-md-8">
                            <label for="pendidikan" class="form-label">Pendidikan Terakhir <span
                                    class="text-danger">*</span></label>
                            <select id="pendidikan" name="pendidikan" class="form-select" required>
                                <option value="" disabled selected>Pilih pendidikan terakhir...</option>
                                <option>SD</option>
                                <option>SMP</option>
                                <option>SMA/SMK</option>
                                <option>D3</option>
                                <option>S1/D4</option>
                                <option>S2</option>
                                <option>S3</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="form-label">Pekerjaan Anda <span class="text-danger">*</span></label>
                        <select id="pekerjaan" name="pekerjaan" class="form-select" required
                            onchange="togglePekerjaanLain()">
                            <option value="" disabled selected>Pilih pekerjaan...</option>
                            <option>Advokat</option>
                            <option>Pegawai Swasta</option>
                            <option>Wirausaha</option>
                            <option>Aparatur Sipil Negara</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                        <input type="text" id="pekerjaan_lain" name="pekerjaan_lain" class="form-control mt-2 d-none"
                            placeholder="Jelaskan pekerjaan Anda...">
                    </div>

                    <div class="mt-4">
                        <label class="form-label">Waktu terbaik untuk kami menghubungi Anda <span
                                class="text-danger">*</span></label>
                        <select id="waktu_hubung" name="waktu_hubung" class="form-select" required
                            onchange="toggleWaktuLain()">
                            <option value="" disabled selected>Pilih opsi...</option>
                            <option>Bisa Kapan Saja</option>
                            <option value="lainnya">Sebaiknya di waktu berikut</option>
                        </select>
                        <input type="text" id="waktu_lain" name="waktu_lain" class="form-control mt-2 d-none"
                            placeholder="Contoh: Senin-Jumat pukul 18.00-20.00">
                    </div>

                    <hr class="my-5">

                    <!-- Bagian 3: Bentuk Pelanggaran & Kontak -->
                    <h5 class="mb-3">Bentuk Pelanggaran & Cara Menghubungi</h5>
                    <div class="mt-3">
                        <label class="form-label">
                            Bentuk pelanggaran yang akan Anda laporkan? <span class="text-danger">*</span>
                        </label>

                        <!-- Kotak 1 -->
                        <div class="card mb-3 shadow-sm border-primary">
                            <div class="card-body">
                                <h6 class="card-title mb-3 text-primary">Pelanggaran Etika & Integritas Akademik</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="pelanggaran[]"
                                        value="Pelanggaran norma dan etika" id="pel1">
                                    <label class="form-check-label" for="pel1">Pelanggaran norma dan etika</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="pelanggaran[]"
                                        value="Plagiasi / Falsifikasi / Fabrikasi" id="pel2">
                                    <label class="form-check-label" for="pel2">Plagiasi / Falsifikasi /
                                        Fabrikasi</label>
                                </div>
                            </div>
                        </div>

                        <!-- Kotak 2 -->
                        <div class="card mb-3 shadow-sm border-success">
                            <div class="card-body">
                                <h6 class="card-title mb-3 text-success">Pelanggaran Integritas & Anti Korupsi</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="pelanggaran[]"
                                                value="Korupsi" id="pel3">
                                            <label class="form-check-label" for="pel3">Korupsi</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="pelanggaran[]"
                                                value="Kolusi" id="pel4">
                                            <label class="form-check-label" for="pel4">Kolusi</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="pelanggaran[]"
                                                value="Nepotisme" id="pel5">
                                            <label class="form-check-label" for="pel5">Nepotisme</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="pelanggaran[]"
                                                value="Gratifikasi / Penyuapan" id="pel6">
                                            <label class="form-check-label" for="pel6">Gratifikasi / Penyuapan</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="pelanggaran[]"
                                                value="Benturan / Konflik Kepentingan" id="pel7">
                                            <label class="form-check-label" for="pel7">Benturan / Konflik
                                                Kepentingan</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="pelanggaran[]"
                                                value="Kecurangan / Fraud" id="pel8">
                                            <label class="form-check-label" for="pel8">Kecurangan / Fraud</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kotak 3 -->
                        <div class="card mb-3 shadow-sm border-warning">
                            <div class="card-body">
                                <h6 class="card-title mb-3 text-warning">Pelanggaran Kejujuran & Kriminal</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="pelanggaran[]"
                                                value="Penipuan" id="pel9">
                                            <label class="form-check-label" for="pel9">Penipuan</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="pelanggaran[]"
                                                value="Pencurian" id="pel10">
                                            <label class="form-check-label" for="pel10">Pencurian</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="pelanggaran[]"
                                                value="Pemerasan / Pungutan liar" id="pel11">
                                            <label class="form-check-label" for="pel11">Pemerasan / Pungutan
                                                liar</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="pelanggaran[]"
                                                value="Pemalsuan data atau dokumen" id="pel12">
                                            <label class="form-check-label" for="pel12">Pemalsuan data atau
                                                dokumen</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kotak 4 -->
                        <div class="card mb-3 shadow-sm border-danger">
                            <div class="card-body">
                                <h6 class="card-title mb-3 text-danger">Pelanggaran Moral & Sosial</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="pelanggaran[]"
                                        value="Pelecehan seksual" id="pel13">
                                    <label class="form-check-label" for="pel13">Pelecehan seksual</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="pelanggaran[]"
                                        value="Perundungan" id="pel14">
                                    <label class="form-check-label" for="pel14">Perundungan</label>
                                </div>
                            </div>
                        </div>

                        <!-- Kotak 5 -->
                        <div class="card mb-3 shadow-sm border-info">
                            <div class="card-body">
                                <h6 class="card-title mb-3 text-info">Permohonan atau Lainnya</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="pelanggaran[]"
                                        value="Permohonan" id="pel15">
                                    <label class="form-check-label" for="pel15">Permohonan</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="pel16" name="pelanggaran[]"
                                        value="Lainnya" onchange="togglePelanggaranLain()">
                                    <label class="form-check-label" for="pel16">Lainnya</label>
                                </div>

                                <div class="form-group mt-2 d-none" id="pelanggaran_lain">
                                    <label for="inputPelanggaranLain">Pelanggaran Lainnya:</label>
                                    <input type="text" name="pelanggaran_lain" id="inputPelanggaranLain"
                                        class="form-control" placeholder="Tuliskan pelanggaran lainnya...">
                                </div>



                            </div>
                        </div>
                    </div>




                    <div class="row">
                        <h6 class="card-title mb-3">Bagaimana kami dapat menghubungi Anda?</h6>
                        <p class="text-muted mb-3">Pilih salah satu atau lebih metode komunikasi yang Anda inginkan,
                            lalu isi informasinya.</p>
                        <div class="col-md-4">

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="hubEmail"
                                    onchange="toggleHubungiField()">
                                <label class="form-check-label" for="hubEmail">Email</label>
                            </div>
                            <input type="email" id="inputEmail" name="email" class="form-control mt-2 d-none"
                                placeholder="Masukkan alamat email Anda...">
                        </div>

                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="hubTelepon"
                                    onchange="toggleHubungiField()">
                                <label class="form-check-label" for="hubTelepon">Telepon / Handphone</label>
                            </div>
                            <input type="text" id="inputTelepon" name="telepon" class="form-control mt-2 d-none"
                                placeholder="Masukkan nomor telepon Anda...">
                        </div>

                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="hubWhatsApp"
                                    onchange="toggleHubungiField()">
                                <label class="form-check-label" for="hubWhatsApp">WhatsApp</label>
                            </div>
                            <input type="text" id="inputWhatsApp" name="whatsapp" class="form-control mt-2 d-none"
                                placeholder="Masukkan nomor WhatsApp Anda...">
                        </div>
                    </div>

                    <script>
                        function toggleHubungiField() {
                            const emailCheck = document.getElementById('hubEmail');
                            const telpCheck = document.getElementById('hubTelepon');
                            const waCheck = document.getElementById('hubWhatsApp');

                            const emailInput = document.getElementById('inputEmail');
                            const telpInput = document.getElementById('inputTelepon');
                            const waInput = document.getElementById('inputWhatsApp');

                            // Email
                            if (emailCheck.checked) {
                                emailInput.classList.remove('d-none');
                                emailInput.setAttribute('required', true);
                            } else {
                                emailInput.classList.add('d-none');
                                emailInput.removeAttribute('required');
                                emailInput.value = '';
                            }

                            // Telepon
                            if (telpCheck.checked) {
                                telpInput.classList.remove('d-none');
                                telpInput.setAttribute('required', true);
                            } else {
                                telpInput.classList.add('d-none');
                                telpInput.removeAttribute('required');
                                telpInput.value = '';
                            }

                            // WhatsApp
                            if (waCheck.checked) {
                                waInput.classList.remove('d-none');
                                waInput.setAttribute('required', true);
                            } else {
                                waInput.classList.add('d-none');
                                waInput.removeAttribute('required');
                                waInput.value = '';
                            }
                        }
                    </script>


                    <p></p>

                    <!-- Bagian 4: Tempat & Perkiraan Waktu Kejadian -->
                    <h5 class="mb-3">Tempat & Perkiraan Waktu Kejadian</h5>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <label for="tanggal_kejadian" class="form-label">Tanggal Kejadian <span
                                    class="text-danger">*</span></label>
                            <input type="date" id="tanggal_kejadian" name="tanggal_kejadian" class="form-control"
                                required>
                        </div>
                        <div class="col-md-4">
                            <label for="jam_kejadian" class="form-label">Waktu / Jam Kejadian <span
                                    class="text-danger">*</span></label>
                            <input type="time" id="jam_kejadian" name="jam_kejadian" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="tempat_kejadian" class="form-label">Tempat Kejadian <span
                                    class="text-danger">*</span></label>
                            <select id="tempat_kejadian" name="tempat_kejadian" class="form-select" required>
                                <option value="" disabled selected>Pilih tempat kejadian...</option>
                                <option>Gedung A3</option>
                                <option>GOR</option>
                                <option>Gedung TI</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                            <input type="text" id="tempat_lain" name="tempat_lain" class="form-control mt-2 d-none"
                                placeholder="Sebutkan tempat lain...">
                        </div>
                    </div>

                    <p class="text-muted small mt-3"><span class="text-danger">*</span> Wajib diisi</p>

                    <div class="d-flex justify-content-end mt-4 gap-2">
                        <button type="reset" class="btn btn-outline-secondary"><i class="bi bi-x-circle me-1"></i>
                            Reset</button>
                        <button type="button" class="btn btn-primary" onclick="goToStep2()">Lanjut ➡️</button>
                    </div>
                </div>

                <!-- STEP 2 -->
                <div id="step2" class="d-none">
                    <h5 class="mb-3">Data Terlapor</h5>
                    <table class="table table-bordered" id="tableTerlapor">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Satuan Kerja</th>
                                <th>Jabatan</th>
                                <th>Jenis Kelamin</th>
                                <th style="width: 100px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <button type="button" class="btn btn-outline-success mb-3" onclick="addRow()">
                        <i class="bi bi-person-plus"></i> Tambah Pihak yang Dilaporkan
                    </button>

                    <!-- Tambahan: Pernyataan & Informasi Pihak Terkait -->
                    <div class="mt-4">
                        <h5 class="mb-3">Pernyataan dan Informasi Pihak Terkait</h5>

                        <!-- Identitas Diketahui -->
                        <label class="form-label d-block">Apakah untuk pengaduan ini, identitas Anda ingin diketahui
                            terlapor?
                            <span class="text-danger">*</span>
                        </label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="identitas_diketahui" id="identitas_ya"
                                value="Ya" required>
                            <label class="form-check-label" for="identitas_ya">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="identitas_diketahui" id="identitas_tidak"
                                value="Tidak" required>
                            <label class="form-check-label" for="identitas_tidak">Tidak</label>
                        </div>

                        <!-- Pihak Terkait -->
                        <div class="mt-3">
                            <label for="pihak_terkait" class="form-label">Sebutkan jika ada pihak terkait yang memiliki
                                informasi pendukung laporan pengaduan Anda, beserta informasi kontak yang
                                bersangkutan</label>
                            <textarea id="pihak_terkait" name="pihak_terkait" class="form-control" rows="3"
                                placeholder="Contoh: Nama pihak, jabatan, nomor kontak..."></textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-outline-secondary" onclick="backToStep1()">⬅️
                            Kembali</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-send-fill me-1"></i>
                            Kirim</button>
                    </div>
                </div>


            </form>
        </div>
    </div>

    <script>
        function goToStep2() {
            const step1 = document.querySelector('#step1');
            const requiredFields = step1.querySelectorAll('[required]');
            let valid = true;

            requiredFields.forEach(field => {
                if (!field.value) {
                    field.classList.add('is-invalid');
                    valid = false;
                } else {
                    field.classList.remove('is-invalid');
                }
            });

            if (!valid) {
                alert("Harap lengkapi semua field yang wajib diisi sebelum lanjut.");
                return;
            }

            document.getElementById('step1').classList.add('d-none');
            document.getElementById('step2').classList.remove('d-none');
        }

        function backToStep1() {
            document.getElementById('step2').classList.add('d-none');
            document.getElementById('step1').classList.remove('d-none');
        }

        function addRow() {
            const table = document.querySelector("#tableTerlapor tbody");
            const rowCount = table.rows.length + 1;

            const row = table.insertRow();
            row.innerHTML = `
        <td>${rowCount}</td>
        <td><input type="text" name="terlapor[${rowCount}][nama]" class="form-control" required></td>
        <td><input type="text" name="terlapor[${rowCount}][nip]" class="form-control" required></td>
        <td>
            <select name="terlapor[${rowCount}][satuan_kerja]" class="form-select" required>
                <option value="" disabled selected>Pilih...</option>
                <option>Balikpapan</option>
                <option>Jember</option>
                <option>Surabaya</option>
                <option>Samarinda</option>
            </select>
        </td>
        <td>
            <select name="terlapor[${rowCount}][jabatan]" class="form-select" required>
                <option value="" disabled selected>Pilih...</option>
                <option>Hakim</option>
                <option>Hakim Agung</option>
                <option>Sekretaris</option>
            </select>
        </td>
        <td>
            <select name="terlapor[${rowCount}][jenis_kelamin]" class="form-select" required>
                <option value="" disabled selected>Pilih...</option>
                <option>Laki-laki</option>
                <option>Perempuan</option>
                <option>Tidak diketahui</option>
            </select>
        </td>
        <td>
            <button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">
                <i class="bi bi-trash"></i>
            </button>
        </td>
    `;
        }


        function removeRow(button) {
            const row = button.closest("tr");
            row.remove();
            const rows = document.querySelectorAll("#tableTerlapor tbody tr");
            rows.forEach((r, i) => {
                r.cells[0].innerText = i + 1;
            });
        }

        // toggle tambahan
        function togglePekerjaanLain() {
            const pekerjaan = document.getElementById('pekerjaan').value;
            document.getElementById('pekerjaan_lain').classList.toggle('d-none', pekerjaan !== 'lainnya');
        }

        function toggleWaktuLain() {
            const waktu = document.getElementById('waktu_hubung').value;
            document.getElementById('waktu_lain').classList.toggle('d-none', waktu !== 'lainnya');
        }

        function togglePelanggaranLain() {
            const pelanggaran = document.getElementById('pel16').checked;
            document.getElementById('pelanggaran_lain').classList.toggle('d-none', !pelanggaran);
        }


        document.getElementById('tempat_kejadian').addEventListener('change', function () {
            document.getElementById('tempat_lain').classList.toggle('d-none', this.value !== 'lainnya');
        });
    </script>


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