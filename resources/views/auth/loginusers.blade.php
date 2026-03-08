@extends('layouts.auth')
@section('title', 'Login Anggota Organisasi')

@section('content')
<div class="w-full max-w-md" x-data="{ loading: false, showPassword: false }">
    <div class="bg-white/80 backdrop-blur-xl border border-white/50 rounded-3xl shadow-2xl p-8 sm:p-10">
        
        <div class="text-center mb-8">
            <div class="mx-auto w-20 h-20 bg-gradient-to-tr from-green-50 to-green-100 rounded-2xl flex items-center justify-center mb-5 shadow-inner border border-green-50">
                <img src="{{ asset('logouk.png') }}" alt="Logo" class="w-16 h-16 rounded-full object-cover">
            </div>
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Selamat Datang</h2>
            <p class="text-sm text-gray-500 mt-2">Masuk ke akun anggota Anda</p>
        </div>

        <form @submit="loading = true" method="POST" action="{{ route('login.user') }}" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                <input
                    id="email" name="email" type="email" required autofocus
                    placeholder="nama@email.com"
                    class="w-full px-4 py-3 bg-white/50 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all outline-none"
                >
            </div>

            <div class="relative">
                <div class="flex justify-between items-center mb-1.5">
                    <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                    <a href="{{ route('password.request') }}" class="text-sm font-medium text-green-600 hover:text-green-700 hover:underline transition-colors">
                        Lupa Password?
                    </a>
                </div>
                <div class="relative">
                    <input
                        id="password" name="password" :type="showPassword ? 'text' : 'password'" required
                        placeholder="••••••••"
                        class="w-full px-4 py-3 bg-white/50 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all outline-none pr-12"
                    >
                    <button type="button" @click="showPassword = !showPassword" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-green-600 transition-colors">
                        <span x-text="showPassword ? 'Sembunyi' : 'Lihat'" class="text-xs font-bold uppercase tracking-wide"></span>
                    </button>
                </div>
            </div>

            <button
                type="submit" :disabled="loading"
                class="w-full mt-2 py-3.5 rounded-xl text-white font-bold bg-green-600 hover:bg-green-700 active:scale-[0.98] transition-all flex justify-center items-center gap-2 shadow-lg shadow-green-600/30 disabled:opacity-70"
            >
                <span x-show="!loading">Masuk Sekarang</span>
                <span x-show="loading" class="animate-pulse flex items-center gap-2">
                    <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path></svg>
                    Memproses...
                </span>
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-gray-100 space-y-4 text-center">
            <p class="text-sm text-gray-600">
                Belum punya akun? 
                <a href="{{ route('register.user') }}" class="font-bold text-green-600 hover:text-green-700 hover:underline">Daftar sekarang</a>
            </p>
            <a href="{{ route('login.admin') }}" class="inline-block text-sm font-medium text-gray-400 hover:text-gray-700 transition-colors">
                &rarr; Masuk sebagai Admin
            </a>
        </div>
    </div>
</div>
@endsection