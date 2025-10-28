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
    <title>Evaluasi MR - SPI Polije</title>
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

        .badge.bg-purple {
            background-color: #6f42c1;
            color: #fff;
        }

        .bagian-section {
            margin-bottom: 3rem;
        }

        .bagian-title {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            font-weight: 600;
            font-size: 1.2rem;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
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
                    const container = document.getElementById('allTablesContainer');

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
            .bagian-title {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                padding: 0.5rem 1rem;
                margin: 20px 0 10px 0;
                font-weight: 600;
                font-size: 14px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                font-size: 10px;
                table-layout: fixed;
                word-wrap: break-word;
                margin-bottom: 30px;
                page-break-inside: avoid;
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
                ${container.innerHTML}
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

                    // Group risiko by bagian
                    $risikosByBagian = $risikos->groupBy('bagian');
                @endphp

                {{-- Dropdown Filter Bagian --}}
                <div class="mb-3">
                    <strong>Filter Unit :</strong>
                    <select class="form-select form-select-sm d-inline-block" style="width: 200px;"
                        onchange="filterBagian(this.value)">
                        <option value="all"> Semua Unit </option>
                        @php
                            $bagians = $risikos->pluck('bagian')->unique();
                        @endphp
                        @foreach($bagians as $bagian)
                            <option value="{{ $bagian }}">{{ $bagian }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Container untuk semua tabel --}}
                <div id="allTablesContainer">
                    {{-- Tabel untuk mode "Semua Unit" (grouped by bagian) --}}
                    <div id="groupedTables" style="display: block;">
                        @foreach($risikosByBagian as $bagian => $risikoGroup)
                            <div class="bagian-section" data-bagian-group="{{ $bagian }}">
                                <div class="bagian-title">
                                    <i class="fa fa-building"></i> Unit: {{ $bagian }}
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped align-middle">
                                        <thead>
                                            <tr class="text-center">
                                                <th rowspan="2">#</th>
                                                <th rowspan="2">Abjad</th>
                                                <th rowspan="2">Tanggal Evaluasi</th>
                                                <th rowspan="2">Tujuan</th>
                                                <th rowspan="2">Proses Bisnis</th>
                                                <th rowspan="2">Kategori Risiko</th>
                                                <th rowspan="2">Uraian Risiko</th>
                                                <th rowspan="2">Penyebab Risiko</th>
                                                <th rowspan="2">Sumber Risiko</th>
                                                <th rowspan="2">Akibat / Potensi Kerugian</th>
                                                <th rowspan="2">Pemilik Risiko</th>
                                                <th colspan="3">Skor Awal</th>
                                                <th colspan="3">Pengendalian Intern</th>
                                                <th colspan="3">Nilai Residu</th>
                                                <th rowspan="2">Mitigasi Opsi</th>
                                                <th rowspan="2">Mitigasi Deskripsi</th>
                                                <th colspan="3">Skor Akhir</th>
                                                <th rowspan="2">Edit & Hapus</th>
                                            </tr>
                                            <tr class="text-center">
                                                <th>Likelihood</th>
                                                <th>Impact</th>
                                                <th>Level</th>
                                                <th>Ada</th>
                                                <th>Memadai</th>
                                                <th>Dijalankan</th>
                                                <th>Likelihood</th>
                                                <th>Impact</th>
                                                <th>Level</th>
                                                <th>Likelihood</th>
                                                <th>Impact</th>
                                                <th>Level</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($risikoGroup as $risiko)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $risiko->abjad }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($risiko->tanggal_evaluasi)->format('d-m-Y') }}</td>
                                                    <td>{{ $risiko->tujuan }}</td>
                                                    <td>{{ $risiko->proses_bisnis }}</td>
                                                    <td>{{ $risiko->kategori_risiko }}</td>
                                                    <td>{{ $risiko->uraian_risiko }}</td>
                                                    <td>{{ $risiko->penyebab_risiko }}</td>
                                                    <td>{{ $risiko->sumber_risiko }}</td>
                                                    <td>{{ $risiko->akibat }}</td>
                                                    <td>{{ $risiko->pemilik_risiko }}</td>
                                                    <td>{{ $risiko->skor_likelihood }}</td>
                                                    <td>{{ $risiko->skor_impact }}</td>
                                                    @php $styleAwal = getRiskColor($risiko->skor_likelihood, $risiko->skor_impact); @endphp
                                                    <td class="text-center"><span class="badge"
                                                            style="{{ $styleAwal }}">{{ $risiko->skor_likelihood * $risiko->skor_impact }}</span>
                                                    </td>
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
                                                    <td>{{ $risiko->residu_likelihood }}</td>
                                                    <td>{{ $risiko->residu_impact }}</td>
                                                    @php $styleResidu = getRiskColor($risiko->residu_likelihood, $risiko->residu_impact); @endphp
                                                    <td class="text-center"><span class="badge"
                                                            style="{{ $styleResidu }}">{{ $risiko->residu_likelihood * $risiko->residu_impact }}</span>
                                                    </td>
                                                    <td>{{ $risiko->mitigasi_opsi }}</td>
                                                    <td>{{ $risiko->mitigasi_deskripsi }}</td>
                                                    <td>{{ $risiko->akhir_likelihood }}</td>
                                                    <td>{{ $risiko->akhir_impact }}</td>
                                                    @php $styleAkhir = getRiskColor($risiko->akhir_likelihood, $risiko->akhir_impact); @endphp
                                                    <td class="text-center"><span class="badge"
                                                            style="{{ $styleAkhir }}">{{ $risiko->akhir_likelihood * $risiko->akhir_impact }}</span>
                                                    </td>
                                                    <td class="text-center">
                                                        @if(Auth::check() && Auth::user()->role === 'admin')
                                                            <a href="{{ route('evaluasiMr.edit', $risiko->id) }}"
                                                                class="btn btn-sm btn-warning mb-1"><i class="fa fa-edit"></i> Edit</a>
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
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Tabel tunggal untuk mode filter spesifik --}}
                    <div id="singleTable" style="display: none;">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle" id="risikoTable">
                                <thead>
                                    <tr class="text-center">
                                        <th rowspan="2">#</th>
                                        <th rowspan="2">Abjad</th>
                                        <th rowspan="2">Tanggal Evaluasi</th>
                                        <th rowspan="2">Tujuan</th>
                                        <th rowspan="2">Proses Bisnis</th>
                                        <th rowspan="2">Kategori Risiko</th>
                                        <th rowspan="2">Uraian Risiko</th>
                                        <th rowspan="2">Penyebab Risiko</th>
                                        <th rowspan="2">Sumber Risiko</th>
                                        <th rowspan="2">Akibat / Potensi Kerugian</th>
                                        <th rowspan="2">Pemilik Risiko</th>
                                        <th rowspan="2">Bagian</th>
                                        <th colspan="3">Skor Awal</th>
                                        <th colspan="3">Pengendalian Intern</th>
                                        <th colspan="3">Nilai Residu</th>
                                        <th rowspan="2">Mitigasi Opsi</th>
                                        <th rowspan="2">Mitigasi Deskripsi</th>
                                        <th colspan="3">Skor Akhir</th>
                                        <th rowspan="2">Edit & Hapus</th>
                                    </tr>
                                    <tr class="text-center">
                                        <th>Likelihood</th>
                                        <th>Impact</th>
                                        <th>Level</th>
                                        <th>Ada</th>
                                        <th>Memadai</th>
                                        <th>Dijalankan</th>
                                        <th>Likelihood</th>
                                        <th>Impact</th>
                                        <th>Level</th>
                                        <th>Likelihood</th>
                                        <th>Impact</th>
                                        <th>Level</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($risikos as $risiko)
                                        <tr data-bagian="{{ $risiko->bagian }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $risiko->abjad }}</td>
                                            <td>{{ \Carbon\Carbon::parse($risiko->tanggal_evaluasi)->format('d-m-Y') }}</td>
                                            <td>{{ $risiko->tujuan }}</td>
                                            <td>{{ $risiko->proses_bisnis }}</td>
                                            <td>{{ $risiko->kategori_risiko }}</td>
                                            <td>{{ $risiko->uraian_risiko }}</td>
                                            <td>{{ $risiko->penyebab_risiko }}</td>
                                            <td>{{ $risiko->sumber_risiko }}</td>
                                            <td>{{ $risiko->akibat }}</td>
                                            <td>{{ $risiko->pemilik_risiko }}</td>
                                            <td>{{ $risiko->bagian }}</td>
                                            <td>{{ $risiko->skor_likelihood }}</td>
                                            <td>{{ $risiko->skor_impact }}</td>
                                            @php $styleAwal = getRiskColor($risiko->skor_likelihood, $risiko->skor_impact); @endphp
                                            <td class="text-center"><span class="badge"
                                                    style="{{ $styleAwal }}">{{ $risiko->skor_likelihood * $risiko->skor_impact }}</span>
                                            </td>
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
                                            <td>{{ $risiko->residu_likelihood }}</td>
                                            <td>{{ $risiko->residu_impact }}</td>
                                            @php $styleResidu = getRiskColor($risiko->residu_likelihood, $risiko->residu_impact); @endphp
                                            <td class="text-center"><span class="badge"
                                                    style="{{ $styleResidu }}">{{ $risiko->residu_likelihood * $risiko->residu_impact }}</span>
                                            </td>
                                            <td>{{ $risiko->mitigasi_opsi }}</td>
                                            <td>{{ $risiko->mitigasi_deskripsi }}</td>
                                            <td>{{ $risiko->akhir_likelihood }}</td>
                                            <td>{{ $risiko->akhir_impact }}</td>
                                            @php $styleAkhir = getRiskColor($risiko->akhir_likelihood, $risiko->akhir_impact); @endphp
                                            <td class="text-center"><span class="badge"
                                                    style="{{ $styleAkhir }}">{{ $risiko->akhir_likelihood * $risiko->akhir_impact }}</span>
                                            </td>
                                            <td class="text-center">
                                                @if(Auth::check() && Auth::user()->role === 'admin')
                                                    <a href="{{ route('evaluasiMr.edit', $risiko->id) }}"
                                                        class="btn btn-sm btn-warning mb-1"><i class="fa fa-edit"></i> Edit</a>
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
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <script>
                    function filterBagian(bagian) {
                        const groupedTables = document.getElementById('groupedTables');
                        const singleTable = document.getElementById('singleTable');
                        
                        if (bagian === 'all') {
                            // Show grouped tables (multiple tables by bagian)
                            groupedTables.style.display = 'block';
                            singleTable.style.display = 'none';
                        } else {
                            // Show single table with filtered rows
                            groupedTables.style.display = 'none';
                            singleTable.style.display = 'block';
                            
                            const rows = document.querySelectorAll('#risikoTable tbody tr');
                            rows.forEach(row => {
                                if (row.getAttribute('data-bagian').trim() === bagian.trim()) {
                                    row.style.display = '';
                                } else {
                                    row.style.display = 'none';
                                }
                            });
                        }
                    }
                </script>

                <!-- Bootstrap JS + Popper -->
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

            </div>
        </div>
    </div>

    @include('layouts.NavbarBawah')

</body>

</html>