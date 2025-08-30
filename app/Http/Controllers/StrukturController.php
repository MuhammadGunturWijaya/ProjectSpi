<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengurus; // Pastikan model Pengurus sudah ada

class StrukturController extends Controller
{
    // Menampilkan halaman daftar struktur organisasi + daftar pengurus
    public function index()
    {
        $struktur = 'images/struktur.jpg'; // Path default struktur
         $pengurus = Pengurus::orderBy('id', 'asc')->get(); // Ambil semua pengurus dari database

        return view('struktur-organisasi', compact('struktur', 'pengurus'));
    }

    // Menampilkan form edit struktur
    public function edit()
    {
        return view('admin.editStruktur');
    }

    // Menangani update struktur
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
