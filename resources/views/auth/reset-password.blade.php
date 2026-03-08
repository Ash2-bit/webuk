@extends('layouts.auth')
@section('title', 'Buat Password Baru')

@section('content')
<div class="w-full max-w-md" x-data="{ loading: false, showPassword: false, showPasswordConfirm: false }">
    <div class="bg-white/80 backdrop-blur-xl border border-white/50 rounded-3xl shadow-2xl p-8 sm:p-10">
        
        <div class="text-center mb-6">
            <h2 class="text-2xl font-extrabold text-gray-900">Buat Password Baru</h2>
            <p class="text-sm text-gray-500 mt-1">Silakan amankan akun Anda dengan password baru.</p>
        </div>

        <form @submit="loading = true" method="POST" action="{{ route('password.update') }}" class="space-y-5">
            @csrf
            

            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                <input id="email" name="email" type="email" value="{{ $email ?? old('email') }}" required readonly class="w-full px-4 py-3 bg-gray-100 rounded-xl border border-gray-200 text-gray-500 cursor-not-allowed outline-none">
            </div>

            <div class="relative space-y-1.5">
                <label for="password" class="block text-sm font-semibold text-gray-700">Password Baru</label>
                <div class="relative">
                    <input id="password" name="password" :type="showPassword ? 'text' : 'password'" required placeholder="Minimal 8 karakter" class="w-full px-4 py-3 bg-white/50 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all outline-none pr-12">
                    <button type="button" @click="showPassword = !showPassword" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-green-600">
                        <span x-text="showPassword ? 'Hide' : 'Show'" class="text-xs font-bold uppercase"></span>
                    </button>
                </div>
            </div>

            <div class="relative space-y-1.5">
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">Konfirmasi Password Baru</label>
                <div class="relative">
                    <input id="password_confirmation" name="password_confirmation" :type="showPasswordConfirm ? 'text' : 'password'" required placeholder="Ulangi password" class="w-full px-4 py-3 bg-white/50 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all outline-none pr-12">
                    <button type="button" @click="showPasswordConfirm = !showPasswordConfirm" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-green-600">
                        <span x-text="showPasswordConfirm ? 'Hide' : 'Show'" class="text-xs font-bold uppercase"></span>
                    </button>
                </div>
            </div>

            <button type="submit" :disabled="loading" class="w-full py-3.5 mt-2 rounded-xl text-white font-bold bg-green-600 hover:bg-green-700 active:scale-[0.98] transition-all flex justify-center items-center shadow-lg shadow-green-600/30">
                <span x-show="!loading">Simpan Password</span>
                <span x-show="loading" class="animate-pulse">Memproses...</span>
            </button>
        </form>
    </div>
</div>
@endsection