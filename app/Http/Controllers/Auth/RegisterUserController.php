<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserAnggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class RegisterUserController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'npm' => 'required|string|max:20|unique:user_anggotas',
            'tahun_masuk' => 'required|digits:4|integer',
            'jurusan' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'ldf' => 'nullable|string|max:255',
            'genre' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:user_anggotas',
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->except(['password', 'foto']);
        $data['password'] = Hash::make($request->password);

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto_anggota', 'public');
        }

        UserAnggota::create($data);

        return redirect()->route('login.user')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
