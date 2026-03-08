<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Materi Bacaan</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #2c3e50; padding-bottom: 10px; }
        .header h2 { margin: 0; font-size: 18px; text-transform: uppercase; }
        .year-title { background-color: #16a085; color: white; padding: 8px; font-size: 14px; margin-top: 20px; margin-bottom: 0; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        th, td { border: 1px solid #bdc3c7; padding: 8px; vertical-align: top; }
        th { background-color: #ecf0f1; font-weight: bold; text-align: left; font-size: 11px; text-transform: uppercase; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .text-center { text-align: center; }
        .link { color: #2980b9; text-decoration: none; word-break: break-all; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Data Materi Bacaan</h2>
        <p style="font-size: 11px; color: #7f8c8d; margin-top: 5px;">Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i') }}</p>
    </div>

    @php
        $groupedData = $data->groupBy(function($item) {
            return \Carbon\Carbon::parse($item->created_at)->format('Y');
        })->sortKeysDesc();
    @endphp

    @foreach($groupedData as $year => $items)
        <h3 class="year-title">Ditambahkan Tahun: {{ $year }} ({{ count($items) }} Materi)</h3>
        <table>
            <thead>
                <tr>
                    <th class="text-center" width="5%">No</th>
                    <th width="25%">Judul Materi</th>
                    <th width="40%">Deskripsi Singkat</th>
                    <th width="30%">Tautan Akses</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $index => $row)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td><strong>{{ $row->judul }}</strong></td>
                    <td>{{ Str::limit($row->deskripsi, 80) }}</td>
                    <td><a href="{{ $row->tautan }}" class="link">{{ $row->tautan }}</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</body>
</html>