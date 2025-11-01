<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identifikasi Risiko - SPI Polije</title>
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
            flex-wrap: wrap;
            gap: 10px;
        }

        .card-header i {
            margin-right: 0.5rem;
        }

        .btn-success, .btn-primary {
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

        .btn-primary:hover {
            background-color: #0056b3;
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
                <h4 class="mb-0"><i class="fa fa-shield-alt"></i> Daftar Identifikasi Risiko</h4>
                <div class="d-flex gap-2 flex-wrap">
                    @if(Auth::check() && Auth::user()->role === 'admin')
                        <a href="{{ route('identifikasi.risiko.create') }}" class="btn btn-success">
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

            <!-- Load XLSX Library -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

            <!-- Export to Excel Function -->
            <script>
                function exportToExcel() {
                    const workbook = XLSX.utils.book_new();
                    const bagianSections = document.querySelectorAll('.bagian-section');

                    bagianSections.forEach(section => {
                        const unitName = section.querySelector('.bagian-title').textContent.trim().replace('Unit: ', '').trim();
                        const table = section.querySelector('table');

                        if (table) {
                            const clonedTable = table.cloneNode(true);
                            clonedTable.querySelectorAll('td:last-child').forEach(el => el.textContent = '');

                            const worksheet = XLSX.utils.table_to_sheet(clonedTable);
                            worksheet['!cols'] = [
                                { wch: 5 },   // #
                                { wch: 8 },   // Abjad
                                { wch: 20 },  // Tujuan
                                { wch: 20 },  // Proses Bisnis
                                { wch: 15 },  // Kategori
                                { wch: 30 },  // Uraian
                                { wch: 25 },  // Penyebab
                                { wch: 15 },  // Sumber
                                { wch: 25 },  // Akibat
                                { wch: 15 }   // Pemilik
                            ];

                            let sheetName = unitName.substring(0, 31).replace(/[:\\\/\?\*\[\]]/g, '_');
                            XLSX.utils.book_append_sheet(workbook, worksheet, sheetName);
                        }
                    });

                    const today = new Date();
                    const dateStr = today.getFullYear() + '-' +
                        String(today.getMonth() + 1).padStart(2, '0') + '-' +
                        String(today.getDate()).padStart(2, '0');

                    const filename = `Identifikasi_Risiko_SPI_Polije_${dateStr}.xlsx`;
                    XLSX.writeFile(workbook, filename);
                }
            </script>

            <!-- Print Function -->
            <script>
                function printLaporan() {
                    const container = document.getElementById('allTablesContainer');
                    const clonedContainer = container.cloneNode(true);
                    
                    // Hapus kolom Edit & Hapus
                    clonedContainer.querySelectorAll('thead tr th:last-child').forEach(el => el.remove());
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
                                font-size: 9px;
                            }
                            
                            h2 {
                                text-align: center;
                                margin-bottom: 15px;
                                font-size: 16px;
                                color: #333;
                                font-weight: bold;
                            }
                            
                            .bagian-section {
                                page-break-inside: avoid;
                                margin-bottom: 25px;
                            }
                            
                            .bagian-title {
                                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                                color: white;
                                padding: 8px 12px;
                                margin: 12px 0 8px 0;
                                font-weight: 600;
                                font-size: 12px;
                                border-radius: 4px;
                            }
                            
                            table {
                                width: 100%;
                                border-collapse: collapse;
                                font-size: 8px;
                                margin-bottom: 15px;
                                background: white;
                            }
                            
                            table, th, td {
                                border: 0.5px solid #000;
                            }
                            
                            th {
                                background-color: #343a40 !important;
                                color: white !important;
                                padding: 6px 4px;
                                text-align: center;
                                vertical-align: middle;
                                font-weight: 600;
                            }
                            
                            td {
                                padding: 4px 3px;
                                vertical-align: top;
                                word-wrap: break-word;
                                line-height: 1.4;
                            }
                            
                            td:nth-child(1) { width: 3%; text-align: center; }
                            td:nth-child(2) { width: 5%; text-align: center; }
                            td:nth-child(3) { width: 12%; }
                            td:nth-child(4) { width: 12%; }
                            td:nth-child(5) { width: 10%; }
                            td:nth-child(6) { width: 15%; }
                            td:nth-child(7) { width: 14%; }
                            td:nth-child(8) { width: 10%; }
                            td:nth-child(9) { width: 14%; }
                            td:nth-child(10) { width: 10%; }
                            
                            button, .btn, form {
                                display: none !important;
                            }
                            
                            @media print {
                                body {
                                    print-color-adjust: exact;
                                    -webkit-print-color-adjust: exact;
                                }
                                
                                .bagian-section {
                                    page-break-inside: avoid;
                                }
                                
                                thead {
                                    display: table-header-group;
                                }
                                
                                th {
                                    background-color: #343a40 !important;
                                }
                            }
                        </style>
                    `;
                    
                    printWindow.document.write(`
                        <html>
                        <head>
                            <title>Laporan Identifikasi Risiko - SPI Polije</title>
                            ${style}
                        </head>
                        <body>
                            <h2>LAPORAN IDENTIFIKASI RISIKO</h2>
                            <h2>SATUAN PENGAWASAN INTERN - POLITEKNIK NEGERI JEMBER</h2>
                            ${clonedContainer.innerHTML}
                        </body>
                        </html>
                    `);
                    
                    printWindow.document.close();
                    printWindow.focus();
                    
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
                    // Group risiko by bagian
                    $risikosByBagian = $risikos->groupBy('bagian');
                @endphp

                {{-- Dropdown Filter Unit --}}
                <div class="mb-3">
                    <strong>Filter Unit :</strong>
                    <select class="form-select form-select-sm d-inline-block" style="width: 200px;" onchange="filterBagian(this.value)">
                        <option value="all">Semua Unit</option>
                        @php
                            $bagians = $risikos->pluck('bagian')->unique()->filter();
                        @endphp
                        @foreach($bagians as $bagian)
                            <option value="{{ $bagian }}">{{ $bagian }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Container untuk semua tabel --}}
                <div id="allTablesContainer">
                    {{-- Tabel grouped by bagian --}}
                    <div id="groupedTables" style="display: block;">
                        @foreach($risikosByBagian as $bagian => $risikoGroup)
                            <div class="bagian-section" data-bagian-group="{{ $bagian }}">
                                <div class="bagian-title">
                                    <i class="fa fa-building"></i> Unit: {{ $bagian }}
                                </div>
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
                                            @foreach($risikoGroup as $risiko)
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
                                                    <td class="text-center">
                                                        @if(Auth::check() && Auth::user()->role === 'admin')
                                                            <a href="{{ route('identifikasi.risiko.edit', $risiko->id) }}"
                                                                class="btn btn-sm btn-warning mb-1">
                                                                <i class="fa fa-edit"></i> Edit
                                                            </a>
                                                            <form action="{{ route('identifikasi.risiko.destroy', $risiko->id) }}"
                                                                method="POST" class="d-inline"
                                                                onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger">
                                                                    <i class="fa fa-trash"></i> Hapus
                                                                </button>
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

                    {{-- Tabel tunggal untuk filter spesifik --}}
                    <div id="singleTable" style="display: none;">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle" id="risikoTable">
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
                                        <th>Bagian</th>
                                        <th>Edit & Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($risikos as $risiko)
                                        <tr data-bagian="{{ $risiko->bagian }}">
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
                                            <td>{{ $risiko->bagian }}</td>
                                            <td class="text-center">
                                                @if(Auth::check() && Auth::user()->role === 'admin')
                                                    <a href="{{ route('identifikasi.risiko.edit', $risiko->id) }}"
                                                        class="btn btn-sm btn-warning mb-1">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>
                                                    <form action="{{ route('identifikasi.risiko.destroy', $risiko->id) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fa fa-trash"></i> Hapus
                                                        </button>
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
                            groupedTables.style.display = 'block';
                            singleTable.style.display = 'none';
                        } else {
                            groupedTables.style.display = 'none';
                            singleTable.style.display = 'block';

                            const rows = document.querySelectorAll('#risikoTable tbody tr');
                            rows.forEach(row => {
                                if (row.getAttribute('data-bagian') === bagian) {
                                    row.style.display = '';
                                } else {
                                    row.style.display = 'none';
                                }
                            });
                        }
                    }
                </script>
            </div>
        </div>
    </div>

    @include('layouts.NavbarBawah')

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>