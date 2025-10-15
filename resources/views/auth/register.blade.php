<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - SPI Polije</title>
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
            background: linear-gradient(135deg, #c62828 0%, #d32f2f 50%, #e53935 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated Background Elements */
        .bg-decoration {
            position: fixed;
            border-radius: 50%;
            opacity: 0.1;
            animation: float 20s infinite ease-in-out;
        }

        .circle-1 {
            width: 300px;
            height: 300px;
            background: #ffeb3b;
            top: -100px;
            right: -100px;
            animation-delay: 0s;
        }

        .circle-2 {
            width: 200px;
            height: 200px;
            background: #ffffff;
            bottom: -50px;
            left: -50px;
            animation-delay: 2s;
        }

        .circle-3 {
            width: 150px;
            height: 150px;
            background: #ffeb3b;
            top: 50%;
            right: 10%;
            animation-delay: 4s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translate(0, 0) rotate(0deg);
            }

            33% {
                transform: translate(30px, -30px) rotate(120deg);
            }

            66% {
                transform: translate(-20px, 20px) rotate(240deg);
            }
        }

        /* Main Container with 3D Effect */
        .register-container {
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
            grid-template-columns: 1fr 1.2fr;
            position: relative;
            z-index: 1;
            transform-style: preserve-3d;
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
            padding: 50px 40px;
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
            margin-bottom: 30px;
        }

        .logo {
            width: 120px;
            height: 120px;
            background: white;
            border-radius: 50%;
            padding: 20px;
            box-shadow:
                0 15px 35px rgba(0, 0, 0, 0.3),
                0 5px 15px rgba(198, 40, 40, 0.4),
                inset 0 -3px 10px rgba(0, 0, 0, 0.05);
            animation: logoFloat 3s ease-in-out infinite;
            transform-style: preserve-3d;
        }

        @keyframes logoFloat {

            0%,
            100% {
                transform: translateY(0) translateZ(20px);
            }

            50% {
                transform: translateY(-15px) translateZ(30px);
            }
        }

        .brand-text {
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .brand-text h1 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 0 3px 15px rgba(0, 0, 0, 0.3);
        }

        .brand-text p {
            font-size: 14px;
            opacity: 0.95;
            line-height: 1.6;
        }

        .brand-text .highlight {
            color: #ffeb3b;
            font-weight: 600;
            text-shadow: 0 2px 10px rgba(255, 235, 59, 0.5);
        }

        /* Right Panel - Form */
        .form-panel {
            padding: 50px 45px;
            background: white;
        }

        .form-header {
            margin-bottom: 35px;
        }

        .form-header h2 {
            font-size: 28px;
            font-weight: 700;
            color: #c62828;
            margin-bottom: 8px;
        }

        .form-header p {
            color: #666;
            font-size: 14px;
        }

        /* Input Groups with 3D Effect */
        .input-wrapper {
            position: relative;
            margin-bottom: 20px;
        }

        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 14px;
            padding: 14px 18px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: #fafafa;
            box-shadow:
                0 2px 4px rgba(0, 0, 0, 0.05),
                inset 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .form-control:focus {
            border-color: #c62828;
            background: white;
            box-shadow:
                0 0 0 4px rgba(198, 40, 40, 0.1),
                0 8px 16px rgba(198, 40, 40, 0.15);
            transform: translateY(-3px);
        }

        .form-control::placeholder {
            color: #999;
        }

        /* Category Cards with 3D Effect */
        .category-section {
            margin-bottom: 25px;
        }

        .category-title {
            font-size: 13px;
            font-weight: 600;
            color: #c62828;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
        }

        .category-title::before {
            content: '';
            width: 4px;
            height: 16px;
            background: linear-gradient(135deg, #ffeb3b 0%, #ffc107 100%);
            margin-right: 8px;
            border-radius: 2px;
            box-shadow: 0 2px 8px rgba(255, 193, 7, 0.4);
        }

        .radio-card {
            border: 2px solid #e8e8e8;
            border-radius: 14px;
            padding: 16px 18px;
            margin-bottom: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: linear-gradient(145deg, #ffffff 0%, #f8f8f8 100%);
            position: relative;
            box-shadow:
                0 4px 8px rgba(0, 0, 0, 0.08),
                0 2px 4px rgba(0, 0, 0, 0.06),
                inset 0 -2px 4px rgba(0, 0, 0, 0.03);
            transform-style: preserve-3d;
        }

        .radio-card:hover {
            border-color: #c62828;
            background: linear-gradient(145deg, #ffffff 0%, #fff5f5 100%);
            transform: translateY(-4px) translateZ(10px);
            box-shadow:
                0 12px 24px rgba(198, 40, 40, 0.2),
                0 6px 12px rgba(0, 0, 0, 0.1),
                inset 0 -2px 4px rgba(0, 0, 0, 0.03);
        }

        .radio-card input[type="radio"] {
            position: absolute;
            opacity: 0;
        }

        .radio-card input[type="radio"]:checked+.radio-content {
            color: #c62828;
            font-weight: 600;
        }

        .radio-card input[type="radio"]:checked~.check-icon {
            opacity: 1;
            transform: scale(1) translateZ(10px);
        }

        .radio-card.active {
            border-color: #c62828;
            background: linear-gradient(145deg, #fff5f5 0%, #ffebee 100%);
            box-shadow:
                0 15px 30px rgba(198, 40, 40, 0.25),
                0 8px 16px rgba(0, 0, 0, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.8),
                inset 0 -3px 6px rgba(198, 40, 40, 0.1);
            transform: translateY(-6px) translateZ(15px);
        }

        .radio-content {
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            padding-left: 8px;
        }

        .check-icon {
            position: absolute;
            right: 18px;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: linear-gradient(135deg, #c62828 0%, #d32f2f 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transform: scale(0.5);
            transition: all 0.3s ease;
            box-shadow:
                0 4px 12px rgba(198, 40, 40, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
        }

        .check-icon::after {
            content: '✓';
            color: white;
            font-size: 16px;
            font-weight: bold;
        }

        /* Role Dropdown with 3D */
        .role-dropdown {
            margin-top: 12px;
            margin-left: 16px;
            padding: 14px;
            background: linear-gradient(145deg, #ffffff 0%, #fafafa 100%);
            border-radius: 12px;
            border: 2px solid #e0e0e0;
            animation: slideDown 0.3s ease-out;
            box-shadow:
                0 6px 12px rgba(0, 0, 0, 0.08),
                inset 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                max-height: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                max-height: 200px;
                transform: translateY(0);
            }
        }

        .role-dropdown select {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 13px;
            background: white;
            box-shadow:
                0 2px 4px rgba(0, 0, 0, 0.05),
                inset 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        /* Submit Button with 3D */
        .btn-register {
            width: 100%;
            background: linear-gradient(135deg, #c62828 0%, #d32f2f 100%);
            border: none;
            border-radius: 14px;
            padding: 16px;
            color: white;
            font-weight: 600;
            font-size: 15px;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow:
                0 8px 16px rgba(198, 40, 40, 0.3),
                0 4px 8px rgba(0, 0, 0, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
        }

        .btn-register::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .btn-register:hover {
            transform: translateY(-4px) translateZ(10px);
            box-shadow:
                0 16px 32px rgba(198, 40, 40, 0.4),
                0 8px 16px rgba(0, 0, 0, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
            background: linear-gradient(135deg, #d32f2f 0%, #e53935 100%);
        }

        .btn-register:hover::before {
            left: 100%;
        }

        .btn-register:active {
            transform: translateY(-2px) translateZ(5px);
            box-shadow:
                0 8px 16px rgba(198, 40, 40, 0.3),
                0 4px 8px rgba(0, 0, 0, 0.15);
        }

        /* Alert with 3D */
        .alert-danger {
            border-radius: 12px;
            border: 2px solid #ef5350;
            background: linear-gradient(145deg, #fff5f5 0%, #ffebee 100%);
            color: #c62828;
            padding: 14px 18px;
            margin-bottom: 20px;
            font-size: 13px;
            box-shadow:
                0 6px 12px rgba(198, 40, 40, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.5);
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
            margin: 0;
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

        /* Responsive */
        @media (max-width: 768px) {
            .register-container {
                grid-template-columns: 1fr;
                max-width: 500px;
            }

            .brand-panel {
                padding: 40px 30px;
            }

            .brand-text h1 {
                font-size: 24px;
            }

            .form-panel {
                padding: 40px 30px;
            }

            .logo {
                width: 80px;
                height: 80px;
            }
        }

        .d-none {
            display: none;
        }
    </style>
</head>

<body>
    <!-- Background Decorations -->
    <div class="bg-decoration circle-1"></div>
    <div class="bg-decoration circle-2"></div>
    <div class="bg-decoration circle-3"></div>

    <div class="register-container">
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
                <h1>SPI Polije</h1>
                <p>Sistem Pengaduan Internal</p>
                <p style="margin-top: 20px; font-size: 13px;">
                    Daftar sekarang untuk mengakses <span class="highlight">sistem pelaporan</span> yang aman dan
                    terpercaya
                </p>
            </div>
        </div>

        <!-- Right Panel - Form -->
        <div class="form-panel">
            <div class="form-header">
                <h2>Buat Akun Baru</h2>
                <p>Lengkapi data diri Anda untuk mendaftar</p>
                <!-- Pesan sukses -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Pesan error -->
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>
                                    @if(str_contains($error, 'email'))
                                        Alamat email sudah terdaftar atau tidak valid.
                                    @elseif(str_contains($error, 'password'))
                                        Konfirmasi password tidak cocok atau password terlalu pendek.
                                    @else
                                        {{ $error }}
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>

            <form id="registerForm" method="POST" action="{{ route('register.post') }}">
                @csrf
                <!-- STEP 1: Data Dasar -->
                <div class="form-step" id="step1">
                    <div class="input-wrapper">
                        <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" required
                            autofocus>
                    </div>
                    <div class="input-wrapper">
                        <input type="email" name="email" class="form-control" placeholder="Alamat Email" required>
                    </div>
                    <div class="input-wrapper">
                        <input type="email" name="alt_email" class="form-control" placeholder="Email Alternatif">
                    </div>
                    <div class="input-wrapper">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="input-wrapper">
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="Konfirmasi Password" required>
                    </div>
                    <div class="input-wrapper">
                        <input type="text" name="phone" class="form-control" placeholder="No. Telp / HP / WhatsApp">
                    </div>
                    <div class="input-wrapper">
                        <input type="text" name="address" class="form-control" placeholder="Alamat Lengkap">
                    </div>


                    <!-- Tombol Lanjut -->
                    <button type="button" class="btn-register" id="nextStepBtn">Lanjut</button>
                </div>

                <!-- STEP 2: Kategori & Disabilitas -->
                <div class="form-step d-none" id="step2">

                    <!-- Internal Category -->
                    <div class="category-section">
                        <div class="category-title">Kategori Internal</div>
                        <label class="radio-card" for="pegawaiPolije">
                            <input type="radio" name="user_type" id="pegawaiPolije" value="pegawai">
                            <div class="radio-content">Pegawai Polije</div>
                            <div class="check-icon"></div>
                        </label>
                        <div class="role-dropdown d-none" id="pegawaiRoleBox">
                            <select name="pegawai_role" id="pegawaiRole" class="form-control">
                                <option value="" disabled selected>-- Pilih Jabatan / Role --</option>
                                <option value="pimpinan">Pimpinan</option>
                                <option value="pejabat">Pejabat yang Ditunjuk</option>
                                <option value="pegawai">Pegawai</option>
                                <option value="admin">Admin</option>
                                <option value="pengawas">Pengawas</option>
                            </select>
                        </div>
                        <label class="radio-card" for="whistleblower">
                            <input type="radio" name="user_type" id="whistleblower" value="whistleblower">
                            <div class="radio-content">Whistleblower</div>
                            <div class="check-icon"></div>
                        </label>
                    </div>

                    <!-- External Category -->
                    <div class="category-section">
                        <div class="category-title">Kategori Eksternal</div>
                        <label class="radio-card" for="masyarakat">
                            <input type="radio" name="user_type" id="masyarakat" value="masyarakat">
                            <div class="radio-content">Masyarakat / Non Pegawai / Instansi Lain</div>
                            <div class="check-icon"></div>
                        </label>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="category-section">
                        <div class="category-title">Jenis Kelamin</div>
                        <label class="radio-card" for="male">
                            <input type="radio" name="gender" id="male" value="Laki-laki">
                            <div class="radio-content">Laki-laki</div>
                            <div class="check-icon"></div>
                        </label>
                        <label class="radio-card" for="female">
                            <input type="radio" name="gender" id="female" value="Perempuan">
                            <div class="radio-content">Perempuan</div>
                            <div class="check-icon"></div>
                        </label>
                        <label class="radio-card" for="hidden">
                            <input type="radio" name="gender" id="hidden" value="Disembunyikan">
                            <div class="radio-content">Disembunyikan</div>
                            <div class="check-icon"></div>
                        </label>
                    </div>

                    <!-- Disabilitas -->
                    <div class="category-section">
                        <div class="category-title">Apakah Anda Memiliki Disabilitas?</div>
                        <label class="radio-card" for="disab_yes">
                            <input type="radio" name="disability" id="disab_yes" value="iya">
                            <div class="radio-content">Ya</div>
                            <div class="check-icon"></div>
                        </label>
                        <label class="radio-card" for="disab_no">
                            <input type="radio" name="disability" id="disab_no" value="tidak">
                            <div class="radio-content">Tidak</div>
                            <div class="check-icon"></div>
                        </label>
                        <div class="role-dropdown d-none" id="disabilityTypeBox">
                            <select name="disability_type" id="disabilityType" class="form-control">
                                <option value="" disabled selected>-- Pilih Jenis Disabilitas --</option>
                                <option value="low_vision">Gangguan Penglihatan / Low Vision</option>
                                <option value="blind">Tidak Dapat Melihat</option>
                                <option value="hearing">Sulit Mendengar</option>
                                <option value="other">Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <!-- Tombol Back + Submit -->
                    <div style="display:flex; gap:10px; margin-top:20px;">
                        <button type="button" class="btn-register" id="backStepBtn"
                            style="background:#777;">Kembali</button>
                        <button type="submit" class="btn-register">Daftar Sekarang</button>
                    </div>
                </div>

            </form>

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>





            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const nextStepBtn = document.getElementById("nextStepBtn");
                    const backStepBtn = document.getElementById("backStepBtn");
                    const step1 = document.getElementById("step1");
                    const step2 = document.getElementById("step2");

                    // Tombol Lanjut
                    nextStepBtn.addEventListener("click", function () {
                        const inputs = step1.querySelectorAll("input[required]");
                        let valid = true;
                        inputs.forEach(input => { if (!input.value.trim()) valid = false; });
                        if (!valid) { alert("Mohon lengkapi semua field terlebih dahulu!"); return; }

                        step1.classList.add("d-none");
                        step2.classList.remove("d-none");
                    });

                    // Tombol Kembali
                    backStepBtn.addEventListener("click", function () {
                        step2.classList.add("d-none");
                        step1.classList.remove("d-none");
                    });

                    // Toggle role dropdown untuk pegawai
                    const radioCards = document.querySelectorAll('.radio-card');
                    const pegawaiRadio = document.getElementById("pegawaiPolije");
                    const roleBoxPegawai = document.getElementById("pegawaiRoleBox");

                    radioCards.forEach(card => {
                        card.addEventListener('click', function () {
                            radioCards.forEach(c => c.classList.remove('active'));
                            const radio = this.querySelector('input[type="radio"]');
                            if (radio) {
                                radio.checked = true;
                                this.classList.add('active');
                                // toggle role box
                                if (pegawaiRadio.checked) roleBoxPegawai.classList.remove('d-none');
                                else roleBoxPegawai.classList.add('d-none');
                            }
                        });
                    });

                    // Toggle dropdown disabilitas
                    const disabYes = document.getElementById("disab_yes");
                    const disabNo = document.getElementById("disab_no");
                    const disabilityBox = document.getElementById("disabilityTypeBox");

                    [disabYes, disabNo].forEach(el => {
                        el.addEventListener("change", function () {
                            if (disabYes.checked) disabilityBox.classList.remove("d-none");
                            else disabilityBox.classList.add("d-none");
                        });
                    });
                });

            </script>

            <div class="form-footer">
                <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Radio utama
            const pegawaiRadio = document.getElementById("pegawaiPolije");
            const whistleRadio = document.getElementById("whistleblower");
            const masyarakatRadio = document.getElementById("masyarakat");
            const roleBoxPegawai = document.getElementById("pegawaiRoleBox");

            const pegawaiCard = pegawaiRadio.closest('.radio-card');
            const whistleCard = whistleRadio.closest('.radio-card');
            const masyarakatCard = masyarakatRadio.closest('.radio-card');

            let selectedKey = null; // Track toggle kategori utama

            const mainRadios = [
                { key: 'pegawai', radio: pegawaiRadio, card: pegawaiCard },
                { key: 'whistle', radio: whistleRadio, card: whistleCard },
                { key: 'masyarakat', radio: masyarakatRadio, card: masyarakatCard }
            ];

            mainRadios.forEach(item => {
                item.card.addEventListener('click', function (e) {
                    e.preventDefault(); // hentikan behavior default

                    if (selectedKey === item.key) {
                        // Lepas pilihan
                        item.radio.checked = false;
                        item.card.classList.remove('active');
                        roleBoxPegawai.classList.add("d-none");
                        document.getElementById("pegawaiRole").selectedIndex = 0;
                        selectedKey = null;
                        // Tampilkan semua opsi utama lagi
                        mainRadios.forEach(r => r.card.classList.remove('d-none'));
                    } else if (!selectedKey) {
                        // Pilih opsi utama pertama kali
                        selectedKey = item.key;
                        item.radio.checked = true;
                        item.card.classList.add('active');
                        mainRadios.forEach(r => {
                            if (r.key !== item.key) r.card.classList.add('d-none');
                        });
                        // Tampilkan dropdown Pegawai jika dipilih
                        if (selectedKey === 'pegawai') roleBoxPegawai.classList.remove("d-none");
                    }
                });
            });

            // Radio jenis kelamin dan disabilitas
            const genderRadios = document.querySelectorAll('input[name="gender"]');
            const disabilityRadios = document.querySelectorAll('input[name="disability"]');
            const disabilityBox = document.getElementById("disabilityTypeBox");

            // Klik radio jenis kelamin
            genderRadios.forEach(r => {
                const card = r.closest('.radio-card');
                card.addEventListener('click', function () {
                    genderRadios.forEach(r2 => r2.closest('.radio-card').classList.remove('active'));
                    r.checked = true;
                    card.classList.add('active');
                });
            });

            // Klik radio disabilitas
            disabilityRadios.forEach(r => {
                const card = r.closest('.radio-card');
                card.addEventListener('click', function () {
                    disabilityRadios.forEach(r2 => r2.closest('.radio-card').classList.remove('active'));
                    r.checked = true;
                    card.classList.add('active');

                    if (r.id === 'disab_yes') {
                        disabilityBox.classList.remove("d-none");
                    } else {
                        disabilityBox.classList.add("d-none");
                        document.getElementById("disabilityType").selectedIndex = 0;
                    }
                });
            });
        });
    </script>


</body>

</html>