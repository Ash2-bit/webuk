@extends('layouts.auth')
@section('title', 'Login Admin Organisasi')

@section('content')
<div class="w-full max-w-md" x-data="{ loading: false, showPassword: false }">
    <div class="bg-white/90 backdrop-blur-xl border border-gray-100 rounded-3xl shadow-xl p-8 sm:p-10 relative overflow-hidden">
        
        <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-green-400 to-emerald-600"></div>

        <div class="text-center mb-8 mt-2">
            <h2 class="text-2xl font-extrabold text-gray-800 tracking-tight">Portal Admin</h2>
            <p class="text-sm text-gray-500 mt-1">Gunakan kredensial admin Anda</p>
        </div>

        <form @submit="loading = true" method="POST" action="{{ route('login.admin.submit') }}" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Email Admin</label>
                <input
                    id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                    placeholder="admin@organisasi.com"
                    class="w-full px-4 py-3 bg-gray-50/50 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all outline-none"
                >
                @error('email') <p class="text-sm text-red-500 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <div class="relative">
                <div class="flex justify-between items-center mb-1.5">
                    <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                    {{-- <a href="{{ route('password.request') }}" class="text-sm font-medium text-green-600 hover:text-green-700 hover:underline transition-colors">
                        Lupa Password?
                    </a> --}}
                </div>
                <div class="relative">
                    <input
                        id="password" name="password" :type="showPassword ? 'text' : 'password'" required
                        placeholder="••••••••"
                        class="w-full px-4 py-3 bg-gray-50/50 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all outline-none pr-12"
                    >
                    <button type="button" @click="showPassword = !showPassword" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-700">
                        <span x-text="showPassword ? 'Sembunyi' : 'Lihat'" class="text-xs font-bold uppercase"></span>
                    </button>
                </div>
            </div>

            <button
                type="submit" :disabled="loading"
                class="w-full mt-4 py-3.5 rounded-xl text-white font-bold bg-gray-800 hover:bg-gray-900 active:scale-[0.98] transition-all flex justify-center items-center gap-2 shadow-lg disabled:opacity-70"
            >
                <span x-show="!loading">Akses Dashboard</span>
                <span x-show="loading" class="animate-pulse">Memverifikasi...</span>
            </button>
        </form>

        <div class="mt-8 text-center">
            <a href="{{ route('login.user') }}" class="text-sm font-medium text-gray-500 hover:text-green-600 transition-colors">
                &larr; Kembali ke Login Anggota
            </a>
        </div>
    </div>
</div>
@endsection