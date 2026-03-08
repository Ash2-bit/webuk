<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AsmaulHusnaController extends Controller
{
    public function asmaulHusna()
    {
        // Menggunakan API publik gratis untuk Asmaul Husna
        $response = Http::get('https://islamic-api-zhirrr.vercel.app/api/asmaulhusna');
        $data = $response->json()['data'] ?? [];

        return view('pages.bacaan.asmaul-husna', compact('data'));
    }
}
