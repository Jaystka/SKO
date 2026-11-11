<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Menyelaraskan database produksi lama (dibuat manual) dengan kolom yang
 * dibutuhkan aplikasi. Hanya menambah kolom yang belum ada; tidak menghapus
 * atau mengubah data yang sudah ada.
 */
return new class extends Migration
{
    public function up(): void
    {
        $this->addMissing('transactions', [
            'recipient_name' => fn (Blueprint $t) => $t->string('recipient_name')->nullable(),
            'recipient_phone' => fn (Blueprint $t) => $t->string('recipient_phone', 30)->nullable(),
            'address' => fn (Blueprint $t) => $t->text('address')->nullable(),
            'expedition' => fn (Blueprint $t) => $t->string('expedition')->nullable(),
            'snap_token' => fn (Blueprint $t) => $t->string('snap_token')->nullable(),
            'status' => fn (Blueprint $t) => $t->string('status', 32)->default('pending'),
            'payment_method' => fn (Blueprint $t) => $t->string('payment_method')->nullable(),
            'total_payment' => fn (Blueprint $t) => $t->unsignedBigInteger('total_payment')->default(0),
            'paid_at' => fn (Blueprint $t) => $t->timestamp('paid_at')->nullable(),
            'created_at' => fn (Blueprint $t) => $t->timestamp('created_at')->nullable(),
            'updated_at' => fn (Blueprint $t) => $t->timestamp('updated_at')->nullable(),
        ]);

        $this->addMissing('payments', [
            'size' => fn (Blueprint $t) => $t->string('size', 10)->nullable(),
        ]);

        $this->addMissing('customers', [
            'profile_picture' => fn (Blueprint $t) => $t->string('profile_picture')->nullable(),
            'remember_token' => fn (Blueprint $t) => $t->rememberToken(),
        ]);

        $this->addMissing('carts', [
            'status' => fn (Blueprint $t) => $t->string('status', 2)->default('1'),
            'created_at' => fn (Blueprint $t) => $t->timestamp('created_at')->nullable(),
            'updated_at' => fn (Blueprint $t) => $t->timestamp('updated_at')->nullable(),
        ]);

        $this->addMissing('products', [
            'tax_id' => fn (Blueprint $t) => $t->string('tax_id')->nullable(),
            'rating' => fn (Blueprint $t) => $t->unsignedTinyInteger('rating')->default(0),
        ]);

        // Customer ID berbentuk string (C0001); kolom sessions.user_id bawaan Laravel
        // berupa integer sehingga session driver "database" gagal di MySQL strict mode.
        $this->convertIntegerColumnToString('sessions', 'user_id', 255, nullable: true);

        // Order ID lama dibuat dengan rand() (integer); format baru "SKO-..." berupa string.
        $this->convertIntegerColumnToString('transactions', 'transaction_id', 64);
        $this->convertIntegerColumnToString('payments', 'transaction_id', 64);
    }

    private function convertIntegerColumnToString(string $table, string $column, int $length, bool $nullable = false): void
    {
        if (! Schema::hasTable($table) || ! Schema::hasColumn($table, $column)) {
            return;
        }

        $type = strtolower(Schema::getColumnType($table, $column));
        if (! str_contains($type, 'int')) {
            return;
        }

        Schema::table($table, function (Blueprint $t) use ($column, $length, $nullable) {
            $definition = $t->string($column, $length);
            if ($nullable) {
                $definition->nullable();
            }
            $definition->change();
        });
    }

    public function down(): void
    {
        // Tidak di-rollback: kolom bisa sudah berisi data produksi.
    }

    /**
     * @param  array<string, Closure(Blueprint): mixed>  $columns
     */
    private function addMissing(string $table, array $columns): void
    {
        if (! Schema::hasTable($table)) {
            return;
        }

        foreach ($columns as $column => $definition) {
            if (! Schema::hasColumn($table, $column)) {
                Schema::table($table, fn (Blueprint $t) => $definition($t));
            }
        }
    }
};
