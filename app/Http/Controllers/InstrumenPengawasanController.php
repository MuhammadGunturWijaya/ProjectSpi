<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstrumenPengawasanController extends Controller
{
    // Tampilkan daftar instrumen pengawasan
    public function index()
    {
        // Nanti data bisa diambil dari database, sementara pakai array contoh
        $data = [
            [
                'nama' => 'Audit Internal',
                'deskripsi' => 'Pengawasan terhadap kepatuhan aturan internal POLIJE.',
                'status' => 'Aktif'
            ],
            [
                'nama' => 'Reviu Kinerja',
                'deskripsi' => 'Evaluasi capaian kinerja unit kerja.',
                'status' => 'Proses'
            ],
            [
                'nama' => 'Evaluasi Keuangan',
                'deskripsi' => 'Pemeriksaan laporan keuangan unit kerja.',
                'status' => 'Selesai'
            ],
        ];

       return view('instrumen-pengawasan', compact('data'));

    }
}
