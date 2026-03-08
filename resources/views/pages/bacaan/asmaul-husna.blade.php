@extends(auth()->guard('anggota')->check() ? 'layouts.app' : 'layouts.gust') {{-- Memperbaiki 'gust' menjadi 'guest' --}}

@section('content')
@php
    function toArabic($number) {
        $arabic_digits = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        return str_replace(range(0, 9), $arabic_digits, $number);
    }
@endphp

{{-- pt-20 untuk mobile agar tidak terlalu jauh dari header, md:pt-28 untuk desktop --}}
<div class="pt-20 md:pt-28 pb-16 bg-gradient-to-b from-green-50/50 to-white min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center mb-10 md:mb-16">
            {{-- Ukuran text disesuaikan: text-3xl di mobile, text-5xl di desktop --}}
            <h1 class="text-3xl md:text-5xl font-black text-gray-900 mb-4 tracking-tight">
                Asmaul <span class="text-green-600 underline decoration-amber-400 decoration-4 underline-offset-8">Husna</span>
            </h1>
            
            {{-- Padding box dikurangi di mobile (p-4) agar hemat ruang --}}
            <div class="max-w-2xl mx-auto bg-white p-4 md:p-6 rounded-2xl border border-green-100 shadow-sm italic">
                <p class="text-base md:text-lg text-gray-700 font-medium leading-relaxed">
                    "Allah memiliki Asmaul Husna, maka bermohonlah kepada-Nya dengan menyebut Asmaul Husna itu..."
                </p>
                <span class="block mt-2 text-xs md:text-sm font-bold text-green-700 uppercase">— QS. Al-A'raf: 180 —</span>
            </div>
        </div>

        {{-- Gap dikurangi di mobile (gap-3) agar kartu tidak terlalu renggang --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-6">
            @foreach($data as $index => $item)
            <div class="group bg-white p-4 md:p-6 rounded-2xl md:rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:border-green-300 transition-all duration-500 text-center relative overflow-hidden flex flex-col justify-center min-h-[160px] md:min-h-[200px]">
                
                {{-- Posisi nomor disesuaikan agar tidak menabrak teks di layar kecil --}}
                <div class="absolute top-1 left-3 opacity-10 group-hover:opacity-25 transition-opacity">
                    <span class="text-2xl md:text-4xl font-arabic font-black text-green-900">{{ toArabic($index + 1) }}</span>
                </div>

                <div class="relative z-10">
                    {{-- Ukuran teks arab disesuaikan agar tidak overflow di layar kecil --}}
                    <p class="text-3xl md:text-5xl font-arabic text-green-700 mb-2 md:mb-4 group-hover:scale-110 transition-transform duration-500 leading-normal">
                        {{ $item['arabic'] }}
                    </p>
                    {{-- Teks Latin lebih kecil di mobile (text-sm/base) --}}
                    <h3 class="text-sm md:text-xl font-black text-gray-800 tracking-tight line-clamp-1">
                        {{ $item['latin'] }}
                    </h3>
                    {{-- Terjemahan dibuat text-xxs/xs di mobile agar muat 1 baris --}}
                    <p class="text-[10px] md:text-sm text-amber-600 font-bold uppercase mt-0.5 md:mt-1 italic leading-tight">
                        {{ $item['translation_id'] }}
                    </p>
                </div>
                
                <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-amber-400 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@700&display=swap');
    .font-arabic { 
        font-family: 'Amiri', serif;
        /* Mengatur agar spasi antar baris arab lebih rapi di mobile */
        line-height: 1.2;
    }
    
    /* Mencegah teks latin yang terlalu panjang merusak layout */
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;  
        overflow: hidden;
    }
</style>
@endsection