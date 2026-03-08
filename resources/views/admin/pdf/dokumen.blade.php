<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Anggota</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #2c3e50; padding-bottom: 10px; }
        .header h2 { margin: 0; font-size: 18px; text-transform: uppercase; }
        .header p { margin: 5px 0 0; font-size: 11px; color: #7f8c8d; }
        .year-title { background-color: #2c3e50; color: white; padding: 8px; font-size: 14px; margin-top: 20px; margin-bottom: 0; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        th, td { border: 1px solid #bdc3c7; padding: 8px; vertical-align: top; }
        th { background-color: #ecf0f1; font-weight: bold; text-align: left; font-size: 11px; text-transform: uppercase; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .text-center { text-align: center; }
        .footer { margin-top: 30px; font-size: 10px; text-align: right; color: #7f8c8d; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Data Anggota</h2>
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i') }}</p>
    </div>

    @php
        // Mengelompokkan data berdasarkan tahun_masuk (berurutan dari tahun terbaru)
        $groupedData = $data->groupBy(function($item) {
            return $item->tahun_masuk ?: 'Tidak Diketahui';
        })->sortKeysDesc();
    @endphp

    @foreach($groupedData as $year => $items)
        <h3 class="year-title">Angkatan Tahun: {{ $year }} ({{ count($items) }} Orang)</h3>
        <table>
            <thead>
                <tr>
                    <th class="text-center" width="5%">No</th>
                    <th width="25%">Nama Lengkap</th>
                    <th width="15%">NPM</th>
                    <th width="25%">Jurusan / Prodi</th>
                    <th width="10%">LDF</th>
                    <th width="20%">Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $index => $row)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $row->nama }}</td>
                    <td>{{ $row->npm }}</td>
                    <td>{{ $row->jurusan }} {{ $row->prodi ? ' / '.$row->prodi : '' }}</td>
                    <td>{{ $row->ldf }}</td>
                    <td>{{ $row->email }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach

    <div class="footer">
        <p>Total Keseluruhan Anggota: {{ count($data) }} Orang</p>
    </div>
</body>
</html>