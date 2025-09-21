<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Peraturan JDIH BPK</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        /* ==== style yang sudah ada ==== */
        :root {
            --primary-color: #0a6f8b;
            --primary-dark: #074e61;
            --secondary-color: #f7f9fc;
            --text-color: #333d45;
            --light-text: #6c757d;
            --white: #fff;
            --light-gray: #eef1f5;
            --shadow: 0 10px 30px rgba(0, 0, 0, .07);
            --border-radius: 12px;
            --transition-speed: 0.3s;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--secondary-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        header {
            position: relative;
            height: 380px;
            background: url('https://cdn1-production-images-kly.akamaized.net/MSQHuQN_kaYnR40kMSjN9VFhn44=/1200x675/smart/filters:quality(75):strip_icc():format(jpeg)/kly-media-production/medias/1097050/original/024845800_1451399636-20151229-BPK-RI-YR-1.jpg') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        header::after {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
        }

        .header-text-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 380px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--white);
            z-index: 10;
            padding: 0 2rem;
        }

        .header-text-container h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.8rem, 5vw, 3.2rem);
            font-weight: 700;
            line-height: 1.2;
            margin: 0;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.4);
        }

        .header-text-container p {
            font-size: clamp(1rem, 2vw, 1.2rem);
            margin-top: 0.5rem;
            max-width: 600px;
            font-weight: 300;
        }

        .navbar-bawah {
            background-color: var(--primary-color);
            color: var(--white);
            padding: 0.8rem 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .navbar-bawah-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .navbar-bawah-links {
            display: flex;
            gap: 2rem;
        }

        .navbar-bawah-links a {
            color: var(--white);
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
            transition: color var(--transition-speed);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar-bawah-links a:hover {
            color: rgba(255, 255, 255, 0.8);
        }

        .main-content {
            display: grid;
            gap: 2rem;
            grid-template-columns: 2fr 1fr;
            padding-top: 2rem;
        }

        .card {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 2rem;
            transition: transform var(--transition-speed), box-shadow var(--transition-speed);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, .1);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--light-gray);
            margin-bottom: 1.5rem;
        }

        .card-header h2 {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--primary-dark);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .card-header .btn-primary {
            background-color: var(--primary-color);
            color: var(--white);
            padding: 0.6rem 1.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: background-color var(--transition-speed), transform var(--transition-speed);
        }

        .card-header .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .btn-group .btn {
            background-color: var(--primary-color);
            color: var(--white);
            padding: 0.6rem 1.5rem;
            border: none;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color var(--transition-speed), transform var(--transition-speed);
            text-decoration: none;
        }

        .btn-group .btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .btn-group .btn-secondary {
            background-color: #6c757d;
        }

        .btn-group .btn-secondary:hover {
            background-color: #5a6268;
        }

        .btn-group {
            display: flex;
            gap: 1rem;
        }

        .metadata-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 0;
            border: 1px solid var(--light-gray);
            border-radius: var(--border-radius);
            overflow: hidden;
        }

        .metadata-item {
            display: contents;
        }

        .metadata-item dt {
            font-weight: 600;
            padding: 1rem 1.5rem;
            background-color: var(--light-gray);
            border-bottom: 1px solid var(--light-gray);
        }

        .metadata-item dd {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--light-gray);
            color: var(--light-text);
        }

        .social-share {
            margin-top: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        .social-share .share-text {
            color: var(--light-text);
            font-size: 0.9rem;
            margin-right: 0.5rem;
        }

        .social-share .social-icon {
            display: inline-flex;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--light-gray);
            color: var(--primary-color);
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 1.2rem;
            transition: background-color var(--transition-speed), transform var(--transition-speed);
        }

        .social-share .social-icon:hover {
            transform: translateY(-3px);
            background-color: var(--primary-color);
            color: var(--white);
        }

        .file-card-content {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }

        .file-card-content .file-icon {
            font-size: 3rem;
            color: #dc3545;
        }

        .file-card-content .file-name {
            font-size: 1rem;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .main-content {
                grid-template-columns: 1fr;
            }

            .navbar-bawah-container {
                flex-direction: column;
                gap: 1rem;
            }
        }

        /* ===== Popup Modern Minimalis ===== */
        .popup-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            /* overlay transparan lembut */
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            backdrop-filter: blur(12px);
            /* blur ringan, elegan */
            padding: 1.5rem;
            transition: background 0.3s ease, backdrop-filter 0.3s ease;
        }

        .popup-overlay.active {
            display: flex;
        }

        .popup-content {
            position: relative;
            background: rgba(255, 255, 255, 0.95);
            /* latar semi-transparan */
            border-radius: 20px;
            width: 90%;
            max-width: 650px;
            max-height: 85vh;
            padding: 2rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            text-align: left;
            transform: translateY(-30px) scale(0.97);
            opacity: 0;
            animation: slideDownFade 0.5s forwards ease-out;
        }

        /* border halus */
        .popup-content::before {
            content: "";
            position: absolute;
            top: -2px;
            bottom: -2px;
            left: -2px;
            right: -2px;
            border-radius: 22px;
            border: 2px solid rgba(10, 111, 139, 0.3);
            pointer-events: none;
        }

        .popup-content::-webkit-scrollbar {
            width: 10px;
        }

        .popup-content::-webkit-scrollbar-thumb {
            background-color: rgba(10, 111, 139, 0.3);
            border-radius: 5px;
        }

        .popup-content h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #0a6f8b;
            text-align: center;
            font-weight: 700;
        }

        .popup-content p,
        .popup-content ul {
            font-size: 1rem;
            color: #333;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .popup-content ul {
            padding-left: 1.5rem;
            list-style: none;
        }

        .popup-content ul li::before {
            content: '•';
            /* bullet sederhana */
            color: #0a6f8b;
            font-weight: bold;
            margin-right: 8px;
        }

        .popup-footer {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .popup-footer .btn {
            padding: 0.8rem 2rem;
            border-radius: 25px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
            text-transform: uppercase;
            user-select: none;
        }

        .popup-footer .btn-confirm {
            background-color: #0a6f8b;
            color: #fff;
        }

        .popup-footer .btn-confirm:hover {
            background-color: #0e88a0;
            transform: translateY(-3px);
        }

        .popup-footer .btn-cancel {
            background-color: #f44336;
            color: #fff;
        }

        .popup-footer .btn-cancel:hover {
            background-color: #e53935;
            transform: translateY(-3px);
        }

        .close-popup {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 1.8rem;
            color: #0a6f8b;
            cursor: pointer;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .close-popup:hover {
            color: #4caf50;
            transform: rotate(180deg) scale(1.2);
        }

        /* ===== Animations ===== */
        @keyframes slideDownFade {
            from {
                transform: translateY(-30px) scale(0.97);
                opacity: 0;
            }

            to {
                transform: translateY(0) scale(1);
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    @include('layouts.navbar')
    <header>
        <div class="header-text-container">
            <h1>{{  $Konsideran->judul ?? '-'  }}</h1>
        </div>
    </header>

    <div class="navbar-bawah">
        <div class="navbar-bawah-container">

            <div class="navbar-bawah-links center">
                <a href="#"><i class="fas fa-home"></i> Beranda</a>
                <a href="#"><i class="fas fa-book"></i> Peraturan</a>
                <a href="#"><i class="fas fa-file-alt"></i> Produk Hukum</a>
            </div>
        </div>
    </div>

    <main class="container">
        <div class="main-content">
            <div class="left-column">
                <!-- Ringkasan Konsideran -->
                <div class="card">
                    <div class="card-header">
                        <h2><i class="fas fa-info-circle"></i> Ringkasan Konsideran SPI</h2>
                        <a href="#" class="btn-primary openPopup" data-id="{{ $Konsideran->id }}">
                            Lihat Selengkapnya
                        </a>
                    </div>
                    <p class="abstract-content">
                        {{ $Konsideran->abstrak ?? 'Tidak ada ringkasan tersedia.' }}
                    </p>
                </div>

                <!-- Metadata Konsideran -->
                <div class="card" style="margin-top: 2rem;">
                    <div class="card-header">
                        <h2><i class="fas fa-tags"></i> Metadata Konsideran SPI</h2>
                    </div>
                    <dl class="metadata-grid">
                        <div class="metadata-item">
                            <dt>Tipe Dokumen</dt>
                            <dd>{{ $Konsideran->tipe_dokumen ?? '-' }}</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Judul</dt>
                            <dd>{{ $Konsideran->judul_meta ?? '-' }}</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>T.E.U.</dt>
                            <dd>{{ $Konsideran->teu ?? '-' }}</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Nomor</dt>
                            <dd>{{ $Konsideran->nomor ?? '-' }}</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Bentuk</dt>
                            <dd>{{ $Konsideran->bentuk ?? '-' }}</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Bentuk Singkat</dt>
                            <dd>{{ $Konsideran->bentuk_singkat ?? '-' }}</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Tahun</dt>
                            <dd>{{ $Konsideran->tahun_meta ?? '-' }}</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Tempat Penetapan</dt>
                            <dd>{{ $Konsideran->tempat_penetapan ?? '-' }}</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Tanggal Penetapan</dt>
                            <dd>{{ $Konsideran->tanggal_penetapan?->format('d F Y') ?? '-' }}</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Tanggal Pengundangan</dt>
                            <dd>{{ $Konsideran->tanggal_pengundangan?->format('d F Y') ?? '-' }}</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Tanggal Berlaku</dt>
                            <dd>{{ $Konsideran->tanggal_berlaku?->format('d F Y') ?? '-' }}</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Sumber</dt>
                            <dd>{{ $Konsideran->sumber ?? '-' }}</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Subjek</dt>
                            <dd>{{ $Konsideran->subjek ?? '-' }}</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Status</dt>
                            <dd>{{ $Konsideran->status ?? '-' }}</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Bahasa</dt>
                            <dd>{{ $Konsideran->bahasa ?? '-' }}</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Lokasi</dt>
                            <dd>{{ $Konsideran->lokasi ?? '-' }}</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Bidang</dt>
                            <dd>{{ $Konsideran->bidang ?? '-' }}</dd>
                        </div>
                    </dl>
                    <div class="social-share">
                        <span class="share-text">Halaman ini telah diakses {{ $Konsideran->view_count ?? 0 }}
                            kali</span>
                        <a href="#" class="social-icon twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon whatsapp"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>

                <!-- Uji Materi -->
                <div class="card" style="margin-top: 2rem;">
                    <div class="card-header">
                        <h2><i class="fas fa-balance-scale"></i> Uji Materi</h2>
                    </div>
                    <p class="abstract-content">{{ $Konsideran->uji_materi ?? 'Belum Tersedia' }}</p>
                </div>
            </div>

            <!-- Right Column -->
            <div class="right-column">
                <!-- File Konsideran -->
                <div class="card">
                    <div class="card-header">
                        <h2><i class="fas fa-file-download"></i> File Konsideran SPI</h2>
                    </div>
                    <div class="file-card-content">
                        <i class="fas fa-file-pdf file-icon"></i>
                        <div class="file-name">{{ $Konsideran->file_pdf ?? 'Tidak ada file' }}</div>
                        <div class="btn-group">
                            @php
                                $filePath = $Konsideran->file_pdf
                                    ? asset('storage/' . trim($Konsideran->file_pdf))
                                    : null;
                            @endphp

                            @if ($filePath)
                                <a href="{{ $filePath }}" target="_blank" class="btn btn-primary">Preview</a>
                                <a href="{{ $filePath }}" class="btn btn-primary" download>Download</a>
                            @else
                                <span class="btn btn-secondary disabled">Preview</span>
                                <span class="btn btn-primary disabled">Download</span>
                            @endif
                        </div>
                    </div>

                    <!-- Status Konsideran -->
                    <div class="card" style="margin-top: 2rem;">
                        <div class="card-header">
                            <h2><i class="fas fa-check-circle"></i> Status Konsideran SPI</h2>
                        </div>
                        <div class="related-regulations">
                            @if($Konsideran->mencabut)
                                <div class="status-item">
                                    <i class="fas fa-arrow-circle-right"></i>
                                    <div>
                                        <div class="status-label">Mencabut:</div>
                                        <ul>
                                            @foreach(explode("\n", str_replace("\r", '', $Konsideran->mencabut)) as $item)
                                                <li>{{ $item }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @else
                                <p>Tidak ada status mencabut.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
    </main>


    @include('layouts.NavbarBawah')
    <div class="popup-overlay" id="popup">
        <div class="popup-content">
            <span class="close-popup" id="closePopup">&times;</span>
            <h2 id="popup-judul"></h2>
            <p><strong>Tahun: </strong><span id="popup-tahun"></span></p>
            <p><strong>Kata Kunci: </strong><span id="popup-kata_kunci"></span></p>

            <h3>Abstrak:</h3>
            <ul id="popup-abstrak"></ul>

            <h3>Catatan:</h3>
            <ul id="popup-catatan"></ul>

            <div class="popup-footer">
                <button class="btn close-btn" id="closeBtnPopup">Tutup</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Selectors
            const popup = document.getElementById('popup');
            const openPopupBtn = document.querySelectorAll('.openPopup');
            const closePopupBtn = document.getElementById('closeBtnPopup');
            const closePopupIcon = document.getElementById('closePopup');

            // Event listener untuk membuka pop-up
            openPopupBtn.forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    const instrumenId = this.dataset.id;

                    fetch(`/instrumen/detail/${instrumenId}`)
                        .then(res => res.json())
                        .then(data => {
                            // Mengisi konten pop-up dengan data
                            document.getElementById('popup-judul').textContent = data.judul;
                            document.getElementById('popup-tahun').textContent = data.tahun;
                            document.getElementById('popup-kata_kunci').textContent = data.kata_kunci || '';

                            // Mengisi abstrak
                            const abstrakList = document.getElementById('popup-abstrak');
                            abstrakList.innerHTML = '';
                            if (data.abstrak) {
                                data.abstrak.split('\n').forEach(item => {
                                    const li = document.createElement('li');
                                    li.textContent = item;
                                    abstrakList.appendChild(li);
                                });
                            }

                            // Mengisi catatan
                            const catatanList = document.getElementById('popup-catatan');
                            catatanList.innerHTML = '';
                            if (data.catatan) {
                                data.catatan.split('\n').forEach(item => {
                                    const li = document.createElement('li');
                                    li.textContent = item;
                                    catatanList.appendChild(li);
                                });
                            }

                            // Menampilkan pop-up
                            popup.style.display = 'flex';
                        })
                        .catch(err => console.error('Error fetching instrumen:', err));
                });
            });

            // Event listeners untuk menutup pop-up
            closePopupBtn.addEventListener('click', () => {
                popup.style.display = 'none';
            });

            closePopupIcon.addEventListener('click', () => {
                popup.style.display = 'none';
            });

            // Menutup pop-up ketika mengklik area overlay (di luar konten)
            popup.addEventListener('click', (e) => {
                if (e.target === popup) {
                    popup.style.display = 'none';
                }
            });
        });
    </script>



</body>

</html>