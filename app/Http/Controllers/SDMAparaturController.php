<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SDMAparaturController extends Controller
{
    public function index()
    {
        $data = [
            [
                'no' => 1,
                'aspek' => 'Perencanaan Kebutuhan Pegawai',
                'tujuan' => 'Memastikan formasi pegawai sesuai kebutuhan organisasi',
                'indikator' => [
                    'Ketersediaan analisis jabatan (Anjab)',
                    'Analisis beban kerja (ABK)',
                    'Usulan formasi pegawai yang realistis'
                ],
                'metode' => 'Reviu dokumen, wawancara',
                'dokumen' => 'Dokumen Anjab, ABK, usulan formasi',
                'unit' => 'Bagian Kepegawaian / SDM',
            ],
            [
                'no' => 2,
                'aspek' => 'Rekrutmen dan Seleksi',
                'tujuan' => 'Menilai transparansi dan kepatuhan dalam proses rekrutmen pegawai',
                'indikator' => [
                    'Proses seleksi sesuai aturan ASN',
                    'Adanya pengumuman resmi',
                    'Kesesuaian hasil seleksi dengan ketentuan'
                ],
                'metode' => 'Audit kepatuhan, telaah dokumen',
                'dokumen' => 'Pengumuman seleksi, berita acara, SK pengangkatan',
                'unit' => 'Bagian SDM & Biro Umum',
            ],
            [
                'no' => 3,
                'aspek' => 'Pengembangan Kompetensi',
                'tujuan' => 'Meningkatkan kapasitas pegawai sesuai kebutuhan jabatan',
                'indikator' => [
                    'Adanya rencana pengembangan pegawai',
                    'Realisasi pelatihan/pendidikan',
                    'Evaluasi hasil pelatihan'
                ],
                'metode' => 'Reviu, observasi, wawancara',
                'dokumen' => 'Rencana pengembangan SDM, daftar pelatihan, sertifikat',
                'unit' => 'Pusat Pelatihan / Bagian SDM',
            ],
            [
                'no' => 4,
                'aspek' => 'Kinerja Pegawai',
                'tujuan' => 'Menjamin penilaian kinerja objektif dan terukur',
                'indikator' => [
                    'Adanya SKP yang disusun pegawai',
                    'Evaluasi kinerja secara berkala',
                    'Tindak lanjut atas pegawai dengan kinerja rendah'
                ],
                'metode' => 'Audit kinerja, telaah SKP',
                'dokumen' => 'SKP, laporan evaluasi kinerja, berita acara',
                'unit' => 'Atasan langsung & Bagian SDM',
            ],
            [
                'no' => 5,
                'aspek' => 'Kedisiplinan Pegawai',
                'tujuan' => 'Menegakkan disiplin dan etika kerja pegawai',
                'indikator' => [
                    'Kepatuhan terhadap jam kerja',
                    'Kepatuhan terhadap aturan internal',
                    'Tindakan terhadap pelanggaran disiplin'
                ],
                'metode' => 'Observasi, uji petik data absensi',
                'dokumen' => 'Rekap absensi, laporan pelanggaran disiplin, surat peringatan',
                'unit' => 'Bagian SDM & Pimpinan Unit',
            ],
            [
                'no' => 6,
                'aspek' => 'Pola Karier dan Promosi',
                'tujuan' => 'Menjamin promosi dan rotasi pegawai berdasarkan merit sistem',
                'indikator' => [
                    'Adanya regulasi tentang pola karier',
                    'Kesesuaian promosi dengan kinerja dan kompetensi',
                    'Transparansi dalam proses promosi'
                ],
                'metode' => 'Telaah dokumen, wawancara',
                'dokumen' => 'SK promosi/rotasi, berita acara, aturan pola karier',
                'unit' => 'Bagian SDM, Pimpinan Institusi',
            ],
        ];

        return view('penataan-sdm-aparatur', compact('data'));
    }
}
