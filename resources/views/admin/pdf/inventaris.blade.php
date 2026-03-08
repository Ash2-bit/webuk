<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Inventaris</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #2c3e50; padding-bottom: 10px; }
        .header h2 { margin: 0; font-size: 18px; text-transform: uppercase; }
        .header p { margin: 5px 0 0; font-size: 11px; color: #7f8c8d; }
        .year-title { background-color: #27ae60; color: white; padding: 8px; font-size: 14px; margin-top: 20px; margin-bottom: 0; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        th, td { border: 1px solid #bdc3c7; padding: 8px; vertical-align: top; }
        th { background-color: #ecf0f1; font-weight: bold; text-align: left; font-size: 11px; text-transform: uppercase; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Data Inventaris</h2>
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i') }}</p>
    </div>

    @php
        $groupedData = $data->groupBy(function($item) {
            return $item->tanggal_masuk ? \Carbon\Carbon::parse($item->tanggal_masuk)->format('Y') : 'Tidak Diketahui';
        })->sortKeysDesc();
    @endphp

    @foreach($groupedData as $year => $items)
        <h3 class="year-title">Masuk Tahun: {{ $year }} ({{ count($items) }} Jenis Barang)</h3>
        <table>
            <thead>
                <tr>
                    <th class="text-center" width="5%">No</th>
                    <th width="25%">Nama Barang</th>
                    <th class="text-center" width="10%">Jumlah</th>
                    <th width="20%">Kondisi</th>
                    <th width="20%">Lokasi</th>
                    <th width="20%">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $index => $row)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $row->nama_barang }}</td>
                    <td class="text-center">{{ $row->jumlah }}</td>
                    <td>{{ $row->kondisi ?? '-' }}</td>
                    <td>{{ $row->lokasi }}</td>
                    <td>{{ str_replace('_', ' ', strtoupper($row->ketersediaan)) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</body>
</html>