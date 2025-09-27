<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedoman;

class DetailPengawasanController extends Controller
{
    public function index()
    {
        // ambil semua pedoman dengan jenis audit
        $pedomanAudit = Pedoman::where('jenis', 'audit')->get();
        $pedomanReviu = Pedoman::where('jenis', 'reviu')->get();
        $pedomanMonev = Pedoman::where('jenis', 'monev')->get();

        return view('pedomanpengawasan.detailPengawasan', compact('pedomanAudit', 'pedomanReviu', 'pedomanMonev'));
    }
}
