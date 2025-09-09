<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PedomanReviuController extends Controller
{
    public function index()
    {
        return view('pedoman-reviu');
    }
}
