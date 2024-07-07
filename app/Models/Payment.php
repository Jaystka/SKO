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
        'transaction_detail_id',
        'total_price',
        'qty',
        'status',
        'time'
    ];
    public $incrementing = false;

    // protected $table = 'payment';
    // public function cart()
    // {
    //     return $this->belongsTo(Cart::class);
    // }
}
