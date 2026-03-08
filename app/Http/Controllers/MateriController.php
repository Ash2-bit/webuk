<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf; // Tambahan Facade PDF

class MateriController extends Controller
{
    public function index(Request $request)
    {
        $query = Materi::query();

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        }

        $data = $query->latest()->paginate(10);

        return view('admin.materi', compact('data'));
    }

    // Method Baru untuk Export PDF
    public function exportPdf()
    {
        $data = Materi::latest()->get();
        $pdf = Pdf::loadView('admin.pdf.materi', compact('data'));
        return $pdf->download('Data_Materi.pdf');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tautan' => 'required|url',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $imagePath = $request->file('gambar')->store('materi_images', 'public');

        Materi::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tautan' => $request->tautan,
            'gambar' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Materi berhasil ditambahkan!');
    }

    public function update(Request $request, Materi $materi)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tautan' => 'required|url',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tautan' => $request->tautan,
        ];

        if ($request->hasFile('gambar')) {
            if (Storage::disk('public')->exists($materi->gambar)) {
                Storage::disk('public')->delete($materi->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('materi_images', 'public');
        }

        $materi->update($data);

        return redirect()->back()->with('success', 'Materi berhasil diperbarui!');
    }

    public function destroy(Materi $materi)
    {
        if (Storage::disk('public')->exists($materi->gambar)) {
            Storage::disk('public')->delete($materi->gambar);
        }
        
        $materi->delete();

        return redirect()->back()->with('success', 'Materi berhasil dihapus!');
    }
}