<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('furniture', function (Blueprint $table) {
            // Tambah kolom purchase_price setelah selling_price atau di posisi yang diinginkan
            $table->decimal('purchase_price', 15, 2)->after('supplier_id')->nullable(false)->default(0);
            
            // Optional: Jika ingin mengubah urutan kolom (hanya untuk MySQL)
            // $table->decimal('purchase_price', 15, 2)->after('supplier_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('furniture', function (Blueprint $table) {
            $table->dropColumn('purchase_price');
        });
    }
};