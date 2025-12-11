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
    <title>Login - SPI Polije</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #6e0d0d 0%, #8c1b1b 50%, #a92525 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        /* Animated Background Elements */
        .bg-decoration {
            position: fixed;
            border-radius: 50%;
            opacity: 0.1;
            animation: float 20s infinite ease-in-out;
        }

        .circle-1 {
            width: 400px;
            height: 400px;
            background: #ffeb3b;
            top: -150px;
            right: -150px;
            animation-delay: 0s;
        }

        .circle-2 {
            width: 300px;
            height: 300px;
            background: #ffffff;
            bottom: -100px;
            left: -100px;
            animation-delay: 2s;
        }

        .circle-3 {
            width: 200px;
            height: 200px;
            background: #ffeb3b;
            top: 40%;
            right: 15%;
            animation-delay: 4s;
        }

        .circle-4 {
            width: 150px;
            height: 150px;
            background: #ffffff;
            bottom: 30%;
            left: 10%;
            animation-delay: 6s;
        }

        @keyframes float {
            0%, 100% {
                transform: translate(0, 0) rotate(0deg);
            }
            33% {
                transform: translate(40px, -40px) rotate(120deg);
            }
            66% {
                transform: translate(-30px, 30px) rotate(240deg);
            }
        }

        /* Main Container with 3D Effect */
        .login-container {
            background: #ffffff;
            border-radius: 30px;
            padding: 0;
            width: 100%;
            max-width: 900px;
            box-shadow:
                0 30px 60px rgba(0, 0, 0, 0.3),
                0 15px 30px rgba(198, 40, 40, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.8);
            overflow: hidden;
            animation: slideUp 0.8s ease-out;
            display: grid;
            grid-template-columns: 1fr 1fr;
            position: relative;
            z-index: 1;
            transform-style: preserve-3d;
            min-height: 550px;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px) rotateX(10deg);
            }
            to {
                opacity: 1;
                transform: translateY(0) rotateX(0deg);
            }
        }

        /* Left Panel - Branding */
        .brand-panel {
            background: linear-gradient(135deg, #b71c1c 0%, #c62828 50%, #d32f2f 100%);
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            position: relative;
            overflow: hidden;
            box-shadow: inset -5px 0 15px rgba(0, 0, 0, 0.1);
        }

        .brand-panel::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.15) 0%, transparent 70%);
            animation: pulse 15s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: translate(-50%, -50%) scale(1);
                opacity: 0.5;
            }
            50% {
                transform: translate(-50%, -50%) scale(1.5);
                opacity: 0.2;
            }
        }

        .logo-wrapper {
            position: relative;
            z-index: 2;
            margin-bottom: 35px;
        }

        .logo {
            width: 140px;
            height: 140px;
            background: white;
            border-radius: 50%;
            padding: 25px;
            box-shadow:
                0 20px 40px rgba(0, 0, 0, 0.3),
                0 8px 20px rgba(198, 40, 40, 0.4),
                inset 0 -3px 10px rgba(0, 0, 0, 0.05);
            animation: logoFloat 3s ease-in-out infinite;
            transform-style: preserve-3d;
        }

        @keyframes logoFloat {
            0%, 100% {
                transform: translateY(0) translateZ(20px) rotate(0deg);
            }
            50% {
                transform: translateY(-15px) translateZ(30px) rotate(5deg);
            }
        }

        .brand-text {
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .brand-text h1 {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 12px;
            text-shadow: 0 3px 15px rgba(0, 0, 0, 0.3);
        }

        .brand-text p {
            font-size: 15px;
            opacity: 0.95;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .brand-text .tagline {
            font-size: 13px;
            opacity: 0.9;
            margin-top: 25px;
            padding: 15px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            backdrop-filter: blur(10px);
        }

        .brand-text .highlight {
            color: #ffeb3b;
            font-weight: 600;
            text-shadow: 0 2px 10px rgba(255, 235, 59, 0.5);
        }

        /* Right Panel - Form */
        .form-panel {
            padding: 60px 50px;
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-header {
            margin-bottom: 40px;
        }

        .form-header h2 {
            font-size: 32px;
            font-weight: 700;
            color: #c62828;
            margin-bottom: 10px;
        }

        .form-header p {
            color: #666;
            font-size: 15px;
        }

        /* Input Groups with 3D Effect */
        .input-wrapper {
            position: relative;
            margin-bottom: 22px;
        }

        .input-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #c62828;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 14px;
            padding: 15px 20px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #fafafa;
            width: 100%;
            box-shadow:
                0 2px 4px rgba(0, 0, 0, 0.05),
                inset 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .form-control:focus {
            border-color: #c62828;
            background: white;
            outline: none;
            box-shadow:
                0 0 0 4px rgba(198, 40, 40, 0.1),
                0 8px 16px rgba(198, 40, 40, 0.15);
            transform: translateY(-3px);
        }

        .form-control::placeholder {
            color: #999;
        }

        /* Submit Button with 3D */
        .btn-login {
            width: 100%;
            background: linear-gradient(135deg, #c62828 0%, #d32f2f 100%);
            border: none;
            border-radius: 14px;
            padding: 16px;
            color: white;
            font-weight: 600;
            font-size: 16px;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            margin-top: 10px;
            box-shadow:
                0 8px 16px rgba(198, 40, 40, 0.3),
                0 4px 8px rgba(0, 0, 0, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
            cursor: pointer;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .btn-login:hover {
            transform: translateY(-4px) translateZ(10px);
            box-shadow:
                0 16px 32px rgba(198, 40, 40, 0.4),
                0 8px 16px rgba(0, 0, 0, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
            background: linear-gradient(135deg, #d32f2f 0%, #e53935 100%);
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:active {
            transform: translateY(-2px) translateZ(5px);
            box-shadow:
                0 8px 16px rgba(198, 40, 40, 0.3),
                0 4px 8px rgba(0, 0, 0, 0.15);
        }

        /* Footer Links */
        .form-footer {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
        }

        .form-footer p {
            color: #666;
            font-size: 14px;
            margin: 8px 0;
        }

        .form-footer a {
            color: #c62828;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            text-shadow: 0 1px 2px rgba(198, 40, 40, 0.1);
        }

        .form-footer a:hover {
            color: #ffeb3b;
            text-decoration: underline;
            text-shadow: 0 2px 8px rgba(255, 235, 59, 0.5);
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            margin: 20px 0;
            color: #999;
            font-size: 13px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e0e0e0;
        }

        .divider span {
            padding: 0 15px;
        }

        /* Custom SweetAlert2 Styling */
        .swal2-popup {
            font-family: 'Poppins', sans-serif;
            border-radius: 20px;
        }

        .swal2-title {
            font-weight: 700;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .login-container {
                grid-template-columns: 1fr;
                max-width: 500px;
            }

            .brand-panel {
                padding: 40px 30px;
                min-height: auto;
            }

            .brand-text h1 {
                font-size: 28px;
            }

            .brand-text .tagline {
                font-size: 12px;
            }

            .form-panel {
                padding: 40px 30px;
            }

            .form-header h2 {
                font-size: 26px;
            }

            .logo {
                width: 100px;
                height: 100px;
            }
        }
    </style>
</head>

<body>
    <!-- Background Decorations -->
    <div class="bg-decoration circle-1"></div>
    <div class="bg-decoration circle-2"></div>
    <div class="bg-decoration circle-3"></div>
    <div class="bg-decoration circle-4"></div>

    <div class="login-container">
        <!-- Left Panel - Branding -->
        <div class="brand-panel">
            <div class="logo-wrapper">
                <div class="logo">
                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="50" cy="50" r="45" fill="#c62828" />
                        <text x="50" y="65" font-size="40" font-weight="bold" fill="#ffeb3b"
                            text-anchor="middle">P</text>
                    </svg>
                </div>
            </div>
            <div class="brand-text">
                <h1>Selamat Datang!</h1>
                <p>Satuan Pengawas Internal</p>
                <p style="font-size: 14px; margin-top: 15px;">Politeknik Negeri Jember</p>

                <div class="tagline">
                    Login untuk mengakses <span class="highlight">website</span> satuan pengawas internal politeknik
                    negeri jember
                </div>
            </div>
        </div>

        <!-- Right Panel - Form -->
        <div class="form-panel">
            <div class="form-header">
                <h2>Login</h2>
                <p>Masuk ke akun Anda</p>
            </div>

            <!-- Form Login -->
            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf
                <div class="input-wrapper">
                    <label class="input-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="masukkan email anda" required autofocus value="{{ old('email') }}">
                </div>

                <div class="input-wrapper">
                    <label class="input-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="masukkan password anda" required>
                </div>

                <button type="submit" class="btn-login">Login Sekarang</button>
            </form>

            <div class="form-footer">
                <p><a href="{{ route('password.request-otp') }}">Lupa Password?</a></p>
                <div class="divider">
                    <span>atau</span>
                </div>
                <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // Handle Laravel validation errors - GAGAL LOGIN
        @if($errors->any())
            document.addEventListener("DOMContentLoaded", function () {
                let errorMessages = '';
                @foreach($errors->all() as $error)
                    errorMessages += '<div style="text-align: left; padding: 10px 15px; margin: 5px 0; background: #ffebee; border-left: 4px solid #c62828; border-radius: 8px;"><i style="color: #c62828;">✖</i> {{ $error }}</div>';
                @endforeach

                Swal.fire({
                    icon: 'error',
                    title: '❌ Login Gagal!',
                    html: `
                        <div style="padding: 10px;">
                            <p style="font-size: 15px; color: #666; margin-bottom: 15px;">Terjadi kesalahan saat login:</p>
                            ${errorMessages}
                        </div>
                    `,
                    confirmButtonText: 'Coba Lagi',
                    confirmButtonColor: '#c62828',
                    customClass: {
                        popup: 'animate__animated animate__shakeX'
                    },
                    showClass: {
                        popup: 'animate__animated animate__headShake'
                    }
                });
            });
        @endif

        // Handle success message - BERHASIL LOGIN
        @if(session('success'))
            document.addEventListener("DOMContentLoaded", function () {
                Swal.fire({
                    icon: 'success',
                    title: '🎉 Selamat Datang!',
                    html: '<p style="font-size: 16px;">Di <strong style="color: #2e7d32;">Sistem Informasi SPI</strong></p><p style="font-size: 14px; color: #666;">Politeknik Negeri Jember</p><p style="font-size: 13px; color: #999; margin-top: 10px;">{{ session('success') }}</p>',
                    confirmButtonText: 'Lanjutkan',
                    confirmButtonColor: '#2e7d32',
                    timer: 3000,
                    timerProgressBar: true,
                    showClass: {
                        popup: 'animate__animated animate__bounceIn'
                    },
                    willClose: () => {
                        // Redirect otomatis jika ada
                        @if(session('redirect'))
                            window.location.href = "{{ session('redirect') }}";
                        @endif
                    }
                });
            });
        @endif

        // Handle status message (seperti email verification)
        @if(session('status'))
            document.addEventListener("DOMContentLoaded", function () {
                Swal.fire({
                    icon: 'info',
                    title: 'ℹ️ Informasi',
                    text: '{{ session('status') }}',
                    confirmButtonText: 'Mengerti',
                    confirmButtonColor: '#0288d1',
                    timer: 5000,
                    timerProgressBar: true
                });
            });
        @endif

        // Handle error message - UMUM
        @if(session('error'))
            document.addEventListener("DOMContentLoaded", function () {
                Swal.fire({
                    icon: 'error',
                    title: '⚠️ Terjadi Kesalahan!',
                    text: '{{ session('error') }}',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#c62828',
                    showClass: {
                        popup: 'animate__animated animate__shakeX'
                    }
                });
            });
        @endif

        // Handle pegawai code
        @if(session('pegawai_code'))
            document.addEventListener("DOMContentLoaded", function () {
                Swal.fire({
                    title: '🔐 Kode Verifikasi Pegawai',
                    html: `
                        <div style="padding: 20px;">
                            <p style="font-size: 15px; margin-bottom: 20px;">Silakan kirim kode berikut ke <strong style="color: #c62828;">Admin</strong> untuk verifikasi</p>
                            <div style="background: linear-gradient(135deg, #fff5f5 0%, #ffebee 100%); padding: 25px; border-radius: 15px; border: 2px dashed #c62828; margin: 20px 0;">
                                <h2 style="color: #c62828; font-weight: bold; font-size: 32px; letter-spacing: 3px; margin: 0;">{{ session('pegawai_code') }}</h2>
                            </div>
                            <p style="font-size: 13px; color: #666; margin-top: 15px;">
                                💡 Anda dapat melihat kode ini di halaman Profile Anda
                            </p>
                        </div>
                    `,
                    icon: 'info',
                    iconColor: '#c62828',
                    confirmButtonText: '📋 Salin Kode',
                    confirmButtonColor: '#c62828',
                    showCancelButton: true,
                    cancelButtonText: 'Tutup',
                    cancelButtonColor: '#666',
                    allowOutsideClick: false,
                    showClass: {
                        popup: 'animate__animated animate__zoomIn'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        navigator.clipboard.writeText("{{ session('pegawai_code') }}").then(() => {
                            Swal.fire({
                                icon: 'success',
                                title: '✅ Berhasil!',
                                text: 'Kode berhasil disalin ke clipboard',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                                toast: true,
                                position: 'top-end',
                                background: '#d4edda',
                                color: '#155724'
                            });
                        }).catch(() => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal menyalin',
                                text: 'Silakan salin kode secara manual',
                                toast: true,
                                position: 'top-end',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        });
                    }
                });
            });
        @endif

        // Form submission with loading
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            // Tampilkan loading saat form disubmit
            const submitButton = this.querySelector('.btn-login');
            submitButton.disabled = true;
            submitButton.innerHTML = '<span style="display: inline-block; animation: spin 1s linear infinite;">⏳</span> Memproses...';
            
            // Tampilkan SweetAlert loading
            Swal.fire({
                title: 'Memproses Login...',
                html: 'Sedang memverifikasi data Anda, mohon tunggu',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        });
    </script>

    <style>
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
    </style>
</body>
</html>