<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Furniture;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Exports\SalesExport;
use App\Exports\ProductSalesExport;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'week');
        
        // Total Produk
        $totalProducts = Furniture::count();
        
        // Stok Menipis
        $lowStockItems = Furniture::whereRaw('stock <= min_stock')->count();
        
        // Total Supplier
        $totalSuppliers = Supplier::count();
        
        // Total Aset (Harga Beli x Stok)
        $totalAset = Furniture::sum(DB::raw('purchase_price * stock'));
        
        // ========== PENJUALAN PRODUK BULAN INI ==========
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        
        // Total produk terjual bulan ini (jumlah pcs)
        $totalProductsSoldThisMonth = Transaction::join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->where('transactions.payment_status', 'paid')
            ->whereMonth('transactions.transaction_date', $currentMonth)
            ->whereYear('transactions.transaction_date', $currentYear)
            ->sum('transaction_details.quantity');
        
        // Total penjualan bulan ini (Rp)
       $totalSalesThisMonth = Transaction::where('payment_status', 'paid')
    ->whereMonth('transaction_date', $currentMonth)
    ->whereYear('transaction_date', $currentYear)
    ->sum('total');

// Total transaksi bulan ini
$totalTransactions = Transaction::where('payment_status', 'paid')
    ->whereMonth('transaction_date', $currentMonth)
    ->whereYear('transaction_date', $currentYear)
    ->count();
        
        // Produk terlaris bulan ini (Top 5)
        $topProductsThisMonth = Transaction::select(
                'furniture.id',
                'furniture.code',
                'furniture.name',
                DB::raw('SUM(transaction_details.quantity) as total_quantity'),
                DB::raw('SUM(transaction_details.subtotal) as total_sales')
            )
            ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->join('furniture', 'transaction_details.furniture_id', '=', 'furniture.id')
            ->where('transactions.payment_status', 'paid')
            ->whereMonth('transactions.transaction_date', $currentMonth)
            ->whereYear('transactions.transaction_date', $currentYear)
            ->groupBy('furniture.id', 'furniture.code', 'furniture.name')
            ->orderBy('total_quantity', 'desc')
            ->limit(5)
            ->get();
        
        // ========== PENJUALAN PRODUK BULAN LALU ==========
        $lastMonth = Carbon::now()->subMonth()->month;
        $lastMonthYear = Carbon::now()->subMonth()->year;
        
        $totalProductsSoldLastMonth = Transaction::join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->where('transactions.payment_status', 'paid')
            ->whereMonth('transactions.transaction_date', $lastMonth)
            ->whereYear('transactions.transaction_date', $lastMonthYear)
            ->sum('transaction_details.quantity');
        
        // Persentase perubahan penjualan
        $salesTrend = 0;
        if ($totalProductsSoldLastMonth > 0) {
            $salesTrend = (($totalProductsSoldThisMonth - $totalProductsSoldLastMonth) / $totalProductsSoldLastMonth) * 100;
        } elseif ($totalProductsSoldThisMonth > 0) {
            $salesTrend = 100;
        }
        
        // Chart data
        $labels = [];
        $chartData = [];
        $title = 'Penjualan';
        $subtitle = '';
        
        switch($filter) {
            case 'week':
    $salesData = Transaction::select(
            DB::raw('DATE(transaction_date) as period'),
            DB::raw('SUM(total) as total')
        )
        // Hapus filter tanggal atau perluas rentang
        ->whereBetween('transaction_date', [now()->subDays(30), now()]) 
        ->groupBy('period')
        ->orderBy('period')
        ->get()
        ->keyBy('period');
    
                    for($i = 30; $i >= 0; $i--) { 
                    $date = now()->subDays($i);
                    $dateKey = $date->format('Y-m-d');
                    $labels[] = $date->format('d M');
                    
                    if (isset($salesData[$dateKey])) {
                        $chartData[] = (float)$salesData[$dateKey]->total;
                    } else {
                        $chartData[] = 0;
                    }
                }
                
                $title = 'Penjualan 7 Hari Terakhir';
                $subtitle = now()->subDays(6)->format('d M Y') . ' - ' . now()->format('d M Y');
                break;
                
            case 'month':
                $daysInMonth = now()->daysInMonth;
                $salesData = Transaction::select(
                        DB::raw('DAY(transaction_date) as period'),
                        DB::raw('SUM(total) as total')
                    )
                    ->whereMonth('transaction_date', now()->month)
                    ->whereYear('transaction_date', now()->year)
                    ->groupBy('period')
                    ->orderBy('period')
                    ->get()
                    ->keyBy('period');
                
                for($i = 1; $i <= $daysInMonth; $i++) {
                    $labels[] = $i;
                    if (isset($salesData[$i])) {
                        $chartData[] = (float)$salesData[$i]->total;
                    } else {
                        $chartData[] = 0;
                    }
                }
                
                $title = 'Penjualan Bulanan';
                $subtitle = now()->format('F Y');
                break;
                
            case 'year':
                $salesData = Transaction::select(
                        DB::raw('MONTH(transaction_date) as period'),
                        DB::raw('SUM(total) as total')
                    )
                    ->whereYear('transaction_date', now()->year)
                    ->groupBy('period')
                    ->orderBy('period')
                    ->get()
                    ->keyBy('period');
                
                $monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
                for($i = 1; $i <= 12; $i++) {
                    $labels[] = $monthNames[$i-1];
                    if (isset($salesData[$i])) {
                        $chartData[] = (float)$salesData[$i]->total;
                    } else {
                        $chartData[] = 0;
                    }
                }
                
                $title = 'Penjualan Tahunan';
                $subtitle = now()->year;
                break;
                
            default:
                $filter = 'week';
                $salesData = Transaction::select(
                        DB::raw('DATE(transaction_date) as period'),
                        DB::raw('SUM(total) as total')
                    )
                    ->whereBetween('transaction_date', [now()->subDays(6), now()])
                    ->groupBy('period')
                    ->orderBy('period')
                    ->get()
                    ->keyBy('period');
                
                for($i = 6; $i >= 0; $i--) {
                    $date = now()->subDays($i);
                    $dateKey = $date->format('Y-m-d');
                    $labels[] = $date->format('d M');
                    
                    if (isset($salesData[$dateKey])) {
                        $chartData[] = (float)$salesData[$dateKey]->total;
                    } else {
                        $chartData[] = 0;
                    }
                }
                
                $title = 'Penjualan 7 Hari Terakhir';
                $subtitle = now()->subDays(6)->format('d M Y') . ' - ' . now()->format('d M Y');
        }
        
        // Total penjualan periode
        $totalSales = array_sum($chartData);
        
        // Rata-rata penjualan
        $avgSales = count($chartData) > 0 ? $totalSales / count($chartData) : 0;
        
        return view('dashboard', compact(
    'totalProducts',
    'lowStockItems',
    'totalSuppliers',
    'totalAset',
    'totalSales',
    'avgSales',
    'chartData',
    'labels',
    'title',
    'subtitle',
    'filter',
    'totalProductsSoldThisMonth',
    'totalSalesThisMonth',
    'totalTransactions',
    'topProductsThisMonth',
    'totalProductsSoldLastMonth',
    'salesTrend'
));
    }
    
    public function export(Request $request)
    {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $filter = $request->get('filter', 'month');

        return Excel::download(new SalesExport($startDate, $endDate, $filter), 'laporan-penjualan-' . date('Y-m-d') . '.xlsx');
    }
}