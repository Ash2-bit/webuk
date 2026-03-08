<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\BlogComment;
use Barryvdh\DomPDF\Facade\Pdf; // Tambahan Facade PDF

class BlogsController extends Controller
{
    public function index()
    {
        $blogs = Blogs::with('comments')->latest()->get();
        return view('admin.blogs', compact('blogs'));
    }

    // Method Baru untuk Export PDF
    public function exportPdf()
    {
        $data = Blogs::latest()->get();
        $pdf = Pdf::loadView('admin.pdf.blogs', compact('data'));
        return $pdf->download('Data_Blogs.pdf');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'   => 'required|max:255',
            'konten'  => 'required',
            'penulis' => 'required|max:100',
            'gambar'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['slug'] = Str::slug($request->judul);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('blogs', 'public');
        }

        Blogs::create($validated);

        return back()->with('success', 'Blog berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $blogs = Blogs::findOrFail($id);

        $validated = $request->validate([
            'judul'   => 'required|max:255',
            'konten'  => 'required',
            'penulis' => 'required|max:100',
            'gambar'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['slug'] = Str::slug($request->judul);

        if ($request->hasFile('gambar')) {
            if ($blogs->gambar) {
                Storage::disk('public')->delete($blogs->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('blogs', 'public');
        }

        $blogs->update($validated);

        return back()->with('success', 'Blog berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $blog = Blogs::findOrFail($id);

        if ($blog->gambar) {
            Storage::disk('public')->delete($blog->gambar);
        }

        $blog->delete();
        return back()->with('success', 'Blog berhasil dihapus.');
    }

    public function frontendIndex(Request $request)
    {
        $query = Blogs::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('konten', 'like', "%{$search}%")
                  ->orWhere('penulis', 'like', "%{$search}%");
            });
        }

        if ($request->get('sort') == 'oldest') {
            $query->oldest();
        } else {
            $query->latest();
        }

        $blogs = $query->paginate(9)->withQueryString();

        return view('pages.blogs', compact('blogs'));
    }

    public function frontendDetail($slug)
    {
        $blog = Blogs::with('comments')->where('slug', $slug)->firstOrFail();
        return view('pages.blogdetail', compact('blog'));
    }

    public function storeComment(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'komentar' => 'required|string',
        ]);

        BlogComment::create([
            'blogs_id' => $id,
            'nama' => $request->nama,
            'email' => $request->email,
            'komentar' => $request->komentar,
        ]);

        return back()->with('success', 'Komentar Anda telah terkirim!');
    }

    public function destroyComment($id)
    {
        $comment = BlogComment::findOrFail($id);
        $comment->delete();

        return back()->with('success', 'Komentar berhasil dihapus.');
    }
}