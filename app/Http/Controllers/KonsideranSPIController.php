<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KonsideranSPIController extends Controller
{
    /**
     * Menampilkan halaman Konsideran SPI
     */
    public function index()
    {
        return view('konsideranSPI'); // resources/views/konsideranSPI.blade.php
    }
}
