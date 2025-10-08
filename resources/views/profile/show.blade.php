<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visi, Misi, dan Tujuan SPI POLIJE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .content-wrapper {
            background: #fff;
            border-radius: 10px;
            padding: 40px;
            margin: 40px auto;
            max-width: 950px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
        }

        .content-wrapper h2 {
            font-weight: 700;
            color: #0d2d50;
            margin-bottom: 10px;
        }

        .meta-info {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 20px;
        }

        .meta-info i {
            margin-right: 5px;
        }

        .section-title {
            font-weight: 600;
            margin-top: 25px;
            margin-bottom: 10px;
        }

        .content-wrapper p {
            text-align: justify;
            line-height: 1.7;
            color: #333;
        }

        ol {
            margin-left: 20px;
            padding-left: 15px;
        }

        ol li {
            margin-bottom: 8px;
            line-height: 1.6;
        }
    </style>
</head>

<body>
    @include('layouts.navbar')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white fw-bold">
                        Profil Saya
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf

                            {{-- Nama --}}
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $user->name) }}" required>
                            </div>

                            {{-- Email --}}
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $user->email) }}" required>
                            </div>

                            {{-- Email Alternatif --}}
                            <div class="mb-3">
                                <label class="form-label">Email Alternatif</label>
                                <input type="email" name="alt_email" class="form-control"
                                    value="{{ old('alt_email', $user->alt_email) }}">
                            </div>

                            {{-- No HP / WhatsApp --}}
                            <div class="mb-3">
                                <label class="form-label">No. Telp / HP / WhatsApp</label>
                                <input type="text" name="phone" class="form-control"
                                    value="{{ old('phone', $user->phone) }}">
                            </div>

                            {{-- Alamat Lengkap --}}
                            <div class="mb-3">
                                <label class="form-label">Alamat Lengkap</label>
                                <input type="text" name="address" class="form-control"
                                    value="{{ old('address', $user->address) }}">
                            </div>

                            {{-- Password Baru --}}
                            <div class="mb-3">
                                <label class="form-label">Password Baru
                                    <small class="text-muted">(Kosongkan jika tidak ingin diubah)</small>
                                </label>
                                <input type="password" name="password" class="form-control">
                            </div>

                            {{-- Konfirmasi Password --}}
                            <div class="mb-3">
                                <label class="form-label">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-success w-100">Simpan Perubahan</button>
                        </form>

                        {{-- Tombol lihat kode verifikasi hanya untuk pegawai --}}
                        @if($user->user_type === 'pegawai' && $user->pegawai_code)
                            <hr>
                            <button class="btn btn-info w-100 mt-2" onclick="showKode()">Lihat Kode Verifikasi</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if($user->user_type === 'pegawai' && $user->pegawai_code)
        <script>
            function showKode() {
                Swal.fire({
                    title: 'Kode Verifikasi Pegawai',
                    html: `<p>Kode verifikasi Anda:</p>
                       <h2 style="color:#0d6efd; font-weight:bold;">{{ $user->pegawai_code }}</h2>`,
                    icon: 'info',
                    confirmButtonText: 'Salin Kode'
                }).then((result) => {
                    if (result.isConfirmed) {
                        navigator.clipboard.writeText("{{ $user->pegawai_code }}");
                    }
                });
            }
        </script>
    @endif


    @include('layouts.NavbarBawah')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</body>

</html>