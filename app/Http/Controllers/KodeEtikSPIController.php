<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KodeEtikSPIController extends Controller
{
    /**
     * Menampilkan halaman Kode Etik SPI
     */
    public function index()
    {
        return view('kodeEtikSPI'); // resources/views/kodeEtikSPI.blade.php
    }
}
