<?php

namespace Tests\Feature;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

/**
 * Mensimulasikan database produksi lama (dibuat manual tanpa migrasi Laravel)
 * dan memastikan migrasi baru dapat dijalankan tanpa merusak data.
 */
class LegacySchemaMigrationTest extends TestCase
{
    public function test_migrations_upgrade_legacy_schema_without_losing_data(): void
    {
        Schema::create('sessions', function (Blueprint $t) {
            $t->string('id')->primary();
            $t->unsignedBigInteger('user_id')->nullable()->index();
            $t->longText('payload');
            $t->integer('last_activity');
        });
        Schema::create('transactions', function (Blueprint $t) {
            $t->integer('transaction_id')->primary();
            $t->string('customer_id');
            $t->text('address')->nullable();
            $t->string('expedition')->nullable();
            $t->string('snap_token')->nullable();
            $t->string('status')->nullable();
        });
        Schema::create('payments', function (Blueprint $t) {
            $t->string('payment_id')->primary();
            $t->integer('transaction_id');
            $t->string('customer_id');
            $t->string('cart_id');
            $t->string('product_id');
            $t->integer('total_price');
            $t->integer('qty');
            $t->string('status');
        });
        Schema::create('carts', function (Blueprint $t) {
            $t->string('cart_id')->primary();
            $t->string('customer_id');
            $t->integer('quantity');
            $t->integer('cart_price');
            $t->string('product_id');
            $t->string('size');
        });
        DB::table('transactions')->insert(['transaction_id' => 123456, 'customer_id' => 'C0001', 'status' => 'settlement']);

        $this->artisan('migrate', ['--force' => true])->assertSuccessful();

        $this->assertTrue(Schema::hasColumns('transactions', ['total_payment', 'payment_method', 'paid_at', 'recipient_name']));
        $this->assertTrue(Schema::hasColumn('payments', 'size'));
        $this->assertTrue(Schema::hasColumn('carts', 'status'));
        $this->assertTrue(Schema::hasTable('products') && Schema::hasTable('customers') && Schema::hasTable('stocks'));
        $this->assertStringNotContainsString('int', strtolower(Schema::getColumnType('transactions', 'transaction_id')));
        $this->assertStringNotContainsString('int', strtolower(Schema::getColumnType('sessions', 'user_id')));

        $this->assertSame('settlement', DB::table('transactions')->where('transaction_id', '123456')->value('status'));
        DB::table('transactions')->insert(['transaction_id' => 'SKO-241111-ABC123', 'customer_id' => 'C0001']);
        $this->assertSame(2, DB::table('transactions')->count());
    }
}
