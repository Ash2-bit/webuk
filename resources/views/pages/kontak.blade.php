@extends(auth()->guard('anggota')->check() ? 'layouts.app' : 'layouts.gust')
@section('content')

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


<section class="pt-32 sm:pt-36 bg-gradient-to-br from-blue-50 via-white to-blue-100 pb-16">

    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center" data-aos="fade-up">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800">
                Hubungi Kami
            </h1>
            <p class="mt-3 text-gray-600 text-lg font-medium">
                Kami selalu siap membantu Anda kapan saja.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-14">

            <div data-aos="zoom-in" data-aos-delay="100"
                class="bg-white shadow-lg rounded-3xl p-8 hover:shadow-2xl transition shadow-blue-200 border border-gray-100">
                <div class="w-16 h-16 flex items-center justify-center rounded-full bg-blue-100 text-blue-600 text-3xl mb-4">
                    📞
                </div>
                <h3 class="text-xl font-semibold text-gray-800">Telepon</h3>
                <p class="mt-3 text-gray-500">(+62) 812 3456 7890</p>
            </div>

            <div data-aos="zoom-in" data-aos-delay="200"
                class="bg-white shadow-lg rounded-3xl p-8 hover:shadow-2xl transition shadow-blue-200 border border-gray-100">
                <div class="w-16 h-16 flex items-center justify-center rounded-full bg-green-100 text-green-600 text-3xl mb-4">
                    📧
                </div>
                <h3 class="text-xl font-semibold text-gray-800">Email</h3>
                <p class="mt-3 text-gray-500">ukmkerohanian@gmail.com</p>
            </div>

            <div data-aos="zoom-in" data-aos-delay="300"
                class="bg-white shadow-lg rounded-3xl p-8 hover:shadow-2xl transition shadow-blue-200 border border-gray-100">
                <div class="w-16 h-16 flex items-center justify-center rounded-full bg-purple-100 text-purple-600 text-3xl mb-4">
                    📍
                </div>
                <h3 class="text-xl font-semibold text-gray-800">Alamat</h3>
                <p class="mt-3 text-gray-500">Universitas Bengkulu, Gedung UKM</p>
            </div>

        </div>
    </div>

</section>


<section class="py-16 bg-gradient-to-b from-white to-blue-50">
    <div class="max-w-4xl mx-auto text-center" data-aos="fade-up">
        <h2 class="text-3xl font-bold text-gray-800 mb-3">
            Ikuti Sosial Media Kami
        </h2>
        <p class="text-gray-600 mb-10">
            Tetap terhubung untuk update terbaru dan informasi kegiatan.
        </p>

        <div class="flex items-center justify-center gap-6 md:gap-10">
            <a href="https://www.instagram.com/ukmkerohaniankbmunib?igsh=OGFweHVsMXRtaHZn" target="_blank"
                class="w-14 h-14 md:w-16 md:h-16 bg-white shadow-xl border hover:shadow-2xl hover:bg-pink-50
                border-gray-200 rounded-2xl flex items-center justify-center transition transform hover:-translate-y-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-pink-600" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M7.75 2h8.5A5.75 5.75 0 0122 7.75v8.5A5.75 5.75 0 0116.25 22h-8.5A5.75 5.75 0 012 16.25v-8.5A5.75 5.75 0 017.75 2zm8.5 4.25h.008v.008H16.25V6.25zm-4.25 2a4 4 0 110 8 4 4 0 010-8z" />
                </svg>
            </a>

            <a href="https://www.facebook.com/share/1936Vb5Cdt/?mibextid=wwXIfr" target="_blank"
                class="w-14 h-14 md:w-16 md:h-16 bg-white shadow-xl border hover:shadow-2xl hover:bg-blue-50
                border-gray-200 rounded-2xl flex items-center justify-center transition transform hover:-translate-y-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-blue-700" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M22 12.07C22 6.51 17.52 2 12 2S2 6.51 2 12.07c0 5.01 3.66 9.16 8.44 9.93v-7.03H7.9v-2.9h2.53V9.41c0-2.5 1.5-3.89 3.78-3.89 1.1 0 2.24.2 2.24.2v2.46H15.3c-1.27 0-1.67.79-1.67 1.6v1.92h2.84l-.45 2.9h-2.39V22c4.78-.77 8.44-4.92 8.44-9.93z">
                    </path>
                </svg>
            </a>

            <a href="https://www.youtube.com/@ukmkerohaniankbmunib" target="_blank"
                class="w-14 h-14 md:w-16 md:h-16 bg-white shadow-xl border hover:shadow-2xl hover:bg-red-50
                border-gray-200 rounded-2xl flex items-center justify-center transition transform hover:-translate-y-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-red-600" fill="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        d="M21.8 8.001s-.2-1.4-.8-2c-.8-.9-1.7-.9-2.1-1C15.9 4.8 12 4.8 12 4.8h-.1s-3.9 0-6.9.2c-.5.1-1.4.1-2.1 1-.6.6-.8 2-.8 2S2 9.4 2 10.8v1.3c0 1.4.2 2.8.2 2.8s.2 1.4.8 2c.8.9 1.9.9 2.4 1 1.8.2 6.6.3 6.6.3s3.9 0 6.9-.2c.5-.1 1.4-.1 2.1-1 .6-.6.8-2 .8-2s.2-1.4.2-2.8v-1.3c0-1.4-.2-2.8-.2-2.8zM10 14.2V8.8l5.2 2.7-5.2 2.7z" />
                </svg>
            </a>

            <a href="https://www.tiktok.com/@ukmkerohaniankbmunib?_t=zs-8upzrwxzy2b&_r=1" target="_blank"
                class="w-14 h-14 md:w-16 md:h-16 bg-white shadow-xl border hover:shadow-2xl hover:bg-gray-100
                border-gray-200 rounded-2xl flex items-center justify-center transition transform hover:-translate-y-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-gray-800" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M12.35 2h3.37c.17 1.7 1.33 3.17 3 3.6v3.27c-1.1.05-2.17-.23-3.12-.78v6.54a6.36 6.36 0 11-6.36-6.36c.4 0 .78.05 1.14.14v3.44a2.77 2.77 0 102. - .08V2z" />
                </svg>
            </a>
        </div>
    </div>
</section>


<section class="py-20 bg-white" id="contact-section">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <div data-aos="fade-right">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">
                    Kirim Pesan
                </h2>
                <p class="text-gray-600 mb-8">
                    Silakan tinggalkan pesan, kami terima keritikan dan saran dengan senang hati.
                </p>

                {{-- Alert Sukses (Muncul setelah pesan terkirim) --}}
                @if(session('success'))
                    <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 flex items-center gap-3 animate-bounce">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                    @csrf {{-- Token Keamanan Wajib --}}

                    {{-- Input Nama --}}
                    <div>
                        <label class="block text-sm font-semibold mb-1 text-gray-700">Nama Lengkap</label>
                        <input type="text" 
                               name="nama" 
                               value="{{ old('nama') }}"
                               placeholder="Contoh: Budi Santoso"
                               required
                               class="w-full px-4 py-3 border rounded-xl shadow-sm focus:ring-2 focus:ring-blue-400 outline-none transition-all @error('nama') border-red-500 ring-1 ring-red-500 @enderror">
                        
                        {{-- Pesan Error Validasi --}}
                        @error('nama')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Input Email --}}
                    <div>
                        <label class="block text-sm font-semibold mb-1 text-gray-700">Email</label>
                        <input type="email" 
                               name="email"
                               value="{{ old('email') }}"
                               placeholder="nama@email.com"
                               required
                               class="w-full px-4 py-3 border rounded-xl shadow-sm focus:ring-2 focus:ring-blue-400 outline-none transition-all @error('email') border-red-500 ring-1 ring-red-500 @enderror">
                        
                        @error('email')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Input Pesan --}}
                    <div>
                        <label class="block text-sm font-semibold mb-1 text-gray-700">Pesan</label>
                        <textarea rows="5" 
                                  name="pesan"
                                  placeholder="Tulis pesan Anda di sini..."
                                  required
                                  class="w-full px-4 py-3 border rounded-xl shadow-sm focus:ring-2 focus:ring-blue-400 outline-none transition-all @error('pesan') border-red-500 ring-1 ring-red-500 @enderror">{{ old('pesan') }}</textarea>
                        
                        @error('pesan')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tombol Submit --}}
                    <button type="submit"
                        class="px-8 py-3 bg-blue-600 text-white rounded-xl text-lg font-semibold shadow-lg hover:bg-blue-700 hover:shadow-xl transition-all transform hover:-translate-y-1 w-full md:w-auto">
                        Kirim Pesan
                    </button>
                </form>
            </div>

            <div data-aos="fade-left">
                <img src="{{ asset('c.png') }}"
                     class="w-full drop-shadow-xl hover:scale-105 transition-transform duration-500" 
                     alt="Contact Illustration">
            </div>

        </div>
    </div>
</section>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 900,
        once: true,
    });
</script>

@endsection@extends(auth()->guard('anggota')->check() ? 'layouts.app' : 'layouts.gust')
@section('content')

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<section class="pt-24 sm:pt-36 bg-gradient-to-br from-blue-50 via-white to-blue-100 pb-12 sm:pb-16">

    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center" data-aos="fade-up">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-gray-800">
                Hubungi Kami
            </h1>
            <p class="mt-3 text-gray-600 text-base sm:text-lg font-medium">
                Kami selalu siap membantu Anda kapan saja.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8 mt-10 sm:mt-14">

            <div data-aos="zoom-in" data-aos-delay="100"
                class="bg-white shadow-lg rounded-3xl p-6 sm:p-8 hover:shadow-2xl transition shadow-blue-200 border border-gray-100">
                <div class="w-14 h-14 sm:w-16 sm:h-16 flex items-center justify-center rounded-full bg-blue-100 text-blue-600 text-2xl sm:text-3xl mb-4">
                    📞
                </div>
                <h3 class="text-lg sm:text-xl font-semibold text-gray-800">Telepon</h3>
                <p class="mt-2 sm:mt-3 text-sm sm:text-base text-gray-500">(+62) 812 3456 7890</p>
            </div>

            <div data-aos="zoom-in" data-aos-delay="200"
                class="bg-white shadow-lg rounded-3xl p-6 sm:p-8 hover:shadow-2xl transition shadow-blue-200 border border-gray-100">
                <div class="w-14 h-14 sm:w-16 sm:h-16 flex items-center justify-center rounded-full bg-green-100 text-green-600 text-2xl sm:text-3xl mb-4">
                    📧
                </div>
                <h3 class="text-lg sm:text-xl font-semibold text-gray-800">Email</h3>
                <p class="mt-2 sm:mt-3 text-sm sm:text-base text-gray-500">ukmkerohanian@gmail.com</p>
            </div>

            <div data-aos="zoom-in" data-aos-delay="300"
                class="bg-white shadow-lg rounded-3xl p-6 sm:p-8 hover:shadow-2xl transition shadow-blue-200 border border-gray-100">
                <div class="w-14 h-14 sm:w-16 sm:h-16 flex items-center justify-center rounded-full bg-purple-100 text-purple-600 text-2xl sm:text-3xl mb-4">
                    📍
                </div>
                <h3 class="text-lg sm:text-xl font-semibold text-gray-800">Alamat</h3>
                <p class="mt-2 sm:mt-3 text-sm sm:text-base text-gray-500">Universitas Bengkulu, Gedung UKM</p>
            </div>

        </div>
    </div>

</section>


<section class="py-12 sm:py-16 bg-gradient-to-b from-white to-blue-50">
    <div class="max-w-4xl mx-auto text-center px-4" data-aos="fade-up">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-3">
            Ikuti Sosial Media Kami
        </h2>
        <p class="text-gray-600 mb-8 sm:mb-10 text-sm sm:text-base">
            Tetap terhubung untuk update terbaru dan informasi kegiatan.
        </p>

        <div class="flex flex-wrap items-center justify-center gap-4 sm:gap-6 md:gap-10">
            <a href="https://www.instagram.com/ukmkerohaniankbmunib?igsh=OGFweHVsMXRtaHZn" target="_blank"
                class="w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 bg-white shadow-xl border hover:shadow-2xl hover:bg-pink-50
                border-gray-200 rounded-2xl flex items-center justify-center transition transform hover:-translate-y-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 sm:w-7 sm:h-7 text-pink-600" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M7.75 2h8.5A5.75 5.75 0 0122 7.75v8.5A5.75 5.75 0 0116.25 22h-8.5A5.75 5.75 0 012 16.25v-8.5A5.75 5.75 0 017.75 2zm8.5 4.25h.008v.008H16.25V6.25zm-4.25 2a4 4 0 110 8 4 4 0 010-8z" />
                </svg>
            </a>

            <a href="https://www.facebook.com/share/1936Vb5Cdt/?mibextid=wwXIfr" target="_blank"
                class="w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 bg-white shadow-xl border hover:shadow-2xl hover:bg-blue-50
                border-gray-200 rounded-2xl flex items-center justify-center transition transform hover:-translate-y-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 sm:w-7 sm:h-7 text-blue-700" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M22 12.07C22 6.51 17.52 2 12 2S2 6.51 2 12.07c0 5.01 3.66 9.16 8.44 9.93v-7.03H7.9v-2.9h2.53V9.41c0-2.5 1.5-3.89 3.78-3.89 1.1 0 2.24.2 2.24.2v2.46H15.3c-1.27 0-1.67.79-1.67 1.6v1.92h2.84l-.45 2.9h-2.39V22c4.78-.77 8.44-4.92 8.44-9.93z">
                    </path>
                </svg>
            </a>

            <a href="https://www.youtube.com/@ukmkerohaniankbmunib" target="_blank"
                class="w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 bg-white shadow-xl border hover:shadow-2xl hover:bg-red-50
                border-gray-200 rounded-2xl flex items-center justify-center transition transform hover:-translate-y-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 sm:w-7 sm:h-7 text-red-600" fill="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        d="M21.8 8.001s-.2-1.4-.8-2c-.8-.9-1.7-.9-2.1-1C15.9 4.8 12 4.8 12 4.8h-.1s-3.9 0-6.9.2c-.5.1-1.4.1-2.1 1-.6.6-.8 2-.8 2S2 9.4 2 10.8v1.3c0 1.4.2 2.8.2 2.8s.2 1.4.8 2c.8.9 1.9.9 2.4 1 1.8.2 6.6.3 6.6.3s3.9 0 6.9-.2c.5-.1 1.4-.1 2.1-1 .6-.6.8-2 .8-2s.2-1.4.2-2.8v-1.3c0-1.4-.2-2.8-.2-2.8zM10 14.2V8.8l5.2 2.7-5.2 2.7z" />
                </svg>
            </a>

            <a href="https://www.tiktok.com/@ukmkerohaniankbmunib?_t=zs-8upzrwxzy2b&_r=1" target="_blank"
                class="w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 bg-white shadow-xl border hover:shadow-2xl hover:bg-gray-100
                border-gray-200 rounded-2xl flex items-center justify-center transition transform hover:-translate-y-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 sm:w-7 sm:h-7 text-gray-800" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M12.35 2h3.37c.17 1.7 1.33 3.17 3 3.6v3.27c-1.1.05-2.17-.23-3.12-.78v6.54a6.36 6.36 0 11-6.36-6.36c.4 0 .78.05 1.14.14v3.44a2.77 2.77 0 102. - .08V2z" />
                </svg>
            </a>
        </div>
    </div>
</section>


<section class="py-12 lg:py-20 bg-white" id="contact-section">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-12 items-center">

            <div data-aos="fade-left" class="order-1 lg:order-2 flex justify-center">
                <img src="{{ asset('c.png') }}"
                     class="w-3/4 sm:w-2/3 lg:w-full drop-shadow-xl hover:scale-105 transition-transform duration-500" 
                     alt="Contact Illustration">
            </div>

            <div data-aos="fade-right" class="order-2 lg:order-1">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-4 sm:mb-6 text-center lg:text-left">
                    Kirim Pesan
                </h2>
                <p class="text-gray-600 mb-6 sm:mb-8 text-sm sm:text-base text-center lg:text-left">
                    Silakan tinggalkan pesan, kami terima kritikan dan saran dengan senang hati.
                </p>

                {{-- Alert Sukses --}}
                @if(session('success'))
                    <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 flex items-center gap-3 animate-bounce">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="font-medium text-sm sm:text-base">{{ session('success') }}</span>
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-4 sm:space-y-5">
                    @csrf

                    <div>
                        <label class="block text-sm font-semibold mb-1 text-gray-700">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Contoh: Budi Santoso" required
                               class="w-full px-4 py-3 border rounded-xl shadow-sm focus:ring-2 focus:ring-blue-400 outline-none transition-all text-sm sm:text-base @error('nama') border-red-500 ring-1 ring-red-500 @enderror">
                        @error('nama')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-1 text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required
                               class="w-full px-4 py-3 border rounded-xl shadow-sm focus:ring-2 focus:ring-blue-400 outline-none transition-all text-sm sm:text-base @error('email') border-red-500 ring-1 ring-red-500 @enderror">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-1 text-gray-700">Pesan</label>
                        <textarea rows="5" name="pesan" placeholder="Tulis pesan Anda di sini..." required
                                  class="w-full px-4 py-3 border rounded-xl shadow-sm focus:ring-2 focus:ring-blue-400 outline-none transition-all text-sm sm:text-base @error('pesan') border-red-500 ring-1 ring-red-500 @enderror">{{ old('pesan') }}</textarea>
                        @error('pesan')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="px-8 py-3 bg-blue-600 text-white rounded-xl text-base sm:text-lg font-semibold shadow-lg hover:bg-blue-700 hover:shadow-xl transition-all transform hover:-translate-y-1 w-full">
                        Kirim Pesan
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 900,
        once: true,
    });
</script>

@endsection