<div x-data="{ open: window.innerWidth >= 1024 }" 
     x-init="window.addEventListener('resize', () => open = window.innerWidth >= 1024)"
     class="relative flex">

    <button 
        @click="open = !open"
        class="fixed top-5 left-5 z-50 text-white bg-indigo-600/90 backdrop-blur-sm p-2.5 rounded-xl shadow-lg lg:hidden transition-all duration-300 hover:bg-indigo-700 focus:outline-none ring-1 ring-white/20">
        <template x-if="!open">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </template>
        <template x-if="open">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </template>
    </button>

    <div 
        x-show="open && window.innerWidth < 1024"
        x-transition.opacity
        @click="open = false"
        class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40 lg:hidden">
    </div>

    <aside 
        x-show="open"
        x-transition:enter="transition transform duration-300 ease-out"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition transform duration-300 ease-in"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed lg:static inset-y-0 left-0 z-50 bg-gradient-to-b from-indigo-700 to-indigo-900 text-white w-72 flex flex-col h-screen shadow-2xl rounded-r-2xl overflow-hidden transition-transform duration-300 border-r border-indigo-500/30">

        <div class="h-24 flex items-center justify-center px-6 border-b border-white/10 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full bg-white/5 backdrop-blur-md z-0"></div>
            
            <a href="/" class="relative z-10 flex items-center gap-4 w-full group">
                <div class="p-1 bg-white/10 rounded-full group-hover:bg-white/20 transition-colors duration-300 ring-1 ring-white/20">
                    <img src="{{ asset('logouk.png') }}" alt="Logo Organisasi" class="w-12 h-12 rounded-full object-cover">
                </div>
                <div class="flex flex-col">
                    <span class="text-sm font-bold tracking-widest text-white uppercase drop-shadow-sm">UKM Kerohanian</span>
                    <span class="text-[10px] text-indigo-300 tracking-wider">Panel Admin</span>
                </div>
            </a>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto scrollbar-thin scrollbar-thumb-indigo-500 scrollbar-track-transparent">
            <h3 class="px-3 text-[11px] font-bold text-indigo-300/80 uppercase tracking-[0.2em] mb-4 mt-2">Menu Utama</h3>

            <a href="{{ route('admin.dashboard') }}" 
               class="group flex items-center gap-4 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300 relative {{ request()->routeIs('admin.dashboard') ? 'bg-white/15 text-white shadow-sm after:absolute after:left-0 after:top-2 after:bottom-2 after:w-1 after:bg-white after:rounded-r-md' : 'text-indigo-200 hover:bg-white/10 hover:text-white hover:translate-x-1' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-transform duration-300 group-hover:scale-110 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-indigo-300 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="7" height="18" x="3" y="3" rx="1"/>
                    <rect width="7" height="7" x="14" y="3" rx="1"/>
                    <rect width="7" height="7" x="14" y="14" rx="1"/>
                </svg>
                <span class="whitespace-nowrap">Dashboard</span>
            </a>
            
            <a href="{{ route('admin.keuangan.index') }}" 
               class="group flex items-center gap-4 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300 relative {{ request()->routeIs('admin.keuangan.*') ? 'bg-white/15 text-white shadow-sm after:absolute after:left-0 after:top-2 after:bottom-2 after:w-1 after:bg-white after:rounded-r-md' : 'text-indigo-200 hover:bg-white/10 hover:text-white hover:translate-x-1' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-transform duration-300 group-hover:scale-110 {{ request()->routeIs('admin.keuangan.*') ? 'text-white' : 'text-indigo-300 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" x2="12" y1="2" y2="22"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                </svg>
                <span class="whitespace-nowrap">Keuangan</span>
            </a>

            <a href="{{ route('admin.documents.index') }}" 
               class="group flex items-center gap-4 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300 relative {{ request()->routeIs('admin.documents.*') ? 'bg-white/15 text-white shadow-sm after:absolute after:left-0 after:top-2 after:bottom-2 after:w-1 after:bg-white after:rounded-r-md' : 'text-indigo-200 hover:bg-white/10 hover:text-white hover:translate-x-1' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-transform duration-300 group-hover:scale-110 {{ request()->routeIs('admin.documents.*') ? 'text-white' : 'text-indigo-300 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20"/>
                    <path d="M8 11h8"/><path d="M8 7h6"/>
                </svg>
                <span class="whitespace-nowrap">Dokumen</span>
            </a>

            <a href="{{ route('admin.anggota.index') }}" 
               class="group flex items-center gap-4 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300 relative {{ request()->routeIs('admin.anggota.*') ? 'bg-white/15 text-white shadow-sm after:absolute after:left-0 after:top-2 after:bottom-2 after:w-1 after:bg-white after:rounded-r-md' : 'text-indigo-200 hover:bg-white/10 hover:text-white hover:translate-x-1' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-transform duration-300 group-hover:scale-110 {{ request()->routeIs('admin.anggota.*') ? 'text-white' : 'text-indigo-300 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 13a3 3 0 1 0-6 0"/>
                    <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20"/>
                    <circle cx="12" cy="8" r="2"/>
                </svg>
                <span class="whitespace-nowrap">Anggota</span>
            </a>

            <a href="{{ route('admin.inventaris.index') }}" 
               class="group flex items-center gap-4 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300 relative {{ request()->routeIs('admin.inventaris.*') ? 'bg-white/15 text-white shadow-sm after:absolute after:left-0 after:top-2 after:bottom-2 after:w-1 after:bg-white after:rounded-r-md' : 'text-indigo-200 hover:bg-white/10 hover:text-white hover:translate-x-1' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-transform duration-300 group-hover:scale-110 {{ request()->routeIs('admin.inventaris.*') ? 'text-white' : 'text-indigo-300 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
                    <line x1="12" y1="22.08" x2="12" y2="12"/>
                </svg>
                <span class="whitespace-nowrap">Inventaris</span>
            </a>

            <a href="{{ route('admin.materi.index') }}" 
               class="group flex items-center gap-4 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300 relative {{ request()->routeIs('admin.materi.*') ? 'bg-white/15 text-white shadow-sm after:absolute after:left-0 after:top-2 after:bottom-2 after:w-1 after:bg-white after:rounded-r-md' : 'text-indigo-200 hover:bg-white/10 hover:text-white hover:translate-x-1' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-transform duration-300 group-hover:scale-110 {{ request()->routeIs('admin.materi.*') ? 'text-white' : 'text-indigo-300 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                <span class="whitespace-nowrap">Materi Islami</span>
            </a>

            <a href="{{ route('admin.blogs.index') }}" 
               class="group flex items-center gap-4 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300 relative {{ request()->routeIs('admin.blogs.*') ? 'bg-white/15 text-white shadow-sm after:absolute after:left-0 after:top-2 after:bottom-2 after:w-1 after:bg-white after:rounded-r-md' : 'text-indigo-200 hover:bg-white/10 hover:text-white hover:translate-x-1' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-transform duration-300 group-hover:scale-110 {{ request()->routeIs('admin.blogs.*') ? 'text-white' : 'text-indigo-300 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="3" rx="2" ry="2"/>
                    <line x1="3" y1="9" x2="21" y2="9"/>
                    <line x1="9" y1="21" x2="9" y2="9"/>
                </svg>
                <span class="whitespace-nowrap">Berita & Blog</span>
            </a>

            <a href="{{ route('admin.cabinets.index') }}" 
               class="group flex items-center gap-4 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300 relative {{ request()->routeIs('admin.cabinets.*') ? 'bg-white/15 text-white shadow-sm after:absolute after:left-0 after:top-2 after:bottom-2 after:w-1 after:bg-white after:rounded-r-md' : 'text-indigo-200 hover:bg-white/10 hover:text-white hover:translate-x-1' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-transform duration-300 group-hover:scale-110 {{ request()->routeIs('admin.cabinets.*') ? 'text-white' : 'text-indigo-300 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                    <rect width="20" height="14" x="2" y="6" rx="2"/>
                </svg>
                <span class="whitespace-nowrap">Struktur Kabinet</span>
            </a>
        </nav>

        <div class="mt-auto p-4 border-t border-white/10 bg-indigo-900/30">
            <div x-data="{ openMenu: false }" class="relative">
                <button @click="openMenu = !openMenu" class="w-full flex items-center gap-3 p-2.5 rounded-xl bg-white/5 hover:bg-white/10 border border-transparent hover:border-white/10 transition-all duration-300 focus:outline-none">
                    <div class="h-9 w-9 rounded-full bg-gradient-to-tr from-indigo-400 to-purple-400 flex items-center justify-center text-sm font-bold shadow-inner ring-2 ring-white/20">A</div>
                    <div class="flex-1 min-w-0 text-left">
                        <p class="text-sm font-semibold text-white truncate">Petugas</p>
                        <span class="text-xs text-indigo-300 block truncate">Administrator Utama</span>
                    </div>
                    <svg class="h-5 w-5 text-indigo-300 transition-transform duration-300" 
                         :class="{'rotate-180': openMenu}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                    </svg>
                </button>
                
                <div x-show="openMenu"
                     @click.away="openMenu = false"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 translate-y-2"
                     class="absolute bottom-full mb-3 left-0 w-full bg-white text-slate-700 border border-slate-100 rounded-xl shadow-2xl z-10 overflow-hidden ring-1 ring-black/5">
                    
                    <a href="{{ route('admin.manage.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-medium hover:bg-indigo-50 hover:text-indigo-700 transition-colors">
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>Pengaturan Akun</span>
                    </a>

                    <div class="h-px bg-slate-100"></div>

                    <form method="POST" action="{{ route('logout.admin') }}" class="w-full m-0">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm font-medium text-red-600 hover:bg-red-50 transition-colors text-left">
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                            </svg>
                            <span>Keluar Sistem</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </aside>
</div>