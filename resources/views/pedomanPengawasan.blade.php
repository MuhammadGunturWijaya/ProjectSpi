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
        }

        /* Search box */
        .search-wrapper {
            max-width: 900px;
            margin: -50px auto 40px;
            background: var(--white);
            border-radius: 50px;
            /* lebih bulat */
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            position: relative;
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
            max-width: 1000px;
            margin: auto;
            display: flex;
            align-items: center;
            gap: 10px;
            /* Jarak antara tombol dan carousel */
            padding: 0 40px;
            /* Memberikan ruang untuk tombol */
        }

        .carousel-track-container {
            overflow: hidden;
            flex: 1;
        }

        .carousel-track {
            display: flex;
            gap: 20px;
            /* animation: slide 30s linear infinite; <-- Hapus ini */
            transition: transform 0.5s ease;
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
            /* Adjust margin for standalone display */
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
            background: #f9fbfd;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            transition: box-shadow .3s;
        }

        .card:hover {
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.08);
        }

        .card i {
            font-size: 1.8rem;
            color: var(--primary);
            margin-bottom: 14px;
        }

        .card h3 {
            font-size: 1.05rem;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .card p {
            font-size: .9rem;
            line-height: 1.5;
            color: #555;
            margin-bottom: 12px;
        }

        .card a {
            text-decoration: none;
            font-weight: 600;
            color: var(--primary);
            font-size: .9rem;
        }

        .card a:hover {
            text-decoration: underline;
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            .classification {
                padding: 30px 20px;
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
        <h1>SELAMAT DATANG<br>DI DATABASE PERATURAN JDIH BPK</h1>
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
                    <div class="card-item">
                        <span>UU No. 1 Tahun 2023</span>
                        <small>Kitab Undang-Undang Hukum Pidana</small>
                    </div>
                    <div class="card-item">
                        <span>UU No. 11 Tahun 2020</span>
                        <small>Cipta Kerja</small>
                    </div>
                    <div class="card-item">
                        <span>UU No. 23 Tahun 2014</span>
                        <small>Pemerintahan Daerah</small>
                    </div>
                    <div class="card-item">
                        <span>Peraturan BPK No. 2 Tahun 2023</span>
                        <small>Tentang Pemeriksaan Keuangan</small>
                    </div>
                    <div class="card-item">
                        <span>UU No. 5 Tahun 2014</span>
                        <small>Aparatur Sipil Negara</small>
                    </div>
                    <div class="card-item">
                        <span>PP No. 45 Tahun 2013</span>
                        <small>Tata Cara Pelaksanaan APBN</small>
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
        const cardItems = document.querySelectorAll('.card-item');

        const cardWidth = cardItems[0].offsetWidth + 20;
        let currentIndex = 0;
        let autoScroll;   // interval id

        function updateCarousel() {
            carouselTrack.style.transform = `translateX(${-currentIndex * cardWidth}px)`;
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % cardItems.length;
            updateCarousel();
        }

        function prevSlide() {
            currentIndex = (currentIndex - 1 + cardItems.length) % cardItems.length;
            updateCarousel();
        }

        // tombol
        nextBtn.addEventListener('click', () => {
            nextSlide();
            resetAuto();
        });

        prevBtn.addEventListener('click', () => {
            prevSlide();
            resetAuto();
        });

        // auto scroll
        function startAuto() {
            autoScroll = setInterval(nextSlide, 3000); // 3 detik
        }
        function resetAuto() {
            clearInterval(autoScroll);
            startAuto();
        }

        startAuto();
    </script>


    <section class="classification">
        <div class="classification-header">
            <h2>Pedoman <span class="audit-text">Audit</span></h2>
            <a href="#"><i class="fa fa-chart-bar"></i> Lihat Statistik</a>
        </div>
        <div class="grid">
            <div class="card">
                <i class="fa fa-file-alt"></i>
                <h3>Peraturan BPK</h3>
                <p>Kumpulan Peraturan Badan Pemeriksa Keuangan.</p>
                <a href="#">Lihat Peraturan →</a>
            </div>
            <div class="card">
                <i class="fa fa-file-alt"></i>
                <h3>Peraturan Perundang-undangan Pusat</h3>
                <p>UU, PP, Perpres, dan lainnya.</p>
                <a href="#">Lihat Peraturan →</a>
            </div>
            <div class="card">
                <i class="fa fa-file-alt"></i>
                <h3>Peraturan Kementerian/Lembaga</h3>
                <p>Permendagri, Permenkeu, dan lainnya.</p>
                <a href="#">Lihat Peraturan →</a>
            </div>
            <div class="card">
                <i class="fa fa-file-alt"></i>
                <h3>Peraturan Daerah</h3>
                <p>Perda, Pergub, Perwali, dan lainnya.</p>
                <a href="#">Lihat Peraturan →</a>
            </div>
        </div>
    </section>

    @include('layouts.NavbarBawah')
</body>

</html>