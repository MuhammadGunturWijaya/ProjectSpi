<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProsesBisnisSPIController extends Controller
{
    /**
     * Menampilkan halaman Proses Bisnis SPI
     */
    public function index()
    {
        return view('prosesBisnisSPI'); // resources/views/prosesBisnisSPI.blade.php
    }
}
