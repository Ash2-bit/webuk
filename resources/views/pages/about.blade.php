@extends(auth()->guard('anggota')->check() ? 'layouts.app' : 'layouts.gust')

@section('content')
<style>
    /* Style untuk animasi scroll */
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

<section x-data="{ 
            activeSlide: 0, 
            slides: ['/foto/uk3.jpg', '/foto/uk2.jpg', '/foto/uk1.jpg'],
            autoPlay() {
                setInterval(() => {
                    this.activeSlide = (this.activeSlide + 1) % this.slides.length;
                }, 5000); // Berubah setiap 5 detik
            }
        }" 
        x-init="autoPlay()"
        class="relative w-full h-[400px] sm:h-[450px] md:h-[650px] overflow-hidden">

    <template x-for="(slide, index) in slides" :key="index">
        <div x-show="activeSlide === index" 
             x-transition:enter="transition duration-1000 ease-out"
             x-transition:enter-start="opacity-0 scale-110"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition duration-1000 ease-in"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="absolute inset-0">
            <img :src="slide" alt="Slide" class="w-full h-full object-cover brightness-[0.45]">
        </div>
    </template>

    <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-4 md:px-6">
        <h1 class="text-white text-3xl sm:text-4xl md:text-6xl font-bold font-['Playfair_Display'] mb-3 md:mb-4 drop-shadow-2xl leading-tight">
            UKM Kerohanian KBM UNIB
        </h1>
        <div class="w-16 md:w-24 h-1 bg-green-500 mb-4 md:mb-6"></div>
        <p class="text-white/90 text-sm sm:text-lg md:text-2xl max-w-3xl italic font-light drop-shadow-md leading-relaxed px-4">
            "Tempat jiwa menemukan arah, akal menemukan makna, dan langkah kembali ditautkan kepada nilai-nilai Ilahi."
        </p>
    </div>

    <div class="absolute bottom-6 md:bottom-8 left-1/2 -translate-x-1/2 flex space-x-2 md:space-x-3">
        <template x-for="(slide, index) in slides" :key="index">
            <button @click="activeSlide = index" 
                    :class="activeSlide === index ? 'bg-green-500 w-6 md:w-8' : 'bg-white/50 w-2'"
                    class="h-2 rounded-full transition-all duration-300"></button>
        </template>
    </div>
</section>

<section class="max-w-6xl mx-auto px-6 py-16 md:py-24 reveal">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-16 items-center">
        <div class="relative group mt-6 md:mt-0 order-2 md:order-1">
            <div class="w-full h-64 sm:h-80 md:h-[500px] bg-white rounded-2xl overflow-hidden shadow-2xl relative z-10 transition-transform duration-500 group-hover:scale-[1.02] p-4 md:p-0">
                <img src="{{ asset('logouk.png') }}" alt="Suasana UKM" class="w-full h-full object-contain md:object-cover">
            </div>
            <div class="absolute -bottom-4 -left-4 md:-bottom-6 md:-left-6 w-32 h-32 md:w-64 md:h-64 bg-green-50 rounded-2xl -z-0"></div>
        </div>

        <div class="order-1 md:order-2">
            <span class="text-green-600 font-bold tracking-widest uppercase text-xs md:text-sm">Sejarah & Filosofi</span>
            <h2 class="text-3xl md:text-4xl font-bold mt-2 mb-4 md:mb-6 text-gray-800 font-['Playfair_Display'] leading-tight">Denyut Ruhani Sejak 1994</h2>
            <div class="space-y-4 md:space-y-6 text-gray-700 leading-relaxed font-['Poppins'] text-base md:text-lg text-justify md:text-left">
                <p>
                    UKM Kerohanian KBM UNIB bukan sekadar organisasi, melainkan denyut ruhani yang tumbuh sejak <span class="text-green-700 font-semibold">28 Oktober 1994</span>. 
                    Ia lahir dari kesadaran bahwa ilmu tanpa iman akan kehilangan cahaya.
                </p>
                <p>
                    Berlandaskan Al-Qur’an dan As-Sunnah, kami berdiri sebagai rumah pembinaan mahasiswa muslim yang terbuka dan inklusif. Di sinilah kader-kader ditempa untuk menjadi pribadi yang matang bersikap dan kokoh dalam nilai.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="bg-gray-50 py-16 md:py-24 reveal">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <h2 class="text-2xl md:text-3xl font-bold mb-10 md:mb-16 font-['Playfair_Display'] text-gray-800 italic underline decoration-green-500 decoration-4 underline-offset-8">
            Ruang Gerak & Pengabdian
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
            @php
                $pilars = [
                    ['01', 'Kaderisasi', 'Menumbuhkan karakter, membentuk pribadi yang produktif dan militan.'],
                    ['02', 'Kajian Keilmuan', 'Menghidupkan nalar kritis mahasiswa dalam menyulam keilmuan.'],
                    ['03', 'Syiar & Sosial', 'Menyapa masyarakat kampus dengan nilai Islam yang hidup dan relevan.'],
                    ['04', 'Pembinaan', 'Penguatan spiritual yang meneduhkan hati sebagai bekal perjuangan.']
                ];
            @endphp

            @foreach($pilars as $pilar)
            <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border-b-4 border-transparent hover:border-green-600 transition-all duration-300 transform hover:-translate-y-3">
                <div class="text-green-600 mb-2 md:mb-4 text-3xl md:text-4xl font-serif italic opacity-30">{{ $pilar[0] }}</div>
                <h4 class="font-bold text-lg md:text-xl mb-2 md:mb-3 text-gray-800">{{ $pilar[1] }}</h4>
                <p class="text-gray-600 text-sm leading-relaxed">{{ $pilar[2] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="max-w-6xl mx-auto px-4 md:px-6 py-16 md:py-24 reveal">
    <div class="bg-green-800 rounded-3xl md:rounded-[3rem] p-8 md:p-20 text-white relative overflow-hidden shadow-2xl text-center md:text-left">
        <div class="relative z-10 max-w-2xl mx-auto md:mx-0">
            <h2 class="text-2xl md:text-4xl font-bold mb-4 md:mb-8 font-['Playfair_Display'] leading-tight">Musyawarah sebagai Sendi Perjuangan</h2>
            <p class="text-green-50 text-sm md:text-lg leading-relaxed mb-6 md:mb-8">
                Muktamar menjadi ruang suci tempat gagasan diuji dan amanah dipertanggungjawabkan. Di sanalah kepemimpinan lahir bukan dari ambisi, melainkan dari amanah yang tulus untuk merawat umat.
            </p>
            <div class="inline-block bg-white text-green-800 px-6 py-2.5 md:px-8 md:py-3 rounded-full text-sm md:text-base font-bold shadow-lg">
                Muktamar UKM Kerohanian
            </div>
        </div>
        <div class="hidden md:block absolute top-0 right-0 w-1/3 h-full bg-green-700/50 skew-x-12 transform translate-x-20"></div>
    </div>
</section>

<section class="py-16 md:py-24 text-center px-6 reveal">
    <div class="max-w-3xl mx-auto">
        <p class="text-2xl md:text-4xl font-['Playfair_Display'] italic text-gray-800 mb-6 leading-snug">
            "Dakwah adalah jalan panjang yang indah, selama ia ditempuh dengan keikhlasan."
        </p>
        <p class="text-green-600 font-semibold tracking-widest uppercase text-xs md:text-sm mb-10 md:mb-12">— UKM Kerohanian KBM UNIB</p>
        
        <a href="{{ route('struktur') }}" class="inline-flex items-center gap-2 md:gap-3 px-6 py-3 md:px-10 md:py-4 bg-green-700 text-white rounded-full text-sm md:text-base font-bold shadow-xl hover:bg-green-800 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 group">
            <span>Kenali Struktur Kami</span>
            <svg class="w-4 h-4 md:w-5 md:h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
        </a>
    </div>
</section>

<script>
    // Fungsi untuk memicu animasi saat di-scroll
    document.addEventListener('DOMContentLoaded', function() {
        const observerOptions = {
            threshold: 0.15 // Animasi mulai saat 15% bagian muncul di layar
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.reveal').forEach(el => {
            observer.observe(el);
        });
    });
</script>
@endsection