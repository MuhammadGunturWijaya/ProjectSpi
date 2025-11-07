<?php

namespace App\Http\Controllers;

use App\Models\RoleBidang;
use Illuminate\Http\Request;

class RoleBidangController extends Controller
{
    /**
     * Tampilkan daftar semua role bidang.
     */
    public function index()
    {
        // Ambil semua data role bidang
        $roleBidangs = RoleBidang::orderBy('id', 'asc')->get();

        // Kirim ke view
        return view('admin.roleBidang.index', compact('roleBidangs'));
    }

    /**
     * Simpan role baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_role' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'can_view_pengaduan' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['can_view_pengaduan'] = $request->has('can_view_pengaduan');

        RoleBidang::create($validated);

        return redirect()->back()->with('success', 'Role bidang berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $role = RoleBidang::findOrFail($id);

        $validated = $request->validate([
            'nama_role' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'can_view_pengaduan' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['can_view_pengaduan'] = $request->has('can_view_pengaduan');

        $role->update($validated);

        return redirect()->back()->with('success', 'Role bidang berhasil diperbarui!');
    }


    /**
     * Hapus role.
     */
    public function destroy($id)
    {
        $role = RoleBidang::findOrFail($id);
        $role->delete();

        return redirect()->back()->with('success', 'Role bidang berhasil dihapus!');
    }

    /**
     * Toggle status aktif/nonaktif.
     */
    public function toggleStatus($id)
    {
        $role = RoleBidang::findOrFail($id);
        $role->is_active = !$role->is_active;
        $role->save();

        return redirect()->back()->with('success', 'Status role berhasil diperbarui!');
    }

    public function create()
    {
        // Ambil semua role bidang yang aktif
        $roles = RoleBidang::where('is_active', true)
            ->orderBy('nama_role', 'asc')
            ->get();

        return view('auth.register', compact('roles'));
    }
}
