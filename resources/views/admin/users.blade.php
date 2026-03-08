@extends('layouts.admin')

@section('title', 'Manajemen User Anggota')

@section('content')
<div class="p-6" x-data="userModal()" x-cloak>
    
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Manajemen Anggota</h1>
            <p class="text-sm text-gray-500 font-medium">Kelola data anggota organisasi secara profesional.</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.anggota.pdf') }}" target="_blank" class="bg-red-500 hover:bg-red-600 text-white px-5 py-2.5 rounded-xl shadow-lg shadow-red-200 font-semibold transition-all transform active:scale-95 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Export PDF
            </a>
            
            <button @click="openAddModal()" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl shadow-lg shadow-indigo-200 font-semibold transition-all transform active:scale-95 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah Anggota
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm transition hover:shadow-md text-center md:text-left">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Total Anggota</p>
            <p class="text-2xl font-extrabold text-indigo-600">{{ count($anggota) }} <span class="text-sm text-gray-400 font-medium">Orang</span></p>
        </div>
        <div class="bg-indigo-600 p-6 rounded-2xl shadow-lg shadow-indigo-100 text-center md:text-left">
            <p class="text-xs font-bold text-indigo-200 uppercase tracking-widest mb-1">Status Database</p>
            <p class="text-2xl font-extrabold text-white">Aktif & Terhubung</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
            <div class="md:col-span-2">
                <label class="block text-xs font-bold text-gray-500 mb-2 uppercase">Pencarian Anggota</label>
                <input type="text" x-model="search" placeholder="Cari nama atau NPM..." class="w-full bg-gray-50 border-none rounded-xl p-3 text-sm focus:ring-2 focus:ring-indigo-500 transition outline-none">
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
                    <th class="p-4 text-xs font-bold text-gray-400 uppercase tracking-tighter">Profil Anggota</th>
                    <th class="p-4 text-xs font-bold text-gray-400 uppercase tracking-tighter">LDF / Genre</th>
                    <th class="p-4 text-xs font-bold text-gray-400 uppercase tracking-tighter">Kontak</th>
                    <th class="p-4 text-xs font-bold text-gray-400 uppercase tracking-tighter text-center">Opsi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($anggota as $user)
                <tr class="hover:bg-gray-50/50 transition" x-show="'{{ strtolower($user->nama) }}'.includes(search.toLowerCase()) || '{{ strtolower($user->npm) }}'.includes(search.toLowerCase())">
                    <td class="p-4 text-center">
                        <div class="w-12 h-12 mx-auto rounded-xl overflow-hidden bg-gray-100 border border-gray-200 flex items-center justify-center">
                            @if($user->foto)
                                <img src="{{ asset('storage/'.$user->foto) }}" alt="{{ $user->nama }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-xl">👤</span>
                            @endif
                        </div>
                    </td>
                    <td class="p-4">
                        <div class="text-sm font-bold text-gray-800">{{ $user->nama }}</div>
                        <div class="text-[11px] font-medium text-indigo-500 mt-1">{{ $user->npm }} • {{ $user->jurusan }}</div>
                    </td>
                    <td class="p-4">
                        <div class="text-sm font-bold text-gray-800">{{ $user->ldf }}</div>
                        <div class="text-[11px] text-gray-400 leading-tight mt-1">{{ $user->genre }}</div>
                    </td>
                    <td class="p-4">
                        <div class="text-sm text-gray-600 font-medium">{{ $user->email }}</div>
                    </td>
                    <td class="p-4">
                        <div class="flex justify-center items-center gap-2">
                            <button @click="openViewModal({{ json_encode($user) }})" class="p-2 text-gray-400 hover:bg-gray-100 rounded-lg transition" title="Lihat Detail">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </button>
                            <button @click="openEditModal({{ json_encode($user) }})" class="p-2 text-indigo-500 hover:bg-indigo-50 rounded-lg transition" title="Edit Data">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </button>
                            <form action="{{ route('admin.anggota.destroy', $user->id) }}" method="POST">
                                @csrf @method("DELETE")
                                <button type="submit" class="p-2 text-red-400 hover:bg-red-50 rounded-lg transition" onclick="return confirm('Hapus anggota ini?')">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-16 text-center">
                        <p class="text-gray-300 font-bold uppercase tracking-widest text-xs italic">Belum ada data anggota</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div x-show="isOpen" class="fixed inset-0 z-[99] flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm" x-transition.opacity>
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl overflow-hidden border border-gray-100 max-h-[90vh] overflow-y-auto" @click.away="isOpen = false" x-transition.scale.95>
            <div class="p-6 border-b flex justify-between items-center bg-gray-50/50 sticky top-0 z-10">
                <h3 class="text-lg font-black text-gray-800 uppercase tracking-tight" x-text="editMode ? 'Perbarui Anggota' : 'Tambah Anggota Baru'"></h3>
                <button @click="isOpen = false" class="text-gray-400 hover:text-gray-800 transition text-2xl">&times;</button>
            </div>
            
            <form :action="formAction" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                @csrf
                <template x-if="editMode"><input type="hidden" name="_method" value="PUT"></template>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="space-y-1">
                        <label class="text-xs font-black text-gray-500 uppercase tracking-widest">Nama Lengkap</label>
                        <input type="text" name="nama" x-model="formData.nama" class="w-full bg-gray-50 border-none rounded-2xl p-4 outline-none focus:ring-2 focus:ring-indigo-500 transition" required>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-black text-gray-500 uppercase tracking-widest">NPM</label>
                        <input type="text" name="npm" x-model="formData.npm" class="w-full bg-gray-50 border-none rounded-2xl p-4 outline-none focus:ring-2 focus:ring-indigo-500 transition" required>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-black text-gray-500 uppercase tracking-widest">Tahun Masuk</label>
                        <input type="number" name="tahun_masuk" x-model="formData.tahun_masuk" class="w-full bg-gray-50 border-none rounded-2xl p-4 outline-none focus:ring-2 focus:ring-indigo-500 transition" required>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-black text-gray-500 uppercase tracking-widest">Jurusan</label>
                        <input type="text" name="jurusan" x-model="formData.jurusan" class="w-full bg-gray-50 border-none rounded-2xl p-4 outline-none focus:ring-2 focus:ring-indigo-500 transition" required>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-black text-gray-500 uppercase tracking-widest">Program Studi</label>
                        <input type="text" name="prodi" x-model="formData.prodi" class="w-full bg-gray-50 border-none rounded-2xl p-4 outline-none focus:ring-2 focus:ring-indigo-500 transition">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-black text-gray-500 uppercase tracking-widest">LDF</label>
                        <select name="ldf" x-model="formData.ldf" class="w-full bg-gray-50 border-none rounded-2xl p-4 outline-none focus:ring-2 focus:ring-indigo-500 transition">
                            <template x-for="item in listLdf" :key="item">
                                <option :value="item" x-text="item"></option>
                            </template>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-black text-gray-500 uppercase tracking-widest">Genre / Jenis Kelamin</label>
                        <select name="genre" x-model="formData.genre" class="w-full bg-gray-50 border-none rounded-2xl p-4 outline-none focus:ring-2 focus:ring-indigo-500 transition">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-black text-gray-500 uppercase tracking-widest">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" x-model="formData.tanggal_lahir" class="w-full bg-gray-50 border-none rounded-2xl p-4 outline-none focus:ring-2 focus:ring-indigo-500 transition">
                    </div>
                    <div class="space-y-1 md:col-span-2">
                        <label class="text-xs font-black text-gray-500 uppercase tracking-widest">Email</label>
                        <input type="email" name="email" x-model="formData.email" class="w-full bg-gray-50 border-none rounded-2xl p-4 outline-none focus:ring-2 focus:ring-indigo-500 transition" required>
                    </div>
                    <div class="space-y-1 md:col-span-2" x-show="!editMode">
                        <label class="text-xs font-black text-gray-500 uppercase tracking-widest">Password</label>
                        <input type="password" name="password" class="w-full bg-gray-50 border-none rounded-2xl p-4 outline-none focus:ring-2 focus:ring-indigo-500 transition" :required="!editMode">
                    </div>
                    <div class="space-y-1 md:col-span-2">
                        <label class="text-xs font-black text-gray-500 uppercase tracking-widest">Alamat</label>
                        <textarea name="alamat" x-model="formData.alamat" rows="2" class="w-full bg-gray-50 border-none rounded-2xl p-4 outline-none focus:ring-2 focus:ring-indigo-500 transition"></textarea>
                    </div>
                    <div class="space-y-1 md:col-span-2">
                        <label class="text-xs font-black text-gray-500 uppercase tracking-widest">Foto (Opsional)</label>
                        <input type="file" name="foto" accept="image/*" class="w-full bg-gray-50 border-none rounded-2xl p-3 outline-none focus:ring-2 focus:ring-indigo-500 transition text-sm">
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 mt-6">
                    <button type="button" @click="isOpen = false" class="px-6 py-3 text-sm font-bold text-gray-400 hover:text-gray-600 transition">Batal</button>
                    <button type="submit" class="px-8 py-3 bg-indigo-600 text-white rounded-2xl font-black text-sm hover:bg-indigo-700 shadow-lg shadow-indigo-100 transition transform active:scale-95" x-text="editMode ? 'Simpan Perubahan' : 'Tambahkan Data'"></button>
                </div>
            </form>
        </div>
    </div>

    <div x-show="isViewOpen" class="fixed inset-0 z-[99] flex items-center justify-center p-4 bg-gray-900/80 backdrop-blur-md" x-transition.opacity>
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg overflow-hidden" @click.away="isViewOpen = false" x-transition.scale.95>
            <div class="p-6 bg-indigo-600 text-white flex justify-between items-center">
                <h3 class="font-bold uppercase tracking-widest text-sm">Detail Anggota</h3>
                <button @click="isViewOpen = false" class="text-white/60 hover:text-white transition">&times;</button>
            </div>
            <div class="p-8 space-y-6 max-h-[70vh] overflow-y-auto">
                <div class="text-center">
                    <template x-if="viewData.foto">
                        <img :src="'/storage/' + viewData.foto" class="w-24 h-24 mx-auto rounded-2xl object-cover shadow-md mb-4 border border-gray-100">
                    </template>
                    <template x-if="!viewData.foto">
                        <div class="w-24 h-24 mx-auto bg-gray-100 rounded-2xl flex items-center justify-center text-3xl mb-4 shadow-inner">👤</div>
                    </template>
                    <h2 class="text-2xl font-black tracking-tight text-gray-800" x-text="viewData.nama"></h2>
                    <p class="text-sm font-bold text-indigo-500 mt-1" x-text="viewData.npm"></p>
                </div>
                
                <div class="grid grid-cols-2 gap-y-4 gap-x-6 border-t border-gray-50 pt-6">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Jurusan / Prodi</p>
                        <p class="text-sm font-bold text-gray-800" x-text="viewData.jurusan + ' / ' + (viewData.prodi || '-') "></p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Tahun Masuk</p>
                        <p class="text-sm font-bold text-gray-800" x-text="viewData.tahun_masuk"></p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">LDF</p>
                        <p class="text-sm font-bold text-gray-800" x-text="viewData.ldf"></p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Genre</p>
                        <p class="text-sm font-bold text-gray-800" x-text="viewData.genre"></p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Email</p>
                        <p class="text-sm font-bold text-indigo-600 break-all" x-text="viewData.email"></p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Alamat</p>
                        <p class="text-sm text-gray-600 leading-relaxed" x-text="viewData.alamat || 'Belum diisi'"></p>
                    </div>
                </div>

                <button @click="isViewOpen = false" class="w-full py-4 bg-gray-100 rounded-2xl font-bold text-gray-500 hover:bg-gray-200 transition">Tutup Detail</button>
            </div>
        </div>
    </div>

</div>

<script>
    function userModal() {
        return {
            search: '',
            isOpen: false, 
            isViewOpen: false, 
            editMode: false,
            listLdf: ['FKSI', 'FOSI', 'FIMADINA', 'GSI', 'IMC', 'WAMI', 'MGC', 'MOSTANEER', 'TIDAK ADA'],
            formAction: "{{ route('admin.anggota.store') }}",
            formData: { nama: '', npm: '', tahun_masuk: '', jurusan: '', prodi: '', ldf: 'TIDAK ADA', genre: 'Laki-laki', tanggal_lahir: '', email: '', alamat: '' },
            viewData: {},
            
            openAddModal() {
                this.editMode = false;
                this.formAction = "{{ route('admin.anggota.store') }}";
                this.formData = { nama: '', npm: '', tahun_masuk: '', jurusan: '', prodi: '', ldf: 'TIDAK ADA', genre: 'Laki-laki', tanggal_lahir: '', email: '', alamat: '' };
                this.isOpen = true;
            },
            
            openEditModal(data) {
                this.editMode = true;
                this.formAction = `/admin/anggota/${data.id}`;
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