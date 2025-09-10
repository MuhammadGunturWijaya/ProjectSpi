<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProgramKerjaController extends Controller
{
    public function index()
    {
        // contoh data dummy
        $programKerja = [
            [
                'nama' => 'Audit Internal Tahunan',
                'deskripsi' => 'Melaksanakan audit internal untuk memastikan tata kelola berjalan sesuai aturan.',
                'periode' => '2025',
                'status' => 'Aktif'
            ],
            [
                'nama' => 'Evaluasi Kinerja Unit',
                'deskripsi' => 'Menilai capaian kinerja setiap unit kerja di POLIJE.',
                'periode' => '2025',
                'status' => 'Proses'
            ],
            [
                'nama' => 'Pelatihan Tata Kelola',
                'deskripsi' => 'Mengadakan pelatihan internal tentang tata kelola dan akuntabilitas.',
                'periode' => '2024',
                'status' => 'Selesai'
            ],
        ];

        return view('program-kerja', compact('programKerja'));
    }
}
