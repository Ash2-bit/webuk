<?php

namespace App\Http\Controllers;

use App\Models\Cabinet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CabinetController extends Controller
{
    public function index()
    {
        $cabinets = Cabinet::orderBy('tahun', 'desc')->get();
        return view('admin.cabinets.index', compact('cabinets'));
    }

    public function store(Request $request)
    {
        // 1. Validasi semua input
        $data = $request->validate([
            'nama_kabinet' => 'required',
            'tahun' => 'required',
            'deskripsi' => 'nullable',
            
            // Pengurus Inti & Keputrian
            'ketua' => 'required', 'npm_ketua' => 'required', 'prodi_ketua' => 'required',
            'keputrian' => 'required', 'npm_keputrian' => 'required', 'prodi_keputrian' => 'required',
            'sekretaris' => 'required', 'npm_sekretaris' => 'required', 'prodi_sekretaris' => 'required',
            'bendahara' => 'required', 'npm_bendahara' => 'required', 'prodi_bendahara' => 'required',
            
            // Foto
            'logo' => 'image|mimes:jpeg,png,jpg|max:2048|nullable',
            'foto_ketua' => 'image|mimes:jpeg,png,jpg|max:2048|nullable',
            'foto_keputrian' => 'image|mimes:jpeg,png,jpg|max:2048|nullable',
            'foto_sekretaris' => 'image|mimes:jpeg,png,jpg|max:2048|nullable',
            'foto_bendahara' => 'image|mimes:jpeg,png,jpg|max:2048|nullable',
        ]);

        // 2. Upload file jika ada
        if ($request->hasFile('logo')) $data['logo'] = $request->file('logo')->store('cabinets/logo', 'public');
        if ($request->hasFile('foto_ketua')) $data['foto_ketua'] = $request->file('foto_ketua')->store('cabinets/bph', 'public');
        if ($request->hasFile('foto_keputrian')) $data['foto_keputrian'] = $request->file('foto_keputrian')->store('cabinets/bph', 'public');
        if ($request->hasFile('foto_sekretaris')) $data['foto_sekretaris'] = $request->file('foto_sekretaris')->store('cabinets/bph', 'public');
        if ($request->hasFile('foto_bendahara')) $data['foto_bendahara'] = $request->file('foto_bendahara')->store('cabinets/bph', 'public');

        // 3. Simpan ke database
        Cabinet::create($data);
        return back()->with('success', 'Kabinet berhasil ditambahkan');
    }

    public function update(Request $request, Cabinet $cabinet)
    {
        $data = $request->validate([
            'nama_kabinet' => 'required',
            'tahun' => 'required',
            'deskripsi' => 'nullable',
            
            // Pengurus Inti & Keputrian (Sama seperti store)
            'ketua' => 'required', 'npm_ketua' => 'required', 'prodi_ketua' => 'required',
            'keputrian' => 'required', 'npm_keputrian' => 'required', 'prodi_keputrian' => 'required',
            'sekretaris' => 'required', 'npm_sekretaris' => 'required', 'prodi_sekretaris' => 'required',
            'bendahara' => 'required', 'npm_bendahara' => 'required', 'prodi_bendahara' => 'required',
            
            // Foto
            'logo' => 'image|mimes:jpeg,png,jpg|max:2048|nullable',
            'foto_ketua' => 'image|mimes:jpeg,png,jpg|max:2048|nullable',
            'foto_keputrian' => 'image|mimes:jpeg,png,jpg|max:2048|nullable',
            'foto_sekretaris' => 'image|mimes:jpeg,png,jpg|max:2048|nullable',
            'foto_bendahara' => 'image|mimes:jpeg,png,jpg|max:2048|nullable',
        ]);

        // Hapus foto lama jika ada foto baru yang diunggah
        if ($request->hasFile('logo')) {
            if ($cabinet->logo) Storage::disk('public')->delete($cabinet->logo);
            $data['logo'] = $request->file('logo')->store('cabinets/logo', 'public');
        }
        if ($request->hasFile('foto_ketua')) {
            if ($cabinet->foto_ketua) Storage::disk('public')->delete($cabinet->foto_ketua);
            $data['foto_ketua'] = $request->file('foto_ketua')->store('cabinets/bph', 'public');
        }
        if ($request->hasFile('foto_keputrian')) { // Tambahan: Delete & Upload foto keputrian
            if ($cabinet->foto_keputrian) Storage::disk('public')->delete($cabinet->foto_keputrian);
            $data['foto_keputrian'] = $request->file('foto_keputrian')->store('cabinets/bph', 'public');
        }
        if ($request->hasFile('foto_sekretaris')) {
            if ($cabinet->foto_sekretaris) Storage::disk('public')->delete($cabinet->foto_sekretaris);
            $data['foto_sekretaris'] = $request->file('foto_sekretaris')->store('cabinets/bph', 'public');
        }
        if ($request->hasFile('foto_bendahara')) {
            if ($cabinet->foto_bendahara) Storage::disk('public')->delete($cabinet->foto_bendahara);
            $data['foto_bendahara'] = $request->file('foto_bendahara')->store('cabinets/bph', 'public');
        }

        $cabinet->update($data);
        return back()->with('success', 'Data Kabinet berhasil diperbarui');
    }

    public function show(Cabinet $cabinet)
    {
        $cabinet->load('departments'); 
        return view('admin.cabinets.show', compact('cabinet'));
    }

    public function destroy(Cabinet $cabinet)
    {
        $cabinet->delete();
        return back()->with('success', 'Kabinet dihapus');
    }
}