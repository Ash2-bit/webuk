<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserAnggota;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ResetPasswordController extends Controller
{
    // 1. Tampilkan form input kode OTP
    public function showOtpForm()
    {
        // Jika tidak ada sesi email, kembalikan ke awal
        if (!Session::has('reset_email')) {
            return redirect()->route('password.request');
        }
        return view('auth.verify-otp');
    }

    // 2. Proses validasi kode OTP
    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|digits:6']);

        $email = Session::get('reset_email');
        $savedOtp = Session::get('reset_otp_' . $email);

        // Jika kode cocok
        if ($request->otp == $savedOtp) {
            // Beri tanda bahwa OTP sudah lolos validasi
            Session::put('otp_verified_' . $email, true);
            return redirect()->route('password.reset')->with('success', 'Kode verifikasi valid! Silakan buat password baru Anda.');
        }

        return back()->withErrors(['otp' => 'Kode verifikasi salah. Silakan periksa kembali email Anda.']);
    }

    // 3. Tampilkan form buat password baru
    public function showResetForm()
    {
        $email = Session::get('reset_email');

        // Pastikan user sudah melewati tahap input OTP
        if (!Session::get('otp_verified_' . $email)) {
            return redirect()->route('password.otp');
        }

        return view('auth.reset-password', compact('email'));
    }

    // 4. Proses simpan password ke database
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $email = Session::get('reset_email');

        // Keamanan ekstra: Pastikan emailnya tidak dimanipulasi
        if ($request->email !== $email || !Session::get('otp_verified_' . $email)) {
            return redirect()->route('password.request')->withErrors(['email' => 'Sesi Anda tidak valid atau telah berakhir.']);
        }

        // Simpan password baru
        $user = UserAnggota::where('email', $email)->first();
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        // Bersihkan semua session reset password agar tidak bisa diakses lagi
        Session::forget(['reset_email', 'reset_otp_' . $email, 'otp_verified_' . $email]);

        return redirect()->route('login.user')->with('success', 'Password Anda berhasil direset! Silakan login dengan password baru.');
    }
}