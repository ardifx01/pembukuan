<?php

namespace App\Exports;

use App\Models\Furniture;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ProductStockExport implements FromCollection, ShouldAutoSize, WithEvents
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate = null, $endDate = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        $products = Furniture::with('category')->get();

        $rows = collect();

        // =====================================================
        // TITLE
        // =====================================================

        $rows->push([
            'LAPORAN STOK PRODUK'
        ]);

        $rows->push([
            'Meubel Semarang'
        ]);

        if ($this->startDate && $this->endDate) {

            $periode =
                Carbon::parse($this->startDate)->format('d/m/Y') .
                ' s/d ' .
                Carbon::parse($this->endDate)->format('d/m/Y');

        } else {

            $periode =
                Carbon::now()->startOfMonth()->format('d/m/Y') .
                ' s/d ' .
                Carbon::now()->format('d/m/Y');
        }

        $rows->push([
            'Periode: ' . $periode
        ]);

        $rows->push([
            'Dicetak: ' .
            Carbon::now('Asia/Jakarta')
                ->format('d/m/Y H:i:s') .
            ' WIB'
        ]);

        // SPACER
        $rows->push([]);

        // =====================================================
        // HEADER
        // =====================================================

        $rows->push([

            'Kode Produk',
            'Nama Produk',
            'Kategori',
            'Stok Awal',
            'Stok Keluar',
            'Stok Akhir',
            'Minimal Stok',
            'Status',
            'Harga Beli',
            'Harga Jual',

        ]);

        // =====================================================
        // DATA
        // =====================================================

        foreach ($products as $product) {

            $query = TransactionDetail::where(
                'furniture_id',
                $product->id
            );

            if ($this->startDate && $this->endDate) {

                $query->whereHas('transaction', function ($q) {

                    $q->whereBetween(
                        'transaction_date',
                        [
                            $this->startDate,
                            $this->endDate . ' 23:59:59'
                        ]
                    );
                });
            }

            $stockOut = $query->sum('quantity');

            $initialStock =
                $product->stock + $stockOut;

            $status =
                $product->stock <= $product->min_stock
                    ? 'Stok Menipis'
                    : 'Aman';

            $rows->push([

                $product->code,

                $product->name,

                $product->category->name ?? '-',

                $initialStock,

                $stockOut,

                $product->stock,

                $product->min_stock,

                $status,

                'Rp ' . number_format(
                    $product->purchase_price,
                    0,
                    ',',
                    '.'
                ),

                'Rp ' . number_format(
                    $product->selling_price,
                    0,
                    ',',
                    '.'
                ),
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

            // =====================================================
            // MERGE TITLE
            // =====================================================

            $sheet->mergeCells('A1:J1');
            $sheet->mergeCells('A2:J2');
            $sheet->mergeCells('A3:J3');
            $sheet->mergeCells('A4:J4');

            // =====================================================
            // TITLE STYLE
            // =====================================================

            $sheet->getStyle('A1')->applyFromArray([
                'font' => [
                    'bold' => true,
                    'size' => 24,
                    'color' => ['argb' => 'FF1D4ED8']
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER
                ]
            ]);

            // =====================================================
            // SUBTITLE STYLE
            // =====================================================
            $sheet->getStyle('A2:A4')->applyFromArray([
                'font' => [
                    'italic' => true,
                    'size' => 12,
                    'color' => ['argb' => 'FF6B7280']
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER
                ]
            ]);

            // =====================================================
            // HEADER TABLE STYLE (Baris ke-6)
            // =====================================================
            $sheet->getStyle('A5:J5')->applyFromArray([
                'font' => [
                    'bold' => true,
                    'size' => 11,
                    'color' => ['argb' => 'FFFFFFFF']
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FF1E40AF']
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER // <--- FIX: Perataan vertikal header
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['argb' => 'FFFFFFFF']
                    ]
                ]
            ]);

            // =====================================================
            // BORDER TABLE
            // =====================================================
            $sheet->getStyle("A6:J{$lastRow}")->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['argb' => 'FFD1D5DB']
                    ]
                ]
            ]);

            // =====================================================
            // DATA COLOR & ZEBRA STRIPE
            // =====================================================
            for ($row = 6; $row <= $lastRow; $row++) { // <--- FIX: Mulai dari row 6 (header)
                $status = $sheet->getCell("H{$row}")->getValue();

                // Stok Menipis
                if ($status == 'Stok Menipis') {
                    $sheet->getStyle("A{$row}:J{$row}")->applyFromArray([
                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'startColor' => ['argb' => 'FFFEE2E2']
                        ]
                    ]);
                } 
                // JANGAN beri warna zebra pada header (baris 6)
                elseif ($row > 6) {
                    $color = ($row % 2 == 0) ? 'FFF8FAFC' : 'FFFFFFFF';
                    $sheet->getStyle("A{$row}:J{$row}")->applyFromArray([
                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'startColor' => ['argb' => $color]
                        ]
                    ]);
                }
            }

            // =====================================================
            // GLOBAL VERTICAL ALIGNMENT untuk semua data (termasuk header)
            // =====================================================
            $sheet->getStyle("A6:J{$lastRow}")->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

            // HORIZONTAL ALIGNMENT untuk tiap kolom (dimulai dari baris 6)
            // Center (Kode, Kategori, kolom angka, dll)
            foreach (['A','C','D','E','F','G','H'] as $column) {
                $sheet->getStyle("{$column}6:{$column}{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            }

            // Left (Nama Produk)
            $sheet->getStyle("B6:B{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

            // Right (Harga Beli & Jual)
            foreach (['I','J'] as $column) {
                $sheet->getStyle("{$column}6:{$column}{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
            }

            // =====================================================
            // ROW HEIGHT (disamakan antara header dan data)
            // =====================================================
            // Semua baris dari baris 6 sampai terakhir diberi tinggi 28
            for ($row = 6; $row <= $lastRow; $row++) {
                $sheet->getRowDimension($row)->setRowHeight(28);
            }

            // =====================================================
            // COLUMN WIDTH
            // =====================================================
            $sheet->getColumnDimension('A')->setWidth(18);
            $sheet->getColumnDimension('B')->setWidth(35);
            $sheet->getColumnDimension('C')->setWidth(18);
            $sheet->getColumnDimension('D')->setWidth(15);
            $sheet->getColumnDimension('E')->setWidth(15);
            $sheet->getColumnDimension('F')->setWidth(15);
            $sheet->getColumnDimension('G')->setWidth(18);
            $sheet->getColumnDimension('H')->setWidth(16);
            $sheet->getColumnDimension('I')->setWidth(20);
            $sheet->getColumnDimension('J')->setWidth(20);

            // =====================================================
            // FREEZE HEADER (membekukan baris 6)
            // =====================================================
            $sheet->freezePane('A7');
        }
    ];
}
}