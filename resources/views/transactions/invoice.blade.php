<!DOCTYPE html>
<html>
<head>
    <title>Nota Penjualan - {{ $transaction->invoice_number }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', 'Poppins', 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .invoice-container {
            max-width: 500px;
            width: 100%;
            margin: 0 auto;
            animation: slideUp 0.5s ease;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .invoice-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        
        .invoice-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .invoice-header h1 {
            font-size: 24px;
            margin-bottom: 5px;
            font-weight: 700;
        }
        
        .invoice-header p {
            font-size: 12px;
            opacity: 0.9;
            margin-top: 5px;
        }
        
        .invoice-body {
            padding: 30px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 16px;
            margin-bottom: 25px;
        }
        
        .info-item {
            display: flex;
            flex-direction: column;
        }
        
        .info-label {
            font-size: 11px;
            text-transform: uppercase;
            font-weight: 600;
            color: #6c757d;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }
        
        .info-value {
            font-size: 14px;
            font-weight: 600;
            color: #2d3748;
        }
        
        .items-table {
            width: 100%;
            margin-bottom: 25px;
        }
        
        .items-table-header {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 12px;
            display: grid;
            grid-template-columns: 2fr 0.8fr 1.2fr 1.2fr;
            gap: 10px;
            margin-bottom: 10px;
            font-weight: 700;
            font-size: 12px;
            color: #6c757d;
            text-transform: uppercase;
        }
        
        .items-table-row {
            display: grid;
            grid-template-columns: 2fr 0.8fr 1.2fr 1.2fr;
            gap: 10px;
            padding: 12px;
            border-bottom: 1px solid #e9ecef;
            font-size: 13px;
        }
        
        .items-table-row:last-child {
            border-bottom: none;
        }
        
        .product-name {
            font-weight: 600;
            color: #2d3748;
        }
        
        .total-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 16px;
            padding: 20px;
            margin-top: 20px;
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
        }
        
        .total-row.total {
            border-top: 2px solid #dee2e6;
            margin-top: 8px;
            padding-top: 12px;
            font-weight: 800;
            font-size: 18px;
            color: #667eea;
        }
        
        .total-label {
            font-weight: 600;
            color: #6c757d;
        }
        
        .total-value {
            font-weight: 700;
            color: #2d3748;
        }
        
        .total-row.total .total-value {
            color: #667eea;
            font-size: 20px;
        }
        
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px dashed #dee2e6;
        }
        
        .footer p {
            font-size: 11px;
            color: #6c757d;
            margin: 5px 0;
        }
        
        .button-group {
            display: flex;
            gap: 12px;
            justify-content: center;
            margin-top: 20px;
            padding: 0 30px 30px;
        }
        
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        .btn-secondary {
            background: #f8f9fa;
            color: #6c757d;
            border: 1px solid #dee2e6;
        }
        
        .btn-secondary:hover {
            background: #e9ecef;
        }
        
        @media print {
            body {
                background: white;
                padding: 0;
            }
            .button-group {
                display: none;
            }
            .invoice-card {
                box-shadow: none;
            }
            .invoice-header {
                background: #667eea;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .total-section {
                background: #f8f9fa;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="invoice-card">
            <div class="invoice-header">
                <h1>🧾 NOTA PENJUALAN</h1>
                <p>{{ $transaction->invoice_number }}</p>
            </div>
            
            <div class="invoice-body">
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Tanggal</span>
                        <span class="info-value">{{ $transaction->created_at ? $transaction->created_at->format('d/m/Y H:i') : date('d/m/Y H:i') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Kasir</span>
                        <span class="info-value">{{ $transaction->user->name ?? 'Admin' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Pelanggan</span>
                        <span class="info-value">{{ $transaction->customer_name ?? 'Umum' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Invoice</span>
                        <span class="info-value">#{{ $transaction->invoice_number }}</span>
                    </div>
                </div>
                
                <div class="items-table">
                    <div class="items-table-header">
                        <span>Produk</span>
                        <span class="text-center">Qty</span>
                        <span class="text-right">Harga</span>
                        <span class="text-right">Subtotal</span>
                    </div>
                    
                    @foreach($transaction->details as $detail)
                    <div class="items-table-row">
                        <span class="product-name">{{ $detail->furniture->name ?? 'Produk' }}</span>
                        <span class="text-center">{{ $detail->quantity }}</span>
                        <span class="text-right">Rp {{ number_format($detail->price, 0, ',', '.') }}</span>
                        <span class="text-right">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                    </div>
                    @endforeach
                </div>
                
             <div class="total-section">

    {{-- SUBTOTAL --}}
    <div class="total-row">

        <span class="total-label">
            Subtotal
        </span>

        <span class="total-value">
            Rp {{ number_format($transaction->subtotal, 0, ',', '.') }}
        </span>

    </div>

    {{-- DISKON --}}
    @if($transaction->discount > 0)

    <div class="total-row">

        <span class="total-label" style="color:#dc2626;">
            Diskon / Potongan
        </span>

        <span class="total-value" style="color:#dc2626;">
            - Rp {{ number_format($transaction->discount, 0, ',', '.') }}
        </span>

    </div>

    @endif

    {{-- TOTAL --}}
    <div class="total-row total">

        <span class="total-label">
            TOTAL
        </span>

        <span class="total-value">
            Rp {{ number_format($transaction->total, 0, ',', '.') }}
        </span>

    </div>

    {{-- KHUSUS DP --}}
    @if($transaction->payment_method == 'dp')

        <div class="total-row">

            <span class="total-label" style="color:#d97706;">
                DP Dibayar
            </span>

            <span class="total-value" style="color:#d97706;">
                Rp {{ number_format($transaction->paid, 0, ',', '.') }}
            </span>

        </div>

        <div class="total-row">

            <span class="total-label" style="color:#dc2626;">
                Sisa Hutang
            </span>

            <span class="total-value" style="color:#dc2626;">
                Rp {{ number_format($transaction->remaining_debt, 0, ',', '.') }}
            </span>

        </div>

        <div style="margin-top:10px;">

            <span style="
                background:#fef3c7;
                color:#92400e;
                padding:6px 12px;
                border-radius:999px;
                font-size:12px;
                font-weight:700;
            ">

                Status: DP / Cicilan

            </span>

        </div>

    @else

        {{-- BAYAR --}}
        <div class="total-row">

            <span class="total-label">
                Bayar
            </span>

            <span class="total-value">
                Rp {{ number_format($transaction->paid, 0, ',', '.') }}
            </span>

        </div>

        {{-- KEMBALI --}}
        <div class="total-row">

            <span class="total-label">
                Kembali
            </span>

            <span class="total-value"
                  style="color:#16a34a;">

                Rp {{ number_format($transaction->change, 0, ',', '.') }}

            </span>

        </div>

    @endif

</div>

                
                <div class="footer">
                    <p>✨ Terima kasih atas kunjungan Anda ✨</p>
                    <p>Barang yang sudah dibeli tidak dapat dikembalikan</p>
                    <p style="margin-top: 10px; font-size: 10px;">Simpan nota ini sebagai bukti pembelian</p>
                </div>
            </div>
        </div>
        
        <div class="button-group">
            <button class="btn btn-primary" onclick="window.print()">
                🖨️ Cetak Nota
            </button>
            <button class="btn btn-secondary" onclick="window.location.href='{{ route('transactions.create') }}'">
                ➕ Transaksi Baru
            </button>
            <button class="btn btn-secondary" onclick="window.location.href='{{ route('transactions.index') }}'">
                📋 Riwayat
            </button>
        </div>
    </div>
</body>
</html>