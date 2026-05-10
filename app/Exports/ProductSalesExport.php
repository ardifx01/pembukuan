<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Carbon\Carbon;
use App\Exports\ProductSalesExport;


class ProductSalesExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithEvents
{
    protected $year;
    
    public function __construct($year = null)
    {
        $this->year = $year ?? Carbon::now()->year;
    }
    
    public function collection()
    {
        $monthlyProductSales = Transaction::select(
                'furniture.code',
                'furniture.name',
                DB::raw('MONTH(transactions.transaction_date) as month'),
                DB::raw('SUM(transaction_details.quantity) as total_quantity'),
                DB::raw('SUM(transaction_details.subtotal) as total_sales')
            )
            ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->join('furniture', 'transaction_details.furniture_id', '=', 'furniture.id')
            ->where('transactions.payment_status', 'paid')
            ->whereYear('transactions.transaction_date', $this->year)
            ->groupBy('furniture.code', 'furniture.name', 'month')
            ->orderBy('month', 'asc')
            ->orderBy('furniture.name', 'asc')
            ->get();
        
        // Format data untuk export
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
        $products = [];
        
        foreach ($monthlyProductSales as $sale) {
            $key = $sale->code . '|' . $sale->name;
            if (!isset($products[$key])) {
                $products[$key] = [
                    'code' => $sale->code,
                    'name' => $sale->name,
                    'sales' => array_fill(0, 12, 0),
                    'quantity' => array_fill(0, 12, 0),
                ];
            }
            $monthIndex = $sale->month - 1;
            $products[$key]['sales'][$monthIndex] = $sale->total_sales;
            $products[$key]['quantity'][$monthIndex] = $sale->total_quantity;
        }
        
        $result = [];
        foreach ($products as $product) {
            $row = [
                $product['code'],
                $product['name'],
            ];
            for ($i = 0; $i < 12; $i++) {
                $row[] = $product['sales'][$i] > 0 ? $product['sales'][$i] : 0;
                $row[] = $product['quantity'][$i] > 0 ? $product['quantity'][$i] : 0;
            }
            $row[] = array_sum($product['sales']);
            $result[] = $row;
        }
        
        return collect($result);
    }
    
    public function headings(): array
    {
        $headings = ['Kode Produk', 'Nama Produk'];
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
        
        foreach ($months as $month) {
            $headings[] = $month . ' (Rp)';
            $headings[] = $month . ' (Qty)';
        }
        $headings[] = 'Total (Rp)';
        
        return $headings;
    }
    
    public function styles(Worksheet $sheet)
    {
        // Header style
        $sheet->getStyle('A1:' . $sheet->getHighestColumn() . '1')->applyFromArray([
            'font' => ['bold' => true, 'size' => 11, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '1E40AF']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);
        
        // Format angka
        $lastRow = $sheet->getHighestRow();
        $lastColumn = $sheet->getHighestColumn();
        $sheet->getStyle('C2:' . $lastColumn . $lastRow)->getNumberFormat()->setFormatCode('#,##0');
        
        return $sheet;
    }
    
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $lastRow = $sheet->getHighestRow();
                $lastColumn = $sheet->getHighestColumn();
                
                // Border untuk semua data
                $sheet->getStyle('A1:' . $lastColumn . $lastRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => ['borderStyle' => Border::BORDER_THIN],
                    ],
                ]);
                
                // Alignment untuk kolom angka
                $sheet->getStyle('C2:' . $lastColumn . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
            },
        ];
    }
    public function exportProductSales(Request $request)
{
    $year = $request->get('year', date('Y'));
    return Excel::download(new ProductSalesExport($year), 'laporan-penjualan-produk-' . $year . '.xlsx');
}

}