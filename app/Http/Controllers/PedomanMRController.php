<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PedomanMRController extends Controller
{
    /**
     * Tampilkan halaman Pedoman Manajemen Risiko
     */
    public function index()
    {
        return view('pedoman-mr');
    }
}
