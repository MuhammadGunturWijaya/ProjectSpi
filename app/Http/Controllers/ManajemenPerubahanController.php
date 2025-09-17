<?php

namespace App\Http\Controllers;

use App\Models\manajemenPerubahan;
use Illuminate\Http\Request;

class ManajemenPerubahanController extends Controller
{

    public function index()
    {
        $manajemenperubahan = ManajemenPerubahan::orderBy('created_at', 'desc')->get();
        return view('manajemenPerubahan', compact('manajemenperubahan'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_manajemen' => 'required|string|max:255',
            'tahun' => 'required|digits:4|integer',
            'file_manajemen' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        // Simpan file
        $filePath = $request->file('file_manajemen')->store('manajemen-files', 'public');

        // Simpan data ke database
        \App\Models\ManajemenPerubahan::create([
            'nama_manajemen' => $request->nama_manajemen,
            'tahun' => $request->tahun,
            'file_path' => $filePath,
        ]);

        return redirect()->back()->with('success', 'Manajemen berhasil diunggah!');
    }



    public function show($id)
    {
        // Ambil piagam berdasarkan ID
        $manajemen = Piagam::findOrFail($id);

        // Tampilkan halaman detail
        return view('piagamDetail', compact('piagam'));
    }

}
