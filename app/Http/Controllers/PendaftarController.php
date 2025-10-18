<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class PendaftarController extends Controller
{
    public function check(Request $request)
    {
        $request->validate([
            'code' => 'required|string'
        ]);

        $user = User::where('pegawai_code', $request->code)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Kode pendaftar tidak ditemukan.'
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'code' => $user->pegawai_code,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'address' => $user->address,
                'role' => $user->role,
                'verified' => (bool) $user->email_verified_at,
                'created_at' => $user->created_at->format('d-m-Y H:i')
            ]
        ]);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|string'
        ]);

        $user = User::where('pegawai_code', $request->code)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Kode verifikasi tidak ditemukan.'
            ]);
        }

        if (!$user->email_verified_at) {
            $user->email_verified_at = Carbon::now();
        }

        $user->role = $user->pegawai_role;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Verifikasi berhasil! Akun telah diaktifkan.',
            'new_role' => $user->role
        ]);
    }
}
