@extends(auth()->guard('anggota')->check() ? 'layouts.app' : 'layouts.gust')

@section('content')
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center mb-16 mt-10">
            <h1 class="text-4xl md:text-5xl font-extrabold text-green-700 mb-4 tracking-tight">
                Pusat Bacaan Islami
            </h1>
            
            <div class="max-w-3xl mx-auto bg-white border-l-4 border-amber-400 p-6 rounded-r-xl shadow-sm mb-8 italic">
                <p class="text-lg text-gray-700 leading-relaxed">
                    "Hanya dengan mengingati Allah-lah hati menjadi tenteram."
                </p>
                <span class="block mt-2 text-sm font-semibold text-green-600">— QS. Ar-Ra'd: 28 —</span>
            </div>

            <p class="text-lg text-gray-600">Pilih jenis bacaan untuk memulai ibadah dan memperdalam spiritualitas Anda.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            
            <a href="{{ route('quran.index') }}" 
               class="group relative overflow-hidden bg-white border border-green-100 rounded-3xl p-8 shadow-sm hover:shadow-2xl hover:border-green-500 hover:-translate-y-2 transition-all duration-300">
                <div class="flex flex-col items-center text-center">
                    <div class="w-20 h-20 mb-6 flex items-center justify-center rounded-2xl bg-green-50 text-green-700 group-hover:bg-green-600 group-hover:text-white transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 group-hover:text-green-700 mb-3">Al-Qur'an Digital</h2>
                    <p class="text-gray-500 mb-6 leading-relaxed">Baca mushaf Al-Qur'an 30 Juz lengkap dengan terjemahan dan daftar surat.</p>
                    <span class="text-3xl font-arabic text-green-800 opacity-60 group-hover:opacity-100 transition-opacity">
                        القرآن الكريم
                    </span>
                </div>
            </a>

            <a href="{{ route('asmaul.index') }}" 
               class="group relative overflow-hidden bg-white border border-green-100 rounded-3xl p-8 shadow-sm hover:shadow-2xl hover:border-green-500 hover:-translate-y-2 transition-all duration-300">
                <div class="flex flex-col items-center text-center">
                    <div class="w-20 h-20 mb-6 flex items-center justify-center rounded-2xl bg-amber-50 text-amber-600 group-hover:bg-amber-500 group-hover:text-white transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 group-hover:text-green-700 mb-3">Asmaul Husna</h2>
                    <p class="text-gray-500 mb-6 leading-relaxed">99 Nama Allah yang Indah untuk dihafal, dipahami, dan diamalkan setiap hari.</p>
                    <span class="text-3xl font-arabic text-green-800 opacity-60 group-hover:opacity-100 transition-opacity">
                        أسماء الله الحسنى
                    </span>
                </div>
            </a>

            <a href="{{ route('almatsurat.index') }}" 
               class="group relative overflow-hidden bg-white border border-green-100 rounded-3xl p-8 shadow-sm hover:shadow-2xl hover:border-green-500 hover:-translate-y-2 transition-all duration-300">
                <div class="flex flex-col items-center text-center">
                    <div class="w-20 h-20 mb-6 flex items-center justify-center rounded-2xl bg-blue-50 text-blue-600 group-hover:bg-blue-500 group-hover:text-white transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 group-hover:text-green-700 mb-3">Al-Matsurat</h2>
                    <p class="text-gray-500 mb-6 leading-relaxed">Kumpulan zikir dan doa pagi & petang sesuai sunnah Rasulullah SAW.</p>
                    <span class="text-3xl font-arabic text-green-800 opacity-60 group-hover:opacity-100 transition-opacity">
                        المأثورات
                    </span>
                </div>
            </a>

        </div>

        @isset($materis)
            <div class="relative py-12 mt-8">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                
                <div class="relative flex flex-col md:flex-row items-center justify-between px-2">
                    <span class="bg-gray-50 px-6 text-xl font-bold text-gray-800 tracking-tight flex items-center gap-3 mb-6 md:mb-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        Koleksi Materi Pilihan
                    </span>

                    <form action="{{ route('bacaan.index') }}" method="GET" class="bg-gray-50 px-4 w-full md:w-auto flex items-center gap-2">
                        <div class="relative w-full md:w-72">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul atau materi..." 
                                   class="w-full bg-white border border-gray-200 rounded-full py-2.5 pl-5 pr-12 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm transition outline-none">
                            <button type="submit" class="absolute right-1 top-1 bottom-1 bg-indigo-600 text-white rounded-full p-2 hover:bg-indigo-700 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </div>
                        @if(request('search'))
                            <a href="{{ route('bacaan.index') }}" class="text-gray-400 hover:text-red-500 transition ml-1" title="Hapus Pencarian">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </a>
                        @endif
                    </form>
                </div>
            </div>

            @if($materis->isEmpty() && request('search'))
                <div class="text-center py-16 bg-white rounded-3xl border border-dashed border-gray-300 mb-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-lg font-bold text-gray-700">Materi tidak ditemukan</h3>
                    <p class="text-gray-500 mt-2">Pencarian untuk "<strong>{{ request('search') }}</strong>" tidak menghasilkan apapun. Coba kata kunci lain.</p>
                </div>
            @endif

            @if($materis->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($materis as $materi)
                <a href="{{ $materi->tautan }}" target="_blank" rel="noopener noreferrer"
                   class="group relative overflow-hidden bg-white border border-gray-100 rounded-3xl p-8 shadow-sm hover:shadow-xl hover:border-indigo-400 hover:-translate-y-1 transition-all duration-300 flex flex-col">
                    <div class="flex flex-col items-center text-center flex-grow">
                        <div class="w-24 h-24 mb-6 flex items-center justify-center rounded-2xl overflow-hidden shadow-sm group-hover:shadow-md transition-all duration-300 border border-gray-50">
                            <img src="{{ asset('storage/' . $materi->gambar) }}" alt="{{ $materi->judul }}" class="object-cover w-full h-full group-hover:scale-110 transition-transform duration-500">
                        </div>
                        
                        <h2 class="text-2xl font-bold text-gray-900 group-hover:text-indigo-600 mb-3 transition-colors">{{ $materi->judul }}</h2>
                        <p class="text-gray-500 mb-6 leading-relaxed">{{ $materi->deskripsi }}</p>
                    </div>
                    
                    <span class="mt-auto text-sm font-bold text-indigo-600 opacity-70 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2 bg-indigo-50 px-4 py-3 rounded-2xl group-hover:bg-indigo-100">
                        Buka Materi 
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </span>
                </a>
                @endforeach
            </div>

            <div class="mt-12 mb-8 flex justify-center">
                {{ $materis->links() }}
            </div>
            @endif
            
        @endisset

    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Amiri&display=swap');
    .font-arabic {
        font-family: 'Amiri', serif;
    }
</style>
@endsection