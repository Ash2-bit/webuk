@extends('layouts.auth')
@section('title', 'Register Anggota Organisasi')

@section('content')
<div class="w-full max-w-2xl my-8" x-data="{ loading: false, showPassword: false, showPasswordConfirm: false }">
    <div class="bg-white/90 backdrop-blur-xl border border-white/50 rounded-3xl shadow-2xl p-6 sm:p-10">
        
        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Pendaftaran Anggota</h2>
            <p class="text-sm text-gray-500 mt-2">Lengkapi data diri di bawah ini dengan benar</p>
        </div>

        <form @submit="loading = true" method="POST" action="{{ route('register.user') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                
                <div class="space-y-1.5">
                    <label for="nama" class="block text-sm font-semibold text-gray-700">Nama Lengkap</label>
                    <input id="nama" name="nama" type="text" required placeholder="Cth: Ajis Saputra" class="w-full px-4 py-2.5 bg-white/50 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all outline-none">
                </div>

                <div class="space-y-1.5">
                    <label for="npm" class="block text-sm font-semibold text-gray-700">NPM</label>
                    <input id="npm" name="npm" type="text" required placeholder="Nomor Pokok Mahasiswa" class="w-full px-4 py-2.5 bg-white/50 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all outline-none">
                </div>

                <div class="space-y-1.5">
                    <label for="email" class="block text-sm font-semibold text-gray-700">Email Aktif</label>
                    <input id="email" name="email" type="email" required placeholder="email@anda.com" class="w-full px-4 py-2.5 bg-white/50 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all outline-none">
                </div>

                <div class="space-y-1.5">
                    <label for="tahun_masuk" class="block text-sm font-semibold text-gray-700">Tahun Masuk</label>
                    <input id="tahun_masuk" name="tahun_masuk" type="number" required min="2000" max="{{ date('Y') }}" placeholder="Contoh: 2023" class="w-full px-4 py-2.5 bg-white/50 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all outline-none">
                </div>

                <div class="space-y-1.5">
                    <label for="jurusan" class="block text-sm font-semibold text-gray-700">Fakultas</label>
                    <input id="jurusan" name="jurusan" type="text" required placeholder="Nama Fakultas" class="w-full px-4 py-2.5 bg-white/50 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all outline-none">
                </div>

                <div class="space-y-1.5">
                    <label for="prodi" class="block text-sm font-semibold text-gray-700">Program Studi</label>
                    <input id="prodi" name="prodi" type="text" required placeholder="Program Studi" class="w-full px-4 py-2.5 bg-white/50 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all outline-none">
                </div>

                <div class="space-y-1.5">
                    <label for="ldf" class="block text-sm font-semibold text-gray-700">Lembaga Dakwah Fakultas</label>
                    <select id="ldf" name="ldf" class="w-full px-4 py-2.5 bg-white/50 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all outline-none">
                        <option value="" disabled selected>-- Pilih LDF --</option>
                        @foreach(['FKSI', 'FOSI', 'FIMADINA', 'GSI', 'IMC', 'WAMI', 'MGC', 'MOSTANEER', 'TIDAK ADA'] as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-1.5">
                    <label for="tanggal_lahir" class="block text-sm font-semibold text-gray-700">Tanggal Lahir</label>
                    <input id="tanggal_lahir" name="tanggal_lahir" type="date" required class="w-full px-4 py-2.5 bg-white/50 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all outline-none">
                </div>
            </div> <div class="space-y-2 bg-gray-50/50 p-4 rounded-xl border border-gray-100">
                <label class="block text-sm font-semibold text-gray-700">Jenis Kelamin</label>
                <div class="flex gap-8">
                    <label class="flex items-center cursor-pointer group">
                        <input type="radio" name="genre" value="Laki-laki" required class="w-4 h-4 text-green-600 focus:ring-green-500 border-gray-300">
                        <span class="ml-2 text-gray-700 group-hover:text-green-700 transition">Laki-laki</span>
                    </label>
                    <label class="flex items-center cursor-pointer group">
                        <input type="radio" name="genre" value="Perempuan" required class="w-4 h-4 text-green-600 focus:ring-green-500 border-gray-300">
                        <span class="ml-2 text-gray-700 group-hover:text-green-700 transition">Perempuan</span>
                    </label>
                </div>
            </div>

            <div class="space-y-1.5">
                <label for="alamat" class="block text-sm font-semibold text-gray-700">Alamat Lengkap</label>
                <textarea id="alamat" name="alamat" required rows="2" placeholder="Masukkan alamat domisili..." class="w-full px-4 py-2.5 bg-white/50 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all outline-none"></textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="relative space-y-1.5">
                    <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                    <div class="relative">
                        <input id="password" name="password" :type="showPassword ? 'text' : 'password'" required placeholder="Minimal 8 karakter" class="w-full px-4 py-2.5 bg-white/50 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all outline-none pr-12">
                        <button type="button" @click="showPassword = !showPassword" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-green-600">
                            <span x-text="showPassword ? 'Hide' : 'Show'" class="text-xs font-bold uppercase"></span>
                        </button>
                    </div>
                </div>

                <div class="relative space-y-1.5">
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">Konfirmasi Password</label>
                    <div class="relative">
                        <input id="password_confirmation" name="password_confirmation" :type="showPasswordConfirm ? 'text' : 'password'" required placeholder="Ulangi password" class="w-full px-4 py-2.5 bg-white/50 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all outline-none pr-12">
                        <button type="button" @click="showPasswordConfirm = !showPasswordConfirm" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-green-600">
                            <span x-text="showPasswordConfirm ? 'Hide' : 'Show'" class="text-xs font-bold uppercase"></span>
                        </button>
                    </div>
                </div>
            </div>

            <button type="submit" :disabled="loading" class="w-full py-4 mt-4 rounded-xl text-white font-bold bg-green-600 hover:bg-green-700 active:scale-[0.98] transition-all flex justify-center items-center shadow-lg shadow-green-600/30">
                <span x-show="!loading">Daftar Sekarang</span>
                <span x-show="loading" class="animate-pulse">Mendaftarkan Data...</span>
            </button>
        </form>

        <div class="mt-6 pt-6 border-t border-gray-100 flex flex-col sm:flex-row justify-center items-center gap-4 text-sm">
            <p class="text-gray-500">Sudah punya akun? <a href="{{ route('login.user') }}" class="font-bold text-green-600 hover:underline">Masuk</a></p>
            <span class="hidden sm:block text-gray-300">•</span>
            <a href="{{ route('login.admin') }}" class="font-medium text-gray-400 hover:text-gray-600">Portal Admin</a>
        </div>
    </div>
</div>
@endsection