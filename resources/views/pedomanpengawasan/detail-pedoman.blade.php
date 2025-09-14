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
                <div class="card">
                    <div class="card-header">
                        <h2><i class="fas fa-info-circle"></i> Ringkasan Peraturan</h2>
                        <a href="#" class="btn-primary" id="openPopup">Lihat Selengkapnya</a>
                    </div>

                    <p class="abstract-content">
                        Peraturan ini mengatur tentang ketentuan umum, kedudukan, tugas dan fungsi, susunan organisasi,
                        tata kerja, penataan organisasi, sumber daya manusia, ketentuan pelatihan, dan ketentuan penutup
                        dari Sekretariat Komite Stabilitas Sistem Keuangan.
                    </p>
                </div>

                <div class="card" style="margin-top: 2rem;">
                    <div class="card-header">
                        <h2><i class="fas fa-tags"></i> Metadata Peraturan</h2>
                    </div>
                    <dl class="metadata-grid">
                        <div class="metadata-item">
                            <dt>Tipe Dokumen</dt>
                            <dd>Peraturan Perundang-undangan</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Judul</dt>
                            <dd>Peraturan Menteri Keuangan Nomor 64 Tahun 2025 tentang Organisasi dan Tata Kerja
                                Sekretariat Komite Stabilitas Sistem Keuangan</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>T.E.U.</dt>
                            <dd>Indonesia. Kementerian Keuangan</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Nomor</dt>
                            <dd>64</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Bentuk</dt>
                            <dd>Peraturan Menteri Keuangan</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Bentuk Singkat</dt>
                            <dd>PMK</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Tahun</dt>
                            <dd>2025</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Tempat Penetapan</dt>
                            <dd>Jakarta</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Tanggal Penetapan</dt>
                            <dd>28 Agustus 2025</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Tanggal Pengundangan</dt>
                            <dd>04 September 2025</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Tanggal Berlaku</dt>
                            <dd>04 September 2025</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Sumber</dt>
                            <dd>BN.2025 (666)/4 hlm</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Subjek</dt>
                            <dd>STRUKTUR ORGANISASI</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Status</dt>
                            <dd>Berlaku</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Bahasa</dt>
                            <dd>Bahasa Indonesia</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Lokasi</dt>
                            <dd>Kementerian Keuangan</dd>
                        </div>
                        <div class="metadata-item">
                            <dt>Bidang</dt>
                            <dd>HUKUM TATA NEGARA</dd>
                        </div>
                    </dl>
                    <div class="social-share">
                        <span class="share-text">Halaman ini telah diakses 52 kali</span>
                        <a href="#" class="social-icon twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon whatsapp"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>

                <div class="card" style="margin-top: 2rem;">
                    <div class="card-header">
                        <h2><i class="fas fa-balance-scale"></i> Uji Materi</h2>
                    </div>
                    <p class="abstract-content">Belum Tersedia</p>
                </div>
            </div>

            <div class="right-column">
                <div class="card">
                    <div class="card-header">
                        <h2><i class="fas fa-file-download"></i> File Peraturan</h2>
                    </div>
                    <div class="file-card-content">
                        <i class="fas fa-file-pdf file-icon"></i>
                        <div class="file-name">64 th 2025.pdf</div>
                        <div class="btn-group">
                            <a href="#" class="btn btn-secondary">Preview</a>
                            <a href="#" class="btn btn-primary">Download</a>
                        </div>
                    </div>
                </div>

                <div class="card" style="margin-top: 2rem;">
                    <div class="card-header">
                        <h2><i class="fas fa-check-circle"></i> Status Peraturan</h2>
                    </div>
                    <div class="related-regulations">
                        <div class="status-item">
                            <i class="fas fa-arrow-circle-right"></i>
                            <div>
                                <div class="status-label">Mencabut:</div>
                                <ul>
                                    <li><a href="#">PMK No. 92/PMK.01/2017 tentang Organisasi dan Tata Kerja Sekretariat
                                            Komite Stabilitas Sistem Keuangan</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </main>

    @include('layouts.NavbarBawah')
    <!-- ===== Popup admin ===== -->
    <div class="popup-overlay" id="popup">
        <div class="popup-content">
            <span class="close-popup" id="closePopup">&times;</span>
            <h3>Kelola Peraturan</h3>
            <p>Pilih aksi untuk mengelola peraturan ini:</p>
            <div class="popup-actions">
                <a href="#" class="btn btn-primary">Edit</a>
                <a href="#" class="btn btn-secondary">Hapus</a>
                <a href="#" class="btn btn-primary">Tambah Baru</a>
            </div>
        </div>
    </div>

    <script>
        const openPopup = document.getElementById('openPopup');
        const closePopup = document.getElementById('closePopup');
        const popup = document.getElementById('popup');
        openPopup.addEventListener('click', e => {
            e.preventDefault();
            popup.style.display = 'flex';
        });
        closePopup.addEventListener('click', () => popup.style.display = 'none');
        popup.addEventListener('click', e => {
            if (e.target === popup) popup.style.display = 'none';
        });
    </script>
</body>

</html>