<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RoleBidang;
use Illuminate\Support\Facades\Auth;

class UserListController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Hanya admin yang bisa akses
        if ($user->role !== 'admin') {
            return redirect()->route('profile.show')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Ambil semua role dari tabel role_bidang untuk filter
        $roles = RoleBidang::orderBy('nama_role', 'asc')->get();

        // Query dasar
        $query = User::query();

        // Filter berdasarkan kategori
        $category = $request->input('category', 'all');
        
        if ($category === 'with_code') {
            // User yang memiliki pegawai_code (termasuk role 'user')
            $query->whereNotNull('pegawai_code')
                  ->where('pegawai_code', '!=', '');
        } elseif ($category === 'without_code') {
            // User tanpa pegawai_code
            $query->where(function($q) {
                $q->whereNull('pegawai_code')
                  ->orWhere('pegawai_code', '');
            });
        }

        // Filter berdasarkan role
        if ($request->filled('role') && $request->role !== 'all') {
            $query->where('role', $request->role);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('pegawai_code', 'like', '%' . $search . '%');
            });
        }

        // Sorting
        $sortBy = $request->input('sort_by', 'created_at');
        $sortOrder = $request->input('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        // Pagination
        $users = $query->paginate(15)->withQueryString();

        // Statistik
        $stats = [
            'total' => User::count(),
            'with_code' => User::whereNotNull('pegawai_code')
                              ->where('pegawai_code', '!=', '')
                              ->count(),
            'without_code' => User::where(function($q) {
                                $q->whereNull('pegawai_code')
                                  ->orWhere('pegawai_code', '');
                            })->count(),
        ];

        return view('users.index', compact('users', 'roles', 'stats', 'category'));
    }

    public function destroy($id)
    {
        $user = Auth::user();

        // Hanya admin yang boleh hapus
        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses untuk menghapus user.',
            ], 403);
        }

        try {
            $targetUser = User::findOrFail($id);

            // Tidak boleh hapus diri sendiri
            if ($targetUser->id === $user->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak dapat menghapus akun Anda sendiri.',
                ], 400);
            }

            // Tidak boleh hapus admin lain (opsional)
            if ($targetUser->role === 'admin') {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak dapat menghapus akun admin lain.',
                ], 400);
            }

            $targetUser->delete();

            return response()->json([
                'success' => true,
                'message' => 'User berhasil dihapus.',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus user: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function edit($id)
    {
        $user = Auth::user();

        // Hanya admin yang bisa edit
        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses.',
            ], 403);
        }

        try {
            $targetUser = User::findOrFail($id);
            $roles = RoleBidang::orderBy('nama_role', 'asc')->get();

            return response()->json([
                'success' => true,
                'data' => $targetUser,
                'roles' => $roles
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan.',
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();

        // Hanya admin yang boleh update
        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses.',
            ], 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'role' => 'required|string|exists:role_bidang,nama_role',
            'alt_email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        try {
            $targetUser = User::findOrFail($id);

            $targetUser->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'role' => $validated['role'],
                'pegawai_role' => $validated['role'],
                'alt_email' => $validated['alt_email'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data user berhasil diperbarui.',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui data: ' . $e->getMessage(),
            ], 500);
        }
    }
}