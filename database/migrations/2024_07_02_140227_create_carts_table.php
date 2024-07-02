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
        Schema::create('carts', function (Blueprint $table) {
            $table->string('cart_id')->primary();
            $table->string('customer_id');
            $table->foreign('customer_id')->references('customer_id')->on('user');
            $table->integer('quantity');
            $table->integer('cart_price');
            $table->string('product_id');
            $table->foreign('product_id')->references('product_id')->on('products');
            $table->string('size');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
