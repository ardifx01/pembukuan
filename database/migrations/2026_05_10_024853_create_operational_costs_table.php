<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('operational_costs', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama biaya (Listrik, PDAM, Gaji, dll)
            $table->decimal('amount', 15, 2); // Nominal biaya
            $table->date('date'); // Tanggal biaya
            $table->string('category')->default('operational'); // operational, other
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('operational_costs');
    }
};