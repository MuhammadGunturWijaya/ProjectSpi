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
        }

        .reset-container {
            background: #ffffff;
            border-radius: 30px;
            padding: 50px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .icon-wrapper {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            box-shadow: 0 10px 30px rgba(40, 167, 69, 0.3);
        }

        .icon-wrapper svg {
            width: 50px;
            height: 50px;
            stroke: white;
            fill: none;
            stroke-width: 2;
        }

        h2 {
            font-size: 28px;
            color: #c62828;
            margin-bottom: 10px;
            text-align: center;
        }

        .subtitle {
            color: #666;
            font-size: 15px;
            margin-bottom: 30px;
            text-align: center;
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

        .input-wrapper {
            margin-bottom: 20px;
            position: relative;
        }

        .input-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #c62828;
            margin-bottom: 8px;
        }

        .password-wrapper {
            position: relative;
        }

        .form-control {
            width: 100%;
            border: 2px solid #e0e0e0;
            border-radius: 14px;
            padding: 15px;
            padding-right: 50px;
            background: #fafafa;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #c62828;
            background: white;
            outline: none;
            box-shadow: 0 0 0 4px rgba(198, 40, 40, 0.1);
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #999;
            padding: 5px;
        }

        .toggle-password:hover {
            color: #c62828;
        }

        .password-strength {
            margin-top: 10px;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 12px;
            display: none;
        }

        .password-strength.weak {
            background: #f8d7da;
            color: #721c24;
            display: block;
        }

        .password-strength.medium {
            background: #fff3cd;
            color: #856404;
            display: block;
        }

        .password-strength.strong {
            background: #d4edda;
            color: #155724;
            display: block;
        }

        .password-requirements {
            font-size: 12px;
            color: #666;
            margin-top: 8px;
            line-height: 1.6;
        }

        .password-requirements li {
            margin-bottom: 4px;
        }

        .requirement-met {
            color: #28a745;
        }

        .btn-reset {
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
            margin-top: 10px;
        }

        .btn-reset:hover {
            background: linear-gradient(135deg, #d32f2f 0%, #e53935 100%);
            transform: translateY(-3px);
        }

        .back-link {
            display: block;
            margin-top: 20px;
            color: #c62828;
            text-decoration: none;
            font-weight: 600;
            text-align: center;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>

    <div class="reset-container">
        <div class="icon-wrapper">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
        </div>

        <h2>Buat Password Baru</h2>
        <p class="subtitle">OTP terverifikasi! Silakan buat password baru Anda</p>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('password.reset') }}" id="resetForm">
            @csrf

            <input type="hidden" name="email" value="{{ session('email') }}">
            <input type="hidden" name="otp_verified" value="{{ session('otp_verified') }}">


            <div class="input-wrapper">
                <label class="input-label">Password Baru</label>
                <div class="password-wrapper">
                    <input id="password" type="password" name="password"
                        class="form-control @error('password') is-invalid @enderror" placeholder="Minimal 8 karakter"
                        required>
                    <button type="button" class="toggle-password" onclick="togglePassword('password')">
                        👁️
                    </button>
                </div>
                <div class="password-strength" id="passwordStrength"></div>
                <ul class="password-requirements" id="passwordRequirements">
                    <li id="req-length">❌ Minimal 8 karakter</li>
                    <li id="req-uppercase">❌ Minimal 1 huruf besar</li>
                    <li id="req-lowercase">❌ Minimal 1 huruf kecil</li>
                    <li id="req-number">❌ Minimal 1 angka</li>
                </ul>
                @error('password')
                    <div style="color: #dc3545; font-size: 13px; margin-top: 8px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-wrapper">
                <label class="input-label">Konfirmasi Password</label>
                <div class="password-wrapper">
                    <input id="password_confirmation" type="password" name="password_confirmation"
                        class="form-control @error('password_confirmation') is-invalid @enderror"
                        placeholder="Ulangi password" required>
                    <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation')">
                        👁️
                    </button>
                </div>
                <div id="passwordMatch" style="font-size: 12px; margin-top: 8px;"></div>
                @error('password_confirmation')
                    <div style="color: #dc3545; font-size: 13px; margin-top: 8px;">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-reset" id="submitBtn" disabled>🔒 Reset Password</button>
        </form>

        <a href="{{ route('login') }}" class="back-link">⬅ Kembali ke Login</a>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const confirmInput = document.getElementById('password_confirmation');
        const strengthDiv = document.getElementById('passwordStrength');
        const matchDiv = document.getElementById('passwordMatch');
        const submitBtn = document.getElementById('submitBtn');

        function togglePassword(id) {
            const input = document.getElementById(id);
            input.type = input.type === 'password' ? 'text' : 'password';
        }

        function checkPasswordStrength(password) {
            let strength = 0;
            const requirements = {
                length: password.length >= 8,
                uppercase: /[A-Z]/.test(password),
                lowercase: /[a-z]/.test(password),
                number: /[0-9]/.test(password)
            };

            // Update requirements display
            document.getElementById('req-length').innerHTML =
                requirements.length ? '✓ Minimal 8 karakter' : '❌ Minimal 8 karakter';
            document.getElementById('req-length').className = requirements.length ? 'requirement-met' : '';

            document.getElementById('req-uppercase').innerHTML =
                requirements.uppercase ? '✓ Minimal 1 huruf besar' : '❌ Minimal 1 huruf besar';
            document.getElementById('req-uppercase').className = requirements.uppercase ? 'requirement-met' : '';

            document.getElementById('req-lowercase').innerHTML =
                requirements.lowercase ? '✓ Minimal 1 huruf kecil' : '❌ Minimal 1 huruf kecil';
            document.getElementById('req-lowercase').className = requirements.lowercase ? 'requirement-met' : '';

            document.getElementById('req-number').innerHTML =
                requirements.number ? '✓ Minimal 1 angka' : '❌ Minimal 1 angka';
            document.getElementById('req-number').className = requirements.number ? 'requirement-met' : '';

            // Calculate strength
            Object.values(requirements).forEach(met => {
                if (met) strength++;
            });

            return { strength, requirements };
        }

        passwordInput.addEventListener('input', (e) => {
            const { strength, requirements } = checkPasswordStrength(e.target.value);

            strengthDiv.className = 'password-strength';
            if (e.target.value.length === 0) {
                strengthDiv.style.display = 'none';
            } else if (strength <= 2) {
                strengthDiv.className += ' weak';
                strengthDiv.textContent = '⚠️ Password lemah';
            } else if (strength === 3) {
                strengthDiv.className += ' medium';
                strengthDiv.textContent = '⚡ Password sedang';
            } else {
                strengthDiv.className += ' strong';
                strengthDiv.textContent = '✓ Password kuat';
            }

            checkFormValidity();
        });

        confirmInput.addEventListener('input', () => {
            checkFormValidity();
        });

        function checkFormValidity() {
            const password = passwordInput.value;
            const confirm = confirmInput.value;
            const { strength, requirements } = checkPasswordStrength(password);

            if (confirm.length > 0) {
                if (password === confirm) {
                    matchDiv.style.color = '#28a745';
                    matchDiv.textContent = '✓ Password cocok';
                } else {
                    matchDiv.style.color = '#dc3545';
                    matchDiv.textContent = '❌ Password tidak cocok';
                }
            } else {
                matchDiv.textContent = '';
            }

            // Enable submit button only if all conditions met
            const allRequirementsMet = Object.values(requirements).every(met => met);
            const passwordsMatch = password === confirm && confirm.length > 0;

            submitBtn.disabled = !(allRequirementsMet && passwordsMatch);
        }
    </script>
@endsection