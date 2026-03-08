@extends(auth()->guard('anggota')->check() ? 'layouts.app' : 'layouts.gust')

@section('content')
<style>
    .reveal {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s ease-out;
    }
    .reveal.active {
        opacity: 1;
        transform: translateY(0);
    }
</style>

@if($cabinet)
<section class="bg-linear-to-br from-emerald-400 via-teal-500 to-green-600 rounded-b-[2.5rem] md:rounded-b-[4rem] px-4 py-16 md:p-24 lg:p-32 text-center text-white relative overflow-hidden shadow-2xl">
    <div class="absolute top-[-10%] left-[-10%] w-48 h-48 md:w-64 md:h-64 bg-yellow-300 rounded-full mix-blend-multiply filter blur-2xl opacity-50 animate-pulse"></div>
    <div class="absolute bottom-[-10%] right-[-5%] w-64 h-64 md:w-80 md:h-80 bg-emerald-300 rounded-full mix-blend-multiply filter blur-2xl opacity-40 animate-pulse" style="animation-delay: 2s;"></div>

    <div class="relative z-10 max-w-4xl mx-auto flex flex-col items-center">
        <span class="inline-block px-4 py-2 md:px-6 md:py-3 bg-white/20 backdrop-blur-md rounded-full text-white font-bold tracking-widest uppercase text-xs md:text-sm mb-6 md:mb-7 reveal shadow-sm border border-white/30">
            Struktur Kepengurusan
        </span>
        
        @if($cabinet->logo)
            <div class="mb-6 md:mb-8 p-3 md:p-4 bg-white/20 backdrop-blur-md rounded-full shadow-2xl border border-white/30 reveal">
                <img src="{{ asset('storage/'.$cabinet->logo) }}" alt="Logo Kabinet" class="w-32 h-32 sm:w-48 sm:h-48 md:w-56 md:h-56 object-contain drop-shadow-2xl transform hover:scale-105 transition-transform duration-500">
            </div>
        @else
            <div class="mb-6 md:mb-8 w-32 h-32 sm:w-48 sm:h-48 bg-linear-to-tr from-emerald-100/50 to-teal-50/50 rounded-full flex items-center justify-center text-white border-4 border-white/50 shadow-lg backdrop-blur-sm reveal">
                <span class="text-center text-xs sm:text-sm font-bold uppercase tracking-widest">Tanpa<br>Logo</span>
            </div>
        @endif
        
        <h1 class="text-4xl sm:text-5xl md:text-7xl font-extrabold font-['Playfair_Display'] mb-3 md:mb-4 drop-shadow-xl reveal leading-tight px-2">
            {{ $cabinet->nama_kabinet }}
        </h1>
        
        <p class="text-white/90 text-lg sm:text-xl md:text-3xl font-medium drop-shadow-md reveal mt-2 bg-black/10 inline-block px-4 md:px-6 py-2 rounded-2xl backdrop-blur-sm">
            Periode {{ $cabinet->tahun }}
        </p>
    </div>
</section>

<section class="max-w-4xl mx-auto px-4 sm:px-6 py-8 md:py-12 reveal -mt-10 md:-mt-16 relative z-20">
    <div class="bg-white/95 backdrop-blur-xl rounded-[1.5rem] md:rounded-[2rem] p-6 md:p-12 shadow-2xl border border-emerald-50 text-center">
        <h2 class="text-xl md:text-2xl font-black mb-3 md:mb-4 text-emerald-800 font-['Playfair_Display']">Tentang Kabinet Ini</h2>
        <div class="w-12 md:w-16 h-1 bg-yellow-400 mx-auto rounded-full mb-4 md:mb-6"></div>
        <p class="text-gray-600 leading-relaxed font-['Poppins'] text-base md:text-xl italic">
            "{{ $cabinet->deskripsi ?? 'Merajut ukhuwah, menebar manfaat, dan menjadi penggerak kebaikan di lingkungan kampus dengan penuh semangat dan keceriaan.' }}"
        </p>
    </div>
</section>

<section class="py-12 md:py-20 relative z-10 reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center">
        <h2 class="text-3xl md:text-4xl font-black mb-10 md:mb-16 text-emerald-800 font-['Playfair_Display'] relative inline-block">
            Pengurus Inti
            <div class="absolute -bottom-2 md:-bottom-3 left-1/2 transform -translate-x-1/2 w-16 md:w-24 h-1.5 md:h-2 bg-yellow-400 rounded-full"></div>
        </h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 items-center mt-6 md:mt-10">
            
            <div class="order-4 lg:order-1 bg-white p-6 rounded-[2rem] md:rounded-[2.5rem] shadow-xl border border-gray-100 hover:border-pink-300 transition-all duration-300 hover:-translate-y-2 z-10 flex flex-col items-center">
                <div class="w-24 h-24 md:w-28 md:h-28 mx-auto rounded-full p-1.5 bg-linear-to-tr from-pink-300 to-rose-300 mb-4 shadow-md">
                    <img src="{{ $cabinet->foto_bendahara ? asset('storage/'.$cabinet->foto_bendahara) : 'https://ui-avatars.com/api/?name='.$cabinet->bendahara.'&background=FCE7F3&color=BE185D' }}" class="w-full h-full rounded-full object-cover border-4 border-white">
                </div>
                <p class="text-pink-500 font-bold tracking-widest uppercase text-[10px] mb-1">Bendahara</p>
                <h4 class="font-bold text-lg md:text-xl text-gray-800 break-words text-center">{{ $cabinet->bendahara ?? '-' }}</h4>
                <p class="text-[11px] text-gray-500 mt-2 font-medium bg-gray-50 px-3 py-1 rounded-full border text-center">{{ $cabinet->npm_bendahara ?? 'NPM -' }} | {{ $cabinet->prodi_bendahara ?? 'Prodi -' }}</p>
            </div>

            <div class="order-1 lg:order-2 bg-linear-to-b from-emerald-500 to-teal-600 p-6 md:p-8 rounded-[2rem] md:rounded-[2.5rem] shadow-2xl transform lg:-translate-y-6 hover:-translate-y-2 lg:hover:-translate-y-10 transition-all duration-300 relative z-20 flex flex-col items-center">
                <div class="absolute -top-3 -right-3 md:-top-4 md:-right-4 text-3xl md:text-4xl animate-bounce">✨</div>
                <div class="w-28 h-28 md:w-32 md:h-32 mx-auto rounded-full p-2 bg-white/30 backdrop-blur-sm mb-4 md:mb-5 shadow-xl">
                    <img src="{{ $cabinet->foto_ketua ? asset('storage/'.$cabinet->foto_ketua) : 'https://ui-avatars.com/api/?name='.$cabinet->ketua.'&background=fff&color=047857' }}" class="w-full h-full rounded-full object-cover border-4 border-white">
                </div>
                <p class="text-yellow-300 font-black tracking-widest uppercase text-xs mb-1 md:mb-2 drop-shadow-sm">Ketua Umum</p>
                <h4 class="font-black text-xl md:text-2xl text-white font-['Playfair_Display'] drop-shadow-md text-center">{{ $cabinet->ketua ?? '-' }}</h4>
                <div class="mt-3 bg-white/20 px-4 py-1.5 rounded-full backdrop-blur-sm border border-white/30 w-full">
                    <p class="text-[10px] md:text-[11px] text-white font-semibold tracking-wide text-center truncate">{{ $cabinet->npm_ketua ?? 'NPM -' }}<br>{{ $cabinet->prodi_ketua ?? 'Prodi -' }}</p>
                </div>
            </div>

            <div class="order-2 lg:order-3 bg-linear-to-b from-pink-500 to-rose-600 p-6 md:p-8 rounded-[2rem] md:rounded-[2.5rem] shadow-2xl transform lg:-translate-y-6 hover:-translate-y-2 lg:hover:-translate-y-10 transition-all duration-300 relative z-20 flex flex-col items-center">
                <div class="w-28 h-28 md:w-32 md:h-32 mx-auto rounded-full p-2 bg-white/30 backdrop-blur-sm mb-4 md:mb-5 shadow-xl">
                    <img src="{{ $cabinet->foto_keputrian ? asset('storage/'.$cabinet->foto_keputrian) : 'https://ui-avatars.com/api/?name='.$cabinet->keputrian.'&background=fff&color=be185d' }}" class="w-full h-full rounded-full object-cover border-4 border-white">
                </div>
                <p class="text-pink-200 font-black tracking-widest uppercase text-xs mb-1 md:mb-2 drop-shadow-sm">Keputrian</p>
                <h4 class="font-black text-xl md:text-2xl text-white font-['Playfair_Display'] drop-shadow-md text-center">{{ $cabinet->keputrian ?? '-' }}</h4>
                <div class="mt-3 bg-white/20 px-4 py-1.5 rounded-full backdrop-blur-sm border border-white/30 w-full">
                    <p class="text-[10px] md:text-[11px] text-white font-semibold tracking-wide text-center truncate">{{ $cabinet->npm_keputrian ?? 'NPM -' }}<br>{{ $cabinet->prodi_keputrian ?? 'Prodi -' }}</p>
                </div>
            </div>

            <div class="order-3 lg:order-4 bg-white p-6 rounded-[2rem] md:rounded-[2.5rem] shadow-xl border border-gray-100 hover:border-blue-300 transition-all duration-300 hover:-translate-y-2 z-10 flex flex-col items-center">
                <div class="w-24 h-24 md:w-28 md:h-28 mx-auto rounded-full p-1.5 bg-linear-to-tr from-blue-300 to-indigo-300 mb-4 shadow-md">
                    <img src="{{ $cabinet->foto_sekretaris ? asset('storage/'.$cabinet->foto_sekretaris) : 'https://ui-avatars.com/api/?name='.$cabinet->sekretaris.'&background=E0E7FF&color=3730A3' }}" class="w-full h-full rounded-full object-cover border-4 border-white">
                </div>
                <p class="text-blue-500 font-bold tracking-widest uppercase text-[10px] mb-1">Sekretaris</p>
                <h4 class="font-bold text-lg md:text-xl text-gray-800 break-words text-center">{{ $cabinet->sekretaris ?? '-' }}</h4>
                <p class="text-[11px] text-gray-500 mt-2 font-medium bg-gray-50 px-3 py-1 rounded-full border text-center">{{ $cabinet->npm_sekretaris ?? 'NPM -' }} | {{ $cabinet->prodi_sekretaris ?? 'Prodi -' }}</p>
            </div>

        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 py-12 md:py-20 reveal bg-gray-50/50 rounded-[2rem] md:rounded-[3rem] mb-12 md:mb-20">
    <div class="text-center mb-10 md:mb-16">
        <h2 class="text-3xl md:text-4xl font-black text-emerald-800 font-['Playfair_Display'] relative inline-block">
            Bidang & Departemen
            <div class="absolute -bottom-2 md:-bottom-3 left-1/2 transform -translate-x-1/2 w-12 md:w-16 h-1.5 md:h-2 bg-emerald-400 rounded-full"></div>
        </h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
        @foreach($cabinet->departments as $dept)
        <div class="bg-white rounded-2xl md:rounded-3xl p-6 md:p-8 shadow-lg hover:shadow-2xl hover:-translate-y-2 border-b-4 border-emerald-400 transition-all duration-300 group flex flex-col relative overflow-hidden">
            <div class="absolute -right-8 -top-8 md:-right-10 md:-top-10 w-24 h-24 md:w-32 md:h-32 bg-emerald-50 rounded-full group-hover:bg-emerald-100 transition-colors z-0"></div>
            
            <div class="relative z-10 flex-1">
                <h3 class="text-xl md:text-2xl font-bold text-gray-800 mb-5 md:mb-6 font-['Playfair_Display'] group-hover:text-emerald-700 transition-colors">{{ $dept->nama_bidang }}</h3>

                <div class="space-y-3 md:space-y-4 mb-5 md:mb-6">
                    <div class="flex items-center gap-3 md:gap-4 bg-blue-50/30 p-3 rounded-2xl overflow-hidden">
                        <img src="{{ $dept->foto_co_ikhwan ? asset('storage/'.$dept->foto_co_ikhwan) : 'https://ui-avatars.com/api/?name='.$dept->co_ikhwan.'&background=DBEAFE&color=1E40AF' }}" class="w-12 h-12 md:w-14 md:h-14 rounded-full object-cover shadow-sm border-2 border-white shrink-0">
                        <div class="min-w-0 flex-1">
                            <p class="text-[9px] md:text-[10px] text-blue-500 font-bold uppercase tracking-wider truncate">Koordinator Ikhwan</p>
                            <p class="text-sm md:text-base font-bold text-gray-800 truncate">{{ $dept->co_ikhwan }}</p>
                            <p class="text-[9px] md:text-[10px] text-gray-500 mt-0.5 truncate">{{ $dept->npm_co_ikhwan ?? 'NPM -' }} | {{ $dept->prodi_co_ikhwan ?? 'Prodi -' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 md:gap-4 bg-pink-50/30 p-3 rounded-2xl overflow-hidden">
                        <img src="{{ $dept->foto_co_akhwat ? asset('storage/'.$dept->foto_co_akhwat) : 'https://ui-avatars.com/api/?name='.$dept->co_akhwat.'&background=FCE7F3&color=BE185D' }}" class="w-12 h-12 md:w-14 md:h-14 rounded-full object-cover shadow-sm border-2 border-white shrink-0">
                        <div class="min-w-0 flex-1">
                            <p class="text-[9px] md:text-[10px] text-pink-500 font-bold uppercase tracking-wider truncate">Koordinator Akhwat</p>
                            <p class="text-sm md:text-base font-bold text-gray-800 truncate">{{ $dept->co_akhwat }}</p>
                            <p class="text-[9px] md:text-[10px] text-gray-500 mt-0.5 truncate">{{ $dept->npm_co_akhwat ?? 'NPM -' }} | {{ $dept->prodi_co_akhwat ?? 'Prodi -' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            @if($dept->anggota_aktif)
            <div class="pt-4 mt-auto border-t border-gray-100 relative z-10">
                <p class="text-[11px] md:text-xs font-bold text-emerald-600 uppercase mb-2 flex items-center gap-2">
                    <span>👥</span> Anggota Aktif
                </p>
                <div class="text-xs md:text-sm text-gray-600 leading-relaxed whitespace-pre-wrap">{{ $dept->anggota_aktif }}</div>
            </div>
            @endif

            @if($dept->deskripsi)
            <div class="pt-3 mt-3 border-t border-gray-50 relative z-10">
                <p class="text-gray-600 text-xs md:text-sm italic border-l-4 border-yellow-400 pl-3 bg-yellow-50/50 py-2 pr-2 rounded-r-lg">"{{ $dept->deskripsi }}"</p>
            </div>
            @endif

        </div>
        @endforeach
    </div>
</section>

@if(isset($allCabinets) && $allCabinets->count() > 1)
<section class="py-16 md:py-20 bg-linear-to-b from-white to-emerald-50 reveal border-t border-emerald-100">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 text-center">
        <h3 class="text-xl sm:text-2xl md:text-3xl font-bold text-emerald-800 mb-4 md:mb-8 font-['Playfair_Display']">
            Jelajahi Kepengurusan Lainnya
        </h3>
        <p class="text-sm md:text-base text-gray-600 mb-8 md:mb-10 max-w-2xl mx-auto px-4">Setiap masa ada orangnya, setiap orang ada masanya. Mari lihat rekam jejak perjuangan kabinet-kabinet sebelumnya.</p>
        
        <div class="flex flex-wrap justify-center gap-3 md:gap-4">
            @foreach($allCabinets as $cab)
                <a href="{{ route('struktur', $cab->id) }}" 
                   class="px-6 md:px-8 py-3 md:py-4 rounded-full text-sm md:text-base font-bold shadow-md transition-all duration-300 transform hover:-translate-y-1 
                   {{ $cabinet->id == $cab->id ? 'bg-emerald-600 text-white shadow-emerald-200 ring-4 ring-emerald-100' : 'bg-white text-emerald-700 border border-emerald-200 hover:bg-emerald-50 hover:shadow-lg' }}">
                    {{ $cab->nama_kabinet }} 
                    <span class="text-xs md:text-sm font-normal opacity-80 ml-1">({{ $cab->tahun }})</span>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@else
<section class="max-w-4xl mx-auto px-4 sm:px-6 py-20 md:py-32 text-center">
    <div class="bg-gray-50 rounded-2xl md:rounded-3xl p-8 md:p-16 border-2 border-dashed border-gray-200">
        <div class="text-5xl md:text-6xl mb-4">🌱</div>
        <h2 class="text-2xl md:text-3xl font-bold font-['Playfair_Display'] text-gray-400 mb-3 md:mb-4">Struktur Belum Tersedia</h2>
        <p class="text-sm md:text-base text-gray-500">Data struktur kepengurusan saat ini sedang diperbarui. Silakan kembali lagi nanti!</p>
    </div>
</section>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const observerOptions = { threshold: 0.15 };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('active');
            });
        }, observerOptions);

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    });
</script>
@endsection