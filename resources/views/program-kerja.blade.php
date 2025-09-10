<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instrumen Kerja SPI POLIJE</title>
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
            max-width: 950px;
            box-shadow: 0 6px 16px rgba(0,0,0,0.08);
        }
        h2 {
            text-align: center;
            font-weight: bold;
            margin-bottom: 30px;
        }
        h4 {
            margin-top: 30px;
            font-weight: bold;
            color: #0d2d50;
        }
        ol {
            margin-top: 10px;
        }
        ul {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    {{-- Navbar Atas --}}
    @include('layouts.navbar')

    <div class="container">
        <div class="content-wrapper">
            <h2>Program Kerja SPI </h2>

            {{-- Tugas dan Fungsi --}}
            <h4>Tugas dan Fungsi</h4>
            <b>a. Tugas SPI</b>
            <ol>
                <li>Menyusun dan melaksanakan rencana pengawasan internal</li>
                <li>Menyusun peta risiko SPI</li>
                <li>Memantau dan mengevaluasi pelaksanaan program institusi dan kebijakan pimpinan</li>
                <li>Mengkoordinasi tindak lanjut manajemen risiko institusi sebagai dasar pengawasan dan pengendalian internal</li>
                <li>Melakukan pemeriksaan penilaian atas efisiensi dan efektivitas bidang kebijakan dan program, keuangan, manajemen risiko, pengadaan barang dan jasa, reformasi birokrasi, SDM, BMN</li>
                <li>Melakukan pendampingan dan reviu RKA KL dan laporan keuangan</li>
                <li>Menyusun laporan hasil pengawasan</li>
                <li>Memantau, menganalisis dan melaporkan pelaksanaan tindak lanjut rekomendasi pengawasan</li>
                <li>Mengembangkan jejaring SPI</li>
                <li>Memberikan saran perbaikan dan rekomendasi berdasarkan informasi yang objektif</li>
                <li>Menyusun laporan kinerja SPI</li>
            </ol>

            <b>b. Fungsi SPI</b>
            <ol>
                <li>Membantu manajemen dalam hal pengawasan, pengendalian, dan penilaian dalam rangka penjaminan layanan dan peringatan dini</li>
                <li>Sebagai satuan pengawas internal yang independen</li>
            </ol>

            {{-- Hak dan Wewenang --}}
            <h4>Hak dan Wewenang</h4>
            <b>a. Hak SPI</b>
            <ol>
                <li>Mendapat perlindungan atas pelaksanaan dan dampak tugas audit</li>
                <li>Mengusulkan tenaga ahli dan/atau perangkat audit berdasarkan analisis kebutuhan audit</li>
                <li>Mengembangkan kompetensi bidang pengawasan dan pengendalian</li>
            </ol>

            <b>b. Wewenang SPI</b>
            <ol>
                <li>Mengakses unit kerja, informasi, data, aktivitas, personalia, serta sarana prasarana fisik dan non fisik untuk keperluan pelaksanaan tugas pengawasan, berdasarkan Surat Tugas Direktur</li>
                <li>Berkomunikasi langsung dengan organ POLIJE terkait tugas pengawasan</li>
                <li>Berkomunikasi dengan Inspektorat Jenderal Kemendikbud Ristek terkait tugas pengawasan</li>
            </ol>

            {{-- Tanggung Jawab --}}
            <h4>Tanggung Jawab</h4>
            <ol>
                <li>Kebenaran temuan</li>
                <li>Rekomendasi</li>
                <li>Audit tindak lanjut</li>
                <li>Koordinasi dengan auditor eksternal</li>
            </ol>

            {{-- Independensi --}}
            <h4>Independensi</h4>
            <ol>
                <li>Bekerja tanpa tekanan atau campur tangan dari pihak lain</li>
                <li>Memiliki kebebasan dalam menetapkan prosedur audit</li>
                <li>Memberikan laporan khusus kepada Inspektorat Jenderal Kementerian Pendidikan dan Kebudayaan</li>
            </ol>

            {{-- Kode Etik --}}
            <h4>Kode Etik</h4>
            <ol>
                <li>Independensi (bebas, tidak ada benturan kepentingan/conflict of interest)</li>
                <li>Objektivitas (tidak berdasarkan pendapat pribadi)</li>
                <li>Integritas (mempunyai kejujuran profesi)</li>
                <li>Profesionalisme (keahlian dalam melaksanakan tugas)</li>
                <li>Kompetensi (kemampuan dalam merekonstruksi permasalahan)</li>
                <li>Memberikan pencerahan, saran perbaikan yang rasional, konstruktif dan dapat ditindaklanjuti</li>
                <li>Berperilaku sopan</li>
            </ol>

            {{-- Persyaratan Auditor Intern SPI --}}
            <h4>Persyaratan Auditor Intern SPI</h4>
            <p>Persyaratan auditor internal paling sedikit menguasai:</p>
            <ol>
                <li>Pencatatan dan pelaporan keuangan</li>
                <li>Tata kelola Perguruan Tinggi</li>
                <li>Peraturan perundang-undangan di bidang Pendidikan Tinggi</li>
                <li>Pengelolaan barang milik negara</li>
                <li>Memiliki integritas dan perilaku yang profesional, independen, jujur, dan objektif dalam pelaksanaan tugasnya</li>
                <li>Memiliki pengetahuan dan pengalaman mengenai teknis audit dan disiplin ilmu lain yang relevan dengan bidang tugasnya</li>
                <li>Memiliki pengetahuan tentang peraturan perundang-undangan</li>
                <li>Memiliki kecakapan untuk berinteraksi dan berkomunikasi baik lisan maupun tertulis secara efektif</li>
                <li>Mematuhi standar profesi yang dikeluarkan oleh asosiasi Audit Internal</li>
                <li>Mematuhi kode etik Audit Internal</li>
                <li>Menjaga kerahasiaan informasi dan/atau data terkait dengan pelaksanaan tugas dan tanggung jawab Audit Internal</li>
                <li>Memahami prinsip tata kelola perusahaan yang baik dan manajemen risiko</li>
                <li>Bersedia meningkatkan pengetahuan, keahlian, dan kemampuan profesionalismenya secara terus-menerus</li>
            </ol>
        </div>
    </div>

    {{-- Navbar Bawah --}}
    @include('layouts.NavbarBawah')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
