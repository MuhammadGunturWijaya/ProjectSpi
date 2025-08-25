<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil SPI Unpad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* Warna latar belakang abu-abu muda */
        }
        .profile-section {
            background-color: #ffffff; /* Warna latar belakang putih untuk konten */
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .profile-section h2 {
            font-weight: bold;
            color: #0d2d50; /* Warna hijau tua khas Unpad */
            margin-bottom: 20px;
        }
        .profile-section p {
            line-height: 1.8;
            color: #343a40;
            text-align: justify;
        }
        .profile-section ul {
            padding-left: 25px;
        }
        .profile-section li {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    @include('layouts.navbar')
    <div class="container mt-5 mb-5">
        <div class="profile-section">
            <h2 class="text-center mb-4">Profil SPI</h2>
            <p class="lead text-center" ><strong>Kenal lebih dekat dengan kami</strong></p>

            <p><strong>SPI Unpad</strong> dibentuk berdasar pada Peraturan Pemerintah Nomor 66 Tahun 2010 tentang Perubahan atas Peraturan Pemerintah Nomor 17 Tahun 2010 tentang Pengelolaan dan Penyelenggaraan Pendidikan pasal 58 butir c: “Satuan pengawas melakukan pengawasan pelaksanaan otonomi perguruan tinggi bidang non-akademik untuk dan atas nama Rektor, Ketua atau Direktur”.</p>

            <p>Pelaksanaan operasional pengawasan SPI ditetapkan dalam <strong>Piagam Audit (Audit Charter) SPI</strong> yang pertamakali ditandatangani oleh Rektor dan Sekretaris Senat Universitas Padjadjaran tanggal 19 Januari 2007 dan diperbaharui terakhir tanggal 24 Juni 2020 ditandatangani oleh Majelis Wali Amanat dan Rektor. Piagam Audit SPI menetapkan fungsi dan tanggung jawab sebagai berikut:</p>

            <ul>
                <li>Memberikan penilaian mengenai kecukupan dan efektivitas proses manajemen Unpad dalam mengendalikan kegiatannya dan pengelolaan risiko.</li>
                <li>Melaporkan hal-hal penting berkaitan dengan proses pengendalian manajemen, termasuk melaporkan kemungkinan melakukan peningkatan pada proses tersebut.</li>
                <li>Memberikan informasi mengenai perkembangan (progress) dan hasil-hasil pelaksanaan rencana audit tahunan dan kecukupan sumber daya audit.</li>
            </ul>

            <p>Pengaturan ruang lingkup dan tugas SPI terbaru tercantum dalam <strong>Peraturan Rektor Nomor 19 Tahun 2021</strong> tentang Sistem Pengawas Internal Unpad dan <strong>Peraturan Rektor Nomor 1 Tahun 2020</strong> tentang Struktur Organisasi dan Tata Kerja Pengelola Universitas Padjadjaran.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @include('layouts.NavbarBawah')
</body>

</html>