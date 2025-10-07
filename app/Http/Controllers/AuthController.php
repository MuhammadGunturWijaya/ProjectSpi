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
        // Validasi hanya email, password, konfirmasi password
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Simpan user baru, field lain boleh null
        $user = User::create([
            'name' => $request->name ?? null,
            'email' => $request->email,
            'alt_email' => $request->alt_email ?? null,
            'password' => Hash::make($request->password),
            'phone' => $request->phone ?? null,
            'address' => $request->address ?? null,
            'user_type' => $request->user_type ?? null,
            'pegawai_role' => $request->pegawai_role ?? null,
            'gender' => $request->gender ?? null,
            'disability' => $request->disability ?? null,
            'disability_type' => $request->disability_type ?? null,
            'email_verified_at' => null,
        ]);

        // Auto login setelah daftar (opsional)
        Auth::login($user);

        return redirect('/login')->with('success', 'Registrasi berhasil, silakan login!');
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
