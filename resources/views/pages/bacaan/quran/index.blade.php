
@extends(auth()->guard('anggota')->check() ? 'layouts.app' : 'layouts.gust')

@section('content')
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center mb-20 mt-10">
            <h1 class="text-4xl md:text-5xl font-extrabold text-green-700 mb-4">
                Al-Qur'an Digital
            </h1>
            
            <div class="max-w-3xl mx-auto bg-white border-l-4 border-amber-400 p-6 rounded-r-xl shadow-sm mb-8 italic">
                <p class="text-lg text-gray-700 leading-relaxed">
                    "Bacalah Al-Qur'an, karena sesungguhnya ia akan datang pada hari kiamat sebagai pemberi syafaat bagi pembacanya."
                </p>
                <span class="block mt-2 text-sm font-semibold text-green-600">— HR. Muslim —</span>
            </div>

            <p class="text-lg text-gray-600">Jelajahi petunjuk Allah melalui daftar surat di bawah ini.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($daftarSurat as $surat)
            <a href="{{ route('quran.show', $surat['nomor']) }}" 
               class="block p-6 bg-white border border-green-100 rounded-2xl shadow-sm hover:shadow-lg hover:border-green-500 hover:-translate-y-1 transition-all duration-300 group">
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-xl bg-green-50 text-green-700 font-bold group-hover:bg-green-500 group-hover:text-white transition-colors duration-300">
                            {{ $surat['nomor'] }}
                        </div>
                        
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 group-hover:text-green-600 transition-colors">
                                {{ $surat['namaLatin'] }}
                            </h3>
                            <p class="text-sm text-gray-500">
                                <span class="text-amber-500 font-medium">{{ $surat['arti'] }}</span> 
                                <span class="mx-1">•</span> 
                                {{ $surat['jumlahAyat'] }} Ayat
                            </p>
                        </div>
                    </div>

                    <div class="text-right">
                        <span class="text-3xl font-arabic text-green-800 leading-none">
                            {{ $surat['nama'] }}
                        </span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Amiri&display=swap');
    .font-arabic {
        font-family: 'Amiri', serif;
    }
</style>
@endsection