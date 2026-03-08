@extends(auth()->guard('anggota')->check() ? 'layouts.app' : 'layouts.gust')


@section('content')
<div class="bg-gray-50 min-h-screen">
    {{-- Header Section --}}
    <header class="pt-32 pb-12 bg-white border-b border-gray-100">
        <div class="container mx-auto px-4 lg:max-w-4xl text-center">
            <nav class="mb-6 flex justify-center items-center gap-2 text-sm font-bold text-indigo-600 uppercase tracking-widest">
                <a href="{{ url('/') }}" class="hover:text-indigo-800 transition">Beranda</a>
                <span class="text-gray-300">/</span>
                <a href="{{ route('blogs.index') }}" class="hover:text-indigo-800 transition">Blog</a>
            </nav>
            
            <h1 class="text-3xl md:text-5xl font-black text-gray-900 leading-tight mb-6 tracking-tight">
                {{ $blog->judul }}
            </h1>

            <div class="flex flex-wrap justify-center items-center gap-4 text-gray-500 text-sm font-medium">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xs">
                        {{ substr($blog->penulis, 0, 1) }}
                    </div>
                    <span class="text-gray-800 font-bold">{{ $blog->penulis }}</span>
                </div>
                <span class="hidden md:inline text-gray-300">•</span>
                <time datetime="{{ $blog->created_at }}">{{ $blog->created_at->format('d M Y') }}</time>
            </div>
        </div>
    </header>

    <section class="py-16">
        <div class="container mx-auto px-4 lg:max-w-6xl">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

                {{-- KONTEN UTAMA BLOG (Sisi Kiri) --}}
                <div class="lg:col-span-8 space-y-12">
                    <article>
                        @if($blog->gambar)
                            <div class="relative mb-12 group">
                                <div class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-3xl blur opacity-25 group-hover:opacity-40 transition duration-1000"></div>
                                <img src="{{ asset('storage/' . $blog->gambar) }}"
                                     alt="{{ $blog->judul }}" 
                                     class="relative w-full rounded-3xl shadow-2xl object-cover max-h-[500px]">
                            </div>
                        @endif

                        <div class="bg-white p-8 md:p-12 rounded-3xl shadow-sm border border-gray-100">
                            <div class="prose prose-lg prose-indigo max-w-none text-gray-700 leading-relaxed">
                                {!! $blog->konten !!}
                            </div>
                        </div>
                    </article>

                    {{-- BAGIAN KOMENTAR --}}
                    <div class="bg-white p-8 md:p-12 rounded-3xl shadow-sm border border-gray-100">
                        <h3 class="text-2xl font-black text-gray-900 mb-8 flex items-center gap-3">
                            Komentar 
                            {{-- Dinamis: Menghitung jumlah komentar --}}
                            <span class="bg-indigo-100 text-indigo-600 text-sm px-3 py-1 rounded-full">{{ $blog->comments->count() }}</span>
                        </h3>

                        <form action="{{ route('blogs.comment.store', $blog->id) }}" method="POST" class="mb-12 space-y-4">
                            @csrf
                            @if(session('success'))
                                <div class="p-4 mb-4 text-sm text-green-800 rounded-2xl bg-green-50 font-bold">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <input type="text" name="nama" placeholder="Nama Lengkap" class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 transition outline-none" required>
                                <input type="email" name="email" placeholder="Email" class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 transition outline-none" required>
                            </div>
                            <textarea name="komentar" rows="4" placeholder="Tuliskan komentar Anda..." class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 transition outline-none" required></textarea>
                            <div class="flex justify-end">
                                <button type="submit" class="px-8 py-4 bg-indigo-600 text-white rounded-2xl font-black text-sm hover:bg-indigo-700 shadow-lg transition transform active:scale-95">
                                    Kirim Komentar
                                </button>
                            </div>
                        </form>

                        <div class="space-y-8">
                            @forelse($blog->comments as $comment)
                                <div class="flex gap-4 p-6 bg-gray-50 rounded-2xl">
                                    <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-bold shrink-0">
                                        {{ substr($comment->nama, 0, 1) }}
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900">{{ $comment->nama }}</h4>
                                        <p class="text-xs text-gray-400 mb-2">{{ $comment->created_at->diffForHumans() }}</p>
                                        <p class="text-gray-600 text-sm leading-relaxed">{{ $comment->komentar }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-10">
                                    <p class="text-gray-400 italic">Belum ada diskusi di sini. Jadilah yang pertama!</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div> {{-- TUTUP lg:col-span-8 --}}

                {{-- SIDEBAR (Sisi Kanan) --}}
                <aside class="lg:col-span-4">
                    <div class="sticky top-28 space-y-8">
                        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
                            <h4 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-6 border-l-4 border-indigo-600 pl-4">Artikel Menarik</h4>
                            <x-sidebar-blog />
                        </div>
                    </div>
                </aside>

            </div> {{-- TUTUP grid --}}
        </div> {{-- TUTUP container --}}
    </section>
</div>
@endsection