<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - SPI Polije</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Background animasi gradient */
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(270deg, #0066ff, #0099ff, #00ccff, #0066ff);
            background-size: 800% 800%;
            animation: gradientMove 15s ease infinite;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Card register */
        .register-box {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(14px);
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.35);
            color: #fff;
            animation: fadeInUp 1s ease;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .register-box h2 {
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
            letter-spacing: 1px;
        }

        /* Input */
        .form-control {
            border-radius: 50px;
            padding: 12px 20px;
            border: none;
            outline: none;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
        }

        .form-control:focus {
            box-shadow: 0 0 12px #00ccff;
            transform: scale(1.02);
        }

        /* Tombol daftar */
        .btn-register {
            background: linear-gradient(135deg, #28a745, #00cc66);
            border: none;
            border-radius: 50px;
            padding: 12px;
            color: #fff;
            font-weight: 600;
            transition: all 0.4s ease;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        .btn-register:hover {
            background: linear-gradient(135deg, #218838, #00b359);
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(0, 255, 128, 0.6);
        }

        .btn-register:active { transform: scale(0.97); }

        /* Link tambahan */
        .extra-links {
            text-align: center;
            margin-top: 15px;
        }

        .extra-links a {
            color: #fff;
            text-decoration: underline;
            transition: color 0.3s;
        }

        .extra-links a:hover {
            color: #ffeb3b;
        }

        /* Logo */
        .logo {
            display: block;
            margin: 0 auto 15px;
            width: 90px;
            height: 90px;
            animation: floatLogo 3s ease-in-out infinite;
        }

        @keyframes floatLogo {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>

<body>
    <div class="register-box">
        <!-- Logo -->
        <img src="{{ asset('images/logoPolije.png') }}" alt="Logo Polije" class="logo">

        <!-- Judul -->
        <h2>Daftar Akun SPI Polije</h2>

        <!-- Error -->
        @if ($errors->any())
            <div class="alert alert-danger animate__animated animate__shakeX">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Register -->
        <form action="{{ route('register.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" required autofocus>
            </div>
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
            </div>
            <button type="submit" class="btn btn-register">Daftar</button>
        </form>

        <!-- Tambahan link -->
        <div class="extra-links">
            <p class="mt-3">Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
