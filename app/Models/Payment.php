<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $primaryKey = 'payment_id';
    protected $fillable = [
        'payment_id',
        'customer_id',
        'product_id',
        'transaction_id',
        'cart_id',
        'total_price',
        'qty',
        'status',
        'created_at',
        'updated_at'
    ];
    public $incrementing = false;

    // protected $table = 'payment';
    // public function cart()
    // {
    //     return $this->belongsTo(Cart::class);
    // }
}
