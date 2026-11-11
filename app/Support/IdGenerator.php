<?php

namespace App\Support;

use Illuminate\Support\Facades\DB;

/**
 * Membuat ID berurutan berprefix seperti C0001, P0001, S0001, PY001.
 *
 * Mengambil angka terbesar secara numerik (bukan urutan string) sehingga tetap
 * benar untuk ID dengan panjang berbeda (mis. PY999 -> PY1000) dan berjalan di
 * MySQL/MariaDB maupun SQLite. Pemanggil sebaiknya membungkusnya dalam
 * DB::transaction agar baris terkunci (lockForUpdate) dan dua request tidak
 * mendapat ID yang sama.
 */
class IdGenerator
{
    public static function next(string $table, string $column, string $prefix, int $pad = 4): string
    {
        $driver = DB::connection()->getDriverName();
        $castType = in_array($driver, ['mysql', 'mariadb'], true) ? 'UNSIGNED' : 'INTEGER';
        $grammar = DB::connection()->getQueryGrammar();
        $wrapped = $grammar->wrap($column);
        $start = strlen($prefix) + 1;

        $max = DB::table($table)
            ->where($column, 'like', addcslashes($prefix, '%_\\').'%')
            ->lockForUpdate()
            ->max(DB::raw("CAST(SUBSTR({$wrapped}, {$start}) AS {$castType})"));

        return $prefix.str_pad((string) ((int) $max + 1), $pad, '0', STR_PAD_LEFT);
    }
}
