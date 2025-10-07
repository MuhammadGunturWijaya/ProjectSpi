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

        .badge.bg-purple {
            background-color: #6f42c1;
            color: #fff;
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
                <div class="d-flex gap-2">
                    @if(Auth::check() && Auth::user()->role === 'admin')
                        <a href="{{ route('evaluasiMr.create') }}" class="btn btn-success">
                            <i class="fa fa-plus"></i> Tambah Risiko
                        </a>
                    @endif
                    <button onclick="printLaporan()" class="btn btn-primary">
                        <i class="fa fa-print"></i> Cetak Laporan
                    </button>
                </div>
            </div>
            <script>
                function printLaporan() {
                    const table = document.querySelector('.table-responsive table');

                    const printWindow = window.open('', '', 'height=800,width=1200');

                    const style = `
        <style>
            @page {
                size: landscape;
                margin: 10mm;
            }
            body {
                font-family: 'Poppins', sans-serif;
                padding: 10px;
            }
            h2 {
                text-align: center;
                margin-bottom: 20px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                font-size: 10px; /* kecilkan font agar muat semua kolom */
                table-layout: fixed;
                word-wrap: break-word;
            }
            table, th, td {
                border: 1px solid #000;
            }
            th, td {
                padding: 4px;
                text-align: center;
                vertical-align: middle;
            }
            th {
                background-color: #343a40;
                color: white;
            }
            .badge {
                display: inline-block;
                padding: 2px 4px;
                border-radius: 5px;
                color: white;
                font-size: 10px;
            }
            /* biar tabel bisa di-scroll horizontal di cetak jika masih kebesaran */
            .table-container {
                width: 100%;
                overflow-x: auto;
            }
        </style>
    `;

                    printWindow.document.write(`
        <html>
        <head>
            <title>Laporan Evaluasi MR</title>
            ${style}
        </head>
        <body>
            <h2>Laporan Evaluasi MR - SPI Polije</h2>
            <div class="table-container">
                ${table.outerHTML}
            </div>
        </body>
        </html>
    `);

                    printWindow.document.close();
                    printWindow.focus();
                    printWindow.print();
                    printWindow.close();
                }
            </script>

            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success rounded-pill">{{ session('success') }}</div>
                @endif

                @php
                    function getRiskColor($likelihood, $impact)
                    {
                        $matrix = [
                            1 => [1 => 'blue', 2 => 'lightgreen', 3 => 'lightgreen', 4 => 'darkgreen', 5 => 'yellow'],
                            2 => [1 => 'lightgreen', 2 => 'lightgreen', 3 => 'darkgreen', 4 => 'yellow', 5 => 'purple'],
                            3 => [1 => 'lightgreen', 2 => 'darkgreen', 3 => 'yellow', 4 => 'purple', 5 => 'red'],
                            4 => [1 => 'darkgreen', 2 => 'yellow', 3 => 'purple', 4 => 'red', 5 => 'red'],
                            5 => [1 => 'yellow', 2 => 'purple', 3 => 'red', 4 => 'red', 5 => 'red'],
                        ];

                        $colorMap = [
                            'blue' => 'background-color:#007bff; color:white;',
                            'lightgreen' => 'background-color:#90ee90; color:black;',
                            'darkgreen' => 'background-color:#006400; color:white;',
                            'yellow' => 'background-color:#ffc107; color:black;',
                            'purple' => 'background-color:#6f42c1; color:white;',
                            'red' => 'background-color:#dc3545; color:white;',
                        ];

                        return $colorMap[$matrix[$likelihood][$impact] ?? 'red'];
                    }
                @endphp



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
                                    @php $styleAwal = getRiskColor($risiko->skor_likelihood, $risiko->skor_impact); @endphp
                                    <td class="text-center"><span class="badge"
                                            style="{{ $styleAwal }}">{{ $risiko->skor_likelihood * $risiko->skor_impact }}</span>
                                    </td>

                                    {{-- Pengendalian Intern --}}
                                    <td class="text-center">
                                        <div>{{ $risiko->pengendalian_intern_ada }}</div>
                                        @if($risiko->pengendalian_intern_ada_keterangan)
                                            <div
                                                style="border-top:1px solid #ccc; margin-top:2px; font-size:0.8rem; color:#6c757d;">
                                                {{ $risiko->pengendalian_intern_ada_keterangan }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div>{{ $risiko->pengendalian_intern_memadai }}</div>
                                        @if($risiko->pengendalian_intern_memadai_keterangan)
                                            <div
                                                style="border-top:1px solid #ccc; margin-top:2px; font-size:0.8rem; color:#6c757d;">
                                                {{ $risiko->pengendalian_intern_memadai_keterangan }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div>{{ $risiko->pengendalian_intern_dijalankan }}%</div>
                                        @if($risiko->pengendalian_intern_dijalankan_keterangan)
                                            <div
                                                style="border-top:1px solid #ccc; margin-top:2px; font-size:0.8rem; color:#6c757d;">
                                                {{ $risiko->pengendalian_intern_dijalankan_keterangan }}
                                            </div>
                                        @endif
                                    </td>

                                    {{-- Nilai Residu --}}
                                    <td>{{ $risiko->residu_likelihood }}</td>
                                    <td>{{ $risiko->residu_impact }}</td>
                                    @php $styleResidu = getRiskColor($risiko->residu_likelihood, $risiko->residu_impact); @endphp
                                    <td class="text-center"><span class="badge"
                                            style="{{ $styleResidu }}">{{ $risiko->residu_likelihood * $risiko->residu_impact }}</span>
                                    </td>

                                    {{-- Mitigasi --}}
                                    <td>{{ $risiko->mitigasi_opsi }}</td>
                                    <td>{{ $risiko->mitigasi_deskripsi }}</td>

                                    {{-- Skor Akhir --}}
                                    <td>{{ $risiko->akhir_likelihood }}</td>
                                    <td>{{ $risiko->akhir_impact }}</td>
                                    @php $styleAkhir = getRiskColor($risiko->akhir_likelihood, $risiko->akhir_impact); @endphp
                                    <td class="text-center"><span class="badge"
                                            style="{{ $styleAkhir }}">{{ $risiko->akhir_likelihood * $risiko->akhir_impact }}</span>
                                    </td>

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