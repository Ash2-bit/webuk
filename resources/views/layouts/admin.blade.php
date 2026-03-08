<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    
    @vite('resources/css/app.css')
    <title>Document</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 font-sans">

    {{-- KUNCI #1: Wrapper utama dengan flex dan tinggi layar penuh --}}
    <div class="flex h-screen">
        
        <x-sidebar />

        {{-- KUNCI #2: Container konten yang fleksibel dan menampung sisa ruang --}}
        <div class="flex-1 flex flex-col overflow-y-auto">
            
            <main class="flex-1 p-6">
                @yield('content')
            </main>

        </div>
    </div>

</body>
</html>