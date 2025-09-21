<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IdentifikasiRisiko; // nanti kita buat model ini

class IdentifikasiRisikoController extends Controller
{

    public function index()
    {
        $risikos = \App\Models\IdentifikasiRisiko::all();
        return view('identifikasi.index', compact('risikos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'abjad' => 'required|string|max:5',
            'no' => 'required|integer',
            'tujuan' => 'required|string|max:255',
            'proses_bisnis' => 'required|string|max:255',
            'kategori_risiko' => 'required|string|max:255',
            'uraian_risiko' => 'required|string',
            'penyebab_risiko' => 'required|string',
            'sumber_risiko' => 'required|string',
            'akibat' => 'required|string',
            'pemilik_risiko' => 'required|string|max:255',
        ]);

        IdentifikasiRisiko::create($request->all());

        return redirect()->back()->with('success', 'Data risiko berhasil disimpan!');
    }

    public function create()
    {
        return view('identifikasi.editRisiko'); // arah ke view editRisiko.blade.php
    }

}
