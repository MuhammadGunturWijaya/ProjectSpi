<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PedomanAuditController extends Controller
{
    /**
     * Menampilkan halaman Pedoman Audit SPI
     */
    public function index()
    {
        return view('pedomanAudit'); // resources/views/pedomanAudit.blade.php
    }
}
