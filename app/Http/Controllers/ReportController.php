<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Furniture;
use App\Models\OperationalCost;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FinancialSummaryExport;

class ReportController extends Controller
{
  public function financial(Request $request)
{
    // Ambil filter periode
    $period = $request->get('period', 'month');
    $startDate = $request->get('start_date');
    $endDate = $request->get('end_date');
    
    // Set default periode
    if ($period == 'month') {
        $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
    } elseif ($period == 'last_month') {
        $startDate = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
        $endDate = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');
    } elseif ($period == 'year') {
        $startDate = Carbon::now()->startOfYear()->format('Y-m-d');
        $endDate = Carbon::now()->endOfYear()->format('Y-m-d');
    } elseif ($period == 'custom' && $startDate && $endDate) {
        // sudah ada
    } else {
        $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
    }
    
    // Query transaksi lunas
    $query = Transaction::where('payment_status', 'paid')
        ->whereBetween('transaction_date', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
    
    $transactions = $query->get();
    
    // Total Penjualan
    $totalSales = $transactions->sum('total');
    
    // ========== HPP (Harga Pokok Penjualan) dari DATABASE ==========
    $totalHpp = 0;
    foreach ($transactions as $transaction) {
        foreach ($transaction->details as $detail) {
            $totalHpp += ($detail->base_price ?? $detail->price) * $detail->quantity;
        }
    }
    
    // Persentase HPP
    $hppPercentage = $totalSales > 0 ? ($totalHpp / $totalSales) * 100 : 0;
    
    // Laba Kotor
    $grossProfit = $totalSales - $totalHpp;
    $grossMargin = $totalSales > 0 ? ($grossProfit / $totalSales) * 100 : 0;
    
     // ========== BIAYA OPERASIONAL ==========
    // Gunakan whereDate untuk perbandingan tanggal
    $operationalCosts = \App\Models\OperationalCost::whereDate('date', '>=', $startDate)
        ->whereDate('date', '<=', $endDate)
        ->where('category', 'operational')
        ->orderBy('date', 'desc')
        ->get();
    
    $totalOperationalCost = $operationalCosts->sum('amount');
    
    // ========== BIAYA LAIN-LAIN ==========
    $otherCosts = \App\Models\OperationalCost::whereDate('date', '>=', $startDate)
        ->whereDate('date', '<=', $endDate)
        ->where('category', 'other')
        ->orderBy('date', 'desc')
        ->get();
    
    $totalOtherCost = $otherCosts->sum('amount');
    
    // Laba Bersih
    $netProfit = $grossProfit - $totalOperationalCost - $totalOtherCost;
    $netMargin = $totalSales > 0 ? ($netProfit / $totalSales) * 100 : 0;
    
    // Data untuk chart
    $chartLabels = [];
    $chartSalesData = [];
    
    $start = Carbon::parse($startDate);
    $end = Carbon::parse($endDate);
    $days = $start->diffInDays($end) + 1;
    
    for ($i = 0; $i < $days; $i++) {
        $date = $start->copy()->addDays($i);
        $dateStr = $date->format('Y-m-d');
        $dailySales = Transaction::where('payment_status', 'paid')
            ->whereDate('transaction_date', $dateStr)
            ->sum('total');
        
        $chartLabels[] = $date->format('d/m');
        $chartSalesData[] = $dailySales;
    }
    
    // Ringkasan per bulan
    $monthlyLabels = [];
    $monthlySalesData = [];
    $monthlyProfitData = [];
    
    for ($i = 5; $i >= 0; $i--) {
        $month = Carbon::now()->subMonths($i);
        $monthStart = $month->copy()->startOfMonth();
        $monthEnd = $month->copy()->endOfMonth();
        
        $monthSales = Transaction::where('payment_status', 'paid')
            ->whereBetween('transaction_date', [$monthStart, $monthEnd])
            ->sum('total');
        
        $monthlyLabels[] = $month->format('M Y');
        $monthlySalesData[] = $monthSales;
        $monthlyProfitData[] = $monthSales > 0 ? $monthSales * ($netMargin / 100) : 0;
    }
    
    return view('reports.financial', compact(
        'totalSales', 'totalHpp', 'grossProfit', 'grossMargin', 'hppPercentage',
        'operationalCosts', 'totalOperationalCost',
        'otherCosts', 'totalOtherCost',
        'netProfit', 'netMargin',
        'startDate', 'endDate', 'period',
        'chartLabels', 'chartSalesData',
        'monthlyLabels', 'monthlySalesData', 'monthlyProfitData'
    ));
}
    
    // Method untuk menyimpan biaya operasional
    public function storeOperationalCost(Request $request)
{
    // Debug: lihat data yang masuk
    \Log::info('Data biaya masuk:', $request->all());
    
    try {
        $validated = $request->validate([
            'name' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'category' => 'required|in:operational,other'
        ]);
        
        $cost = \App\Models\OperationalCost::create([
            'name' => $request->name,
            'amount' => $request->amount,
            'date' => $request->date,
            'category' => $request->category,
        ]);
        
        \Log::info('Biaya berhasil disimpan:', $cost->toArray());
        
        return redirect()->back()->with('success', 'Biaya berhasil ditambahkan');
        
    } catch (\Exception $e) {
        \Log::error('Error simpan biaya: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
    }
}

    
    // Method untuk menghapus biaya operasional
    public function deleteOperationalCost($id)
    {
        $cost = OperationalCost::findOrFail($id);
        $cost->delete();
        
        return redirect()->back()->with('success', 'Biaya berhasil dihapus');
    }
    
    public function exportExcel(Request $request)
{
    $startDate = $request->get('start_date');
    $endDate = $request->get('end_date');
    $period = $request->get('period', 'month');
    
    // Set default periode
    if ($period == 'month') {
        $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
    } elseif ($period == 'last_month') {
        $startDate = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
        $endDate = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');
    } elseif ($period == 'year') {
        $startDate = Carbon::now()->startOfYear()->format('Y-m-d');
        $endDate = Carbon::now()->endOfYear()->format('Y-m-d');
    }
    
    // Query transaksi
    $query = Transaction::where('payment_status', 'paid')
        ->whereBetween('transaction_date', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
    
    $transactions = $query->get();
    $totalSales = $transactions->sum('total');
    
    // HPP dari database
    $totalHpp = 0;
    foreach ($transactions as $transaction) {
        foreach ($transaction->details as $detail) {
            $totalHpp += ($detail->base_price ?? $detail->price) * $detail->quantity;
        }
    }
    
    $grossProfit = $totalSales - $totalHpp;
    $grossMargin = $totalSales > 0 ? ($grossProfit / $totalSales) * 100 : 0;
    
    // ========== BIAYA DARI INPUT MANUAL ==========
    $totalOperationalCost = \App\Models\OperationalCost::whereBetween('date', [$startDate, $endDate])
        ->where('category', 'operational')
        ->sum('amount');
    
    $totalOtherCost = \App\Models\OperationalCost::whereBetween('date', [$startDate, $endDate])
        ->where('category', 'other')
        ->sum('amount');
    
    $operationalPercentage = $totalSales > 0 ? ($totalOperationalCost / $totalSales) * 100 : 0;
    $otherPercentage = $totalSales > 0 ? ($totalOtherCost / $totalSales) * 100 : 0;
    
    $netProfit = $grossProfit - $totalOperationalCost - $totalOtherCost;
    $netMargin = $totalSales > 0 ? ($netProfit / $totalSales) * 100 : 0;
    
    return Excel::download(new FinancialSummaryExport(
        $startDate, $endDate,
        $totalSales, $totalHpp, $grossProfit, $grossMargin,
        $totalOperationalCost, $otherPercentage, $netProfit, $netMargin
    ), 'laporan-laba-rugi-' . date('Y-m-d') . '.xlsx');
}

    public function exportPdf(Request $request)
{
    $startDate = $request->get('start_date');
    $endDate = $request->get('end_date');
    $period = $request->get('period', 'month');
    
    // Set default periode
    if ($period == 'month') {
        $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
    } elseif ($period == 'last_month') {
        $startDate = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
        $endDate = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');
    } elseif ($period == 'year') {
        $startDate = Carbon::now()->startOfYear()->format('Y-m-d');
        $endDate = Carbon::now()->endOfYear()->format('Y-m-d');
    }
    
    // Query transaksi
    $query = Transaction::where('payment_status', 'paid')
        ->whereBetween('transaction_date', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
    
    $transactions = $query->get();
    $totalSales = $transactions->sum('total');
    
    // HPP dari database
    $totalHpp = 0;
    foreach ($transactions as $transaction) {
        foreach ($transaction->details as $detail) {
            $totalHpp += ($detail->base_price ?? $detail->price) * $detail->quantity;
        }
    }
    
    $grossProfit = $totalSales - $totalHpp;
    $grossMargin = $totalSales > 0 ? ($grossProfit / $totalSales) * 100 : 0;
    $hppPercentage = $totalSales > 0 ? ($totalHpp / $totalSales) * 100 : 0;
    
    // ========== BIAYA DARI INPUT MANUAL ==========
    $totalOperationalCost = \App\Models\OperationalCost::whereBetween('date', [$startDate, $endDate])
        ->where('category', 'operational')
        ->sum('amount');
    
    $totalOtherCost = \App\Models\OperationalCost::whereBetween('date', [$startDate, $endDate])
        ->where('category', 'other')
        ->sum('amount');
    
    $operationalPercentage = $totalSales > 0 ? ($totalOperationalCost / $totalSales) * 100 : 0;
    $otherPercentage = $totalSales > 0 ? ($totalOtherCost / $totalSales) * 100 : 0;
    
    $netProfit = $grossProfit - $totalOperationalCost - $totalOtherCost;
    $netMargin = $totalSales > 0 ? ($netProfit / $totalSales) * 100 : 0;
    
    $data = [
        'totalSales' => $totalSales,
        'totalHpp' => $totalHpp,
        'hppPercentage' => $hppPercentage,
        'grossProfit' => $grossProfit,
        'grossMargin' => $grossMargin,
        'totalOperationalCost' => $totalOperationalCost,
        'operationalPercentage' => $operationalPercentage,
        'totalOtherCost' => $totalOtherCost,
        'otherPercentage' => $otherPercentage,
        'netProfit' => $netProfit,
        'netMargin' => $netMargin,
        'startDate' => $startDate,
        'endDate' => $endDate
    ];
    
    $pdf = Pdf::loadView('reports.financial-pdf', $data);
    return $pdf->download('laporan-laba-rugi-' . date('Y-m-d') . '.pdf');
    }
}