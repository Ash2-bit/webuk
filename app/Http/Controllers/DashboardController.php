<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesan;
use App\Models\UserAnggota;
use App\Models\Keuangan;
use App\Models\Document;
use App\Models\Inventaris;


class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil Data Dasar
        $messages = Pesan::latest()->paginate(5); 
        $totalAnggota = UserAnggota::count();
        $totalDokumen = Document::count();
        $totalInventaris = Inventaris::count();
        
        $totalPemasukan = Keuangan::where('jenis', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = Keuangan::where('jenis', 'pengeluaran')->sum('jumlah');
        $saldoAkhir = $totalPemasukan - $totalPengeluaran;

        // Data untuk Chart Donut (LDF)
        $dataLDF = UserAnggota::selectRaw('ldf, count(*) as total')
            ->groupBy('ldf')
            ->get();

        // 2. Data Pendaftaran BULANAN (Tahun Berjalan)
        $pendaftaranPerBulan = UserAnggota::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get()
            ->pluck('total', 'bulan')
            ->toArray();

        $chartBulanan = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartBulanan[] = $pendaftaranPerBulan[$i] ?? 0;
        }

        // 3. Data Pendaftaran TAHUNAN (5 Tahun Terakhir)
        $tahunSekarang = date('Y');
        $pendaftaranPerTahun = UserAnggota::selectRaw('YEAR(created_at) as tahun, COUNT(*) as total')
            ->where('created_at', '>=', $tahunSekarang - 4)
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->get()
            ->pluck('total', 'tahun')
            ->toArray();

        $chartTahunanData = [];
        $chartTahunanLabels = [];
        for ($i = $tahunSekarang - 4; $i <= $tahunSekarang; $i++) {
            $chartTahunanLabels[] = (string)$i;
            $chartTahunanData[] = $pendaftaranPerTahun[$i] ?? 0;
        }

        // 4. Susun Card Statistik
        $stats = [
            ['title' => 'Total Anggota', 'value' => number_format($totalAnggota), 'emoji' => '👥', 'color' => 'from-green-600 via-emerald-500 to-teal-400'],
            ['title' => 'Data Inventaris', 'value' => number_format($totalInventaris), 'emoji' => '📦', 'color' => 'from-blue-600 via-indigo-500 to-sky-400'],
            ['title' => 'Saldo Organisasi', 'value' => 'Rp ' . number_format($saldoAkhir, 0, ',', '.'), 'emoji' => '💰', 'color' => 'from-amber-600 via-yellow-500 to-orange-400'],
            ['title' => 'Arsip Dokumen', 'value' => number_format($totalDokumen), 'emoji' => '🗂️', 'color' => 'from-pink-600 via-rose-500 to-red-400'],
        ];

        return view('admin.dashboard', compact(
            'messages', 'stats', 'dataLDF', 
            'chartBulanan', 'chartTahunanData', 'chartTahunanLabels'
        ));
    }
}