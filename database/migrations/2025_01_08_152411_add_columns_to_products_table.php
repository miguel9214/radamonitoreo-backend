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
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('profit_margin', 5, 2)->nullable()->after('purchase_price');
            $table->decimal('sale_price', 10, 2)->nullable()->after('profit_margin');
            $table->decimal('vat', 5, 2)->nullable()->after('sale_price');
            $table->decimal('total_sale_price', 10, 2)->nullable()->after('vat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['profit_margin', 'sale_price', 'vat', 'total_sale_price']);
        });
    }
};
