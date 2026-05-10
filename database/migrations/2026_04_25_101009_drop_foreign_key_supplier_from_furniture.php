<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('furniture', function (Blueprint $table) {
            // Hapus foreign key constraint
            $table->dropForeign(['supplier_id']);
        });
    }

    public function down(): void
    {
        Schema::table('furniture', function (Blueprint $table) {
            // Kembalikan foreign key
            $table->foreign('supplier_id')->references('id')->on('suppliers')->nullOnDelete();
        });
    }
};