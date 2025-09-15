<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Peraturan JDIH BPK</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        :root {
            --primary: #0a4d92;
            --primary-dark: #083c72;
            --secondary: #f8fafc;
            --white: #fff;
            --text: #333;
            --shadow: 0 8px 24px rgba(0, 0, 0, .08);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: var(--secondary);
            color: var(--text);
        }

        /* Header */
        header {
            position: relative;
            height: 360px;
            background: url('https://cdn1-production-images-kly.akamaized.net/MSQHuQN_kaYnR40kMSjN9VFhn44=/1200x675/smart/filters:quality(75):strip_icc():format(jpeg)/kly-media-production/medias/1097050/original/024845800_1451399636-20151229-BPK-RI-YR-1.jpg') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #fff;
        }

        header::after {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
        }

        header h1 {
            position: relative;
            font-size: 2.2rem;
            font-weight: 700;
            line-height: 1.4;
            /* Properti baru untuk efek menyala */
            animation: pulseGlow 2s infinite alternate;
        }

        /* Container baru untuk teks */
        .header-text-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 360px;
            /* Sesuaikan dengan tinggi header */
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #fff;
            z-index: 10;
            /* Pastikan teks di atas lapisan gelap */
        }

        .header-text-container h1 {
            font-size: 2.2rem;
            font-weight: 700;
            line-height: 1.4;
        }

        @keyframes pulseGlow {
            from {
                text-shadow: 0 0 10px #5721bbff, 0 0 20px #fff, 0 0 30px #0a4d92, 0 0 40px #0a4d92;
            }

            to {
                text-shadow: 0 0 15px #176da7ff, 0 0 25px #fff, 0 0 40px #0a4d92, 0 0 50px #0a4d92;
            }
        }

        /* Search box */
        .search-wrapper {
            max-width: 900px;
            margin: -50px auto 40px;
            background: var(--white);
            border-radius: 50px;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            position: relative;
            z-index: 10;
            /* This is the new line you should add */
        }

        .search-wrapper .input-group {
            position: relative;
            flex: 1;
        }

        .search-wrapper .input-group i {
            position: absolute;
            top: 50%;
            left: 16px;
            transform: translateY(-50%);
            color: #888;
            font-size: 1rem;
        }

        .search-wrapper input {
            width: 100%;
            padding: 14px 18px 14px 44px;
            border: none;
            font-size: 1rem;
            outline: none;
            border-radius: 40px;
            background: #f9fafb;
            transition: box-shadow .3s;
        }

        .search-wrapper input:focus {
            box-shadow: 0 0 0 3px rgba(10, 77, 146, 0.15);
        }

        /* Tombol */
        .search-wrapper button {
            padding: 12px 22px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            font-size: .95rem;
            border-radius: 40px;
            transition: background .3s, transform .2s;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .search-btn {
            background: var(--primary);
            color: #fff;
        }

        .search-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }

        .adv-btn {
            background: #f3f4f7;
            color: var(--primary);
        }

        .adv-btn:hover {
            background: #e8ebf0;
            transform: translateY(-1px);
        }

        /* Responsif */
        @media (max-width: 640px) {
            .search-wrapper {
                flex-direction: column;
                border-radius: 20px;
                gap: 12px;
            }

            .search-wrapper button {
                width: 100%;
                justify-content: center;
            }
        }


        /* Carousel */
        .popular {
            text-align: center;
            margin: 50px auto;
        }

        .popular h2 {
            font-size: 1.7rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 25px;
        }

        /* Update Carousel Wrapper */
        .carousel-wrapper {
            overflow: hidden;
            position: relative;
            overflow-x: auto;
            max-width: 1600px;
            margin: auto;
            display: flex;
            align-items: center;
            gap: 10px;
            /* Jarak antara tombol dan carousel */
            padding: 0 40px;
            /* Memberikan ruang untuk tombol */
        }

        .carousel-track-container {

            display: inline-block;
            /* supaya lebarnya sesuai isi */
            max-width: 1600px;
            /* batas maksimum */
            overflow: hidden;
            /* sembunyikan yang keluar */
            margin: 0 auto;
            /* tetap di tengah */
        }


        .carousel-track {
            display: inline-flex;
            /* lebar otomatis sesuai isi */
            gap: 25px;
            /* jarak antar card */
            width: max-content;
            /* biar muat sesuai jumlah card */
            transition: transform 0.5s ease;
        }

        /* --- NEW STYLES FOR POPULAR CARDS --- */
        .card-item-new {
            width: 280px;
            padding: 24px;
            border-radius: 20px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #fff;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            gap: 15px;
            cursor: pointer;
        }

        .card-item-new:hover {
            transform: translateY(-8px) scale(1.02) perspective(1px) translateZ(0);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .card-icon-new {
            background-color: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            width: 50px;
            height: 50px;
            min-width: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #fff;
        }

        .card-content-new {
            display: flex;
            flex-direction: column;
        }

        .card-title-new {
            font-size: 1.15rem;
            font-weight: 700;
            margin-bottom: 4px;
            line-height: 1.2;
        }

        .card-subtitle-new {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.85);
            margin-bottom: 8px;
        }

        .card-type-new {
            font-size: 0.8rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.7);
            padding: 4px 8px;
            border-radius: 5px;
            background-color: rgba(0, 0, 0, 0.1);
            align-self: flex-start;
        }

        /* Update original carousel styles to accommodate the new card width */
        .carousel-track {
            gap: 25px;
            /* Increase gap for new card size */
        }

        @media(max-width: 768px) {
            .card-item-new {
                width: 240px;
            }
        }


        .card-item {
            background: var(--primary);
            color: #fff;
            padding: 20px;
            width: 250px;
            border-radius: 14px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            flex-shrink: 0;
            text-align: left;
            transition: transform .3s, background .3s;
        }

        .card-item span {
            font-weight: 700;
            display: block;
            margin-bottom: 6px;
        }

        .card-item:hover {
            background: var(--primary-dark);
            transform: translateY(-4px);
        }

        /* Tombol Navigasi Carousel */
        .carousel-btn {
            background: rgba(10, 77, 146, 0.85);
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            cursor: pointer;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s, transform 0.2s;
            flex-shrink: 0;

        }

        .carousel-btn:hover {
            background: var(--primary-dark);
            transform: scale(1.05);
        }

        .carousel-btn:active {
            transform: scale(0.95);
        }

        /* Animasi geser */
        @keyframes slide {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        /* Responsif */
        @media(max-width:768px) {
            .card-item {
                width: 200px;
                font-size: .9rem;
            }
        }

        /* Classification Section */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

        .classification {
            max-width: 1400px;
            margin: 50px auto;
            padding: 50px 40px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 30px;
            box-shadow: 0 8px 32px rgba(10, 77, 146, 0.12);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(10, 77, 146, 0.2);
            font-family: 'Poppins', sans-serif;
            color: #1a1a1a;
            transition: background 0.3s ease;
        }

        .classification-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            border-bottom: 3px solid var(--primary);
            padding-bottom: 12px;
        }

        .header-actions {
            display: flex;
            gap: 12px;
            /* jarak antara "Lihat Lebih" dan "Tambah Pedoman" */
        }


        .classification-header h2 {
            font-size: 2rem;
            font-weight: 900;
            color: var(--primary-dark);
            letter-spacing: 1.5px;
            text-transform: uppercase;
            position: relative;
        }

        .classification-header h2::after {
            content: '';
            position: absolute;
            bottom: -12px;
            left: 0;
            width: 80px;
            height: 5px;
            background: var(--primary);
            border-radius: 3px;
            box-shadow: 0 0 15px var(--primary);
            transition: width 0.3s ease;
        }

        .classification-header a {
            background: var(--primary);
            color: #fff;
            padding: 12px 28px;
            border-radius: 14px;
            font-weight: 700;
            font-size: 1.1rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 8px 20px rgba(10, 77, 146, 0.35);
            transition: background 0.3s ease, box-shadow 0.3s ease, transform 0.25s ease;
        }

        .classification-header a:hover {
            background: var(--primary-dark);
            box-shadow: 0 12px 30px rgba(8, 60, 114, 0.6);
            transform: translateY(-4px);
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 32px;
        }

        .card {
            background: rgba(255, 255, 255, 0.25);
            border-radius: 24px;
            padding: 32px 28px;
            box-shadow: 0 12px 30px rgba(10, 77, 146, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1.5px solid rgba(255, 255, 255, 0.3);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
            transition: transform 0.5s cubic-bezier(0.25, 0.8, 0.25, 1), box-shadow 0.5s ease, border-color 0.5s ease;
            cursor: pointer;
        }

        .card:hover {
            transform: translateY(-15px) rotateX(5deg) scale(1.05);
            box-shadow: 0 25px 50px rgba(10, 77, 146, 0.3);
            border-color: var(--primary);
            background: rgba(255, 255, 255, 0.4);
        }

        .card-icon-wrapper {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 28px;
            box-shadow: 0 10px 25px rgba(10, 77, 146, 0.4);
            transition: transform 0.5s ease, box-shadow 0.5s ease;
        }

        .card:hover .card-icon-wrapper {
            transform: scale(1.3) rotate(15deg);
            box-shadow: 0 15px 40px rgba(10, 77, 146, 0.6);
        }

        .card-icon-wrapper i {
            font-size: 2.8rem;
            color: #fff;
            transition: color 0.5s ease;
        }

        .card:hover .card-icon-wrapper i {
            color: #ffd34e;
        }

        .card-content h3 {
            font-size: 1.4rem;
            font-weight: 800;
            margin-bottom: 14px;
            color: var(--primary-dark);
            transition: color 0.4s ease;
        }

        .card:hover .card-content h3 {
            color: var(--primary);
        }

        .card-content p {
            font-size: 1.05rem;
            line-height: 1.7;
            color: #444;
            margin-bottom: 24px;
            transition: color 0.4s ease;
        }

        .card:hover .card-content p {
            color: #222;
        }

        .card-link {
            font-weight: 700;
            font-size: 1.05rem;
            color: var(--primary);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            border-bottom: 3px solid transparent;
            padding-bottom: 4px;
            transition: color 0.4s ease, border-color 0.4s ease, transform 0.3s ease;
        }

        .card-link:hover {
            color: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateX(8px);
        }


        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            .classification {
                padding: 30px 20px;
            }

            .card {
                padding: 20px;
            }

            .card-icon-wrapper {
                width: 50px;
                height: 50px;
            }

            .card-icon-wrapper i {
                font-size: 1.6rem;
            }
        }

        /* ===== Modal Background ===== */
        .modal {
            display: none;
            position: fixed;
            z-index: 999;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(10, 77, 146, 0.55);
            backdrop-filter: blur(4px);
            animation: fadeIn .3s;
        }

        /* ===== Modal Box ===== */
        .modal-box {
            background: rgba(255, 255, 255, 0.95);
            margin: 6% auto;
            width: 95%;
            max-width: 650px;
            border-radius: 20px;
            padding: 35px 40px;
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.2);
            position: relative;
            animation: slideUp .4s ease;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                transform: translateY(30px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* ===== Title & Close ===== */
        .modal-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 28px;
            text-align: center;
        }

        .close {
            position: absolute;
            right: 18px;
            top: 16px;
            font-size: 1.7rem;
            color: #777;
            cursor: pointer;
            transition: color .3s;
        }

        .close:hover {
            color: var(--primary-dark);
        }

        /* ===== Form Layout ===== */
        .adv-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 18px 22px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 6px;
            color: #444;
        }

        .form-group input {
            padding: 10px 14px;
            border: 1px solid #d5d9e0;
            border-radius: 10px;
            background: #f9fafc;
            transition: border .3s, box-shadow .3s;
            font-size: .95rem;
        }

        .form-group input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(10, 77, 146, 0.15);
            outline: none;
        }

        /* ===== Buttons ===== */
        .form-actions {
            grid-column: 1 / -1;
            text-align: center;
            margin-top: 20px;
        }

        .btn-submit {
            background: var(--primary);
            color: #fff;
            padding: 10px 28px;
            border: none;
            border-radius: 40px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            margin-right: 12px;
            transition: background .3s, transform .2s;
        }

        .btn-submit:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }

        .btn-cancel {
            background: #ccc;
            color: #333;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-cancel:hover {
            background: #aaa;
        }
    </style>
</head>

<body>
    @include('layouts.navbar')

    <header>
        <div class="header-text-container">
            <h1>PEDOMAN PENGAWASAN </h1>
        </div>
    </header>


    <div class="search-wrapper">
        <div class="input-group">
            <i class="fa fa-search"></i>
            <input type="text" placeholder="Cari peraturan ...">
        </div>
        <button class="search-btn"><i class="fa fa-search"></i> Cari</button>
        <button class="adv-btn"><i class="fa fa-sliders-h"></i> Adv. Search</button>
    </div>

    <div id="advModal" class="modal">
        <div class="modal-box">
            <span class="close">&times;</span>
            <h2 class="modal-title"><i class="fa fa-sliders-h"></i> Advanced Search</h2>
            <form class="adv-form">
                <div class="form-group">
                    <label for="tentang">Tentang</label>
                    <input type="text" id="tentang" placeholder="Masukkan kata kunci ...">
                </div>

                <div class="form-group">
                    <label for="nomor">Nomor</label>
                    <input type="text" id="nomor" placeholder="Contoh: 12">
                </div>

                <div class="form-group">
                    <label for="tahun">Tahun</label>
                    <input type="number" id="tahun" placeholder="2023">
                </div>

                <div class="form-group">
                    <label for="jenis">Jenis</label>
                    <input type="text" id="jenis" placeholder="Peraturan / UU / PP ...">
                </div>

                <div class="form-group">
                    <label for="entitas">Entitas</label>
                    <input type="text" id="entitas" placeholder="Nama instansi ...">
                </div>

                <div class="form-group">
                    <label for="tag">Tag</label>
                    <input type="text" id="tag" placeholder="Pisahkan dengan koma">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <i class="fa fa-search"></i> Cari
                    </button>
                    <button type="button" class="btn-cancel" id="cancelBtn">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const advBtn = document.querySelector('.adv-btn');
        const modal = document.getElementById('advModal');
        const closeBtn = document.querySelector('.close');
        const cancelBtn = document.getElementById('cancelBtn');

        advBtn.addEventListener('click', () => {
            modal.style.display = 'block';
        });

        closeBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        cancelBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
    </script>

    <section class="popular">
        <h2>Peraturan Terpopuler 2 Minggu Terakhir</h2>
        <div class="carousel-wrapper">
            <button id="carousel-prev" class="carousel-btn prev-btn"><i class="fas fa-chevron-left"></i></button>
            <div class="carousel-track-container">
                <div class="carousel-track">
                    <div class="card-item-new">
                        <div class="card-icon-new">
                            <i class="fas fa-gavel"></i>
                        </div>
                        <div class="card-content-new">
                            <span class="card-title-new">UU No. 1 Tahun 2023</span>
                            <small class="card-subtitle-new">Kitab Undang-Undang Hukum Pidana</small>
                            <span class="card-type-new">📜 Undang-Undang</span>
                        </div>
                    </div>
                    <div class="card-item-new">
                        <div class="card-icon-new">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <div class="card-content-new">
                            <span class="card-title-new">UU No. 11 Tahun 2020</span>
                            <small class="card-subtitle-new">Cipta Kerja</small>
                            <span class="card-type-new">📜 Undang-Undang</span>
                        </div>
                    </div>
                    <div class="card-item-new">
                        <div class="card-icon-new">
                            <i class="fas fa-gavel"></i>
                        </div>
                        <div class="card-content-new">
                            <span class="card-title-new">UU No. 1 Tahun 2023</span>
                            <small class="card-subtitle-new">Kitab Undang-Undang Hukum Pidana</small>
                            <span class="card-type-new">📜 Undang-Undang</span>
                        </div>
                    </div>
                    <div class="card-item-new">
                        <div class="card-icon-new">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <div class="card-content-new">
                            <span class="card-title-new">UU No. 11 Tahun 2020</span>
                            <small class="card-subtitle-new">Cipta Kerja</small>
                            <span class="card-type-new">📜 Undang-Undang</span>
                        </div>
                    </div>
                    <div class="card-item-new">
                        <div class="card-icon-new">
                            <i class="fas fa-gavel"></i>
                        </div>
                        <div class="card-content-new">
                            <span class="card-title-new">UU No. 1 Tahun 2023</span>
                            <small class="card-subtitle-new">Kitab Undang-Undang Hukum Pidana</small>
                            <span class="card-type-new">📜 Undang-Undang</span>
                        </div>
                    </div>
                    <div class="card-item-new">
                        <div class="card-icon-new">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <div class="card-content-new">
                            <span class="card-title-new">UUU No. 11 Tahun 2020</span>
                            <small class="card-subtitle-new">Cipta Kerja</small>
                            <span class="card-type-new">📜 Undang-Undang</span>
                        </div>
                    </div>

                </div>
            </div>
            <button id="carousel-next" class="carousel-btn next-btn"><i class="fas fa-chevron-right"></i></button>
        </div>
    </section>

    <script>
        const carouselTrack = document.querySelector('.carousel-track');
        const prevBtn = document.getElementById('carousel-prev');
        const nextBtn = document.getElementById('carousel-next');

        // Mengambil semua elemen kartu
        const cardItems = document.querySelectorAll('.card-item-new');

        // Menghitung lebar total satu kartu, termasuk gap
        const cardWidth = cardItems[0].offsetWidth + 25;

        // Indeks untuk melacak posisi
        let currentIndex = 0;
        let autoScroll;

        // Duplikasi kartu untuk menciptakan efek loop
        cardItems.forEach(card => {
            const clone = card.cloneNode(true);
            carouselTrack.appendChild(clone);
        });

        function updateCarousel() {
            carouselTrack.style.transform = `translateX(${-currentIndex * cardWidth}px)`;
        }

        function nextSlide() {
            currentIndex++;
            if (currentIndex >= cardItems.length) {
                // Jika sudah mencapai akhir, segera kembali ke awal tanpa transisi
                carouselTrack.style.transition = 'none';
                currentIndex = 0;
                updateCarousel();

                // Atur timeout untuk mengaktifkan kembali transisi dan geser ke slide pertama
                setTimeout(() => {
                    carouselTrack.style.transition = 'transform 0.5s ease';
                    currentIndex = 1;
                    updateCarousel();
                }, 10);

            } else {
                updateCarousel();
            }
        }

        function prevSlide() {
            if (currentIndex === 0) {
                // Jika di awal, geser ke akhir duplikat tanpa transisi
                carouselTrack.style.transition = 'none';
                currentIndex = cardItems.length;
                updateCarousel();

                // Atur timeout untuk mengaktifkan kembali transisi dan geser mundur
                setTimeout(() => {
                    carouselTrack.style.transition = 'transform 0.5s ease';
                    currentIndex--;
                    updateCarousel();
                }, 10);
            } else {
                currentIndex--;
                updateCarousel();
            }
        }

        // Tombol navigasi
        nextBtn.addEventListener('click', () => {
            nextSlide();
            resetAuto();
        });

        prevBtn.addEventListener('click', () => {
            prevSlide();
            resetAuto();
        });

        // Auto scroll
        function startAuto() {
            autoScroll = setInterval(nextSlide, 3000); // 3 detik
        }

        function resetAuto() {
            clearInterval(autoScroll);
            startAuto();
        }

        // Mulai otomatis saat halaman dimuat
        startAuto();
    </script>

    <!-- disini letak pilih pedoman -->
    <style>
        /* Container */
        .pedoman-buttons-wrapper {
            max-width: 900px;
            margin: 50px auto;
            padding: 0 20px;
        }

        .pedoman-buttons-wrapper h2 {
            font-size: 1.7rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 25px;
            text-align: center;
        }

        /* Tombol container */
        .pedoman-buttons {
            display: flex;
            justify-content: center;
            gap: 25px;
            flex-wrap: wrap;
        }

        /* Tombol */
        .pedoman-btn {
            background: linear-gradient(145deg, var(--primary), var(--primary-dark));
            color: #fff;
            padding: 20px 34px;
            border-radius: 20px;
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 14px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 28px rgba(10, 77, 146, 0.25);
            transition: all .4s ease;
        }

        /* Efek cahaya */
        .pedoman-btn::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.1);
            transform: skewX(-25deg);
            transition: left .5s ease;
        }

        /* Hover tombol */
        .pedoman-btn:hover::after {
            left: 100%;
        }

        .pedoman-btn:hover {
            transform: translateY(-6px) scale(1.02);
            box-shadow: 0 14px 36px rgba(10, 77, 146, 0.35);
        }

        /* Ikon */
        .pedoman-btn i {
            font-size: 1.8rem;
            transition: transform .4s ease, color .4s ease;
            color: #ffd34e;
        }

        .pedoman-btn:hover i {
            transform: scale(1.2) rotate(-5deg);
            color: #fff;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .pedoman-buttons {
                flex-direction: column;
                align-items: center;
                gap: 18px;
            }

            .pedoman-btn {
                width: 100%;
                justify-content: center;
                padding: 18px 20px;
                font-size: 1rem;
            }

            .pedoman-btn i {
                font-size: 1.5rem;
            }
        }
    </style>

    <div class="pedoman-buttons-wrapper">
        <h2>Pilih Pedoman</h2>
        <div class="pedoman-buttons">
            <a href="#pedomanaudit" class="pedoman-btn">
                <i class="fa fa-file-invoice-dollar"></i> Lihat Pedoman Audit
            </a>
            <a href="#pedomanreviu" class="pedoman-btn">
                <i class="fa fa-search-plus"></i> Lihat Pedoman Reviu
            </a>
            <a href="#" class="pedoman-btn">
                <i class="fa fa-tasks"></i> Lihat Pedoman Monev
            </a>
        </div>
    </div>

    <!-- pedoman audit -->
    <section class="classification" id="pedomanaudit">
        <div class="classification-header">
            <h2>Pedoman <span class="audit-text">Audit</span></h2>
            <div class="header-actions">
                <a href="#"><i class="fa fa-chart-bar"></i> Lihat Lebih</a>

                @if(Auth::check() && Auth::user()->role === 'admin')
                    <a href="#" id="btnTambahAudit">
                        <i class="fa fa-plus"></i> Tambah Pedoman
                    </a>
                @endif
            </div>
        </div>

        <div class="grid">
            @forelse($pedomanAudit as $pedoman)
                <div class="card">
                    <div class="card-icon-wrapper">
                        <i class="fa fa-file-alt"></i>
                    </div>
                    <div class="card-content">
                        <h3>{{ $pedoman->judul }}</h3>
                        <p>Tahun: {{ $pedoman->tahun ?? '-' }}</p>
                    </div>
                    @if($pedoman->file_pdf)
                        <a href="#" class="card-link" data-id="{{ $pedoman->id }}">
                            Lihat Peraturan →
                        </a>
                    @else
                        <a href="{{ route('pedoman.show', $pedoman->id) }}" class="card-link">
                            Lihat Peraturan →
                        </a>

                    @endif
                </div>
            @empty
                <p>Tidak ada pedoman audit.</p>
            @endforelse
        </div>
    </section>


    <!-- pedoman reviu -->
    <section class="classification" id="pedomanreviu">
        <div class="classification-header">
            <h2>Pedoman <span class="audit-text">Reviu</span></h2>
            <div class="header-actions">
                <a href="#"><i class="fa fa-chart-bar"></i> Lihat Lebih</a>

                @if(Auth::check() && Auth::user()->role === 'admin')
                    <a href="#" id="btnTambahAudit">
                        <i class="fa fa-plus"></i> Tambah Pedoman
                    </a>
                @endif
            </div>
        </div>
        <div class="grid">
            <div class="card">
                <div class="card-icon-wrapper">
                    <i class="fa fa-file-alt"></i>
                </div>
                <div class="card-content">
                    <h3>Peraturan BPK</h3>
                    <p>Kumpulan Peraturan Badan Pemeriksa Keuangan.</p>
                </div>
                <a href="#" class="card-link">Lihat Peraturan →</a>
            </div>
            <div class="card">
                <div class="card-icon-wrapper">
                    <i class="fa fa-landmark"></i>
                </div>
                <div class="card-content">
                    <h3>Peraturan Perundang-undangan Pusat</h3>
                    <p>UU, PP, Perpres, dan lainnya.</p>
                </div>
                <a href="#" class="card-link">Lihat Peraturan →</a>
            </div>
            <div class="card">
                <div class="card-icon-wrapper">
                    <i class="fa fa-building"></i>
                </div>
                <div class="card-content">
                    <h3>Peraturan Kementerian/Lembaga</h3>
                    <p>Permendagri, Permenkeu, dan lainnya.</p>
                </div>
                <a href="{{ route('pedoman.show', $pedoman->id) }}" class="card-link">Lihat Peraturan →</a>

            </div>
            <div class="card">
                <div class="card-icon-wrapper">
                    <i class="fa fa-map-marked-alt"></i>
                </div>
                <div class="card-content">
                    <h3>Peraturan Daerah</h3>
                    <p>Perda, Pergub, Perwali, dan lainnya.</p>
                </div>
                <a href="#" class="card-link">Lihat Peraturan →</a>
            </div>
        </div>
    </section>

    <!-- Modal Tambah Pedoman -->
    <div id="modalTambahPedoman" class="modal">
        <div class="modal-box">
            <button class="close" id="closeModalTambah" aria-label="Close modal">&times;</button>
            <h2 class="modal-title">Tambah Dokumen Pedoman</h2>
            {{-- Pesan error umum (misal gagal simpan) --}}
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Pesan validasi dari Laravel --}}
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul style="margin:0; padding-left:20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="stepper-nav" role="tablist" aria-label="Form Steps">
                <button class="step-nav-item active" data-step="1" role="tab" aria-selected="true"
                    aria-controls="step1-content" id="step1">
                    <span class="step-number">1</span> Materi Pokok
                </button>
                <button class="step-nav-item" data-step="2" role="tab" aria-selected="false"
                    aria-controls="step2-content" id="step2">
                    <span class="step-number">2</span> Metadata
                </button>
                <button class="step-nav-item" data-step="3" role="tab" aria-selected="false"
                    aria-controls="step3-content" id="step3">
                    <span class="step-number">3</span> Berkas & Status
                </button>
            </div>

            <form id="formTambahPedoman" action="{{ route('pedoman.store') }}" method="POST"
                enctype="multipart/form-data" novalidate>
                @csrf

                <section class="step-content active" data-step="1" id="step1-content" role="tabpanel"
                    aria-labelledby="step1">
                    <div class="form-section-header">
                        <h4>Materi Pokok Dokumen</h4>
                        <p class="section-desc">Informasi dasar dokumen seperti judul, tahun, dan ringkasan.</p>
                    </div>
                    <div class="form-group">
                        <label>Pilih Jenis Pedoman <span class="required">*</span></label>
                        <div class="button-group">
                            <button type="button" class="btn btn-outline" data-jenis="audit">Pedoman Audit</button>
                            <button type="button" class="btn btn-outline" data-jenis="reviu">Pedoman Reviu</button>
                            <button type="button" class="btn btn-outline" data-jenis="monev">Pedoman Monev</button>
                        </div>
                        <input type="hidden" name="jenis" id="jenisPedoman" required>
                    </div>

                    <div class="form-group">
                        <label for="judul">Judul <span class="required">*</span></label>
                        <input type="text" id="judul" name="judul" required placeholder="Masukkan judul peraturan">
                    </div>
                    <div class="form-group">
                        <label for="tahun">Tahun <span class="required">*</span></label>
                        <select id="tahun" name="tahun" required>
                            <option value="">Pilih Tahun</option>
                            @for ($y = date('Y'); $y >= 1900; $y--)
                                <option value="{{ $y }}">{{ $y }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kata_kunci">Kata Kunci</label>
                        <input type="text" id="kata_kunci" name="kata_kunci"
                            placeholder="Pisahkan dengan koma, contoh: pajak, bea cukai">
                    </div>
                    <div class="form-group">
                        <label for="abstrak">Abstrak</label>
                        <textarea id="abstrak" name="abstrak" rows="4"
                            placeholder="Tuliskan ringkasan isi peraturan"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="catatan">Catatan</label>
                        <textarea id="catatan" name="catatan" rows="2"
                            placeholder="Catatan atau informasi tambahan"></textarea>
                    </div>
                </section>

                <section class="step-content" data-step="2" id="step2-content" role="tabpanel" aria-labelledby="step2">
                    <div class="form-section-header">
                        <h4>Metadata Dokumen</h4>
                        <p class="section-desc">Detail teknis dokumen seperti nomor, tanggal, dan sumber.</p>
                    </div>
                    <div class="grid-2">
                        <div class="form-group">
                            <label for="tipe_dokumen">Tipe Dokumen</label>
                            <input type="text" id="tipe_dokumen" name="tipe_dokumen"
                                placeholder="Contoh: Peraturan Pemerintah">
                        </div>
                        <div class="form-group">
                            <label for="judul_meta">Judul Metadata</label>
                            <input type="text" id="judul_meta" name="judul_meta" placeholder="Judul metadata">
                        </div>
                        <div class="form-group">
                            <label for="teu">T.E.U.</label>
                            <input type="text" id="teu" name="teu" placeholder="Tanda Efektif Umum">
                        </div>
                        <div class="form-group">
                            <label for="nomor">Nomor</label>
                            <input type="text" id="nomor" name="nomor" placeholder="Nomor peraturan">
                        </div>
                        <div class="form-group">
                            <label for="bentuk">Bentuk</label>
                            <input type="text" id="bentuk" name="bentuk" placeholder="Bentuk peraturan">
                        </div>
                        <div class="form-group">
                            <label for="bentuk_singkat">Bentuk Singkat</label>
                            <input type="text" id="bentuk_singkat" name="bentuk_singkat" placeholder="Singkatan bentuk">
                        </div>
                        <div class="form-group">
                            <label for="tahun_meta">Tahun Metadata</label>
                            <select id="tahun_meta" name="tahun_meta">
                                <option value="">Pilih Tahun</option>
                                @for ($y = date('Y'); $y >= 1900; $y--)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tempat_penetapan">Tempat Penetapan</label>
                            <input type="text" id="tempat_penetapan" name="tempat_penetapan"
                                placeholder="Lokasi penetapan">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_penetapan">Tanggal Penetapan</label>
                            <input type="date" id="tanggal_penetapan" name="tanggal_penetapan">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_pengundangan">Tanggal Pengundangan</label>
                            <input type="date" id="tanggal_pengundangan" name="tanggal_pengundangan">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_berlaku">Tanggal Berlaku</label>
                            <input type="date" id="tanggal_berlaku" name="tanggal_berlaku">
                        </div>
                        <div class="form-group">
                            <label for="sumber">Sumber</label>
                            <input type="text" id="sumber" name="sumber" placeholder="Sumber peraturan">
                        </div>
                        <div class="form-group">
                            <label for="subjek">Subjek</label>
                            <input type="text" id="subjek" name="subjek" placeholder="Subjek terkait">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <input type="text" id="status" name="status" placeholder="Status peraturan">
                        </div>
                        <div class="form-group">
                            <label for="bahasa">Bahasa</label>
                            <input type="text" id="bahasa" name="bahasa" placeholder="Bahasa dokumen">
                        </div>
                        <div class="form-group">
                            <label for="lokasi">Lokasi</label>
                            <input type="text" id="lokasi" name="lokasi" placeholder="Lokasi penyimpanan">
                        </div>
                        <div class="form-group">
                            <label for="bidang">Bidang</label>
                            <input type="text" id="bidang" name="bidang" placeholder="Bidang terkait">
                        </div>
                    </div>
                </section>

                <section class="step-content" data-step="3" id="step3-content" role="tabpanel" aria-labelledby="step3">
                    <div class="form-section-header">
                        <h4>Berkas Dokumen & Status</h4>
                        <p class="section-desc">Unggah file dokumen dan isi informasi status.</p>
                    </div>
                    <div class="form-group file-upload-group">
                        <label for="file_pdf" class="file-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon-upload">
                                <path
                                    d="M4 14.899V20a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-5.101M16 16l-4-4-4 4M12 12.5V2.5" />
                            </svg>
                            Pilih Berkas PDF
                        </label>
                        <input type="file" id="file_pdf" name="file_pdf" accept="application/pdf"
                            aria-describedby="fileHelp" />
                        <span id="file-name" class="file-name-display">Belum ada file yang dipilih.</span>
                        <small id="fileHelp" class="file-help">Format: PDF, maksimal 10MB.</small>
                    </div>

                    <div class="form-group">
                        <label for="mencabut">Mencabut</label>
                        <input type="text" id="mencabut" name="mencabut" placeholder="Tuliskan peraturan yang dicabut">
                    </div>
                </section>

                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" id="prevStep"
                        aria-label="Kembali ke langkah sebelumnya" style="display:none;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon-arrow">
                            <line x1="19" y1="12" x2="5" y2="12"></line>
                            <polyline points="12 19 5 12 12 5"></polyline>
                        </svg>
                        Kembali
                    </button>
                    <button type="button" class="btn btn-primary" id="nextStep"
                        aria-label="Lanjut ke langkah berikutnya">
                        Lanjut
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon-arrow">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </button>
                    <button type="submit" class="btn btn-submit" id="submitBtn" style="display:none"
                        aria-label="Simpan data">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon-save">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 3 7 8 15 8"></polyline>
                        </svg>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .button-group .btn-outline {
            background: #ecf0f1;
            color: #34495e;
            border: 1px solid #bdc3c7;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .button-group .btn-outline:hover {
            background: #3498db;
            color: #fff;
            border-color: #2980b9;
        }

        .button-group .btn-outline.active {
            background: #2980b9;
            color: #fff;
            border-color: #2980b9;
        }

        select {
            width: 100%;
            padding: 12px 18px;
            font-size: 1rem;
            border: 1px solid #dfe6e9;
            border-radius: 10px;
            background-color: #f7f9fb;
            transition: all 0.3s ease;
            font-family: inherit;
            color: #2c3e50;
        }

        select:focus {
            border-color: #3498db;
            box-shadow: 0 0 10px rgba(52, 152, 219, 0.2);
            background-color: #fff;
            outline: none;
        }

        .alert {
            padding: 12px 18px;
            border-radius: 8px;
            font-size: 0.95rem;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #e8f8f5;
            border: 1px solid #a3e4d7;
            color: #117864;
        }

        .alert-danger {
            background: #fdecea;
            border: 1px solid #f5c2c7;
            color: #b71c1c;
        }


        /* Styling improvements for a modern look */
        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #e9eff5;
            color: #34495e;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            inset: 0;
            background: rgba(44, 62, 80, 0.7);
            backdrop-filter: blur(8px);
            padding: 30px 15px;
            overflow-y: auto;
            transition: all 0.4s ease;
        }

        .modal-box {
            background: #ffffff;
            max-width: 700px;
            margin: 40px auto;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            padding: 40px 50px;
            position: relative;
            animation: modalPop 0.45s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
        }

        .close {
            position: absolute;
            top: 20px;
            right: 25px;
            font-size: 2.5rem;
            color: #aeb6bf;
            background: none;
            border: none;
            cursor: pointer;
            transition: color 0.3s ease, transform 0.2s ease;
            line-height: 1;
        }

        .close:hover {
            color: #e74c3c;
            transform: rotate(90deg);
        }

        .modal-title {
            font-size: 2rem;
            font-weight: 700;
            color: #34495e;
            text-align: center;
            margin-bottom: 25px;
            position: relative;
        }

        .modal-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background: #3498db;
            margin: 10px auto 0;
            border-radius: 2px;
        }

        /* Stepper Navigation */
        .stepper-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            position: relative;
        }

        .stepper-nav::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 4px;
            background: #ecf0f1;
            z-index: 1;
            transform: translateY(-50%);
        }

        .stepper-nav .step-nav-item {
            flex: 1;
            background: #ecf0f1;
            color: #95a5a6;
            font-weight: 600;
            font-size: 1rem;
            padding: 12px 10px;
            border-radius: 50px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .step-nav-item .step-number {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #bdc3c7;
            color: #fff;
            font-weight: 700;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .stepper-nav .step-nav-item.active {
            background: #3498db;
            color: #fff;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.4);
            transform: translateY(-5px);
        }

        .stepper-nav .step-nav-item.active .step-number {
            background: #2980b9;
        }

        .stepper-nav .step-nav-item:hover:not(.active) {
            background: #d4e6f1;
            color: #2c3e50;
        }

        .stepper-nav .step-nav-item:focus-visible {
            outline: 3px solid #85c1e9;
            outline-offset: 4px;
        }

        .step-content {
            display: none;
            animation: fadeInContent 0.5s cubic-bezier(0.39, 0.575, 0.565, 1) forwards;
        }

        .step-content.active {
            display: block;
        }

        /* Form Sections */
        .form-section-header {
            margin-bottom: 25px;
            border-bottom: 1px solid #dfe6e9;
            padding-bottom: 15px;
        }

        .form-section-header h4 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #34495e;
            margin-bottom: 5px;
        }

        .form-section-header .section-desc {
            font-size: 0.9rem;
            color: #7f8c8d;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #555;
            font-size: 0.95rem;
        }

        .required {
            color: #e74c3c;
            margin-left: 2px;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 12px 18px;
            font-size: 1rem;
            border: 1px solid #dfe6e9;
            border-radius: 10px;
            background-color: #f7f9fb;
            transition: all 0.3s ease;
            font-family: inherit;
            color: #2c3e50;
        }

        input:focus,
        textarea:focus {
            border-color: #3498db;
            box-shadow: 0 0 10px rgba(52, 152, 219, 0.2);
            background-color: #fff;
            outline: none;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
        }

        /* File Upload */
        .file-upload-group {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        input[type="file"] {
            display: none;
        }

        .file-label {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #3498db;
            color: #fff;
            padding: 12px 22px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            user-select: none;
            transition: background 0.3s ease, box-shadow 0.3s ease;
            font-size: 1rem;
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.2);
        }

        .file-label:hover {
            background: #2980b9;
            box-shadow: 0 6px 15px rgba(41, 128, 185, 0.3);
        }

        .icon-upload {
            width: 22px;
            height: 22px;
        }

        .file-name-display {
            margin-top: 10px;
            font-size: 0.9rem;
            color: #555;
            font-style: italic;
        }

        .file-help {
            font-size: 0.8rem;
            color: #95a5a6;
            margin-top: 4px;
        }

        /* Buttons */
        .form-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
            gap: 20px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 25px;
            font-weight: 600;
            font-size: 1rem;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            user-select: none;
            border: none;
        }

        .btn-primary {
            background: #3498db;
            color: #fff;
        }

        .btn-primary:hover {
            background: #2980b9;
            box-shadow: 0 5px 15px rgba(41, 128, 185, 0.3);
        }

        .btn-secondary {
            background: #ecf0f1;
            color: #7f8c8d;
            border: 1px solid #bdc3c7;
        }

        .btn-secondary:hover {
            background: #d4e6f1;
            color: #34495e;
        }

        .btn-submit {
            flex-grow: 1;
            background: #2980b9;
            color: #fff;
            font-weight: 700;
            font-size: 1.1rem;
            padding: 15px 0;
            box-shadow: 0 5px 20px rgba(46, 204, 113, 0.3);
        }

        .btn-submit:hover {
            background: #27ae60;
            box-shadow: 0 8px 25px rgba(39, 174, 96, 0.4);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .modal-box {
                padding: 30px;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }

            .stepper-nav {
                flex-direction: column;
                gap: 15px;
                margin-bottom: 30px;
            }

            .stepper-nav::before {
                display: none;
            }

            .stepper-nav .step-nav-item {
                width: 100%;
                justify-content: flex-start;
                padding-left: 20px;
            }
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const modalTambah = document.getElementById("modalTambahPedoman");
            const btnOpenModal = document.querySelectorAll("#btnTambahAudit, #btnTambahReviu");
            const btnCloseModal = document.getElementById("closeModalTambah");

            const steps = document.querySelectorAll(".step-nav-item");
            const contents = document.querySelectorAll(".step-content");
            const nextBtn = document.getElementById("nextStep");
            const prevBtn = document.getElementById("prevStep");
            const submitBtn = document.getElementById("submitBtn");
            let currentStep = 0;

            // --- Button Jenis Pedoman ---
            const jenisButtons = document.querySelectorAll('.button-group .btn-outline');
            const jenisInput = document.getElementById('jenisPedoman');

            jenisButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    // Hapus active dari semua tombol
                    jenisButtons.forEach(b => b.classList.remove('active'));
                    // Aktifkan tombol yang diklik
                    btn.classList.add('active');
                    // Set value hidden input
                    jenisInput.value = btn.getAttribute('data-jenis');
                });
            });

            // Function to show/hide steps and buttons
            function showStep(index) {
                contents.forEach((c, i) => c.classList.toggle("active", i === index));
                steps.forEach((s, i) => s.classList.toggle("active", i === index));

                prevBtn.style.display = index === 0 ? "none" : "inline-flex";
                nextBtn.style.display = index === contents.length - 1 ? "none" : "inline-flex";
                submitBtn.style.display = index === contents.length - 1 ? "inline-flex" : "none";
            }

            // Function to validate the current step
            function validateStep(index) {
                const currentContent = contents[index];
                const requiredInputs = currentContent.querySelectorAll("[required]");
                let isValid = true;

                requiredInputs.forEach(input => {
                    if (!input.value) {
                        input.classList.add("is-invalid");
                        isValid = false;
                    } else {
                        input.classList.remove("is-invalid");
                    }
                });

                if (!isValid) {
                    alert("Harap lengkapi semua bidang yang wajib diisi (*).");
                }
                return isValid;
            }

            // --- Event Listeners for Modal Control ---
            btnOpenModal.forEach(btn => {
                btn.addEventListener("click", function (e) {
                    e.preventDefault();
                    modalTambah.style.display = "block";
                    currentStep = 0;
                    showStep(currentStep);
                });
            });

            if (btnCloseModal) {
                btnCloseModal.addEventListener("click", function () {
                    modalTambah.style.display = "none";
                });
            }

            window.addEventListener("click", function (e) {
                if (e.target === modalTambah) {
                    modalTambah.style.display = "none";
                }
            });

            // --- Event Listeners for Stepper ---
            steps.forEach((step, idx) => {
                step.addEventListener("click", () => {
                    if (idx < currentStep) {
                        currentStep = idx;
                        showStep(currentStep);
                    } else if (idx > currentStep) {
                        if (validateStep(currentStep)) {
                            currentStep = idx;
                            showStep(currentStep);
                        }
                    }
                });
            });

            nextBtn.addEventListener("click", () => {
                if (validateStep(currentStep)) {
                    if (currentStep < contents.length - 1) {
                        currentStep++;
                        showStep(currentStep);
                    }
                }
            });

            prevBtn.addEventListener("click", () => {
                if (currentStep > 0) {
                    currentStep--;
                    showStep(currentStep);
                }
            });

            // Initial state
            showStep(currentStep);

            // --- File input display ---
            const fileInput = document.getElementById("file_pdf");
            const fileNameDisplay = document.getElementById("file-name");

            if (fileInput && fileNameDisplay) {
                fileInput.addEventListener("change", function () {
                    if (this.files.length > 0) {
                        fileNameDisplay.textContent = this.files[0].name;
                    } else {
                        fileNameDisplay.textContent = "Belum ada file yang dipilih.";
                    }
                });
            }
        });
    </script>

    @include('layouts.NavbarBawah')
</body>

</html>