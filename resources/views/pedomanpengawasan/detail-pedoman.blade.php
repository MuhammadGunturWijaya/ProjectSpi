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

        /* ===== Tambahan: Popup Admin ===== */
        .popup-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .popup-content {
            background: var(--white);
            border-radius: var(--border-radius);
            width: 90%;
            max-width: 500px;
            padding: 2rem;
            box-shadow: var(--shadow);
            text-align: center;
        }

        .popup-content h3 {
            margin-bottom: 1rem;
            color: var(--primary-dark);
        }

        .popup-actions {
            margin-top: 1.5rem;
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        .close-popup {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 1.2rem;
            color: var(--light-text);
            cursor: pointer;
        }
    </style>
</head>

<body>
    @include('layouts.navbar')
    <header>
        <div class="header-text-container">
            <h1>Selamat Datang di <BR>SATUAN PENGAWAS INTERNAL</BR></h1>
            <p>Organisasi dan Tata Kerja Sekretariat Komite Stabilitas Sistem Keuangan</p>
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
                <!-- Ringkasan Peraturan -->
                <div class="card">
                    <div class="card-header">
                        <h2><i class="fas fa-info-circle"></i> Ringkasan Peraturan</h2>
                        <a href="#" class="btn-primary openPopup" data-id="{{ $pedoman->id }}">
                            Lihat Selengkapnya
                        </a>
                    </div>
                    <p class="abstract-content">
                        {{ $pedoman->abstrak ?? 'Tidak ada ringkasan tersedia.' }}
                    </p>
                </div>

                <!-- Metadata Peraturan -->
                <div class="card" style="margin-top: 2rem;">
                    <div class="card-header">
                        <h2><i class="fas fa-tags"></i> Metadata Peraturan</h2>
                    </div>
                    <dl class="metadata-grid">
                        <div class="metadata-item">
                            <dt>Tipe Dokumen</dt>
                            <dd>{{ $pedoman->tipe_dokumen ?? '-' }}</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Judul</dt>
                            <dd>{{ $pedoman->judul_meta ?? '-' }}</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>T.E.U.</dt>
                            <dd>{{ $pedoman->teu ?? '-' }}</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Nomor</dt>
                            <dd>{{ $pedoman->nomor ?? '-' }}</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Bentuk</dt>
                            <dd>{{ $pedoman->bentuk ?? '-' }}</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Bentuk Singkat</dt>
                            <dd>{{ $pedoman->bentuk_singkat ?? '-' }}</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Tahun</dt>
                            <dd>{{ $pedoman->tahun_meta ?? '-' }}</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Tempat Penetapan</dt>
                            <dd>{{ $pedoman->tempat_penetapan ?? '-' }}</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Tanggal Penetapan</dt>
                            <dd>{{ $pedoman->tanggal_penetapan?->format('d F Y') ?? '-' }}</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Tanggal Pengundangan</dt>
                            <dd>{{ $pedoman->tanggal_pengundangan?->format('d F Y') ?? '-' }}</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Tanggal Berlaku</dt>
                            <dd>{{ $pedoman->tanggal_berlaku?->format('d F Y') ?? '-' }}</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Sumber</dt>
                            <dd>{{ $pedoman->sumber ?? '-' }}</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Subjek</dt>
                            <dd>{{ $pedoman->subjek ?? '-' }}</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Status</dt>
                            <dd>{{ $pedoman->status ?? '-' }}</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Bahasa</dt>
                            <dd>{{ $pedoman->bahasa ?? '-' }}</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Lokasi</dt>
                            <dd>{{ $pedoman->lokasi ?? '-' }}</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Bidang</dt>
                            <dd>{{ $pedoman->bidang ?? '-' }}</dd>
                        </div>
                    </dl>
                    <div class="social-share">
                        <span class="share-text">Halaman ini telah diakses {{ $pedoman->view_count ?? 0 }} kali</span>
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
                    <p class="abstract-content">{{ $pedoman->uji_materi ?? 'Belum Tersedia' }}</p>
                </div>
            </div>

            <!-- Right Column -->
            <div class="right-column">
                <!-- File Peraturan -->
                <div class="card">
                    <div class="card-header">
                        <h2><i class="fas fa-file-download"></i> File Peraturan</h2>
                    </div>
                    <div class="file-card-content">
                        <i class="fas fa-file-pdf file-icon"></i>
                        <div class="file-name">{{ $pedoman->file_pdf ?? 'Tidak ada file' }}</div>
                        <div class="btn-group">
                            @php
                                $filePath = $pedoman->file_pdf ? asset('storage/' . trim($pedoman->file_pdf)) : null;
                            @endphp

                            @if($filePath)
                                <a href="{{ $filePath }}" class="btn btn-secondary" target="_blank">Preview</a>
                                <a href="{{ $filePath }}" class="btn btn-primary" download>Download</a>
                            @else
                                <span class="btn btn-secondary disabled">Preview</span>
                                <span class="btn btn-primary disabled">Download</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Status Peraturan -->
                <div class="card" style="margin-top: 2rem;">
                    <div class="card-header">
                        <h2><i class="fas fa-check-circle"></i> Status Peraturan</h2>
                    </div>
                    <div class="related-regulations">
                        @if($pedoman->mencabut)
                            <div class="status-item">
                                <i class="fas fa-arrow-circle-right"></i>
                                <div>
                                    <div class="status-label">Mencabut:</div>
                                    <ul>
                                        @foreach(explode("\n", $pedoman->mencabut) as $item)
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
    <div class="popup-overlay" id="popup" style="display:none;">
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



    <style>
        /* --- Design based on the provided image --- */
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .popup-content.original-style {
            background-color: #f7f7f7;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            max-width: 850px;
            width: 90%;
            position: relative;
            font-family: 'Times New Roman', Times, serif;
            /* Using a classic font to match the document feel */
            line-height: 1.6;
            color: #333;
        }

        .close-popup {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 2.5rem;
            cursor: pointer;
            color: #666;
        }

        .close-popup:hover {
            color: #000;
        }

        .document-section {
            margin-bottom: 1.5rem;
        }

        .doc-title {
            font-size: 1.8rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 1rem;
            color: #222;
        }

        .subtitle {
            font-size: 1.1rem;
            font-weight: bold;
            text-align: center;
            margin: 0;
        }

        .section-heading {
            font-weight: bold;
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            text-decoration: underline;
            text-transform: uppercase;
        }

        .abstract-list,
        .notes-list {
            list-style-type: none;
            /* Remove default list bullets */
            padding-left: 0;
            margin-bottom: 1.5rem;
        }

        .abstract-list li,
        .notes-list li {
            position: relative;
            padding-left: 1.5rem;
            /* Space for the custom bullet */
            margin-bottom: 1rem;
        }

        .abstract-list li::before {
            content: "•";
            /* Custom bullet point */
            color: #333;
            font-weight: bold;
            position: absolute;
            left: 0;
            top: 0;
        }

        .notes-list li::before {
            content: "•";
            color: #333;
            font-weight: bold;
            position: absolute;
            left: 0;
            top: 0;
        }

        .popup-footer {
            text-align: right;
            margin-top: 2rem;
            border-top: 1px solid #ccc;
            padding-top: 1rem;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .close-btn {
            background-color: #6c757d;
            color: white;
        }

        .close-btn:hover {
            background-color: #5a6268;
        }

        /* Make content scrollable for smaller screens */
        .popup-content.original-style {
            max-height: 80vh;
            overflow-y: auto;
        }
    </style>
    <script>
        // Gunakan selector sesuai tombol di HTML
        document.querySelectorAll('.openPopup').forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();

                const pedomanId = this.dataset.id;

                fetch(`/pedoman/detail/${pedomanId}`)
                    .then(res => res.json())
                    .then(data => {
                        document.getElementById('popup-judul').textContent = data.judul;
                        document.getElementById('popup-tahun').textContent = data.tahun;
                        document.getElementById('popup-kata_kunci').textContent = data.kata_kunci || '';

                        const abstrakList = document.getElementById('popup-abstrak');
                        abstrakList.innerHTML = '';
                        if (data.abstrak) {
                            data.abstrak.split('\n').forEach(item => {
                                const li = document.createElement('li');
                                li.textContent = item;
                                abstrakList.appendChild(li);
                            });
                        }

                        const catatanList = document.getElementById('popup-catatan');
                        catatanList.innerHTML = '';
                        if (data.catatan) {
                            data.catatan.split('\n').forEach(item => {
                                const li = document.createElement('li');
                                li.textContent = item;
                                catatanList.appendChild(li);
                            });
                        }

                        document.getElementById('popup').style.display = 'flex';
                    })
                    .catch(err => console.error('Error fetching pedoman:', err));
            });
        });

    </script>


</body>

</html>