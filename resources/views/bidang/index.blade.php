<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Bidang Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            min-height: 100vh;
            padding: 40px 0;
        }

        .container {
            max-width: 1200px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 40px;
            animation: fadeInDown 0.8s ease;
        }

        .page-header h1 {
            color: white;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 2px 4px 8px rgba(0,0,0,0.2);
        }

        .page-header p {
            color: rgba(255,255,255,0.9);
            font-size: 1.1rem;
        }

        .card-custom {
            background: white;
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
            margin-bottom: 30px;
            animation: fadeInUp 0.6s ease;
        }

        .btn-add {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .table-responsive {
            border-radius: 15px;
            overflow: hidden;
        }

        .table {
            margin: 0;
        }

        .table thead {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .table thead th {
            border: none;
            padding: 15px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background: #f8f9ff;
            transform: scale(1.01);
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
        }

        .badge-active {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 6px 15px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .badge-inactive {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            padding: 6px 15px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .btn-action {
            border: none;
            padding: 8px 15px;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin: 0 3px;
        }

        .btn-edit {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
        }

        .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(59, 130, 246, 0.4);
        }

        .btn-toggle {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }

        .btn-toggle:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(245, 158, 11, 0.4);
        }

        .btn-delete {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(239, 68, 68, 0.4);
        }

        .modal-content {
            border-radius: 20px;
            border: none;
        }

        .modal-header {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border-radius: 20px 20px 0 0;
            border: none;
        }

        .form-control, .form-select {
            border-radius: 12px;
            border: 2px solid #e5e7eb;
            padding: 10px 15px;
        }

        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .alert-custom {
            border-radius: 15px;
            border: none;
            padding: 15px 20px;
            animation: slideInRight 0.5s ease;
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

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6b7280;
        }

        .empty-state i {
            font-size: 4rem;
            opacity: 0.3;
            margin-bottom: 20px;
        }

        .btn-back {
            background: white;
            color: #667eea;
            border: 2px solid white;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255,255,255,0.3);
            color: #667eea;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Page Header -->
        <div class="page-header">
            <h1><i class="bi bi-grid-3x3-gap-fill"></i> Kelola Bidang Pengaduan</h1>
            <p>Manajemen Kategori Bidang Pengaduan Masyarakat</p>
        </div>

        <!-- Alerts -->
        @if(session('success'))
            <div class="alert alert-success alert-custom alert-dismissible fade show" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-check-circle-fill fs-4 me-3"></i>
                    <div><strong>Berhasil!</strong> {{ session('success') }}</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-custom alert-dismissible fade show" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-exclamation-circle-fill fs-4 me-3"></i>
                    <div><strong>Gagal!</strong> {{ session('error') }}</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Card -->
        <div class="card-custom">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0"><i class="bi bi-list-ul"></i> Daftar Bidang</h4>
                <button class="btn-add" data-bs-toggle="modal" data-bs-target="#addModal">
                    <i class="bi bi-plus-circle-fill"></i> Tambah Bidang
                </button>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="25%">Nama Bidang</th>
                            <th width="35%">Deskripsi</th>
                            <th width="10%">Jumlah</th>
                            <th width="10%">Status</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bidangs as $index => $bidang)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><strong>{{ $bidang->nama_bidang }}</strong></td>
                                <td>{{ $bidang->deskripsi ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-primary">{{ $bidang->pengaduans_count }} pengaduan</span>
                                </td>
                                <td>
                                    <span class="badge-{{ $bidang->is_active ? 'active' : 'inactive' }}">
                                        {{ $bidang->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td>
                                    <button class="btn-action btn-edit" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editModal{{ $bidang->id }}">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>
                                    
                                    <form action="{{ route('bidang.toggleStatus', $bidang->id) }}" 
                                          method="POST" 
                                          style="display: inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn-action btn-toggle">
                                            <i class="bi bi-{{ $bidang->is_active ? 'toggle-on' : 'toggle-off' }}"></i>
                                        </button>
                                    </form>
                                    
                                    <button class="btn-action btn-delete" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal{{ $bidang->id }}">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal{{ $bidang->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                <i class="bi bi-pencil-square"></i> Edit Bidang
                                            </h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('bidang.update', $bidang->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Bidang *</label>
                                                    <input type="text" name="nama_bidang" class="form-control" 
                                                           value="{{ $bidang->nama_bidang }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Deskripsi</label>
                                                    <textarea name="deskripsi" class="form-control" rows="3">{{ $bidang->deskripsi }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" 
                                                               name="is_active" value="1" 
                                                               {{ $bidang->is_active ? 'checked' : '' }}>
                                                        <label class="form-check-label">Status Aktif</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{ $bidang->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title">
                                                <i class="bi bi-exclamation-triangle-fill"></i> Konfirmasi Hapus
                                            </h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah Anda yakin ingin menghapus bidang <strong>{{ $bidang->nama_bidang }}</strong>?</p>
                                            @if($bidang->pengaduans_count > 0)
                                                <div class="alert alert-warning">
                                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                                    Bidang ini digunakan oleh {{ $bidang->pengaduans_count }} pengaduan!
                                                </div>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <form action="{{ route('bidang.destroy', $bidang->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <i class="bi bi-inbox"></i>
                                        <p>Belum ada bidang pengaduan</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Back Button -->
        <div class="text-center">
            <a href="{{ route('pengaduan.index') }}" class="btn-back">
                <i class="bi bi-arrow-left-circle"></i> Kembali ke Daftar Pengaduan
            </a>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-plus-circle-fill"></i> Tambah Bidang Baru
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('bidang.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Bidang *</label>
                            <input type="text" name="nama_bidang" class="form-control" 
                                   placeholder="Contoh: Infrastruktur" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3" 
                                      placeholder="Deskripsi singkat tentang bidang ini"></textarea>
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" 
                                       name="is_active" value="1" checked>
                                <label class="form-check-label">Status Aktif</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>