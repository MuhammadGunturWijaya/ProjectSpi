<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function create()
    {
        return view('pengaduan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'kategori' => 'required',
            'judul' => 'required|string|max:255',
            'kritik_saran' => 'required|string',
            'bukti_foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('bukti_foto')) {
            $validated['bukti_foto'] = $request->file('bukti_foto')->store('bukti', 'public');
        }

        \App\Models\Pengaduan::create($validated);

        return redirect()->back()->with('success', 'Pengaduan berhasil dikirim. Terima kasih!');
    }

}
