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
            max-width: 1180px;
            margin: 40px auto;
            background: var(--white);
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: var(--shadow);
        }

        .classification-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
        }

        .classification-header h2 {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary);
        }

        .classification-header a {
            background: var(--primary);
            color: #fff;
            padding: 8px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: background .3s;
        }

        .classification-header a:hover {
            background: var(--primary-dark);
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 22px;
        }

        .card {
            background: linear-gradient(145deg, #f9fbfd, #e9eef5);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
        }

        .card-icon-wrapper {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
            box-shadow: 0 4px 10px rgba(10, 77, 146, 0.2);
        }

        .card-icon-wrapper i {
            font-size: 1.8rem;
            color: #fff;
            margin-bottom: 0;
        }

        .card-content h3 {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--primary-dark);
        }

        .card-content p {
            font-size: .95rem;
            line-height: 1.5;
            color: #555;
            margin-bottom: 16px;
        }

        .card-link {
            text-decoration: none;
            font-weight: 600;
            color: var(--primary);
            font-size: .95rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: color 0.3s, transform 0.3s;
        }

        .card-link:hover {
            color: var(--primary-dark);
            text-decoration: underline;
            transform: translateX(3px);
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
            background: #f1f2f5;
            color: #555;
            padding: 10px 24px;
            border: none;
            border-radius: 40px;
            font-weight: 600;
            cursor: pointer;
            transition: background .3s;
        }

        .btn-cancel:hover {
            background: #e3e5ea;
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
            text-align: center;
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 35px;
            text-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
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
            <a href="#" class="pedoman-btn">
                <i class="fa fa-file-invoice-dollar"></i> Lihat Pedoman Audit
            </a>
            <a href="#" class="pedoman-btn">
                <i class="fa fa-search-plus"></i> Lihat Pedoman Reviu
            </a>
            <a href="#" class="pedoman-btn">
                <i class="fa fa-tasks"></i> Lihat Pedoman Monev
            </a>
        </div>
    </div>

    <!-- pedoman audit -->
    <section class="classification">
        <div class="classification-header">
            <h2>Pedoman <span class="audit-text">Audit</span></h2>
            <a href="#"><i class="fa fa-chart-bar"></i> Lihat Statistik</a>
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
                <a href="{{ route('detail-pedoman') }}" class="card-link">Lihat Peraturan →</a>
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

    @include('layouts.NavbarBawah')
</body>

</html>