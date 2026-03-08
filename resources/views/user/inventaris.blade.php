@extends('layouts.app')

@section('title', 'Inventaris')

@section('content')
<div x-data="{ search:'' }" class="max-w-7xl mx-auto px-6 pt-28 pb-16 space-y-12">
    {{-- ↑ pt-28 supaya tidak ketutup header --}}

    <!-- HERO -->
    <div class="text-center space-y-3">
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900">
            Inventaris Organisasi
        </h1>
        <p class="text-gray-500 text-lg">
            Daftar inventaris yang dapat diakses oleh anggota
        </p>
    </div>

    <!-- SEARCH BOX -->
    <div class="flex justify-center">
        <div class="relative w-full max-w-xl">
            <input
                x-model="search"
                type="text"
                placeholder="Cari nama barang atau lokasi..."
                class="w-full px-6 py-4 pl-12 rounded-2xl border border-gray-300 shadow-sm
                       focus:ring-2 focus:ring-emerald-400 focus:outline-none text-gray-700"
            >
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                🔍
            </span>
        </div>
    </div>

    <!-- GRID INVENTARIS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
        @foreach($inventaris as $item)
        <div
            x-show="'{{ strtolower($item->nama_barang) }}'.includes(search.toLowerCase())
            || '{{ strtolower($item->lokasi) }}'.includes(search.toLowerCase())"
            class="bg-white rounded-3xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden"
        >

            <!-- IMAGE -->
            @if($item->foto_barang)
                <img src="{{ asset('storage/'.$item->foto_barang) }}"
                     class="h-52 w-full object-cover">
            @else
                <div class="h-52 bg-gray-100 flex items-center justify-center text-5xl">
                    📦
                </div>
            @endif

            <!-- CONTENT -->
            <div class="p-6 space-y-3">
                <h3 class="text-xl font-bold text-gray-900 truncate">
                    {{ $item->nama_barang }}
                </h3>

                <p class="text-gray-600 flex items-center gap-2">
                    📍 <span>{{ $item->lokasi ?? '-' }}</span>
                </p>

                <p class="text-gray-600 flex items-center gap-2">
                    📦 <span>Jumlah: {{ $item->jumlah }}</span>
                </p>

                <span class="inline-block mt-1 px-3 py-1 text-xs font-semibold rounded-full
                    {{ $item->ketersediaan === 'ada'
                        ? 'bg-green-100 text-green-700'
                        : 'bg-gray-200 text-gray-600' }}">
                    {{ strtoupper($item->ketersediaan) }}
                </span>

                <a href="{{ route('user.inventaris.detail', $item->id) }}"
                   class="block mt-5 text-center bg-emerald-600 text-white py-3 rounded-xl
                          hover:bg-emerald-700 transition font-semibold">
                    Lihat Detail
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <!-- PAGINATION -->
    <div class="flex justify-center pt-10">
        {{ $inventaris->links('pagination::tailwind') }}
    </div>

</div>
@endsection
