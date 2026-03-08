<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DepartmentController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'cabinet_id' => 'required|exists:cabinets,id',
            'nama_bidang' => 'required',
            
            // Co Ikhwan & Akhwat dengan NPM dan Prodi
            'co_ikhwan' => 'required', 'npm_co_ikhwan' => 'required', 'prodi_co_ikhwan' => 'required',
            'co_akhwat' => 'required', 'npm_co_akhwat' => 'required', 'prodi_co_akhwat' => 'required',
            
            'deskripsi' => 'nullable',
            'anggota_aktif' => 'nullable',
            
            'foto_co_ikhwan' => 'image|mimes:jpeg,png,jpg|max:2048|nullable',
            'foto_co_akhwat' => 'image|mimes:jpeg,png,jpg|max:2048|nullable'
        ]);

        if ($request->hasFile('foto_co_ikhwan')) {
            $data['foto_co_ikhwan'] = $request->file('foto_co_ikhwan')->store('bidang/co', 'public');
        }
        if ($request->hasFile('foto_co_akhwat')) {
            $data['foto_co_akhwat'] = $request->file('foto_co_akhwat')->store('bidang/co', 'public');
        }

        Department::create($data);
        return back()->with('success', 'Bidang berhasil ditambahkan');
    }

    public function update(Request $request, Department $department)
    {
        $data = $request->validate([
            'nama_bidang' => 'required',
            
            // Co Ikhwan & Akhwat dengan NPM dan Prodi
            'co_ikhwan' => 'required', 'npm_co_ikhwan' => 'required', 'prodi_co_ikhwan' => 'required',
            'co_akhwat' => 'required', 'npm_co_akhwat' => 'required', 'prodi_co_akhwat' => 'required',
            
            'deskripsi' => 'nullable',
            'anggota_aktif' => 'nullable',
            
            'foto_co_ikhwan' => 'image|mimes:jpeg,png,jpg|max:2048|nullable',
            'foto_co_akhwat' => 'image|mimes:jpeg,png,jpg|max:2048|nullable'
        ]);

        // Hapus foto lama jika ada foto baru
        if ($request->hasFile('foto_co_ikhwan')) {
            if ($department->foto_co_ikhwan) Storage::disk('public')->delete($department->foto_co_ikhwan);
            $data['foto_co_ikhwan'] = $request->file('foto_co_ikhwan')->store('bidang/co', 'public');
        }
        if ($request->hasFile('foto_co_akhwat')) {
            if ($department->foto_co_akhwat) Storage::disk('public')->delete($department->foto_co_akhwat);
            $data['foto_co_akhwat'] = $request->file('foto_co_akhwat')->store('bidang/co', 'public');
        }

        $department->update($data);
        return back()->with('success', 'Bidang berhasil diupdate');
    }

    public function destroy(Department $department)
    {
        // Tambahkan hapus foto saat bidang dihapus agar storage tidak penuh
        if ($department->foto_co_ikhwan) Storage::disk('public')->delete($department->foto_co_ikhwan);
        if ($department->foto_co_akhwat) Storage::disk('public')->delete($department->foto_co_akhwat);

        $department->delete();
        return back()->with('success', 'Bidang dihapus');
    }
}