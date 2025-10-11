<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'alt_email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->alt_email = $request->alt_email;
        $user->phone = $request->phone;
        $user->address = $request->address;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json([
            'success' => 'Profil berhasil diperbarui!'
        ]);
    }

    public function verifyPendaftar(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $user = auth()->user();

        // Hanya admin bisa verifikasi
        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses untuk memverifikasi kode.',
            ]);
        }

        $code = trim($request->input('code'));

        // Cari pendaftar berdasarkan kode
        $pendaftar = \App\Models\User::where('pegawai_code', $code)->first();

        if (!$pendaftar) {
            return response()->json([
                'success' => false,
                'message' => 'Kode verifikasi tidak ditemukan atau sudah digunakan.',
            ]);
        }

        // Update role/akses pendaftar
        $pendaftar->role = 'pendaftar';
        $pendaftar->save();

        return response()->json([
            'success' => true,
            'message' => 'Verifikasi berhasil! Akses pendaftar telah diaktifkan.',
        ]);
    }


}
