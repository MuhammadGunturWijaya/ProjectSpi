<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AkuntabilitasController extends Controller
{
    public function index()
    {
        $data = [
            [
                'no' => 1,
                'aspek' => 'Perencanaan Kinerja',
                'tujuan' => 'Memastikan perencanaan kinerja sesuai visi, misi, dan tujuan institusi',
                'indikator' => [
                    'Dokumen perencanaan kinerja tersedia',
                    'Sasaran kinerja sesuai Renstra',
                    'Keterkaitan antara perencanaan dan anggaran'
                ],
                'metode' => 'Telaah dokumen, wawancara',
                'dokumen' => 'Renstra, RKT, Perjanjian Kinerja',
                'unit' => 'Bagian Perencanaan'
            ],
            [
                'no' => 2,
                'aspek' => 'Pengukuran Kinerja',
                'tujuan' => 'Menilai apakah capaian kinerja diukur secara objektif',
                'indikator' => [
                    'Tersedia indikator kinerja yang terukur',
                    'Laporan kinerja berbasis output/outcome',
                    'Kesesuaian indikator dengan tujuan strategis'
                ],
                'metode' => 'Audit kinerja, reviu laporan',
                'dokumen' => 'Laporan Kinerja (LKj), Monev Kinerja',
                'unit' => 'Bagian Perencanaan & Unit Kerja'
            ],
            [
                'no' => 3,
                'aspek' => 'Pelaporan Kinerja',
                'tujuan' => 'Menjamin pelaporan kinerja transparan dan akuntabel',
                'indikator' => [
                    'Laporan kinerja disusun secara berkala',
                    'Laporan dipublikasikan secara terbuka',
                    'Laporan diverifikasi oleh pimpinan'
                ],
                'metode' => 'Reviu laporan, wawancara',
                'dokumen' => 'LKj, Laporan Tahunan',
                'unit' => 'Bagian Perencanaan & SPI'
            ],
            [
                'no' => 4,
                'aspek' => 'Evaluasi dan Tindak Lanjut',
                'tujuan' => 'Memastikan hasil evaluasi digunakan untuk perbaikan kinerja',
                'indikator' => [
                    'Ada dokumen evaluasi capaian kinerja',
                    'Tindak lanjut atas hasil evaluasi',
                    'Rekomendasi dimanfaatkan untuk perencanaan berikutnya'
                ],
                'metode' => 'Telaah hasil evaluasi',
                'dokumen' => 'Laporan evaluasi, rekomendasi SPI',
                'unit' => 'Pimpinan, Bagian Perencanaan, SPI'
            ],
        ];

        return view('penguatan-akuntabilitas', compact('data'));
    }
}
