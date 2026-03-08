@extends('layouts.admin')

@section('content')
<div class="p-6" x-data="{ modalTambah: false, modalPassword: false }">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Manajemen Admin</h2>
        <button @click="modalTambah = true" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            + Tambah Admin Baru
        </button>
    </div>

    {{-- Pesan Sukses/Gagal --}}
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($admins as $admin)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $admin->name }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $admin->email }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                        <div class="flex justify-center items-center space-x-4">
                            {{-- Tombol Ubah Password (Hanya untuk diri sendiri) --}}
                            @if(auth('admin')->id() == $admin->id)
                                <button @click="modalPassword = true" class="text-indigo-600 hover:text-indigo-900 font-medium">
                                    Ubah Password Saya
                                </button>
                            @else
                                {{-- Tombol Hapus (Hanya untuk akun admin lain) --}}
                                <form action="{{ route('admin.manage.destroy', $admin->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun admin ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 font-medium">
                                        Hapus Akun
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- MODAL TAMBAH ADMIN --}}
    <div x-show="modalTambah" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" x-cloak>
        <div class="bg-white rounded-lg w-full max-w-md p-6 shadow-xl" @click.away="modalTambah = false">
            <h3 class="text-xl font-bold mb-4">Tambah Admin Baru</h3>
            <form action="{{ route('admin.manage.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <input type="text" name="name" placeholder="Nama Lengkap" class="w-full border rounded-lg p-2" required>
                    <input type="email" name="email" placeholder="Email" class="w-full border rounded-lg p-2" required>
                    <input type="password" name="password" placeholder="Password" class="w-full border rounded-lg p-2" required>
                    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" class="w-full border rounded-lg p-2" required>
                </div>
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" @click="modalTambah = false" class="text-gray-500">Batal</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL UBAH PASSWORD --}}
    <div x-show="modalPassword" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" x-cloak>
        <div class="bg-white rounded-lg w-full max-w-md p-6 shadow-xl" @click.away="modalPassword = false">
            <h3 class="text-xl font-bold mb-4">Ubah Password Saya</h3>
            <form action="{{ route('admin.password.update') }}" method="POST">
                @csrf @method('PUT')
                <div class="space-y-4">
                    <input type="password" name="current_password" placeholder="Password Saat Ini" class="w-full border rounded-lg p-2" required>
                    <input type="password" name="password" placeholder="Password Baru" class="w-full border rounded-lg p-2" required>
                    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password Baru" class="w-full border rounded-lg p-2" required>
                </div>
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" @click="modalPassword = false" class="text-gray-500">Batal</button>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection