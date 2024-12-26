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
        Schema::create('cash_registers', function (Blueprint $table) {
            $table->id();
            $table->decimal('initial_amount', 10, 2); // Monto inicial en caja
            $table->decimal('final_amount', 10, 2)->nullable(); // Monto final en caja
           $table->unsignedBigInteger('created_by_user')->nullable();
            $table->unsignedBigInteger('updated_by_user')->nullable();
            $table->timestamps();
            $table->foreign('created_by_user')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('updated_by_user')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_registers');
    }
};
