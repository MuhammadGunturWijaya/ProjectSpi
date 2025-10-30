<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AspirasiController extends Controller
{
    public function create()
    {
        return view('aspirasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'keterangan' => 'required|string',
            'asal_pelapor' => 'required|string|max:255',
            'instansi' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'kategori' => 'required|in:agama,kesehatan,keuangan',
            'lampiran' => 'nullable|file|max:2048',
        ]);

        // Simpan file jika ada
        if ($request->hasFile('lampiran')) {
            $validated['lampiran'] = $request->file('lampiran')->store('lampiran', 'public');
        }

        // Simpan ke database (opsional)
        // Aspirasi::create($validated);

        return redirect()->back()->with('success', 'Aspirasi berhasil dikirim!');
    }
}
