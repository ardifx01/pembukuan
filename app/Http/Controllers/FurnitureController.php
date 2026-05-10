<?php

namespace App\Http\Controllers;

use App\Models\Furniture;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\ProductStockExport;
use Maatwebsite\Excel\Facades\Excel;

class FurnitureController extends Controller
{
    public function index(Request $request)
{
    $query = Furniture::with(['category', 'supplier']);
    
    // Filter berdasarkan kategori
    if ($request->has('category') && $request->category != '') {
        $query->where('category_id', $request->category);
    }
    
    $furniture = $query->orderBy('id', 'desc')->get();
    $categories = Category::all();
    $selectedCategory = $request->category;
    
   // ✅ HITUNG TOTAL ASET (Harga Beli x Stok)
    $totalAset = 0;
    foreach ($furniture as $item) {
        $totalAset += $item->purchase_price * $item->stock;
    }
    
    return view('furniture.index', compact('furniture', 'categories', 'selectedCategory', 'totalAset'));
}

    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('furniture.create', compact('categories', 'suppliers'));
    }

public function store(Request $request)
{
    // ✅ Hapus titik dari harga (format Rupiah -> angka)
    $request->merge([
        'purchase_price' => str_replace('.', '', $request->purchase_price),
        'selling_price' => str_replace('.', '', $request->selling_price),
    ]);
    
    // Lanjutkan dengan validasi dan simpan seperti biasa
    $request->validate([
        'code' => 'required|string|unique:furniture',
        'name' => 'required|string',
        'category_id' => 'required|exists:categories,id',
        'supplier_id' => 'nullable|exists:suppliers,id',
        'purchase_price' => 'required|numeric|min:0',
        'selling_price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'min_stock' => 'nullable|integer|min:0',
        'image' => 'nullable|image|max:2048'
    ]);

    $data = $request->all();
    
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('furniture', 'public');
        $data['image'] = $path;
    }
    
    Furniture::create($data);
    
    return redirect()->route('furniture.index')->with('success', 'Produk berhasil ditambahkan');
}
public function edit(Furniture $furniture)
{
    $categories = Category::all();
    $suppliers = Supplier::where('is_active', true)->get();
    
    // ✅ Format harga ke Rupiah untuk ditampilkan di form
    $furniture->purchase_price = number_format($furniture->purchase_price, 0, ',', '.');
    $furniture->selling_price = number_format($furniture->selling_price, 0, ',', '.');
    
    return view('furniture.edit', compact('furniture', 'categories', 'suppliers'));
}

public function update(Request $request, Furniture $furniture)
{
    // ✅ Hapus titik dari harga (format Rupiah -> angka)
    $request->merge([
        'purchase_price' => str_replace('.', '', $request->purchase_price),
        'selling_price' => str_replace('.', '', $request->selling_price),
    ]);
    
    $request->validate([
        'code' => 'required|string|unique:furniture,code,' . $furniture->id,
        'name' => 'required|string',
        'category_id' => 'required|exists:categories,id',
        'supplier_id' => 'nullable|exists:suppliers,id',
        'purchase_price' => 'required|numeric|min:0',
        'selling_price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'min_stock' => 'nullable|integer|min:0',
        'image' => 'nullable|image|max:2048'
    ]);

    $data = $request->all();
    
    if ($request->hasFile('image')) {
        if ($furniture->image) {
            \Storage::disk('public')->delete($furniture->image);
        }
        $path = $request->file('image')->store('furniture', 'public');
        $data['image'] = $path;
    }
    
    $furniture->update($data);
    
    return redirect()->route('furniture.index')->with('success', 'Produk berhasil diperbarui');
}

public function destroy($id)
{
    $furniture = Furniture::find($id);
    
    if (!$furniture) {
        return redirect()->route('furniture.index')
            ->with('error', 'Produk tidak ditemukan!');
    }
    
    // Hapus file gambar
    if ($furniture->image && file_exists(public_path($furniture->image))) {
        unlink(public_path($furniture->image));
    }
    
    // Hapus produk (akan otomatis set null di transaction_details)
    $furniture->delete();
    
    return redirect()->route('furniture.index')->with('success', ' Produk berhasil dihapus!');
}
    public function lowStock()
    {
        $furniture = Furniture::whereRaw('stock <= min_stock')->get();
        return view('furniture.low-stock', compact('furniture'));
    }
    public function exportPdf()
{
    $products = Furniture::with('category')->get();
    
    $data = [];
    foreach ($products as $product) {
        $stockOut = TransactionDetail::where('furniture_id', $product->id)->sum('quantity');
        $initialStock = $product->stock + $stockOut;
        
        $data[] = (object) [
            'code' => $product->code,
            'name' => $product->name,
            'category' => $product->category->name ?? '-',
            'initial_stock' => $initialStock,
            'stock_out' => $stockOut,
            'current_stock' => $product->stock,
            'min_stock' => $product->min_stock,
            'status' => $product->stock <= $product->min_stock ? 'Stok Menipis' : 'Aman',
            'purchase_price' => $product->purchase_price,
            'selling_price' => $product->selling_price,
        ];
    }
    
    $pdf = Pdf::loadView('exports.product-stock-pdf', compact('data'));
    return $pdf->download('laporan-stok-produk-' . date('Y-m-d') . '.pdf');
}

}