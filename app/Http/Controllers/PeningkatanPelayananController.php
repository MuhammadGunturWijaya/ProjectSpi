<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeningkatanPelayananController extends Controller
{
    /**
     * Menampilkan halaman Peningkatan Kualitas Pelayanan Publik.
     */
    public function index()
    {
        return view('pelayanan');
    }
}
