<?php

namespace App\Http\Controllers;

use App\Models\UserAnggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Barryvdh\DomPDF\Facade\Pdf; // Tambahan Facade PDF

class UserAnggotaController extends Controller
{
    public function index()
    {
        $anggota = UserAnggota::orderBy('id', 'desc')->get();
        return view('admin.users', compact('anggota'));
    }

    // Method Baru untuk Export PDF
    public function exportPdf()
    {
        $data = UserAnggota::orderBy('id', 'desc')->get();
        $pdf = Pdf::loadView('admin.pdf.anggota', compact('data'));
        return $pdf->download('Data_Anggota.pdf');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'          => 'required|string|max:255',
            'npm'           => 'required|string|unique:user_anggotas,npm|max:50',
            'tahun_masuk'   => 'nullable|integer',
            'jurusan'       => 'nullable|string|max:100',
            'prodi'         => 'nullable|string|max:100',
            'ldf'           => 'nullable|string|max:100',
            'genre'         => 'nullable|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'nullable|date',
            'alamat'        => 'nullable|string|max:255',
            'email'         => 'required|email|unique:user_anggotas,email',
            'password'      => 'required|min:6',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'nama','npm','tahun_masuk','jurusan','prodi','ldf','genre','tanggal_lahir','alamat','email'
        ]);

        $data['password'] = Hash::make($request->password);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('anggota', 'public');
        }

        UserAnggota::create($data);

        return redirect()->route('admin.anggota.index')
            ->with('success', 'Anggota berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $anggota = UserAnggota::findOrFail($id);

        $request->validate([
            'nama'          => 'required|string|max:255',
            'npm'           => 'required|string|unique:user_anggotas,npm,' . $anggota->id . '|max:50',
            'tahun_masuk'   => 'nullable|integer',
            'jurusan'       => 'nullable|string|max:100',
            'prodi'         => 'nullable|string|max:100',
            'ldf'           => 'nullable|in:FKSI,FOSI,FIMADINA,GSI,IMC,WAMI,MGC,MOSTANEER,TIDAK ADA',
            'genre'         => 'nullable|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'nullable|date',
            'alamat'        => 'nullable|string|max:255',
            'email'         => 'required|email|unique:user_anggotas,email,' . $anggota->id,
            'password'      => 'nullable|min:6',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'nama','npm','tahun_masuk','jurusan','prodi','ldf','genre','tanggal_lahir','alamat','email'
        ]);

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('foto')) {
            if ($anggota->foto) Storage::disk('public')->delete($anggota->foto);
            $data['foto'] = $request->file('foto')->store('anggota', 'public');
        }

        $anggota->update($data);

        return redirect()->route('admin.anggota.index')
            ->with('success', 'Data anggota berhasil diperbarui');
    }

    public function destroy($id)
    {
        $anggota = UserAnggota::findOrFail($id);

        if ($anggota->foto) Storage::disk('public')->delete($anggota->foto);

        $anggota->delete();

        return redirect()->route('admin.anggota.index')
            ->with('success', 'Anggota berhasil dihapus');
    }

    public function editProfile()
    {
        $user = Auth::guard('anggota')->user();
        return view('user.akun', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::guard('anggota')->user();

        if ($request->filled('current_password') || $request->filled('password')) {
            $request->validate([
                'current_password' => 'required',
                'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
            ], [
                'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
            ]);

            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini yang Anda masukkan salah.'])->withInput();
            }

            $user->update([
                'password' => Hash::make($request->password)
            ]);

            return back()->with('success', 'Kata sandi Anda berhasil diperbarui!');
        }

        $request->validate([
            'nama'          => 'required|string|max:255',
            'email'         => 'required|email|unique:user_anggotas,email,' . $user->id,
            'ldf'           => 'nullable|string',
            'tahun_masuk'   => 'nullable|integer',
            'jurusan'       => 'nullable|string|max:100',
            'prodi'         => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'alamat'        => 'nullable|string',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['nama', 'email', 'tahun_masuk', 'jurusan', 'prodi', 'ldf', 'genre', 'tanggal_lahir', 'alamat']);

        if ($request->hasFile('foto')) {
            if ($user->foto) Storage::disk('public')->delete($user->foto);
            $data['foto'] = $request->file('foto')->store('anggota', 'public');
        }

        $user->update($data);

        return redirect()->back()->with('success', 'Profil dan Email berhasil diperbarui!');
    }
}