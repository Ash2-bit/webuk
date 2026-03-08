@extends('layouts.auth')
@section('title', 'Lupa Password')

@section('content')
<div class="w-full max-w-md" x-data="{ loading: false }">
    <div class="bg-white/80 backdrop-blur-xl border border-white/50 rounded-3xl shadow-2xl p-8 sm:p-10">
        
        <div class="text-center mb-6">
            <div class="mx-auto w-16 h-16 bg-orange-50 rounded-full flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            </div>
            <h2 class="text-2xl font-extrabold text-gray-900">Lupa Password?</h2>
            <p class="text-sm text-gray-500 mt-2 leading-relaxed">
                Masukkan email Anda yang terdaftar. Kami akan mengirimkan instruksi untuk mereset password.
            </p>
        </div>

        @if (session('status') || session('success'))
            <div class="p-4 mb-6 text-sm text-green-800 rounded-xl bg-green-50 border border-green-200" role="alert">
                {{ session('status') ?? session('success') }}
            </div>
        @endif

        <form @submit="loading = true" method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat Email</label>
                <input
                    id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                    placeholder="contoh@email.com"
                    class="w-full px-4 py-3 bg-white/50 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all outline-none"
                >
                @error('email') <p class="text-sm text-red-500 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <button type="submit" :disabled="loading" class="w-full py-3.5 rounded-xl text-white font-bold bg-green-600 hover:bg-green-700 active:scale-[0.98] transition-all flex justify-center items-center shadow-lg shadow-green-600/30">
                <span x-show="!loading">Kirim Tautan Reset</span>
                <span x-show="loading" class="animate-pulse">Mengirim...</span>
            </button>
        </form>

        <div class="text-center mt-8">
            <a href="{{ route('login.user') }}" class="text-sm font-medium text-gray-500 hover:text-green-600 transition-colors flex items-center justify-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke halaman Login
            </a>
        </div>
    </div>
</div>
@endsection