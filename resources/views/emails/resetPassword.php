<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #c62828 0%, #d32f2f 100%);
            padding: 40px 30px;
            text-align: center;
            color: white;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }
        .header p {
            margin: 10px 0 0;
            font-size: 14px;
            opacity: 0.9;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
        }
        .message {
            color: #666;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .otp-container {
            background: linear-gradient(135deg, #ffeb3b 0%, #ffc107 100%);
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            margin: 30px 0;
        }
        .otp-label {
            font-size: 14px;
            color: #c62828;
            font-weight: 600;
            margin-bottom: 10px;
        }
        .otp-code {
            font-size: 48px;
            font-weight: 700;
            color: #c62828;
            letter-spacing: 8px;
            margin: 10px 0;
            font-family: 'Courier New', monospace;
        }
        .expiry-note {
            font-size: 13px;
            color: #c62828;
            margin-top: 10px;
        }
        .warning {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .warning-title {
            font-weight: 600;
            color: #856404;
            margin-bottom: 5px;
        }
        .warning-text {
            color: #856404;
            font-size: 14px;
            line-height: 1.5;
        }
        .footer {
            background: #f9f9f9;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #eee;
        }
        .footer p {
            color: #999;
            font-size: 13px;
            margin: 5px 0;
        }
        .footer-logo {
            color: #c62828;
            font-weight: 700;
            font-size: 16px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>🔐 Reset Password</h1>
            <p>Satuan Pengawas Internal - Politeknik Negeri Jember</p>
        </div>
        
        <div class="content">
            <p class="greeting">Halo, <strong>{{ $userName }}</strong>!</p>
            
            <p class="message">
                Kami menerima permintaan untuk reset password akun Anda. 
                Gunakan kode OTP berikut untuk melanjutkan proses reset password:
            </p>
            
            <div class="otp-container">
                <div class="otp-label">KODE OTP ANDA</div>
                <div class="otp-code">{{ $otp }}</div>
                <div class="expiry-note">⏱ Kode berlaku selama 10 menit</div>
            </div>
            
            <div class="warning">
                <div class="warning-title">⚠️ Perhatian Keamanan</div>
                <div class="warning-text">
                    • Jangan bagikan kode OTP ini kepada siapapun<br>
                    • Tim SPI POLIJE tidak akan pernah meminta kode OTP Anda<br>
                    • Jika Anda tidak meminta reset password, abaikan email ini
                </div>
            </div>
            
            <p class="message">
                Jika Anda mengalami kesulitan, silakan hubungi administrator sistem.
            </p>
        </div>
        
        <div class="footer">
            <div class="footer-logo">SPI POLIJE</div>
            <p>Satuan Pengawas Internal</p>
            <p>Politeknik Negeri Jember</p>
            <p style="margin-top: 15px;">Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
        </div>
    </div>
</body>
</html>