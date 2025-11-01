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
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .reorder-toggle {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 0.4rem 1rem;
            border-radius: 50px;
            font-size: 0.9rem;
            transition: all 0.3s;
            cursor: pointer;
        }

        .reorder-toggle:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.05);
        }

        .reorder-toggle.active {
            background: #28a745;
            border-color: #28a745;
        }

        /* Drag and Drop Styles */
        .draggable-row {
            cursor: default;
            transition: all 0.2s;
        }

        .reorder-mode .draggable-row {
            cursor: move;
        }

        .draggable-row.dragging {
            opacity: 0.5;
            background-color: #e3f2fd;
        }

        .draggable-row.drag-over {
            border-top: 3px solid #007bff;
        }

        .drag-handle {
            display: none;
            cursor: move;
            color: #6c757d;
            padding: 0 8px;
        }

        .reorder-mode .drag-handle {
            display: inline-block;
        }

        .reorder-mode tbody tr {
            background-color: #f8f9fa;
        }

        .reorder-mode tbody tr:hover {
            background-color: #e9ecef !important;
        }

        @media (max-width: 992px) {
            table {
                font-size: 0.875rem;
            }

            .bagian-title {
                flex-direction: column;
                gap: 0.5rem;
                align-items: flex-start;
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
                    <button onclick="exportToExcel()" class="btn btn-success">
                        <i class="fa fa-file-excel"></i> Export Excel
                    </button>
                </div>
            </div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
            <script>
                function exportToExcel() {
                    const workbook = XLSX.utils.book_new();

                    // Get all tables by unit
                    const bagianSections = document.querySelectorAll('.bagian-section');

                    bagianSections.forEach(section => {
                        const unitName = section.querySelector('.bagian-title').textContent.trim().replace('Unit: ', '').replace('Pindah Urutan', '').trim();
                        const table = section.querySelector('table');

                        if (table) {
                            // Clone table to manipulate
                            const clonedTable = table.cloneNode(true);

                            // Remove drag handles and action buttons
                            clonedTable.querySelectorAll('.drag-handle').forEach(el => el.remove());
                            clonedTable.querySelectorAll('td:last-child').forEach(el => el.textContent = '');

                            // Convert table to worksheet
                            const worksheet = XLSX.utils.table_to_sheet(clonedTable);

                            // Set column widths
                            worksheet['!cols'] = [
                                { wch: 5 },   // #
                                { wch: 8 },   // Abjad
                                { wch: 15 },  // Tanggal
                                { wch: 20 },  // Tujuan
                                { wch: 20 },  // Proses Bisnis
                                { wch: 15 },  // Kategori
                                { wch: 30 },  // Uraian
                                { wch: 25 },  // Penyebab
                                { wch: 15 },  // Sumber
                                { wch: 25 },  // Akibat
                                { wch: 15 },  // Pemilik
                                { wch: 10 },  // Likelihood
                                { wch: 10 },  // Impact
                                { wch: 10 },  // Level
                                { wch: 12 },  // Ada
                                { wch: 12 },  // Memadai
                                { wch: 12 },  // Dijalankan
                                { wch: 10 },  // Residu L
                                { wch: 10 },  // Residu I
                                { wch: 10 },  // Residu Level
                                { wch: 15 },  // Mitigasi Opsi
                                { wch: 30 },  // Mitigasi Desk
                                { wch: 10 },  // Akhir L
                                { wch: 10 },  // Akhir I
                                { wch: 10 }   // Akhir Level
                            ];

                            // Sanitize sheet name (max 31 chars, no special chars)
                            let sheetName = unitName.substring(0, 31).replace(/[:\\\/\?\*\[\]]/g, '_');

                            XLSX.utils.book_append_sheet(workbook, worksheet, sheetName);
                        }
                    });

                    // Generate filename with current date
                    const today = new Date();
                    const dateStr = today.getFullYear() + '-' +
                        String(today.getMonth() + 1).padStart(2, '0') + '-' +
                        String(today.getDate()).padStart(2, '0');

                    const filename = `Evaluasi_MR_SPI_Polije_${dateStr}.xlsx`;

                    // Save file
                    XLSX.writeFile(workbook, filename);
                }
            </script>
            <script>
                function printLaporan() {
                    const container = document.getElementById('allTablesContainer');

                    // Clone container untuk manipulasi
                    const clonedContainer = container.cloneNode(true);

                    // Hapus semua tombol reorder dan kolom Edit & Hapus
                    clonedContainer.querySelectorAll('.reorder-toggle').forEach(el => el.remove());
                    clonedContainer.querySelectorAll('.drag-handle').forEach(el => el.remove());

                    // Hapus kolom header "Edit & Hapus"
                    clonedContainer.querySelectorAll('thead tr:first-child th:last-child').forEach(el => el.remove());

                    // Hapus sel "Edit & Hapus" di body
                    clonedContainer.querySelectorAll('tbody tr td:last-child').forEach(el => el.remove());

                    const printWindow = window.open('', '', 'height=800,width=1400');

                    const style = `
        <style>
            @page {
                size: A3 landscape;
                margin: 10mm;
            }
            
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            
            body {
                font-family: 'Arial', sans-serif;
                padding: 8px;
                font-size: 7px;
                max-width: 100%;
            }
            
            h2 {
                text-align: center;
                margin-bottom: 10px;
                font-size: 14px;
                color: #333;
                page-break-after: avoid;
                font-weight: bold;
            }
            
            .bagian-section {
                page-break-inside: avoid;
                margin-bottom: 25px;
            }
            
            .bagian-title {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                padding: 5px 10px;
                margin: 10px 0 5px 0;
                font-weight: 600;
                font-size: 10px;
                border-radius: 3px;
                page-break-after: avoid;
            }
            
            .table-responsive {
                width: 100%;
                overflow: visible;
                page-break-inside: avoid;
            }
            
            table {
                width: 100%;
                border-collapse: collapse;
                font-size: 6.5px;
                table-layout: auto;
                margin-bottom: 10px;
                background: white;
            }
            
            table, th, td {
                border: 0.5px solid #000;
            }
            
            th {
                background-color: #343a40 !important;
                color: white !important;
                padding: 3px 2px;
                text-align: center;
                vertical-align: middle;
                font-weight: 600;
                font-size: 6.5px;
                line-height: 1.2;
            }
            
            td {
                padding: 2px 1px;
                text-align: left;
                vertical-align: top;
                word-wrap: break-word;
                overflow-wrap: break-word;
                hyphens: auto;
                line-height: 1.3;
                max-width: 80px;
            }
            
            /* Kolom nomor dan identifikasi */
            table td:nth-child(1) { 
                width: 20px;
                text-align: center;
                font-weight: bold;
            }
            
            table td:nth-child(2) { 
                width: 25px;
                text-align: center;
                font-weight: bold;
            }
            
            table td:nth-child(3) { 
                width: 50px;
                text-align: center;
                font-size: 6px;
            }
            
            /* Kolom deskriptif - diberi ruang lebih */
            table td:nth-child(4),
            table td:nth-child(5),
            table td:nth-child(6) { 
                width: 60px;
                font-size: 6px;
            }
            
            table td:nth-child(7),
            table td:nth-child(8),
            table td:nth-child(10) { 
                width: 70px;
                font-size: 6px;
            }
            
            table td:nth-child(9),
            table td:nth-child(11) { 
                width: 50px;
                font-size: 6px;
            }
            
            /* Kolom skor - sempit */
            table td:nth-child(12),
            table td:nth-child(13),
            table td:nth-child(14),
            table td:nth-child(18),
            table td:nth-child(19),
            table td:nth-child(20),
            table td:nth-child(23),
            table td:nth-child(24),
            table td:nth-child(25) { 
                width: 22px;
                text-align: center;
                font-weight: bold;
            }
            
            /* Kolom pengendalian intern */
            table td:nth-child(15),
            table td:nth-child(16),
            table td:nth-child(17) { 
                width: 45px;
                text-align: center;
                font-size: 6px;
            }
            
            /* Kolom mitigasi */
            table td:nth-child(21) { 
                width: 45px;
                text-align: center;
                font-size: 6px;
            }
            
            table td:nth-child(22) { 
                width: 65px;
                font-size: 6px;
            }
            
            .badge {
                display: inline-block;
                padding: 1px 4px;
                border-radius: 2px;
                color: white;
                font-size: 6.5px;
                font-weight: 700;
                min-width: 18px;
            }
            
            /* Styling untuk keterangan tambahan */
            td > div {
                margin: 1px 0;
                line-height: 1.3;
            }
            
            td > div:not(:first-child) {
                border-top: 0.5px solid #ccc;
                margin-top: 2px;
                padding-top: 1px;
                font-size: 5.5px;
                color: #555;
                font-style: italic;
            }
            
            /* Hide elements tidak perlu */
            .reorder-toggle,
            .drag-handle,
            button,
            .btn,
            form {
                display: none !important;
            }
            
            /* Print adjustments */
            @media print {
                body {
                    print-color-adjust: exact;
                    -webkit-print-color-adjust: exact;
                }
                
                .bagian-section {
                    page-break-inside: avoid;
                }
                
                table {
                    page-break-inside: auto;
                }
                
                tr {
                    page-break-inside: avoid;
                    page-break-after: auto;
                }
                
                thead {
                    display: table-header-group;
                }
                
                th {
                    background-color: #343a40 !important;
                    -webkit-print-color-adjust: exact;
                    print-color-adjust: exact;
                }
            }
        </style>
    `;

                    printWindow.document.write(`
        <html>
        <head>
            <title>Laporan Evaluasi MR - SPI Polije</title>
            ${style}
        </head>
        <body>
            <h2>LAPORAN EVALUASI MANAJEMEN RISIKO</h2>
            <h2>SATUAN PENGAWASAN INTERN - POLITEKNIK NEGERI JEMBER</h2>
            <div class="table-container">
                ${clonedContainer.innerHTML}
            </div>
        </body>
        </html>
    `);

                    printWindow.document.close();
                    printWindow.focus();

                    // Delay print untuk memastikan styling sudah dimuat
                    setTimeout(() => {
                        printWindow.print();
                        printWindow.close();
                    }, 250);
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
                                    <div>
                                        <i class="fa fa-building"></i> Unit: {{ $bagian }}
                                    </div>
                                    @if(Auth::check() && Auth::user()->role === 'admin')
                                        <button class="reorder-toggle" onclick="toggleReorderMode(this, '{{ $bagian }}')">
                                            <i class="fa fa-arrows-alt"></i> Pindah Urutan
                                        </button>
                                    @endif
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped align-middle"
                                        data-unit="{{ $bagian }}">
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
                                                <tr class="draggable-row" draggable="false" data-id="{{ $risiko->id }}">
                                                    <td><span class="drag-handle"><i class="fa fa-grip-vertical"></i></span>
                                                        {{ $loop->iteration }}</td>
                                                    <td>{{ $risiko->abjad }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($risiko->tanggal_evaluasi)->format('d-m-Y') }}
                                                    </td>
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
                                                    <td class="text-center">
                                                        <div>{{ $risiko->mitigasi_opsi }}</div>
                                                        @if($risiko->mitigasi_opsi_keterangan)
                                                            <div
                                                                style="border-top:1px solid #ccc; margin-top:2px; font-size:0.8rem; color:#6c757d;">
                                                                {{ $risiko->mitigasi_opsi_keterangan }}
                                                            </div>
                                                        @endif
                                                    </td>

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
                                                                class="btn btn-sm btn-warning mb-1"><i class="fa fa-edit"></i>
                                                                Edit</a>
                                                            <form action="{{ route('evaluasiMr.destroy', $risiko->id) }}"
                                                                method="POST" style="display:inline;">
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
                                            <td class="text-center">
                                                <div>{{ $risiko->mitigasi_opsi }}</div>
                                                @if($risiko->mitigasi_opsi_keterangan)
                                                    <div
                                                        style="border-top:1px solid #ccc; margin-top:2px; font-size:0.8rem; color:#6c757d;">
                                                        {{ $risiko->mitigasi_opsi_keterangan }}
                                                    </div>
                                                @endif
                                            </td>


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
                    let draggedElement = null;
                    let activeTable = null;

                    function toggleReorderMode(button, unit) {
                        const table = document.querySelector(`table[data-unit="${unit}"]`);
                        const tbody = table.querySelector('tbody');
                        const rows = tbody.querySelectorAll('.draggable-row');

                        button.classList.toggle('active');
                        tbody.classList.toggle('reorder-mode');

                        const isReorderMode = button.classList.contains('active');

                        if (isReorderMode) {
                            button.innerHTML = '<i class="fa fa-check"></i> Selesai';
                            activeTable = tbody;

                            rows.forEach(row => {
                                row.setAttribute('draggable', 'true');
                                row.addEventListener('dragstart', handleDragStart);
                                row.addEventListener('dragend', handleDragEnd);
                                row.addEventListener('dragover', handleDragOver);
                                row.addEventListener('drop', handleDrop);
                                row.addEventListener('dragleave', handleDragLeave);
                            });
                        } else {
                            button.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';
                            button.disabled = true;

                            rows.forEach(row => {
                                row.setAttribute('draggable', 'false');
                                row.removeEventListener('dragstart', handleDragStart);
                                row.removeEventListener('dragend', handleDragEnd);
                                row.removeEventListener('dragover', handleDragOver);
                                row.removeEventListener('drop', handleDrop);
                                row.removeEventListener('dragleave', handleDragLeave);
                            });

                            updateRowNumbers(tbody);

                            // Simpan urutan ke database
                            saveOrder(tbody, button);

                            activeTable = null;
                        }
                    }

                    function saveOrder(tbody, button) {
                        const rows = tbody.querySelectorAll('.draggable-row');
                        const orders = {};

                        rows.forEach((row, index) => {
                            const id = row.getAttribute('data-id');
                            orders[id] = index + 1;
                        });

                        // Kirim ke server via AJAX
                        fetch('{{ route("evaluasiMr.updateOrder") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ orders: orders })
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    button.innerHTML = '<i class="fa fa-check-circle"></i> Tersimpan!';
                                    setTimeout(() => {
                                        button.innerHTML = '<i class="fa fa-arrows-alt"></i> Pindah Urutan';
                                        button.disabled = false;
                                    }, 1500);
                                } else {
                                    alert('Gagal menyimpan urutan!');
                                    button.innerHTML = '<i class="fa fa-arrows-alt"></i> Pindah Urutan';
                                    button.disabled = false;
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Terjadi kesalahan saat menyimpan urutan!');
                                button.innerHTML = '<i class="fa fa-arrows-alt"></i> Pindah Urutan';
                                button.disabled = false;
                            });
                    }

                    function handleDragStart(e) {
                        draggedElement = this;
                        this.classList.add('dragging');
                        e.dataTransfer.effectAllowed = 'move';
                        e.dataTransfer.setData('text/html', this.innerHTML);
                    }

                    function handleDragEnd(e) {
                        this.classList.remove('dragging');

                        const rows = activeTable.querySelectorAll('.draggable-row');
                        rows.forEach(row => {
                            row.classList.remove('drag-over');
                        });
                    }

                    function handleDragOver(e) {
                        if (e.preventDefault) {
                            e.preventDefault();
                        }

                        e.dataTransfer.dropEffect = 'move';

                        if (this !== draggedElement) {
                            this.classList.add('drag-over');
                        }

                        return false;
                    }

                    function handleDragLeave(e) {
                        this.classList.remove('drag-over');
                    }

                    function handleDrop(e) {
                        if (e.stopPropagation) {
                            e.stopPropagation();
                        }

                        if (draggedElement !== this) {
                            const allRows = [...activeTable.querySelectorAll('.draggable-row')];
                            const draggedIndex = allRows.indexOf(draggedElement);
                            const targetIndex = allRows.indexOf(this);

                            if (draggedIndex < targetIndex) {
                                this.parentNode.insertBefore(draggedElement, this.nextSibling);
                            } else {
                                this.parentNode.insertBefore(draggedElement, this);
                            }

                            updateRowNumbers(activeTable);
                        }

                        this.classList.remove('drag-over');

                        return false;
                    }

                    function updateRowNumbers(tbody) {
                        const rows = tbody.querySelectorAll('.draggable-row');
                        rows.forEach((row, index) => {
                            const numberCell = row.querySelector('td:first-child');
                            const dragHandle = numberCell.querySelector('.drag-handle');
                            if (dragHandle) {
                                numberCell.innerHTML = dragHandle.outerHTML + ' ' + (index + 1);
                            }
                        });
                    }

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