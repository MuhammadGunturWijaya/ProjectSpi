<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // model user bawaan laravel
use Illuminate\Support\Facades\Hash;
use App\Models\RoleBidang;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login'); // file: resources/views/auth/login.blade.php
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Coba autentikasi
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            // Jika ada redirect (dari query string)
            if ($request->has('redirect')) {
                return redirect()->to($request->redirect)->with('success', 'Login berhasil!');
            }

            // Default: redirect intended (atau ke landing)
            return redirect()->intended('/landing')->with('success', 'Login berhasil!');
        }


        // Jika gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    // Menampilkan form register
    public function showRegisterForm()
    {
        // Ambil hanya Role Bidang aktif
        $roleBidangs = RoleBidang::where('is_active', true)->get();

        // Debug sementara
        // dd($roleBidangs);

        return view('auth.register', compact('roleBidangs'));
    }





    // Proses daftar akun
    // Proses daftar akun
    public function register(Request $request)
    {
        // Validasi dasar
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'user_type' => 'required|in:pegawai,whistleblower,masyarakat',
        ];

        // Tambahkan validasi role_bidang_id HANYA jika user_type adalah pegawai
        if ($request->user_type === 'pegawai') {
            $rules['role_bidang_id'] = 'required|exists:role_bidang,id';
        }

        $request->validate($rules);

        // Ambil data role bidang hanya untuk pegawai
        $roleBidang = null;
        $pegawaiRole = null;
        $roleBidangId = null;

        if ($request->user_type === 'pegawai' && $request->role_bidang_id) {
            $roleBidang = \App\Models\RoleBidang::find($request->role_bidang_id);
            $pegawaiRole = $roleBidang->nama_role;
            $roleBidangId = $roleBidang->id;
        }

        // Generate kode hanya untuk pegawai
        $pegawaiCode = $request->user_type === 'pegawai' ? rand(100000, 999999) : null;

        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'alt_email' => $request->alt_email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'user_type' => $request->user_type,
            'pegawai_role' => $pegawaiRole, // null untuk non-pegawai
            'role_bidang_id' => $roleBidangId, // null untuk non-pegawai
            'gender' => $request->gender,
            'disability' => $request->disability,
            'disability_type' => $request->disability_type,
            'pegawai_code' => $pegawaiCode,
        ]);

        return redirect('/login')
            ->with('success', 'Registrasi berhasil, silakan login!')
            ->with('pegawai_code', $pegawaiCode);
    }



    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('landing')->with('success', 'Anda sudah logout.');
    }
}
