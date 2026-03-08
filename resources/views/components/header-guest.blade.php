<header
    x-data="{
        open: false,
        scrolled: false,
        current: window.location.pathname,
        loaded: false,
        items: [
            { name: 'Beranda', href: '{{ route('landing') }}' },
            { name: 'Blogs', href: '{{ route('blogs.index') }}' },
            { name: 'Tentang', href: '{{ route('about') }}' },
            { name: 'Kontak', href: '{{ route('kontak') }}' },
            {{-- { name: 'Bacaan', href: '{{ route('bacaan.index') }}' },
            {
                name: 'Lainnya',
                children: [
                    { name: 'Tentang', href: '{{ route('about') }}' },
                    { name: 'Kontak', href: '{{ route('kontak') }}' },
                ]
            }, --}}
        ],
        isActive(href) {
            if (href === '/') return this.current === '/';
            return this.current.startsWith(href);
        }
    }"
    x-init="
        window.addEventListener('scroll', () => { scrolled = window.scrollY > 10 });
        setTimeout(() => loaded = true, 200);
    "
    :class="scrolled ? 'backdrop-blur-md bg-white/90 shadow-md border-b border-green-100/60' : 'bg-white'"
    class="fixed top-0 left-0 w-full z-50 transition-all duration-500"
>

    <div class="max-w-7xl mx-auto flex justify-between items-center px-4 sm:px-6 py-3 sm:py-4">

        <a href="/"
           class="flex items-center space-x-3 group transition-all duration-700"
           :class="loaded ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-5'">
            <img src="{{ asset('logouk.png') }}" class="w-10 h-10 object-contain">
            <span class="text-xl sm:text-2xl font-extrabold text-green-600 group-hover:text-green-500 transition">
                UKM Kerohanian
            </span>
        </a>

        <nav
            class="hidden md:flex items-center space-x-6 lg:space-x-8 font-semibold text-green-700 transition-all duration-700 delay-200"
            :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-3'">

            <template x-for="item in items" :key="item.name">
                <div class="relative flex items-center">

                    <template x-if="!item.children">
                        <a :href="item.href"
                           class="relative py-1 transition group"
                           :class="isActive(item.href) ? 'text-green-600 font-semibold' : 'hover:text-green-500'">
                            <span x-text="item.name"></span>
                            <span class="absolute left-0 bottom-0 h-[2px] bg-gradient-to-r from-green-400 via-amber-300 to-green-400 rounded-full transition-all duration-500"
                                  :class="isActive(item.href) ? 'w-full opacity-100' : 'w-0 opacity-0 group-hover:w-full group-hover:opacity-70'">
                            </span>
                        </a>
                    </template>

                    <template x-if="item.children">
                        <div x-data="{ openDrop: false }" class="relative">
                            <button
                                @click="openDrop = !openDrop"
                                @click.outside="openDrop = false"
                                class="relative py-1 flex items-center gap-1 transition font-semibold text-green-700"
                                :class="(item.children?.some(c => isActive(c.href))) ? 'text-green-600' : 'hover:text-green-500'">
                                <span x-text="item.name"></span>
                                <svg class="w-4 h-4 transition-transform duration-300" :class="openDrop ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>

                            <div x-show="openDrop"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                                 class="absolute top-full left-0 mt-3 w-40 bg-white border border-green-100 rounded-lg shadow-lg overflow-hidden z-50">
                                <template x-for="child in item.children" :key="child.href">
                                    <a :href="child.href"
                                       class="block px-4 py-2 text-sm hover:bg-green-50 hover:text-green-600 transition"
                                       :class="isActive(child.href) ? 'bg-green-50 text-green-600 font-bold' : 'text-gray-700'">
                                        <span x-text="child.name"></span>
                                    </a>
                                </template>
                            </div>
                        </div>
                    </template>

                </div>
            </template>
        </nav>

        <div
            class="hidden md:flex items-center space-x-3"
            :class="loaded ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-5'">
            <a href="{{ route('login.user') }}"
               class="px-4 py-2 bg-green-500 hover:bg-green-400 text-white rounded-lg shadow-sm transition">
                Masuk
            </a>
            <a href="{{ route('register.user') }}"
               class="px-4 py-2 border border-green-500 text-green-600 hover:bg-green-500 hover:text-white rounded-lg transition">
                Daftar
            </a>
        </div>

        <button @click="open = !open"
                class="md:hidden text-green-600 focus:outline-none transition-transform duration-300"
                :class="{ 'rotate-90': open }">
            <svg x-show="!open" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg x-show="open" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <div x-show="open"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="md:hidden bg-white/95 backdrop-blur-md border-t border-green-100 shadow-inner">
        <nav class="flex flex-col space-y-4 py-5 px-6 text-green-700 font-medium">
            <template x-for="item in items" :key="item.name">
                <div class="w-full">
                    <template x-if="!item.children">
                        <a :href="item.href"
                           class="block hover:text-green-500"
                           :class="isActive(item.href) ? 'text-green-600 font-bold' : ''">
                            <span x-text="item.name"></span>
                        </a>
                    </template>

                    <template x-if="item.children">
                        <div x-data="{ openChild: false }" class="space-y-2">
                            <button @click="openChild = !openChild"
                                    class="flex justify-between items-center w-full hover:text-green-500 font-medium">
                                <span x-text="item.name"></span>
                                <svg class="w-4 h-4 transition-transform duration-300" :class="openChild ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="openChild" x-transition class="pl-4 space-y-2 border-l-2 border-green-100 ml-1">
                                <template x-for="child in item.children" :key="child.href">
                                    <a :href="child.href"
                                       class="block hover:text-green-500 text-sm transition"
                                       :class="isActive(child.href) ? 'text-green-600 font-bold' : 'text-gray-600'">
                                        <span x-text="child.name"></span>
                                    </a>
                                </template>
                            </div>
                        </div>
                    </template>
                </div>
            </template>
            <hr class="border-green-100">
            <a href="{{ route('login.user') }}" class="hover:text-green-500">Masuk</a>
            <a href="{{ route('register.user') }}" class="hover:text-green-500 font-bold">Daftar</a>
        </nav>
    </div>
</header>