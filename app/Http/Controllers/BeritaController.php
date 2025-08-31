<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;

class BeritaController extends Controller
{
    // Halaman semua berita
    public function index()
    {
        $beritas = Berita::latest()->get();
        return view('berita.index', compact('beritas')); // ✅ diarahkan ke folder berita/index.blade.php
    }

    // Halaman detail berita
    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        return view('berita.show', compact('berita')); // ✅ diarahkan ke folder berita/show.blade.php
    }

    // Form tambah berita
    public function create()
    {
        return view('berita.create'); // ✅ sebaiknya di berita/create.blade.php
    }

    // Simpan berita
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'tanggal' => 'required|date',
        ]);

        // Simpan gambar
        $path = $request->file('gambar')->store('berita', 'public');

        // Simpan ke DB
        Berita::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'gambar' => 'storage/' . $path,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan!');
    }
}
