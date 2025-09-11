<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenguatanPengawasanController extends Controller
{
    /**
     * Halaman utama Penguatan Pengawasan
     */
    public function index()
    {
        return view('penguatan-pengawasan'); // Blade di resources/views
    }
}
