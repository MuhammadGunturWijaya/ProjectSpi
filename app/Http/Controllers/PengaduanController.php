<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;

class PengaduanController extends Controller
{
    // Form pengaduan masyarakat
    public function create()
    {
        return view('pengaduan.create');
    }

    // Menyimpan pengaduan
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

        Pengaduan::create($validated);

        return redirect()->back()->with('success', 'Pengaduan berhasil dikirim. Terima kasih!');
    }

    // Menampilkan daftar pengaduan (untuk admin)
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $pengaduans = Pengaduan::latest()->get();
        return view('admin.pengaduanIndex', compact('pengaduans'));
    }

    // Menampilkan detail pengaduan (untuk admin)
    public function show($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $pengaduan = Pengaduan::findOrFail($id);
        return view('admin.pengaduanShow', compact('pengaduan'));
    }

    public function destroy($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $pengaduan = \App\Models\Pengaduan::findOrFail($id);

        // Hapus file bukti jika ada
        if ($pengaduan->bukti_foto) {
            \Storage::disk('public')->delete($pengaduan->bukti_foto);
        }

        $pengaduan->delete();

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dihapus.');
    }

}
