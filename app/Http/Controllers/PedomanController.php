<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedoman;

class PedomanController extends Controller
{
    public function show($id)
    {
        $pedoman = Pedoman::findOrFail($id);
        return view('pedomanpengawasan.detail-pedoman', compact('pedoman'));
    }
}
