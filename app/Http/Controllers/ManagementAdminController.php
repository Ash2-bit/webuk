<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User; // Model User yang berfungsi sebagai Admin
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ManagementAdminController extends Controller
{
    /**
     * Menampilkan daftar admin pada satu halaman utama.
     * Method ini memperbaiki error "Call to undefined method ManagementAdminController::index()".
     */
    public function index()
    {
        // Mengambil semua data admin untuk ditampilkan di tabel @foreach($admins)
        $admins = User::all(); 
        
        // Memanggil view index yang berada di folder resources/views/admin/manage/
        return view('admin.manage.index', compact('admins'));
    }

    /**
     * Simpan data admin baru dari Modal Tambah.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Password di-hash otomatis
        ]);

        // Redirect kembali ke halaman manajemen agar data terbaru langsung muncul
        return redirect()->route('admin.manage.index')->with('success', 'Admin baru berhasil ditambahkan!');
    }

    /**
     * Proses update password dari Modal Ubah Password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password:admin'], // Validasi guard admin
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        // Ambil user dari guard admin yang sedang login
        $admin = $request->user('admin');
        
        $admin->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $admin = User::findOrFail($id);

        // Mencegah admin menghapus dirinya sendiri agar tidak terkunci keluar
        if (auth('admin')->id() == $admin->id) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        $admin->delete();

        return back()->with('success', 'Akun admin berhasil dihapus.');
    }
}