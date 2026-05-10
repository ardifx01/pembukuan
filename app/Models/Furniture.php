<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Furniture extends Model
{
    protected $table = 'furniture';
    protected $fillable = [
    'code', 'name', 'category_id', 'supplier_id',
    'purchase_price', 'selling_price', 'reseller_price',
    'stock', 'min_stock', 'description', 'image', 'is_active'
];

    public function category(): BelongsTo { return $this->belongsTo(Category::class); }
    public function supplier(): BelongsTo { return $this->belongsTo(Supplier::class); }
    public function transactionDetails(): HasMany { return $this->hasMany(TransactionDetail::class); }
    public function stockRequests(): HasMany { return $this->hasMany(StockRequest::class); }

    // Cek stok menipis
    public function isLowStock(): bool { return $this->stock <= $this->min_stock; }

    // Update stok otomatis
    public function updateStock($quantity, $operation = 'decrease')
    {
        if ($operation === 'decrease') {
            $this->stock -= $quantity;
        } else {
            $this->stock += $quantity;
        }
        $this->save();

        // Auto request stock if low
        if ($this->isLowStock()) {
            $this->autoRequestStock();
        }
    }

    private function autoRequestStock()
    {
        StockRequest::create([
            'furniture_id' => $this->id,
            'requested_quantity' => $this->min_stock * 2,
            'reason' => 'Stok menipis, tersisa ' . $this->stock,
            'requested_by' => auth()->id() ?? 1,
            'status' => 'pending'
        ]);
    }
}