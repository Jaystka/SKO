<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory;

    public static function spInsertCart($id, $customer_id, $quantity, $product_id, $size)
    {
        return DB::statement('call cart_insert(?, ?, ?, ?, ?)', [$id, $customer_id, $quantity, $product_id, $size]);
    }

    public static function spUpdateCart($id, $customer_id, $quantity, $product_id, $size)
    {
        return DB::statement('call cart_insert(?, ?, ?, ?, ?)', [$id, $customer_id, $quantity, $product_id, $size]);
    }

    public static function spInsertTransaction($cart_id)
    {
        return DB::statement('call transaction_insert(?)', [$cart_id]);
    }
}
