@extends('layouts.admin')

@section('title', 'Manajemen Dokumen')

@section('content')
<div class="p-6" x-data="documentManager()" x-cloak>
    
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Manajemen Dokumen</h1>
            <p class="text-sm text-gray-500 font-medium">Kelola arsip dan dokumen organisasi dengan aman dan terstruktur.</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.documents.pdf') }}" target="_blank" class="bg-red-500 hover:bg-red-600 text-white px-5 py-2.5 rounded-xl shadow-lg shadow-red-200 font-semibold transition-all transform active:scale-95 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Export PDF
            </a>
            <button @click="openCreateModal()" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl shadow-lg shadow-indigo-200 font-semibold transition-all transform active:scale-95 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah Dokumen
            </button>
        </div>
    </div>

    @php
        $totalDocs = count($documents);
        $suratMasuk = collect($documents)->where('kategori', 'Surat Masuk')->count();
        $suratKeluar = collect($documents)->where('kategori', 'Surat Keluar')->count();
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm transition hover:shadow-md text-center md:text-left">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Total Arsip</p>
            <p class="text-2xl font-extrabold text-indigo-600">{{ $totalDocs }} <span class="text-sm text-gray-400 font-medium">Dokumen</span></p>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm transition hover:shadow-md text-center md:text-left">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Surat Masuk</p>
            <p class="text-2xl font-extrabold text-green-500">{{ $suratMasuk }} <span class="text-sm text-gray-400 font-medium">Berkas</span></p>
        </div>
        <div class="bg-indigo-600 p-6 rounded-2xl shadow-lg shadow-indigo-100 text-center md:text-left">
            <p class="text-xs font-bold text-indigo-200 uppercase tracking-widest mb-1">Surat Keluar</p>
            <p class="text-2xl font-extrabold text-white">{{ $suratKeluar }} <span class="text-sm text-indigo-200 font-medium">Berkas</span></p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
            <div class="md:col-span-2">
                <label class="block text-xs font-bold text-gray-500 mb-2 uppercase">Pencarian Dokumen</label>
                <input type="text" x-model="search" placeholder="Cari nama dokumen atau kategori..." class="w-full bg-gray-50 border-none rounded-xl p-3 text-sm focus:ring-2 focus:ring-indigo-500 transition outline-none">
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
                    <th class="p-4 text-xs font-bold text-gray-400 uppercase tracking-tighter w-16 text-center">Ikon</th>
                    <th class="p-4 text-xs font-bold text-gray-400 uppercase tracking-tighter">Informasi Dokumen</th>
                    <th class="p-4 text-xs font-bold text-gray-400 uppercase tracking-tighter text-center">Kategori</th>
                    <th class="p-4 text-xs font-bold text-gray-400 uppercase tracking-tighter text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($documents as $doc)
                <tr class="hover:bg-gray-50/50 transition" x-show="'{{ strtolower($doc->nama_dokumen) }}'.includes(search.toLowerCase()) || '{{ strtolower($doc->kategori) }}'.includes(search.toLowerCase())">
                    <td class="p-4 text-center">
                        <div class="w-12 h-12 mx-auto rounded-xl bg-indigo-50 text-indigo-500 flex items-center justify-center border border-indigo-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                    </td>
                    <td class="p-4">
                        <div class="text-sm font-bold text-gray-800">{{ $doc->nama_dokumen }}</div>
                        <div class="text-[11px] font-medium text-gray-400 mt-1">Diunggah: {{ \Carbon\Carbon::parse($doc->tanggal_upload)->translatedFormat('d M Y') }}</div>
                    </td>
                    <td class="p-4 text-center">
                        @php
                            $badgeColor = match($doc->kategori) {
                                'Surat Masuk' => 'bg-green-100 text-green-700',
                                'Surat Keluar' => 'bg-blue-100 text-blue-700',
                                'Dokumen Penting' => 'bg-red-100 text-red-700',
                                default => 'bg-gray-100 text-gray-700',
                            };
                        @endphp
                        <span class="inline-block px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest {{ $badgeColor }}">
                            {{ $doc->kategori }}
                        </span>
                    </td>
                    <td class="p-4">
                        <div class="flex justify-center items-center gap-2">
                            <a href="{{ asset('storage/'.$doc->file_path) }}" target="_blank" class="p-2 text-green-500 hover:bg-green-50 rounded-lg transition" title="Download Dokumen">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            </a>
                            <button @click="openEditModal({{ json_encode($doc) }})" class="p-2 text-indigo-500 hover:bg-indigo-50 rounded-lg transition" title="Edit Data">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </button>
                            <form action="{{ route('admin.documents.destroy', $doc->id) }}" method="POST">
                                @csrf @method("DELETE")
                                <button type="submit" class="p-2 text-red-400 hover:bg-red-50 rounded-lg transition" onclick="return confirm('Hapus dokumen ini?')">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-16 text-center">
                        <p class="text-gray-300 font-bold uppercase tracking-widest text-xs italic">Belum ada data dokumen arsip</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div x-show="isOpen" class="fixed inset-0 z-[99] flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm" x-transition.opacity>
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-xl overflow-hidden border border-gray-100 max-h-[90vh] overflow-y-auto" @click.away="isOpen = false" x-transition.scale.95>
            <div class="p-6 border-b flex justify-between items-center bg-gray-50/50 sticky top-0 z-10">
                <h3 class="text-lg font-black text-gray-800 uppercase tracking-tight" x-text="editMode ? 'Edit Data Dokumen' : 'Upload Dokumen Baru'"></h3>
                <button @click="isOpen = false" class="text-gray-400 hover:text-gray-800 transition text-2xl">&times;</button>
            </div>
            
            <form :action="formAction" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                @csrf
                <template x-if="editMode"><input type="hidden" name="_method" value="PUT"></template>
                
                <div class="space-y-1">
                    <label class="text-xs font-black text-gray-500 uppercase tracking-widest">Nama Dokumen</label>
                    <input type="text" name="nama_dokumen" x-model="formData.nama_dokumen" class="w-full bg-gray-50 border-none rounded-2xl p-4 outline-none focus:ring-2 focus:ring-indigo-500 transition" required>
                </div>
                
                <div class="space-y-1">
                    <label class="text-xs font-black text-gray-500 uppercase tracking-widest">Kategori</label>
                    <select name="kategori" x-model="formData.kategori" class="w-full bg-gray-50 border-none rounded-2xl p-4 outline-none focus:ring-2 focus:ring-indigo-500 transition" required>
                        <option value="Surat Masuk">Surat Masuk</option>
                        <option value="Surat Keluar">Surat Keluar</option>
                        <option value="Dokumen Penting">Dokumen Penting</option>
                        <option value="Dokumen Lainnya">Dokumen Lainnya</option>
                    </select>
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-black text-gray-500 uppercase tracking-widest" x-text="editMode ? 'Ganti File Dokumen (Opsional)' : 'Upload File Dokumen'"></label>
                    <input type="file" name="file_path" class="w-full bg-gray-50 border-none rounded-2xl p-3 outline-none focus:ring-2 focus:ring-indigo-500 transition text-sm" :required="!editMode">
                    <p x-show="editMode" class="text-[10px] text-gray-400 mt-1 px-2 italic">Biarkan kosong jika tidak ingin mengubah file.</p>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 mt-6">
                    <button type="button" @click="isOpen = false" class="px-6 py-3 text-sm font-bold text-gray-400 hover:text-gray-600 transition">Batal</button>
                    <button type="submit" class="px-8 py-3 bg-indigo-600 text-white rounded-2xl font-black text-sm hover:bg-indigo-700 shadow-lg shadow-indigo-100 transition transform active:scale-95" x-text="editMode ? 'Simpan Perubahan' : 'Upload Berkas'"></button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    function documentManager() {
        return {
            search: '',
            isOpen: false,
            editMode: false,
            formAction: "{{ route('admin.documents.store') }}",
            formData: { nama_dokumen: '', kategori: 'Surat Masuk' },
            
            openCreateModal() { 
                this.editMode = false;
                this.formAction = "{{ route('admin.documents.store') }}";
                this.formData = { nama_dokumen: '', kategori: 'Surat Masuk' };
                this.isOpen = true; 
            },
            
            openEditModal(doc) {
                this.editMode = true;
                this.formAction = `/admin/documents/${doc.id}`;
                this.formData = { 
                    nama_dokumen: doc.nama_dokumen, 
                    kategori: doc.kategori 
                }; 
                this.isOpen = true;
            }
        }
    }
</script>

<style> [x-cloak] { display: none !important; } </style>
@endsection