@extends('layouts.admin')

@section('title', 'Dashboard Pengelolaan Organisasi')

@section('content')
<div 
    class="space-y-10" 
    x-data 
    x-init="$nextTick(() => { 
        const observer = new IntersectionObserver(entries => { 
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('opacity-100', 'translate-y-0', 'scale-100');
            });
        }, { threshold: 0.1 });
        document.querySelectorAll('.fade-section').forEach(el => {
            el.classList.add('opacity-0', 'translate-y-5', 'scale-95', 'transition-all', 'duration-700');
            observer.observe(el);
        });
    })"
>

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 fade-section">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">
                🏢 Dashboard Pengelolaan UKM KEROHANIAN
            </h1>
            <p class="text-gray-500 mt-1">
                Pantau kegiatan, anggota, keuangan, dan data statistik organisasi
            </p>
        </div>
    </div>

    {{-- STATISTIK UTAMA --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 fade-section">

        @foreach ($stats as $stat)
        <div 
            class="relative bg-gradient-to-r {{ $stat['color'] }} rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 fade-section">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium opacity-80 text-white">{{ $stat['title'] }}</h3>
                    <p class="text-4xl font-extrabold mt-2 text-white">{{ $stat['value'] }}</p>
                </div>
                <div class="text-4xl text-white opacity-80">{{ $stat['emoji'] }}</div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- GRAFIK --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 fade-section">
        {{-- Line Chart dengan Filter --}}
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-1">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-2">
                        <span class="text-green-600">📈</span> Statistik Pendaftaran
                    </h2>
                    <select 
                        x-model="periode" 
                        @change="updateChart($event.target.value)"
                        class="text-sm border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500"
                    >
                        <option value="bulanan">Bulanan (Tahun Ini)</option>
                        <option value="tahunan">Tahunan (5 Tahun Terakhir)</option>
                    </select>
                </div>
                <div class="relative h-64">
                    <canvas id="pendaftaranChart"></canvas>
                </div>
            </div>
        </div>

        {{-- Doughnut Chart --}}
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-1">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-2">
                        <span class="text-blue-600">📊</span> Persentase Data Anggota LDF
                    </h2>
                </div>
                <div class="relative h-64">
                    <canvas id="divisiChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    {{-- TABEL PESAN --}}
    <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100 mt-10 fade-section">
        
        {{-- Flash Message Success --}}
        @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
        @endif

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
            <h2 class="text-xl font-semibold text-gray-800 border-l-4 border-blue-600 pl-3">
                📨 Kotak Masuk (Contact Form)
            </h2>
            <div class="flex gap-2">
                <div class="text-sm text-gray-500 px-4 py-2">
                    Total Pesan: <span class="font-bold text-gray-800">{{ $messages->total() }}</span>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto rounded-xl border border-gray-200 shadow-md">
            <table class="min-w-full border-collapse text-sm">
                <thead class="bg-gradient-to-r from-blue-50 to-indigo-50 text-gray-800">
                    <tr>
                        <th class="px-5 py-3 text-left font-semibold w-12">#</th>
                        <th class="px-5 py-3 text-left font-semibold w-1/4">Pengirim</th>
                        <th class="px-5 py-3 text-left font-semibold w-1/3">Isi Pesan</th>
                        <th class="px-5 py-3 text-left font-semibold">Waktu Masuk</th>
                        <th class="px-5 py-3 text-left font-semibold">Status</th>
                        <th class="px-5 py-3 text-center font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($messages as $index => $msg)
                    <tr class="hover:bg-blue-50/60 transition-all duration-200 odd:bg-white even:bg-blue-50/20">
                        <td class="px-5 py-4 text-gray-500">{{ $messages->firstItem() + $index }}</td>
                        
                        {{-- Pengirim --}}
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-sm shrink-0 uppercase">
                                    {{ substr($msg->nama, 0, 1) }}
                                </div>
                                <div class="min-w-0">
                                    <p class="font-semibold text-gray-800 truncate">{{ $msg->nama }}</p>
                                    <p class="text-xs text-blue-500 truncate">{{ $msg->email }}</p>
                                </div>
                            </div>
                        </td>

                        {{-- Isi Pesan --}}
                        <td class="px-5 py-4">
                            <div class="max-w-xs md:max-w-sm">
                                <p class="text-gray-600 truncate font-medium">"{{ $msg->pesan }}"</p>
                            </div>
                        </td>

                        {{-- Tanggal --}}
                        <td class="px-5 py-4 text-gray-500 whitespace-nowrap text-xs">
                            {{ $msg->created_at->format('d M Y, H:i') }}
                            <br>
                            <span class="text-[10px] text-gray-400">({{ $msg->created_at->diffForHumans() }})</span>
                        </td>

                        {{-- Status Badge --}}
                        <td class="px-5 py-4">
                            @php
                                $statusClass = match($msg->status) {
                                    'Baru' => 'bg-red-100 text-red-700 border-red-200',
                                    'Dibalas' => 'bg-green-100 text-green-700 border-green-200',
                                    'Dibaca' => 'bg-gray-100 text-gray-600 border-gray-200',
                                    default => 'bg-gray-100 text-gray-600'
                                };
                            @endphp
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $statusClass }}">
                                {{ $msg->status }}
                            </span>
                        </td>

                        {{-- KOLOM AKSI (MODIFIKASI) --}}
                        <td class="px-5 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                
                                {{-- 1. TOMBOL TANDAI DIBACA --}}
                                @if($msg->status == 'Baru')
                                    {{-- Jika status 'Baru', Tampilkan Tombol Aktif --}}
                                    <form action="{{ route('admin.pesan.read', $msg->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" title="Tandai Sudah Dibaca" class="p-2 bg-green-50 border border-green-200 text-green-600 hover:bg-green-600 hover:text-white rounded-lg transition-colors shadow-sm">
                                            {{-- Ikon Checklist --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                            </svg>
                                        </button>
                                    </form>
                                @else
                                    {{-- Jika sudah dibaca, Tampilkan Indikator Pasif --}}
                                    <div title="Pesan Sudah Dibaca" class="p-2 bg-gray-50 border border-gray-200 text-gray-400 rounded-lg cursor-default">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                        </svg>
                                    </div>
                                @endif

                                {{-- 2. TOMBOL HAPUS --}}
                                <form action="{{ route('admin.pesan.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan dari {{ $msg->nama }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button title="Hapus Pesan" type="submit" class="p-2 bg-white border border-gray-200 hover:bg-red-50 text-gray-500 hover:text-red-600 rounded-lg transition-colors shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                        </svg>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-500 bg-gray-50 rounded-b-xl">
                            <p class="text-lg font-medium">Belum ada pesan masuk</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination Links --}}
        @if($messages->hasPages())
        <div class="mt-6">
            {{ $messages->links() }} 
        </div>
        @endif
        
    </div>
</div>
{{-- SCRIPT --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<script>
    // Data dari Controller
    const dataBulanan = {!! json_encode($chartBulanan) !!};
    const labelsBulanan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    const dataTahunan = {!! json_encode($chartTahunanData) !!};
    const labelsTahunan = {!! json_encode($chartTahunanLabels) !!};

    // 1. Inisialisasi Line Chart
    const pendaftaranCtx = document.getElementById('pendaftaranChart').getContext('2d');
    let pendaftaranChart = new Chart(pendaftaranCtx, {
        type: 'line',
        data: {
            labels: labelsBulanan,
            datasets: [{
                label: 'Anggota Baru',
                data: dataBulanan,
                borderColor: '#16a34a',
                backgroundColor: 'rgba(34,197,94,0.2)',
                borderWidth: 3,
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
    });

    // Fungsi Toggle Chart (Dipanggil via Alpine @change)
    function updateChart(val) {
        if (val === 'bulanan') {
            pendaftaranChart.data.labels = labelsBulanan;
            pendaftaranChart.data.datasets[0].data = dataBulanan;
        } else {
            pendaftaranChart.data.labels = labelsTahunan;
            pendaftaranChart.data.datasets[0].data = dataTahunan;
        }
        pendaftaranChart.update();
    }

    // 2. Doughnut Chart (9 Warna)
    const divisiCtx = document.getElementById('divisiChart').getContext('2d');
    new Chart(divisiCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($dataLDF->pluck('ldf')) !!},
            datasets: [{
                data: {!! json_encode($dataLDF->pluck('total')) !!},
                backgroundColor: [
                    '#4F46E5', '#10B981', '#F59E0B', '#EF4444', 
                    '#8B5CF6', '#EC4899', '#06B6D4', '#F97316', '#64748B'
                ],
                borderWidth: 3,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { 
                legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20 } } 
            },
            cutout: '65%'
        }
    });
</script>
@endsection