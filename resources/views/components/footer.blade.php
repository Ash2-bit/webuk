<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<footer x-data="footerComponent()" class="bg-green-950 text-gray-300 pt-8 md:pt-16 pb-6 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-t from-green-950 via-green-900/40 to-transparent pointer-events-none"></div>

    <div class="container mx-auto px-5 md:px-6 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 md:gap-12">
            
            <div class="border-b border-white/10 md:border-none pb-2 md:pb-0">
                <button @click="toggleSection('about')" class="w-full flex justify-between items-center py-2 md:py-0 md:cursor-default focus:outline-none group">
                    <h3 class="font-bold text-white md:mb-6 uppercase tracking-wider text-sm md:text-xl group-hover:text-green-400 transition-colors">Tentang Kami</h3>
                    <span class="md:hidden text-green-500 bg-white/5 p-1.5 rounded-md transition-transform duration-300" :class="openSection === 'about' ? 'rotate-180 bg-green-500/20' : ''">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </span>
                </button>
                <div x-show="window.innerWidth > 768 || openSection === 'about'" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="pb-3 md:pb-0 mt-1 md:mt-0">
                    <p class="text-gray-400 leading-relaxed text-xs md:text-sm text-justify md:text-left">
                        <span class="text-green-400 font-semibold" x-text="companyName"></span> adalah organisasi yang berfokus pada pengembangan spiritual, sosial, dan kegiatan kerohanian di lingkungan Universitas Bengkulu. Kami berkomitmen menciptakan organisasi yang saling mendukung nilai-nilai Islam.
                    </p>
                </div>
            </div>

            <div class="border-b border-white/10 md:border-none pb-2 md:pb-0">
                <button @click="toggleSection('contact')" class="w-full flex justify-between items-center py-2 md:py-0 md:cursor-default focus:outline-none group">
                    <h3 class="font-bold text-white md:mb-6 uppercase tracking-wider text-sm md:text-xl group-hover:text-green-400 transition-colors">Kontak Kami</h3>
                    <span class="md:hidden text-green-500 bg-white/5 p-1.5 rounded-md transition-transform duration-300" :class="openSection === 'contact' ? 'rotate-180 bg-green-500/20' : ''">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </span>
                </button>
                <div x-show="window.innerWidth > 768 || openSection === 'contact'" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="pb-3 md:pb-0 mt-2 md:mt-0">
                    <ul class="space-y-2.5 text-xs md:text-sm">
                        <li>
                            <a :href="'mailto: ' + contact.email" class="flex items-center group hover:text-green-400 transition-colors">
                                <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-white/5 flex items-center justify-center mr-3 group-hover:bg-green-600/20 transition-all flex-shrink-0">
                                    <i class="fa-solid fa-envelope text-green-500 text-xs md:text-base"></i>
                                </div>
                                <span class="break-all" x-text="contact.email"></span>
                            </a>
                        </li>
                        <li>
                            <a :href="'tel:' + contact.phone" class="flex items-center group hover:text-green-400 transition-colors">
                                <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-white/5 flex items-center justify-center mr-3 group-hover:bg-green-600/20 transition-all flex-shrink-0">
                                    <i class="fa-solid fa-phone text-green-500 text-xs md:text-base"></i>
                                </div>
                                <span x-text="contact.phone"></span>
                            </a>
                        </li>
                        <li class="flex items-start">
                            <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-white/5 flex items-center justify-center mr-3 flex-shrink-0">
                                <i class="fa-solid fa-location-dot text-green-500 text-xs md:text-base"></i>
                            </div>
                            <span class="pt-1.5 italic leading-snug" x-text="contact.address"></span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="pt-3 md:pt-0 pb-2 md:pb-0">
                <h3 class="font-bold text-white mb-3 md:mb-6 uppercase tracking-wider text-sm md:text-xl">Lokasi Kami</h3>
                
                <a :href="map.targetUrl" target="_blank" rel="noopener noreferrer"
                   class="block group relative rounded-xl overflow-hidden border border-white/10 hover:border-green-500 transition-all duration-500 shadow-xl shadow-black/20">
                    <img :src="map.imageUrl" alt="Peta lokasi Sekre"
                         class="w-full h-28 md:h-48 object-cover group-hover:scale-110 transition-transform duration-700 brightness-75 group-hover:brightness-100">
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="bg-green-600/90 text-white px-3 py-1.5 rounded-full text-[10px] md:text-xs font-bold flex items-center gap-2 backdrop-blur-sm">
                            <i class="fa-solid fa-map-location-dot"></i> Buka Maps
                        </div>
                    </div>
                </a>

                <div class="mt-5 md:mt-8 flex flex-col items-start">
                    <h4 class="text-[9px] md:text-xs font-bold text-green-500/80 uppercase tracking-[0.2em] mb-2.5 md:mb-4">Temukan Kami di Media Sosial</h4>
                    <div class="flex space-x-2.5 sm:space-x-4">
                        <template x-for="social in socials">
                            <a :href="social.url" target="_blank" rel="noopener noreferrer" class="w-9 h-9 md:w-10 md:h-10 rounded-lg md:rounded-xl bg-white/5 border border-white/5 flex items-center justify-center hover:bg-green-600 hover:border-green-500 hover:text-white hover:-translate-y-1 transition-all duration-300 text-sm md:text-lg">
                                <i :class="social.icon"></i>
                            </a>
                        </template>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 md:mt-12 pt-4 border-t border-white/10 flex flex-col-reverse md:flex-row justify-between items-center text-[10px] md:text-xs text-gray-500 gap-3 text-center md:text-left">
            <p>© <span x-text="copyrightYear"></span> <span x-text="companyName"></span>. <br class="md:hidden">Semua Hak Cipta Dilindungi.</p>
            <div class="flex space-x-4 md:space-x-6">
                <a href="#" class="hover:text-green-500 transition">Kebijakan Privasi</a>
                <span class="text-white/20">|</span>
                <a href="#" class="hover:text-green-500 transition">Syarat & Ketentuan</a>
            </div>
        </div>
    </div>
</footer>

<script>
    function footerComponent() {
        return {
            openSection: window.innerWidth > 768 ? 'all' : '',
            toggleSection(section) {
                if(window.innerWidth <= 768) {
                    this.openSection = this.openSection === section ? '' : section;
                }
            },
            contact: {
                email: 'info@ukmkerohanian.unib.ac.id',
                phone: '+62 812 3456 7890',
                address: 'Gedung PKM UNIB Lt. 2, Universitas Bengkulu, Kota Bengkulu.'
            },
            map: {
                imageUrl: '/peta.png', // Pastikan gambar ini ada di folder public kamu
                targetUrl: 'https://maps.app.goo.gl/EhGX9ZXegc7wRGgv7'
            },
            socials: [
                { icon: 'fa-brands fa-facebook-f', url: 'https://www.facebook.com/share/1936Vb5Cdt/?mibextid=wwXIfr' },
                { icon: 'fa-brands fa-instagram', url: 'https://www.instagram.com/ukmkerohaniankbmunib?igsh=OGFweHVsMXRtaHZn' },
                { icon: 'fa-brands fa-youtube', url: 'https://www.youtube.com/@ukmkerohaniankbmunib' },
                { icon: 'fa-brands fa-tiktok', url: 'https://www.tiktok.com/@ukmkerohaniankbmunib?_t=zs-8upzrwxzy2b&_r=1' }
            ],
            companyName: 'UKM KEROHANIAN KBM UNIB',
            copyrightYear: new Date().getFullYear()
        }
    }
</script>