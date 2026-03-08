@extends('layouts.admin')

@section('content')
<div x-data="cabinetManager()" class="p-6 space-y-10">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">Manajemen Kabinet</h1>
        </div>
        <button @click="openModal('create')" class="px-6 py-3 bg-indigo-600 text-white rounded-2xl shadow-lg hover:scale-105 transition">
            + Tambah Kabinet
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($cabinets as $cab)
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100 p-6 flex flex-col justify-between">
            <div class="flex items-center gap-4 mb-4">
                @if($cab->logo)
                    <img src="{{ asset('storage/'.$cab->logo) }}" class="w-16 h-16 rounded-full object-cover border border-gray-200">
                @else
                    <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center text-xs text-gray-400">No Logo</div>
                @endif
                <div>
                    <h2 class="text-xl font-black text-gray-800">{{ $cab->nama_kabinet }}</h2>
                    <p class="text-sm font-medium text-indigo-600">Periode: {{ $cab->tahun }}</p>
                </div>
            </div>
            <div class="mt-4 flex gap-2">
                <a href="{{ route('admin.cabinets.show', $cab->id) }}" class="flex-1 text-center py-2 bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-100 font-bold transition text-sm">Struktur</a>
                
                <button @click="openModal('edit', {{ json_encode($cab) }})" class="p-2 bg-yellow-50 text-yellow-600 rounded-xl hover:bg-yellow-100 transition text-sm">✏️</button>
                
                <form action="{{ route('admin.cabinets.destroy', $cab->id) }}" method="POST" onsubmit="return confirm('Hapus Kabinet ini? Semua Bidang di dalamnya juga akan terhapus.')">
                    @csrf @method('DELETE')
                    <button class="p-2 bg-red-50 text-red-600 rounded-xl hover:bg-red-100 transition text-sm">🗑️</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    <div x-show="isOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm" x-cloak>
        <div class="bg-white rounded-3xl w-full max-w-5xl p-8 shadow-2xl overflow-y-auto max-h-[90vh]" @click.away="isOpen = false">
            <h2 class="text-2xl font-bold mb-6" x-text="mode === 'create' ? 'Tambah Kabinet Baru' : 'Edit Kabinet'"></h2>
            
            <form :action="mode === 'create' ? '{{ route('admin.cabinets.store') }}' : '/admin/cabinets/' + formData.id" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <template x-if="mode === 'edit'"><input type="hidden" name="_method" value="PUT"></template>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    <div class="space-y-4 lg:col-span-4 border-r pr-4">
                        <h3 class="font-bold border-b pb-2">Informasi Kabinet</h3>
                        <div>
                            <label class="text-xs font-bold text-gray-400 uppercase">Nama Kabinet</label>
                            <input type="text" name="nama_kabinet" x-model="formData.nama_kabinet" class="w-full p-3 border rounded-xl mt-1" required>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-400 uppercase">Tahun Periode</label>
                            <input type="text" name="tahun" x-model="formData.tahun" class="w-full p-3 border rounded-xl mt-1" required>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-400 uppercase">Deskripsi Kabinet</label>
                            <textarea name="deskripsi" x-model="formData.deskripsi" rows="3" class="w-full p-3 border rounded-xl mt-1"></textarea>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-400 uppercase" x-text="mode === 'create' ? 'Logo Kabinet' : 'Ganti Logo Kabinet (Opsional)'"></label>
                            <input type="file" name="logo" class="w-full p-2 border rounded-xl mt-1">
                        </div>
                    </div>

                    <div class="space-y-4 lg:col-span-8">
                        <h3 class="font-bold border-b pb-2">Pengurus Inti (BPH)</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="p-4 bg-gray-50 border rounded-2xl">
                                <label class="text-xs font-bold text-indigo-500 uppercase">Ketua Umum</label>
                                <input type="text" name="ketua" x-model="formData.ketua" placeholder="Nama Lengkap" class="w-full p-2 border rounded-xl mt-1 text-sm">
                                <div class="grid grid-cols-2 gap-2 mt-2">
                                    <input type="text" name="npm_ketua" x-model="formData.npm_ketua" placeholder="NPM" class="w-full p-2 border rounded-xl text-sm">
                                    <input type="text" name="prodi_ketua" x-model="formData.prodi_ketua" placeholder="Prodi" class="w-full p-2 border rounded-xl text-sm">
                                </div>
                                <input type="file" name="foto_ketua" class="w-full p-1 mt-2 border bg-white rounded-xl text-xs">
                            </div>

                            <div class="p-4 bg-gray-50 border rounded-2xl">
                                <label class="text-xs font-bold text-pink-500 uppercase">Keputrian</label>
                                <input type="text" name="keputrian" x-model="formData.keputrian" placeholder="Nama Lengkap" class="w-full p-2 border rounded-xl mt-1 text-sm">
                                <div class="grid grid-cols-2 gap-2 mt-2">
                                    <input type="text" name="npm_keputrian" x-model="formData.npm_keputrian" placeholder="NPM" class="w-full p-2 border rounded-xl text-sm">
                                    <input type="text" name="prodi_keputrian" x-model="formData.prodi_keputrian" placeholder="Prodi" class="w-full p-2 border rounded-xl text-sm">
                                </div>
                                <input type="file" name="foto_keputrian" class="w-full p-1 mt-2 border bg-white rounded-xl text-xs">
                            </div>

                            <div class="p-4 bg-gray-50 border rounded-2xl">
                                <label class="text-xs font-bold text-gray-500 uppercase">Sekretaris</label>
                                <input type="text" name="sekretaris" x-model="formData.sekretaris" placeholder="Nama Lengkap" class="w-full p-2 border rounded-xl mt-1 text-sm">
                                <div class="grid grid-cols-2 gap-2 mt-2">
                                    <input type="text" name="npm_sekretaris" x-model="formData.npm_sekretaris" placeholder="NPM" class="w-full p-2 border rounded-xl text-sm">
                                    <input type="text" name="prodi_sekretaris" x-model="formData.prodi_sekretaris" placeholder="Prodi" class="w-full p-2 border rounded-xl text-sm">
                                </div>
                                <input type="file" name="foto_sekretaris" class="w-full p-1 mt-2 border bg-white rounded-xl text-xs">
                            </div>

                            <div class="p-4 bg-gray-50 border rounded-2xl">
                                <label class="text-xs font-bold text-gray-500 uppercase">Bendahara</label>
                                <input type="text" name="bendahara" x-model="formData.bendahara" placeholder="Nama Lengkap" class="w-full p-2 border rounded-xl mt-1 text-sm">
                                <div class="grid grid-cols-2 gap-2 mt-2">
                                    <input type="text" name="npm_bendahara" x-model="formData.npm_bendahara" placeholder="NPM" class="w-full p-2 border rounded-xl text-sm">
                                    <input type="text" name="prodi_bendahara" x-model="formData.prodi_bendahara" placeholder="Prodi" class="w-full p-2 border rounded-xl text-sm">
                                </div>
                                <input type="file" name="foto_bendahara" class="w-full p-1 mt-2 border bg-white rounded-xl text-xs">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-6 border-t">
                    <button type="button" @click="isOpen = false" class="px-5 py-2 bg-gray-200 rounded-xl font-bold">Batal</button>
                    <button type="submit" class="px-5 py-2 bg-indigo-600 text-white rounded-xl font-bold" x-text="mode === 'create' ? 'Simpan' : 'Update Data'"></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function cabinetManager() {
        return {
            isOpen: false,
            mode: 'create',
            formData: {
                id: '', nama_kabinet: '', tahun: '', deskripsi: '',
                ketua: '', npm_ketua: '', prodi_ketua: '',
                keputrian: '', npm_keputrian: '', prodi_keputrian: '',
                sekretaris: '', npm_sekretaris: '', prodi_sekretaris: '',
                bendahara: '', npm_bendahara: '', prodi_bendahara: ''
            },
            openModal(action, data = null) {
                this.mode = action;
                if (action === 'edit' && data) {
                    this.formData = { ...data };
                } else {
                    this.formData = { 
                        id: '', nama_kabinet: '', tahun: '', deskripsi: '', 
                        ketua: '', npm_ketua: '', prodi_ketua: '',
                        keputrian: '', npm_keputrian: '', prodi_keputrian: '',
                        sekretaris: '', npm_sekretaris: '', prodi_sekretaris: '',
                        bendahara: '', npm_bendahara: '', prodi_bendahara: '' 
                    };
                }
                this.isOpen = true;
            }
        }
    }
</script>

<style> [x-cloak] { display: none !important; } </style>
@endsection