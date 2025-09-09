<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PedomanMonevController extends Controller
{
    public function index()
    {
        return view('pedoman-monev');
    }
}
