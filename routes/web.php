<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FurnitureController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\StockRequestController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SupplierController;
use App\Exports\ProductStockExport;
use Maatwebsite\Excel\Facades\Excel;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
|
*/

// ==================== GUEST ROUTES ====================
Route::get('/', function () {
    return redirect()->route('login');
});

// ==================== AUTHENTICATED ROUTES ====================
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/export', [DashboardController::class, 'export'])->name('dashboard.export');
    Route::get('/dashboard/export-product-sales', [DashboardController::class, 'exportProductSales'])->name('dashboard.export.product-sales');
    
    // Profile Management
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::post('/password', [ProfileController::class, 'updatePassword'])->name('password');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    // ==================== MASTER DATA ====================
    
    // Categories Management
    Route::resource('categories', CategoryController::class);
    
    // Furniture / Product Management
    Route::resource('furniture', FurnitureController::class)->except(['show']);
    Route::get('stock/low', [FurnitureController::class, 'lowStock'])->name('stock.low');
    Route::get('/furniture/export-excel', function() {
    return Excel::download(new ProductStockExport(), 'laporan-stok-produk-' . date('Y-m-d') . '.xlsx'); })->name('furniture.export.excel');
    Route::get('/furniture/export-pdf', [FurnitureController::class, 'exportPdf'])->name('furniture.export.pdf');


    
    // Supplier Management
    Route::resource('supplier', SupplierController::class);

    
    // ==================== TRANSACTIONS ====================
    
    // Transaction Management
    Route::resource('transactions', TransactionController::class);
    Route::get('transactions/invoice/{id}', [TransactionController::class, 'invoice'])->name('transactions.invoice');
    
   // Cart Management (Session based)
    Route::prefix('transactions')->name('transactions.')->group(function () {

    Route::get(
        '/add-to-cart/{id}/{quantity}',
        [TransactionController::class, 'addToCart']
    )->name('add-to-cart');

    Route::get(
        '/remove-from-cart/{id}',
        [TransactionController::class, 'removeFromCart']
    )->name('remove-from-cart');

    Route::delete(
        '/clear-cart',
        [TransactionController::class, 'clearCart']
    )->name('clear-cart');

    // PAYMENT CICILAN
    Route::get(
        '/{id}/payment',
        [TransactionController::class, 'paymentForm']
    )->name('payment');

    Route::post(
        '/{id}/payment',
        [TransactionController::class, 'processPayment']
    )->name('processPayment');

});
    
    // ==================== STOCK MANAGEMENT ====================
    
    // Stock Request Management
    Route::resource('stock-requests', StockRequestController::class);
    Route::post('stock-requests/{id}/approve', [StockRequestController::class, 'approve'])->name('stock-requests.approve');

    // ==================== USERS ====================
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
    Route::post('/users', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/toggle/{id}', [App\Http\Controllers\UserController::class, 'toggleActive'])->name('users.toggle');

    // Laporan Keuangan
    Route::get('/reports/financial', [ReportController::class, 'financial'])->name('reports.financial');
    Route::get('/reports/financial/export', [ReportController::class, 'exportExcel'])->name('reports.financial.export');
    Route::get('/reports/financial/pdf', [ReportController::class, 'exportPdf'])->name('reports.financial.pdf');
    Route::post('/reports/financial/cost/store', [ReportController::class, 'storeOperationalCost'])->name('reports.financial.cost.store');
    Route::delete('/reports/financial/cost/{id}', [ReportController::class, 'deleteOperationalCost'])->name('reports.financial.cost.delete');
});

// ==================== AUTHENTICATION ROUTES ====================
require __DIR__.'/auth.php';