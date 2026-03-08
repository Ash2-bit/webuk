<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginUserController extends Controller
{
    public function showLoginForm()
    {
        // Jika user sudah login → pindahkan ke halaman user home
        if (Auth::guard('anggota')->check()) {
            return redirect()->route('user.home');
        }

        return view('auth.loginusers'); 
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Gunakan guard anggota
        if (Auth::guard('anggota')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('user.home'); // ← user akan diarahkan ke halaman berbeda
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('anggota')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
