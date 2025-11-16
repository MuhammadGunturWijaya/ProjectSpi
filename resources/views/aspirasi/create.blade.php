<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aspirasi - Elegant Design</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e8ecf1 100%);
            overflow-x: hidden;
            position: relative;
            min-height: 100vh;
        }

        /* Animated Background Elements */
        .bg-decoration {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }

        .bg-shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.4;
            filter: blur(80px);
        }

        .bg-shape-1 {
            width: 500px;
            height: 500px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            top: -10%;
            left: -5%;
            animation: floatSlow 25s ease-in-out infinite;
        }

        .bg-shape-2 {
            width: 400px;
            height: 400px;
            background: linear-gradient(135deg, #f093fb, #f5576c);
            top: 40%;
            right: -8%;
            animation: floatSlow 30s ease-in-out infinite reverse;
        }

        .bg-shape-3 {
            width: 350px;
            height: 350px;
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            bottom: -5%;
            left: 30%;
            animation: floatSlow 28s ease-in-out infinite;
        }

        @keyframes floatSlow {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(30px, -30px) scale(1.05);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.95);
            }
        }

        /* Subtle Grid Pattern */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image:
                linear-gradient(rgba(102, 126, 234, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(102, 126, 234, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
            pointer-events: none;
            z-index: 0;
        }

        .aspirasi-container {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            padding: 60px 0 80px;
        }

        .form-card {
            background: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow:
                0 10px 40px rgba(0, 0, 0, 0.06),
                0 2px 8px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(102, 126, 234, 0.08);
            transition: box-shadow 0.3s ease;
        }

        .form-card:hover {
            box-shadow:
                0 15px 50px rgba(0, 0, 0, 0.08),
                0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .form-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 50px 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .form-header::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        }

        .header-icon-wrapper {
            position: relative;
            z-index: 2;
            width: 100px;
            height: 100px;
            margin: 0 auto 25px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .header-icon {
            font-size: 3rem;
            color: white;
        }

        .form-header h3 {
            position: relative;
            z-index: 2;
            font-size: 2rem;
            font-weight: 700;
            color: white;
            margin: 0 0 12px 0;
            letter-spacing: -0.5px;
        }

        .form-header p {
            position: relative;
            z-index: 2;
            color: rgba(255, 255, 255, 0.95);
            font-size: 1rem;
            font-weight: 400;
            margin: 0;
            line-height: 1.6;
        }

        .btn-view-aspirasi {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.4);
            border-radius: 12px;
            padding: 12px 30px;
            font-weight: 600;
            font-size: 0.95rem;
            color: white;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            backdrop-filter: blur(10px);
        }

        .btn-view-aspirasi:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.6);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .form-body {
            padding: 45px 40px;
        }

        .form-group {
            margin-bottom: 28px;
        }

        .form-label {
            color: #2d3748;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            letter-spacing: 0.3px;
        }

        .form-label i {
            width: 28px;
            height: 28px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            color: white;
        }

        .form-control,
        .form-select {
            background: #f8f9fa;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px 18px;
            color: #2d3748;
            font-size: 0.95rem;
            transition: all 0.25s ease;
            font-weight: 500;
        }

        .form-control::placeholder {
            color: #a0aec0;
            font-weight: 400;
        }

        .form-control:focus,
        .form-select:focus {
            background: #ffffff;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            outline: none;
            color: #2d3748;
        }

        .form-control:hover,
        .form-select:hover {
            border-color: #cbd5e0;
            background: #ffffff;
        }

        .form-select {
            cursor: pointer;
            color: #2d3748;
            font-weight: 500;
        }

        .form-select option {
            background: #ffffff;
            color: #2d3748;
            padding: 10px;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 130px;
            line-height: 1.6;
        }

        .file-upload-wrapper {
            position: relative;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: 2px dashed #cbd5e0;
            border-radius: 16px;
            padding: 45px 30px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .file-upload-wrapper:hover {
            border-color: #667eea;
            background: linear-gradient(135deg, #f0f4ff 0%, #e6edff 100%);
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
            margin-bottom: 12px;
        }

        .upload-text {
            color: #4a5568;
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 6px;
        }

        .upload-subtext {
            color: #718096;
            font-size: 0.85rem;
        }

        .btn-group-custom {
            display: flex;
            gap: 12px;
            justify-content: center;
            margin-top: 40px;
        }

        .btn-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            padding: 16px 45px;
            font-weight: 700;
            font-size: 1rem;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            cursor: pointer;
            letter-spacing: 0.3px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-back {
            background: #ffffff;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px 45px;
            font-weight: 700;
            font-size: 1rem;
            color: #4a5568;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-back:hover {
            border-color: #cbd5e0;
            background: #f8f9fa;
            color: #2d3748;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .alert-custom {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            border: none;
            border-radius: 12px;
            padding: 18px 24px;
            color: white;
            font-weight: 600;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(72, 187, 120, 0.25);
        }

        .section-title {
            color: #2d3748;
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid #e2e8f0;
            letter-spacing: 0.3px;
        }

        @media (max-width: 768px) {
            .aspirasi-container {
                padding: 30px 0 50px;
            }

            .form-header {
                padding: 40px 25px;
            }

            .form-header h3 {
                font-size: 1.6rem;
            }

            .header-icon-wrapper {
                width: 80px;
                height: 80px;
                margin-bottom: 20px;
            }

            .header-icon {
                font-size: 2.2rem;
            }

            .form-body {
                padding: 35px 25px;
            }

            .btn-group-custom {
                flex-direction: column;
                gap: 10px;
            }

            .btn-submit,
            .btn-back {
                width: 100%;
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #5568d3, #653a8b);
        }

        /* Smooth transitions */
        .form-control,
        .form-select,
        .btn-submit,
        .btn-back,
        .file-upload-wrapper {
            will-change: transform;
        }
    </style>
</head>

<body>
    <!-- Animated Background Decoration -->
    <div class="bg-decoration">
        <div class="bg-shape bg-shape-1"></div>
        <div class="bg-shape bg-shape-2"></div>
        <div class="bg-shape bg-shape-3"></div>
    </div>

    @include('layouts.navbar')

    <div class="aspirasi-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-9">
                    <div class="form-card">
                        <div class="form-header">
                            <div class="header-icon-wrapper">
                                <i class="bi bi-chat-left-text-fill header-icon"></i>
                            </div>
                            <h3>Formulir Aspirasi & Kritik</h3>
                            <p>Sampaikan aspirasi, kritik, dan saran Anda untuk kemajuan bersama</p>
                            <a href="{{ route('aspirasi.index') }}" class="btn-view-aspirasi">
                                <i class="bi bi-list-ul me-2"></i>Lihat Aspirasi Saya
                            </a>
                        </div>

                        <div class="form-body">
                            @if(session('success'))
                                <div class="alert-custom">
                                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ route('aspirasi.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="judul" class="form-label">
                                        <i class="bi bi-pencil-square"></i>
                                        Judul Aspirasi
                                    </label>
                                    <input type="text" name="judul" id="judul" class="form-control"
                                        placeholder="Tuliskan judul aspirasi Anda..." required>
                                </div>

                                <div class="form-group">
                                    <label for="keterangan" class="form-label">
                                        <i class="bi bi-card-text"></i>
                                        Keterangan Detail
                                    </label>
                                    <textarea name="keterangan" id="keterangan" class="form-control" rows="5"
                                        placeholder="Jelaskan aspirasi atau kritik Anda secara detail..."
                                        required></textarea>
                                </div>

                                <div class="section-title mt-4">
                                    <i class="bi bi-person-badge me-2"></i>Informasi Pelapor
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="asal_pelapor" class="form-label">
                                                <i class="bi bi-person-fill"></i>
                                                Asal Pelapor
                                            </label>
                                            <input type="text" name="asal_pelapor" id="asal_pelapor"
                                                class="form-control" placeholder="Nama lengkap Anda" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="instansi" class="form-label">
                                                <i class="bi bi-building"></i>
                                                Instansi
                                            </label>
                                            <input type="text" name="instansi" id="instansi" class="form-control"
                                                placeholder="Nama instansi/organisasi" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="section-title mt-4">
                                    <i class="bi bi-info-circle me-2"></i>Detail Laporan
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal" class="form-label">
                                                <i class="bi bi-calendar-event"></i>
                                                Tanggal Laporan
                                            </label>
                                            <input type="date" name="tanggal" id="tanggal" class="form-control"
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kategori" class="form-label">
                                                <i class="bi bi-tag-fill"></i>
                                                Kategori Laporan
                                            </label>
                                            <select name="kategori" id="kategori" class="form-select" required>
                                                <option value="">-- Pilih Kategori --</option>
                                                <option value="agama">Agama</option>
                                                <option value="kesehatan">Kesehatan</option>
                                                <option value="pendidikan">Pendidikan</option>
                                                <option value="infrastruktur">Infrastruktur</option>
                                                <option value="akademik">akademik</option>
                                                <option value="kemahasiswaan">kemahasiswaan</option>
                                                <option value="keuangan">keuangan</option>
                                                <option value="sarana_prasarana">sarana prasarana</option>
                                                <option value="layanan_administrasi">layanan administrasi</option>
                                                <option value="kerja_sama">kerja sama </option>
                                                <option value="kepegawaian">kepegawaian</option>
                                                <option value="perencanaan_dan_kegiatan">perencanaan dan kegiatan </option>
                                                <option value="tata_kelola">tata kelola</option>
                                                <option value="unit_bisnis_dan_teaching_factory">unit bisnis dan teaching factory</option>
                                                <option value="lingkungan">lingkungan</option>
                                                <option value="sistem_informasi_dan_komunikasi">sistem informasi dan komunikasi</option>
                                                <option value="lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Field tambahan untuk kategori "lainnya" -->
                                <div class="form-group" id="kategoriLainnyaWrapper" style="display: none;">
                                    <label for="kategori_lainnya" class="form-label">
                                        <i class="bi bi-pencil-fill"></i>
                                        Sebutkan Kategori Lainnya
                                    </label>
                                    <input type="text" name="kategori_lainnya" id="kategori_lainnya"
                                        class="form-control" placeholder="Masukkan kategori lainnya...">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="bi bi-cloud-upload-fill"></i>
                                        Lampiran Dokumen (opsional)
                                    </label>
                                    <div class="file-upload-wrapper" id="fileUploadWrapper">
                                        <input type="file" name="lampiran" id="lampiran"
                                            accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                        <div class="upload-icon">
                                            <i class="bi bi-cloud-arrow-up-fill"></i>
                                        </div>
                                        <p class="upload-text">Klik atau drag file ke sini</p>
                                        <p class="upload-subtext">PDF, DOC, atau Gambar (Max 5MB)</p>
                                    </div>
                                </div>

                                <div class="btn-group-custom">
                                    <button type="submit" class="btn-submit" id="btnKirim">
                                        <span class="spinner-border spinner-border-sm me-2 d-none" id="loadingSpinner"
                                            role="status" aria-hidden="true"></span>
                                        <i class="bi bi-send-fill me-2" id="btnIcon"></i>
                                        <span id="btnText">Kirim Aspirasi</span>
                                    </button>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function () {
                                            const form = document.querySelector('form'); // ganti jika form kamu punya ID tertentu
                                            const btnKirim = document.getElementById('btnKirim');
                                            const spinner = document.getElementById('loadingSpinner');
                                            const btnText = document.getElementById('btnText');
                                            const btnIcon = document.getElementById('btnIcon');

                                            form.addEventListener('submit', function () {
                                                // Tampilkan spinner dan ubah teks tombol
                                                spinner.classList.remove('d-none');
                                                btnText.textContent = 'Mengirim...';
                                                btnIcon.classList.add('d-none');
                                                btnKirim.disabled = true; // nonaktifkan tombol agar tidak diklik dua kali
                                            });
                                        });
                                    </script>

                                    <a href="{{route('landingpage')}}" class="btn-back">
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
        // File upload handling
        const fileInput = document.getElementById('lampiran');
        const fileWrapper = document.getElementById('fileUploadWrapper');

        fileInput.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                fileWrapper.style.borderColor = '#667eea';
                fileWrapper.style.background = 'linear-gradient(135deg, #f0f4ff 0%, #e6edff 100%)';
                fileWrapper.querySelector('.upload-text').textContent = '📎 ' + file.name;
                fileWrapper.querySelector('.upload-subtext').textContent = 'File berhasil dipilih';
            }
        });

        // Tampilkan field kategori lainnya jika dipilih
        const kategoriSelect = document.getElementById('kategori');
        const kategoriLainnyaWrapper = document.getElementById('kategoriLainnyaWrapper');
        const kategoriLainnyaInput = document.getElementById('kategori_lainnya');

        kategoriSelect.addEventListener('change', function () {
            if (this.value === 'lainnya') {
                kategoriLainnyaWrapper.style.display = 'block';
                kategoriLainnyaInput.setAttribute('required', 'required');
            } else {
                kategoriLainnyaWrapper.style.display = 'none';
                kategoriLainnyaInput.removeAttribute('required');
                kategoriLainnyaInput.value = '';
            }
        });

        // Set today's date as default
        document.getElementById('tanggal').valueAsDate = new Date();

        // Smooth scroll to top on form errors
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('invalid', function () {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }, true);
        }
    </script>
</body>

</html>