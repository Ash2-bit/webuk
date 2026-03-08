@extends('layouts.admin')

@section('content')
<div class="p-6" x-data="materiModal()" x-cloak>
    
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Manajemen Materi</h1>
            <p class="text-sm text-gray-500 font-medium">Kelola tautan dan bacaan Islami di halaman utama</p>
        </div>
        <button @click="openAddModal()" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl shadow-lg shadow-indigo-200 font-semibold transition-all transform active:scale-95 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Tambah Materi
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm transition hover:shadow-md text-center md:text-left">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Total Materi Tersedia</p>
            <p class="text-2xl font-extrabold text-indigo-600">{{ $data->total() }} <span class="text-sm text-gray-400 font-medium">Item</span></p>
        </div>
        <div class="bg-indigo-600 p-6 rounded-2xl shadow-lg shadow-indigo-100 text-center md:text-left">
            <p class="text-xs font-bold text-indigo-200 uppercase tracking-widest mb-1">Status Visibilitas</p>
            <p class="text-2xl font-extrabold text-white">Aktif Ditampilkan</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm mb-6">
        <form action="{{ route('admin.materi.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
            <div class="md:col-span-2">
                <label class="block text-xs font-bold text-gray-500 mb-2 uppercase">Pencarian Judul / Deskripsi</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari materi..." class="w-full bg-gray-50 border-none rounded-xl p-3 text-sm focus:ring-2 focus:ring-indigo-500 transition">
            </div>
            <div class="flex gap-2">
                <button type="submit" class="bg-gray-900 text-white px-5 py-3 rounded-xl text-sm font-bold hover:bg-black transition flex-1">Cari</button>
                <a href="{{ route('admin.materi.index') }}" class="bg-gray-100 text-gray-500 px-5 py-3 rounded-xl text-sm font-bold hover:bg-gray-200 transition text-center">Reset</a>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden overflow-x-auto">
        <table class="w-full text-left min-w-[800px]">
            <thead class="bg-gray-50/80 border-b border-gray-100">
                <tr>
                    <th class="p-4 text-xs font-bold text-gray-400 uppercase tracking-tighter w-16 text-center">Ikon</th>
                    <th class="p-4 text-xs font-bold text-gray-400 uppercase tracking-tighter">Informasi Materi</th>
                    <th class="p-4 text-xs font-bold text-gray-400 uppercase tracking-tighter">Tautan Akses</th>
                    <th class="p-4 text-xs font-bold text-gray-400 uppercase tracking-tighter text-center">Tanggal Dibuat</th>
                    <th class="p-4 text-xs font-bold text-gray-400 uppercase tracking-tighter text-center">Opsi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($data as $d)
                <tr class="hover:bg-gray-50/50 transition">
                    <td class="p-4 text-center">
                        <div class="w-12 h-12 mx-auto rounded-xl overflow-hidden bg-gray-100 border border-gray-200">
                            <img src="{{ asset('storage/' . $d->gambar) }}" alt="{{ $d->judul }}" class="w-full h-full object-cover">
                        </div>
                    </td>
                    <td class="p-4">
                        <div class="text-sm font-bold text-gray-800">{{ $d->judul }}</div>
                        <div class="text-[11px] text-gray-400 leading-tight mt-1">{{ Str::limit($d->deskripsi, 60) }}</div>
                    </td>
                    <td class="p-4">
                        <a href="{{ $d->tautan }}" target="_blank" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 underline truncate max-w-[200px] inline-block">
                            Buka Tautan &nearr;
                        </a>
                    </td>
                    <td class="p-4 text-center text-sm text-gray-500 font-medium">
                        {{ \Carbon\Carbon::parse($d->created_at)->translatedFormat('d M Y') }}
                    </td>
                    <td class="p-4">
                        <div class="flex justify-center items-center gap-2">
                            <button @click="openViewModal({{ json_encode($d) }}, '{{ asset('storage/' . $d->gambar) }}')" class="p-2 text-gray-400 hover:bg-gray-100 rounded-lg transition" title="Lihat Detail">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </button>
                            <button @click="openEditModal({{ json_encode($d) }})" class="p-2 text-indigo-500 hover:bg-indigo-50 rounded-lg transition" title="Edit Data">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </button>
                            <form action="{{ route('admin.materi.destroy', $d->id) }}" method="POST">
                                @csrf @method("DELETE")
                                <button type="submit" class="p-2 text-red-400 hover:bg-red-50 rounded-lg transition" onclick="return confirm('Hapus materi ini?')">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-16 text-center">
                        <p class="text-gray-300 font-bold uppercase tracking-widest text-xs italic">Belum ada materi yang ditambahkan</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $data->links() }}
    </div>

    <div x-show="isOpen" class="fixed inset-0 z-[99] flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm" x-transition.opacity>
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg overflow-hidden border border-gray-100" @click.away="isOpen = false" x-transition.scale.95>
            <div class="p-6 border-b flex justify-between items-center bg-gray-50/50">
                <h3 class="text-lg font-black text-gray-800 uppercase tracking-tight" x-text="editMode ? 'Perbarui Materi' : 'Materi Baru'"></h3>
                <button @click="isOpen = false" class="text-gray-400 hover:text-gray-800 transition text-2xl">&times;</button>
            </div>
            <form :action="formAction" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                @csrf
                <template x-if="editMode"><input type="hidden" name="_method" value="PUT"></template>
                
                <div class="space-y-1">
                    <label class="text-xs font-black text-gray-500 uppercase tracking-widest">Judul Materi</label>
                    <input type="text" name="judul" x-model="formData.judul" placeholder="Contoh: Tafsir Jalalain" class="w-full bg-gray-50 border-none rounded-2xl p-4 outline-none focus:ring-2 focus:ring-indigo-500 transition" required>
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-black text-gray-500 uppercase tracking-widest">Tautan URL Akses</label>
                    <input type="url" name="tautan" x-model="formData.tautan" placeholder="https://..." class="w-full bg-gray-50 border-none rounded-2xl p-4 outline-none focus:ring-2 focus:ring-indigo-500 transition" required>
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-black text-gray-500 uppercase tracking-widest">Keterangan / Deskripsi</label>
                    <textarea name="deskripsi" x-model="formData.deskripsi" rows="3" placeholder="Deskripsi singkat materi..." class="w-full bg-gray-50 border-none rounded-2xl p-4 outline-none focus:ring-2 focus:ring-indigo-500 transition" required></textarea>
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-black text-gray-500 uppercase tracking-widest">Ikon / Gambar Pemanis</label>
                    <input type="file" name="gambar" accept="image/*" :required="!editMode" class="w-full bg-gray-50 border-none rounded-2xl p-3 outline-none focus:ring-2 focus:ring-indigo-500 transition text-sm">
                    <p x-show="editMode" class="text-[11px] text-gray-400 mt-1 italic">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" @click="isOpen = false" class="px-6 py-3 text-sm font-bold text-gray-400 hover:text-gray-600 transition">Batal</button>
                    <button type="submit" class="px-8 py-3 bg-indigo-600 text-white rounded-2xl font-black text-sm hover:bg-indigo-700 shadow-lg shadow-indigo-100 transition transform active:scale-95" x-text="editMode ? 'Simpan Perubahan' : 'Tambahkan Data'"></button>
                </div>
            </form>
        </div>
    </div>

    <div x-show="isViewOpen" class="fixed inset-0 z-[99] flex items-center justify-center p-4 bg-gray-900/80 backdrop-blur-md" x-transition.opacity>
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden" @click.away="isViewOpen = false" x-transition.scale.95>
            <div class="p-6 bg-indigo-600 text-white flex justify-between items-center">
                <h3 class="font-bold uppercase tracking-widest text-sm">Detail Materi</h3>
                <button @click="isViewOpen = false" class="text-white/60 hover:text-white transition">&times;</button>
            </div>
            <div class="p-8 space-y-6">
                <div class="text-center">
                    <div class="w-24 h-24 mx-auto rounded-2xl overflow-hidden shadow-md mb-4 border border-gray-100">
                        <img :src="viewImage" alt="Ikon Materi" class="w-full h-full object-cover">
                    </div>
                    <h2 class="text-2xl font-black tracking-tight text-gray-800" x-text="viewData.judul"></h2>
                </div>
                
                <div class="border-y border-gray-50 py-6">
                    <p class="text-[10px] font-bold text-gray-400 uppercase mb-2">Tautan Akses</p>
                    <a :href="viewData.tautan" target="_blank" class="text-sm font-bold text-indigo-600 hover:text-indigo-800 break-all bg-indigo-50 p-3 rounded-xl block">
                        <span x-text="viewData.tautan"></span> &nearr;
                    </a>
                </div>

                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Deskripsi Materi</p>
                    <p class="text-sm text-gray-600 leading-relaxed" x-text="viewData.deskripsi"></p>
                </div>

                <button @click="isViewOpen = false" class="w-full py-4 bg-gray-100 rounded-2xl font-bold text-gray-500 hover:bg-gray-200 transition">Tutup Detail</button>
            </div>
        </div>
    </div>

</div>

<script>
    function materiModal() {
        return {
            isOpen: false, 
            isViewOpen: false, 
            editMode: false,
            formAction: "{{ route('admin.materi.store') }}",
            formData: { judul: '', deskripsi: '', tautan: '' },
            viewData: {},
            viewImage: '',
            
            openAddModal() {
                this.editMode = false;
                this.formAction = "{{ route('admin.materi.store') }}";
                this.formData = { 
                    judul: '', 
                    deskripsi: '', 
                    tautan: ''
                };
                this.isOpen = true;
            },
            
            openEditModal(data) {
                this.editMode = true;
                this.formAction = `/admin/materi/${data.id}`;
                this.formData = { 
                    judul: data.judul, 
                    deskripsi: data.deskripsi, 
                    tautan: data.tautan
                };
                this.isOpen = true;
            },

            openViewModal(data, imageUrl) {
                this.viewData = data;
                this.viewImage = imageUrl;
                this.isViewOpen = true;
            }
        }
    }
</script>

<style> [x-cloak] { display: none !important; } </style>
@endsection