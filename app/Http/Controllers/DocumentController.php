<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf; // Tambahan Facade PDF

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::latest()->get();
        return view('admin.dokumen', compact('documents'));
    }

    // Method Baru untuk Export PDF
    public function exportPdf()
    {
        $data = Document::latest()->get();
        $pdf = Pdf::loadView('admin.pdf.dokumen', compact('data'));
        return $pdf->download('Data_Dokumen.pdf');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_dokumen' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'file_path' => 'required|file',
        ]);

        $file = $request->file('file_path')->store('documents');

        Document::create([
            'nama_dokumen' => $request->nama_dokumen,
            'kategori' => $request->kategori,
            'tanggal_upload' => now(),
            'file_path' => $file
        ]);

        return redirect()->back()->with('success', 'Dokumen berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $document = Document::findOrFail($id);

        $request->validate([
            'nama_dokumen' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'file_path' => 'nullable|file',
        ]);

        if ($request->hasFile('file_path')) {
            Storage::delete($document->file_path);
            $file = $request->file('file_path')->store('documents');
            $document->file_path = $file;
        }

        $document->nama_dokumen = $request->nama_dokumen;
        $document->kategori = $request->kategori;
        $document->save();

        return redirect()->back()->with('success', 'Dokumen berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $document = Document::findOrFail($id);
        Storage::delete($document->file_path);
        $document->delete();

        return redirect()->back()->with('success', 'Dokumen berhasil dihapus.');
    }
}