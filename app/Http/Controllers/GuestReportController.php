<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class GuestReportController extends Controller
{
    public function createGuest()
    {
        // Generate dummy data akun
        $dummyName = 'Tamu_' . Str::random(5);
        $dummyEmail = 'tamu_' . Str::random(5) . '@example.com';
        $dummyPassword = Str::random(8);

        // Buat user dummy
        $user = User::create([
            'name' => $dummyName,
            'email' => $dummyEmail,
            'password' => bcrypt($dummyPassword),
            'role' => 'guest', // pastikan role guest tersedia
        ]);

        // Login otomatis user dummy
        Auth::login($user);

        // Redirect ke form pengaduan
        return redirect()->route('pengaduan.create')->with('success', 'Akun sementara berhasil dibuat. Anda bisa mengganti password nanti.');
    }
}
