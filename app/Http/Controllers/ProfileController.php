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

        // Hanya admin yang boleh aktivasi
        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses untuk memverifikasi kode ini.',
            ], 403);
        }

        $code = trim($request->input('code'));
        $pendaftar = \App\Models\User::where('pegawai_code', $code)->first();

        // Jika kode tidak ditemukan
        if (!$pendaftar) {
            return response()->json([
                'success' => false,
                'message' => 'Kode pendaftar tidak ditemukan.',
            ], 404);
        }

        // Cek apakah pegawai_role memiliki pasangan di tabel role_bidang
        $roleBidang = \App\Models\RoleBidang::where('nama_role', 'LIKE', '%' . $pendaftar->pegawai_role . '%')->first();

        if (!$roleBidang) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal Aktivasi: Role bidang tidak ditemukan untuk pendaftar ini (' . $pendaftar->pegawai_role . ').',
            ], 400);
        }

        // Jika ditemukan, update role pendaftar
        $pendaftar->role = $roleBidang->nama_role;
        $pendaftar->save();

        return response()->json([
            'success' => true,
            'message' => 'Aktivasi berhasil! Role pendaftar sekarang: ' . $roleBidang->nama_role,
        ], 200);
    }

    public function showAddMember()
    {
        $user = Auth::user();

        // Hanya admin yang bisa akses
        if ($user->role !== 'admin') {
            return redirect()->route('profile.show')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Ambil semua role dari tabel role_bidang
        $roles = \App\Models\RoleBidang::orderBy('nama_role', 'asc')->get();

        return view('profile.add-member', compact('roles'));
    }

    public function storeMember(Request $request)
    {
        $user = Auth::user();

        // Hanya admin yang boleh menambah anggota
        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses untuk menambahkan anggota.',
            ], 403);
        }

        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|string|exists:role_bidang,nama_role',
            'alt_email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'role.required' => 'Role wajib dipilih.',
            'role.exists' => 'Role yang dipilih tidak valid.',
        ]);

        try {
            // Simpan password plain text untuk dikirim ke email (HANYA untuk email)
            $plainPassword = $validated['password'];

            // Generate pegawai_code otomatis
            $lastCode = \App\Models\User::where('pegawai_code', 'LIKE', 'PEG-%')
                ->orderBy('pegawai_code', 'desc')
                ->first();

            if ($lastCode) {
                $lastNumber = (int) substr($lastCode->pegawai_code, 4);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }

            $pegawaiCode = 'PEG-' . str_pad($newNumber, 6, '0', STR_PAD_LEFT);

            // Ambil data role_bidang untuk pegawai_role
            $roleBidang = \App\Models\RoleBidang::where('nama_role', $validated['role'])->first();

            // Buat user baru
            $newUser = \App\Models\User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => $validated['role'],
                'pegawai_role' => $roleBidang->nama_role,
                'pegawai_code' => $pegawaiCode,
                'alt_email' => $validated['alt_email'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
            ]);

            // Siapkan data untuk email
            $memberData = [
                'name' => $newUser->name,
                'email' => $newUser->email,
                'password' => $plainPassword, // Password asli (tidak di-hash)
                'pegawai_code' => $newUser->pegawai_code,
                'role' => $newUser->role,
                'login_url' => route('login') // Sesuaikan dengan route login Anda
            ];

            // Kirim email ke anggota baru
            try {
                \Mail::to($newUser->email)->send(new \App\Mail\NewMemberRegistered($memberData));
                $emailSent = true;
                $emailMessage = 'Email notifikasi telah dikirim ke ' . $newUser->email;
            } catch (\Exception $mailError) {
                $emailSent = false;
                $emailMessage = 'Gagal mengirim email: ' . $mailError->getMessage();
                \Log::error('Email sending failed: ' . $mailError->getMessage());
            }

            return response()->json([
                'success' => true,
                'message' => 'Anggota berhasil ditambahkan dengan kode: ' . $pegawaiCode,
                'email_sent' => $emailSent,
                'email_message' => $emailMessage,
                'data' => [
                    'name' => $newUser->name,
                    'email' => $newUser->email,
                    'code' => $newUser->pegawai_code,
                    'role' => $newUser->role,
                ]
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan anggota: ' . $e->getMessage(),
            ], 500);
        }
    }

}