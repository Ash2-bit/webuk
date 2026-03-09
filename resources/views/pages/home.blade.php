@extends(auth()->guard('anggota')->check() ? 'layouts.app' : 'layouts.gust')

@section('content')
<!-- Scroll Smooth -->
<style>
    html {
        scroll-behavior: smooth;
    }
</style>
<!--hero section-->
<section id="hero" class="min-h-screen flex items-center bg-gradient-to-b from-white to-green-50 overflow-hidden">
  <div class="mx-auto max-w-[95%] md:max-w-6xl px-6 flex flex-col md:flex-row items-center justify-between gap-12 md:gap-20 py-16 md:py-28">

    <div class="flex justify-center md:justify-end order-1 md:order-2 w-full md:w-auto">
      <div class="relative group">
        <div class="absolute -inset-4 md:-inset-8 bg-gradient-to-r from-green-300 to-amber-200 rounded-full blur-2xl opacity-30 md:opacity-40 group-hover:opacity-70 transition duration-500 animate-pulse"></div>
        <img src="{{ asset('logouk.png') }}" alt="Logo UKM"
        class="relative w-48 sm:w-56 md:w-72 lg:w-[30rem] drop-shadow-2xl transition-transform duration-700 group-hover:scale-105">
      </div>
    </div>

    <div class="w-full md:max-w-xl space-y-6 text-left order-2 md:order-1">
      
      <div class="inline-block px-4 py-0.5 bg-green-100 rounded-lg">
        <h2 class="text-xs md:text-sm font-bold text-green-700 tracking-wider uppercase font-sans">
          @if(auth()->guard('anggota')->check())
            👋 Hai, {{ auth()->guard('anggota')->user()->nama }}
          @else
            🌿 Selamat Datang di
          @endif
        </h2>
      </div>

      <h1 class="font-serif font-extrabold leading-tight">
        <span class="text-3xl sm:text-2xl md:text-5xl text-amber-500 block">UKM Kerohanian</span>
        <span class="text-2xl sm:text-1xl md:text-4xl text-green-800 opacity-90">KBM Universitas Bengkulu</span>
      </h1>

      <p class="text-base md:text-lg text-green-900/80 leading-relaxed font-sans max-w-md">
        Mari tumbuhkan keimanan dan kecintaan terhadap Islam melalui kegiatan positif dan kebersamaan yang membawa keberkahan.
      </p>

      <div class="flex flex-col sm:flex-row items-start justify-start gap-5 pt-2">
        @if(!auth()->guard('anggota')->check())
            <a href="{{ route('register.user') }}" 
               class="w-full sm:w-auto px-8 py-3 bg-green-600 text-white font-bold rounded-xl shadow-lg shadow-green-200 hover:bg-green-700 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 text-center">
               Bergabung Sekarang
            </a>
        @else
            <div class="w-full sm:w-auto px-5 py-3 bg-white/80 backdrop-blur-sm border-l-4 border-amber-500 rounded-r-xl shadow-sm">
                <p class="text-green-800 font-bold">
                   Senang melihatmu kembali! ✨
                </p>
            </div>
        @endif

        <a href="{{ route('about') }}"
           class="inline-flex items-center text-green-700 font-semibold hover:text-amber-600 transition duration-300 group py-2">
          Pelajari Lebih Lanjut 
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </a>
      </div>
    </div>

  </div>
</section>

<section id="visi-misi" 
    class="min-h-[100vh] flex flex-col justify-center border-t border-green-200 relative [clip-path:inset(0)] bg-green-50">
    
    <div class="fixed inset-0 w-full h-full z-0 opacity-40 transform-gpu will-change-transform"
         style="background-image: url('{{ asset('uk6.jpg') }}'); 
                background-size: cover; 
                background-position: center;">
    </div>
    
    <div class="absolute inset-0 w-full h-full z-0 bg-gradient-to-b from-green-100/60 via-emerald-200/70 to-green-900/60"></div>

    <div class="max-w-6xl mx-auto px-6 sm:px-10 py-20 sm:py-28 text-center relative z-10" x-data="{ activeCard: null }">
        
        <div class="mb-16 sm:mb-20" x-data="{ visible: false }" 
             x-init="setTimeout(() => visible = true, 100)">
             
            <h2 x-show="visible" 
                x-transition:enter="transition ease-out duration-700 transform-gpu"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="text-3xl sm:text-5xl font-extrabold text-green-800 mb-4 tracking-tight shadow-sm">
                Visi & Misi <span class="text-amber-500">UKM Kerohanian</span>
            </h2>

            <p x-show="visible" 
               x-transition:enter="transition ease-out duration-700 delay-200 transform-gpu"
               x-transition:enter-start="opacity-0 translate-y-4"
               x-transition:enter-end="opacity-100 translate-y-0"
               class="text-green-900 font-medium text-base sm:text-xl max-w-3xl mx-auto leading-relaxed">
                Membangun organisasi yang bergerak dengan keikhlasan, tumbuh dalam ukhuwah, 
                dan memberi manfaat yang melampaui batas-batas ruang kampus.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 sm:gap-10 mt-6 px-3 sm:px-0">

            <div @click="activeCard === 1 ? activeCard = null : activeCard = 1"
                 class="cursor-pointer group bg-white/95 backdrop-blur-sm rounded-3xl shadow-xl hover:shadow-2xl border border-green-200
                        p-8 sm:p-10 transition-all duration-300 transform-gpu hover:-translate-y-2 hover:scale-[1.02]
                        relative overflow-hidden will-change-transform">

                <div class="absolute inset-0 bg-gradient-to-r from-green-200/50 to-transparent opacity-0 
                            group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>

                <div class="relative z-10">
                    <h2 class="text-green-800 mt-4 text-2xl font-bold">Visi</h2>
                    <div class="mt-3 w-20 h-1.5 bg-gradient-to-r from-green-400 to-amber-400 mx-auto rounded-full shadow-sm"></div>

                    <div x-show="activeCard === 1"
                         x-collapse
                         x-transition.duration.400ms
                         class="mt-6 text-green-800 font-medium leading-relaxed text-base sm:text-lg">
                        <div class="pt-2">
                            Menjadi wadah kerohanian yang membentuk generasi berakhlak mulia, luas wawasan,
                            dan aktif memberi kontribusi bagi kehidupan sosial berlandaskan nilai Islam.
                        </div>
                    </div>
                </div>
            </div>

            <div @click="activeCard === 2 ? activeCard = null : activeCard = 2"
                 class="cursor-pointer group bg-white/95 backdrop-blur-sm rounded-3xl shadow-xl hover:shadow-2xl border border-amber-100
                        p-8 sm:p-10 transition-all duration-300 transform-gpu hover:-translate-y-2 hover:scale-[1.02]
                        relative overflow-hidden will-change-transform">

                <div class="absolute inset-0 bg-gradient-to-r from-amber-200/40 to-transparent opacity-0 
                            group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>

                <div class="relative z-10">
                    <h2 class="text-green-800 mt-4 text-2xl font-bold">Misi</h2>
                    <div class="mt-3 w-20 h-1.5 bg-gradient-to-r from-green-400 to-amber-400 mx-auto rounded-full shadow-sm"></div>

                    <div x-show="activeCard === 2" 
                         x-collapse
                         x-transition.duration.400ms
                         class="mt-6 text-green-800 font-medium leading-relaxed text-left max-w-md mx-auto text-base sm:text-lg">
                        <ul class="pt-2 space-y-2">
                            <li>• Menyelenggarakan kegiatan pembinaan rohani dan intelektual.</li>
                            <li>• Menumbuhkan semangat ukhuwah dan kepedulian sosial.</li>
                            <li>• Mengembangkan potensi anggota dalam bidang keagamaan dan organisasi.</li>
                            <li>• Berkontribusi positif bagi masyarakat kampus dan sekitar.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-16 sm:mt-20 text-white font-semibold text-sm sm:text-base italic tracking-wide">
            “Makna terdalam selalu lahir dari niat yang bersih dan langkah yang penuh ketulusan.”
        </div>
    </div>
</section>

<section id="statistik" 
         class="min-h-[auto] md:min-h-screen flex flex-col justify-center bg-gradient-to-b from-white to-green-50 border-t border-green-100 py-16 md:py-0">
    <div class="max-w-6xl mx-auto px-5 md:px-6 text-center flex flex-col justify-center">

        <div class="mb-12 md:mb-20 space-y-3">
            <div class="inline-block px-3 py-1 bg-green-100 rounded-full mb-2">
                <span class="text-[10px] md:text-xs font-bold text-green-700 uppercase tracking-widest">Data Terkini</span>
            </div>
            
            <h2 class="text-3xl md:text-5xl font-extrabold text-green-800 tracking-tight leading-tight">
                Statistik <span class="text-amber-500 block md:inline">UKM Kerohanian</span>
            </h2>
            
            <p class="text-sm md:text-xl text-green-900/80 max-w-2xl mx-auto leading-relaxed">
                Membangun organisasi yang aktif dan terus berkembang bersama <span class="font-semibold text-green-800">ukhuwah Islamiyah</span>.
            </p>
        </div>

        <div class="grid grid-cols-3 gap-2 md:gap-12 mt-4">
            
            <div class="group bg-white rounded-2xl md:rounded-3xl shadow-sm md:shadow-lg hover:shadow-2xl border border-green-100 p-3 md:p-14 transition-all duration-500 transform hover:-translate-y-2">
                <div class="text-2xl sm:text-4xl md:text-6xl font-black text-green-700 group-hover:text-emerald-600 transition duration-300">
                    {{ $totalAnggota }}
                </div>
                <p class="text-green-800 mt-1 md:mt-4 text-[10px] sm:text-base md:text-xl font-bold leading-tight uppercase tracking-tighter md:tracking-normal">
                    Pengurus & <br class="md:hidden"> Anggota
                </p>
                <div class="mt-2 md:mt-4 w-6 md:w-20 h-0.5 md:h-1 bg-gradient-to-r from-green-400 to-amber-300 mx-auto rounded-full"></div>
            </div>

            <div class="group bg-white rounded-2xl md:rounded-3xl shadow-sm md:shadow-lg hover:shadow-2xl border border-green-100 p-3 md:p-14 transition-all duration-500 transform hover:-translate-y-2">
                <div class="text-2xl sm:text-4xl md:text-6xl font-black text-green-700 group-hover:text-emerald-600 transition duration-300">
                    {{ $totalBlog }}
                </div>
                <p class="text-green-800 mt-1 md:mt-4 text-[10px] sm:text-base md:text-xl font-bold leading-tight uppercase tracking-tighter md:tracking-normal">
                    Berita & <br class="md:hidden"> Blog
                </p>
                <div class="mt-2 md:mt-4 w-6 md:w-20 h-0.5 md:h-1 bg-gradient-to-r from-green-400 to-amber-300 mx-auto rounded-full"></div>
            </div>

            <div class="group bg-white rounded-2xl md:rounded-3xl shadow-sm md:shadow-lg hover:shadow-2xl border border-green-100 p-3 md:p-14 transition-all duration-500 transform hover:-translate-y-2">
                <div class="text-2xl sm:text-4xl md:text-6xl font-black text-green-700 group-hover:text-emerald-600 transition duration-300">
                    {{ $totalMateri }}
                </div>
                <p class="text-green-800 mt-1 md:mt-4 text-[10px] sm:text-base md:text-xl font-bold leading-tight uppercase tracking-tighter md:tracking-normal">
                    Materi <br class="md:hidden"> Islami
                </p>
                <div class="mt-2 md:mt-4 w-6 md:w-20 h-0.5 md:h-1 bg-gradient-to-r from-green-400 to-amber-300 mx-auto rounded-full"></div>
            </div>

        </div>

        <div class="mt-14 md:mt-24 flex flex-col items-center">
            <div class="w-12 h-[1px] bg-green-200 mb-4 md:hidden"></div>
            <p class="text-sm md:text-xl text-green-700/80 italic font-medium max-w-xs md:max-w-none">
                "Bersama kita tumbuh dalam iman, ilmu, dan amal."
            </p>
        </div>
    </div>
</section>
{{-- ldf --}}
<section id="mitra" 
    class="min-h-screen flex flex-col justify-center items-center border-t border-green-100 relative overflow-hidden"
    style="
        background-image:
            linear-gradient(to bottom, rgba(255,255,255,0.92), rgba(240,253,244,0.92)),
            url('{{ asset('foto/uk5.png') }}');
        background-size: cover;
        background-position: center;
        background-attachment: scroll;
    ">

    {{-- Animasi Cahaya Tetap Ada (Hanya Glow Halus, Tidak Bergerak Posisi) --}}
    <style>
        @keyframes softGlow {
            0%, 100% { opacity: 0.2; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.1); }
        }
        .animate-glow-slow {
            animation: softGlow 4s ease-in-out infinite;
        }
    </style>

    <div class="w-full max-w-7xl mx-auto px-3 sm:px-6 md:px-30 py-19 md:py-24 text-center relative z-10">

        <div class="mb-5 md:mb-10">
            <h2 class="text-3xl md:text-5xl font-extrabold text-green-800 mb-4 tracking-tight">
                🤝 <span class="text-amber-500">Tumbuh & Berjuang</span>
                <span class="text-green-800">Bersama LDF Hebat</span>
            </h2>
            <div class="w-16 h-1 bg-amber-400 mx-auto mb-6 rounded-full"></div>
            <p class="text-sm md:text-xl text-green-900 max-w-2xl mx-auto leading-relaxed opacity-90 px-4">
                Bersama delapan <span class="font-bold text-green-700">Lembaga Dakwah Fakultas</span> Universitas Bengkulu, 
                kita kuatkan ukhuwah dalam sinergi dakwah dalam kampus biru ini.
            </p>
        </div>

        <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-4 md:justify-center gap-2 md:gap-2">
            
            @php
                // Menambahkan key 'link' untuk masing-masing Instagram LDF
                $ldf_list = [
                    ['src' => 'img/ldf/Logo FKSI.jpg', 'name' => 'FKSI (FEB)', 'link' => 'https://www.instagram.com/fksi_unib/'],
                    ['src' => 'img/ldf/Logo FOSI.png', 'name' => 'FOSI (FKIP)', 'link' => 'https://www.instagram.com/fosi_fkipunib/'],
                    ['src' => 'img/ldf/Logo mostaneer .png', 'name' => 'MOSTANEER (FT)', 'link' => 'https://www.instagram.com/mostaneer_unib/'],
                    ['src' => 'img/ldf/Logo FIMADINA.png', 'name' => 'FIMADINA (FKIK)', 'link' => 'https://www.instagram.com/fimadina.fkikunib/'],
                    ['src' => 'img/ldf/LOGO UKM GSI FMIPA UNIB.PNG', 'name' => 'GSI (FMIPA)', 'link' => 'https://www.instagram.com/gsifmipaunib/'],
                    ['src' => 'img/ldf/LOGO UKM MGC FP UNIB.png', 'name' => 'MGC (FAPERTA)', 'link' => 'https://www.instagram.com/ukm_mgc_fpkbmunib/'],
                    ['src' => 'img/ldf/Logo WAMI.jpg', 'name' => 'WAMI (FH)', 'link' => 'https://www.instagram.com/wami_fh_unib/'],
                    ['src' => 'img/ldf/Logo IMC.png', 'name' => 'IMC (FISIP)', 'link' => 'https://www.instagram.com/ukm_imc_fisipkbmunib/']
                ];
            @endphp

            @foreach ($ldf_list as $mitra)
            <a href="{{ $mitra['link'] }}" target="_blank" rel="noopener noreferrer" class="group flex flex-col items-center p-2 transition-all duration-500">
                <div class="relative">
                    <div class="absolute -inset-3 bg-gradient-to-tr from-green-300 to-amber-200 rounded-full blur-xl opacity-0 group-hover:opacity-60 transition-opacity duration-500"></div>
                    
                    <div class="relative bg-white rounded-full p-4 md:p-7 shadow-lg border border-green-50 group-hover:scale-110 group-hover:shadow-green-200 transition-all duration-500">
                        <img src="{{ asset($mitra['src']) }}" alt="{{ $mitra['name'] }}" 
                             class="w-12 h-12 md:w-20 md:h-20 object-contain">
                    </div>
                </div>
                
                <p class="mt-4 text-green-800 font-bold text-[10px] md:text-sm group-hover:text-green-600 transition-colors duration-300 uppercase tracking-widest leading-tight">
                    {{ $mitra['name'] }}
                </p>
            </a>
            @endforeach

        </div>

        <div class="mt-16 md:mt-24">
            <p class="text-[10px] md:text-lg text-green-700/60 font-medium italic tracking-wide">
                “Delapan LDF, satu semangat dakwah kampus”
            </p>
        </div>
    </div>
</section>

<section id="blogs" class="py-29 bg-gradient-to-b from-green-50/50 to-white">
    <div class="max-w-7xl mx-auto px-6">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
            <div class="max-w-2xl">
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 leading-tight">
                    Wawasan & <span class="text-green-600">Artikel Terbaru</span>
                </h2>
                <p class="mt-4 text-gray-600 text-lg">
                    Temukan tips, berita, dan event mendalam langsung dari para  kami.
                </p>
            </div>
            <a href="{{ route('blogs.index') }}" class="inline-flex items-center text-green-600 font-semibold hover:text-green-700 transition-colors group">
                Lihat Semua Artikel 
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($latestBlogs as $blog)
                <article class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 border border-gray-100">
                    <div class="relative overflow-hidden aspect-[16/10]">
                        <img src="{{ $blog->gambar ? asset('storage/' . $blog->gambar) : asset('default-blog.jpg') }}" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700" 
                             alt="{{ $blog->judul }}">
                        
                        <div class="absolute top-4 left-4">
                            <span class="bg-white/90 backdrop-blur-md text-green-700 text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wider shadow-sm">
                                Inspirasi
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-8">
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ $blog->created_at ? $blog->created_at->format('d M, Y') : 'Baru saja' }}
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-green-600 transition-colors line-clamp-2">
                            {{ $blog->judul }}
                        </h3>

                        <p class="text-gray-600 text-sm leading-relaxed mb-6 line-clamp-3">
                            {{ Str::limit(strip_tags($blog->konten), 120) }}
                        </p>

                        <div class="pt-6 border-t border-gray-50">
                            <a href="{{ route('blogs.detail', $blog->slug) }}" 
                               class="inline-flex items-center font-bold text-green-600 hover:text-green-700 group/link">
                                Baca Selengkapnya 
                                <span class="ml-2 transform group-hover/link:translate-x-1 transition-transform">→</span>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full py-20 text-center">
                    <div class="bg-gray-50 rounded-2xl p-10 inline-block">
                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z" />
                        </svg>
                        <p class="text-gray-500 italic">Belum ada artikel yang diterbitkan saat ini.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>


<style>
@keyframes fade-in-slow {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in-slow {
  animation: fade-in-slow 1.8s ease-out both;
}

/* Animasi muncul lembut */
#statistik .group {
  opacity: 0;
  transform: translateY(30px);
  animation: fadeUp 1s ease forwards;
}
#statistik .group:nth-child(1) { animation-delay: 0.2s; }
#statistik .group:nth-child(2) { animation-delay: 0.4s; }
#statistik .group:nth-child(3) { animation-delay: 0.6s; }

@keyframes fadeUp {
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
@endsection
