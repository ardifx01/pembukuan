<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class FinancialReportExport implements FromCollection, WithHeadings, WithMapping
{
    protected $startDate;
    protected $endDate;
    protected $period;
    
    public function __construct($startDate = null, $endDate = null, $period = 'month')
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->period = $period;
    }
    
    public function collection()
    {
        $query = Transaction::with('details.furniture')
            ->where('payment_status', 'paid');
        
        if ($this->startDate && $this->endDate) {
            $query->whereBetween('transaction_date', [$this->startDate . ' 00:00:00', $this->endDate . ' 23:59:59']);
        } elseif ($this->period == 'month') {
            $query->whereMonth('transaction_date', Carbon::now()->month)
                  ->whereYear('transaction_date', Carbon::now()->year);
        } elseif ($this->period == 'year') {
            $query->whereYear('transaction_date', Carbon::now()->year);
        }
        
        return $query->orderBy('transaction_date', 'desc')->get();
    }
    
    public function headings(): array
    {
        return [
            'No. Invoice',
            'Tanggal',
            'Customer',
            'Total Penjualan',
            'HPP',
            'Laba Kotor',
            'Metode Pembayaran',
            'Status'
        ];
    }
    
    public function map($transaction): array
    {
        $hpp = 0;
        foreach ($transaction->details as $detail) {
            $hpp += ($detail->base_price ?? $detail->price ?? 0) * $detail->quantity;
        }
        
        return [
            $transaction->invoice_number,
            Carbon::parse($transaction->transaction_date)->format('d/m/Y H:i'),
            $transaction->customer_name ?? 'Umum',
            $transaction->total,
            $hpp,
            $transaction->total - $hpp,
            $transaction->payment_method == 'cash' ? 'Tunai' : ($transaction->payment_method == 'dp' ? 'DP' : 'Transfer'),
            $transaction->payment_status == 'paid' ? 'Lunas' : 'DP'
        ];
    }
}