@extends('layouts.admin')

@section('content')
<div class="p-6" x-data="blogManager()" x-cloak>
    
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Manajemen Blog</h1>
            <p class="text-sm text-gray-500 font-medium">Kelola artikel blog Anda dengan tampilan profesional.</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.blogs.pdf') }}" target="_blank" class="bg-red-500 hover:bg-red-600 text-white px-5 py-2.5 rounded-xl shadow-lg shadow-red-200 font-semibold transition-all transform active:scale-95 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Export PDF
            </a>
            <button @click="openCreateModal()" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl shadow-lg shadow-indigo-200 font-semibold transition-all transform active:scale-95 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tulis Blog
            </button>
        </div>
    </div>

    @php
        $totalBlogs = count($blogs);
        $blogsBulanIni = collect($blogs)->filter(function($item) {
            return \Carbon\Carbon::parse($item->created_at)->isCurrentMonth();
        })->count();
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm transition hover:shadow-md text-center md:text-left">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Total Keseluruhan Blog</p>
            <p class="text-2xl font-extrabold text-indigo-600">{{ $totalBlogs }} <span class="text-sm text-gray-400 font-medium">Artikel</span></p>
        </div>
        <div class="bg-indigo-600 p-6 rounded-2xl shadow-lg shadow-indigo-100 text-center md:text-left">
            <p class="text-xs font-bold text-indigo-200 uppercase tracking-widest mb-1">Ditulis Bulan Ini</p>
            <p class="text-2xl font-extrabold text-white">{{ $blogsBulanIni }} <span class="text-sm text-indigo-200 font-medium">Artikel Baru</span></p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
            <div class="md:col-span-2">
                <label class="block text-xs font-bold text-gray-500 mb-2 uppercase">Pencarian Artikel</label>
                <input type="text" x-model="search" placeholder="Cari judul atau penulis..." class="w-full bg-gray-50 border-none rounded-xl p-3 text-sm focus:ring-2 focus:ring-indigo-500 transition outline-none">
            </div>
            <div class="flex gap-2">
                <button class="bg-gray-900 text-white px-5 py-3 rounded-xl text-sm font-bold hover:bg-black transition flex-1">Cari</button>
                <button @click="search = ''" class="bg-gray-100 text-gray-500 px-5 py-3 rounded-xl text-sm font-bold hover:bg-gray-200 transition text-center">Reset</button>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden overflow-x-auto">
        <table class="w-full text-left min-w-[800px]">
            <thead class="bg-gray-50/80 border-b border-gray-100">
                <tr>
                    <th class="p-4 text-xs font-bold text-gray-400 uppercase tracking-tighter w-16 text-center">Cover</th>
                    <th class="p-4 text-xs font-bold text-gray-400 uppercase tracking-tighter">Judul Blog</th>
                    <th class="p-4 text-xs font-bold text-gray-400 uppercase tracking-tighter">Penulis</th>
                    <th class="p-4 text-xs font-bold text-gray-400 uppercase tracking-tighter text-center">Komentar</th>
                    <th class="p-4 text-xs font-bold text-gray-400 uppercase tracking-tighter text-center">Opsi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($blogs as $blog)
                <tr class="hover:bg-gray-50/50 transition" x-show="'{{ strtolower($blog->judul) }}'.includes(search.toLowerCase()) || '{{ strtolower($blog->penulis) }}'.includes(search.toLowerCase())">
                    <td class="p-4 text-center">
                        <div class="w-16 h-12 mx-auto rounded-lg overflow-hidden bg-gray-100 border border-gray-200">
                            @if($blog->gambar)
                                <img src="{{ asset('storage/'.$blog->gambar) }}" alt="{{ $blog->judul }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-[10px] text-gray-400">N/A</div>
                            @endif
                        </div>
                    </td>
                    <td class="p-4">
                        <div class="text-sm font-bold text-gray-800">{{ $blog->judul }}</div>
                        <div class="text-[11px] font-medium text-gray-400 mt-1">{{ \Carbon\Carbon::parse($blog->created_at)->translatedFormat('d M Y') }}</div>
                    </td>
                    <td class="p-4">
                        <div class="text-sm text-gray-600 font-medium">{{ $blog->penulis }}</div>
                    </td>
                    <td class="p-4 text-center">
                        <span class="inline-block px-3 py-1 rounded-lg text-xs font-black bg-blue-50 text-blue-600">
                            {{ count($blog->comments) }}
                        </span>
                    </td>
                    <td class="p-4">
                        <div class="flex justify-center items-center gap-2">
                            <button @click="openDetailModal({{ json_encode($blog) }})" class="p-2 text-gray-400 hover:bg-gray-100 rounded-lg transition" title="Lihat Detail">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </button>
                            <button @click="openEditModal({{ json_encode($blog) }})" class="p-2 text-indigo-500 hover:bg-indigo-50 rounded-lg transition" title="Edit Data">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </button>
                            <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST">
                                @csrf @method("DELETE")
                                <button type="submit" class="p-2 text-red-400 hover:bg-red-50 rounded-lg transition" onclick="return confirm('Hapus blog ini?')">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-16 text-center">
                        <p class="text-gray-300 font-bold uppercase tracking-widest text-xs italic">Belum ada data artikel</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div x-show="isOpen" class="fixed inset-0 z-[99] flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm" x-transition.opacity>
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-3xl overflow-hidden border border-gray-100 max-h-[90vh] overflow-y-auto" @click.away="isOpen = false" x-transition.scale.95>
            <div class="p-6 border-b flex justify-between items-center bg-gray-50/50 sticky top-0 z-10">
                <h3 class="text-lg font-black text-gray-800 uppercase tracking-tight" x-text="editMode ? 'Edit Artikel Blog' : 'Tulis Blog Baru'"></h3>
                <button @click="isOpen = false" class="text-gray-400 hover:text-gray-800 transition text-2xl">&times;</button>
            </div>
            
            <form :action="formAction" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                @csrf
                <template x-if="editMode"><input type="hidden" name="_method" value="PUT"></template>
                
                <div class="space-y-1">
                    <label class="text-xs font-black text-gray-500 uppercase tracking-widest">Judul Artikel</label>
                    <input type="text" name="judul" x-model="formData.judul" class="w-full bg-gray-50 border-none rounded-2xl p-4 outline-none focus:ring-2 focus:ring-indigo-500 transition" required>
                </div>
                
                <div class="space-y-1">
                    <label class="text-xs font-black text-gray-500 uppercase tracking-widest">Penulis</label>
                    <input type="text" name="penulis" x-model="formData.penulis" class="w-full bg-gray-50 border-none rounded-2xl p-4 outline-none focus:ring-2 focus:ring-indigo-500 transition" required>
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-black text-gray-500 uppercase tracking-widest">Konten Artikel</label>
                    <textarea name="konten" x-model="formData.konten" rows="8" class="w-full bg-gray-50 border-none rounded-2xl p-4 outline-none focus:ring-2 focus:ring-indigo-500 transition" required></textarea>
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-black text-gray-500 uppercase tracking-widest" x-text="editMode ? 'Ganti Gambar Cover (Opsional)' : 'Gambar Cover'"></label>
                    <input type="file" name="gambar" accept="image/*" class="w-full bg-gray-50 border-none rounded-2xl p-3 outline-none focus:ring-2 focus:ring-indigo-500 transition text-sm">
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 mt-6">
                    <button type="button" @click="isOpen = false" class="px-6 py-3 text-sm font-bold text-gray-400 hover:text-gray-600 transition">Batal</button>
                    <button type="submit" class="px-8 py-3 bg-indigo-600 text-white rounded-2xl font-black text-sm hover:bg-indigo-700 shadow-lg shadow-indigo-100 transition transform active:scale-95" x-text="editMode ? 'Simpan Perubahan' : 'Terbitkan Artikel'"></button>
                </div>
            </form>
        </div>
    </div>

    <div x-show="openDetail" class="fixed inset-0 z-[99] flex items-center justify-center p-4 bg-gray-900/80 backdrop-blur-md" x-transition.opacity>
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-3xl overflow-hidden max-h-[90vh] flex flex-col" @click.away="openDetail = false" x-transition.scale.95>
            
            <div class="p-6 bg-indigo-600 text-white flex justify-between items-center shrink-0">
                <h3 class="font-bold uppercase tracking-widest text-sm">Detail Artikel & Komentar</h3>
                <button @click="openDetail = false" class="text-white/60 hover:text-white transition">&times;</button>
            </div>
            
            <div class="p-8 overflow-y-auto flex-1">
                <template x-if="detailData.gambar">
                    <img :src="'/storage/' + detailData.gambar" class="w-full h-64 object-cover rounded-2xl mb-6 shadow-md border border-gray-100">
                </template>

                <h2 class="text-3xl font-black text-gray-900 leading-tight" x-text="detailData.judul"></h2>
                
                <div class="flex items-center gap-2 mt-3 mb-6">
                    <span class="text-xs font-bold px-3 py-1.5 bg-indigo-50 text-indigo-600 rounded-lg uppercase tracking-wider flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <span x-text="detailData.penulis"></span>
                    </span>
                </div>

                <div class="prose prose-indigo max-w-none text-gray-700 mb-8 p-6 bg-gray-50 rounded-2xl" x-html="detailData.konten"></div>

                <hr class="my-8 border-gray-100 border-2">

                <div class="space-y-4">
                    <h3 class="text-lg font-black text-gray-800 flex items-center gap-2 uppercase tracking-wide">
                        Komentar Masuk (<span x-text="detailData.comments ? detailData.comments.length : 0"></span>)
                    </h3>
                    
                    <div class="space-y-4">
                        <template x-for="comment in detailData.comments" :key="comment.id">
                            <div class="p-5 bg-white rounded-2xl border border-gray-100 shadow-sm flex justify-between items-start gap-4 transition hover:shadow-md">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-1">
                                        <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-xs uppercase" x-text="comment.nama.substring(0,2)"></div>
                                        <div>
                                            <p class="font-bold text-sm text-gray-900" x-text="comment.nama"></p>
                                            <p class="text-[10px] text-gray-400" x-text="new Date(comment.created_at).toLocaleDateString('id-ID') + ' | ' + comment.email"></p>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-600 italic mt-2 bg-gray-50 p-3 rounded-xl" x-text="'&quot;' + comment.komentar + '&quot;'"></p>
                                </div>
                                
                                <form :action="'/admin/comments/' + comment.id" method="POST" onsubmit="return confirm('Hapus komentar ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-400 hover:bg-red-50 hover:text-red-600 rounded-lg transition" title="Hapus Komentar">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </template>

                        <template x-if="!detailData.comments || detailData.comments.length === 0">
                            <div class="p-8 text-center bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                                <p class="text-gray-400 text-sm font-bold uppercase tracking-widest italic">Belum ada komentar.</p>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
            
            <div class="p-6 bg-white border-t border-gray-100 shrink-0">
                <button @click="openDetail = false" class="w-full py-4 bg-gray-100 rounded-2xl font-bold text-gray-500 hover:bg-gray-200 transition">Tutup Detail</button>
            </div>

        </div>
    </div>

</div>

<script>
    function blogManager() {
        return {
            search: '',
            isOpen: false,
            openDetail: false,
            editMode: false,
            formAction: "{{ route('admin.blogs.store') }}",
            formData: { judul: '', penulis: '', konten: '' },
            detailData: {},
            
            openCreateModal() { 
                this.editMode = false;
                this.formAction = "{{ route('admin.blogs.store') }}";
                this.formData = { judul: '', penulis: '', konten: '' };
                this.isOpen = true; 
            },
            
            openEditModal(blog) {
                this.editMode = true;
                this.formAction = `/admin/blogs/${blog.id}`;
                this.formData = { ...blog }; 
                this.isOpen = true;
            },
            
            openDetailModal(blog) {
                this.detailData = blog;
                this.openDetail = true;
            }
        }
    }
</script>

<style> [x-cloak] { display: none !important; } </style>
@endsection