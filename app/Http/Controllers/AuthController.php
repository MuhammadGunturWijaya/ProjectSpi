<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // model user bawaan laravel
use Illuminate\Support\Facades\Hash;

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
        return view('auth.register'); // file: resources/views/auth/register.blade.php
    }

    // Proses daftar akun
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Generate kode hanya untuk pegawai
        $pegawaiCode = null;
        if ($request->user_type === 'pegawai') {
            $pegawaiCode = rand(100000, 999999); // kode 6 digit
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'alt_email' => $request->alt_email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'user_type' => $request->user_type,
            'pegawai_role' => $request->pegawai_role,
            'gender' => $request->gender,
            'disability' => $request->disability,
            'disability_type' => $request->disability_type,
            'pegawai_code' => $pegawaiCode,
        ]);

        // redirect ke login + kirim kode ke session
        return redirect('/login')->with('success', 'Registrasi berhasil, silakan login!')
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
