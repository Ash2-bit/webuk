<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\Cabinet;
use App\Models\UserAnggota; // <-- Sudah diganti menggunakan UserAnggota
use App\Models\Materi;      // <-- PERHATIAN: Pastikan model ini juga sesuai dengan nama asli di project Anda

class LandingPageController extends Controller
{
    /**
     * Menampilkan halaman utama (Home / Landing Page)
     */
    public function index()
    {
        // Ambil 3 blog/berita terbaru untuk section blog preview
        $latestBlogs = Blogs::latest()->take(3)->get();

        // Hitung total data menggunakan model yang benar
        $totalAnggota = UserAnggota::count() ?? 0; // <-- Menggunakan UserAnggota
        $totalBlog = Blogs::count() ?? 0;
        $totalMateri = Materi::count() ?? 0;       // <-- Jika nama model materi berbeda, ganti 'Materi' dengan nama yang benar

        // Kirim semua data ke view pages.home
        return view('pages.home', compact('latestBlogs', 'totalAnggota', 'totalBlog', 'totalMateri'));
    }

    /**
     * Menampilkan halaman Struktur Kabinet
     */
    public function struktur($id = null)
    {
        // Ambil semua daftar kabinet untuk opsi di bagian bawah
        $allCabinets = Cabinet::orderBy('tahun', 'desc')->get();

        // Jika pengunjung mengklik kabinet tertentu (ada ID)
        if ($id) {
            $cabinet = Cabinet::with('departments')->findOrFail($id);
        } else {
            // Jika tidak ada ID, tampilkan yang sedang aktif, atau yang paling baru
            $cabinet = Cabinet::with('departments')->where('is_active', true)->first();
            
            if (!$cabinet) {
                $cabinet = Cabinet::with('departments')->orderBy('tahun', 'desc')->first();
            }
        }

        return view('pages.about.struktur', compact('cabinet', 'allCabinets'));
    }
}