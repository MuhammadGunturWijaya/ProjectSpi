<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenataanTataKelolaController extends Controller
{
    /**
     * Halaman utama Penataan Tata Kelola
     */
    public function index()
    {
        return view('penataan-tata-kelola'); // Blade ada di resources/views
    }
}
