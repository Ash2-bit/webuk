<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // Tambahan Facade PDF

class KeuanganController extends Controller
{
    public function index(Request $request)
    {
        $query = Keuangan::query();

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }

        $totalPemasukan = (clone $query)->where('jenis', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = (clone $query)->where('jenis', 'pengeluaran')->sum('jumlah');
        $saldoAkhir = $totalPemasukan - $totalPengeluaran;

        $data = $query->latest('tanggal')->paginate(10)->withQueryString();

        return view('admin.keuangan', compact(
            'data', 'totalPemasukan', 'totalPengeluaran', 'saldoAkhir'
        ));
    }

    // Method Baru untuk Export PDF
    public function exportPdf(Request $request)
    {
        $query = Keuangan::query();

        // Menerapkan filter yang sama untuk file Export PDF
        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }

        $data = $query->latest('tanggal')->get();
        
        $totalPemasukan = $data->where('jenis', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = $data->where('jenis', 'pengeluaran')->sum('jumlah');
        $saldoAkhir = $totalPemasukan - $totalPengeluaran;

        $pdf = Pdf::loadView('admin.pdf.keuangan', compact('data', 'totalPemasukan', 'totalPengeluaran', 'saldoAkhir'));
        return $pdf->download('Laporan_Keuangan.pdf');
    }

    public function store(Request $request)
    {
        $attr = $request->validate([
            'judul' => 'required|string|max:255',
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'jumlah' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string'
        ]);

        Keuangan::create($attr);
        return redirect()->back()->with('success', 'Data berhasil disimpan.');
    }

    public function update(Request $request, Keuangan $keuangan)
    {
        $attr = $request->validate([
            'judul' => 'required|string|max:255',
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'jumlah' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string'
        ]);

        $keuangan->update($attr);
        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(Keuangan $keuangan)
    {
        $keuangan->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}