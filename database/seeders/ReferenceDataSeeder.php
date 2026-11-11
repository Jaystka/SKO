<?php

namespace Database\Seeders;

use App\Models\Expedition;
use App\Models\Tax;
use Illuminate\Database\Seeder;

/**
 * Data referensi minimum agar checkout bisa berjalan. Idempoten: tidak
 * menimpa data yang sudah ada.
 */
class ReferenceDataSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['JNE', 'J&T', 'SiCepat', 'POS Indonesia'] as $name) {
            Expedition::firstOrCreate(['expedition' => $name]);
        }

        Tax::firstOrCreate(['tax_id' => 'T0000'], ['tax' => 0]);
    }
}
