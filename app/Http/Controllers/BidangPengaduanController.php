<?php

namespace App\Http\Controllers;

use App\Models\BidangPengaduan;
use Illuminate\Http\Request;

class BidangPengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bidangs = BidangPengaduan::withCount('pengaduans')->latest()->get();
        return view('bidang.index', compact('bidangs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_bidang' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'role' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        BidangPengaduan::create($validated);

        return redirect()->back()->with('success', 'Bidang berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_bidang' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'role' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $bidang = BidangPengaduan::findOrFail($id);
        $bidang->update($validated);

        return redirect()->back()->with('success', 'Bidang berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BidangPengaduan $bidang)
    {
        // Cek apakah ada pengaduan yang menggunakan bidang ini
        if ($bidang->pengaduans()->count() > 0) {
            return redirect()->back()->with('error', 'Bidang tidak dapat dihapus karena masih digunakan oleh ' . $bidang->pengaduans()->count() . ' pengaduan!');
        }

        $bidang->delete();

        return redirect()->back()->with('success', 'Bidang pengaduan berhasil dihapus!');
    }

    /**
     * Toggle status aktif bidang
     */
    public function toggleStatus(BidangPengaduan $bidang)
    {
        $bidang->update(['is_active' => !$bidang->is_active]);

        $status = $bidang->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()->with('success', "Bidang berhasil {$status}!");
    }
}