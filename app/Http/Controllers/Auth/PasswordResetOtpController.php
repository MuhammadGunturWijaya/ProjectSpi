<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordOtp;
use App\Models\PasswordResetOtp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PasswordResetOtpController extends Controller
{
    // Tampilkan form request OTP
    public function showRequestForm()
    {
        return view('auth.passwords.request-otp');
    }

    // Kirim OTP ke email
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.exists' => 'Email tidak terdaftar dalam sistem'
        ]);

        $user = User::where('email', $request->email)->first();

        // Hapus OTP lama yang belum terpakai
        PasswordResetOtp::where('email', $request->email)
            ->where('is_used', false)
            ->delete();

        // Generate OTP 6 digit
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Simpan OTP ke database
        PasswordResetOtp::create([
            'email' => $request->email,
            'otp' => $otp,
            'expires_at' => now()->addMinutes(10), // Berlaku 10 menit
            'is_used' => false
        ]);

        // Kirim email
        try {
            Mail::to($request->email)->send(new ResetPasswordOtp($otp, $user->name ?? null));

            // Simpan email ke session agar tidak hilang
            session(['email' => $request->email]);

            return redirect()->route('password.verify-otp-form')
                ->with('success', 'Kode OTP telah dikirim ke email Anda. Silakan cek inbox atau folder spam.');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim email. Silakan coba lagi.');
        }

    }

    // Tampilkan form verifikasi OTP
    public function showVerifyForm()
    {
        if (!session('email')) {
            return redirect()->route('password.request-otp');
        }

        return view('auth.passwords.verify-otp');
    }

    // Verifikasi OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6'
        ], [
            'otp.required' => 'Kode OTP harus diisi',
            'otp.digits' => 'Kode OTP harus 6 digit'
        ]);

        $otpRecord = PasswordResetOtp::where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('is_used', false)
            ->first();

        if (!$otpRecord) {
            return back()->with('error', 'Kode OTP tidak valid.');
        }

        if ($otpRecord->isExpired()) {
            return back()->with('error', 'Kode OTP telah kadaluarsa. Silakan request kode baru.');
        }

        // Tandai OTP sudah digunakan
        $otpRecord->update(['is_used' => true]);

        // 🔥 SET SESSION PERSISTEN
        session([
            'email' => $request->email,
            'otp_verified' => true,
        ]);

        return redirect()->route('password.reset-form')
            ->with('success', 'Kode OTP valid. Silakan buat password baru Anda.');
    }


    // Tampilkan form reset password
    public function showResetForm()
    {
        if (!session('otp_verified')) {
            return redirect()->route('password.request-otp')
                ->with('error', 'Silakan verifikasi OTP terlebih dahulu.');
        }

        return view('auth.passwords.reset-password');
    }

    // Reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok'
        ]);

        if (!session('otp_verified')) {
            return redirect()->route('password.request-otp')
                ->with('error', 'Sesi telah berakhir. Silakan request OTP kembali.');
        }

        $user = User::where('email', $request->email)->first();
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        // Hapus semua session
        session()->forget(['email', 'otp_verified']);

        return redirect()->route('login')
            ->with('success', 'Password berhasil direset. Silakan login dengan password baru Anda.');
    }

    // Kirim ulang OTP
    public function resendOtp(Request $request)
    {
        $email = $request->email ?? session('email');

        if (!$email) {
            return back()->with('error', 'Email tidak ditemukan.');
        }

        $request->merge(['email' => $email]);
        return $this->sendOtp($request);
    }
}