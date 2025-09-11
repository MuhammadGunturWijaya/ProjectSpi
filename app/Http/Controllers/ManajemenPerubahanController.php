<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManajemenPerubahanController extends Controller
{
    public function index()
    {
        return view('manajemen-perubahan');
    }
}
