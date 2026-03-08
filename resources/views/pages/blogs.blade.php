@extends(auth()->guard('anggota')->check() ? 'layouts.app' : 'layouts.gust')

@section('content')

<style>
    /* Animasi Halus */
    @keyframes fadeUp {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .fade-up { animation: fadeUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards; }
    
    .hero-blur {
        filter: blur(3px);
        transform: scale(1.03);
    }
</style>

<section class="pb-10 sm:pb-20 pt-16 sm:pt-0 bg-[#fbfcfd]">
    <div class="relative w-full overflow-hidden shadow-lg mb-8 sm:mb-12 pt-6 sm:pt-12" style="min-height: 400px;">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('uk6.jpg') }}" class="w-full h-full object-cover hero-blur" alt="Banner">
            <div class="absolute inset-0 bg-gradient-to-r from-black/85 via-black/50 to-transparent"></div>
        </div>

        <div class="relative z-10 container mx-auto px-6 md:px-12 h-full flex flex-col justify-center py-8 sm:py-20 fade-up opacity-0">
            
            <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-md bg-emerald-500/10 backdrop-blur-md border-l-2 border-emerald-500 mb-4 sm:mb-6 w-fit">
                <span class="text-emerald-400 text-[10px] font-bold uppercase tracking-[0.2em]">Pena & Dakwah Digital</span>
            </div>

            <h1 class="text-3xl sm:text-4xl md:text-6xl font-black text-white leading-tight mb-2 sm:mb-4 tracking-tight">
                Blog & <span class="text-amber-400">Wawasan Ummat</span>
            </h1>

            <p class="text-gray-300 text-sm sm:text-base md:text-lg max-w-2xl mb-6 sm:mb-10 leading-snug sm:leading-relaxed font-light">
                Eksplorasi pemikiran, kajian, dan informasi terkini dari perspektif mahasiswa Muslim progresif untuk membangun peradaban.
            </p>

            <div class="w-full max-w-4xl" x-data="{ 
                openSort: false, 
                sortLabel: '{{ request('sort') == 'oldest' ? 'Terlama' : 'Terbaru' }}',
                sortBy(val, label) {
                    this.sortLabel = label;
                    this.openSort = false;
                    document.getElementById('sort-input').value = val;
                    document.getElementById('search-form').submit();
                }
            }">
                <form id="search-form" action="{{ route('blogs.index') }}" method="GET" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-y-4 sm:gap-x-3 w-full">
                    
                    <div class="relative w-full sm:flex-grow group shadow-lg rounded-full">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-5 h-5 group-focus-within:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari artikel..." 
                            class="w-full pl-12 pr-28 py-3.5 rounded-full bg-white border-none text-gray-800 focus:ring-2 focus:ring-emerald-500 transition-all text-sm outline-none shadow-inner"
                        >
                        <button type="submit" class="absolute right-1.5 top-1.5 bottom-1.5 px-6 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-full transition-all text-xs shadow-md active:scale-95">
                            Cari
                        </button>
                    </div>

                    <input type="hidden" name="sort" id="sort-input" value="{{ request('sort', 'latest') }}">

                    <div class="relative w-full sm:w-auto">
                        <button type="button" @click="openSort = !openSort"
                            class="flex items-center justify-between sm:justify-center w-full sm:w-auto gap-2 px-6 py-3.5 rounded-full bg-white text-gray-700 font-semibold text-sm shadow-lg hover:bg-gray-50 transition-all border border-transparent focus:border-emerald-500/30">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"/>
                                </svg>
                                <span x-text="sortLabel"></span>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 transition-transform duration-300" :class="openSort ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="openSort" 
                             @click.outside="openSort = false"
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-100"
                             class="absolute left-0 mt-2 w-full sm:w-40 bg-white border border-gray-100 rounded-xl shadow-2xl z-50 overflow-hidden p-1">
                            
                            <button type="button" @click="sortBy('latest', 'Terbaru')" 
                                class="w-full text-left px-3 py-3 sm:py-2 text-sm sm:text-xs font-bold rounded-lg transition-all flex items-center justify-between"
                                :class="sortLabel === 'Terbaru' ? 'bg-emerald-50 text-emerald-700' : 'hover:bg-gray-50 text-gray-600'">
                                Terbaru
                            </button>

                            <button type="button" @click="sortBy('oldest', 'Terlama')" 
                                class="w-full text-left px-3 py-3 sm:py-2 text-sm sm:text-xs font-bold rounded-lg transition-all flex items-center justify-between"
                                :class="sortLabel === 'Terlama' ? 'bg-emerald-50 text-emerald-700' : 'hover:bg-gray-50 text-gray-600'">
                                Terlama
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-6 md:px-12">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-8 sm:mb-10 gap-4 sm:gap-0">
            <div>
                <h2 class="text-xl font-bold text-gray-900 tracking-tight flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    Artikel Terbaru
                </h2>
                <div class="h-1 w-12 bg-emerald-600 rounded-full mt-1.5"></div>
            </div>
            @if(request('search'))
                <span class="text-sm sm:text-xs text-gray-500 bg-gray-100 px-3 py-1 rounded-full">Hasil untuk: <b class="text-emerald-600">"{{ request('search') }}"</b></span>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10">
            @forelse($blogs as $index => $blog)
            <div class="group fade-up opacity-0" style="animation-delay: {{ $index * 0.1 }}s">
                <article class="bg-white rounded-[2rem] overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100 flex flex-col h-full relative">
                    <div class="relative overflow-hidden h-52 sm:h-60">
                        @if($blog->gambar)
                            <img src="{{ asset('storage/' . $blog->gambar) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        @else
                            <div class="w-full h-full bg-emerald-50 flex items-center justify-center text-emerald-200 font-bold italic">Pena Dakwah</div>
                        @endif
                        <div class="absolute bottom-4 left-6">
                            <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-emerald-800 text-[10px] font-bold rounded-lg shadow-sm">
                                {{ $blog->created_at ? $blog->created_at->format('d M, Y') : 'Terbaru' }}
                            </span>
                        </div>
                    </div>

                    <div class="p-6 sm:p-8 flex flex-col flex-grow">
                        <h3 class="text-lg sm:text-xl font-extrabold text-gray-900 mb-3 sm:mb-4 group-hover:text-emerald-700 transition-colors line-clamp-2 leading-tight">
                            {{ $blog->judul }}
                        </h3>
                        <p class="text-gray-500 text-sm mb-6 sm:mb-8 line-clamp-3 leading-relaxed">
                            {{ Str::limit(strip_tags($blog->konten), 110) }}
                        </p>
                        <div class="mt-auto pt-5 sm:pt-6 border-t border-gray-50 flex justify-between items-center">
                            <a href="{{ route('blogs.detail', $blog->slug) }}" class="inline-flex items-center text-emerald-600 font-bold text-sm hover:gap-2 transition-all">
                                Baca Detail 
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </a>
                        </div>
                    </div>
                </article>
            </div>
            @empty
            <div class="col-span-full py-20 text-center text-gray-400 italic font-medium">
                "Tidak ada artikel yang ditemukan."
            </div>
            @endforelse
        </div>

        @if($blogs->hasPages())
        <div class="mt-16 sm:mt-20 flex justify-center w-full overflow-x-auto">
            <div class="p-1 bg-white rounded-xl shadow-sm border border-gray-100 min-w-max">
                {{ $blogs->appends(request()->query())->links('pagination::tailwind') }}
            </div>
        </div>
        @endif
    </div>
</section>

@endsection