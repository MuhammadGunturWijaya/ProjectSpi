<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Piagam SPI - Pos AP Pengawasan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <style>
        :root {
            --primary-color: #4f46e5;
            --secondary-color: #f3f4f6;
            --accent-color: #10b981;
            --text-color: #1f2937;
            --card-bg: #ffffff;
            --hover-card: #eef2ff;
            --shadow-light: rgba(0, 0, 0, 0.08);
            --shadow-dark: rgba(0, 0, 0, 0.2);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--secondary-color);
            margin: 0;
            padding: 0;
        }

        /* Header */
        .header-bg {
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            background-image: url('https://i.ytimg.com/vi/DydathDbxUM/maxresdefault.jpg');
            height: 300px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #fff;
            text-align: center;
            border-bottom-left-radius: 50px;
            border-bottom-right-radius: 50px;
            padding: 0 20px;
            position: relative;
            overflow: hidden;
        }

        .header-bg h1 {
            font-size: 3rem;
            font-weight: 700;
            margin: 0;
            letter-spacing: 2px;
            animation: fadeInDown 1s ease forwards;
        }

        .header-bg p {
            font-size: 1.2rem;
            margin-top: 10px;
            opacity: 0.9;
            animation: fadeInUp 1s ease forwards;
        }

        @keyframes fadeInDown {
            0% {
                transform: translateY(-20px);
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            0% {
                transform: translateY(20px);
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Pos Section */
        .pos-section {
            max-width: 1200px;
            margin: -80px auto 50px;
            padding: 40px 30px;
            background: linear-gradient(145deg, #ffffffff, #ffffffff);
            /* gradien halus */
            border-radius: 30px;
            box-shadow: 0 50px 50px var(--shadow-light);
            position: relative;
            z-index: 3;
            overflow: hidden;
        }

        /* Optional: pola overlay menggunakan pseudo-element */
        .pos-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('https://www.transparenttextures.com/patterns/cubes.png');
            /* pola halus */
            opacity: 0.05;
            /* transparansi agar tidak mengganggu konten */
            z-index: 1;
        }

        /* Pastikan konten di dalam section berada di atas overlay */
        .pos-section>* {
            position: relative;
            z-index: 2;
        }


        .pos-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .pos-header h4 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-color);
        }

        .btn-add {
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            color: #fff;
            font-weight: 600;
            padding: 12px 24px;
            border-radius: 50px;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-add:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 25px var(--shadow-dark);
        }

        /* Cards */
        .pos-cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
        }

        .pos-card {
            position: relative;
            background: var(--card-bg);
            border-radius: 25px;
            padding: 25px 20px;
            box-shadow: 0 10px 30px var(--shadow-light);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.4s, box-shadow 0.4s, background 0.3s;
            text-decoration: none;
            color: var(--text-color);
        }

        .pos-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 60px var(--shadow-dark);
            background: var(--hover-card);
        }

        .icon-wrapper {
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
            color: #fff;
            border-radius: 20px;
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            font-size: 2.2rem;
            transition: transform 0.5s ease;
        }

        .pos-card:hover .icon-wrapper {
            transform: rotate(10deg) scale(1.1);
        }

        .pos-card h6 {
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .pos-card small {
            color: #6b7280;
            margin-bottom: 15px;
            display: block;
        }

        .link-cta {
            font-weight: 600;
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.3s, transform 0.3s;
        }

        .pos-card:hover .link-cta {
            transform: translateX(5px);
        }

        .link-cta::after {
            content: "→";
            margin-left: 5px;
        }

        .badge-card {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 0.8rem;
            padding: 6px 14px;
            border-radius: 50px;
            background-color: var(--accent-color);
            color: #fff;
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            color: #fff;
            padding: 40px 20px;
            text-align: center;
            border-top-left-radius: 40px;
            border-top-right-radius: 40px;
            box-shadow: 0 -10px 25px rgba(0, 0, 0, 0.2);
        }

        footer a {
            color: #fff;
            margin: 0 15px;
            font-size: 1.6rem;
            transition: color 0.3s;
        }

        footer a:hover {
            color: var(--accent-color);
        }
    </style>
</head>

<body>
    @include('layouts.navbar')

    <div class="header-bg">
        <h1>PIAGAM SPI</h1>
        <p>Kelola Piagam SPI dengan mudah dan cepat</p>
    </div>

    <section class="pos-section container">
        <div class="pos-header">
            <h4>Piagam SPI</h4>
            <button class="btn-add"><i class="bi bi-plus-lg"></i> Tambah Piagam</button>
        </div>

        <div class="pos-cards-container">
            <a href="#" class="pos-card">
                <span class="badge-card">Baru</span>
                <div>
                    <div class="icon-wrapper">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>
                    <h6>Piagam 123123</h6>
                    <small>Tahun: 2010</small>
                </div>
                <span class="link-cta">Lihat Piagam</span>
            </a>
            <a href="#" class="pos-card">
                <div>
                    <div class="icon-wrapper">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>
                    <h6>Piagam 34C</h6>
                    <small>Tahun: 2008</small>
                </div>
                <span class="link-cta">Lihat Piagam</span>
            </a>
            <a href="#" class="pos-card">
                <div>
                    <div class="icon-wrapper">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>
                    <h6>Piagam 56D</h6>
                    <small>Tahun: 2012</small>
                </div>
                <span class="link-cta">Lihat Piagam</span>
            </a>
        </div>
    </section>

    @include('layouts.NavbarBawah')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>