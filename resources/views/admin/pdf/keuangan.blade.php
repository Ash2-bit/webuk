<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi Keuangan</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #2c3e50; padding-bottom: 10px; }
        .header h2 { margin: 0; font-size: 18px; text-transform: uppercase; }
        .summary-box { width: 100%; margin-bottom: 20px; border-collapse: collapse; }
        .summary-box td { border: 1px solid #bdc3c7; padding: 10px; text-align: center; background-color: #f9f9f9; width: 33.33%; }
        .summary-title { font-size: 10px; text-transform: uppercase; color: #7f8c8d; font-weight: bold; }
        .summary-value { font-size: 16px; font-weight: bold; margin-top: 5px; }
        .text-green { color: #27ae60; }
        .text-red { color: #e74c3c; }
        .year-title { background-color: #8e44ad; color: white; padding: 8px; font-size: 14px; margin-top: 20px; margin-bottom: 0; }
        .year-summary { background-color: #ecf0f1; padding: 5px 8px; font-size: 11px; font-weight: bold; border-left: 1px solid #bdc3c7; border-right: 1px solid #bdc3c7; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        th, td { border: 1px solid #bdc3c7; padding: 8px; vertical-align: top; }
        th { background-color: #f4f6f7; font-weight: bold; text-align: left; font-size: 11px; text-transform: uppercase; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Transaksi Keuangan</h2>
        <p style="font-size: 11px; color: #7f8c8d; margin-top: 5px;">Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i') }}</p>
    </div>

    <table class="summary-box">
        <tr>
            <td>
                <div class="summary-title">Total Keseluruhan Pemasukan</div>
                <div class="summary-value text-green">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</div>
            </td>
            <td>
                <div class="summary-title">Total Keseluruhan Pengeluaran</div>
                <div class="summary-value text-red">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
            </td>
            <td>
                <div class="summary-title">Saldo Keseluruhan Akhir</div>
                <div class="summary-value">Rp {{ number_format($saldoAkhir, 0, ',', '.') }}</div>
            </td>
        </tr>
    </table>

    @php
        $groupedData = $data->groupBy(function($item) {
            return \Carbon\Carbon::parse($item->tanggal)->format('Y');
        })->sortKeysDesc();
    @endphp

    @foreach($groupedData as $year => $items)
        @php
            $pemasukanTahunIni = $items->where('jenis', 'pemasukan')->sum('jumlah');
            $pengeluaranTahunIni = $items->where('jenis', 'pengeluaran')->sum('jumlah');
        @endphp

        <h3 class="year-title">Tahun: {{ $year }}</h3>
        <div class="year-summary">
            Pemasukan Tahun {{ $year }}: <span class="text-green">Rp {{ number_format($pemasukanTahunIni, 0, ',', '.') }}</span> | 
            Pengeluaran Tahun {{ $year }}: <span class="text-red">Rp {{ number_format($pengeluaranTahunIni, 0, ',', '.') }}</span>
        </div>
        <table>
            <thead>
                <tr>
                    <th class="text-center" width="5%">No</th>
                    <th width="15%">Tanggal</th>
                    <th width="30%">Judul Transaksi</th>
                    <th class="text-center" width="15%">Tipe</th>
                    <th class="text-right" width="20%">Nominal (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $index => $row)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($row->tanggal)->translatedFormat('d M Y') }}</td>
                    <td>
                        <strong>{{ $row->judul }}</strong><br>
                        <span style="font-size: 10px; color: #7f8c8d;">{{ $row->keterangan }}</span>
                    </td>
                    <td class="text-center">{{ strtoupper($row->jenis) }}</td>
                    <td class="text-right">{{ number_format($row->jumlah, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</body>
</html>