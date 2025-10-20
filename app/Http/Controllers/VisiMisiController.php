<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisiMisi;

class VisiMisiController extends Controller
{
    // Halaman publik: menampilkan Tujuan, Visi, Misi
    public function index()
    {
        $visimisi = VisiMisi::first(); // Ambil data pertama (hanya satu)
        return view('VisiMisi', compact('visimisi')); // pastikan nama blade sama
    }

    // Halaman edit untuk admin
    public function edit()
    {
        $visimisi = VisiMisi::first();
        return view('admin.visimisi.edit', compact('visimisi'));
    }

    // Update data dari form admin
    public function update(Request $request)
    {
        $request->validate([
            'tujuan' => 'required',
            'visi' => 'required',
            'misi' => 'required',
        ]);

        $visimisi = VisiMisi::firstOrCreate([]); // buat record jika belum ada
        $visimisi->update([
            'tujuan' => $request->tujuan,
            'visi' => $request->visi,
            'misi' => $request->misi,
        ]);

        return redirect()->route('visi-misi.index')->with('success', 'Visi, Misi & Tujuan berhasil diperbarui.');
    }
}
