<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluasi MR - SPI Polije</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
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
                <h4 class="mb-0"><i class="fa fa-shield-alt"></i> Evaluasi MR</h4>
                @if(Auth::check() && Auth::user()->role === 'admin')
                    <a href="{{ route('evaluasiMr.create') }}" class="btn btn-success">
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
                            <tr class="text-center">
                                <th rowspan="2">#</th>
                                <th rowspan="2">Abjad</th>
                                <th rowspan="2">Tujuan</th>
                                <th rowspan="2">Proses Bisnis</th>
                                <th rowspan="2">Kategori Risiko</th>
                                <th rowspan="2">Uraian Risiko</th>
                                <th rowspan="2">Penyebab Risiko</th>
                                <th rowspan="2">Sumber Risiko</th>
                                <th rowspan="2">Akibat / Potensi Kerugian</th>
                                <th rowspan="2">Pemilik Risiko</th>
                                <th rowspan="2">Departemen/Bagian</th>

                                {{-- Skor Awal --}}
                                <th colspan="3">Skor Awal</th>

                                {{-- Pengendalian Intern --}}
                                <th colspan="3">Pengendalian Intern</th>

                                {{-- Nilai Residu --}}
                                <th colspan="3">Nilai Residu</th>

                                {{-- Mitigasi Risiko --}}
                                <th rowspan="2">Mitigasi Opsi</th>
                                <th rowspan="2">Mitigasi Deskripsi</th>

                                {{-- Skor Akhir --}}
                                <th colspan="3">Skor Akhir</th>

                                <th rowspan="2">Edit & Hapus</th>
                            </tr>
                            <tr class="text-center">
                                {{-- Skor Awal --}}
                                <th>Likelihood</th>
                                <th>Impact</th>
                                <th>Level</th>

                                {{-- Pengendalian Intern --}}
                                <th>Ada</th>
                                <th>Memadai</th>
                                <th>Dijalankan</th>

                                {{-- Nilai Residu --}}
                                <th>Likelihood</th>
                                <th>Impact</th>
                                <th>Level</th>

                                {{-- Skor Akhir --}}
                                <th>Likelihood</th>
                                <th>Impact</th>
                                <th>Level</th>
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
                                    <td>{{ $risiko->departemen }}</td>

                                    {{-- Skor Awal --}}
                                    <td>{{ $risiko->skor_likelihood }}</td>
                                    <td>{{ $risiko->skor_impact }}</td>
                                    <td><span class="badge bg-primary">{{ $risiko->skor_level }}</span></td>

                                    {{-- Pengendalian Intern --}}
                                    <td>{{ $risiko->pengendalian_intern_ada }}</td>
                                    <td>{{ $risiko->pengendalian_intern_memadai }}</td>
                                    <td>{{ $risiko->pengendalian_intern_dijalankan }}</td>

                                    {{-- Nilai Residu --}}
                                    <td>{{ $risiko->residu_likelihood }}</td>
                                    <td>{{ $risiko->residu_impact }}</td>
                                    <td><span class="badge bg-info">{{ $risiko->residu_level }}</span></td>

                                    {{-- Mitigasi --}}
                                    <td>{{ $risiko->mitigasi_opsi }}</td>
                                    <td>{{ $risiko->mitigasi_deskripsi }}</td>

                                    {{-- Skor Akhir --}}
                                    <td>{{ $risiko->akhir_likelihood }}</td>
                                    <td>{{ $risiko->akhir_impact }}</td>
                                    <td><span class="badge bg-danger">{{ $risiko->akhir_level }}</span></td>

                                    <td class="text-center">
                                        @if(Auth::check() && Auth::user()->role === 'admin')
                                            <a href="{{ route('evaluasiMr.edit', $risiko->id) }}"
                                                class="btn btn-sm btn-warning mb-1">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('evaluasiMr.destroy', $risiko->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                            </form>

                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="20" class="text-center">Belum ada data risiko.</td>
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