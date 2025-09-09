<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sumber Daya Manusia</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f9;
            color: #1a202c;
            line-height: 1.6;
        }

        h2,
        h3 {
            font-weight: 800;
            color: #1e3a8a;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #1e3a8a, #4a71b1);
            color: white;
            padding: 120px 20px;
            border-radius: 24px;
            margin-bottom: 60px;
            text-align: center;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(30, 58, 138, 0.2);
        }

        .hero-section::before {
            content: "";
            position: absolute;
            top: -50px;
            left: -50px;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            z-index: 0;
        }

        .hero-section::after {
            content: "";
            position: absolute;
            bottom: -70px;
            right: -70px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            z-index: 0;
        }

        .hero-section h2,
        .hero-section p {
            position: relative;
            z-index: 1;
            font-weight: 700;
        }

        .hero-section h2 {
            font-size: clamp(2rem, 5vw, 3.5rem);
            margin-bottom: 10px;
            color: white;
        }

        .hero-section p {
            font-size: clamp(1rem, 2.5vw, 1.25rem);
            opacity: 0.9;
        }

        /* Card */
        .person-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border: none;
        }

        .person-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 12px 30px rgba(30, 58, 138, 0.15);
        }

        .card-img-top {
            height: 250px;
            object-fit: cover;
            object-position: top;
            transition: transform 0.5s ease;
        }

        .person-card:hover .card-img-top {
            transform: scale(1.05);
        }

        .card-body {
            padding: 25px;
            text-align: center;
        }

        .card-body h5 {
            font-weight: 700;
            margin-bottom: 5px;
            font-size: 1.25rem;
            color: #1e3a8a;
        }

        .card-body p.card-text {
            margin: 0;
            font-size: 1rem;
            color: #4a5568;
        }

        .card-body p.small-text {
            font-size: 0.9rem;
            color: #718096;
            margin-top: 5px;
        }

        /* Grid */
        .row-cols-custom {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }

        /* Tombol */
        .btn-gradient {
            background: linear-gradient(90deg, #1e3a8a, #4a71b1);
            border: none;
            border-radius: 50px;
            padding: 12px 28px;
            font-weight: 600;
            color: white;
            transition: 0.3s;
            box-shadow: 0 4px 15px rgba(30, 58, 138, 0.2);
        }

        .btn-gradient:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(30, 58, 138, 0.4);
        }

        .btn-edit {
            background-color: #4a71b1;
            color: white;
            border: none;
            border-radius: 30px;
            padding: 8px 18px;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }

        .btn-edit:hover {
            background-color: #385989;
        }

        /* Modal */
        .modal-content {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .modal-header {
            background: linear-gradient(to right, #1e3a8a, #4a71b1);
            color: white;
            border-bottom: none;
        }

        .modal-body {
            padding: 40px;
        }

        .modal-body h4 {
            font-weight: bold;
            color: #1e3a8a;
            margin-bottom: 15px;
            font-size: 1.75rem;
        }

        .modal-body .detail-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
            text-align: left;
        }

        .modal-body .detail-item strong {
            color: #1e3a8a;
            min-width: 120px;
            font-weight: 600;
        }
        
        /* Animasi muncul */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.8s ease forwards;
        }

        .fade-in:nth-child(1) { animation-delay: 0.1s; }
        .fade-in:nth-child(2) { animation-delay: 0.2s; }
        .fade-in:nth-child(3) { animation-delay: 0.3s; }
        .fade-in:nth-child(4) { animation-delay: 0.4s; }
        .fade-in:nth-child(5) { animation-delay: 0.5s; }
        .fade-in:nth-child(6) { animation-delay: 0.6s; }
        .fade-in:nth-child(7) { animation-delay: 0.7s; }
        .fade-in:nth-child(8) { animation-delay: 0.8s; }
        
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    @include('layouts.navbar')

    <div class="container mt-5">
        <div class="hero-section">
            <h2>Sumber Daya Manusia SPI</h2>
            <p>Daftar tenaga profesional yang berperan dalam mendukung kinerja Satuan Pengawas Internal.</p>
        </div>
    </div>

    <div class="container mb-5">
        <h3 class="text-center mb-5">Tim Kami</h3>

        @if(Auth::check() && Auth::user()->role == 'admin')
        <div class="text-center mb-5">
            <a href="{{ route('sdm.create') }}" class="btn btn-gradient">
                <i class="bi bi-person-plus-fill me-2"></i> Tambah SDM
            </a>
        </div>
        @endif

        <div class="row-cols-custom">
            @foreach($sdm as $index => $person)
            <div class="fade-in">
                <div class="card person-card" style="cursor: pointer;" data-bs-toggle="modal"
                    data-bs-target="#personModal" data-nama="{{ $person->nama }}"
                    data-jabatan="{{ $person->jabatan }}" data-bidang="{{ $person->bidang }}"
                    data-biodata="{{ $person->biodata }}" data-pengalaman="{{ $person->pengalaman }}"
                    data-tanggal_lahir="{{ $person->tanggal_lahir }}"
                    data-foto="{{ $person->foto ? asset('images/' . $person->foto) : asset('images/default.jpg') }}">

                    <img src="{{ $person->foto ? asset('images/' . $person->foto) : asset('images/default.jpg') }}"
                        class="card-img-top" alt="{{ $person->nama }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $person->nama }}</h5>
                        <p class="card-text">{{ $person->jabatan }}</p>
                       

                        @if(Auth::check() && Auth::user()->role == 'admin')
                        <a href="{{ route('sdm.edit', ['id' => $person->id]) }}" class="btn btn-edit mt-3"
                            onclick="event.stopPropagation();">
                            <i class="bi bi-pencil-fill me-1"></i> Edit
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="modal fade" id="personModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Detail Profile</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalFoto" src="" class="img-fluid rounded mb-4"
                        style="max-height:220px; border-radius: 15px!important; object-fit:cover; box-shadow: 0 8px 20px rgba(0,0,0,0.1);">
                    <h4 id="modalNama"></h4>
                    <p id="modalJabatan" class="fw-bold fs-5"></p>

                    <div class="container text-start mt-4">
                        <div class="detail-item">
                            <strong>Bidang:</strong>
                            <p id="modalBidang" class="ms-2 mb-0"></p>
                        </div>
                        <div class="detail-item">
                            <strong>Biodata:</strong>
                            <p id="modalBiodata" class="ms-2 mb-0"></p>
                        </div>
                        <div class="detail-item">
                            <strong>Pengalaman:</strong>
                            <p id="modalPengalaman" class="ms-2 mb-0"></p>
                        </div>
                        <div class="detail-item">
                            <strong>Tgl. Lahir:</strong>
                            <p id="modalTanggalLahir" class="ms-2 mb-0"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll('.person-card').forEach(card => {
                card.addEventListener('click', function () {
                    document.getElementById('modalFoto').src = this.dataset.foto;
                    document.getElementById('modalNama').textContent = this.dataset.nama;
                    document.getElementById('modalJabatan').textContent = this.dataset.jabatan;
                    document.getElementById('modalBidang').textContent = this.dataset.bidang || "-";
                    document.getElementById('modalBiodata').textContent = this.dataset.biodata || "-";
                    document.getElementById('modalPengalaman').textContent = this.dataset.pengalaman || "-";
                    document.getElementById('modalTanggalLahir').textContent = this.dataset.tanggal_lahir || "-";
                });
            });
        });
    </script>

    @include('layouts.NavbarBawah')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>