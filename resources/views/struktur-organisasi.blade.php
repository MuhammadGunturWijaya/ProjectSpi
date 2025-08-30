<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struktur Organisasi SPI</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background-color: #f9fafb;
            overflow-x: hidden;
        }

        h2,
        h3 {
            font-weight: 700;
            color: #1e293b;
        }

        .img-container img {
            max-width: 100%;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.4s ease-in-out;
            background: white;
        }

        .card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
        }

        .card-img-top {
            height: 220px;
            object-fit: cover;
            border-bottom: 5px solid #2563eb;
        }

        .card-body {
            background: #ffffff;
            color: #1e293b;
            padding: 18px;
        }

        .card-body h5 {
            font-weight: bold;
            margin-bottom: 6px;
        }

        .card-body p {
            margin: 0;
            font-size: 14px;
            color: #64748b;
        }

        .row-cols-custom {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            justify-content: center;
        }

        .fade-in {
            opacity: 0;
            transform: translateY(25px);
            animation: fadeInUp 0.8s ease forwards;
        }

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
        <h2 class="text-center mb-4">Struktur Organisasi Satuan Pengawas Internal (SPI)</h2>
        <div class="img-container text-center mb-3 fade-in">
            <img src="{{ asset('images/struktur.jpg') }}" alt="Struktur Organisasi">
        </div>

        {{-- Button edit hanya muncul untuk admin --}}
        @if(Auth::check() && Auth::user()->role == 'admin')
            <div class="text-center mb-5">
                <a href="{{ route('struktur.edit') }}" class="btn btn-warning btn-sm">
                    ✏️ Edit Struktur Organisasi
                </a>
            </div>
        @endif
    </div>

    <h3 class="text-center mt-5 mb-4">Pengurus SPI</h3>
    <div class="container px-4">
        <div class="row-cols-custom">

            <!-- Ketua -->
            <div class="fade-in" style="animation-delay:0.1s;">
                <div class="card shadow-sm">
                    <img src="{{ asset('images/bapakmunih.jpg') }}" class="card-img-top" alt="Ketua SPI">
                    <div class="card-body text-center">
                        <h5 class="card-title">Nama Ketua</h5>
                        <p class="card-text">Ketua SPI</p>
                        @if(Auth::check() && Auth::user()->role == 'admin')
                            <a href="{{ route('pengurus.edit', ['id' => 1]) }}" class="btn btn-sm btn-primary mt-2">✏️ Edit</a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sekretaris -->
            <div class="fade-in" style="animation-delay:0.2s;">
                <div class="card shadow-sm">
                    <img src="{{ asset('images/ajiseto.jpg') }}" class="card-img-top" alt="Sekretaris SPI">
                    <div class="card-body text-center">
                        <h5 class="card-title">Nama Sekretaris</h5>
                        <p class="card-text">Sekretaris SPI</p>
                        @if(Auth::check() && Auth::user()->role == 'admin')
                            <a href="{{ route('pengurus.edit', ['id' => 2]) }}" class="btn btn-sm btn-primary mt-2">✏️ Edit</a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Anggota 1 -->
            <div class="fade-in" style="animation-delay:0.3s;">
                <div class="card shadow-sm">
                    <img src="{{ asset('images/bapakmunih.jpg') }}" class="card-img-top" alt="Anggota 1 SPI">
                    <div class="card-body text-center">
                        <h5 class="card-title">Nama Anggota 1</h5>
                        <p class="card-text">Anggota SPI</p>
                        @if(Auth::check() && Auth::user()->role == 'admin')
                            <a href="{{ route('pengurus.edit', ['id' => 3]) }}" class="btn btn-sm btn-primary mt-2">✏️ Edit</a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Anggota 2 -->
            <div class="fade-in" style="animation-delay:0.4s;">
                <div class="card shadow-sm">
                    <img src="{{ asset('images/ajiseto.jpg') }}" class="card-img-top" alt="Anggota SPI">
                    <div class="card-body text-center">
                        <h5 class="card-title">Nama Anggota 2</h5>
                        <p class="card-text">Anggota SPI</p>
                        @if(Auth::check() && Auth::user()->role == 'admin')
                            <a href="{{ route('pengurus.edit', ['id' => 4]) }}" class="btn btn-sm btn-primary mt-2">✏️ Edit</a>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

    <p></p>
    @include('layouts.NavbarBawah')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
