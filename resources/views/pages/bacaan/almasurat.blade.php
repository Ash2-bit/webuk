@extends(auth()->guard('anggota')->check() ? 'layouts.app' : 'layouts.gust')

@section('content')
@php
    function toArabic($number) {
        $arabic_digits = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        return str_replace(range(0, 9), $arabic_digits, $number);
    }
    // Warna tema dinamis: Emerald untuk Pagi, Indigo/Blue untuk Petang
    $themeColor = $isPagi ? 'emerald' : 'indigo';
@endphp

<div class="pt-20 md:pt-28 pb-16 bg-gradient-to-b from-{{ $themeColor }}-50/50 to-white min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex justify-center mb-8">
            <div class="bg-white p-1.5 rounded-2xl shadow-sm border border-{{ $themeColor }}-100 flex space-x-1">
                <a href="{{ route('almatsurat.index', 'pagi') }}" 
                   class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all {{ $isPagi ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-200' : 'text-gray-400 hover:text-emerald-600' }}">
                    ☀️ Pagi
                </a>
                <a href="{{ route('almatsurat.index', 'petang') }}" 
                   class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all {{ !$isPagi ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-200' : 'text-gray-400 hover:text-indigo-600' }}">
                    🌙 Petang
                </a>
            </div>
        </div>

        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-5xl font-black text-gray-900 mb-4 tracking-tight">
                Al-Ma'tsurat <span class="text-{{ $themeColor }}-600 underline decoration-amber-400 decoration-4 underline-offset-8">Sugro</span>
            </h1>
            <p class="text-{{ $themeColor }}-700 font-bold uppercase tracking-[0.2em] text-xs">
                Dzikir {{ $waktu }}
            </p>
        </div>

        <div class="space-y-6">
            @foreach($data as $index => $item)
            <div class="group bg-white rounded-[2rem] md:rounded-[2.5rem] border border-gray-100 shadow-sm hover:shadow-xl hover:border-{{ $themeColor }}-200 transition-all duration-500 overflow-hidden">
                <div class="p-6 md:p-10">
                    
                    <div class="flex justify-between items-center mb-8">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-2xl bg-{{ $themeColor }}-600 flex items-center justify-center text-white font-black shadow-lg shadow-{{ $themeColor }}-200">
                                {{ $index + 1 }}
                            </div>
                            <div>
                                <h2 class="text-sm md:text-base font-black text-gray-800 uppercase tracking-tight">{{ $item['title'] }}</h2>
                                <span class="text-[10px] font-bold text-amber-600 bg-amber-50 px-2 py-0.5 rounded-md uppercase">Diulang {{ $item['repeat'] }}x</span>
                            </div>
                        </div>
                        <span class="text-3xl md:text-4xl font-arabic text-{{ $themeColor }}-900/10 group-hover:text-{{ $themeColor }}-600/20 transition-colors">{{ toArabic($index + 1) }}</span>
                    </div>

                    <div class="mb-8">
                        <p class="font-arabic text-3xl md:text-4xl text-gray-800 text-right leading-[2.8] md:leading-[3.5] selection:bg-{{ $themeColor }}-100">
                            {{ $item['arabic'] }}
                        </p>
                    </div>

                    <div class="space-y-4 border-t border-gray-50 pt-8">
                        <p class="text-sm md:text-base text-{{ $themeColor }}-700 italic font-medium leading-relaxed">
                            {{ $item['latin'] }}
                        </p>
                        
                        <div class="bg-gray-50/50 rounded-2xl p-5 border border-gray-50 group-hover:bg-{{ $themeColor }}-50/30 transition-colors">
                            <p class="text-xs md:text-sm text-gray-600 leading-relaxed italic">
                                "{{ $item['translation'] }}"
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-12 text-center pb-10">
            <div class="inline-block px-6 py-3 bg-white rounded-2xl border border-{{ $themeColor }}-100 text-{{ $themeColor }}-700 text-xs md:text-sm font-medium">
                @if($isPagi)
                    Sempurnakan dzikir pagi sebelum matahari terbit.
                @else
                    Sempurnakan dzikir petang setelah Ashar hingga sebelum Isya.
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&display=swap');
    
    .font-arabic { 
        font-family: 'Amiri', serif;
        direction: rtl;
    }

    html {
        scroll-behavior: smooth;
    }

    /* Mencegah angka arab terbalik di beberapa browser */
    .font-arabic {
        unicode-bidi: bidi-override;
    }
</style>
@endsection