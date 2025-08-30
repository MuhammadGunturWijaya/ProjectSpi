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

    <div class="container">
        <div class="content-wrapper">
            <!-- Breadcrumb -->
            <nav style="--bs-breadcrumb-divider: '›';" aria-label="breadcrumb">
                <ol class="breadcrumb mb-3">
                    <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="#">Profil</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Visi, Misi, dan Tujuan SPI</li>
                </ol>
            </nav>

            <!-- Judul -->
            <h2>Visi, Misi, Tujuan</h2>
            <div class="meta-info mb-4">
                <i class="bi bi-calendar"></i> 10 Oktober 2025, 14.17 &nbsp; | &nbsp;
                <i class="bi bi-person"></i> Oleh: SPI &nbsp; | &nbsp;
            </div>

            <!-- Pendahuluan -->
            <p>
                Penguatan Tata Kelola dan Akuntabilitas di lingkungan instansi Pemerintah perlu mendapatkan Pengawasan secara Sistematik yang ditujukan agar Pelaksanaan Tugas Pokok dan Fungsi Instansi Pemerintah terkendali, efisien, dan efektif sesuai dengan peraturan perundang-undangan. Hal ini menjadi kebutuhan dan bagian penting bagi SPI POLIJE untuk mengarahkan dan menjamin tugas pokok dan fungsinya berjalan dengan baik sesuai dengan perundangan dan peraturan yang berlaku. 
            </p>
            <p>
                Arah implementasi tugas dan fungsi pokok diimplementasikan secara akademik dalam visi dan misi SPI POLIJE yang menyesuaikan dengan Karakter POLIJE sebagai Satuan Kerja dari Kementerian Pendidikan dan Kebudayaan (Kemendikbud). Penyusunan Visi dan Misi SPI POLIJE telah memperhatikan, mempertimbangkan, dan merujuk pada Visi Kemendikbudristek dan Visi POLIJE.
            </p>
            <p>
                Visi Kemendikbud tersebut adalah: Kementerian Pendidikan dan Kebudayaan mendukung Visi dan Misi Presiden untuk mewujudkan Indonesia Maju dan berdaulat, mandiri, dan berkepribadian melalui terciptanya Pelajar Pancasila yang bernalar kritis, kreatif, mandiri, beriman, bertakwa kepada Tuhan Yang Maha Esa, berakhlak mulia, bergotong royong, dan berkebhinekaan global.
            </p>
            <p>
                Visi Kemendikbud di atas telah diderivasikan oleh POLIJE dengan menyesuaikan karakter, kondisi, dan tantangan POLIJE untuk kurun waktu 2020-2024 yaitu: Mendukung Visi dan Misi Kementerian Pendidikan dan Kebudayaan dengan mewujudkan Pendidikan Tinggi Vokasi yang Unggul dan Berdaya Saing di bidang Teknologi Terapan serta menghasilkan Lulusan yang Berkarakter Pancasila.
                Visi POLIJE ini merupakan bagian atas pentahapan Rencana Pengembangan Jangka Panjang dalam rangka mencapai visi jangka panjang POLIJE yaitu “Menjadi Politeknik Unggul di Asia Tahun 2035”.
            </p>

            <!-- Visi -->
            <h5 class="section-title">Visi</h5>
            <p>
                Mendukung visi dan misi POLIJE dengan mewujudkan SPI yang berintegritas dan profesional untuk mencapai Good POLIJE Governance.
            </p>

            <!-- Misi -->
            <h5 class="section-title">Misi</h5>
            <ol>
                <li><p>Meningkatkan pengawasan internal yang berintegritas dan profesional.</p></li>
                <li><p>Memastikan pelaksanaan pengawasan dan pengelolaan berdasarkan prinsip akuntabilitas, transparansi, dan obyektifitas.</p></li>
                <li><p>Menjadi mitra strategis bagi manajemen politeknik dalam memberikan nilai tambah penyelenggaraan aktivitas non akademik.</p></li>
            </ol>

            <!-- Tujuan -->
            <h5 class="section-title">Tujuan</h5>
            <ol>
                <li><p> Membantu manajemen POLIJE dalam memberikan layanan aktivitas non akademik terbaik melalui peningkatan keefektifan pengendalian internal secara efisien.</p></li>
                <li><p>Menyediakan laporan hasil audit, reviu, penilaian, dan/atau evaluasi atas aktivitas unit dan memberikan rekomendasi relevan sebagai dasar pertimbangan manajemen dalam pengambilan keputusan.</p></li>
                <li><p>Melakukan evaluasi terhadap kecukupan dan keandalan pengendalian internal untuk memberikan jaminan bahwa penerimaan, pengeluaran, perlindungan aset, dan laporan keuangan sudah sesuai prosedur.</p></li>
                <li><p>Melakukan evaluasi terhadap kecukupan dan keandalan pengendalian internal untuk memberikan jaminan bahwa aturan, undang-undang, dan kebijakan POLIJE telah dipatuhi dan diimplementasikan.</p></li>
            </ol>
        </div>
    </div>

    @include('layouts.NavbarBawah')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</body>
</html>
