<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PiagamSPIController extends Controller
{
    /**
     * Menampilkan halaman Piagam SPI
     */
    public function index()
    {
        return view('piagamSPI'); // resources/views/piagamSPI.blade.php
    }
}
