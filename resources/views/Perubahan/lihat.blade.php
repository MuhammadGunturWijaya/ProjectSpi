<!DOCTYPE html>
<html lang="id">
<style>
    body {
                   overflow-x: hidden;
        }
</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Peraturan JDIH BPK</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/pedomanPengawasan.css') }}">
    <style>
    </style>
</head>

<body>

    @include('layouts.navbar')

    <header>
        <div class="header-text-container">
            <h1>LIHAT LEBIH {{ $title }} </h1>
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

    <div class="container">
        <h2 class="section-title">Daftar {{ $title }}</h2>

        <div class="document-grid">
            @forelse($perubahans as $perubahan)
                <div class="document-card">
                    <div class="card-icon">
                        <i class="fa fa-file-alt"></i>
                    </div>

                    <div class="card-body">
                        <h3 class="card-title">{{ $perubahan->judul }}</h3>
                        <p class="card-subtitle">Tahun: {{ $perubahan->tahun ?? '-' }}</p>
                    </div>

                    <div class="card-actions">
                        <a href="{{ route('perubahan.show', $perubahan->id) }}" class="action-btn view-btn">
                            <i class="fa fa-eye"></i> Lihat
                        </a>

                        @if(Auth::check() && Auth::user()->role === 'admin')
                            <a href="{{ route('perubahan.edit', $perubahan->id) }}" class="action-btn edit-btn">
                                <i class="fa fa-edit"></i> Edit
                            </a>

                            <form action="{{ route('perubahan.destroy', $perubahan->id) }}" method="POST" class="inline-form"
                                onsubmit="return confirm('Yakin ingin menghapus dokumen ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn delete-btn">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <p class="no-data-message">Tidak ada data Perubahan.</p>
            @endforelse
        </div>

        </div>



        <style>
            /* General Body and Container Styling */
            body {
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
                background-color: #f4f7f9;
                color: #334e68;
            }

            .container {
                max-width: 1200px;
                margin: 40px auto;
                padding: 0 20px;
            }

            .section-title {
                font-size: 2.2rem;
                font-weight: 700;
                color: #1a202c;
                text-align: center;
                margin-bottom: 40px;
            }

            /* Grid Layout for Documents */
            .document-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                gap: 25px;
            }

            /* Document Card Styling */
            .document-card {
                background: #ffffff;
                border-radius: 12px;
                box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
                padding: 25px;
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
                transition: transform 0.3s cubic-bezier(0.25, 0.8, 0.25, 1), box-shadow 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            }

            .document-card:hover {
                transform: translateY(-8px);
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            }

            /* Icon */
            .card-icon {
                font-size: 3rem;
                color: #4a90e2;
                margin-bottom: 20px;
            }

            /* Card Body */
            .card-body {
                flex-grow: 1;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                width: 100%;
                margin-bottom: 20px;
            }

            .card-title {
                font-size: 1.25rem;
                font-weight: 600;
                color: #2d3748;
                margin-bottom: 5px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
                width: 100%;
            }

            .card-subtitle {
                font-size: 0.9rem;
                color: #718096;
                font-weight: 400;
            }

            /* Actions */
            .card-actions {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 10px;
                width: 100%;
            }

            .action-btn {
                padding: 10px 15px;
                font-size: 0.9rem;
                font-weight: 500;
                border-radius: 8px;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                transition: all 0.2s ease-in-out;
                border: none;
                cursor: pointer;
                line-height: 1;
            }

            .action-btn i {
                font-size: 0.9rem;
            }

            /* Button Styles */
            .view-btn {
                background: #4a90e2;
                color: #ffffff;
            }

            .view-btn:hover {
                background: #357bd8;
                box-shadow: 0 4px 15px rgba(53, 123, 216, 0.3);
            }

            .edit-btn {
                background: #f7b731;
                color: #ffffff;
            }

            .edit-btn:hover {
                background: #e0a320;
                box-shadow: 0 4px 15px rgba(247, 183, 49, 0.3);
            }

            .delete-btn {
                background: #e74c3c;
                color: #ffffff;
            }

            .delete-btn:hover {
                background: #c0392b;
                box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
            }

            /* Inline form to sit side by side with buttons */
            .inline-form {
                display: inline-block;
            }

            /* No data message */
            .no-data-message {
                grid-column: 1 / -1;
                text-align: center;
                font-size: 1.1rem;
                color: #718096;
                padding: 30px;
                background: #ffffff;
                border-radius: 12px;
                box-shadow: 0 5px 20px rgba(0, 0, 0, 0.03);
            }
        </style>



        @include('layouts.NavbarBawah')
</body>

</html>