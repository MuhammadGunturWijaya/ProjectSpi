<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengurus;

class PengurusController extends Controller
{
    // Form tambah pengurus baru
    // Form tambah pengurus

    public function index()
    {
        $penguruses = Pengurus::all(); // ambil semua data pengurus
        return redirect()->route('pengurus.index')->with('success', 'Pengurus berhasil dihapus.');

    }

    public function create()
    {
        return view('admin.createPengurus');
    }

    // Simpan data pengurus baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $pengurus = new Pengurus();
        $pengurus->nama = $request->nama;
        $pengurus->jabatan = $request->jabatan;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $pengurus->foto = $filename;
        }

        $pengurus->save();

        return redirect()->route('struktur.index')->with('success', 'Pengurus berhasil ditambahkan!');
    }

    // Form edit pengurus
    public function edit($id)
    {
        $pengurus = Pengurus::findOrFail($id);
        return view('admin.editPengurus', compact('pengurus'));
    }

    // Update data pengurus
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $pengurus = Pengurus::findOrFail($id);
        $pengurus->nama = $request->nama;
        $pengurus->jabatan = $request->jabatan;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $pengurus->foto = $filename;
        }

        $pengurus->save();

        return redirect()->route('struktur.index')->with('success', 'Pengurus berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pengurus = Pengurus::findOrFail($id);

        if ($pengurus->foto && file_exists(public_path('images/pengurus/' . $pengurus->foto))) {
            unlink(public_path('images/pengurus/' . $pengurus->foto));
        }

        $pengurus->delete();

        // Redirect ke halaman struktur karena pengurusIndex tidak ada
        return redirect()->route('struktur.index')->with('success', 'Pengurus berhasil dihapus.');
    }



}
