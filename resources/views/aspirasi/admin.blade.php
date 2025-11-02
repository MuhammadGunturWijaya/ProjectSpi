<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kelola Aspirasi</title>
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

        .admin-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 24px;
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 0 10px 40px rgba(102, 126, 234, 0.3);
        }

        .admin-header h2 {
            color: white;
            font-size: 2.2rem;
            font-weight: 700;
            margin: 0 0 10px 0;
        }

        .admin-header p {
            color: rgba(255, 255, 255, 0.95);
            margin: 0;
            font-size: 1.1rem;
        }

        /* Filter Notification Styles */
        .filter-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 350px;
            max-width: 450px;
            background: white;
            border-radius: 16px;
            padding: 20px 25px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            transform: translateX(500px);
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            border-left: 5px solid #667eea;
        }

        .filter-notification.show {
            transform: translateX(0);
            opacity: 1;
        }

        .filter-notification-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .filter-notification-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            color: #2d3748;
            font-size: 1.1rem;
        }

        .filter-notification-title i {
            font-size: 1.3rem;
            color: #667eea;
        }

        .filter-notification-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #718096;
            cursor: pointer;
            transition: all 0.3s ease;
            padding: 0;
            line-height: 1;
        }

        .filter-notification-close:hover {
            color: #2d3748;
            transform: rotate(90deg);
        }

        .filter-notification-body {
            color: #4a5568;
        }

        .filter-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .filter-item:last-child {
            border-bottom: none;
        }

        .filter-item-icon {
            width: 30px;
            height: 30px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.85rem;
        }

        .filter-item-content {
            flex: 1;
        }

        .filter-item-label {
            font-size: 0.75rem;
            color: #718096;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .filter-item-value {
            font-size: 0.95rem;
            color: #2d3748;
            font-weight: 600;
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
            border-left: 4px solid;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .stat-card.total {
            border-color: #667eea;
        }

        .stat-card.agama {
            border-color: #f59e0b;
        }

        .stat-card.kesehatan {
            border-color: #3b82f6;
        }

        .stat-card.keuangan {
            border-color: #10b981;
        }

        .stat-card.pendidikan {
            border-color: #6366f1;
        }

        .stat-card.infrastruktur {
            border-color: #ec4899;
        }

        .stat-card.lainnya {
            border-color: #6b7280;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        .stat-card.total .stat-icon {
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
        }

        .stat-card.agama .stat-icon {
            background: rgba(245, 158, 11, 0.1);
            color: #f59e0b;
        }

        .stat-card.kesehatan .stat-icon {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }

        .stat-card.keuangan .stat-icon {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }

        .stat-card.pendidikan .stat-icon {
            background: rgba(99, 102, 241, 0.1);
            color: #6366f1;
        }

        .stat-card.infrastruktur .stat-icon {
            background: rgba(236, 72, 153, 0.1);
            color: #ec4899;
        }

        .stat-card.lainnya .stat-icon {
            background: rgba(107, 114, 128, 0.1);
            color: #6b7280;
        }

        .stat-label {
            color: #718096;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .stat-value {
            color: #2d3748;
            font-size: 2rem;
            font-weight: 700;
        }

        .filter-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
        }

        .filter-title {
            color: #2d3748;
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-control,
        .form-select {
            background: #f8f9fa;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 12px 16px;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            background: white;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .btn-filter {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-filter:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-reset {
            background: #fee2e2;
            color: #dc2626;
            border: 2px solid #fecaca;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-reset:hover {
            background: #fecaca;
            color: #b91c1c;
            border-color: #fca5a5;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.2);
        }

        .table-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
        }

        .table-header {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 20px 25px;
            border-bottom: 2px solid #e2e8f0;
        }

        .table-header h5 {
            color: #2d3748;
            font-weight: 700;
            margin: 0;
        }

        .table {
            margin: 0;
        }

        .table thead {
            background: #f8f9fa;
        }

        .table thead th {
            color: #4a5568;
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 15px;
            border: none;
        }

        .table tbody td {
            padding: 18px 15px;
            vertical-align: middle;
            color: #4a5568;
        }

        .table tbody tr {
            border-bottom: 1px solid #e2e8f0;
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background: #f8f9fa;
        }

        .kategori-badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: capitalize;
            display: inline-block;
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

        .btn-action {
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .btn-view {
            background: #dbeafe;
            color: #1e40af;
        }

        .btn-view:hover {
            background: #3b82f6;
            color: white;
        }

        .btn-delete-small {
            background: #fee;
            color: #c53030;
        }

        .btn-delete-small:hover {
            background: #fc8181;
            color: white;
        }

        .btn-back {
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px 30px;
            font-weight: 600;
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

        .empty-state {
            text-align: center;
            padding: 60px 20px;
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
        }

        .judul-aspirasi {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 5px;
        }

        .pelapor-info {
            font-size: 0.85rem;
            color: #718096;
        }

        .lampiran-icon {
            color: #667eea;
            font-size: 1.1rem;
        }

        @media (max-width: 768px) {
            .admin-container {
                padding: 30px 0 50px;
            }

            .admin-header {
                padding: 30px 20px;
            }

            .admin-header h2 {
                font-size: 1.6rem;
            }

            .stats-container {
                grid-template-columns: repeat(2, 1fr);
            }

            .table-card {
                overflow-x: auto;
            }

            .table {
                min-width: 800px;
            }

            .filter-notification {
                min-width: 300px;
                max-width: calc(100vw - 40px);
                right: 10px;
                top: 10px;
            }
        }

        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
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

    <!-- Filter Notification -->
    <div id="filterNotification" class="filter-notification">
        <div class="filter-notification-header">
            <div class="filter-notification-title">
                <i class="bi bi-funnel-fill"></i>
                <span>Filter Aktif</span>
            </div>
            <button class="filter-notification-close" onclick="closeFilterNotification()">
                <i class="bi bi-x"></i>
            </button>
        </div>
        <div class="filter-notification-body" id="filterNotificationBody">
            <!-- Filter items will be inserted here -->
        </div>
    </div>

    @include('layouts.navbar')

    <div class="admin-container">
        <div class="container-fluid px-4">
            <!-- Header -->
            <div class="admin-header">
                <h2><i class="bi bi-shield-check me-3"></i>Panel Admin - Kelola Aspirasi</h2>
                <p>Pantau dan kelola semua aspirasi yang masuk dari masyarakat</p>
            </div>

            @if(session('success'))
                <div class="alert-custom">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                </div>
            @endif

            <!-- Statistics -->
            <div class="stats-container">
                <div class="stat-card total">
                    <div class="stat-icon">
                        <i class="bi bi-file-text"></i>
                    </div>
                    <div class="stat-label">Total Aspirasi</div>
                    <div class="stat-value">{{ $stats['total'] }}</div>
                </div>
            </div>

            <!-- Filter -->
            <div class="filter-card">
                <h5 class="filter-title mb-3">
                    <i class="bi bi-funnel"></i>
                    Filter & Pencarian
                </h5>

                <form action="{{ route('aspirasi.admin') }}" method="GET">
                    <div class="row align-items-end g-3">
                        <div class="col-md-3">
                            <label for="search" class="form-label fw-semibold">Judul</label>
                            <input type="text" name="search" id="search" class="form-control"
                                placeholder="Cari judul, pelapor, instansi..." value="{{ request('search') }}">
                        </div>

                        <div class="col-md-2">
                            <label for="kategori" class="form-label fw-semibold">Kategori</label>
                            <select name="kategori" id="kategori" class="form-select">
                                <option value="">Semua</option>
                                <option value="agama" {{ request('kategori') == 'agama' ? 'selected' : '' }}>Agama
                                </option>
                                <option value="kesehatan" {{ request('kategori') == 'kesehatan' ? 'selected' : '' }}>
                                    Kesehatan</option>
                                <option value="keuangan" {{ request('kategori') == 'keuangan' ? 'selected' : '' }}>
                                    Keuangan</option>
                                <option value="pendidikan" {{ request('kategori') == 'pendidikan' ? 'selected' : '' }}>
                                    Pendidikan</option>
                                <option value="infrastruktur" {{ request('kategori') == 'infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                                <option value="lainnya" {{ request('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya
                                </option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label for="tanggal_dari" class="form-label fw-semibold">Dari</label>
                            <input type="date" id="tanggal_dari" name="tanggal_dari" class="form-control"
                                value="{{ request('tanggal_dari') }}">
                        </div>

                        <div class="col-md-2">
                            <label for="tanggal_sampai" class="form-label fw-semibold">Sampai</label>
                            <input type="date" id="tanggal_sampai" name="tanggal_sampai" class="form-control"
                                value="{{ request('tanggal_sampai') }}">
                        </div>

                        <div class="col-md-1">
                            <button type="submit" class="btn btn-filter w-100" title="Terapkan Filter">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>

                        <div class="col-md-2">
                            <a href="{{ route('aspirasi.admin') }}" class="btn btn-filter w-100"
                                title="Reset Semua Filter">
                                <i class="bi bi-arrow-clockwise me-2"></i>Reset Filter
                            </a>
                        </div>
                    </div>
                </form>
            </div>


            <!-- Table -->
            <div class="table-card">
                <div class="table-header">
                    <h5><i class="bi bi-table me-2"></i>Daftar Aspirasi ({{ $aspirasis->total() }} data)</h5>
                </div>

                @if($aspirasis->count() > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th style="width: 25%">Judul & Pelapor</th>
                                    <th style="width: 15%">Kategori</th>
                                    <th style="width: 12%">Tanggal</th>
                                    <th style="width: 30%">Keterangan</th>
                                    <th style="width: 5%">File</th>
                                    <th style="width: 8%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($aspirasis as $index => $aspirasi)
                                    <tr>
                                        <td class="text-center">{{ $aspirasis->firstItem() + $index }}</td>
                                        <td>
                                            <div class="judul-aspirasi">{{ Str::limit($aspirasi->judul, 50) }}</div>
                                            <div class="pelapor-info">
                                                <i class="bi bi-person"></i> {{ $aspirasi->asal_pelapor }}<br>
                                                <i class="bi bi-building"></i> {{ $aspirasi->instansi }}
                                            </div>
                                        </td>
                                        <td>
                                            <span class="kategori-badge kategori-{{ $aspirasi->kategori }}">
                                                {{ $aspirasi->kategori_lengkap }}
                                            </span>
                                        </td>
                                        <td>{{ $aspirasi->tanggal->format('d M Y') }}</td>
                                        <td>{{ Str::limit($aspirasi->keterangan, 80) }}</td>
                                        <td class="text-center">
                                            @if($aspirasi->lampiran)
                                                <a href="{{ asset('storage/' . $aspirasi->lampiran) }}" target="_blank"
                                                    class="lampiran-icon" title="Lihat Lampiran">
                                                    <i class="bi bi-paperclip"></i>
                                                </a>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <a href="{{ route('aspirasi.admin.show', $aspirasi->id) }}"
                                                    class="btn-action btn-view" title="Lihat Detail">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <form action="{{ route('aspirasi.destroy', $aspirasi->id) }}" method="POST"
                                                    class="form-delete" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn-action btn-delete-small btn-confirm-delete"
                                                        title="Hapus">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                                <script>
                                                    document.addEventListener('DOMContentLoaded', function () {
                                                        const deleteForms = document.querySelectorAll('.form-delete');

                                                        deleteForms.forEach(form => {
                                                            form.querySelector('.btn-confirm-delete').addEventListener('click', function (e) {
                                                                e.preventDefault();

                                                                Swal.fire({
                                                                    title: 'Apakah kamu yakin?',
                                                                    text: "Data aspirasi ini akan dihapus secara permanen!",
                                                                    icon: 'warning',
                                                                    showCancelButton: true,
                                                                    confirmButtonColor: '#d33',
                                                                    cancelButtonColor: '#3085d6',
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
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="p-4">
                        {{ $aspirasis->links() }}
                    </div>
                @else
                    <div class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <h4>Tidak Ada Data</h4>
                        <p>Belum ada aspirasi yang sesuai dengan filter</p>
                    </div>
                @endif
            </div>

            <!-- Back Button -->
            <div class="mt-4">
                <a href="{{ url()->previous() }}" class="btn-back">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>

    @include('layouts.NavbarBawah')

    <script>
        // Show filter notification when page loads with filters
        document.addEventListener('DOMContentLoaded', function () {
            const urlParams = new URLSearchParams(window.location.search);
            const hasFilters = urlParams.get('search') || urlParams.get('kategori') ||
                urlParams.get('tanggal_dari') || urlParams.get('tanggal_sampai');

            if (hasFilters) {
                showFilterNotification();
            }
        });

        function showFilterNotification() {
            const notification = document.getElementById('filterNotification');
            const body = document.getElementById('filterNotificationBody');
            const urlParams = new URLSearchParams(window.location.search);

            let filterItems = [];

            // Search filter
            if (urlParams.get('search')) {
                filterItems.push({
                    icon: 'bi-search',
                    label: 'Pencarian',
                    value: urlParams.get('search')
                });
            }

            // Category filter
            if (urlParams.get('kategori')) {
                const kategoriMap = {
                    'agama': 'Agama',
                    'kesehatan': 'Kesehatan',
                    'keuangan': 'Keuangan',
                    'pendidikan': 'Pendidikan',
                    'infrastruktur': 'Infrastruktur',
                    'lainnya': 'Lainnya'
                };
                filterItems.push({
                    icon: 'bi-tag',
                    label: 'Kategori',
                    value: kategoriMap[urlParams.get('kategori')] || urlParams.get('kategori')
                });
            }

            // Date range filter
            if (urlParams.get('tanggal_dari') && urlParams.get('tanggal_sampai')) {
                filterItems.push({
                    icon: 'bi-calendar-range',
                    label: 'Periode',
                    value: formatDate(urlParams.get('tanggal_dari')) + ' - ' + formatDate(urlParams.get('tanggal_sampai'))
                });
            } else if (urlParams.get('tanggal_sampai')) {
                filterItems.push({
                    icon: 'bi-calendar-x',
                    label: 'Sampai Tanggal',
                    value: formatDate(urlParams.get('tanggal_sampai'))
                });
            }

            // Build notification content
            let content = '';
            filterItems.forEach(item => {
                content += `
                    <div class="filter-item">
                        <div class="filter-item-icon">
                            <i class="bi ${item.icon}"></i>
                        </div>
                        <div class="filter-item-content">
                            <div class="filter-item-label">${item.label}</div>
                            <div class="filter-item-value">${item.value}</div>
                        </div>
                    </div>
                `;
            });

            body.innerHTML = content;

            // Show notification
            setTimeout(() => {
                notification.classList.add('show');
            }, 300);

            // Auto hide after 5 seconds
            setTimeout(() => {
                closeFilterNotification();
            }, 5000);
        }

        function closeFilterNotification() {
            const notification = document.getElementById('filterNotification');
            notification.classList.remove('show');
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            return date.getDate() + ' ' + months[date.getMonth()] + ' ' + date.getFullYear();
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
</body>
</html>