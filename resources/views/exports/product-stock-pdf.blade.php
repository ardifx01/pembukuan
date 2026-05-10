<!DOCTYPE html>
<html>
<head>
    <title>Laporan Stok Produk</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { text-align: center; margin-bottom: 30px; }
        .title { font-size: 24px; font-weight: bold; color: #1E40AF; margin-bottom: 5px; }
        .subtitle { font-size: 12px; color: #6B7280; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #1E40AF; color: white; font-size: 11px; }
        td { font-size: 11px; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .danger { background-color: #FEE2E2; color: #DC2626; }
        .success { background-color: #DCFCE7; color: #166534; }
        .footer { margin-top: 30px; text-align: center; font-size: 10px; color: #9CA3AF; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">LAPORAN STOK PRODUK</div>
        <div class="subtitle">Periode: Semua Data | Dicetak: {{ date('d/m/Y H:i:s') }}</div>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>KODE</th>
                <th>NAMA PRODUK</th>
                <th>KATEGORI</th>
                <th class="text-right">STOK AWAL</th>
                <th class="text-right">STOK KELUAR</th>
                <th class="text-right">STOK AKHIR</th>
                <th class="text-right">MIN STOK</th>
                <th>STATUS</th>
                <th class="text-right">HARGA BELI</th>
                <th class="text-right">HARGA JUAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr class="{{ $item->status == 'Stok Menipis' ? 'danger' : 'success' }}">
                <td>{{ $item->code }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->category }}</td>
                <td class="text-right">{{ number_format($item->initial_stock, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($item->stock_out, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($item->current_stock, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($item->min_stock, 0, ',', '.') }}</td>
                <td>{{ $item->status }}</td>
                <td class="text-right">{{ number_format($item->purchase_price, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($item->selling_price, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="footer">
        <p>* Stok keluar = jumlah produk yang sudah terjual</p>
        <p>* Stok awal = Stok akhir + Stok keluar</p>
    </div>
</body>
</html>