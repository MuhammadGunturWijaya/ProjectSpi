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

    {{-- Icon Notifikasi di Navbar --}}
    @php
        $needsCorrection = $userLaporans->where('rejected_at', '!=', null);
        $needsResponse = $userLaporans->where('status', 'tanggapan_pelapor')->where('rejected_at', null);
        $totalNotif = $needsCorrection->count() + $needsResponse->count();
    @endphp

    @if($totalNotif > 0)
        <style>
            .notif-badge {
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 1060;
                cursor: pointer;
                transition: transform 0.3s ease;
            }

            .notif-badge:hover {
                transform: scale(1.1);
            }

            .notif-icon {
                position: relative;
                background: white;
                border-radius: 50%;
                width: 60px;
                height: 60px;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 4px 15px rgba(220, 53, 69, 0.4);
                animation: pulse-red 2s infinite;
            }

            @keyframes pulse-red {

                0%,
                100% {
                    box-shadow: 0 4px 15px rgba(220, 53, 69, 0.4);
                }

                50% {
                    box-shadow: 0 4px 25px rgba(220, 53, 69, 0.8);
                }
            }

            .notif-count {
                position: absolute;
                top: -5px;
                right: -5px;
                background: #dc3545;
                color: white;
                border-radius: 50%;
                width: 24px;
                height: 24px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 12px;
                font-weight: bold;
                animation: blink 1.5s infinite;
            }

            @keyframes blink {

                0%,
                100% {
                    opacity: 1;
                }

                50% {
                    opacity: 0.3;
                }
            }

            .notif-dropdown {
                position: fixed;
                top: 90px;
                right: 20px;
                width: 400px;
                max-height: 500px;
                overflow-y: auto;
                background: white;
                border-radius: 15px;
                box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
                display: none;
                z-index: 1055;
            }

            .notif-dropdown.show {
                display: block;
                animation: slideDown 0.3s ease;
            }

            @keyframes slideDown {
                from {
                    opacity: 0;
                    transform: translateY(-20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @media (max-width: 768px) {
                .notif-badge {
                    top: 10px;
                    right: 10px;
                }

                .notif-icon {
                    width: 50px;
                    height: 50px;
                }

                .notif-dropdown {
                    top: 70px;
                    right: 10px;
                    left: 10px;
                    width: auto;
                }
            }
        </style>

        {{-- Notifikasi Badge --}}
        <div class="notif-badge" onclick="toggleNotifDropdown()">
            <div class="notif-icon">
                <i class="bi bi-bell-fill text-danger fs-3"></i>
                <span class="notif-count">{{ $totalNotif }}</span>
            </div>
        </div>

        {{-- Dropdown Notifikasi --}}
        <div class="notif-dropdown" id="notifDropdown">
            <div class="p-3 border-bottom bg-danger text-white rounded-top">
                <h6 class="mb-0 fw-bold">
                    <i class="bi bi-bell-fill me-2"></i>Notifikasi ({{ $totalNotif }})
                </h6>
            </div>

            <div class="p-3">
                {{-- Notifikasi Perlu Perbaikan --}}
                @if($needsCorrection->count() > 0)
                    <div class="mb-3">
                        <h6 class="text-warning fw-bold mb-2">
                            <i class="bi bi-exclamation-triangle-fill"></i> Perlu Diperbaiki ({{ $needsCorrection->count() }})
                        </h6>
                        @foreach($needsCorrection as $laporan)
                            <div class="card mb-2 border-warning">
                                <div class="card-body p-3">
                                    <h6 class="mb-1 fw-bold">{{ $laporan->perihal }}</h6>
                                    <small class="text-muted d-block mb-2">
                                        <i class="bi bi-clock"></i> {{ $laporan->rejected_at->format('d M Y, H:i') }}
                                    </small>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('pengaduan.feedback', $laporan->id) }}"
                                            class="btn btn-sm btn-warning flex-fill">
                                            <i class="bi bi-chat-left-text"></i> Feedback
                                        </a>
                                        <a href="{{ route('pengaduan.edit', $laporan->id) }}"
                                            class="btn btn-sm btn-primary flex-fill">
                                            <i class="bi bi-pencil-square"></i> Perbaiki
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Notifikasi Ada Tanggapan --}}
                @if($needsResponse->count() > 0)
                    <div class="mb-3">
                        <h6 class="text-info fw-bold mb-2">
                            <i class="bi bi-chat-dots-fill"></i> Ada Tanggapan ({{ $needsResponse->count() }})
                        </h6>
                        @foreach($needsResponse as $laporan)
                            <div class="card mb-2 border-info">
                                <div class="card-body p-3">
                                    <h6 class="mb-1 fw-bold">{{ $laporan->perihal }}</h6>
                                    <small class="text-muted d-block mb-2">
                                        <i class="bi bi-clock"></i>
                                        {{ $laporan->tanggapan_admin_at ? \Carbon\Carbon::parse($laporan->tanggapan_admin_at)->format('d M Y, H:i') : '-' }}
                                    </small>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('pengaduan.tanggapan', $laporan->id) }}"
                                            class="btn btn-sm btn-info flex-fill">
                                            <i class="bi bi-eye-fill"></i> Lihat
                                        </a>
                                        <button type="button" class="btn btn-sm btn-primary flex-fill" data-bs-toggle="modal"
                                            data-bs-target="#tanggapanModal{{ $laporan->id }}">
                                            <i class="bi bi-chat-right-text-fill"></i> Tanggapi
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <script>
            function toggleNotifDropdown() {
                const dropdown = document.getElementById('notifDropdown');
                dropdown.classList.toggle('show');
            }

            // Tutup dropdown saat klik di luar
            document.addEventListener('click', function (event) {
                const notifBadge = document.querySelector('.notif-badge');
                const notifDropdown = document.getElementById('notifDropdown');

                if (notifBadge && notifDropdown) {
                    if (!notifBadge.contains(event.target) && !notifDropdown.contains(event.target)) {
                        notifDropdown.classList.remove('show');
                    }
                }
            });
        </script>
    @endif


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
                                            <h5 class="mb-1 fw-bolder text-dark">
                                                {{ $laporan->perihal }}
                                                <br>
                                                <small class="text-muted">Kode Aduan: {{ $laporan->kode_aduan }}</small>

                                                @if($laporan->rejected_at)
                                                    <br>
                                                    <small class="text-danger">
                                                        <i class="bi bi-exclamation-circle"></i> Perlu Perbaikan
                                                    </small>
                                                @endif
                                            </h5>

                                            @php
                                                $statusColors = [
                                                    'laporan_dikirim' => 'bg-secondary',
                                                    'diverifikasi' => 'bg-info text-white',
                                                    'tindak_lanjut' => 'bg-warning text-dark',
                                                    'tanggapan_pelapor' => 'bg-primary',
                                                    'selesai' => 'bg-success',
                                                ];
                                                $badgeClass = $statusColors[$laporan->status] ?? 'bg-secondary';
                                            @endphp
                                            <span class="badge {{ $badgeClass }} text-uppercase">
                                                {{ str_replace('_', ' ', $laporan->status) }}
                                            </span>
                                            <div class="mt-2 text-muted">
                                                <i class="bi bi-calendar me-1"></i>
                                                <small>{{ $laporan->tanggal_pengaduan }} |
                                                    {{ $laporan->created_at->format('d M Y, H:i') }}</small>
                                            </div>
                                        </div>

                                        {{-- Tombol Aksi --}}
                                        <div class="d-flex gap-2 flex-wrap">

                                            {{-- Tombol Feedback muncul jika laporan ditolak --}}
                                            @if($laporan->rejected_at)
                                                <a href="{{ route('pengaduan.feedback', $laporan->id) }}"
                                                    class="btn btn-sm btn-warning" title="Lihat Feedback">
                                                    <i class="bi bi-chat-left-text"></i> Feedback
                                                </a>
                                            @endif

                                            {{-- Tombol Lihat Tanggapan muncul hanya jika diverifikasi --}}
                                            @if($laporan->status === 'tanggapan_pelapor')
                                                <a href="{{ route('pengaduan.tanggapan', $laporan->id) }}"
                                                    class="btn btn-sm btn-info" title="Lihat Tanggapan">
                                                    <i class="bi bi-eye-fill"></i> Lihat Tanggapan
                                                </a>
                                            @endif

                                            {{-- Tombol Lihat Detail selalu muncul --}}
                                            <button class="btn btn-sm btn-outline-primary toggle-detail" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#detail-{{ $laporan->id }}"
                                                aria-expanded="false" aria-controls="detail-{{ $laporan->id }}">
                                                <i class="bi bi-chevron-down me-1"></i>
                                                <span class="btn-text">Lihat Detail</span>
                                            </button>

                                            {{-- Tombol Hapus selalu muncul --}}
                                            <form action="{{ route('pengaduan.destroy', $laporan->id) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                                    <i class="bi bi-trash me-1"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
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
                                                        // ✅ PERBAIKAN: Ambil raw value dari database
                                                        $rawPelanggaran = $laporan->getAttributes()['pelanggaran'] ?? null;

                                                        // Debug (hapus setelah testing)
                                                        // dd($rawPelanggaran, gettype($rawPelanggaran));

                                                        $pelanggaranList = [];

                                                        // Cek apakah sudah array (dari accessor/cast)
                                                        if (is_array($laporan->pelanggaran)) {
                                                            $pelanggaranList = $laporan->pelanggaran;
                                                        }
                                                        // Jika masih string JSON, decode manual
                                                        elseif (is_string($rawPelanggaran)) {
                                                            // Bersihkan escape characters berlebihan
                                                            $clean = trim($rawPelanggaran, '"');
                                                            $clean = stripslashes($clean);

                                                            // Decode JSON
                                                            $decoded = json_decode($clean, true);

                                                            // Jika decode gagal, coba decode langsung
                                                            if (!is_array($decoded)) {
                                                                $decoded = json_decode($rawPelanggaran, true);
                                                            }

                                                            $pelanggaranList = is_array($decoded) ? $decoded : [];
                                                        }
                                                    @endphp

                                                    @if(count($pelanggaranList) > 0)
                                                        @foreach($pelanggaranList as $p)
                                                            @if($p !== 'Lainnya')
                                                                <li>{{ $p }}</li>
                                                            @endif
                                                        @endforeach

                                                        {{-- Tampilkan "Lainnya" dengan text custom jika ada --}}
                                                        @if(in_array('Lainnya', $pelanggaranList) && !empty($laporan->pelanggaran_lain))
                                                            <li><strong>Lainnya:</strong> {{ $laporan->pelanggaran_lain }}</li>
                                                        @elseif(in_array('Lainnya', $pelanggaranList))
                                                            <li>Lainnya</li>
                                                        @endif
                                                    @else
                                                        <li class="text-muted">Tidak ada pelanggaran tercatat</li>
                                                    @endif
                                                </ul>
                                            </div>


                                            <div class="mt-3">
                                                <p class="mb-1 text-secondary">Kontak yang bisa dihubungi:</p>

                                                @php
                                                    $rawKontak = $laporan->getAttributes()['kontak'] ?? null;

                                                    if (is_array($laporan->kontak) && count($laporan->kontak) > 0) {
                                                        $kontakArray = $laporan->kontak;
                                                    } elseif (is_string($rawKontak)) {
                                                        // Bersihkan tanda kutip luar dan escape ganda
                                                        $clean = trim($rawKontak, '"');
                                                        $clean = stripslashes($clean);

                                                        // Decode JSON
                                                        $decoded = json_decode($clean, true);

                                                        $kontakArray = is_array($decoded) ? $decoded : [];
                                                    } else {
                                                        $kontakArray = [];
                                                    }
                                                @endphp

                                                @if(count($kontakArray))
                                                    <ul class="mb-0">
                                                        @foreach($kontakArray as $key => $value)
                                                            @if($value)
                                                                <li data-field="kontak_{{ $key }}">
                                                                    @if(is_string($key))
                                                                        <strong>{{ ucfirst($key) }}:</strong>
                                                                    @endif
                                                                    {{ $value }}
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    <p class="text-muted mb-0">Tidak ada kontak tercatat</p>
                                                @endif
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
                                                    $rawTerlapor = $laporan->getAttributes()['terlapor'] ?? null;

                                                    if (is_array($laporan->terlapor) && count($laporan->terlapor) > 0) {
                                                        $terlapors = $laporan->terlapor;
                                                    } elseif (is_string($rawTerlapor)) {
                                                        // Bersihkan tanda kutip luar & escape ganda
                                                        $clean = trim($rawTerlapor, '"');
                                                        $clean = stripslashes($clean);

                                                        // Decode JSON
                                                        $decoded = json_decode($clean, true);
                                                        $terlapors = is_array($decoded) ? $decoded : [];
                                                    } else {
                                                        $terlapors = [];
                                                    }
                                                @endphp

                                                @if(count($terlapors) > 0)
                                                    <table class="table table-bordered table-sm">
                                                        <thead class="table-light">
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

                                                    {{-- File Upload --}}
                                                    @php
                                                        $rawFiles = $laporan->getAttributes()['bukti_file'] ?? null;

                                                        if (is_array($laporan->bukti_file) && count($laporan->bukti_file) > 0) {
                                                            $files = $laporan->bukti_file;
                                                        } elseif (is_string($rawFiles)) {
                                                            $clean = trim($rawFiles, '"');
                                                            $clean = stripslashes($clean);
                                                            $decoded = json_decode($clean, true);
                                                            $files = is_array($decoded) ? $decoded : [];
                                                        } else {
                                                            $files = [];
                                                        }
                                                    @endphp

                                                    @if(count($files))
                                                        @foreach($files as $fIndex => $file)
                                                            <a href="{{ asset('storage/' . $file) }}" target="_blank" class="d-block mb-2"
                                                                data-field="bukti_file_{{ $fIndex }}">
                                                                <i class="bi bi-paperclip"></i> {{ basename($file) }}
                                                            </a>
                                                        @endforeach
                                                    @endif

                                                    {{-- Link Video --}}
                                                    @if($laporan->link_video)
                                                        <a href="{{ $laporan->link_video }}" target="_blank" class="d-block mb-2"
                                                            data-field="link_video">
                                                            <i class="bi bi-play-circle"></i> Video Link
                                                        </a>
                                                    @endif
                                                </div>
                                            @endif

                                            {{-- Status Proses --}}
                                            @php
                                                $steps = [
                                                    'laporan_dikirim' => ['title' => 'Tulis Laporan', 'detail' => 'Laporkan keluhan', 'icon' => 'bi-pencil-square', 'class' => 'step-1', 'color' => '#6c757d'],
                                                    'diverifikasi' => ['title' => 'Verifikasi', 'detail' => 'Diverifikasi & diteruskan', 'icon' => 'bi-arrow-right-circle', 'class' => 'step-2', 'color' => '#0dcaf0'],
                                                    'tindak_lanjut' => ['title' => 'Tindak Lanjut', 'detail' => 'Ditindaklanjuti', 'icon' => 'bi-chat-dots', 'class' => 'step-3', 'color' => '#ffc107'],
                                                    'tanggapan_pelapor' => ['title' => 'Tanggapan Pelapor', 'detail' => 'Beri tanggapan', 'icon' => 'bi-chat-text', 'class' => 'step-4', 'color' => '#0d6efd'],
                                                    'selesai' => ['title' => 'Selesai', 'detail' => 'Selesai ditindaklanjuti', 'icon' => 'bi-check-circle-fill', 'class' => 'step-5', 'color' => '#198754'],
                                                ];
                                                $currentStep = array_search($laporan->status, array_keys($steps));
                                                $totalSteps = count($steps);
                                                $progressWidth = ($totalSteps > 1) ? ($currentStep / ($totalSteps - 1) * 100) : 0;

                                                // Get current step color for progress bar
                                                $currentStepColor = $steps[array_keys($steps)[$currentStep]]['color'] ?? '#0d6efd';
                                            @endphp

                                            <h6 class="fw-bold text-primary mb-4 mt-4 pt-3 border-top">Status Proses</h6>
                                            <div class="position-relative process-row d-flex">
                                                <div
                                                    style="position:absolute; top:32px; left:5%; right:5%; height:4px; background:#dee2e6; border-radius:2px; z-index:0;">
                                                </div>
                                                <div
                                                    style="position:absolute; top:32px; left:5%; height:4px; background:{{ $currentStepColor }}; width:{{ $progressWidth }}%; border-radius:2px; z-index:1; transition:width 0.5s, background 0.5s;">
                                                </div>

                                                @foreach($steps as $key => $step)
                                                    @php
                                                        $stepIndex = array_search($key, array_keys($steps));
                                                        $isActive = $stepIndex <= $currentStep;
                                                        $isCurrent = $stepIndex == $currentStep;
                                                    @endphp
                                                    <div
                                                        class="process-step {{ $step['class'] }} {{ $isActive ? 'active' : '' }} text-center flex-fill position-relative">
                                                        <div class="process-icon-container shadow-sm mb-2"
                                                            style="background: {{ $isActive ? $step['color'] : '#fff' }}; 
                                                                                                                                                                                                                        border: 2px solid {{ $isActive ? $step['color'] : '#dee2e6' }};
                                                                                                                                                                                                                        width: 60px; height: 60px; border-radius: 50%; 
                                                                                                                                                                                                                        display: flex; align-items: center; justify-content: center;
                                                                                                                                                                                                                        margin: 0 auto;
                                                                                                                                                                                                                        transition: all 0.3s ease;">
                                                            <i class="bi {{ $step['icon'] }} fs-4"
                                                                style="color: {{ $isActive ? '#fff' : '#dee2e6' }}; transition: color 0.3s;"></i>
                                                        </div>
                                                        <p class="process-title fw-bolder mb-1"
                                                            style="color: {{ $isActive ? $step['color'] : '#6c757d' }}; transition: color 0.3s;">
                                                            {{ $step['title'] }}
                                                            @if($isCurrent)
                                                                <i class="bi bi-arrow-left-circle-fill ms-1"
                                                                    style="color: {{ $step['color'] }};"></i>
                                                            @endif
                                                        </p>
                                                        <small
                                                            style="color: {{ $isActive ? '#495057' : '#adb5bd' }};">{{ $step['detail'] }}</small>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <div class="mt-4 pt-3 border-top">
                                                <span class="badge fs-6 fw-bold"
                                                    style="background-color: {{ $currentStepColor }}; color: #fff;">
                                                    Status Saat Ini: {{ $steps[array_keys($steps)[$currentStep]]['title'] }}
                                                </span>
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

    <!-- Notifikasi Laporan yang Perlu Dikoreksi -->
    @php
        $needsCorrection = $userLaporans->where('status', 'tanggapan_pelapor')->where('rejected_at', '!=', null);
    @endphp

    @if($needsCorrection->count() > 0)
        <div class="container mt-4">
            <div class="alert alert-warning alert-dismissible fade show shadow-sm" role="alert">
                <div class="d-flex align-items-start">
                    <i class="bi bi-exclamation-triangle-fill fs-3 me-3 text-warning"></i>
                    <div class="flex-grow-1">
                        <h5 class="alert-heading mb-2">
                            <i class="bi bi-bell-fill"></i> Perhatian! Laporan Perlu Diperbaiki
                        </h5>
                        <p class="mb-2">Anda memiliki <strong>{{ $needsCorrection->count() }}</strong> laporan yang
                            dikembalikan oleh admin dan perlu diperbaiki.</p>
                        <hr>
                        @foreach($needsCorrection as $laporan)
                            <div class="mb-3 p-3 bg-white rounded border-start border-warning border-4">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1">
                                            <i class="bi bi-file-earmark-text"></i>
                                            <strong>{{ $laporan->perihal }}</strong>
                                        </h6>
                                        <p class="mb-1 text-muted small">
                                            <i class="bi bi-clock"></i> Dikembalikan:
                                            {{ $laporan->rejected_at->format('d M Y, H:i') }}
                                        </p>
                                        @php
                                            $fieldsToFix = $laporan->fields_to_fix;

                                            // Pastikan fieldsToFix adalah array
                                            if (is_string($fieldsToFix)) {
                                                $decoded = json_decode($fieldsToFix, true);
                                                $fieldsToFix = is_array($decoded) ? $decoded : [];
                                            } elseif (!is_array($fieldsToFix)) {
                                                $fieldsToFix = [];
                                            }
                                        @endphp

                                        @if(count($fieldsToFix))
                                            <p class="mb-0 text-danger small">
                                                <i class="bi bi-x-circle"></i>
                                                <strong>{{ count($fieldsToFix) }} field</strong> perlu diperbaiki
                                            </p>
                                        @endif

                                    </div>
                                    <div class="btn-group-vertical" role="group">
                                        <a href="{{ route('pengaduan.feedback', $laporan->id) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="bi bi-chat-left-text"></i> Lihat Feedback
                                        </a>
                                        <a href="{{ route('pengaduan.edit', $laporan->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil-square"></i> Perbaiki Sekarang
                                        </a>
                                        <!-- Dalam Modal Lihat Laporan -->


                                        @if($laporan->status === 'laporan_dikirim' && !$laporan->rejected_at)
                                            <form action="{{ route('pengaduan.destroy', $laporan->id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <style>
        .alert-warning {
            border-left: 5px solid #ffc107;
            animation: slideInRight 0.5s ease;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .btn-group-vertical .btn {
            margin-bottom: 5px;
            white-space: nowrap;
        }

        .border-start.border-warning.border-4 {
            border-left-width: 4px !important;
        }
    </style>

    <style>
        .table-warning {
            background-color: #fff3cd !important;
        }

        .alert-warning {
            border-left: 4px solid #ffc107;
        }

        .btn-sm {
            padding: 4px 8px;
            font-size: 0.875rem;
        }
    </style>


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



    <!-- Notifikasi Menunggu Tanggapan Pelapor -->
    @php
        $needsResponse = $userLaporans->where('status', 'tanggapan_pelapor');
    @endphp

    @if($needsResponse->count() > 0)
        <div class="container mt-4">
            <div class="alert alert-info alert-dismissible fade show shadow-smposition-relative" role="alert"
                id="notifLaporan">
                <div class="d-flex align-items-start">
                    <i class="bi bi-chat-dots-fill fs-3 me-3 text-info"></i>
                    <div class="flex-grow-1">
                        <h5 class="alert-heading mb-2">
                            <i class="bi bi-bell-fill"></i> Ada Tanggapan untuk Laporan Anda!
                        </h5>
                        <p class="mb-2">Anda memiliki <strong>{{ $needsResponse->count() }}</strong> laporan yang telah
                            mendapat tanggapan dari pihak berwenang.</p>
                        <hr>
                        @foreach($needsResponse as $laporan)
                                    <div class="mb-3 p-3 bg-white rounded border-start border-info border-4">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="mb-1">
                                                    <i class="bi bi-file-earmark-text"></i>
                                                    <strong>{{ $laporan->perihal }}</strong>
                                                </h6>
                                                <p class="mb-1 text-muted small">
                                                    <i class="bi bi-clock"></i> Tanggapan diberikan:
                                                    {{ $laporan->tanggapan_admin_at
                            ? \Carbon\Carbon::parse($laporan->tanggapan_admin_at)->format('d M Y, H:i')
                            : '-' }}
                                                </p>
                                                <p class="mb-0 text-info small">
                                                    <i class="bi bi-person-badge"></i>
                                                    Dari: <strong>{{ $laporan->roleBidang->nama_role ?? 'Pihak Berwenang' }}</strong>
                                                </p>
                                            </div>
                                            <div class="btn-group-vertical" role="group">
                                                <a href="{{ route('pengaduan.tanggapan', $laporan->id) }}" class="btn btn-sm btn-info">
                                                    <i class="bi bi-eye-fill"></i> Lihat Tanggapan
                                                </a>
                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#tanggapanModal{{ $laporan->id }}">
                                                    <i class="bi bi-chat-right-text-fill"></i> Beri Tanggapan
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                        @endforeach
                    </div>
                </div>
                <!-- Progress Bar -->
                <div class="progress position-absolute bottom-0 start-0 w-100" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" id="notifProgress"
                        style="width: 0%; background-color: #0d6efd;"></div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const notif = document.getElementById('notifLaporan');
                const progress = document.getElementById('notifProgress');
                let width = 0;
                const duration = 5000; // 5 detik

                const interval = setInterval(() => {
                    width += 100 / (duration / 50); // update tiap 50ms
                    progress.style.width = width + '%';

                    if (width >= 100) {
                        clearInterval(interval);
                        notif.classList.remove('show');
                        notif.classList.add('hide');
                        setTimeout(() => notif.remove(), 500);
                    }
                }, 50);
            });
        </script>

        <style>
            .border-start.border-info.border-4 {
                border-left-width: 4px !important;
            }

            .btn-group label {
                padding: 12px 20px;
                font-weight: 600;
                transition: all 0.3s;
            }

            .btn-check:checked+.btn-outline-success {
                background-color: #198754;
                border-color: #198754;
            }

            .btn-check:checked+.btn-outline-danger {
                background-color: #dc3545;
                border-color: #dc3545;
            }

            /* Animasi fade out */
            .alert.hide {
                opacity: 0;
                transition: opacity 0.5s;
            }

            /* Progress bar putih */
            #notifProgress {
                transition: width 0.05s linear;
            }
        </style>
    @endif




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
                        <label for="bukti_file" class="form-label">
                            Upload File / Foto (maksimal 5 MB per file)
                            <span class="badge bg-info">Max 10 file</span>
                        </label>
                        <input type="file" id="bukti_file" name="bukti_file[]" class="form-control"
                            accept="image/*,.pdf,.doc,.docx" multiple>
                        <small class="text-muted d-block mt-1">
                            <i class="bi bi-info-circle"></i> Anda dapat mengupload lebih dari satu file (JPG, PNG, PDF,
                            DOC, DOCX)
                        </small>

                        <!-- Preview Container -->
                        <div id="filePreviewContainer" class="mt-3 row g-2"></div>

                        <!-- File Counter -->
                        <div id="fileCounter" class="mt-2 text-muted small"></div>
                    </div>

                    <style>
                        .file-preview-item {
                            position: relative;
                            border: 2px solid #dee2e6;
                            border-radius: 8px;
                            padding: 10px;
                            background: #f8f9fa;
                            transition: all 0.3s;
                        }

                        .file-preview-item:hover {
                            border-color: #0d6efd;
                            box-shadow: 0 2px 8px rgba(13, 110, 253, 0.2);
                        }

                        .file-preview-img {
                            width: 100%;
                            height: 120px;
                            object-fit: cover;
                            border-radius: 6px;
                            margin-bottom: 8px;
                        }

                        .file-preview-doc {
                            width: 100%;
                            height: 120px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                            border-radius: 6px;
                            margin-bottom: 8px;
                        }

                        .file-preview-doc i {
                            font-size: 3rem;
                            color: white;
                        }

                        .file-remove-btn {
                            position: absolute;
                            top: 5px;
                            right: 5px;
                            width: 30px;
                            height: 30px;
                            border-radius: 50%;
                            background: #dc3545;
                            color: white;
                            border: 2px solid white;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            cursor: pointer;
                            transition: all 0.3s;
                            z-index: 10;
                        }

                        .file-remove-btn:hover {
                            background: #bb2d3b;
                            transform: scale(1.1);
                        }

                        .file-name {
                            font-size: 0.85rem;
                            font-weight: 600;
                            color: #495057;
                            white-space: nowrap;
                            overflow: hidden;
                            text-overflow: ellipsis;
                            margin-bottom: 4px;
                        }

                        .file-size {
                            font-size: 0.75rem;
                            color: #6c757d;
                        }

                        .file-size.text-danger {
                            font-weight: bold;
                        }
                    </style>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const fileInput = document.getElementById('bukti_file');
                            const previewContainer = document.getElementById('filePreviewContainer');
                            const fileCounter = document.getElementById('fileCounter');
                            const maxFiles = 10;
                            const maxSizeInBytes = 5 * 1024 * 1024; // 5MB

                            let selectedFiles = [];

                            fileInput.addEventListener('change', function (e) {
                                const files = Array.from(e.target.files);

                                // Validasi jumlah file
                                if (selectedFiles.length + files.length > maxFiles) {
                                    alert(`Maksimal ${maxFiles} file yang dapat diupload!`);
                                    return;
                                }

                                files.forEach(file => {
                                    // Validasi ukuran file
                                    if (file.size > maxSizeInBytes) {
                                        alert(`File "${file.name}" melebihi batas 5MB!`);
                                        return;
                                    }

                                    // Validasi tipe file
                                    const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf',
                                        'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                                    if (!validTypes.includes(file.type)) {
                                        alert(`File "${file.name}" bukan format yang diizinkan!`);
                                        return;
                                    }

                                    selectedFiles.push(file);
                                });

                                updateFileList();
                                updateCounter();
                            });

                            function updateFileList() {
                                previewContainer.innerHTML = '';

                                selectedFiles.forEach((file, index) => {
                                    const col = document.createElement('div');
                                    col.className = 'col-md-3 col-sm-4 col-6';

                                    const previewItem = document.createElement('div');
                                    previewItem.className = 'file-preview-item';

                                    // Remove button
                                    const removeBtn = document.createElement('div');
                                    removeBtn.className = 'file-remove-btn';
                                    removeBtn.innerHTML = '<i class="bi bi-x"></i>';
                                    removeBtn.onclick = () => removeFile(index);

                                    // Preview (image or icon)
                                    let previewContent = '';
                                    if (file.type.startsWith('image/')) {
                                        const reader = new FileReader();
                                        reader.onload = function (e) {
                                            const img = previewItem.querySelector('.file-preview-img');
                                            if (img) img.src = e.target.result;
                                        };
                                        reader.readAsDataURL(file);
                                        previewContent = '<img src="" class="file-preview-img" alt="Preview">';
                                    } else {
                                        let iconClass = 'bi-file-earmark';
                                        if (file.type.includes('pdf')) iconClass = 'bi-file-pdf-fill';
                                        else if (file.type.includes('word')) iconClass = 'bi-file-word-fill';

                                        previewContent = `<div class="file-preview-doc"><i class="bi ${iconClass}"></i></div>`;
                                    }

                                    // File info
                                    const fileName = document.createElement('div');
                                    fileName.className = 'file-name';
                                    fileName.textContent = file.name;
                                    fileName.title = file.name;

                                    const fileSize = document.createElement('div');
                                    fileSize.className = 'file-size';
                                    const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
                                    fileSize.innerHTML = `<i class="bi bi-hdd"></i> ${sizeInMB} MB`;

                                    if (file.size > maxSizeInBytes) {
                                        fileSize.classList.add('text-danger');
                                        fileSize.innerHTML += ' <i class="bi bi-exclamation-triangle-fill"></i>';
                                    }

                                    previewItem.innerHTML = previewContent;
                                    previewItem.appendChild(removeBtn);
                                    previewItem.appendChild(fileName);
                                    previewItem.appendChild(fileSize);

                                    col.appendChild(previewItem);
                                    previewContainer.appendChild(col);
                                });

                                // Update actual input files
                                updateInputFiles();
                            }

                            function updateInputFiles() {
                                const dataTransfer = new DataTransfer();
                                selectedFiles.forEach(file => {
                                    dataTransfer.items.add(file);
                                });
                                fileInput.files = dataTransfer.files;
                            }

                            function removeFile(index) {
                                selectedFiles.splice(index, 1);
                                updateFileList();
                                updateCounter();
                            }

                            function updateCounter() {
                                if (selectedFiles.length === 0) {
                                    fileCounter.innerHTML = '';
                                } else {
                                    const totalSize = selectedFiles.reduce((sum, file) => sum + file.size, 0);
                                    const totalSizeInMB = (totalSize / (1024 * 1024)).toFixed(2);

                                    fileCounter.innerHTML = `
                <i class="bi bi-files"></i> ${selectedFiles.length}/${maxFiles} file terpilih 
                | <i class="bi bi-hdd"></i> Total: ${totalSizeInMB} MB
            `;
                                }
                            }
                        });
                    </script>

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
                                <th>Unit</th>
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

    <!-- Tambahkan kode ini SEBELUM tag penutup </body> di file Blade Anda -->

    <!-- Modal untuk setiap laporan yang perlu tanggapan -->
    @if($needsResponse->count() > 0)
        @foreach($needsResponse as $laporan)
            <div class="modal fade" id="tanggapanModal{{ $laporan->id }}" tabindex="-1"
                aria-labelledby="tanggapanModalLabel{{ $laporan->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="tanggapanModalLabel{{ $laporan->id }}">
                                <i class="bi bi-chat-right-text-fill me-2"></i>
                                Beri Tanggapan untuk: {{ $laporan->perihal }}
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <form action="{{ route('pengaduan.tanggapan.store', $laporan->id) }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <!-- Info Laporan -->
                                <div class="alert alert-info">
                                    <h6 class="mb-2"><strong>Info Laporan:</strong></h6>
                                    <p class="mb-1"><strong>Perihal:</strong> {{ $laporan->perihal }}</p>
                                    <p class="mb-1"><strong>Tanggal Pengaduan:</strong> {{ $laporan->tanggal_pengaduan }}</p>
                                    <p class="mb-0"><strong>Status:</strong>
                                        <span
                                            class="badge bg-primary">{{ str_replace('_', ' ', strtoupper($laporan->status)) }}</span>
                                    </p>
                                </div>

                                <!-- Tanggapan dari Admin (jika ada) -->
                                @if($laporan->tanggapan_admin)
                                    <div class="card mb-3 border-info">
                                        <div class="card-header bg-info text-white">
                                            <i class="bi bi-chat-left-quote-fill me-2"></i>
                                            Tanggapan dari {{ $laporan->roleBidang->nama_role ?? 'Pihak Berwenang' }}
                                        </div>
                                        <div class="card-body">
                                            <p class="mb-0">{{ $laporan->tanggapan_admin }}</p>
                                            <small class="text-muted">
                                                <i class="bi bi-clock"></i>
                                                {{ $laporan->tanggapan_admin_at ? \Carbon\Carbon::parse($laporan->tanggapan_admin_at)->format('d M Y, H:i') : '-' }}
                                            </small>
                                        </div>
                                    </div>
                                @endif

                                <!-- Form Tanggapan Pelapor -->
                                <div class="mb-3" id="tanggapanContainer{{ $laporan->id }}">
                                    <label for="tanggapanPelapor{{ $laporan->id }}" class="form-label">
                                        <strong>Tanggapan Anda:</strong> <span class="text-danger"
                                            id="requiredStar{{ $laporan->id }}">*</span>
                                    </label>
                                    <textarea id="tanggapanPelapor{{ $laporan->id }}" name="tanggapan_pelapor"
                                        class="form-control" rows="5"
                                        placeholder="Tuliskan tanggapan Anda terhadap penjelasan dari pihak berwenang..."
                                        required>{{ $laporan->tanggapan_pelapor ?? '' }}</textarea>
                                    <small class="text-muted">
                                        Jelaskan apakah Anda puas dengan tanggapan yang diberikan atau masih ada yang perlu
                                        ditindaklanjuti.
                                    </small>
                                </div>

                                <!-- Status Kepuasan -->
                                <div class="mb-3">
                                    <label class="form-label d-block">
                                        <strong>Apakah Anda puas dengan tanggapan yang diberikan?</strong>
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="btn-group w-100" role="group">
                                        <input type="radio" class="btn-check" name="status_kepuasan" id="puas{{ $laporan->id }}"
                                            value="puas" {{ $laporan->status_kepuasan == 'puas' ? 'checked' : '' }}
                                            onchange="toggleTanggapanField({{ $laporan->id }}, 'puas')" required>
                                        <label class="btn btn-outline-success" for="puas{{ $laporan->id }}">
                                            <i class="bi bi-hand-thumbs-up-fill"></i> Puas
                                        </label>

                                        <input type="radio" class="btn-check" name="status_kepuasan"
                                            id="tidak_puas{{ $laporan->id }}" value="tidak_puas" {{ $laporan->status_kepuasan == 'tidak_puas' ? 'checked' : '' }}
                                            onchange="toggleTanggapanField({{ $laporan->id }}, 'tidak_puas')" required>
                                        <label class="btn btn-outline-danger" for="tidak_puas{{ $laporan->id }}">
                                            <i class="bi bi-hand-thumbs-down-fill"></i> Tidak Puas
                                        </label>
                                    </div>

                                    <!-- Info Status Alert -->
                                    <div id="statusInfo{{ $laporan->id }}" class="alert mt-3" style="display: none;">
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    <i class="bi bi-x-circle me-1"></i> Batal
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-send-fill me-1"></i> Kirim Tanggapan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    <style>
        .btn-group label {
            padding: 12px 20px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-check:checked+.btn-outline-success {
            background-color: #198754;
            border-color: #198754;
            color: white;
        }

        .btn-check:checked+.btn-outline-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            color: white;
        }

        /* Animasi smooth untuk hide/show textarea */
        .slide-up {
            animation: slideUp 0.3s ease-out;
            overflow: hidden;
        }

        .slide-down {
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideUp {
            from {
                max-height: 200px;
                opacity: 1;
            }

            to {
                max-height: 0;
                opacity: 0;
            }
        }

        @keyframes slideDown {
            from {
                max-height: 0;
                opacity: 0;
            }

            to {
                max-height: 200px;
                opacity: 1;
            }
        }
    </style>

    <script>
        function toggleTanggapanField(laporanId, status) {
            const container = document.getElementById('tanggapanContainer' + laporanId);
            const textarea = document.getElementById('tanggapanPelapor' + laporanId);
            const requiredStar = document.getElementById('requiredStar' + laporanId);
            const statusInfo = document.getElementById('statusInfo' + laporanId);

            if (status === 'puas') {
                // Jika puas, sembunyikan textarea dan hapus validasi required
                container.classList.add('slide-up');
                setTimeout(() => {
                    container.style.display = 'none';
                }, 300);

                textarea.removeAttribute('required');
                textarea.value = ''; // Kosongkan value

                // Tampilkan info status SELESAI
                statusInfo.style.display = 'block';
                statusInfo.className = 'alert alert-success mt-3';
                statusInfo.innerHTML = '<i class="bi bi-check-circle-fill me-2"></i><strong>Status laporan akan berubah menjadi SELESAI</strong> ✅';

            } else {
                // Jika tidak puas, tampilkan textarea dan tambahkan validasi required
                container.style.display = 'block';
                container.classList.remove('slide-up');
                container.classList.add('slide-down');

                textarea.setAttribute('required', 'required');

                // Tampilkan info status TINDAK LANJUT
                statusInfo.style.display = 'block';
                statusInfo.className = 'alert alert-warning mt-3';
                statusInfo.innerHTML = '<i class="bi bi-arrow-repeat me-2"></i><strong>Laporan akan dikembalikan ke tahap TINDAK LANJUT</strong> untuk ditinjau ulang oleh pihak berwenang. 🔄';
            }
        }

        // Jalankan saat modal pertama kali dibuka untuk set kondisi awal
        document.addEventListener('DOMContentLoaded', function () {
            // Cek setiap modal yang ada
            @if($needsResponse->count() > 0)
                @foreach($needsResponse as $laporan)
                    (function () {
                        const laporanId = {{ $laporan->id }};
                        const puasRadio = document.getElementById('puas' + laporanId);
                        const tidakPuasRadio = document.getElementById('tidak_puas' + laporanId);

                        // Set kondisi awal berdasarkan data yang ada
                        @if($laporan->status_kepuasan == 'puas')
                            toggleTanggapanField(laporanId, 'puas');
                        @elseif($laporan->status_kepuasan == 'tidak_puas')
                            toggleTanggapanField(laporanId, 'tidak_puas');
                        @endif
                                })();
                @endforeach
            @endif
});
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


    @include('layouts.NavbarBawah')
</body>

</html>