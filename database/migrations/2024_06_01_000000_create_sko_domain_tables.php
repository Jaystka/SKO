<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Skema domain toko SKO.
 *
 * Database produksi awalnya dibuat manual (lihat zquery/QUERY_SKO.txt), sehingga
 * setiap tabel di sini dibuat hanya jika belum ada. Dengan begitu migrasi ini
 * aman dijalankan di database produksi yang sudah berisi data maupun di
 * instalasi baru / CI.
 */
return new class extends Migration
{
    public function up(): void
    {
        $this->createIfMissing('brands', function (Blueprint $table) {
            $table->string('brand_id')->primary();
            $table->string('brand');
            $table->timestamps();
        });

        $this->createIfMissing('categories', function (Blueprint $table) {
            $table->string('category_id')->primary();
            $table->string('category');
            $table->text('category_desc')->nullable();
            $table->timestamps();
        });

        $this->createIfMissing('materials', function (Blueprint $table) {
            $table->string('material_id')->primary();
            $table->string('material');
            $table->text('material_desc')->nullable();
            $table->timestamps();
        });

        $this->createIfMissing('tax', function (Blueprint $table) {
            $table->string('tax_id')->primary();
            $table->unsignedInteger('tax')->default(0);
            $table->timestamps();
        });

        $this->createIfMissing('expeditions', function (Blueprint $table) {
            $table->string('expedition')->primary();
            $table->timestamps();
        });

        $this->createIfMissing('customers', function (Blueprint $table) {
            $table->string('customer_id')->primary();
            $table->string('username');
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone', 30)->nullable();
            $table->text('address')->nullable();
            $table->string('profile_picture')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        $this->createIfMissing('products', function (Blueprint $table) {
            $table->string('product_id')->primary();
            $table->string('brand_id')->index();
            $table->string('category_id')->nullable()->index();
            $table->string('material_id')->nullable()->index();
            $table->string('tax_id')->nullable();
            $table->string('product')->nullable();
            $table->string('series');
            $table->unsignedInteger('price');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->string('slug')->unique();
            $table->unsignedTinyInteger('rating')->default(0);
            $table->timestamps();
        });

        $this->createIfMissing('stocks', function (Blueprint $table) {
            $table->string('stock_id')->primary();
            $table->string('product_id');
            $table->string('size', 10);
            $table->unsignedInteger('total_stock')->default(0);
            $table->timestamps();
            $table->unique(['product_id', 'size']);
        });

        $this->createIfMissing('shopdisplays', function (Blueprint $table) {
            $table->string('display_id')->primary();
            $table->string('brand_id');
            $table->unsignedTinyInteger('number')->index();
            $table->timestamps();
        });

        $this->createIfMissing('carts', function (Blueprint $table) {
            $table->string('cart_id')->primary();
            $table->string('customer_id')->index();
            $table->string('product_id');
            $table->string('size', 10);
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('cart_price');
            // 0 = tidak dipilih, 1 = dipilih untuk checkout, 2 = sudah dipesan
            $table->string('status', 2)->default('1');
            $table->timestamps();
        });

        $this->createIfMissing('transactions', function (Blueprint $table) {
            $table->string('transaction_id', 64)->primary();
            $table->string('customer_id')->index();
            $table->string('recipient_name')->nullable();
            $table->string('recipient_phone', 30)->nullable();
            $table->text('address')->nullable();
            $table->string('expedition')->nullable();
            $table->string('snap_token')->nullable();
            $table->string('status', 32)->default('pending')->index();
            $table->string('payment_method')->nullable();
            $table->unsignedBigInteger('total_payment')->default(0);
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });

        $this->createIfMissing('payments', function (Blueprint $table) {
            $table->string('payment_id')->primary();
            $table->string('transaction_id', 64)->index();
            $table->string('customer_id');
            $table->string('cart_id')->nullable();
            $table->string('product_id');
            $table->string('size', 10)->nullable();
            $table->unsignedInteger('qty');
            $table->unsignedBigInteger('total_price');
            $table->string('status', 32)->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // Sengaja tidak menghapus tabel: tabel-tabel ini bisa berisi data produksi
        // yang tidak dibuat oleh migrasi ini.
    }

    private function createIfMissing(string $table, Closure $callback): void
    {
        if (! Schema::hasTable($table)) {
            Schema::create($table, $callback);
        }
    }
};
