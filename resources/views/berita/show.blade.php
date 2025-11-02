<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $berita->judul }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Merriweather:wght@300;400;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #fafafa;
            color: #1a1a1a;
            overflow-x: hidden;
            line-height: 1.7;
        }

        /* Breadcrumb */
        .breadcrumb {
            background: transparent;
            padding: 0;
            margin-bottom: 2rem;
            font-size: 0.85rem;
        }

        .breadcrumb-item a {
            color: #737373;
            text-decoration: none;
            transition: color 0.2s;
        }

        .breadcrumb-item a:hover {
            color: #1a1a1a;
        }

        .breadcrumb-item.active {
            color: #a3a3a3;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            color: #d4d4d4;
        }

        /* Article Container */
        .article-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 3rem 2rem;
        }

        /* Article Header */
        .article-header {
            margin-bottom: 2.5rem;
        }

        .article-title {
            font-family: 'Merriweather', Georgia, serif;
            font-size: 2.25rem;
            font-weight: 700;
            line-height: 1.3;
            color: #1a1a1a;
            margin-bottom: 1.5rem;
            letter-spacing: -0.02em;
        }

        /* Meta Info */
        .article-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #e5e5e5;
            font-size: 0.9rem;
            color: #737373;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .meta-item i {
            color: #a3a3a3;
            font-size: 0.95rem;
        }

        /* Featured Image */
        .featured-image {
            margin: 2.5rem 0;
            position: relative;
        }

        .featured-image img {
            width: 100%;
            height: auto;
            max-height: 500px;
            object-fit: cover;
            border-radius: 8px;
            display: block;
        }

        /* Article Content */
        .article-content {
            font-family: 'Merriweather', Georgia, serif;
            font-size: 1.1rem;
            line-height: 1.8;
            color: #262626;
            margin: 2.5rem 0;
        }

        .article-content p {
            margin-bottom: 1.5rem;
        }

        /* Back Button */
        .action-section {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid #e5e5e5;
        }

        .btn-back {
            background-color: #1a1a1a;
            color: #ffffff;
            border: none;
            padding: 0.65rem 1.75rem;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn-back:hover {
            background-color: #2d2d2d;
            color: #ffffff;
            transform: translateX(-3px);
        }

        .btn-back i {
            font-size: 1rem;
        }

        /* Share Buttons (Optional - Uncomment if needed) */
        .share-section {
            margin-top: 3rem;
            padding: 1.5rem;
            background-color: #f5f5f5;
            border-radius: 8px;
        }

        .share-title {
            font-size: 0.9rem;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 1rem;
        }

        .share-buttons {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .btn-share {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.2s ease;
            border: 1px solid #e5e5e5;
            background-color: #ffffff;
        }

        .btn-share:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-share.facebook {
            color: #1877f2;
        }

        .btn-share.facebook:hover {
            background-color: #1877f2;
            color: #ffffff;
            border-color: #1877f2;
        }

        .btn-share.twitter {
            color: #1da1f2;
        }

        .btn-share.twitter:hover {
            background-color: #1da1f2;
            color: #ffffff;
            border-color: #1da1f2;
        }

        .btn-share.whatsapp {
            color: #25d366;
        }

        .btn-share.whatsapp:hover {
            background-color: #25d366;
            color: #ffffff;
            border-color: #25d366;
        }

        /* Reading Progress Bar */
        .reading-progress {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 3px;
            background: linear-gradient(90deg, #1a1a1a 0%, #525252 100%);
            z-index: 1000;
            transition: width 0.1s ease;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .article-container {
                padding: 2rem 1rem;
            }

            .article-title {
                font-size: 1.75rem;
            }

            .article-meta {
                gap: 1rem;
            }

            .article-content {
                font-size: 1.05rem;
            }

            .featured-image {
                margin: 2rem -1rem;
            }

            .featured-image img {
                border-radius: 0;
            }
        }

        /* Loading Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .article-container {
            animation: fadeIn 0.6s ease;
        }
    </style>
</head>

<body>
    <!-- Reading Progress Bar -->
    <div class="reading-progress" id="progressBar"></div>

    @include('layouts.navbar')

    <div class="article-container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('landing') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('berita.index') }}">Berita</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($berita->judul, 50) }}</li>
            </ol>
        </nav>

        <!-- Article Header -->
        <header class="article-header">
            <h1 class="article-title">
                {{ $berita->judul }}
            </h1>

            <div class="article-meta">
                <div class="meta-item">
                    <i class="bi bi-folder"></i>
                    <span>Uncategorized</span>
                </div>
                <div class="meta-item">
                    <i class="bi bi-calendar3"></i>
                    <span>{{ $berita->tanggal }}</span>
                </div>
                <div class="meta-item">
                    <i class="bi bi-person"></i>
                    <span>Admin</span>
                </div>
                <div class="meta-item">
                    <i class="bi bi-chat"></i>
                    <span>0 Komentar</span>
                </div>
            </div>
        </header>

        <!-- Featured Image -->
        <figure class="featured-image">
            <img src="{{ asset($berita->gambar) }}" alt="{{ $berita->judul }}" loading="lazy">
        </figure>

        <!-- Article Content -->
        <article class="article-content">
            {!! nl2br(e($berita->isi)) !!}
        </article>

        <!-- Share Section (Optional - Uncomment if needed) -->
        <!--
        <div class="share-section">
            <div class="share-title">Bagikan artikel ini:</div>
            <div class="share-buttons">
                <a href="https://facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                   target="_blank" class="btn-share facebook" title="Share on Facebook">
                    <i class="bi bi-facebook"></i>
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($berita->judul) }}"
                   target="_blank" class="btn-share twitter" title="Share on Twitter">
                    <i class="bi bi-twitter"></i>
                </a>
                <a href="https://api.whatsapp.com/send?text={{ urlencode($berita->judul . ' - ' . request()->fullUrl()) }}"
                   target="_blank" class="btn-share whatsapp" title="Share on WhatsApp">
                    <i class="bi bi-whatsapp"></i>
                </a>
            </div>
        </div>
        -->

        <!-- Back Button -->
        <div class="action-section">
            <a href="{{ url()->previous() }}" class="btn-back">
                <i class="bi bi-arrow-left"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>

    @include('layouts.NavbarBawah')

    <script>
        // Reading Progress Bar
        window.addEventListener('scroll', function() {
            const progressBar = document.getElementById('progressBar');
            const windowHeight = window.innerHeight;
            const documentHeight = document.documentElement.scrollHeight - windowHeight;
            const scrolled = window.scrollY;
            const progress = (scrolled / documentHeight) * 100;
            progressBar.style.width = progress + '%';
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>