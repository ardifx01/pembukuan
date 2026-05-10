<?php

namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class FinancialSummaryExport implements FromArray, ShouldAutoSize, WithEvents
{
    protected $startDate;
    protected $endDate;
    protected $totalSales;
    protected $totalHpp;
    protected $grossProfit;
    protected $grossMargin;
    protected $operationalCost;
    protected $otherCost;
    protected $netProfit;
    protected $netMargin;

    public function __construct(
        $startDate,
        $endDate,
        $totalSales,
        $totalHpp,
        $grossProfit,
        $grossMargin,
        $operationalCost,
        $otherCost,
        $netProfit,
        $netMargin
    ) {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->totalSales = $totalSales;
        $this->totalHpp = $totalHpp;
        $this->grossProfit = $grossProfit;
        $this->grossMargin = $grossMargin;
        $this->operationalCost = $operationalCost;
        $this->otherCost = $otherCost;
        $this->netProfit = $netProfit;
        $this->netMargin = $netMargin;
    }

    public function array(): array
    {
        $hppPercentage = $this->totalSales > 0
            ? ($this->totalHpp / $this->totalSales) * 100
            : 0;

        $operationalPercentage = $this->totalSales > 0
            ? ($this->operationalCost / $this->totalSales) * 100
            : 0;

        $otherPercentage = $this->totalSales > 0
            ? ($this->otherCost / $this->totalSales) * 100
            : 0;

        return [

            // HEADER
            ['LAPORAN LABA RUGI', '', ''],
            ['Meubel Semarang', '', ''],
            [
                'Periode: ' .
                Carbon::parse($this->startDate)->format('d/m/Y') .
                ' - ' .
                Carbon::parse($this->endDate)->format('d/m/Y'),
                '',
                ''
            ],
            [
                'Dicetak: ' .
                Carbon::now('Asia/Jakarta')->format('d/m/Y H:i:s') . ' WIB',
                '',
                ''
            ],

            ['', '', ''],

            // TABLE HEADER
            ['KETERANGAN', 'JUMLAH (RP)', 'PERSENTASE (%)'],

            // PENDAPATAN
            ['A. PENDAPATAN', '', ''],
            ['   Total Penjualan', $this->totalSales, '100%'],

            // HPP
            ['B. HARGA POKOK PENJUALAN', '', ''],
            [
                '   Harga Pokok Penjualan (HPP)',
                -$this->totalHpp,
                '-' . number_format($hppPercentage, 1) . '%'
            ],

            // LABA KOTOR
            [
                'C. LABA KOTOR',
                $this->grossProfit,
                number_format($this->grossMargin, 1) . '%'
            ],

            // BIAYA OPERASIONAL
            ['D. BIAYA OPERASIONAL', '', ''],
            [
                '   Biaya Operasional',
                -$this->operationalCost,
                '-' . number_format($operationalPercentage, 1) . '%'
            ],
            [
                '   Biaya Lain-lain',
                -$this->otherCost,
                '-' . number_format($otherPercentage, 1) . '%'
            ],

            // LABA BERSIH
            [
                'E. LABA BERSIH',
                $this->netProfit,
                number_format($this->netMargin, 1) . '%'
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();

                /*
                |--------------------------------------------------------------------------
                | MERGE HEADER
                |--------------------------------------------------------------------------
                */

                $sheet->mergeCells('A1:C1');
                $sheet->mergeCells('A2:C2');
                $sheet->mergeCells('A3:C3');
                $sheet->mergeCells('A4:C4');

                /*
                |--------------------------------------------------------------------------
                | CENTER HEADER
                |--------------------------------------------------------------------------
                */

                $sheet->getStyle('A1:A4')->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ]
                ]);

                /*
                |--------------------------------------------------------------------------
                | TITLE STYLE
                |--------------------------------------------------------------------------
                */

                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 24,
                        'color' => [
                            'argb' => 'FF1D4ED8'
                        ]
                    ]
                ]);

                $sheet->getStyle('A2')->applyFromArray([
                    'font' => [
                        'italic' => true,
                        'size' => 16,
                        'color' => [
                            'argb' => 'FF6B7280'
                        ]
                    ]
                ]);

                $sheet->getStyle('A3:A4')->applyFromArray([
                    'font' => [
                        'italic' => true,
                        'size' => 14,
                        'color' => [
                            'argb' => 'FF6B7280'
                        ]
                    ]
                ]);

                /*
                |--------------------------------------------------------------------------
                | TABLE HEADER
                |--------------------------------------------------------------------------
                */

                $sheet->getStyle('A6:C6')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
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
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],

                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                        ]
                    ]
                ]);

                /*
                |--------------------------------------------------------------------------
                | BORDER TABLE
                |--------------------------------------------------------------------------
                */

                $sheet->getStyle('A6:C14')->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'argb' => 'FFD1D5DB'
                            ]
                        ]
                    ]
                ]);

                /*
                |--------------------------------------------------------------------------
                | SECTION BOLD
                |--------------------------------------------------------------------------
                */

                foreach ([
                    'A7:C7',
                    'A9:C9',
                    'A12:C12'
                ] as $range) {

                    $sheet->getStyle($range)->applyFromArray([
                        'font' => [
                            'bold' => true,
                            'size' => 14
                        ]
                    ]);
                }

                /*
                |--------------------------------------------------------------------------
                | LABA KOTOR HIJAU
                |--------------------------------------------------------------------------
                */

                $sheet->getStyle('A11:C11')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                        'color' => [
                            'argb' => 'FF2E7D32'
                        ]
                    ]
                ]);

                /*
                |--------------------------------------------------------------------------
                | LABA BERSIH HIJAU
                |--------------------------------------------------------------------------
                */

                $sheet->getStyle('A15:C15')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                        'color' => [
                            'argb' => 'FF2E7D32'
                        ]
                    ]
                ]);

                /*
                |--------------------------------------------------------------------------
                | NEGATIVE RED
                |--------------------------------------------------------------------------
                */

                foreach ([
                    'B10:C10',
                    'B13:C13',
                    'B14:C14'
                ] as $range) {

                    $sheet->getStyle($range)
                        ->getFont()
                        ->getColor()
                        ->setARGB('FFDC2626');
                }

                /*
                |--------------------------------------------------------------------------
                | FORMAT ANGKA
                |--------------------------------------------------------------------------
                */

                $sheet->getStyle('B8:B15')
                    ->getNumberFormat()
                    ->setFormatCode('#,##0');

                /*
                |--------------------------------------------------------------------------
                | ALIGNMENT
                |--------------------------------------------------------------------------
                */

                $sheet->getStyle('B7:C15')
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_RIGHT);

                /*
                |--------------------------------------------------------------------------
                | INDENT SUB ITEM
                |--------------------------------------------------------------------------
                */

                foreach ([
                    'A8',
                    'A10',
                    'A13',
                    'A14'
                ] as $cell) {

                    $sheet->getStyle($cell)
                        ->getAlignment()
                        ->setIndent(1);
                }

                /*
                |--------------------------------------------------------------------------
                | COLUMN WIDTH
                |--------------------------------------------------------------------------
                */

                $sheet->getColumnDimension('A')->setWidth(45);
                $sheet->getColumnDimension('B')->setWidth(25);
                $sheet->getColumnDimension('C')->setWidth(20);

                /*
                |--------------------------------------------------------------------------
                | ROW HEIGHT
                |--------------------------------------------------------------------------
                */

                for ($i = 1; $i <= 15; $i++) {
                    $sheet->getRowDimension($i)->setRowHeight(30);
                }

                /*
                |--------------------------------------------------------------------------
                | FREEZE HEADER
                |--------------------------------------------------------------------------
                */

                $sheet->freezePane('A7');
            },
        ];
    }
}