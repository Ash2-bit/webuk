<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf; // Tambahan Facade PDF

class InventarisController extends Controller
{
    public function index()
    {
        $inventaris = Inventaris::latest()->get();
        return view('admin.inventaris', compact('inventaris'));
    }

    // Method Baru untuk Export PDF
    public function exportPdf()
    {
        $data = Inventaris::latest()->get();
        $pdf = Pdf::loadView('admin.pdf.inventaris', compact('data'));
        return $pdf->download('Data_Inventaris.pdf');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'kondisi' => 'nullable|string|max:255',
            'tanggal_masuk' => 'nullable|date',
            'lokasi' => 'nullable|string|max:255',
            'status_peminjaman' => 'required|in:boleh,tidak_boleh',
            'ketersediaan' => 'required|in:ada,tidak_ada,tidak_dapat_dipinjam',
            'link_sop' => 'nullable|url|max:255', // Ubah validasi menjadi URL
            'foto_barang' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        if ($request->hasFile('foto_barang')) {
            $validated['foto_barang'] = $request->foto_barang->store('foto_barang', 'public');
        }

        $inventaris = Inventaris::create($validated);

        $qrFile = "qr_codes/qr-{$inventaris->id}.svg";
        Storage::disk('public')->makeDirectory('qr_codes');
        Storage::disk('public')->put(
            $qrFile,
            QrCode::format('svg')
                ->size(300)
                ->generate(url("/scan/{$inventaris->id}"))
        );

        $inventaris->update(['qr_code' => $qrFile]);

        return back()->with('success', 'Data berhasil ditambahkan!');
    }


 public function update(Request $request, $id)
    {
        $inventaris = Inventaris::findOrFail($id);

        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'kondisi' => 'nullable|string|max:255',
            'tanggal_masuk' => 'nullable|date',
            'lokasi' => 'nullable|string|max:255',
            'status_peminjaman' => 'required|in:boleh,tidak_boleh',
            'ketersediaan' => 'required|in:ada,tidak_ada,tidak_dapat_dipinjam',
            'link_sop' => 'nullable|url|max:255', // Ubah validasi menjadi URL
            'foto_barang' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        if ($request->hasFile('foto_barang')) {
            if ($inventaris->foto_barang) {
                Storage::disk('public')->delete($inventaris->foto_barang);
            }
            $validated['foto_barang'] = $request->foto_barang->store('foto_barang', 'public');
        }

        $inventaris->update($validated);

        return back()->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $inventaris = Inventaris::findOrFail($id);

        Storage::disk('public')->delete($inventaris->foto_barang);
        Storage::disk('public')->delete($inventaris->qr_code);

        $inventaris->delete();

        return back()->with('success', 'Data berhasil dihapus!');
    }

    public function downloadPDF($id)
    {
        $inventaris = Inventaris::findOrFail($id);

        if (!$inventaris->sop_pdf || !Storage::disk('public')->exists($inventaris->sop_pdf)) {
            return back()->with('error', 'File SOP tidak ditemukan!');
        }

        return response()->download(storage_path("app/public/" . $inventaris->sop_pdf));
    }

    public function userIndex()
    {
        $inventaris = Inventaris::where('ketersediaan', 'ada')
            ->orderBy('nama_barang')
            ->paginate(6);

        return view('user.inventaris', compact('inventaris'));
    }

    public function userShow($id)
    {
        $item = Inventaris::findOrFail($id);
        return view('user.inventaris-detail', compact('item'));
    }
}