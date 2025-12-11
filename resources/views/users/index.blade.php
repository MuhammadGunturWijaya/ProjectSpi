<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Pengguna - SPI POLIJE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary: #0d6efd;
            --primary-dark: #0a58ca;
            --secondary: #6c757d;
            --success: #198754;
            --gradient-1: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-2: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --gradient-3: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px 0;
        }

        .container-main {
            max-width: 1400px;
            margin: 0 auto;
        }

        .page-header {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 25px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .page-header h2 {
            color: #333;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .page-header h2 i {
            color: var(--primary);
            font-size: 2rem;
        }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card .icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 15px;
        }

        .stat-card.total .icon {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .stat-card.with-code .icon {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }

        .stat-card.without-code .icon {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }

        .stat-card .label {
            font-size: 0.9rem;
            color: var(--secondary);
            margin-bottom: 5px;
        }

        .stat-card .value {
            font-size: 2rem;
            font-weight: 700;
            color: #333;
        }

        .filter-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .table-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
        }

        .table {
            margin: 0;
        }

        .table thead {
            background: var(--gradient-1);
            color: white;
        }

        .table thead th {
            border: none;
            padding: 15px;
            font-weight: 600;
            white-space: nowrap;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background: #f8f9fa;
            transform: scale(1.01);
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
        }

        .badge-role {
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
        }

        .badge-admin {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .badge-user {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }

        .badge-other {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }

        .code-badge {
            padding: 5px 12px;
            border-radius: 8px;
            font-family: 'Courier New', monospace;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
        }

        .code-badge.code-verified {
            background: #d4edda;
            color: #155724;
            border: 2px solid #c3e6cb;
        }

        .code-badge.code-unverified {
            background: #f8d7da;
            color: #721c24;
            border: 2px solid #f5c6cb;
        }

        .code-badge.code-user {
            background: #d1ecf1;
            color: #0c5460;
            border: 2px solid #bee5eb;
        }

        .btn-action {
            padding: 8px 12px;
            border-radius: 8px;
            border: none;
            margin: 0 3px;
            transition: all 0.3s ease;
        }

        .btn-action:hover {
            transform: translateY(-2px);
        }

        .btn-edit {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }

        .btn-delete {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }

        .form-control,
        .form-select {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1);
        }

        .btn-filter {
            background: var(--gradient-1);
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            color: white;
            font-weight: 600;
        }

        .btn-reset {
            background: var(--gradient-2);
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            color: white;
            font-weight: 600;
        }

        .pagination {
            margin-top: 20px;
            justify-content: center;
        }

        .pagination .page-link {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            margin: 0 3px;
            color: var(--primary);
        }

        .pagination .page-link:hover {
            background: var(--gradient-1);
            color: white;
            border-color: transparent;
        }

        .pagination .active .page-link {
            background: var(--gradient-1);
            border-color: transparent;
        }

        .category-tabs {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
        }

        .category-tab {
            flex: 1;
            padding: 15px;
            background: white;
            border-radius: 12px;
            border: 3px solid transparent;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            text-decoration: none;
            color: #333;
        }

        .category-tab:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .category-tab.active {
            background: var(--gradient-1);
            color: white;
            border-color: white;
        }

        .category-tab i {
            font-size: 1.5rem;
            display: block;
            margin-bottom: 8px;
        }

        .category-tab .label {
            font-weight: 600;
            font-size: 0.95rem;
        }

        @media (max-width: 768px) {
            .stats-row {
                grid-template-columns: 1fr;
            }

            .category-tabs {
                flex-direction: column;
            }

            .table-responsive {
                font-size: 0.85rem;
            }
        }
    </style>
</head>

<body>
    <div class="container container-main">
        <!-- Page Header -->
        <div class="page-header">
            <h2>
                <i class="bi bi-people-fill"></i>
                Daftar Pengguna Sistem
            </h2>
            <p class="text-muted mb-0 mt-2">Kelola dan monitor semua pengguna yang terdaftar dalam sistem</p>
        </div>

        <!-- Statistics Cards -->
        <div class="stats-row">
            <div class="stat-card total">
                <div class="icon">
                    <i class="bi bi-people"></i>
                </div>
                <div class="label">Total Pengguna</div>
                <div class="value">{{ $stats['total'] }}</div>
            </div>
            <div class="stat-card with-code">
                <div class="icon">
                    <i class="bi bi-person-badge"></i>
                </div>
                <div class="label">Dengan Kode Pegawai</div>
                <div class="value">{{ $stats['with_code'] }}</div>
            </div>
            <div class="stat-card without-code">
                <div class="icon">
                    <i class="bi bi-person"></i>
                </div>
                <div class="label">Tanpa Kode Pegawai</div>
                <div class="value">{{ $stats['without_code'] }}</div>
            </div>
        </div>

        <!-- Category Tabs -->
        <div class="category-tabs">
            <a href="{{ route('users.index', ['category' => 'all'] + request()->except('category')) }}"
                class="category-tab {{ $category === 'all' ? 'active' : '' }}">
                <i class="bi bi-grid-3x3-gap-fill"></i>
                <div class="label">Semua Pengguna</div>
            </a>
            <a href="{{ route('users.index', ['category' => 'with_code'] + request()->except('category')) }}"
                class="category-tab {{ $category === 'with_code' ? 'active' : '' }}">
                <i class="bi bi-person-badge-fill"></i>
                <div class="label">Dengan Kode Pegawai</div>
            </a>
            <a href="{{ route('users.index', ['category' => 'without_code'] + request()->except('category')) }}"
                class="category-tab {{ $category === 'without_code' ? 'active' : '' }}">
                <i class="bi bi-person-fill"></i>
                <div class="label">Tanpa Kode Pegawai</div>
            </a>
        </div>

        <!-- Filter Card -->
        <div class="filter-card">
            <form method="GET" action="{{ route('users.index') }}" id="filterForm">
                <input type="hidden" name="category" value="{{ $category }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">
                            <i class="bi bi-search me-1"></i>Cari Pengguna
                        </label>
                        <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                            placeholder="Nama, Email, atau Kode...">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">
                            <i class="bi bi-funnel me-1"></i>Filter Role
                        </label>
                        <select class="form-select" name="role">
                            <option value="all">Semua Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->nama_role }}"
                                    {{ request('role') === $role->nama_role ? 'selected' : '' }}>
                                    {{ $role->nama_role }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-bold">
                            <i class="bi bi-sort-down me-1"></i>Urutkan
                        </label>
                        <select class="form-select" name="sort_by">
                            <option value="created_at" {{ request('sort_by') === 'created_at' ? 'selected' : '' }}>
                                Tanggal Daftar
                            </option>
                            <option value="name" {{ request('sort_by') === 'name' ? 'selected' : '' }}>Nama</option>
                            <option value="email" {{ request('sort_by') === 'email' ? 'selected' : '' }}>Email</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold" style="opacity: 0;">Action</label>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-filter flex-fill">
                                <i class="bi bi-filter-circle me-1"></i>Filter
                            </button>
                            <a href="{{ route('users.index', ['category' => $category]) }}" class="btn btn-reset">
                                <i class="bi bi-arrow-counterclockwise"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Table Card -->
        <div class="table-card">
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-3">
                <h5 class="mb-0">
                    <i class="bi bi-table me-2"></i>Daftar Pengguna
                </h5>
                <div class="d-flex gap-3 align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <span class="code-badge code-verified">
                            <i class="bi bi-check-circle me-1"></i>Terverifikasi
                        </span>
                        <span class="code-badge code-unverified">
                            <i class="bi bi-exclamation-circle me-1"></i>Belum Verifikasi
                        </span>
                    </div>
                    <span class="text-muted">{{ $users->count() }} dari {{ $users->total() }} pengguna</span>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Kode Pegawai</th>
                            <th>No. Telp</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $users->firstItem() + $loop->index }}</td>
                                <td>
                                    <strong>{{ $user->name }}</strong>
                                    @if($user->id === auth()->id())
                                        <span class="badge bg-warning text-dark ms-1">Anda</span>
                                    @endif
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->role === 'admin')
                                        <span class="badge-role badge-admin">
                                            <i class="bi bi-shield-check me-1"></i>{{ $user->role }}
                                        </span>
                                    @elseif($user->role === 'user')
                                        <span class="badge-role badge-user">
                                            <i class="bi bi-person me-1"></i>{{ $user->role }}
                                        </span>
                                    @else
                                        <span class="badge-role badge-other">
                                            <i class="bi bi-star me-1"></i>{{ $user->role }}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if($user->pegawai_code)
                                        @if($user->role === 'pendaftar' || $user->role === 'user')
                                            {{-- Belum diverifikasi - Merah --}}
                                            <span class="code-badge code-unverified">
                                                <i class="bi bi-exclamation-circle me-1"></i>{{ $user->pegawai_code }}
                                            </span>
                                        @else
                                            {{-- Sudah diverifikasi - Hijau --}}
                                            <span class="code-badge code-verified">
                                                <i class="bi bi-check-circle me-1"></i>{{ $user->pegawai_code }}
                                            </span>
                                        @endif
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $user->phone ?: '-' }}</td>
                                <td>
                                    <small>{{ Str::limit($user->address, 30) ?: '-' }}</small>
                                </td>
                                <td>
                                    <button class="btn btn-action btn-edit btn-sm" onclick="editUser({{ $user->id }})"
                                        title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    @if($user->id !== auth()->id())
                                        <button class="btn btn-action btn-delete btn-sm"
                                            onclick="deleteUser({{ $user->id }}, '{{ $user->name }}')" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                                    <p class="text-muted mt-3">Tidak ada data pengguna</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-4">
            <a href="{{ route('landingpage') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle me-2"></i>Kembali ke Profil
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function editUser(userId) {
            fetch(`/users/${userId}/edit`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const user = data.data;
                        const roles = data.roles;

                        let roleOptions = roles.map(role =>
                            `<option value="${role.nama_role}" ${role.nama_role === user.role ? 'selected' : ''}>${role.nama_role}</option>`
                        ).join('');

                        Swal.fire({
                            title: 'Edit Data Pengguna',
                            html: `
                                <form id="editUserForm" class="text-start">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Nama Lengkap</label>
                                        <input type="text" class="form-control" name="name" value="${user.name}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Email</label>
                                        <input type="email" class="form-control" name="email" value="${user.email}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Role</label>
                                        <select class="form-select" name="role" required>
                                            ${roleOptions}
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Email Alternatif</label>
                                        <input type="email" class="form-control" name="alt_email" value="${user.alt_email || ''}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">No. Telepon</label>
                                        <input type="text" class="form-control" name="phone" value="${user.phone || ''}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Alamat</label>
                                        <textarea class="form-control" name="address" rows="3">${user.address || ''}</textarea>
                                    </div>
                                </form>
                            `,
                            showCancelButton: true,
                            confirmButtonText: '<i class="bi bi-check-circle me-1"></i>Simpan',
                            cancelButtonText: 'Batal',
                            confirmButtonColor: '#667eea',
                            width: '600px',
                            preConfirm: () => {
                                const form = document.getElementById('editUserForm');
                                const formData = new FormData(form);
                                const data = Object.fromEntries(formData);

                                return fetch(`/users/${userId}`, {
                                    method: 'PUT',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                    },
                                    body: JSON.stringify(data)
                                })
                                    .then(response => response.json())
                                    .then(result => {
                                        if (!result.success) {
                                            throw new Error(result.message);
                                        }
                                        return result;
                                    })
                                    .catch(error => {
                                        Swal.showValidationMessage(`Error: ${error.message}`);
                                    });
                            }
                        }).then(result => {
                            if (result.isConfirmed) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Data pengguna berhasil diperbarui',
                                    confirmButtonColor: '#667eea'
                                }).then(() => {
                                    window.location.reload();
                                });
                            }
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Gagal memuat data pengguna'
                    });
                });
        }

        function deleteUser(userId, userName) {
            Swal.fire({
                title: 'Hapus Pengguna?',
                html: `Apakah Anda yakin ingin menghapus pengguna <strong>${userName}</strong>?<br><br>
                       <span class="text-danger">Tindakan ini tidak dapat dibatalkan!</span>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: '<i class="bi bi-trash me-1"></i>Ya, Hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/users/${userId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Content-Type': 'application/json'
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Terhapus!',
                                    text: data.message,
                                    confirmButtonColor: '#667eea'
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: data.message,
                                    confirmButtonColor: '#dc3545'
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Terjadi kesalahan sistem',
                                confirmButtonColor: '#dc3545'
                            });
                        });
                }
            });
        }

        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#667eea'
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: "{{ session('error') }}",
                confirmButtonColor: '#dc3545'
            });
        @endif
    </script>
</body>

</html>