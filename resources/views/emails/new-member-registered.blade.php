<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun SPI POLIJE Anda</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .email-body {
            padding: 30px;
            color: #333;
        }
        .credentials-box {
            background: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .credential-item {
            margin: 10px 0;
            padding: 10px;
            background: white;
            border-radius: 5px;
        }
        .credential-label {
            font-weight: 600;
            color: #667eea;
            font-size: 14px;
            margin-bottom: 5px;
        }
        .credential-value {
            font-size: 16px;
            color: #333;
            font-weight: 700;
            word-break: break-all;
        }
        .btn-login {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            margin: 20px 0;
        }
        .warning-box {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
            color: #856404;
        }
        .email-footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #6c757d;
            font-size: 14px;
        }
        .icon {
            font-size: 48px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <div class="icon">🎉</div>
            <h1>Selamat Datang di SPI POLIJE!</h1>
        </div>

        <div class="email-body">
            <p>Halo <strong>{{ $memberData['name'] }}</strong>,</p>
            
            <p>Akun Anda telah berhasil dibuat oleh Administrator SPI POLIJE. Berikut adalah informasi login Anda:</p>

            <div class="credentials-box">
                <div class="credential-item">
                    <div class="credential-label">👤 Nama Lengkap</div>
                    <div class="credential-value">{{ $memberData['name'] }}</div>
                </div>

                <div class="credential-item">
                    <div class="credential-label">✉️ Email / Username</div>
                    <div class="credential-value">{{ $memberData['email'] }}</div>
                </div>

                <div class="credential-item">
                    <div class="credential-label">🔑 Password</div>
                    <div class="credential-value">{{ $memberData['password'] }}</div>
                </div>

                <div class="credential-item">
                    <div class="credential-label">🏷️ Kode Pegawai</div>
                    <div class="credential-value">{{ $memberData['pegawai_code'] }}</div>
                </div>

                <div class="credential-item">
                    <div class="credential-label">👔 Role / Jabatan</div>
                    <div class="credential-value">{{ $memberData['role'] }}</div>
                </div>
            </div>

            <div class="warning-box">
                <strong>⚠️ Penting untuk Keamanan Akun Anda:</strong>
                <ul style="margin: 10px 0; padding-left: 20px;">
                    <li>Segera ubah password Anda setelah login pertama kali</li>
                    <li>Jangan bagikan password Anda kepada siapapun</li>
                    <li>Gunakan password yang kuat dan unik</li>
                </ul>
            </div>

            <center>
                <a href="{{ $memberData['login_url'] }}" class="btn-login">
                    🚀 Login Sekarang
                </a>
            </center>

            <p style="margin-top: 30px;">Jika Anda memiliki pertanyaan atau mengalami kesulitan, silakan hubungi Administrator SPI POLIJE.</p>

            <p style="margin-top: 20px;">
                Terima kasih,<br>
                <strong>Tim SPI POLIJE</strong>
            </p>
        </div>

        <div class="email-footer">
            <p>Email ini dikirim secara otomatis oleh sistem SPI POLIJE</p>
            <p style="margin: 5px 0;">© {{ date('Y') }} SPI POLIJE - Politeknik Negeri Jember</p>
        </div>
    </div>
</body>
</html>