<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    /**
     * [ADMIN] Menampilkan daftar pesan di Dashboard
     */
    public function index()
    {
        // Ambil data terbaru, paginasi 10 per halaman
        $messages = Pesan::latest()->paginate(10);
        
        // Hitung pesan baru untuk statistik (opsional)
        $countBaru = Pesan::where('status', 'Baru')->count();

        return view('admin.pesan.index', compact('messages', 'countBaru'));
    }

    /**
     * [GUEST] Menyimpan pesan dari Form Hubungi Kami
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'pesan' => 'required|string',
        ]);

        // Simpan ke database
        Pesan::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'pesan' => $request->pesan,
            'status' => 'Baru', // Default status
        ]);

        // Redirect kembali dengan pesan sukses
        return back()->with('success', 'Terima kasih! Pesan Anda telah terkirim.');
    }

    /**
     * [ADMIN] Menandai pesan sudah dibaca (Opsional, pakai AJAX atau button)
     */
    public function markAsRead($id)
    {
        $pesan = Pesan::findOrFail($id);
        $pesan->update(['status' => 'Dibaca']);

        return back()->with('success', 'Status pesan diperbarui.');
    }

    /**
     * [ADMIN] Menghapus pesan
     */
    public function destroy($id)
    {
        $pesan = Pesan::findOrFail($id);
        $pesan->delete();

        return back()->with('success', 'Pesan berhasil dihapus.');
    }
}