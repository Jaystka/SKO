<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * php artisan db:seed            -> data referensi + admin (aman untuk produksi)
     * php artisan db:seed --class=DemoSeeder   -> produk contoh (hanya lokal)
     */
    public function run(): void
    {
        $this->call([
            ReferenceDataSeeder::class,
            AdminSeeder::class,
        ]);

        if (app()->environment('local')) {
            $this->call(DemoSeeder::class);
        }
    }
}
