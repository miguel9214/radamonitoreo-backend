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
        Schema::create('accounts_receivables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->decimal('amount', 10, 2);
            $table->date('due_date');
            $table->string('status');
           $table->unsignedBigInteger('created_by_user')->nullable();
            $table->unsignedBigInteger('updated_by_user')->nullable();
            $table->timestamps();
            $table->foreign('created_by_user')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('updated_by_user')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts_receivables');
    }
};
