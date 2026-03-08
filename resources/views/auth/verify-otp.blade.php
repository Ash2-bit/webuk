@extends('layouts.auth')

@section('title', 'Verifikasi Kode Email')

@section('content')
<div 
    x-data="{ loading: false }"
    class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-50 via-white to-green-100 px-6"
>
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8 space-y-6 border border-green-100">
        
        <div class="text-center">
            <h2 class="mt-4 text-2xl font-bold text-gray-800 tracking-tight">Masukkan Kode</h2>
            <p class="text-sm text-gray-500 mt-2">
                Kami telah mengirimkan 6 digit kode verifikasi ke email <span class="font-bold text-gray-800">{{ Session::get('reset_email') }}</span>.
            </p>
        </div>

        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <form @submit="loading = true" method="POST" action="{{ route('password.verify') }}" class="space-y-6 mt-6">
            @csrf

            <div>
                <label for="otp" class="block text-sm font-medium text-gray-700 mb-1 text-center">Kode 6 Digit</label>
                <input
                    id="otp"
                    name="otp"
                    type="text"
                    maxlength="6"
                    required
                    autofocus
                    placeholder="Contoh: 123456"
                    class="w-full px-4 py-3 text-center text-2xl tracking-widest font-bold rounded-xl border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                >
                @error('otp')
                    <p class="text-sm text-center text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button
                    type="submit"
                    :disabled="loading"
                    class="w-full flex justify-center py-3 px-4 rounded-xl text-white font-semibold bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 transition duration-150 ease-in-out"
                >
                    <span x-show="!loading">Verifikasi Kode</span>
                    <span x-show="loading">Memeriksa...</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection