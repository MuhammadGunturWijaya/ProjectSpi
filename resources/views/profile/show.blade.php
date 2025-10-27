<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Profil Pengguna - SPI POLIJE</title>
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
            overflow-x: hidden;
        }

        .profile-container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .profile-header {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 25px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .profile-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 120px;
            background: var(--gradient-1);
            z-index: 0;
        }

        .profile-avatar-section {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: var(--primary);
            border: 5px solid white;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .profile-info h2 {
            color: white;
            margin: 0;
            font-weight: 700;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .profile-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.9);
            color: var(--primary);
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 8px;
        }

        .profile-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            position: relative;
            z-index: 1;
        }

        .stat-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0.85));
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            backdrop-filter: blur(10px);
        }

        .stat-card i {
            font-size: 28px;
            color: var(--primary);
            margin-bottom: 10px;
        }

        .stat-card .label {
            font-size: 0.85rem;
            color: var(--secondary);
            margin-bottom: 5px;
        }

        .stat-card .value {
            font-size: 1.1rem;
            font-weight: 700;
            color: #333;
        }

        .form-card {
            background: white;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .form-card h4 {
            color: #333;
            font-weight: 700;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-card h4 i {
            color: var(--primary);
        }

        .form-floating label {
            color: var(--secondary);
        }

        .form-control,
        .form-select {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1);
        }

        .input-group-text {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            background: #f8f9fa;
        }

        .btn-save {
            background: var(--gradient-1);
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-code {
            background: var(--gradient-3);
            border: none;
            padding: 12px;
            border-radius: 12px;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
            margin-top: 15px;
        }

        .btn-code:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(79, 172, 254, 0.4);
        }

        .alert {
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .section-divider {
            height: 2px;
            background: linear-gradient(to right, transparent, var(--primary), transparent);
            margin: 30px 0;
        }

        .password-toggle {
            cursor: pointer;
            color: var(--secondary);
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: var(--primary);
        }

        @media (max-width: 768px) {
            .profile-avatar-section {
                flex-direction: column;
                text-align: center;
            }

            .form-card {
                padding: 25px;
            }
        }

        .floating-icon {
            position: absolute;
            opacity: 0.05;
            font-size: 200px;
            color: var(--primary);
            z-index: 0;
        }

        .form-label-custom {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--secondary);
            z-index: 10;
        }

        .input-with-icon {
            padding-left: 45px !important;
        }
    </style>
</head>

<body>
    <div class="container profile-container">
        <!-- Profile Header -->
        <div class="profile-header">
            <div class="profile-avatar-section">
                <div class="profile-avatar">
                    <i class="bi bi-person-circle"></i>
                </div>
                <div class="profile-info">
                    <h2>{{ $user->name }}</h2>
                    <span class="profile-badge">
                        <i class="bi bi-shield-check me-1"></i>{{ $user->pegawai_role }}
                    </span>
                </div>
            </div>

            <div class="profile-stats">
                <div class="stat-card">
                    <i class="bi bi-envelope-fill"></i>
                    <div class="label">Email Terdaftar</div>
                    <div class="value">
                        {{ auth()->user()->email_verified_at ? 'Terverifikasi' : 'Belum Terverifikasi' }}
                    </div>
                </div>
                <div class="stat-card">
                    <i class="bi bi-calendar-check"></i>
                    <div class="label">Bergabung Sejak</div>
                    <div class="value">
                        {{ auth()->user()->created_at->format('d-m-Y') }}
                    </div>
                </div>
                <div class="stat-card">
                    <i class="bi bi-pencil-square"></i>
                    <div class="label">Update Terakhir</div>
                    <div class="value">
                        {{ auth()->user()->updated_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="form-card">
            <i class="bi bi-gear-fill floating-icon" style="right: -50px; top: 50px;"></i>

            <h4>
                <i class="bi bi-person-gear"></i>
                Pengaturan Profil
            </h4>

            <form id="profileForm">
                @csrf
                <div class="row g-3">
                    <!-- Nama -->
                    <div class="col-md-6">
                        <label class="form-label-custom">
                            <i class="bi bi-person me-1"></i>Nama Lengkap
                        </label>
                        <div style="position: relative;">
                            <i class="bi bi-person-fill input-icon"></i>
                            <input type="text" class="form-control input-with-icon" name="name"
                                value="{{ $user->name }}" required>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <label class="form-label-custom">
                            <i class="bi bi-envelope me-1"></i>Email Utama
                        </label>
                        <div style="position: relative;">
                            <i class="bi bi-envelope-fill input-icon"></i>
                            <input type="email" class="form-control input-with-icon" name="email"
                                value="{{ $user->email }}" required>
                        </div>
                    </div>

                    <!-- Email Alternatif -->
                    <div class="col-md-6">
                        <label class="form-label-custom">
                            <i class="bi bi-envelope-plus me-1"></i>Email Alternatif
                        </label>
                        <div style="position: relative;">
                            <i class="bi bi-envelope input-icon"></i>
                            <input type="email" class="form-control input-with-icon" name="alt_email"
                                value="{{ $user->alt_email }}">
                        </div>
                    </div>

                    <!-- Nomor Telepon -->
                    <div class="col-md-6">
                        <label class="form-label-custom">
                            <i class="bi bi-whatsapp me-1"></i>No. Telp / HP / WhatsApp
                        </label>
                        <div style="position: relative;">
                            <i class="bi bi-phone-fill input-icon"></i>
                            <input type="tel" class="form-control input-with-icon" placeholder="08xxxxxxxxxx"
                                name="phone" value="{{ $user->phone }}">
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="col-12">
                        <label class="form-label-custom">
                            <i class="bi bi-geo-alt me-1"></i>Alamat Lengkap
                        </label>
                        <div style="position: relative;">
                            <i class="bi bi-house-fill input-icon" style="top: 25px;"></i>
                            <textarea class="form-control input-with-icon" name="address"
                                rows="3">{{ $user->address }}</textarea>
                        </div>
                    </div>

                    <!-- Tombol verifikasi pendaftar (Admin Only) -->
                    @if(auth()->user()->role === 'admin')
                    <div class="col-12">
                        <button type="button" id="btnVerifyPendaftar" class="btn btn-code w-100">
                            <i class="bi bi-qr-code-scan me-2"></i>Verifikasi Kode Pendaftar
                        </button>
                    </div>
                    @endif

                    <div class="col-12">
                        <div class="section-divider"></div>
                    </div>

                    <!-- Password Section -->
                    <div class="col-12">
                        <h5 class="mb-3">
                            <i class="bi bi-lock-fill me-2" style="color: var(--primary);"></i>
                            Ubah Password
                            <small class="text-muted" style="font-size: 0.8rem; font-weight: normal;">
                                (Opsional - kosongkan jika tidak ingin mengubah)
                            </small>
                        </h5>
                    </div>

                    <!-- Password Lama -->
                    <div class="col-md-4">
                        <label class="form-label-custom">
                            <i class="bi bi-key me-1"></i>Password Lama
                        </label>
                        <div style="position: relative;">
                            <i class="bi bi-lock-fill input-icon"></i>
                            <input type="password" class="form-control input-with-icon" name="current_password"
                                id="currentPassword" placeholder="Masukkan password lama">
                            <i class="bi bi-eye-fill password-toggle"
                                style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%);"
                                onclick="togglePassword('currentPassword', this)"></i>
                        </div>
                    </div>

                    <!-- Password Baru -->
                    <div class="col-md-4">
                        <label class="form-label-custom">
                            <i class="bi bi-key me-1"></i>Password Baru
                        </label>
                        <div style="position: relative;">
                            <i class="bi bi-lock-fill input-icon"></i>
                            <input type="password" class="form-control input-with-icon" name="password"
                                id="newPassword" placeholder="Masukkan password baru">
                            <i class="bi bi-eye-fill password-toggle"
                                style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%);"
                                onclick="togglePassword('newPassword', this)"></i>
                        </div>
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="col-md-4">
                        <label class="form-label-custom">
                            <i class="bi bi-key me-1"></i>Konfirmasi Password Baru
                        </label>
                        <div style="position: relative;">
                            <i class="bi bi-lock-fill input-icon"></i>
                            <input type="password" class="form-control input-with-icon" name="password_confirmation"
                                id="confirmPassword" placeholder="Ulangi password baru">
                            <i class="bi bi-eye-fill password-toggle"
                                style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%);"
                                onclick="togglePassword('confirmPassword', this)"></i>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-save w-100">
                            <i class="bi bi-check-circle me-2"></i>Simpan Perubahan
                        </button>
                    </div>

                    <!-- Tombol lihat kode verifikasi (User Only) -->
                    @if(auth()->user()->role === 'user')
                    <div class="col-12">
                        <button type="button" class="btn btn-code w-100" id="btnShowCode"
                            data-code="{{ auth()->user()->pegawai_code }}">
                            <i class="bi bi-qr-code me-2"></i>Lihat Kode Verifikasi Pegawai
                        </button>
                    </div>
                    @endif

                    <div class="col-12 mt-2">
                        <a href="{{ route('landingpage') }}" class="btn btn-secondary w-100">
                            <i class="bi bi-arrow-left-circle me-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // Toggle Password Visibility
        function togglePassword(fieldId, icon) {
            const field = document.getElementById(fieldId);
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('bi-eye-fill');
                icon.classList.add('bi-eye-slash-fill');
            } else {
                field.type = 'password';
                icon.classList.remove('bi-eye-slash-fill');
                icon.classList.add('bi-eye-fill');
            }
        }

        // Lihat Kode Verifikasi Pegawai
        @if(auth()->user()->role === 'user')
        document.getElementById('btnShowCode').addEventListener('click', function () {
            const pegawaiCode = this.dataset.code;

            Swal.fire({
                title: 'Kode Verifikasi Pegawai',
                html: `
                    <div style="padding: 20px;">
                        <p style="color: #6c757d; margin-bottom: 15px;">Kode verifikasi Anda:</p>
                        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                                    padding: 20px; border-radius: 15px; margin: 20px 0;">
                            <h1 style="color: white; font-weight: bold; letter-spacing: 3px; margin: 0;">
                                ${pegawaiCode}
                            </h1>
                        </div>
                        <p style="color: #6c757d; font-size: 0.9rem;">
                            <i class="bi bi-info-circle me-1"></i>
                            Gunakan kode ini untuk verifikasi identitas pegawai
                        </p>
                    </div>
                `,
                icon: 'info',
                confirmButtonText: '<i class="bi bi-clipboard me-2"></i>Salin Kode',
                confirmButtonColor: '#667eea',
                showCancelButton: true,
                cancelButtonText: 'Tutup'
            }).then((result) => {
                if (result.isConfirmed) {
                    navigator.clipboard.writeText(pegawaiCode);
                    Swal.fire({
                        icon: 'success',
                        title: 'Tersalin!',
                        text: 'Kode verifikasi telah disalin ke clipboard',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        });
        @endif

        // Verifikasi Pendaftar (Admin Only)
        @if(auth()->user()->role === 'admin')
        document.getElementById('btnVerifyPendaftar').addEventListener('click', function (event) {
            event.preventDefault();
            event.stopPropagation();

            Swal.fire({
                title: 'Masukkan Kode Verifikasi Pendaftar',
                input: 'text',
                inputPlaceholder: 'Contoh: REG-123456',
                showCancelButton: true,
                confirmButtonText: 'Cek Data',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#4facfe',
                showLoaderOnConfirm: true,
                preConfirm: (code) => {
                    return fetch("{{ route('pendaftar.check') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ code: code })
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(err => Promise.reject(err));
                        }
                        return response.json();
                    })
                    .catch(error => {
                        Swal.showValidationMessage(`${error.message || 'Terjadi kesalahan'}`);
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed && result.value.success) {
                    const p = result.value.data;

                    Swal.fire({
                        title: 'Konfirmasi Data Pendaftar',
                        html: `
                            <div style="text-align:left">
                                <p><strong>Nama:</strong> ${p.name}</p>
                                <p><strong>Email:</strong> ${p.email}</p>
                                <p><strong>No. HP:</strong> ${p.phone ?? '-'}</p>
                                <p><strong>Alamat:</strong> ${p.address ?? '-'}</p>
                            </div>
                        `,
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonText: 'Aktifkan Akses',
                        cancelButtonText: 'Batal',
                        confirmButtonColor: '#4facfe',
                    }).then((confirmResult) => {
                        if (confirmResult.isConfirmed) {
                            fetch("{{ route('pendaftar.verify') }}", {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                },
                                body: JSON.stringify({ code: p.code })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Verifikasi Berhasil!',
                                        text: data.message,
                                        confirmButtonColor: '#4facfe'
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal Aktivasi',
                                        text: data.message || 'Terjadi kesalahan saat mengaktifkan akses.',
                                        confirmButtonColor: '#dc3545'
                                    });
                                }
                            })
                            .catch(error => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: 'Terjadi kesalahan sistem: ' + error,
                                    confirmButtonColor: '#dc3545'
                                });
                            });
                        }
                    });
                }
            });
        });
        @endif

        // AJAX Form Submit untuk Update Profile
        document.getElementById('profileForm').addEventListener('submit', function (e) {
            e.preventDefault();
            
            let formData = new FormData(this);

            Swal.fire({
                title: 'Menyimpan...',
                text: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });

            fetch("{{ route('profile.update') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                Swal.close();
                
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        confirmButtonColor: '#667eea'
                    }).then(() => {
                        // Reload halaman untuk update data
                        window.location.reload();
                    });
                } else {
                    let errorMessage = 'Terjadi kesalahan!';
                    
                    if (data.errors) {
                        errorMessage = Object.values(data.errors).flat().join('\n');
                    } else if (data.message) {
                        errorMessage = data.message;
                    }
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: errorMessage,
                        confirmButtonColor: '#dc3545'
                    });
                }
            })
            .catch(error => {
                Swal.close();
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan pada sistem. Silakan coba lagi.',
                    confirmButtonColor: '#dc3545'
                });
                console.error('Error:', error);
            });
        });

        // Session Flash Messages
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000
        });
        @endif

        @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: "{{ session('error') }}",
            showConfirmButton: true
        });
        @endif
    </script>
</body>
</html>