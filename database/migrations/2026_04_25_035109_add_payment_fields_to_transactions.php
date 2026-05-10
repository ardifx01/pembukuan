<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->enum('payment_method', ['cash', 'transfer', 'credit_card', 'dp'])->default('cash')->after('paid');
            $table->enum('payment_status', ['paid', 'unpaid', 'down_payment'])->default('paid')->after('payment_method');
            $table->decimal('remaining_debt', 12, 2)->default(0)->after('change');
        });
    }

    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['payment_method', 'payment_status', 'remaining_debt']);
        });
    }
};