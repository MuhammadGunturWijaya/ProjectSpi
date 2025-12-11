@extends('layouts.app')

@section('content')
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    
    body {
        min-height: 100vh;
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #c62828 0%, #d32f2f 50%, #e53935 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .verify-container {
        background: #ffffff;
        border-radius: 30px;
        padding: 50px;
        width: 100%;
        max-width: 500px;
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
        text-align: center;
        animation: slideUp 0.8s ease-out;
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(50px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .icon-wrapper {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #c62828 0%, #d32f2f 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
        box-shadow: 0 10px 30px rgba(198, 40, 40, 0.3);
    }

    .icon-wrapper svg {
        width: 50px;
        height: 50px;
        fill: white;
    }

    h2 { font-size: 28px; color: #c62828; margin-bottom: 10px; }
    .subtitle { color: #666; font-size: 15px; margin-bottom: 30px; }
    .email-display { background: #f5f5f5; padding: 12px; border-radius: 10px; color: #c62828; font-weight: 600; margin-bottom: 30px; }

    .otp-inputs {
        display: flex;
        gap: 10px;
        justify-content: center;
        margin-bottom: 30px;
    }

    .otp-input {
        width: 60px;
        height: 70px;
        font-size: 32px;
        text-align: center;
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        background: #fafafa;
        font-weight: 700;
        color: #c62828;
        transition: all 0.3s ease;
    }

    .otp-input:focus {
        border-color: #c62828;
        background: white;
        outline: none;
        box-shadow: 0 0 0 4px rgba(198, 40, 40, 0.1);
        transform: scale(1.05);
    }

    .btn-verify {
        width: 100%;
        background: linear-gradient(135deg, #c62828 0%, #d32f2f 100%);
        border: none;
        border-radius: 14px;
        padding: 15px;
        color: white;
        font-weight: 600;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-bottom: 15px;
    }

    .btn-verify:hover {
        background: linear-gradient(135deg, #d32f2f 0%, #e53935 100%);
        transform: translateY(-3px);
    }

    .btn-resend {
        width: 100%;
        background: transparent;
        border: 2px solid #c62828;
        border-radius: 14px;
        padding: 15px;
        color: #c62828;
        font-weight: 600;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-resend:hover {
        background: #c62828;
        color: white;
    }

    .timer {
        margin-top: 20px;
        color: #666;
        font-size: 14px;
    }

    .timer span {
        color: #c62828;
        font-weight: 600;
    }

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

    .back-link {
        display: block;
        margin-top: 20px;
        color: #c62828;
        text-decoration: none;
        font-weight: 600;
    }

    .back-link:hover { text-decoration: underline; }
</style>

<div class="verify-container">
    <div class="icon-wrapper">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
        </svg>
    </div>

    <h2>Verifikasi Kode OTP</h2>
    <p class="subtitle">Masukkan kode 6 digit yang dikirim ke email Anda</p>

    <div class="email-display">📧 {{ session('email') }}</div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('password.verify-otp') }}" id="otpForm">
        @csrf
        <input type="hidden" name="email" value="{{ session('email') }}">
        <input type="hidden" name="otp" id="otpValue">

        <div class="otp-inputs">
            <input type="text" maxlength="1" class="otp-input" data-index="0" pattern="\d*" inputmode="numeric">
            <input type="text" maxlength="1" class="otp-input" data-index="1" pattern="\d*" inputmode="numeric">
            <input type="text" maxlength="1" class="otp-input" data-index="2" pattern="\d*" inputmode="numeric">
            <input type="text" maxlength="1" class="otp-input" data-index="3" pattern="\d*" inputmode="numeric">
            <input type="text" maxlength="1" class="otp-input" data-index="4" pattern="\d*" inputmode="numeric">
            <input type="text" maxlength="1" class="otp-input" data-index="5" pattern="\d*" inputmode="numeric">
        </div>

        <button type="submit" class="btn-verify">✓ Verifikasi OTP</button>
    </form>

    <form method="POST" action="{{ route('password.resend-otp') }}">
        @csrf
        <input type="hidden" name="email" value="{{ session('email') }}">
        <button type="submit" class="btn-resend">🔄 Kirim Ulang Kode</button>
    </form>

    <div class="timer">
        Kode akan kadaluarsa dalam <span id="countdown">10:00</span>
    </div>

    <a href="{{ route('login') }}" class="back-link">⬅ Kembali ke Login</a>
</div>

<script>
    // OTP Input Handler
    const inputs = document.querySelectorAll('.otp-input');
    const form = document.getElementById('otpForm');
    const otpValue = document.getElementById('otpValue');

    inputs.forEach((input, index) => {
        // Auto focus next input
        input.addEventListener('input', (e) => {
            const value = e.target.value;
            if (value && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
            updateOTPValue();
        });

        // Handle backspace
        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && !e.target.value && index > 0) {
                inputs[index - 1].focus();
            }
        });

        // Only allow numbers
        input.addEventListener('keypress', (e) => {
            if (!/^\d$/.test(e.key)) {
                e.preventDefault();
            }
        });

        // Handle paste
        input.addEventListener('paste', (e) => {
            e.preventDefault();
            const pastedData = e.clipboardData.getData('text').slice(0, 6);
            const digits = pastedData.match(/\d/g);
            if (digits) {
                digits.forEach((digit, i) => {
                    if (inputs[i]) {
                        inputs[i].value = digit;
                    }
                });
                updateOTPValue();
                if (digits.length === 6) {
                    inputs[5].focus();
                }
            }
        });
    });

    function updateOTPValue() {
        const otp = Array.from(inputs).map(input => input.value).join('');
        otpValue.value = otp;
    }

    // Auto submit when all fields filled
    form.addEventListener('input', () => {
        const otp = Array.from(inputs).map(input => input.value).join('');
        if (otp.length === 6) {
            setTimeout(() => form.submit(), 300);
        }
    });

    // Countdown timer
    let timeLeft = 600; // 10 minutes in seconds
    const countdownEl = document.getElementById('countdown');

    const countdown = setInterval(() => {
        timeLeft--;
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        countdownEl.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;

        if (timeLeft <= 0) {
            clearInterval(countdown);
            countdownEl.textContent = 'Kadaluarsa';
            countdownEl.style.color = '#dc3545';
        }
    }, 1000);

    // Focus first input on load
    inputs[0].focus();
</script>
@endsection