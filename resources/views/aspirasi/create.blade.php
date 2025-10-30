<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aspirasi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }

        .aspirasi-container {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 60px 0;
        }

        .form-card {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px 30px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .form-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: pulse 4s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        .form-header h3 {
            font-size: 2rem;
            font-weight: 700;
            margin: 0 0 10px 0;
            position: relative;
            z-index: 1;
        }

        .form-header p {
            margin: 0;
            opacity: 0.95;
            font-size: 1.05rem;
            position: relative;
            z-index: 1;
        }

        .header-icon {
            font-size: 3.5rem;
            margin-bottom: 15px;
            display: inline-block;
            animation: bounce 2s ease-in-out infinite;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .form-body {
            padding: 40px;
        }

        .form-label {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 8px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-label i {
            color: #667eea;
            font-size: 1.1rem;
        }

        .form-control,
        .form-select {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px 16px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .form-control:hover,
        .form-select:hover {
            border-color: #cbd5e0;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        .file-upload-wrapper {
            position: relative;
            background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
            border: 2px dashed #cbd5e0;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .file-upload-wrapper:hover {
            border-color: #667eea;
            background: linear-gradient(135deg, #edf2f7 0%, #e2e8f0 100%);
        }

        .file-upload-wrapper input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .upload-icon {
            font-size: 3rem;
            color: #667eea;
            margin-bottom: 10px;
        }

        .btn-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            padding: 14px 40px;
            font-weight: 600;
            font-size: 1.05rem;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 25px rgba(102, 126, 234, 0.5);
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            color: white;
        }

        .btn-back {
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px 40px;
            font-weight: 600;
            font-size: 1.05rem;
            color: #4a5568;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-back:hover {
            border-color: #cbd5e0;
            background: #f7fafc;
            transform: translateY(-3px);
            color: #2d3748;
        }

        .alert {
            border-radius: 12px;
            border: none;
            padding: 16px 20px;
            animation: slideDown 0.5s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(72, 187, 120, 0.3);
        }

        @media (max-width: 768px) {
            .aspirasi-container {
                padding: 30px 0;
            }

            .form-body {
                padding: 25px;
            }

            .form-header h3 {
                font-size: 1.5rem;
            }

            .header-icon {
                font-size: 2.5rem;
            }

            .btn-submit,
            .btn-back {
                width: 100%;
                margin-bottom: 10px;
            }

            .btn-back {
                margin-left: 0 !important;
            }
        }

        .report-icon {
            font-size: 5rem;
            margin-bottom: 30px;
            animation: bounce 2s infinite;
        }

        .report-icon {
            font-size: 4rem;
            color: #ffffffff;
            margin-bottom: 20px;
            animation: floatIcon 3s ease-in-out infinite;
        }

        @keyframes floatIcon {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }
        }
    </style>
</head>

<body>
    @include('layouts.navbar')

    <div class="aspirasi-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="form-card">
                        <div class="form-header">
                            <div class="report-icon">
                                <i class="bi bi-chat-left-text-fill"></i>
                            </div>
                            <h3>Formulir Aspirasi & Kritik</h3>
                            <p>Sampaikan aspirasi, kritik, dan saran Anda untuk kemajuan bersama</p>
                        </div>

                        <div class="form-body">
                            @if(session('success'))
                                <div class="alert alert-success mb-4">
                                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ route('aspirasi.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-4">
                                    <label for="judul" class="form-label">
                                        <i class="bi bi-pencil-square"></i>
                                        Judul Aspirasi
                                    </label>
                                    <input type="text" name="judul" id="judul" class="form-control"
                                        placeholder="Tuliskan judul aspirasi Anda..." required>
                                </div>

                                <div class="mb-4">
                                    <label for="keterangan" class="form-label">
                                        <i class="bi bi-card-text"></i>
                                        Keterangan Detail
                                    </label>
                                    <textarea name="keterangan" id="keterangan" class="form-control" rows="5"
                                        placeholder="Jelaskan aspirasi atau kritik Anda secara detail..."
                                        required></textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="asal_pelapor" class="form-label">
                                            <i class="bi bi-person-fill"></i>
                                            Asal Pelapor
                                        </label>
                                        <input type="text" name="asal_pelapor" id="asal_pelapor" class="form-control"
                                            placeholder="Nama lengkap Anda" required>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="instansi" class="form-label">
                                            <i class="bi bi-building"></i>
                                            Instansi
                                        </label>
                                        <input type="text" name="instansi" id="instansi" class="form-control"
                                            placeholder="Nama instansi/organisasi" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="tanggal" class="form-label">
                                            <i class="bi bi-calendar-event"></i>
                                            Tanggal Laporan
                                        </label>
                                        <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="kategori" class="form-label">
                                            <i class="bi bi-tag-fill"></i>
                                            Kategori Laporan
                                        </label>
                                        <select name="kategori" id="kategori" class="form-select" required>
                                            <option value="">-- Pilih Kategori --</option>
                                            <option value="agama">🕌 Agama</option>
                                            <option value="kesehatan">⚕️ Kesehatan</option>
                                            <option value="keuangan">💰 Keuangan</option>
                                            <option value="pendidikan">📚 Pendidikan</option>
                                            <option value="infrastruktur">🏗️ Infrastruktur</option>
                                            <option value="lainnya">📋 Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">
                                        <i class="bi bi-cloud-upload-fill"></i>
                                        Lampiran Dokumen (opsional)
                                    </label>
                                    <div class="file-upload-wrapper">
                                        <input type="file" name="lampiran" id="lampiran"
                                            accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                        <div class="upload-icon">
                                            <i class="bi bi-cloud-arrow-up-fill"></i>
                                        </div>
                                        <p class="mb-0" style="color: #4a5568; font-weight: 500;">
                                            Klik atau drag file ke sini
                                        </p>
                                        <small style="color: #718096;">PDF, DOC, atau Gambar (Max 5MB)</small>
                                    </div>
                                </div>

                                <div class="text-center mt-5">
                                    <button type="submit" class="btn btn-submit">
                                        <i class="bi bi-send-fill me-2"></i>Kirim Aspirasi
                                    </button>
                                    <a href="{{ url()->previous() }}" class="btn btn-back ms-2">
                                        <i class="bi bi-arrow-left me-2"></i>Kembali
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.NavbarBawah')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // File upload preview
        document.getElementById('lampiran').addEventListener('change', function (e) {
            const fileName = e.target.files[0]?.name;
            if (fileName) {
                const wrapper = this.closest('.file-upload-wrapper');
                wrapper.style.borderColor = '#667eea';
                wrapper.style.background = 'linear-gradient(135deg, #f0f4ff 0%, #e6edff 100%)';
                wrapper.querySelector('p').textContent = '📎 ' + fileName;
                wrapper.querySelector('small').textContent = 'File berhasil dipilih';
            }
        });

        // Set today's date as default
        document.getElementById('tanggal').valueAsDate = new Date();
    </script>
</body>

</html>