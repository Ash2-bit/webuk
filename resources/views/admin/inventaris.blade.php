@extends('layouts.admin')

@section('title', 'Manajemen Inventaris')

@section('content')
<div class="p-6" x-data="inventarisModal()" x-cloak>

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-xl shadow-sm">
                <div class="flex items-center mb-2">
                    <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                    <h3 class="text-sm font-bold text-red-800">Gagal menyimpan data!</h3>
                </div>
                <ul class="list-disc list-inside text-xs text-red-700 ml-7 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Manajemen Inventaris</h1>
            <p class="text-sm text-gray-500 font-medium">Kelola data aset dan inventaris organisasi secara profesional.</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.inventaris.pdf') }}" target="_blank" class="bg-red-500 hover:bg-red-600 text-white px-5 py-2.5 rounded-xl shadow-lg shadow-red-200 font-semibold transition-all transform active:scale-95 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Export PDF
            </a>
            <button @click="openAddModal()" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl shadow-lg shadow-indigo-200 font-semibold transition-all transform active:scale-95 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah Inventaris
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm transition hover:shadow-md text-center md:text-left">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Total Aset</p>
            <p class="text-2xl font-extrabold text-indigo-600">{{ count($inventaris) }} <span class="text-sm text-gray-400 font-medium">Item</span></p>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm transition hover:shadow-md text-center md:text-left">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Barang Tersedia</p>
            <p class="text-2xl font-extrabold text-green-500">{{ $inventaris->where('ketersediaan', 'ada')->count() }} <span class="text-sm text-gray-400 font-medium">Item</span></p>
        </div>
        <div class="bg-indigo-600 p-6 rounded-2xl shadow-lg shadow-indigo-100 text-center md:text-left">
            <p class="text-xs font-bold text-indigo-200 uppercase tracking-widest mb-1">Tidak Tersedia</p>
            <p class="text-2xl font-extrabold text-white">{{ $inventaris->where('ketersediaan', '!=', 'ada')->count() }} <span class="text-sm text-indigo-200 font-medium">Item</span></p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
            <div class="md:col-span-2">
                <label class="block text-xs font-bold text-gray-500 mb-2 uppercase">Pencarian Inventaris</label>
                <input type="text" x-model="search" placeholder="Cari nama barang atau lokasi..." class="w-full bg-gray-50 border-none rounded-xl p-3 text-sm focus:ring-2 focus:ring-indigo-500 transition outline-none">
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
                    <th class="p-4 text-xs font-bold text-gray-400 uppercase tracking-tighter w-16 text-center">Foto</th>
                    <th class="p-4 text-xs font-bold text-gray-400 uppercase tracking-tighter">Nama Barang</th>
                    <th class="p-4 text-xs font-bold text-gray-400 uppercase tracking-tighter">Lokasi & Jumlah</th>
                    <th class="p-4 text-xs font-bold text-gray-400 uppercase tracking-tighter text-center">Status</th>
                    <th class="p-4 text-xs font-bold text-gray-400 uppercase tracking-tighter text-center">Opsi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($inventaris as $item)
                <tr class="hover:bg-gray-50/50 transition" x-show="'{{ strtolower($item->nama_barang) }}'.includes(search.toLowerCase()) || '{{ strtolower($item->lokasi) }}'.includes(search.toLowerCase())">
                    <td class="p-4 text-center">
                        <div class="w-12 h-12 mx-auto rounded-xl overflow-hidden bg-gray-100 border border-gray-200 flex items-center justify-center">
                            @if($item->foto_barang)
                                <img src="{{ asset('storage/'.$item->foto_barang) }}" alt="{{ $item->nama_barang }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-xl">📦</span>
                            @endif
                        </div>
                    </td>
                    <td class="p-4">
                        <div class="text-sm font-bold text-gray-800">{{ $item->nama_barang }}</div>
                        <div class="text-[11px] font-medium text-gray-400 mt-1">Kondisi: {{ $item->kondisi ?? 'Tidak diketahui' }}</div>
                    </td>
                    <td class="p-4">
                        <div class="text-sm font-bold text-gray-800">{{ $item->lokasi }}</div>
                        <div class="text-[11px] text-gray-400 leading-tight mt-1">{{ $item->jumlah }} Unit Tersedia</div>
                    </td>
                    <td class="p-4 text-center">
                        <span class="inline-block px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest {{ $item->ketersediaan == 'ada' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                            {{ str_replace('_', ' ', $item->ketersediaan) }}
                        </span>
                    </td>
                    <td class="p-4">
                        <div class="flex justify-center items-center gap-2">
                            <button @click="openViewModal({{ json_encode($item) }})" class="p-2 text-gray-400 hover:bg-gray-100 rounded-lg transition" title="Lihat Detail">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </button>
                            <button @click="openEditModal({{ json_encode($item) }})" class="p-2 text-indigo-500 hover:bg-indigo-50 rounded-lg transition" title="Edit Data">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </button>
                            <form action="{{ route('admin.inventaris.destroy', $item->id) }}" method="POST">
                                @csrf @method("DELETE")
                                <button type="submit" class="p-2 text-red-400 hover:bg-red-50 rounded-lg transition" onclick="return confirm('Hapus item ini?')">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-16 text-center">
                        <p class="text-gray-300 font-bold uppercase tracking-widest text-xs italic">Belum ada data inventaris</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div x-show="isOpen" class="fixed inset-0 z-[99] flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm" x-transition.opacity>
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-3xl overflow-hidden border border-gray-100 max-h-[90vh] overflow-y-auto" @click.away="isOpen = false" x-transition.scale.95>
            <div class="p-6 border-b flex justify-between items-center bg-gray-50/50 sticky top-0 z-10">
                <h3 class="text-lg font-black text-gray-800 uppercase tracking-tight" x-text="editMode ? 'Perbarui Inventaris' : 'Tambah Inventaris Baru'"></h3>
                <button @click="isOpen = false" class="text-gray-400 hover:text-gray-800 transition text-2xl">&times;</button>
            </div>
            
            <form :action="formAction" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                @csrf
                <template x-if="editMode"><input type="hidden" name="_method" value="PUT"></template>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="space-y-1">
                        <label class="text-xs font-black text-gray-500 uppercase tracking-widest">Nama Barang</label>
                        <input type="text" name="nama_barang" x-model="formData.nama_barang" class="w-full bg-gray-50 border-none rounded-2xl p-4 outline-none focus:ring-2 focus:ring-indigo-500 transition" required>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-black text-gray-500 uppercase tracking-widest">Jumlah Unit</label>
                        <input type="number" name="jumlah" x-model="formData.jumlah" class="w-full bg-gray-50 border-none rounded-2xl p-4 outline-none focus:ring-2 focus:ring-indigo-500 transition" required>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-black text-gray-500 uppercase tracking-widest">Kondisi</label>
                        <input type="text" name="kondisi" x-model="formData.kondisi" class="w-full bg-gray-50 border-none rounded-2xl p-4 outline-none focus:ring-2 focus:ring-indigo-500 transition">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-black text-gray-500 uppercase tracking-widest">Tanggal Masuk</label>
                        <input type="date" name="tanggal_masuk" x-model="formData.tanggal_masuk" class="w-full bg-gray-50 border-none rounded-2xl p-4 outline-none focus:ring-2 focus:ring-indigo-500 transition">
                    </div>
                    <div class="space-y-1 sm:col-span-2">
                        <label class="text-xs font-black text-gray-500 uppercase tracking-widest">Lokasi Penyimpanan</label>
                        <input type="text" name="lokasi" x-model="formData.lokasi" class="w-full bg-gray-50 border-none rounded-2xl p-4 outline-none focus:ring-2 focus:ring-indigo-500 transition">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-black text-gray-500 uppercase tracking-widest">Status Peminjaman</label>
                        <select name="status_peminjaman" x-model="formData.status_peminjaman" class="w-full bg-gray-50 border-none rounded-2xl p-4 outline-none focus:ring-2 focus:ring-indigo-500 transition">
                            <option value="boleh">Boleh Dipinjam</option>
                            <option value="tidak_boleh">Tidak Boleh</option>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-black text-gray-500 uppercase tracking-widest">Ketersediaan</label>
                        <select name="ketersediaan" x-model="formData.ketersediaan" class="w-full bg-gray-50 border-none rounded-2xl p-4 outline-none focus:ring-2 focus:ring-indigo-500 transition">
                            <option value="ada">Ada</option>
                            <option value="tidak_ada">Tidak Ada</option>
                            <option value="tidak_dapat_dipinjam">Tidak Dapat Dipinjam</option>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-black text-gray-500 uppercase tracking-widest">Link SOP (Opsional)</label>
                        <input type="url" name="link_sop" x-model="formData.link_sop" placeholder="https://contoh.com/sop" class="w-full bg-gray-50 border-none rounded-2xl p-3 outline-none focus:ring-2 focus:ring-indigo-500 transition text-sm">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-black text-gray-500 uppercase tracking-widest">Foto Barang</label>
                        <input type="file" name="foto_barang" accept="image/*" class="w-full bg-gray-50 border-none rounded-2xl p-3 outline-none focus:ring-2 focus:ring-indigo-500 transition text-sm">
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 mt-6">
                    <button type="button" @click="isOpen = false" class="px-6 py-3 text-sm font-bold text-gray-400 hover:text-gray-600 transition">Batal</button>
                    <button type="submit" class="px-8 py-3 bg-indigo-600 text-white rounded-2xl font-black text-sm hover:bg-indigo-700 shadow-lg shadow-indigo-100 transition transform active:scale-95" x-text="editMode ? 'Simpan Perubahan' : 'Tambahkan Data'"></button>
                </div>
                {{-- TAMPILKAN ERROR VALIDASI --}}

            </form>
        </div>
    </div>

    <div x-show="isViewOpen" class="fixed inset-0 z-[99] flex items-center justify-center p-4 bg-gray-900/80 backdrop-blur-md" x-transition.opacity>
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg overflow-hidden" @click.away="isViewOpen = false" x-transition.scale.95>
            <div class="p-6 bg-indigo-600 text-white flex justify-between items-center">
                <h3 class="font-bold uppercase tracking-widest text-sm">Detail Inventaris</h3>
                <button @click="isViewOpen = false" class="text-white/60 hover:text-white transition">&times;</button>
            </div>
            <div class="p-8 space-y-6 max-h-[75vh] overflow-y-auto">
                <div class="flex gap-4 items-center justify-center mb-6">
                    <template x-if="viewData.foto_barang">
                        <img :src="'/storage/' + viewData.foto_barang" class="w-28 h-28 rounded-2xl object-cover shadow-md border border-gray-100">
                    </template>
                    <template x-if="viewData.qr_code">
                        <img :src="'/storage/' + viewData.qr_code" class="w-28 h-28 rounded-2xl object-cover shadow-md border border-gray-100 p-2 bg-white">
                    </template>
                </div>
                
                <div class="text-center">
                    <h2 class="text-2xl font-black tracking-tight text-gray-800" x-text="viewData.nama_barang"></h2>
                    <p class="text-sm font-bold text-indigo-500 mt-1" x-text="viewData.jumlah + ' Unit'"></p>
                </div>
                
                <div class="grid grid-cols-2 gap-y-4 gap-x-6 border-t border-gray-50 pt-6">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Kondisi</p>
                        <p class="text-sm font-bold text-gray-800" x-text="viewData.kondisi || '-' "></p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Tanggal Masuk</p>
                        <p class="text-sm font-bold text-gray-800" x-text="viewData.tanggal_masuk || '-' "></p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Lokasi</p>
                        <p class="text-sm font-bold text-gray-800" x-text="viewData.lokasi"></p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Ketersediaan</p>
                        <p class="text-sm font-bold capitalize text-gray-800" x-text="viewData.ketersediaan.replace('_', ' ')"></p>
                    </div>
                </div>

                <div class="border-t border-gray-50 pt-4 text-center">
                    <template x-if="viewData.link_sop">
                        <a :href="viewData.link_sop" target="_blank" class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-xl font-bold text-sm transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            Buka Link SOP
                        </a>
                    </template>
                </div>

                <button @click="isViewOpen = false" class="w-full py-4 bg-gray-100 rounded-2xl font-bold text-gray-500 hover:bg-gray-200 transition">Tutup Detail</button>
            </div>
        </div>
    </div>

</div>

<script>
    function inventarisModal() {
        return {
            search: '',
            isOpen: false, 
            isViewOpen: false, 
            editMode: false,
            formAction: "{{ route('admin.inventaris.store') }}",
            formData: { nama_barang: '', jumlah: '', kondisi: '', tanggal_masuk: '', lokasi: '', status_peminjaman: 'boleh', ketersediaan: 'ada', link_sop: '' },
            viewData: { ketersediaan: '' },
            
            openAddModal() {
                this.editMode = false;
                this.formAction = "{{ route('admin.inventaris.store') }}";
                this.formData = { nama_barang: '', jumlah: '', kondisi: '', tanggal_masuk: '', lokasi: '', status_peminjaman: 'boleh', ketersediaan: 'ada', link_sop: '' };
                this.isOpen = true;
            },
            
            openEditModal(data) {
                this.editMode = true;
                this.formAction = `/admin/inventaris/${data.id}`;
                this.formData = { ...data };
                this.isOpen = true;
            },

            openViewModal(data) {
                this.viewData = data;
                this.isViewOpen = true;
            }
        }
    }
</script>

<style> [x-cloak] { display: none !important; } </style>
@endsection