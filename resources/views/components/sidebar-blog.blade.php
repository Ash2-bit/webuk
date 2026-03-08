<div class="w-full bg-white rounded-2xl shadow-md p-6">

    <!-- Header -->
    <div class="mb-5">
        <h2 class="text-lg font-bold text-gray-900 tracking-wide uppercase">
            Terbaru
        </h2>
        <div class="w-10 h-1 bg-gradient-to-r from-emerald-400 to-yellow-400 rounded-full mt-2"></div>
    </div>

    <!-- List -->
    <div class="space-y-5">

        @foreach($latest as $index => $item)
            <a href="{{ route('blogs.detail', $item->slug) }}"
               class="group flex items-start gap-4">

                <!-- Thumbnail -->
                <div class="relative shrink-0">
                    <img src="{{ asset('storage/' . $item->gambar) }}"
                         class="w-24 h-20 object-cover rounded-xl shadow-sm
                                group-hover:scale-105 transition duration-300">

                    <!-- Number badge -->
                    <span class="absolute -top-2 -left-2 w-6 h-6 rounded-full
                                 bg-emerald-500 text-white text-xs font-bold
                                 flex items-center justify-center shadow">
                        {{ $index + 1 }}
                    </span>
                </div>

                <!-- Content -->
                <div class="flex-1">
                    <p class="text-sm font-semibold text-gray-800 leading-snug
                              group-hover:text-emerald-600 transition
                              line-clamp-2">
                        {{ $item->judul }}
                    </p>

                    <div class="text-xs text-gray-500 mt-1 flex flex-wrap gap-1">
                        <span class="text-emerald-600 font-medium">
                            {{ $item->kategori->nama ?? 'Artikel' }}
                        </span>
                        <span>•</span>
                        <span>{{ $item->created_at->diffForHumans() }}</span>
                    </div>
                </div>

            </a>
        @endforeach

    </div>

</div>
