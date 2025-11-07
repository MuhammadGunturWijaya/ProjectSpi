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
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role_bidang_id' => 'required|exists:role_bidang,id', // pastikan tabel benar
        ]);

        // Ambil data role bidang yang dipilih
        $roleBidang = \App\Models\RoleBidang::find($request->role_bidang_id);

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
            'pegawai_role' => $roleBidang->nama_role, // otomatis dari role_bidang
            'role_bidang_id' => $roleBidang->id,       // ✅ simpan id role bidang juga
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
