<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // pendaftar disimpan di users
use Carbon\Carbon;

class PendaftarController extends Controller
{
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

        // Jika belum terverifikasi
        if (!$user->email_verified_at) {
            $user->email_verified_at = Carbon::now();
        }

        // Update role sesuai pegawai_role
        $user->role = $user->pegawai_role;
        $user->save();

        return response()->json([
            'success' => true,
            'email_verified' => (bool) $user->email_verified_at,
            'new_role' => $user->role
        ]);
    }
}
