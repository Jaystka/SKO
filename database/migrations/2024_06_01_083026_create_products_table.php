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
        Schema::create('category', function (Blueprint $table) {
            $table->string('category_id')->primary();
            $table->string('category');
            $table->text('category_desc');
        });

        Schema::create('material', function (Blueprint $table) {
            $table->string('material_id')->primary();
            $table->string('material');
            $table->text('material_desc');
        });

        Schema::create('products', function (Blueprint $table) {
            $table->string('product_id')->primary();
            $table->string('product');
            $table->string('brand');
            $table->string('category_id');
            $table->foreign('category_id')->references('category_id')->on('category');
            $table->integer('price');
            $table->text('image');
            $table->text('description');
            $table->text('slug')->unique();
            $table->integer('rating');
            $table->string('material_id');
            $table->foreign('material_id')->references('material_id')->on('material');
            $table->timestamps();
        });

        Schema::create('stock', function (Blueprint $table) {
            $table->string('stock_id')->primary();
            $table->string('product_id');
            $table->foreign('product_id')->references('product_id')->on('products');
            $table->string('size')->unique();
            $table->integer('total_stock');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
