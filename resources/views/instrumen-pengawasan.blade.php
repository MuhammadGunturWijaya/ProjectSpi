<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instrumen Pengawasan SPI POLIJE</title>
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
            <h2>Instrumen Pengawasan SPI POLIJE</h2>

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
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td>Perencanaan dan Anggaran</td>
                            <td>Menjamin proses perencanaan sesuai regulasi dan kebutuhan institusi</td>
                            <td>
                                - Kesesuaian RKA-KL dengan Renstra<br>
                                - Kesesuaian anggaran dengan prioritas program
                            </td>
                            <td>Reviu, verifikasi dokumen</td>
                            <td>Renstra, RKA-KL, DIPA</td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td>Pengelolaan Keuangan</td>
                            <td>Memastikan pengelolaan dana akuntabel dan transparan</td>
                            <td>
                                - Kepatuhan terhadap peraturan<br>
                                - Efisiensi penggunaan anggaran<br>
                                - Ketepatan laporan keuangan
                            </td>
                            <td>Audit, uji petik, konfirmasi</td>
                            <td>Laporan keuangan, SPJ, bukti transaksi</td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td>Pengadaan Barang dan Jasa</td>
                            <td>Menilai kesesuaian proses pengadaan dengan aturan yang berlaku</td>
                            <td>
                                - Kepatuhan terhadap Perpres PBJ<br>
                                - Transparansi dan akuntabilitas<br>
                                - Kualitas hasil pengadaan
                            </td>
                            <td>Audit kepatuhan, telaah dokumen, wawancara</td>
                            <td>Dokumen tender, kontrak, BAST</td>
                        </tr>
                        <tr>
                            <td class="text-center">4</td>
                            <td>Pengelolaan BMN</td>
                            <td>Menilai tertib administrasi dan pemanfaatan aset negara</td>
                            <td>
                                - Tertib pencatatan BMN<br>
                                - Optimalisasi pemanfaatan<br>
                                - Ketepatan laporan SIMAK BMN
                            </td>
                            <td>Reviu, stock opname, konfirmasi</td>
                            <td>KIB, SIMAK BMN, berita acara</td>
                        </tr>
                        <tr>
                            <td class="text-center">5</td>
                            <td>SDM dan Organisasi</td>
                            <td>Menjamin tata kelola SDM sesuai kebutuhan dan regulasi</td>
                            <td>
                                - Kepatuhan terhadap aturan ASN<br>
                                - Kesesuaian kebutuhan formasi<br>
                                - Efektivitas kinerja pegawai
                            </td>
                            <td>Audit, evaluasi kinerja, wawancara</td>
                            <td>Dokumen kepegawaian, SK, data presensi</td>
                        </tr>
                        <tr>
                            <td class="text-center">6</td>
                            <td>Manajemen Risiko</td>
                            <td>Mengidentifikasi risiko dan mitigasi dalam setiap program kerja</td>
                            <td>
                                - Tersusunnya peta risiko<br>
                                - Implementasi mitigasi risiko<br>
                                - Evaluasi tindak lanjut risiko
                            </td>
                            <td>Observasi, reviu, diskusi dengan unit</td>
                            <td>Peta risiko, laporan monitoring</td>
                        </tr>
                        <tr>
                            <td class="text-center">7</td>
                            <td>Laporan Kinerja</td>
                            <td>Memastikan laporan kinerja akurat dan sesuai fakta</td>
                            <td>
                                - Kesesuaian target & realisasi<br>
                                - Kualitas data dukung<br>
                                - Ketepatan waktu pelaporan
                            </td>
                            <td>Reviu laporan, uji petik, wawancara</td>
                            <td>LKjIP, laporan unit kerja</td>
                        </tr>
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
