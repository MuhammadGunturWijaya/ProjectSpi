<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengaduan Masyarakat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa, #e9f2fb);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .form-card {
            background: #fff;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
        }

        .form-card h3 {
            color: #0d2d50;
            font-weight: 700;
        }

        .form-label {
            font-weight: 600;
            color: #0d2d50;
        }

        .btn-primary {
            background: #0d6efd;
            border: none;
            transition: 0.3s ease;
        }

        .btn-primary:hover {
            background: #084298;
        }

        .btn-outline-secondary:hover {
            background: #dee2e6;
        }

        textarea {
            resize: none;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .alert {
            border-radius: 10px;
        }

        .icon-title {
            font-size: 2rem;
            color: #0d6efd;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    @include('layouts.navbar')

    <div class="container my-5" style="max-width: 800px;">
        <div class="form-card">
            <div class="d-flex align-items-center justify-content-center mb-4">
                <i class="bi bi-envelope-paper-fill icon-title"></i>
                <h3 class="fw-bold text-center mb-0">Form Pengaduan Masyarakat</h3>
            </div>

            {{-- Notifikasi sukses --}}
            @if(session('success'))
                <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
            @endif

            {{-- Notifikasi error --}}
            @if($errors->any())
                <div class="alert alert-danger shadow-sm">
                    <ul class="mb-0">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('pengaduan.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control shadow-sm" id="nama" name="nama"
                        placeholder="Masukkan nama lengkap Anda" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control shadow-sm" id="email" name="email"
                        placeholder="contoh@email.com" required>
                </div>

                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select class="form-select shadow-sm" id="kategori" name="kategori" required>
                        <option value="" disabled selected>Pilih kategori...</option>
                        <option value="Pelanggaran Etika">Pelanggaran Etika</option>
                        <option value="Gratifikasi">Gratifikasi</option>
                        <option value="Penyalahgunaan Wewenang">Penyalahgunaan Wewenang</option>
                        <option value="Kualitas Layanan">Kualitas Layanan</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control shadow-sm" id="judul" name="judul"
                        placeholder="Tuliskan judul pengaduan" required>
                </div>

                <div class="mb-3">
                    <label for="kritik_saran" class="form-label">Kritik / Saran</label>
                    <textarea class="form-control shadow-sm" id="kritik_saran" name="kritik_saran" rows="5"
                        placeholder="Tuliskan pengaduan, kritik, atau saran Anda di sini..." required></textarea>
                </div>

                <div class="mb-3">
                    <label for="bukti_foto" class="form-label">Bukti Foto (opsional)</label>
                    <input class="form-control shadow-sm" type="file" id="bukti_foto" name="bukti_foto"
                        accept="image/*">
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <button type="reset" class="btn btn-outline-secondary px-4">Reset</button>

                    {{-- Jika login tampil tombol submit, kalau tidak login arahkan ke login --}}
                    @auth
                        <button type="submit" class="btn btn-primary px-4">Kirim Pengaduan</button>
                    @else
                        <a href="{{ route('login', ['redirect' => route('pengaduan.create')]) }}"
                            class="btn btn-primary px-4">
                            Login untuk Kirim
                        </a>
                    @endauth
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    @include('layouts.NavbarBawah')
</body>

</html>