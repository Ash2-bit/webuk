<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserAnggota;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = UserAnggota::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Kami tidak dapat menemukan pengguna dengan alamat email tersebut.']);
        }

        // Generate 6 digit kode OTP acak
        $otp = rand(100000, 999999);

        // Simpan OTP dan Email ke dalam Session sementara
        Session::put('reset_otp_' . $request->email, $otp);
        Session::put('reset_email', $request->email);

        // Kirim Kode OTP via Email
        Mail::raw("Halo {$user->nama},\n\nKode verifikasi Anda untuk mengatur ulang kata sandi adalah:\n\n{$otp}\n\nMasukkan kode ini di halaman website. Jangan berikan kode ini kepada siapapun.", function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Kode Verifikasi Reset Password UKM Kerohanian');
        });

        // Alihkan ke halaman input kode
        return redirect()->route('password.otp')->with('success', 'Kode verifikasi telah dikirim ke email Anda.');
    }
}