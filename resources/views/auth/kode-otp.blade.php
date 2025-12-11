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
            background: linear-gradient(135deg, #0d47a1 0%, #1976d2 50%, #2196f3 100%);
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
            background: #4fc3f7;
            top: -150px;
            right: -150px;
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
            background: #4fc3f7;
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
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(40px, -40px) rotate(120deg); }
            66% { transform: translate(-30px, 30px) rotate(240deg); }
        }

        /* Main Container */
        .otp-container {
            background: #ffffff;
            border-radius: 30px;
            padding: 0;
            width: 100%;
            max-width: 800px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3),
                0 15px 30px rgba(13, 71, 161, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.8);
            overflow: hidden;
            animation: slideUp 0.8s ease-out;
            display: grid;
            grid-template-columns: 1fr 1fr;
            position: relative;
            z-index: 1;
            min-height: 500px;
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

        /* Left Panel */
        .info-panel {
            background: linear-gradient(135deg, #0d47a1 0%, #1976d2 50%, #2196f3 100%);
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .icon-wrapper {
            margin-bottom: 30px;
            position: relative;
        }

        .otp-icon {
            width: 120px;
            height: 120px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3), 0 8px 20px rgba(13, 71, 161, 0.4);
            animation: pulse 2s ease-in-out infinite;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .otp-icon svg {
            width: 60px;
            height: 60px;
            fill: white;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .info-text h1 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 12px;
            text-align: center;
        }

        .info-text p {
            font-size: 14px;
            margin-bottom: 5px;
            text-align: center;
        }

        .instructions {
            font-size: 13px;
            margin-top: 20px;
            padding: 15px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            text-align: center;
        }

        .highlight {
            color: #ffeb3b;
            font-weight: 600;
        }

        /* Right Panel */
        .form-panel {
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-header h2 {
            font-size: 28px;
            font-weight: 700;
            color: #1976d2;
            margin-bottom: 10px;
        }

        .form-header p {
            color: #666;
            font-size: 15px;
            margin-bottom: 30px;
        }

        .email-info {
            background: #f0f7ff;
            border: 1px solid #bbdefb;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 25px;
            text-align: center;
        }

        .email-info .email {
            font-weight: 600;
            color: #1976d2;
        }

        /* OTP Input Styling */
        .otp-input-wrapper {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            margin: 25px 0;
        }

        .otp-input {
            width: 60px;
            height: 70px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 32px;
            font-weight: bold;
            text-align: center;
            background: #fafafa;
            color: #1976d2;
            transition: all 0.3s ease;
            outline: none;
        }

        .otp-input:focus {
            border-color: #1976d2;
            background: white;
            box-shadow: 0 0 0 3px rgba(25, 118, 210, 0.1);
            transform: translateY(-2px);
        }

        .otp-input.filled {
            border-color: #4caf50;
            background: #f1f8e9;
        }

        .timer {
            text-align: center;
            font-size: 14px;
            color: #666;
            margin: 15px 0;
        }

        .timer .time {
            font-weight: 600;
            color: #1976d2;
        }

        .timer.expired .time {
            color: #f44336;
        }

        .btn-verify {
            width: 100%;
            background: linear-gradient(135deg, #1976d2 0%, #2196f3 100%);
            border: none;
            border-radius: 14px;
            padding: 15px;
            color: white;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn-verify:hover:not(:disabled) {
            background: linear-gradient(135deg, #2196f3 0%, #42a5f5 100%);
            transform: translateY(-3px);
        }

        .btn-verify:disabled {
            background: #bdbdbd;
            cursor: not-allowed;
            transform: none;
        }

        .resend-section {
            text-align: center;
            margin-top: 20px;
        }

        .resend-link {
            color: #1976d2;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .resend-link:hover {
            color: #ff9800;
            text-decoration: underline;
        }

        .resend-link:disabled {
            color: #bdbdbd;
            cursor: not-allowed;
            text-decoration: none;
        }

        .form-footer {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
        }

        .form-footer a {
            color: #1976d2;
            font-weight: 600;
            text-decoration: none;
        }

        .form-footer a:hover {
            color: #ff9800;
            text-decoration: underline;
        }

        /* Status Messages */
        .alert {
            padding: 12px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: center;
        }

        .alert-success {
            background: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #a5d6a7;
        }

        .alert-error {
            background: #ffebee;
            color: #c62828;
            border: 1px solid #ef9a9a;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .otp-container {
                grid-template-columns: 1fr;
                max-width: 500px;
            }

            .info-panel {
                padding: 40px 30px;
            }

            .form-panel {
                padding: 40px 30px;
            }

            .otp-input-wrapper {
                gap: 10px;
            }

            .otp-input {
                width: 50px;
                height: 60px;
                font-size: 28px;
            }
        }

        @media (max-width: 480px) {
            .otp-input-wrapper {
                gap: 8px;
            }

            .otp-input {
                width: 45px;
                height: 55px;
                font-size: 24px;
            }
        }
    </style>

    <!-- Background Decorations -->
    <div class="bg-decoration circle-1"></div>
    <div class="bg-decoration circle-2"></div>
    <div class="bg-decoration circle-3"></div>
    <div class="bg-decoration circle-4"></div>

    <div class="otp-container">
        <!-- Left Panel -->
        <div class="info-panel">
            <div class="icon-wrapper">
                <div class="otp-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M12,17A2,2 0 0,0 14,15C14,13.89 13.1,13 12,13A2,2 0 0,0 10,15A2,2 0 0,0 12,17M18,8A2,2 0 0,1 20,10V20A2,2 0 0,1 18,22H6A2,2 0 0,1 4,20V10C4,8.89 4.9,8 6,8H7V6A5,5 0 0,1 12,1A5,5 0 0,1 17,6V8H18M12,3A3,3 0 0,0 9,6V8H15V6A3,3 0 0,0 12,3Z" />
                    </svg>
                </div>
            </div>
            <div class="info-text">
                <h1>Verifikasi OTP</h1>
                <p>Satuan Pengawas Internal</p>
                <p>Politeknik Negeri Jember</p>
                <div class="instructions">
                    Masukkan <span class="highlight">6 digit kode</span> yang telah dikirim ke email Anda untuk melanjutkan reset password
                </div>
            </div>
        </div>

        <!-- Right Panel -->
        <div class="form-panel">
            <div class="form-header">
                <h2>Masukkan Kode OTP</h2>
                <p>Kode verifikasi telah dikirim ke email Anda</p>
            </div>

            <div class="email-info">
                <p>Kode dikirim ke: <span class="email">{{ $email ?? 'user@email.com' }}</span></p>
            </div>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('password.verify.otp') }}" id="otpForm">
                @csrf
                <input type="hidden" name="email" value="{{ $email ?? old('email') }}">

                <div class="otp-input-wrapper">
                    @for ($i = 1; $i <= 6; $i++)
                        <input type="text" 
                               class="otp-input" 
                               id="otp-{{ $i }}" 
                               name="otp[]" 
                               maxlength="1" 
                               oninput="moveToNext(this, {{ $i }})" 
                               onkeydown="handleBackspace(event, {{ $i }})"
                               autocomplete="off">
                    @endfor
                </div>

                <div id="timer" class="timer">
                    Kode OTP akan kadaluarsa dalam: <span class="time">05:00</span>
                </div>

                <button type="submit" class="btn-verify" id="verifyBtn" disabled>
                    Verifikasi Kode
                </button>

                <div class="resend-section">
                    <p>Tidak menerima kode? 
                        <a href="#" class="resend-link" id="resendLink" onclick="resendOTP()">
                            Kirim ulang OTP
                        </a>
                    </p>
                </div>
            </form>

            <div class="form-footer">
                <p><a href="{{ route('password.request') }}">⬅ Kembali ke Lupa Password</a></p>
            </div>
        </div>
    </div>

    <script>
        // Auto-focus first OTP input
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('otp-1').focus();
            startTimer(300); // 5 minutes in seconds
            validateOTP();
        });

        // Move to next input on input
        function moveToNext(input, current) {
            // Allow only numbers
            input.value = input.value.replace(/[^0-9]/g, '');
            
            if (input.value.length === 1 && current < 6) {
                document.getElementById('otp-' + (current + 1)).focus();
            }
            
            validateOTP();
            updateInputStyles();
        }

        // Handle backspace key
        function handleBackspace(event, current) {
            if (event.key === 'Backspace' && !event.target.value && current > 1) {
                document.getElementById('otp-' + (current - 1)).focus();
            }
            validateOTP();
            updateInputStyles();
        }

        // Update input styles based on content
        function updateInputStyles() {
            for (let i = 1; i <= 6; i++) {
                const input = document.getElementById('otp-' + i);
                if (input.value) {
                    input.classList.add('filled');
                } else {
                    input.classList.remove('filled');
                }
            }
        }

        // Validate if all OTP fields are filled
        function validateOTP() {
            let allFilled = true;
            for (let i = 1; i <= 6; i++) {
                if (!document.getElementById('otp-' + i).value) {
                    allFilled = false;
                    break;
                }
            }
            
            document.getElementById('verifyBtn').disabled = !allFilled;
            return allFilled;
        }

        // Timer functionality
        function startTimer(duration) {
            let timer = duration;
            const timerElement = document.getElementById('timer');
            const timeElement = timerElement.querySelector('.time');
            const resendLink = document.getElementById('resendLink');
            
            const interval = setInterval(function() {
                const minutes = Math.floor(timer / 60);
                const seconds = timer % 60;
                
                timeElement.textContent = 
                    minutes.toString().padStart(2, '0') + ':' + 
                    seconds.toString().padStart(2, '0');
                
                if (--timer < 0) {
                    clearInterval(interval);
                    timerElement.classList.add('expired');
                    timeElement.textContent = '00:00';
                    resendLink.disabled = false;
                    timerElement.innerHTML = 'Kode OTP telah kadaluarsa. ';
                    timerElement.innerHTML += '<a href="#" class="resend-link" onclick="resendOTP()">Kirim ulang</a>';
                } else if (timer < 60) {
                    // Last minute warning
                    timerElement.classList.add('expired');
                }
            }, 1000);
        }

        // Resend OTP function
        function resendOTP() {
            const email = "{{ $email ?? '' }}";
            const resendLink = document.getElementById('resendLink');
            const timerElement = document.getElementById('timer');
            
            if (resendLink.disabled) return;
            
            // Disable resend link temporarily
            resendLink.disabled = true;
            resendLink.textContent = 'Mengirim ulang...';
            
            // Send AJAX request to resend OTP
            fetch('{{ route("password.resend.otp") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ email: email })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Kode OTP baru telah dikirim ke email Anda.');
                    
                    // Reset timer
                    timerElement.classList.remove('expired');
                    timerElement.innerHTML = 'Kode OTP akan kadaluarsa dalam: <span class="time">05:00</span>';
                    startTimer(300);
                    
                    // Clear OTP inputs
                    for (let i = 1; i <= 6; i++) {
                        document.getElementById('otp-' + i).value = '';
                    }
                    document.getElementById('otp-1').focus();
                    updateInputStyles();
                    validateOTP();
                } else {
                    alert('Gagal mengirim ulang OTP. Silakan coba lagi.');
                }
                
                // Re-enable resend link after 30 seconds
                setTimeout(() => {
                    resendLink.disabled = false;
                    resendLink.textContent = 'Kirim ulang OTP';
                }, 30000);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan. Silakan coba lagi.');
                resendLink.disabled = false;
                resendLink.textContent = 'Kirim ulang OTP';
            });
        }

        // Handle form submission
        document.getElementById('otpForm').addEventListener('submit', function(e) {
            if (!validateOTP()) {
                e.preventDefault();
                alert('Harap masukkan semua digit kode OTP.');
                return;
            }
            
            // Combine OTP inputs into single value
            let otpValue = '';
            for (let i = 1; i <= 6; i++) {
                otpValue += document.getElementById('otp-' + i).value;
            }
            
            // Add hidden input with complete OTP
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'otp_code';
            hiddenInput.value = otpValue;
            this.appendChild(hiddenInput);
            
            // Disable verify button during submission
            document.getElementById('verifyBtn').disabled = true;
            document.getElementById('verifyBtn').textContent = 'Memverifikasi...';
        });
    </script>
@endsection