<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
       public function index()
    {
        return view('VisiMisi'); // nama file blade kamu
    }
}
