@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-white to-green-50 pt-28 pb-12 px-4 sm:px-6 lg:px-8" 
     x-data="{ 
        openEdit: {{ $errors->has('nama') || $errors->has('email') || $errors->has('tahun_masuk') || $errors->has('jurusan') || $errors->has('prodi') || $errors->has('tanggal_lahir') || $errors->has('alamat') || $errors->has('ldf') || $errors->has('foto') ? 'true' : 'false' }}, 
        openPassword: {{ $errors->has('current_password') || $errors->has('password') ? 'true' : 'false' }} 
     }">
    
    @if(session('success'))
    <div x-data="{ show: true }" 
         x-show="show" 
         x-init="setTimeout(() => show = false, 4000)"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-[-20px]"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-[-20px]"
         class="fixed top-24 right-4 sm:right-8 z-[70] bg-white border-l-4 border-green-500 text-green-700 p-4 rounded-xl shadow-2xl flex items-center max-w-sm w-full">
        
        <div class="flex-shrink-0 bg-green-100 p-2 rounded-full mr-3">
            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
        </div>
        <span class="font-bold flex-1">{{ session('success') }}</span>
        <button @click="show = false" class="text-gray-400 hover:text-red-500 transition ml-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>
    @endif

    <div class="max-w-4xl mx-auto space-y-6 relative z-10">

        <div class="bg-white shadow-2xl shadow-green-100/50 rounded-[2rem] overflow-hidden border border-green-50 animate-fade-in-slow">
            <div class="bg-gradient-to-r from-green-600 via-green-700 to-amber-500 h-32 md:h-44 relative">
                <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/islamic-art.png')]"></div>
            </div>
            
            <div class="px-6 md:px-10 pb-10">
                <div class="relative flex flex-col md:flex-row justify-between items-center md:items-end -mt-16 md:-mt-20 mb-8 gap-6">
                    <div class="flex flex-col md:flex-row items-center md:items-end gap-4 md:gap-6 text-center md:text-left">
                        <div class="relative group">
                            <img src="{{ $user->foto ? asset('storage/' . $user->foto) : asset('images/default-avatar.png') }}" 
                                 class="h-32 w-32 md:h-40 md:w-40 rounded-[2rem] border-4 border-white object-cover shadow-xl bg-white group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute -bottom-2 -right-2 bg-amber-500 text-white p-2 rounded-lg shadow-lg">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            </div>
                        </div>
                        <div class="pb-2">
                            <h1 class="text-2xl md:text-3xl font-serif font-extrabold text-green-900">{{ $user->nama }}</h1>
                            <p class="text-amber-600 font-bold tracking-wider text-sm md:text-base uppercase">{{ $user->npm }} • {{ $user->ldf ?? 'Anggota Umum' }}</p>
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap justify-center gap-3 w-full md:w-auto">
                        <button @click="openEdit = true" class="flex-1 md:flex-none px-6 py-3 bg-green-600 text-white font-bold rounded-xl shadow-lg shadow-green-200 hover:bg-green-700 transition-all transform hover:-translate-y-1">
                            Edit Profil
                        </button>
                        <button @click="openPassword = true" class="flex-1 md:flex-none px-6 py-3 bg-white border-2 border-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition-all transform hover:-translate-y-1">
                            Ganti Password
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-8 border-t border-green-50">
                    <div class="space-y-5 bg-green-50/50 p-6 rounded-2xl">
                        <h3 class="text-lg font-bold text-green-800 flex items-center">
                            <span class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3 text-green-600">🎓</span>
                            Informasi Akademik
                        </h3>
                        <div class="space-y-3">
                            <div class="flex justify-between border-b border-white pb-2"><span class="text-gray-500 text-sm">Tahun Masuk</span><span class="font-bold text-gray-800">{{ $user->tahun_masuk ?? '-' }}</span></div>
                            <div class="flex justify-between border-b border-white pb-2"><span class="text-gray-500 text-sm">Jurusan</span><span class="font-bold text-gray-800">{{ $user->jurusan ?? '-' }}</span></div>
                            <div class="flex justify-between border-b border-white pb-2"><span class="text-gray-500 text-sm">Program Studi</span><span class="font-bold text-gray-800">{{ $user->prodi ?? '-' }}</span></div>
                            <div class="flex justify-between"><span class="text-gray-500 text-sm">LDF</span><span class="font-bold text-green-600 uppercase">{{ $user->ldf ?? 'Umum' }}</span></div>
                        </div>
                    </div>

                    <div class="space-y-5 bg-amber-50/30 p-6 rounded-2xl">
                        <h3 class="text-lg font-bold text-amber-800 flex items-center">
                            <span class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center mr-3 text-amber-600">👤</span>
                            Informasi Pribadi
                        </h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between border-b border-white pb-2"><span class="text-gray-500">Gender</span><span class="font-bold text-gray-800">{{ $user->genre ?? '-' }}</span></div>
                            <div class="flex justify-between border-b border-white pb-2"><span class="text-gray-500">Tanggal Lahir</span><span class="font-bold text-gray-800">{{ $user->tanggal_lahir ? \Carbon\Carbon::parse($user->tanggal_lahir)->format('d M Y') : '-' }}</span></div>
                            <div class="flex justify-between border-b border-white pb-2"><span class="text-gray-500">Email</span><span class="font-bold text-gray-800">{{ $user->email }}</span></div>
                            <div class="flex flex-col gap-1">
                                <span class="text-gray-500 italic">Alamat Lengkap:</span>
                                <span class="font-medium text-gray-800 leading-relaxed">{{ $user->alamat ?? 'Belum melengkapi alamat' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div x-show="openEdit" style="display: none;" class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-green-900/40 backdrop-blur-sm" x-transition.opacity>
        <div @click.away="openEdit = false" class="bg-white w-full max-w-2xl rounded-[2rem] shadow-2xl overflow-hidden animate-fade-in-slow">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                <h3 class="text-xl font-bold text-green-800">Perbarui Data Pribadi</h3>
                <button type="button" @click="openEdit = false" class="p-2 hover:bg-red-50 rounded-full text-gray-400 hover:text-red-500 transition-colors">&times;</button>
            </div>
            
            <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8 space-y-5 overflow-y-auto max-h-[75vh]">
                @csrf @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Ganti Foto Profil</label>
                        <input type="file" name="foto" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:bg-green-100 file:text-green-700 hover:file:bg-green-200">
                        @error('foto') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama', $user->nama) }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 outline-none transition">
                        @error('nama') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 outline-none">
                        @error('email') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">LDF</label>
                        <select name="ldf" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 outline-none">
                             @foreach(['FKSI','FOSI','FIMADINA','GSI','IMC','WAMI','MGC','MOSTANEER','TIDAK ADA'] as $ldf)
                                <option value="{{ $ldf }}" {{ old('ldf', $user->ldf) == $ldf ? 'selected' : '' }}>{{ $ldf }}</option>
                            @endforeach
                        </select>
                        @error('ldf') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Tahun Masuk</label>
                        <input type="number" name="tahun_masuk" value="{{ old('tahun_masuk', $user->tahun_masuk) }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 outline-none">
                        @error('tahun_masuk') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Jurusan / Fakultas</label>
                        <input type="text" name="jurusan" value="{{ old('jurusan', $user->jurusan) }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 outline-none">
                        @error('jurusan') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Program Studi</label>
                        <input type="text" name="prodi" value="{{ old('prodi', $user->prodi) }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 outline-none">
                        @error('prodi') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-1">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 outline-none">
                        @error('tanggal_lahir') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-1">Alamat Domisili</label>
                        <textarea name="alamat" rows="2" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 outline-none">{{ old('alamat', $user->alamat) }}</textarea>
                        @error('alamat') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-6">
                    <button type="button" @click="openEdit = false" class="px-6 py-3 text-gray-500 font-bold">Batal</button>
                    <button type="submit" class="px-8 py-3 bg-green-600 text-white font-bold rounded-xl shadow-lg hover:bg-green-700 transition">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div x-show="openPassword" style="display: none;" class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm" x-transition.opacity>
        <div @click.away="openPassword = false" class="bg-white w-full max-w-md rounded-[2rem] shadow-2xl overflow-hidden">
            <div class="p-6 bg-gray-900 text-white flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-bold">Keamanan Akun</h3>
                    <p class="text-xs text-gray-400 mt-1">Pastikan Anda menggunakan kombinasi karakter yang kuat.</p>
                </div>
                <button type="button" @click="openPassword = false" class="text-gray-400 hover:text-white transition-colors">&times;</button>
            </div>
            <form action="{{ route('user.profile.update') }}" method="POST" class="p-6 space-y-4">
                @csrf @method('PUT')
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Password Saat Ini</label>
                    <input type="password" name="current_password" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-500 outline-none transition" placeholder="••••••••">
                    @error('current_password') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="h-[1px] bg-gray-100 my-2"></div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Password Baru</label>
                    <input type="password" name="password" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 outline-none transition" placeholder="Min. 8 Karakter">
                    @error('password') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 outline-none transition" placeholder="Ulangi Password Baru">
                </div>
                <button type="submit" class="w-full py-4 bg-green-600 text-white font-bold rounded-xl hover:bg-green-700 transition shadow-xl mt-4">
                    Perbarui Kata Sandi
                </button>
            </form>
        </div>
    </div>
</div>

<style>
@keyframes fade-in-slow {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in-slow {
  animation: fade-in-slow 0.8s ease-out both;
}
</style>
@endsection