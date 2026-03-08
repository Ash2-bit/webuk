@extends('layouts.admin')

@section('content')
<div x-data="departmentManager()" class="p-6 space-y-10">
    
    <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100 flex flex-col md:flex-row gap-8 items-start relative">
        <a href="{{ route('admin.cabinets.index') }}" class="absolute top-4 right-4 p-2 bg-gray-100 rounded-lg text-sm font-bold hover:bg-gray-200">⬅️ Kembali</a>
        
        @if($cabinet->logo)
            <img src="{{ asset('storage/'.$cabinet->logo) }}" class="w-32 h-32 object-contain bg-gray-50 rounded-2xl border p-2">
        @else
            <div class="w-32 h-32 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-300 border border-indigo-100 text-sm font-bold">Tanpa Logo</div>
        @endif
        
        <div class="flex-1">
            <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">{{ $cabinet->nama_kabinet }}</h1>
            <span class="inline-block mt-2 px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-sm font-bold">Periode: {{ $cabinet->tahun }}</span>
            <p class="mt-4 text-gray-600 leading-relaxed">{{ $cabinet->deskripsi ?? 'Belum ada deskripsi untuk kabinet ini.' }}</p>
        </div>
    </div>

    <div>
        <h2 class="text-2xl font-bold mb-4 border-b-2 border-indigo-600 inline-block pb-1">Pengurus Inti</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <div class="bg-gradient-to-br from-indigo-500 to-indigo-700 p-6 rounded-3xl shadow-lg text-white flex flex-col items-center text-center gap-3">
                <img src="{{ $cabinet->foto_ketua ? asset('storage/'.$cabinet->foto_ketua) : 'https://ui-avatars.com/api/?name='.$cabinet->ketua.'&background=fff&color=4f46e5' }}" class="w-20 h-20 rounded-full border-4 border-indigo-300 object-cover shadow-sm">
                <div>
                    <p class="text-indigo-200 text-[10px] font-bold uppercase tracking-wider">Ketua Umum</p>
                    <h3 class="text-xl font-black">{{ $cabinet->ketua ?? '-' }}</h3>
                    <p class="text-xs text-indigo-100 mt-1 opacity-90">{{ $cabinet->npm_ketua ?? 'NPM -' }} | {{ $cabinet->prodi_ketua ?? 'Prodi -' }}</p>
                </div>
            </div>

            <div class="bg-gradient-to-br from-pink-500 to-pink-700 p-6 rounded-3xl shadow-lg text-white flex flex-col items-center text-center gap-3">
                <img src="{{ $cabinet->foto_keputrian ? asset('storage/'.$cabinet->foto_keputrian) : 'https://ui-avatars.com/api/?name='.$cabinet->keputrian.'&background=fff&color=ec4899' }}" class="w-20 h-20 rounded-full border-4 border-pink-300 object-cover shadow-sm">
                <div>
                    <p class="text-pink-200 text-[10px] font-bold uppercase tracking-wider">Keputrian</p>
                    <h3 class="text-xl font-black">{{ $cabinet->keputrian ?? '-' }}</h3>
                    <p class="text-xs text-pink-100 mt-1 opacity-90">{{ $cabinet->npm_keputrian ?? 'NPM -' }} | {{ $cabinet->prodi_keputrian ?? 'Prodi -' }}</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-3xl shadow-md border flex flex-col items-center text-center gap-3">
                <img src="{{ $cabinet->foto_sekretaris ? asset('storage/'.$cabinet->foto_sekretaris) : 'https://ui-avatars.com/api/?name='.$cabinet->sekretaris.'&background=f3f4f6&color=374151' }}" class="w-20 h-20 rounded-full border-4 border-gray-100 object-cover">
                <div>
                    <p class="text-gray-400 text-[10px] font-bold uppercase tracking-wider">Sekretaris</p>
                    <h3 class="text-xl font-bold text-gray-800">{{ $cabinet->sekretaris ?? '-' }}</h3>
                    <p class="text-xs text-gray-500 mt-1">{{ $cabinet->npm_sekretaris ?? 'NPM -' }} | {{ $cabinet->prodi_sekretaris ?? 'Prodi -' }}</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-3xl shadow-md border flex flex-col items-center text-center gap-3">
                <img src="{{ $cabinet->foto_bendahara ? asset('storage/'.$cabinet->foto_bendahara) : 'https://ui-avatars.com/api/?name='.$cabinet->bendahara.'&background=f3f4f6&color=374151' }}" class="w-20 h-20 rounded-full border-4 border-gray-100 object-cover">
                <div>
                    <p class="text-gray-400 text-[10px] font-bold uppercase tracking-wider">Bendahara</p>
                    <h3 class="text-xl font-bold text-gray-800">{{ $cabinet->bendahara ?? '-' }}</h3>
                    <p class="text-xs text-gray-500 mt-1">{{ $cabinet->npm_bendahara ?? 'NPM -' }} | {{ $cabinet->prodi_bendahara ?? 'Prodi -' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div>
        <h2 class="text-2xl font-bold mb-4 border-b-2 border-green-500 inline-block pb-1">Struktur Bidang</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <button @click="openModal('create')" class="border-2 border-dashed border-gray-300 rounded-3xl p-6 flex flex-col items-center justify-center text-gray-400 hover:bg-gray-50 hover:border-indigo-500 hover:text-indigo-500 transition-all min-h-[300px]">
                <span class="text-5xl mb-2">+</span>
                <span class="font-bold">Tambah Bidang Baru</span>
            </button>

            @foreach($cabinet->departments as $dept)
            <div class="bg-white rounded-3xl shadow-xl border p-6 flex flex-col justify-between">
                <div>
                    <h3 class="text-xl font-black text-gray-800 mb-6 border-b pb-2">{{ $dept->nama_bidang }}</h3>
                    
                    <div class="space-y-4 mb-4">
                        <div class="flex items-center gap-3 bg-blue-50/50 p-3 rounded-2xl border border-blue-50">
                            <img src="{{ $dept->foto_co_ikhwan ? asset('storage/'.$dept->foto_co_ikhwan) : 'https://ui-avatars.com/api/?name='.$dept->co_ikhwan.'&background=EBF8FF&color=2B6CB0' }}" class="w-14 h-14 rounded-full object-cover border-2 border-white shadow-sm">
                            <div>
                                <p class="text-[10px] text-blue-500 font-bold uppercase tracking-wider">Co Ikhwan</p>
                                <p class="text-sm font-bold text-gray-800">{{ $dept->co_ikhwan }}</p>
                                <p class="text-[10px] text-gray-500 mt-0.5">{{ $dept->npm_co_ikhwan ?? 'NPM -' }} | {{ $dept->prodi_co_ikhwan ?? 'Prodi -' }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-3 bg-pink-50/50 p-3 rounded-2xl border border-pink-50">
                            <img src="{{ $dept->foto_co_akhwat ? asset('storage/'.$dept->foto_co_akhwat) : 'https://ui-avatars.com/api/?name='.$dept->co_akhwat.'&background=FFF5F7&color=B83280' }}" class="w-14 h-14 rounded-full object-cover border-2 border-white shadow-sm">
                            <div>
                                <p class="text-[10px] text-pink-500 font-bold uppercase tracking-wider">Co Akhwat</p>
                                <p class="text-sm font-bold text-gray-800">{{ $dept->co_akhwat }}</p>
                                <p class="text-[10px] text-gray-500 mt-0.5">{{ $dept->npm_co_akhwat ?? 'NPM -' }} | {{ $dept->prodi_co_akhwat ?? 'Prodi -' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-xl border mt-4">
                        <p class="text-xs font-bold text-gray-400 uppercase mb-2">Anggota Aktif:</p>
                        <div class="text-sm text-gray-700 italic whitespace-pre-wrap max-h-32 overflow-y-auto pr-2">{{ $dept->anggota_aktif ?? 'Belum ada data' }}</div>
                    </div>
                </div>

                <div class="mt-6 flex gap-2 pt-4 border-t">
                    <button @click="openModal('edit', {{ json_encode($dept) }})" class="flex-1 py-2 bg-yellow-50 text-yellow-600 rounded-xl hover:bg-yellow-100 font-bold text-sm">Edit Bidang</button>
                    <form action="{{ route('admin.departments.destroy', $dept->id) }}" method="POST" onsubmit="return confirm('Hapus bidang ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-xl hover:bg-red-100 text-sm">Hapus</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div x-show="isOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm" x-cloak>
        <div class="bg-white rounded-3xl w-full max-w-3xl p-8 shadow-2xl overflow-y-auto max-h-[90vh]" @click.away="isOpen = false">
            <h2 class="text-2xl font-bold mb-6" x-text="mode === 'create' ? 'Tambah Bidang Baru' : 'Edit Bidang'"></h2>
            
            <form :action="mode === 'create' ? '{{ route('admin.departments.store') }}' : '/admin/departments/' + formData.id" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <template x-if="mode === 'edit'"><input type="hidden" name="_method" value="PUT"></template>
                <input type="hidden" name="cabinet_id" value="{{ $cabinet->id }}">
                
                <div>
                    <label class="text-xs font-bold text-gray-400 uppercase">Nama Bidang</label>
                    <input type="text" name="nama_bidang" x-model="formData.nama_bidang" placeholder="Contoh: Bidang Syiar" class="w-full p-3 border rounded-xl mt-1" required>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-blue-50/30 p-4 rounded-2xl border border-blue-50">
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-blue-500 uppercase">Data Co Ikhwan</label>
                        <input type="text" name="co_ikhwan" x-model="formData.co_ikhwan" placeholder="Nama Lengkap" class="w-full p-2 border rounded-xl text-sm" required>
                        <div class="flex gap-2">
                            <input type="text" name="npm_co_ikhwan" x-model="formData.npm_co_ikhwan" placeholder="NPM" class="w-full p-2 border rounded-xl text-sm">
                            <input type="text" name="prodi_co_ikhwan" x-model="formData.prodi_co_ikhwan" placeholder="Prodi" class="w-full p-2 border rounded-xl text-sm">
                        </div>
                    </div>
                    <div class="flex flex-col justify-end">
                        <label class="text-xs font-bold text-blue-400 uppercase">Foto Co Ikhwan</label>
                        <input type="file" name="foto_co_ikhwan" class="w-full p-2 border bg-white rounded-xl mt-1 text-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-pink-50/30 p-4 rounded-2xl border border-pink-50">
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-pink-500 uppercase">Data Co Akhwat</label>
                        <input type="text" name="co_akhwat" x-model="formData.co_akhwat" placeholder="Nama Lengkap" class="w-full p-2 border rounded-xl text-sm" required>
                        <div class="flex gap-2">
                            <input type="text" name="npm_co_akhwat" x-model="formData.npm_co_akhwat" placeholder="NPM" class="w-full p-2 border rounded-xl text-sm">
                            <input type="text" name="prodi_co_akhwat" x-model="formData.prodi_co_akhwat" placeholder="Prodi" class="w-full p-2 border rounded-xl text-sm">
                        </div>
                    </div>
                    <div class="flex flex-col justify-end">
                        <label class="text-xs font-bold text-pink-400 uppercase">Foto Co Akhwat</label>
                        <input type="file" name="foto_co_akhwat" class="w-full p-2 border bg-white rounded-xl mt-1 text-sm">
                    </div>
                </div>

                <div>
                    <label class="text-xs font-bold text-gray-400 uppercase mb-1 block">Daftar Anggota Aktif</label>
                    <p class="text-[10px] text-gray-400 mb-2">Disarankan format: Nama Lengkap - NPM - Prodi (Tiap orang beda baris)</p>
                    <textarea name="anggota_aktif" x-model="formData.anggota_aktif" rows="4" placeholder="Budi Santoso - G1A021001 - Informatika&#10;Siti Aminah - G1A021002 - Informatika" class="w-full p-3 border rounded-xl mt-1"></textarea>
                </div>

                <div>
                    <label class="text-xs font-bold text-gray-400 uppercase">Deskripsi Bidang (Opsional)</label>
                    <textarea name="deskripsi" x-model="formData.deskripsi" rows="2" class="w-full p-3 border rounded-xl mt-1"></textarea>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t">
                    <button type="button" @click="isOpen = false" class="px-5 py-2 bg-gray-200 rounded-xl font-bold hover:bg-gray-300">Batal</button>
                    <button type="submit" class="px-5 py-2 bg-indigo-600 text-white rounded-xl shadow-lg font-bold hover:bg-indigo-700">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function departmentManager() {
        return {
            isOpen: false,
            mode: 'create',
            formData: {
                id: '',
                nama_bidang: '',
                co_ikhwan: '', npm_co_ikhwan: '', prodi_co_ikhwan: '',
                co_akhwat: '', npm_co_akhwat: '', prodi_co_akhwat: '',
                deskripsi: '',
                anggota_aktif: '' 
            },
            
            openModal(action, data = null) {
                this.mode = action;
                if (action === 'edit' && data) {
                    this.formData = { ...data };
                } else {
                    this.formData = { 
                        id: '', nama_bidang: '', 
                        co_ikhwan: '', npm_co_ikhwan: '', prodi_co_ikhwan: '', 
                        co_akhwat: '', npm_co_akhwat: '', prodi_co_akhwat: '', 
                        deskripsi: '', anggota_aktif: '' 
                    };
                }
                this.isOpen = true;
            }
        }
    }
</script>

<style> [x-cloak] { display: none !important; } </style>
@endsection