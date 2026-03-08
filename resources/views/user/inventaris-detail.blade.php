@extends('layouts.app')

@section('title', 'Detail Inventaris')

@section('content')
<div class="max-w-4xl mx-auto p-6">

    <a href="{{ route('user.inventaris') }}" class="text-emerald-600">
        ← Kembali ke Inventaris
    </a>

    <div class="bg-white rounded-3xl shadow-xl p-8 mt-4">

        @if($item->foto_barang)
            <img src="{{ asset('storage/'.$item->foto_barang) }}"
                 class="w-64 h-64 object-cover rounded-2xl mx-auto mb-6">
        @endif

        @if($item->qr_code)
            <img src="{{ asset('storage/'.$item->qr_code) }}"
                 class="w-40 mx-auto mb-6">
        @endif

        <h1 class="text-3xl font-extrabold text-center mb-6">
            {{ $item->nama_barang }}
        </h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-gray-700">
            <p><strong>Jumlah:</strong> {{ $item->jumlah }}</p>
            <p><strong>Kondisi:</strong> {{ $item->kondisi }}</p>
            <p><strong>Lokasi:</strong> {{ $item->lokasi }}</p>
            <p><strong>Status Peminjaman:</strong> {{ $item->status_peminjaman }}</p>
            <p><strong>Ketersediaan:</strong> {{ $item->ketersediaan }}</p>
            <p><strong>Tanggal Masuk:</strong> {{ $item->tanggal_masuk }}</p>
        </div>

        @if($item->link_sop)
            <div class="text-center mt-8">
                <a href="{{ $item->link_sop }}"
                   target="_blank"
                   class="inline-block px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700">
                    🔗 Buka Link SOP
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
