<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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

        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'alt_email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'current_password' => 'nullable|required_with:password|string',
            'password' => 'nullable|min:6|confirmed',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan oleh pengguna lain.',
            'alt_email.email' => 'Format email alternatif tidak valid.',
            'phone.max' => 'Nomor telepon terlalu panjang.',
            'current_password.required_with' => 'Password lama wajib diisi jika ingin mengubah password.',
            'password.min' => 'Password baru minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // Jika user ingin ubah password
        if ($request->filled('password')) {
            // Validasi password lama harus diisi
            if (!$request->filled('current_password')) {
                return response()->json([
                    'success' => false,
                    'errors' => [
                        'current_password' => ['Password lama wajib diisi untuk mengubah password.']
                    ]
                ], 422);
            }

            // Cek apakah password lama cocok
            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'errors' => [
                        'current_password' => ['Password lama yang Anda masukkan salah.']
                    ]
                ], 422);
            }

            // Update password baru
            $user->password = Hash::make($request->password);
        }

        // Update profil dasar
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->alt_email = $validated['alt_email'];
        $user->phone = $validated['phone'];
        $user->address = $validated['address'];

        // Simpan perubahan
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diperbarui!'
        ], 200);
    }

    public function checkPendaftar(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $user = auth()->user();

        // Hanya admin yang bisa cek kode
        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses untuk memverifikasi kode.',
            ], 403);
        }

        $code = trim($request->input('code'));

        // Cari pendaftar berdasarkan kode
        $pendaftar = \App\Models\User::where('pegawai_code', $code)
            ->where('role', '!=', 'pendaftar') // Belum diverifikasi
            ->first();

        if (!$pendaftar) {
            return response()->json([
                'success' => false,
                'message' => 'Kode verifikasi tidak ditemukan atau sudah digunakan.',
            ], 404);
        }

        // Return data pendaftar untuk konfirmasi
        return response()->json([
            'success' => true,
            'data' => [
                'code' => $pendaftar->pegawai_code,
                'name' => $pendaftar->name,
                'email' => $pendaftar->email,
                'phone' => $pendaftar->phone,
                'address' => $pendaftar->address,
            ]
        ], 200);
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
            ], 403);
        }

        $code = trim($request->input('code'));

        // Cari pendaftar berdasarkan kode
        $pendaftar = \App\Models\User::where('pegawai_code', $code)->first();

        if (!$pendaftar) {
            return response()->json([
                'success' => false,
                'message' => 'Kode verifikasi tidak ditemukan.',
            ], 404);
        }

        // Cek apakah sudah diverifikasi
        if ($pendaftar->role === 'pendaftar') {
            return response()->json([
                'success' => false,
                'message' => 'Kode ini sudah diverifikasi sebelumnya.',
            ], 400);
        }

        // Update role/akses pendaftar
        $pendaftar->role = 'pendaftar';
        $pendaftar->save();

        return response()->json([
            'success' => true,
            'message' => 'Verifikasi berhasil! Akses pendaftar telah diaktifkan.',
        ], 200);
    }
}