<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penguatan Akuntabilitas SPI POLIJE</title>
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
            margin: 30px auto;
            max-width: 1200px;
            box-shadow: 0 6px 16px rgba(0,0,0,0.08);
        }
        h2 {
            text-align: center;
            font-weight: bold;
            margin-bottom: 30px;
        }
        th {
            text-align: center;
            vertical-align: middle;
        }
        td {
            vertical-align: top;
        }
    </style>
</head>
<body>
    {{-- Navbar Atas --}}
    @include('layouts.navbar')

    <div class="container">
        <div class="content-wrapper">
            <h2>Instrumen Pengawasan SPI - Penguatan Akuntabilitas</h2>

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Aspek Pengawasan</th>
                            <th>Tujuan</th>
                            <th>Indikator</th>
                            <th>Metode</th>
                            <th>Dokumen Pendukung</th>
                            <th>Unit Penanggung Jawab</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $row)
                        <tr>
                            <td class="text-center">{{ $row['no'] }}</td>
                            <td>{{ $row['aspek'] }}</td>
                            <td>{{ $row['tujuan'] }}</td>
                            <td>
                                <ul>
                                    @foreach ($row['indikator'] as $indikator)
                                        <li>{{ $indikator }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $row['metode'] }}</td>
                            <td>{{ $row['dokumen'] }}</td>
                            <td>{{ $row['unit'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Navbar Bawah --}}
    @include('layouts.NavbarBawah')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
