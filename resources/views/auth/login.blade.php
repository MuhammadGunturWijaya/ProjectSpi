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

            0%,
            100% {
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

            0%,
            100% {
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

            0%,
            100% {
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

        /* Alert with 3D */
        .alert {
            border-radius: 12px;
            border: none;
            padding: 14px 18px;
            margin-bottom: 20px;
            font-size: 13px;
            animation: slideIn 0.3s ease-out;
            list-style: none;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-danger {
            background: linear-gradient(145deg, #fff5f5 0%, #ffebee 100%);
            color: #c62828;
            border: 2px solid #ef5350;
            box-shadow:
                0 6px 12px rgba(198, 40, 40, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.5);
        }

        .alert-success {
            background: linear-gradient(145deg, #f1f8f4 0%, #e8f5e9 100%);
            color: #2e7d32;
            border: 2px solid #66bb6a;
            box-shadow:
                0 6px 12px rgba(46, 125, 50, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.5);
        }

        .alert ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .alert li {
            padding: 4px 0;
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
                    <!-- Logo SVG Placeholder -->
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

            <!-- Alert Messages -->
            <div id="alertContainer"></div>

            <!-- Form Login -->
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-wrapper">
                    <label class="input-label">Email</label>
                    <input type="email" name="email" class="form-control" required autofocus>
                </div>

                <div class="input-wrapper">
                    <label class="input-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn-login">Login Sekarang</button>
            </form>


            <div class="form-footer">
                <p><a href="{{ route('password.request') }}">Lupa Password?</a></p>
                <div class="divider">
                    <span>atau</span>
                </div>
                <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Form submission handler
            document.getElementById('loginForm').addEventListener('submit', function (e) {
                e.preventDefault();

                const email = this.querySelector('input[name="email"]').value;
                const password = this.querySelector('input[name="password"]').value;

                // Demo validation
                if (email && password) {
                    showAlert('Login berhasil! Mengalihkan...', 'success');
                    setTimeout(() => {
                        window.location.href = "{{ route('landing') }}";
                    }, 1500);
                } else {
                    showAlert('Email dan password harus diisi!', 'danger');
                }
            });

            function showAlert(message, type) {
                const alertContainer = document.getElementById('alertContainer');
                const alertDiv = document.createElement('div');
                alertDiv.className = `alert alert-${type}`;
                alertDiv.innerHTML = `<ul><li>${message}</li></ul>`;
                alertContainer.innerHTML = '';
                alertContainer.appendChild(alertDiv);

                // Auto remove after 5 seconds
                setTimeout(() => {
                    alertDiv.style.animation = 'slideIn 0.3s ease-out reverse';
                    setTimeout(() => alertDiv.remove(), 300);
                }, 5000);
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('pegawai_code'))
        <script>
            Swal.fire({
                title: 'Kode Verifikasi Pegawai',
                html: `<p>Silakan kirim kode berikut ke Admin untuk verifikasi dan Anda Bisa Melihat Di Dalam Profile:</p>
                   <h2 style="color:#0d6efd; font-weight:bold;">{{ session('pegawai_code') }}</h2>`,
                icon: 'info',
                confirmButtonText: 'Salin Kode',
            }).then((result) => {
                if (result.isConfirmed) {
                    navigator.clipboard.writeText("{{ session('pegawai_code') }}");
                }
            });
        </script>
    @endif
</body>

</html>