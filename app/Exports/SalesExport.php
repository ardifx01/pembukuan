<?php

namespace App\Exports;

use App\Models\Transaction;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class SalesExport implements FromCollection, ShouldAutoSize, WithEvents
{
    protected $startDate;
    protected $endDate;
    protected $filter;

    public function __construct($startDate = null, $endDate = null, $filter = 'month')
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->filter = $filter;
    }

    public function collection()
    {
        $query = Transaction::with([
            'details.furniture',
            'user'
        ]);

        // =====================================================
        // FILTER
        // =====================================================

        if ($this->filter == 'week') {

            $start = Carbon::now()->subDays(6)->startOfDay();
            $end = Carbon::now()->endOfDay();

        } elseif ($this->filter == 'year') {

            $start = Carbon::now()->startOfYear();
            $end = Carbon::now()->endOfYear();

        } else {

            $start = Carbon::now()->startOfMonth();
            $end = Carbon::now()->endOfMonth();
        }

        // CUSTOM RANGE
        if ($this->startDate && $this->endDate) {

            $start = Carbon::parse($this->startDate)->startOfDay();
            $end = Carbon::parse($this->endDate)->endOfDay();
        }

        $query->whereBetween('transaction_date', [$start, $end]);

        $transactions = $query
            ->orderBy('created_at', 'desc')
            ->get();

        // =====================================================
        // ROWS
        // =====================================================

        $rows = collect();

        // TITLE
        $rows->push([
            'LAPORAN TRANSAKSI PENJUALAN'
        ]);

        $rows->push([
            'Meubel Semarang'
        ]);

        $rows->push([
            'Periode: ' .
            $start->format('d/m/Y') .
            ' s/d ' .
            $end->format('d/m/Y')
        ]);

        $rows->push([
            'Dicetak: ' .
            Carbon::now('Asia/Jakarta')
                ->format('d/m/Y H:i:s') .
            ' WIB'
        ]);

        // SPACER
        $rows->push([]);

        // HEADER
        $rows->push([

            'No',
            'Tanggal',
            'No. Invoice',
            'Customer',
            'Kasir',
            'Detail Produk',
            'Subtotal',
            'Diskon',
            'Total',
            'Bayar',
            'Kembalian',
            'Sisa Hutang',
            'Metode Pembayaran',
            'Status',

        ]);

        // =====================================================
        // DATA
        // =====================================================

        foreach ($transactions as $index => $transaction) {

            $details = '';

            foreach ($transaction->details as $detail) {

                $details .=
                    $detail->furniture->name .
                    ' (' .
                    $detail->quantity .
                    ' x Rp ' .
                    number_format($detail->price, 0, ',', '.') .
                   ')' . PHP_EOL;
            }

            // PAYMENT METHOD
            $paymentMethod = '-';

            if ($transaction->payment_method == 'cash') {

                $paymentMethod = 'Tunai';

            } elseif ($transaction->payment_method == 'transfer') {

                $paymentMethod = 'Transfer';

            } elseif ($transaction->payment_method == 'qris') {

                $paymentMethod = 'QRIS';

            } elseif ($transaction->payment_method == 'credit_card') {

                $paymentMethod = 'Credit Card';

            } elseif ($transaction->payment_method == 'dp') {

                $paymentMethod = 'DP';

            } else {

                $paymentMethod =
                    ucfirst($transaction->payment_method);
            }

            // STATUS
            $paymentStatus =
                $transaction->payment_status == 'paid'
                    ? 'Lunas'
                    : 'DP';

            // ROW
            $rows->push([

                $index + 1,

                Carbon::parse($transaction->created_at)
                    ->timezone('Asia/Jakarta')
                    ->format('d/m/Y H:i') . ' WIB',

                $transaction->invoice_number,

                $transaction->customer_name ?? 'Umum',

                $transaction->user->name ?? '-',

                $details,

                'Rp ' . number_format($transaction->subtotal, 0, ',', '.'),

                $transaction->discount > 0
                    ? '- Rp ' . number_format($transaction->discount, 0, ',', '.')
                    : '-',

                'Rp ' . number_format($transaction->total, 0, ',', '.'),

                'Rp ' . number_format($transaction->paid, 0, ',', '.'),

                'Rp ' . number_format($transaction->change, 0, ',', '.'),

                $transaction->remaining_debt > 0
                    ? 'Rp ' . number_format($transaction->remaining_debt, 0, ',', '.')
                    : '-',

                $paymentMethod,

                $paymentStatus,

            ]);
        }

        return $rows;
    }

    public function registerEvents(): array
    {
        return [

            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();

                $lastRow = $sheet->getHighestRow();

                // MERGE TITLE
                $sheet->mergeCells('A1:N1');
                $sheet->mergeCells('A2:N2');
                $sheet->mergeCells('A3:N3');
                $sheet->mergeCells('A4:N4');

                // TITLE STYLE
                $sheet->getStyle('A1')->applyFromArray([

                    'font' => [
                        'bold' => true,
                        'size' => 24,
                        'color' => [
                            'argb' => 'FF1D4ED8'
                        ]
                    ],

                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER
                    ]
                ]);

                // SUBTITLE
                $sheet->getStyle('A2:A4')->applyFromArray([

                    'font' => [
                        'italic' => true,
                        'size' => 12,
                        'color' => [
                            'argb' => 'FF6B7280'
                        ]
                    ],

                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER
                    ]
                ]);

                $sheet->getStyle('A5:N5')->applyFromArray([

    'font' => [
        'bold' => true,
        'size' => 11,
        'color' => [
            'argb' => 'FFFFFFFF'
        ]
    ],

    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'argb' => 'FF1E40AF'
        ]
    ],

    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER
    ],

    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => [
                'argb' => 'FFFFFFFF'
            ]
        ]
    ]
]);

// HEADER HEIGHT
$sheet->getRowDimension(5)
    ->setRowHeight(28);

                // BORDER
               $sheet->getStyle("A5:N{$lastRow}")
                    ->applyFromArray([

                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'argb' => 'FFD1D5DB'
                                ]
                            ]
                        ]
                    ]);

                // ALIGNMENT
                $sheet->getStyle("A6:N{$lastRow}")
                    ->getAlignment()
                    ->setVertical(Alignment::VERTICAL_CENTER);

                foreach (['A','B','C','D','E','M','N'] as $column) {

                    $sheet->getStyle("{$column}6:{$column}{$lastRow}")
                        ->getAlignment()
                        ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                }

             // =====================================================
            // DETAIL PRODUK
            // =====================================================

        $sheet->getStyle("F6:F{$lastRow}")
            ->getAlignment()
            ->setWrapText(true);
        
        $sheet->getStyle("F6:F{$lastRow}")
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_LEFT);
        
        $sheet->getStyle("F6:F{$lastRow}")
            ->getAlignment()
            ->setVertical(Alignment::VERTICAL_CENTER);
            
                    // =====================================================
                    // METODE & STATUS CENTER
                    // =====================================================
        
        foreach (['M', 'N'] as $column) {
        
            $sheet->getStyle("{$column}6:{$column}{$lastRow}")
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_CENTER);
        
            $sheet->getStyle("{$column}6:{$column}{$lastRow}")
                ->getAlignment()
                ->setVertical(Alignment::VERTICAL_CENTER);
        
            $sheet->getStyle("{$column}6:{$column}{$lastRow}")
                ->getAlignment()
                ->setWrapText(false);
        }

                // NOMINAL
                foreach (['G','H','I','J','K','L'] as $column) {

                    $sheet->getStyle("{$column}6:{$column}{$lastRow}")
                        ->getAlignment()
                        ->setHorizontal(Alignment::HORIZONTAL_RIGHT);
                }

                // WIDTH
                $sheet->getColumnDimension('A')->setWidth(8);
                $sheet->getColumnDimension('B')->setWidth(24);
                $sheet->getColumnDimension('C')->setWidth(34);
                $sheet->getColumnDimension('D')->setWidth(18);
                $sheet->getColumnDimension('E')->setWidth(15);
                $sheet->getColumnDimension('F')->setWidth(55);

                foreach (['G','H','I','J','K','L'] as $column) {

                    $sheet->getColumnDimension($column)
                        ->setWidth(18);
                }

                $sheet->getColumnDimension('M')->setWidth(22);
                $sheet->getColumnDimension('N')->setWidth(14);
                
                // =====================================================
                // AUTO ROW HEIGHT
                // =====================================================

for ($i = 6; $i <= $lastRow; $i++) {

    $detailText = $sheet
        ->getCell("F{$i}")
        ->getValue();

    $lineCount =
        substr_count($detailText, PHP_EOL) + 1;

    if ($lineCount <= 1) {

        $sheet->getRowDimension($i)
            ->setRowHeight(28);

    } elseif ($lineCount == 2) {

        $sheet->getRowDimension($i)
            ->setRowHeight(42);

    } else {

        $sheet->getRowDimension($i)
            ->setRowHeight(58);
    }
}

                // FREEZE
                $sheet->freezePane('A6');
            }
        ];
    }
}