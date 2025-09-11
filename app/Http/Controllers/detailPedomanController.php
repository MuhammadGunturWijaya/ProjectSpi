<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class detailPedomanController extends Controller
{
    /**
     * Tampilkan halaman detail pedoman.
     */
    public function index()
    {
        return view('pedomanpengawasan.detail-pedoman');
    }
}