<!DOCTYPE html>
<html lang="id">
<style>
    body {
                   overflow-x: hidden;
        }
</style>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Manajemen SPI</title>
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
            overflow-x: hidden;
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
            background: linear-gradient(145deg, #ffffff, #f1f5f9);
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
        <h1>Manajemen SPI</h1>
        <p>Kelola Manajemen SPI dengan mudah dan cepat</p>
    </div>

    <section class="pos-section container">
        <div class="pos-header">
            <h4>Manajemen SPI</h4>
            <button class="btn-add" data-bs-toggle="modal" data-bs-target="#modalTambahManajemen">
                <i class="bi bi-plus-lg"></i> Tambah Manajemen
            </button>
        </div>


        <div class="pos-cards-container">
            @foreach($manajemenperubahan as $manajemen)
                <a href="#" class="pos-card btn-detail-Manajemen" data-bs-toggle="modal"
                    data-bs-target="#modalDetailManajemen" data-nama="{{ $manajemen->nama_manajemen }}"
                    data-tahun="{{ $manajemen->tahun }}" data-file="{{ asset('storage/' . $manajemen->file_path) }}">
                    @if($loop->first)
                        <span class="badge-card">Baru</span>
                    @endif
                    <div>
                        <div class="icon-wrapper">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <h6>{{ $manajemen->nama_manajemen }}</h6>
                        <small>Tahun: {{ $manajemen->tahun }}</small>
                    </div>
                    <span class="link-cta">Lihat Manajemen</span>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Modal Detail Manajemen -->
    <div class="modal fade" id="modalDetailManajemen" tabindex="-1" aria-labelledby="modalDetailManajemenLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg custom-modal-detail">
                <div class="modal-header bg-gradient-primary text-white rounded-top-4 p-4">
                    <h5 class="modal-title fw-bold" id="modalDetailManajemenLabel">
                        <i class="bi bi-file-earmark-text me-2"></i> Detail Manajemen
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-5">
                    <div class="detail-info mb-4">
                        <h6 id="detailNamaManajemen" class="fw-semibold text-primary fs-4"></h6>
                        <p id="detailTahunManajemen" class="text-muted fw-medium"></p>
                    </div>
                    <div class="iframe-wrapper">
                        <iframe id="detailFileManajemen" src="" frameborder="0" style="width:100%; height:500px;"
                            class="rounded-3 border shadow-sm"></iframe>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary rounded-pill px-4 me-2"
                        data-bs-dismiss="modal">Tutup</button>
                    <a id="downloadManajemen" href="#"
                        class="btn btn-primary rounded-pill px-4 btn-animated-primary shadow-sm" download>
                        <i class="bi bi-download me-2"></i> Unduh Manajemen
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Gradient header */
        .bg-gradient-primary {
            background: linear-gradient(135deg, #4f46e5, #6366f1);
        }

        .custom-modal-detail {
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .custom-modal-detail:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        /* Detail info styling */
        .detail-info h6 {
            font-size: 1.5rem;
            margin-bottom: 5px;
        }

        .detail-info p {
            font-size: 1.1rem;
            color: #6b7280;
        }

        /* Iframe hover effect */
        .iframe-wrapper iframe:hover {
            transform: scale(1.02);
            transition: transform 0.3s ease;
        }

        /* Button animation */
        .btn-animated-primary {
            background: #6366f1;
            color: #fff;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-animated-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            background: linear-gradient(135deg, #4f46e5, #6366f1);
        }
    </style>

    <script>
        const modalDetailManajemen = document.getElementById('modalDetailManajemen');
        const downloadBtn = document.getElementById('downloadManajemen');

        modalDetailManajemen.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const nama = button.getAttribute('data-nama');
            const tahun = button.getAttribute('data-tahun');
            const file = button.getAttribute('data-file');

            document.getElementById('modalDetailManajemenLabel').innerText = 'Detail Manajemen';
            document.getElementById('detailNamaManajemen').innerText = nama;
            document.getElementById('detailTahunManajemen').innerText = 'Tahun: ' + tahun;
            document.getElementById('detailFileManajemen').src = file;

            downloadBtn.href = file; // Set link untuk unduh
        });
    </script>



    <div class="modal fade" id="modalTambahManajemen" tabindex="-1" aria-labelledby="modalTambahManajemenLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 custom-modal-shadow">
                <form action="/upload-Manajemen" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header bg-gradient-primary text-white rounded-top-4 p-4">
                        <h5 class="modal-title fw-bold" id="modalTambahManajemenLabel">
                            <i class="bi bi-award me-2"></i> Tambah Manajemen 🏆
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-5">
                        <div class="mb-4">
                            <label for="namaManajemen" class="form-label fw-semibold text-muted">Nama Manajemen</label>
                            <input type="text" class="form-control form-control-lg custom-input" id="namaManajemen"
                                name="nama_manajemen" placeholder="Contoh: Juara 1 Lomba Sains Nasional" required>
                        </div>
                        <div class="mb-4">
                            <label for="tahunManajemen" class="form-label fw-semibold text-muted">Tahun</label>
                            <input type="number" class="form-control form-control-lg custom-input" id="tahunManajemen"
                                name="tahun" placeholder="Contoh: 2023" required>
                        </div>
                        <div class="mb-4">
                            <label for="fileManajemen" class="form-label fw-semibold text-muted">Upload File</label>
                            <div class="file-upload-area" ondragover="event.preventDefault();"
                                ondrop="handleDrop(event);" onclick="document.getElementById('fileManajemen').click()">
                                <i class="bi bi-file-earmark-arrow-up fs-2 text-primary mb-3"></i>
                                <p class="mb-0 text-muted">Klik atau seret file ke sini untuk mengunggah</p>
                                <small class="text-secondary">File didukung: PDF, JPG, PNG | Max 5 MB</small>
                                <input class="form-control d-none" type="file" id="fileManajemen" name="file_manajemen"
                                    required onchange="updateFileLabel(this)">
                            </div>
                            <small id="fileName" class="text-success mt-2 d-block text-center fw-semibold"></small>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary rounded-pill px-4 me-2"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-5 btn-animated-primary shadow-sm">
                            <i class="bi bi-cloud-arrow-up me-2"></i> Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        :root {
            --primary-color: #6366f1;
            --secondary-color: #f1f5f9;
            --text-color: #475569;
            --border-color: #cbd5e1;
        }

        .custom-modal-shadow {
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, #4f46e5, #6366f1);
        }

        .custom-input {
            border-radius: 0.75rem;
            padding: 1rem 1.25rem;
            background-color: var(--secondary-color);
            border: 1px solid var(--border-color);
            transition: all 0.2s ease-in-out;
        }

        .custom-input:focus {
            background-color: #fff;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(99, 102, 241, 0.2);
        }

        .file-upload-area {
            background-color: var(--secondary-color);
            border: 2px dashed var(--border-color);
            border-radius: 0.75rem;
            padding: 3rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-upload-area:hover {
            background-color: #e2e8f0;
            border-color: var(--primary-color);
        }

        .btn-animated-primary {
            background: var(--primary-color);
            color: white;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-animated-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            background: linear-gradient(135deg, #4f46e5, #6366f1);
        }
    </style>

    <script>
        function handleDrop(event) {
            event.preventDefault();
            const fileInput = document.getElementById('fileManajemen');
            fileInput.files = event.dataTransfer.files;
            updateFileLabel(fileInput);
        }

        function updateFileLabel(input) {
            const fileName = document.getElementById('fileName');
            const uploadArea = document.querySelector('.file-upload-area');
            if (input.files.length > 0) {
                fileName.textContent = "File dipilih: " + input.files[0].name;
                uploadArea.classList.add('border-success');
                uploadArea.classList.remove('border-danger');
            } else {
                fileName.textContent = "";
                uploadArea.classList.remove('border-success', 'border-danger');
            }
        }
    </script>


    @include('layouts.NavbarBawah')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>