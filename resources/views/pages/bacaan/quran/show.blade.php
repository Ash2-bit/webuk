@extends(auth()->guard('anggota')->check() ? 'layouts.app' : 'layouts.gust')

@section('content')
@php
    // Fungsi sederhana untuk mengubah angka Latin ke angka Arab
    function toArabicNumber($number) {
        $arabic_digits = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        return str_replace(range(0, 9), $arabic_digits, $number);
    }
@endphp

<div class="pt-28 pb-16 bg-gradient-to-b from-green-50/50 to-white min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="relative overflow-hidden bg-gradient-to-br from-green-600 to-green-800 rounded-3xl p-8 md:p-12 text-center text-white mb-12 shadow-xl">
            <div class="relative z-10">
                <h1 class="text-4xl md:text-6xl font-black mb-4 tracking-tight">{{ $surat['namaLatin'] }}</h1>
                <div class="flex items-center justify-center space-x-3 text-amber-300 font-bold uppercase tracking-widest text-sm">
                    <span>{{ $surat['arti'] }}</span>
                    <span class="w-1.5 h-1.5 bg-amber-400 rounded-full"></span>
                    <span>{{ $surat['tempatTurun'] }}</span>
                </div>
            </div>
        </div>

        <div class="space-y-10">
            @foreach($surat['ayat'] as $ayat)
            <div class="group bg-white p-6 md:p-8 rounded-3xl border border-green-50 shadow-sm hover:shadow-md transition-all duration-300">
                <div class="flex flex-col space-y-6">
                    
                    <div class="flex justify-between items-start gap-6">
                        <div class="flex-shrink-0 w-14 h-14 flex items-center justify-center relative">
                            <div class="absolute inset-0 border-2 border-amber-200 rotate-45 rounded-xl group-hover:border-green-500 transition-colors"></div>
                            <span class="relative z-10 text-2xl font-arabic font-bold text-green-700 group-hover:text-green-600">
                                {{ toArabicNumber($ayat['nomorAyat']) }}
                            </span>
                        </div>

                        <div class="text-right w-full">
                            <p class="text-3xl md:text-5xl leading-[2] md:leading-[2.2] text-green-900 font-arabic tracking-wide" dir="rtl">
                                {{ $ayat['teksArab'] }}
                            </p>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-50">
                        <p class="text-lg text-gray-700 leading-relaxed font-medium">
                            <span class="text-green-600 font-bold mr-1">{{ $ayat['nomorAyat'] }}.</span> 
                            {{ $ayat['teksIndonesia'] }}
                        </p>
                    </div>

                    <div class="mt-4 bg-green-50/50 p-4 rounded-2xl border border-green-100/50">
                        <audio controls class="w-full h-10">
                            <source src="{{ $ayat['audio']['01'] }}" type="audio/mpeg">
                        </audio>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-16 text-center">
            <a href="{{ route('quran.index') }}" class="inline-flex items-center space-x-2 text-green-600 font-bold hover:text-green-800 transition-colors group">
                <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                <span>Kembali ke Daftar Surat</span>
            </a>
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&display=swap');
    .font-arabic { font-family: 'Amiri', serif; }
</style>
@endsection