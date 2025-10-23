<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Peraturan JDIH BPK</title>
    <link rel="stylesheet" href="{{ asset('css/pedomanPengawasan.css') }}">
    <style>
        :root {
            --primary-blue: #0A3D62;
            --secondary-blue: #1C658D;
            --accent-teal: #00BFA6;
            --highlight-yellow: #FFD233;
            --text-dark: #333333;
            --text-light: #666666;
            --bg-light: #F0F4F8;
            --card-bg: #FFFFFF;
            --border-color: #E2E8F0;
            --shadow-subtle: rgba(0, 0, 0, 0.08);
            --shadow-hover: rgba(0, 0, 0, 0.15);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            margin: 0;
            padding: 0;
        }


        .legal-search-container {
            width: 100%;
            max-width: 1450px;
            margin: 50px auto;
            padding: 40px;
            background: linear-gradient(145deg, var(--card-bg), #F8F9FB);
            border-radius: 20px;
            box-shadow: 0 10px 30px var(--shadow-subtle);
            transition: box-shadow 0.3s ease;
        }

        .legal-search-container:hover {
            box-shadow: 0 15px 40px var(--shadow-hover);
        }

        .search-header-panel {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            padding-bottom: 25px;
            margin-bottom: 30px;
            border-bottom: 2px solid var(--border-color);
        }

        .search-header-panel h1 {
            font-size: 32px;
            font-weight: 700;
            color: var(--primary-blue);
            margin: 0;
        }

        .highlight-text {
            color: var(--accent-teal);
        }

        .search-summary {
            font-size: 14px;
            color: var(--text-light);
            margin-top: 8px;
        }

        .result-count {
            font-weight: 600;
            color: var(--primary-blue);
        }

        .search-criteria-chip {
            background-color: var(--border-color);
            padding: 8px 16px;
            border-radius: 25px;
            display: inline-flex;
            align-items: center;
            font-size: 14px;
            font-weight: 500;
        }

        .chip-label {
            color: var(--text-light);
            margin-right: 5px;
        }

        .chip-keyword {
            color: var(--text-dark);
            font-weight: 600;
        }

        .results-grid {
            display: grid;
            gap: 25px;
        }

        .result-card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .result-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border-color: var(--secondary-blue);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
        }

        .card-tag {
            background-color: var(--highlight-yellow);
            color: var(--text-dark);
            font-size: 12px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
        }

        .card-source {
            font-size: 12px;
            color: var(--secondary-blue);
            font-weight: 600;
        }

        .card-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--primary-blue);
            line-height: 1.4;
            margin-top: 0;
            margin-bottom: 15px;
        }

        .card-content .snippet {
            font-size: 14px;
            color: var(--text-light);
            line-height: 1.6;
            margin: 5px 0;
        }

        .highlight {
            background-color: var(--highlight-yellow);
            font-weight: 700;
            padding: 2px 4px;
            border-radius: 4px;
        }

        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px dashed var(--border-color);
        }

        .file-info {
            font-size: 12px;
            color: var(--text-light);
        }

        .download-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: var(--accent-teal);
            color: white;
            padding: 10px 20px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .download-btn:hover {
            background-color: #008C75;
            transform: translateY(-2px);
        }

        .action-bar {
            text-align: center;
            margin-top: 30px;
        }

        .load-more-btn {
            background: var(--primary-blue);
            color: white;
            padding: 12px 28px;
            border: none;
            border-radius: 30px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .load-more-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px var(--shadow-subtle);
        }

        @media (max-width: 768px) {
            .legal-search-container {
                margin: 20px;
                padding: 20px;
            }

            .search-header-panel {
                flex-direction: column;
                align-items: flex-start;
            }

            .search-criteria-chip {
                margin-top: 15px;
            }

            .card-footer {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
        }

        /* buat next slide */
        .pagination-bar {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 12px;
            margin-top: 40px;
            flex-wrap: wrap;
        }

        .page-link,
        .page-number {
            display: inline-block;
            padding: 8px 14px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            color: var(--primary-blue);
            border: 1px solid var(--border-color);
            background: #fff;
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .page-link:hover,
        .page-number:hover {
            background: var(--primary-blue);
            color: #fff;
        }

        .page-number.active {
            background: var(--accent-teal);
            color: #fff;
            border-color: var(--accent-teal);
        }

        .dots {
            font-weight: 700;
            color: var(--text-light);
            padding: 0 6px;
        }
    </style>
</head>

<body>
    @include('layouts.navbar')

    <header>
        <div class="header-text-container">
            <h1>PENCARIAN </h1>
        </div>
    </header>

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
  <div class="search-wrapper">
    <!-- FORM PENCARIAN UTAMA -->
    <form action="{{ route('program-kerja.search') }}" method="GET" class="search-form" style="display: contents;">
        <div class="input-group">
            <input type="text" name="keyword" placeholder="Cari Program Kerja ..." value="{{ request('keyword') }}">
        </div>
        <button type="submit" class="search-btn"><i class="fa fa-search"></i> Cari</button>
        <button type="button" class="adv-btn" id="openAdvModal"><i class="fa fa-sliders-h"></i> Adv. Search</button>
    </form>
</div>

<!-- MODAL ADVANCED SEARCH -->
<div id="advModal" class="modal">
    <div class="modal-box">
        <span class="close">&times;</span>
        <h2 class="modal-title"><i class="fa fa-sliders-h"></i> Advanced Search</h2>

        <form class="adv-form" action="{{ route('program-kerja.search') }}" method="GET">
            <div class="form-group">
                <label for="keyword">Tentang</label>
                <input type="text" name="keyword" id="keyword" placeholder="Masukkan kata kunci ..." value="{{ request('keyword') }}">
            </div>

            <div class="form-group">
                <label for="nomor">Nomor</label>
                <input type="text" name="nomor" id="nomor" placeholder="Contoh: 12" value="{{ request('nomor') }}">
            </div>

            <div class="form-group">
                <label for="tahun">Tahun</label>
                <input type="number" name="tahun" id="tahun" placeholder="2023" value="{{ request('tahun') }}">
            </div>

            <div class="form-group">
                <label for="bidang">Bidang</label>
                <input type="text" name="bidang" id="bidang" placeholder="Contoh: Keuangan, Operasional ..." value="{{ request('bidang') }}">
            </div>

            <div class="form-group">
                <label for="subjek">Subjek</label>
                <input type="text" name="subjek" id="subjek" placeholder="Contoh: Audit, Pengawasan ..." value="{{ request('subjek') }}">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <i class="fa fa-search"></i> Cari
                </button>
            </div>
        </form>
    </div>
</div>

<!-- HASIL PENCARIAN -->
<div class="legal-search-container">
    <div class="search-header-panel">
        <div class="search-info">
            <h1>PENCARIAN <span class="highlight-text">PROGRAM KERJA SPI</span></h1>
            <p class="search-summary">
                Menemukan <span class="result-count">{{ $programKerjaList->total() }}</span> Program Kerja
                @if($keyword)
                    untuk keyword: <strong>{{ $keyword }}</strong>
                @endif
            </p>
        </div>

        <!-- CHIP FILTER -->
        @if($keyword || $nomor || $tahun || $bidang || $subjek)
            <div class="search-criteria-chip">
                @if($keyword)
                    <span class="chip-label">Keyword:</span> <span class="chip-keyword">{{ $keyword }}</span>
                @endif
                @if($nomor)
                    <span class="chip-label">Nomor:</span> <span class="chip-keyword">{{ $nomor }}</span>
                @endif
                @if($tahun)
                    <span class="chip-label">Tahun:</span> <span class="chip-keyword">{{ $tahun }}</span>
                @endif
                @if($bidang)
                    <span class="chip-label">Bidang:</span> <span class="chip-keyword">{{ $bidang }}</span>
                @endif
                @if($subjek)
                    <span class="chip-label">Subjek:</span> <span class="chip-keyword">{{ $subjek }}</span>
                @endif
            </div>
        @endif
    </div>

    <!-- GRID HASIL -->
    <div class="results-grid">
        @forelse($programKerjaList as $item)
            <div class="result-card">
                <div class="card-header">
                    <span class="card-source">{{ $item->nomor ?? '-' }} Tahun {{ $item->tahun ?? '-' }}</span>
                    <span class="card-tag">{{ $item->bidang ?? '-' }}</span>
                </div>

                <h3 class="card-title">
                    <a href="{{ route('program-kerja.show', $item->id) }}" class="detail-link">{{ $item->judul }}</a>
                </h3>

                <div class="card-content">
                    @if($item->abstrak)
                        <p class="snippet">{{ Str::limit($item->abstrak, 200) }}</p>
                    @endif
                </div>

                <div class="card-footer">
                    @if($item->file_pdf)
                        <a href="{{ asset('storage/' . $item->file_pdf) }}" class="download-btn" target="_blank">
                            <i class="fas fa-file-download"></i> Download PDF
                        </a>
                    @else
                        <span>Tidak ada file</span>
                    @endif
                </div>
            </div>
        @empty
            <p>Tidak ada Program Kerja SPI yang sesuai dengan pencarian.</p>
        @endforelse
    </div>

    <!-- PAGINATION -->
    {{ $programKerjaList->links() }}
</div>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    @include('layouts.NavbarBawah')
</body>

</html>