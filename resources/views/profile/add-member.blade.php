<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tambah Anggota - SPI POLIJE</title>
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

        .container-custom {
            max-width: 800px;
            margin: 0 auto;
        }

        .header-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 25px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .header-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 100px;
            background: var(--gradient-3);
            z-index: 0;
        }

        .header-content {
            position: relative;
            z-index: 1;
        }

        .header-icon {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .header-icon i {
            font-size: 40px;
            color: var(--primary);
        }

        .header-card h2 {
            color: #333;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .header-card p {
            color: var(--secondary);
            margin: 0;
        }

        .form-card {
            background: white;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .form-section-title {
            color: #333;
            font-weight: 700;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.1rem;
        }

        .form-section-title i {
            color: var(--primary);
        }

        .form-label-custom {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            font-size: 0.9rem;
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

        .password-toggle {
            cursor: pointer;
            color: var(--secondary);
            transition: color 0.3s ease;
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
        }

        .password-toggle:hover {
            color: var(--primary);
        }

        .btn-submit {
            background: var(--gradient-3);
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(79, 172, 254, 0.3);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(79, 172, 254, 0.4);
            color: white;
        }

        .btn-back {
            background: var(--secondary);
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background: #5a6268;
            transform: translateY(-2px);
            color: white;
        }

        .section-divider {
            height: 2px;
            background: linear-gradient(to right, transparent, var(--primary), transparent);
            margin: 30px 0;
        }

        .required-mark {
            color: #dc3545;
            margin-left: 3px;
        }

        .form-text {
            font-size: 0.85rem;
            color: var(--secondary);
            margin-top: 5px;
        }

        @media (max-width: 768px) {
            .form-card {
                padding: 25px;
            }
        }
    </style>
</head>

<body>
    <div class="container container-custom">
        <!-- Header Card -->
        <div class="header-card">
            <div class="header-content">
                <div class="header-icon">
                    <i class="bi bi-person-plus-fill"></i>
                </div>
                <h2>Tambah Anggota Baru</h2>
                <p>Formulir pendaftaran anggota SPI POLIJE</p>
            </div>
        </div>

        <!-- Form Card -->
        <div class="form-card">
            <form id="addMemberForm">
                @csrf

                <!-- Informasi Dasar -->
                <div class="form-section-title">
                    <i class="bi bi-person-badge"></i>
                    Informasi Dasar
                </div>

                <div class="row g-3 mb-4">
                    <!-- Nama Lengkap -->
                    <div class="col-12">
                        <label class="form-label-custom">
                            <i class="bi bi-person me-1"></i>Nama Lengkap
                            <span class="required-mark">*</span>
                        </label>
                        <div style="position: relative;">
                            <i class="bi bi-person-fill input-icon"></i>
                            <input type="text" class="form-control input-with-icon" name="name"
                                placeholder="Masukkan nama lengkap" required>
                        </div>
                    </div>

                    <!-- Email Utama -->
                    <div class="col-md-6">
                        <label class="form-label-custom">
                            <i class="bi bi-envelope me-1"></i>Email Utama
                            <span class="required-mark">*</span>
                        </label>
                        <div style="position: relative;">
                            <i class="bi bi-envelope-fill input-icon"></i>
                            <input type="email" class="form-control input-with-icon" name="email"
                                placeholder="contoh@email.com" value="" required autocomplete="off">
                        </div>
                        <small class="form-text">Email akan digunakan untuk login</small>
                    </div>

                    <!-- Email Alternatif -->
                    <div class="col-md-6">
                        <label class="form-label-custom">
                            <i class="bi bi-envelope-plus me-1"></i>Email Alternatif
                        </label>
                        <div style="position: relative;">
                            <i class="bi bi-envelope input-icon"></i>
                            <input type="email" class="form-control input-with-icon" name="alt_email"
                                placeholder="Email cadangan (opsional)">
                        </div>
                    </div>

                    <!-- Nomor Telepon -->
                    <div class="col-md-6">
                        <label class="form-label-custom">
                            <i class="bi bi-whatsapp me-1"></i>No. Telp / HP / WhatsApp
                        </label>
                        <div style="position: relative;">
                            <i class="bi bi-phone-fill input-icon"></i>
                            <input type="tel" class="form-control input-with-icon" name="phone"
                                placeholder="08xxxxxxxxxx">
                        </div>
                    </div>

                    <!-- Role -->
                    <div class="col-md-6">
                        <label class="form-label-custom">
                            <i class="bi bi-shield-check me-1"></i>Role / Jabatan
                            <span class="required-mark">*</span>
                        </label>
                        <div style="position: relative;">
                            <i class="bi bi-briefcase-fill input-icon"></i>
                            <select class="form-select input-with-icon" name="role" required>
                                <option value="">-- Pilih Role --</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->nama_role }}">{{ $role->nama_role }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="col-12">
                        <label class="form-label-custom">
                            <i class="bi bi-geo-alt me-1"></i>Alamat Lengkap
                        </label>
                        <div style="position: relative;">
                            <i class="bi bi-house-fill input-icon" style="top: 25px;"></i>
                            <textarea class="form-control input-with-icon" name="address" rows="3"
                                placeholder="Masukkan alamat lengkap"></textarea>
                        </div>
                    </div>
                </div>

                <div class="section-divider"></div>

                <!-- Keamanan Akun -->
                <div class="form-section-title">
                    <i class="bi bi-shield-lock"></i>
                    Keamanan Akun
                </div>

                <div class="row g-3 mb-4">
                    <!-- Password -->
                    <div class="col-md-6">
                        <label class="form-label-custom">
                            <i class="bi bi-key me-1"></i>Password
                            <span class="required-mark">*</span>
                        </label>
                        <div style="position: relative;">
                            <i class="bi bi-lock-fill input-icon"></i>
                            <input type="password" class="form-control input-with-icon" name="password" id="password"
                                placeholder="Minimal 6 karakter" value="" required autocomplete="new-password">
                            <i class="bi bi-eye-fill password-toggle" onclick="togglePassword('password', this)"></i>
                        </div>
                        <small class="form-text">Password minimal 6 karakter</small>
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="col-md-6">
                        <label class="form-label-custom">
                            <i class="bi bi-key me-1"></i>Konfirmasi Password
                            <span class="required-mark">*</span>
                        </label>
                        <div style="position: relative;">
                            <i class="bi bi-lock-fill input-icon"></i>
                            <input type="password" class="form-control input-with-icon" name="password_confirmation"
                                id="password_confirmation" placeholder="Ulangi password" value="" required
                                autocomplete="new-password">
                            <i class="bi bi-eye-fill password-toggle"
                                onclick="togglePassword('password_confirmation', this)"></i>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="row g-3">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-submit w-100">
                            <i class="bi bi-check-circle me-2"></i>Simpan Anggota
                        </button>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('profile.show') }}" class="btn btn-back w-100">
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

        // Form Submit Handler
        document.getElementById('addMemberForm').addEventListener('submit', function (e) {
            e.preventDefault();

            let formData = new FormData(this);

            // Validasi password match
            const password = formData.get('password');
            const passwordConfirm = formData.get('password_confirmation');

            if (password !== passwordConfirm) {
                Swal.fire({
                    icon: 'error',
                    title: 'Password Tidak Cocok',
                    text: 'Password dan konfirmasi password harus sama!',
                    confirmButtonColor: '#dc3545'
                });
                return;
            }

            Swal.fire({
                title: 'Menyimpan Data...',
                text: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });

            fetch("{{ route('profile.store-member') }}", {
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
                        let emailStatus = '';
                        if (data.email_sent) {
                            emailStatus = `<div style="background: #d1e7dd; color: #0f5132; padding: 10px; border-radius: 8px; margin-top: 10px;">
            ✅ ${data.email_message}
        </div>`;
                        } else {
                            emailStatus = `<div style="background: #f8d7da; color: #842029; padding: 10px; border-radius: 8px; margin-top: 10px;">
            ⚠️ ${data.email_message}
        </div>`;
                        }

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            html: `
            <p>${data.message}</p>
            <div style="background: #f8f9fa; padding: 15px; border-radius: 10px; margin-top: 15px;">
                <p style="margin: 5px 0;"><strong>Nama:</strong> ${data.data.name}</p>
                <p style="margin: 5px 0;"><strong>Email:</strong> ${data.data.email}</p>
                <p style="margin: 5px 0;"><strong>Kode Pegawai:</strong> 
                    <span style="color: #667eea; font-weight: bold;">${data.data.code}</span>
                </p>
                <p style="margin: 5px 0;"><strong>Role:</strong> ${data.data.role}</p>
            </div>
            ${emailStatus}
        `,
                            confirmButtonColor: '#4facfe',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            document.getElementById('addMemberForm').reset();
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
    </script>
</body>

</html>