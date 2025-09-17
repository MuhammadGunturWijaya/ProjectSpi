<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Piagam;
use Illuminate\Support\Facades\Storage;

class PiagamSPIController extends Controller
{
    public function index()
    {
        $piagams = Piagam::orderBy('created_at', 'desc')->get();
        return view('piagamSPI', compact('piagams'));
    }


    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_piagam' => 'required|string|max:255',
            'tahun' => 'required|digits:4|integer',
            'file_piagam' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120', // max 5MB
        ]);

        // Simpan file
        $filePath = $request->file('file_piagam')->store('piagams', 'public');

        // Simpan data ke database
        Piagam::create([
            'nama_piagam' => $request->nama_piagam,
            'tahun' => $request->tahun,
            'file_path' => $filePath,
        ]);

        return redirect()->back()->with('success', 'Piagam berhasil diunggah!');
    }

    public function show($id)
    {
        // Ambil piagam berdasarkan ID
        $piagam = Piagam::findOrFail($id);

        // Tampilkan halaman detail
        return view('piagamDetail', compact('piagam'));
    }


}
