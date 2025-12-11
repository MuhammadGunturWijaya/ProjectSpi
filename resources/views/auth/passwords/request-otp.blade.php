@extends('layouts.app')

@section('content')
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
        overflow: hidden;
    }

    .bg-decoration {
        position: fixed;
        border-radius: 50%;
        opacity: 0.1;
        animation: float 20s infinite ease-in-out;
    }

    .circle-1 { width: 400px; height: 400px; background: #ffeb3b; top: -150px; right: -150px; }
    .circle-2 { width: 300px; height: 300px; background: #ffffff; bottom: -100px; left: -100px; animation-delay: 2s; }
    .circle-3 { width: 200px; height: 200px; background: #ffeb3b; top: 40%; right: 15%; animation-delay: 4s; }
    .circle-4 { width: 150px; height: 150px; background: #ffffff; bottom: 30%; left: 10%; animation-delay: 6s; }

    @keyframes float {
        0%, 100% { transform: translate(0, 0) rotate(0deg); }
        33% { transform: translate(40px, -40px) rotate(120deg); }
        66% { transform: translate(-30px, 30px) rotate(240deg); }
    }

    .login-container {
        background: #ffffff;
        border-radius: 30px;
        padding: 0;
        width: 100%;
        max-width: 900px;
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        animation: slideUp 0.8s ease-out;
        display: grid;
        grid-template-columns: 1fr 1fr;
        position: relative;
        z-index: 1;
        min-height: 500px;
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(50px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .brand-panel {
        background: linear-gradient(135deg, #b71c1c 0%, #c62828 50%, #d32f2f 100%);
        padding: 60px 50px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .logo {
        width: 120px;
        height: 120px;
        background: white;
        border-radius: 50%;
        padding: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        margin-bottom: 30px;
    }

    .brand-text h1 { font-size: 32px; font-weight: 700; margin-bottom: 12px; }
    .brand-text p { font-size: 14px; margin-bottom: 5px; }
    .tagline { font-size: 13px; margin-top: 20px; padding: 15px; background: rgba(255, 255, 255, 0.1); border-radius: 12px; }
    .highlight { color: #ffeb3b; font-weight: 600; }

    .form-panel {
        padding: 60px 50px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .form-header h2 { font-size: 28px; font-weight: 700; color: #c62828; margin-bottom: 10px; }
    .form-header p { color: #666; font-size: 15px; margin-bottom: 30px; }

    .alert {
        padding: 15px;
        border-radius: 12px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .alert-success {
        background: #d4edda;
        border-left: 4px solid #28a745;
        color: #155724;
    }

    .alert-error {
        background: #f8d7da;
        border-left: 4px solid #dc3545;
        color: #721c24;
    }

    .input-wrapper { margin-bottom: 20px; }
    .input-label { display: block; font-size: 13px; font-weight: 600; color: #c62828; margin-bottom: 8px; }

    .form-control {
        width: 100%;
        border: 2px solid #e0e0e0;
        border-radius: 14px;
        padding: 15px;
        background: #fafafa;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #c62828;
        background: white;
        outline: none;
        box-shadow: 0 0 0 4px rgba(198, 40, 40, 0.1);
    }

    .btn-login {
        width: 100%;
        background: linear-gradient(135deg, #c62828 0%, #d32f2f 100%);
        border: none;
        border-radius: 14px;
        padding: 15px;
        color: white;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s ease;
        cursor: pointer;
        text-align: center;
        display: block;
        text-decoration: none;
    }

    .btn-login:hover {
        background: linear-gradient(135deg, #d32f2f 0%, #e53935 100%);
        transform: translateY(-3px);
    }

    .form-footer {
        text-align: center;
        margin-top: 20px;
        font-size: 14px;
    }

    .form-footer a {
        color: #c62828;
        font-weight: 600;
        text-decoration: none;
    }

    .form-footer a:hover {
        color: #d32f2f;
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .login-container {
            grid-template-columns: 1fr;
            max-width: 500px;
        }
        .brand-panel, .form-panel { padding: 40px 30px; }
    }
</style>

<div class="bg-decoration circle-1"></div>
<div class="bg-decoration circle-2"></div>
<div class="bg-decoration circle-3"></div>
<div class="bg-decoration circle-4"></div>

<div class="login-container">
    <div class="brand-panel">
        <div class="logo">
            <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <circle cx="50" cy="50" r="45" fill="#c62828" />
                <text x="50" y="65" font-size="40" font-weight="bold" fill="#ffeb3b" text-anchor="middle">P</text>
            </svg>
        </div>
        <div class="brand-text">
            <h1>Lupa Password?</h1>
            <p>Satuan Pengawas Internal</p>
            <p>Politeknik Negeri Jember</p>
            <div class="tagline">
                Masukkan email Anda untuk menerima <span class="highlight">Kode OTP</span> reset password
            </div>
        </div>
    </div>

    <div class="form-panel">
        <div class="form-header">
            <h2>Reset Password</h2>
            <p>Kami akan mengirimkan kode OTP ke email Anda</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('password.send-otp') }}">
            @csrf
            <div class="input-wrapper">
                <label class="input-label">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                    class="form-control @error('email') is-invalid @enderror" 
                    placeholder="nama@email.com" required autofocus>
                @error('email')
                    <div style="color: #dc3545; font-size: 13px; margin-top: 8px;">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn-login">🔐 Kirim Kode OTP</button>
        </form>

        <div class="form-footer">
            <p><a href="{{ route('login') }}">⬅ Kembali ke Login</a></p>
        </div>
    </div>
</div>
@endsection