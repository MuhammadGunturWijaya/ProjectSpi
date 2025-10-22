@extends('layouts.app')
<style>
    body {
                   overflow-x: hidden;
        }
</style>
@section('content')
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
        min-height: 100vh; font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #c62828 0%, #d32f2f 50%, #e53935 100%);
        display: flex; align-items: center; justify-content: center;
        padding: 20px; position: relative; overflow: hidden;
    }

    /* Background animasi */
    .bg-decoration { position: fixed; border-radius: 50%; opacity: 0.1; animation: float 20s infinite ease-in-out; }
    .circle-1 { width: 400px; height: 400px; background: #ffeb3b; top: -150px; right: -150px; }
    .circle-2 { width: 300px; height: 300px; background: #ffffff; bottom: -100px; left: -100px; animation-delay: 2s; }
    .circle-3 { width: 200px; height: 200px; background: #ffeb3b; top: 40%; right: 15%; animation-delay: 4s; }
    .circle-4 { width: 150px; height: 150px; background: #ffffff; bottom: 30%; left: 10%; animation-delay: 6s; }
    @keyframes float {
        0%,100% { transform: translate(0,0) rotate(0deg); }
        33% { transform: translate(40px,-40px) rotate(120deg); }
        66% { transform: translate(-30px,30px) rotate(240deg); }
    }

    /* Container */
    .login-container {
        background: #ffffff; border-radius: 30px;
        width: 100%; max-width: 900px; min-height: 520px;
        box-shadow: 0 30px 60px rgba(0,0,0,0.3),
                    0 15px 30px rgba(198,40,40,0.2),
                    inset 0 1px 0 rgba(255,255,255,0.8);
        overflow: hidden; display: grid; grid-template-columns: 1fr 1fr;
        animation: slideUp 0.8s ease-out; position: relative; z-index: 1;
    }
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(50px) rotateX(10deg); }
        to { opacity: 1; transform: translateY(0) rotateX(0deg); }
    }

    /* Left Panel */
    .brand-panel {
        background: linear-gradient(135deg,#b71c1c 0%,#c62828 50%,#d32f2f 100%);
        padding: 60px 50px; color: white;
        display: flex; flex-direction: column; align-items: center; justify-content: center;
    }
    .logo-wrapper { margin-bottom: 30px; }
    .logo {
        width: 120px; height: 120px; background: white; border-radius: 50%; padding: 20px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.3),0 8px 20px rgba(198,40,40,0.4);
        animation: logoFloat 3s ease-in-out infinite;
    }
    @keyframes logoFloat { 0%,100% { transform: translateY(0);} 50% { transform: translateY(-10px);} }
    .brand-text h1 { font-size: 32px; font-weight: 700; margin-bottom: 12px; }
    .brand-text p { font-size: 14px; margin-bottom: 5px; }
    .tagline {
        font-size: 13px; margin-top: 20px; padding: 15px;
        background: rgba(255,255,255,0.1); border-radius: 12px;
    }
    .highlight { color: #ffeb3b; font-weight: 600; }

    /* Right Panel */
    .form-panel { padding: 60px 50px; display: flex; flex-direction: column; justify-content: center; }
    .form-header h2 { font-size: 28px; font-weight: 700; color: #c62828; margin-bottom: 10px; }
    .form-header p { color: #666; font-size: 15px; margin-bottom: 30px; }

    .input-wrapper { margin-bottom: 20px; }
    .input-label { font-size: 13px; font-weight: 600; color: #c62828; margin-bottom: 8px; display: block; }
    .form-control {
        border: 2px solid #e0e0e0; border-radius: 14px; padding: 14px;
        background: #fafafa; transition: all 0.3s ease;
    }
    .form-control:focus {
        border-color: #c62828; background: white; outline: none;
        box-shadow: 0 0 0 4px rgba(198,40,40,0.1);
    }

    .btn-login {
        width: 100%; background: linear-gradient(135deg,#c62828 0%,#d32f2f 100%);
        border: none; border-radius: 14px; padding: 15px;
        color: white; font-weight: 600; font-size: 16px;
        transition: all 0.3s ease; cursor: pointer;
    }
    .btn-login:hover { background: linear-gradient(135deg,#d32f2f 0%,#e53935 100%); transform: translateY(-3px); }

    .form-footer { text-align: center; margin-top: 20px; font-size: 14px; }
    .form-footer a { color: #c62828; font-weight: 600; text-decoration: none; }
    .form-footer a:hover { color: #ffeb3b; text-decoration: underline; }

    /* Responsive */
    @media(max-width:768px){
        .login-container { grid-template-columns: 1fr; max-width: 500px; }
        .brand-panel { padding: 40px 30px; }
        .form-panel { padding: 40px 30px; }
    }
</style>

<!-- Background Decorations -->
<div class="bg-decoration circle-1"></div>
<div class="bg-decoration circle-2"></div>
<div class="bg-decoration circle-3"></div>
<div class="bg-decoration circle-4"></div>

<div class="login-container">
    <!-- Left Panel -->
    <div class="brand-panel">
        <div class="logo-wrapper">
            <div class="logo">
                <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="50" cy="50" r="45" fill="#c62828"/>
                    <text x="50" y="65" font-size="40" font-weight="bold" fill="#ffeb3b" text-anchor="middle">P</text>
                </svg>
            </div>
        </div>
        <div class="brand-text">
            <h1>Reset Password</h1>
            <p>Satuan Pengawas Internal</p>
            <p>Politeknik Negeri Jember</p>
            <div class="tagline">
                Masukkan password baru Anda untuk <span class="highlight">mengatur ulang akun</span>
            </div>
        </div>
    </div>

    <!-- Right Panel -->
    <div class="form-panel">
        <div class="form-header">
            <h2>Atur Ulang Password</h2>
            <p>Silakan masukkan password baru Anda</p>
        </div>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="input-wrapper">
                <label class="input-label">Email Anda</label>
                <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}" placeholder="nama@email.com" required>
                @error('email') <div class="text-danger small mt-2">{{ $message }}</div> @enderror
            </div>

            <div class="input-wrapper">
                <label class="input-label">Password Baru</label>
                <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                       placeholder="Masukkan password baru" required>
                @error('password') <div class="text-danger small mt-2">{{ $message }}</div> @enderror
            </div>

            <div class="input-wrapper">
                <label class="input-label">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control"
                       placeholder="Ulangi password baru" required>
            </div>

            <button type="submit" class="btn-login">Reset Password</button>
        </form>

        <div class="form-footer">
            <p><a href="{{ route('login') }}">⬅ Kembali ke Login</a></p>
        </div>
    </div>
</div>
@endsection
