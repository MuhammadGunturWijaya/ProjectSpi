<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Kepuasan - SPI Polije</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            overflow-x: hidden;
        }

        .card {
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: linear-gradient(90deg, #007bff, #00c6ff);
            color: #fff;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-header i {
            margin-right: 0.5rem;
        }

        .btn-success {
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-success:hover {
            background-color: #28a745;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        table thead {
            background-color: #343a40;
            color: #fff;
        }

        table tbody tr:hover {
            background-color: #e9f7ff;
        }

        @media (max-width: 992px) {
            table {
                font-size: 0.875rem;
            }
        }
    </style>
</head>

<body>

    @include('layouts.navbar')

    <div class="container py-5">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0"><i class="fa fa-shield-alt"></i> Daftar Identifikasi Risiko</h4>
                @if(Auth::check() && Auth::user()->role === 'admin')
                    <a href="{{ route('identifikasi.risiko.create') }}" class="btn btn-success">
                        <i class="fa fa-plus"></i> Tambah Risiko
                    </a>
                @endif
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success rounded-pill">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Abjad</th>
                                <th>Tujuan</th>
                                <th>Proses Bisnis</th>
                                <th>Kategori Risiko</th>
                                <th>Uraian Risiko</th>
                                <th>Penyebab Risiko</th>
                                <th>Sumber Risiko</th>
                                <th>Akibat / Potensi Kerugian</th>
                                <th>Pemilik Risiko</th>
                                <th>Edit & Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($risikos as $risiko)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $risiko->abjad }}</td>
                                    <td>{{ $risiko->tujuan }}</td>
                                    <td>{{ $risiko->proses_bisnis }}</td>
                                    <td>{{ $risiko->kategori_risiko }}</td>
                                    <td>{{ $risiko->uraian_risiko }}</td>
                                    <td>{{ $risiko->penyebab_risiko }}</td>
                                    <td>{{ $risiko->sumber_risiko }}</td>
                                    <td>{{ $risiko->akibat }}</td>
                                    <td>{{ $risiko->pemilik_risiko }}</td>
                                    <td>
                                        @if(Auth::check() && Auth::user()->role === 'admin')
                                            <a href="{{ route('identifikasi.risiko.edit', $risiko->id) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>

                                            <form action="{{ route('identifikasi.risiko.destroy', $risiko->id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-center">Belum ada data risiko.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    @include('layouts.NavbarBawah')

</body>

</html>