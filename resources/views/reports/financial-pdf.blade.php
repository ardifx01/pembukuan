<!DOCTYPE html>
<html>
<head>
    <title>Laporan Keuangan</title>
    <meta charset="utf-8">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .title {
            font-size: 18px;
            font-weight: bold;
            color: #1E40AF;
            margin-bottom: 5px;
        }
        .subtitle {
            font-size: 11px;
            color: #6B7280;
        }
        .period {
            font-size: 11px;
            color: #6B7280;
            margin-top: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #1E40AF;
            color: white;
            font-weight: bold;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .profit {
            color: #059669;
            font-weight: bold;
        }
        .loss {
            color: #DC2626;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 9px;
            color: #9CA3AF;
        }
        .summary-table td:first-child {
            font-weight: 500;
        }
        .summary-table tr:nth-child(even) {
            background-color: #f9fafb;
        }
        .total-row {
            background-color: #f3f4f6;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">LAPORAN LABA RUGI</div>
        <div class="subtitle">Meubel Semarang</div>
        <div class="period">Periode: {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}</div>
        <div class="period">Dicetak: {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}</div>
    </div>
    
    <table class="summary-table">
        <thead>
            <tr>
                <th>Keterangan</th>
                <th class="text-right">Jumlah (Rp)</th>
                <th class="text-right">Persentase (%)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total Penjualan</td>
                <td class="text-right profit">Rp {{ number_format($totalSales, 0, ',', '.') }}</td>
                <td class="text-right">100%</td>
            </tr>
            <tr>
                <td>Harga Pokok Penjualan (HPP)</td>
                <td class="text-right loss">(Rp {{ number_format($totalHpp, 0, ',', '.') }})</td>
                <td class="text-right loss">-{{ number_format($hppPercentage, 1) }}%</td>
            </tr>
            <tr style="background-color: #f0fdf4;">
                <td><strong>Laba Kotor</strong></td>
                <td class="text-right profit"><strong>Rp {{ number_format($grossProfit, 0, ',', '.') }}</strong></td>
                <td class="text-right profit"><strong>{{ number_format($grossMargin, 1) }}%</strong></td>
            </tr>
            <tr>
                <td>Biaya Operasional</td>
                <td class="text-right loss">(Rp {{ number_format($totalOperationalCost, 0, ',', '.') }})</td>
                <td class="text-right loss">-{{ number_format($operationalPercentage, 1) }}%</td>
            </tr>
            <tr>
                <td>Biaya Lain-lain</td>
                <td class="text-right loss">(Rp {{ number_format($totalOtherCost, 0, ',', '.') }})</td>
                <td class="text-right loss">-{{ number_format($otherPercentage, 1) }}%</td>
            </tr>
            <tr style="background-color: #f3e8ff;">
                <td><strong>Laba Bersih</strong></td>
                <td class="text-right profit"><strong>Rp {{ number_format($netProfit, 0, ',', '.') }}</strong></td>
                <td class="text-right profit"><strong>{{ number_format($netMargin, 1) }}%</strong></td>
            </tr>
        </tbody>
    </table>
    
    <div style="margin-top: 20px;">
        <h4 style="font-size: 12px; margin-bottom: 5px;">📊 Rasio Keuangan</h4>
        <table style="width: 60%;">
            <tr>
                <td>Gross Profit Margin</td>
                <td class="text-right">{{ number_format($grossMargin, 1) }}%</td>
            </tr>
            <tr>
                <td>Net Profit Margin</td>
                <td class="text-right">{{ number_format($netMargin, 1) }}%</td>
            </tr>
            <tr>
                <td>Rasio HPP terhadap Penjualan</td>
                <td class="text-right">{{ number_format($hppPercentage, 1) }}%</td>
            </tr>
            <tr>
                <td>Rasio Biaya Operasional</td>
                <td class="text-right">{{ number_format($operationalPercentage, 1) }}%</td>
            </tr>
        </table>
    </div>
    
    <div class="footer">
        <p>Laporan ini dibuat berdasarkan data transaksi penjualan tunai dan input biaya manual.</p>
        <p>* Laba bersih = Laba Kotor - Biaya Operasional - Biaya Lain-lain</p>
    </div>
</body>
</html>