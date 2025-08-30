<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StrukturController extends Controller
{
    // Menampilkan halaman daftar struktur organisasi
    public function index()
    {
        $struktur = 'images/struktur.jpg'; // Contoh path default
        return view('struktur-organisasi', compact('struktur'));
    }

    // Menampilkan form edit
    public function edit()
    {
        return view('admin.editStruktur');
    }

    // Menangani update
    public function update(Request $request)
    {
        $request->validate([
            'struktur' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('struktur')) {
            $file = $request->file('struktur');
            $fileName = 'struktur.jpg';
            $file->move(public_path('images'), $fileName);
        }

        return redirect()->route('struktur.index')->with('success', 'Struktur organisasi berhasil diperbarui.');

    }
}
