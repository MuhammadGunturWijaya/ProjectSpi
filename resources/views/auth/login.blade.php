<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SPI Polije</title>
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
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* Card login */
        .login-box {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(14px);
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.35);
            color: #fff;
            animation: fadeInUp 1s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-box h2 {
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

        /* Tombol login */
        .btn-login {
            background: linear-gradient(135deg, #0066ff, #0099ff);
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

        .btn-login:hover {
            background: linear-gradient(135deg, #0052cc, #0088cc);
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(0, 153, 255, 0.6);
        }

        .btn-login:active {
            transform: scale(0.97);
        }

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
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }
    </style>
</head>

<body>
    <div class="login-box">
        <!-- Logo -->
        <img src="{{ asset('images/logoPolije.png') }}" alt="Logo Polije" class="logo">

        <!-- Judul -->
        <h2>Login SPI Polije</h2>

        <!-- Pesan error -->
        @if ($errors->any())
            <div class="alert alert-danger animate__animated animate__shakeX">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Pesan sukses -->
        @if (session('success'))
            <div class="alert alert-success animate__animated animate__fadeIn">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form Login -->
        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <!-- fungsi untuk masuk ke url terakhir -->
            @if(request()->has('redirect'))
                <input type="hidden" name="redirect" value="{{ request()->redirect }}">
            @endif
            <button type="submit" class="btn btn-login">Login</button>
        </form>

        <!-- Tambahan link -->
        <div class="extra-links">
            <p class="mt-3"><a href="{{ route('password.request') }}">Lupa Password?</a></p>
            <p>Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>