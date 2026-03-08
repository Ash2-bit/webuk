<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Import facade Http

class QuranController extends Controller
{
    public function index()
    {
        // Mengambil daftar semua surat
        $response = Http::get('https://equran.id/api/v2/surat');

        if ($response->successful()) {
            $daftarSurat = $response->json()['data'];
            return view('pages.bacaan.quran.index', compact('daftarSurat'));
        }

        return back()->with('error', 'Gagal mengambil data dari API.');
    }

    public function show($nomor)
    {
        // Mengambil detail surat berdasarkan nomor
        $response = Http::get("https://equran.id/api/v2/surat/{$nomor}");

        if ($response->successful()) {
            $surat = $response->json()['data'];
            return view('pages.bacaan.quran.show', compact('surat'));
        }

        return abort(404);
    }
}