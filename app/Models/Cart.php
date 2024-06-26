<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $primaryKey = 'cart_id';
    protected $fillable = [
        'cart_id',
        'customer_id',
        'quantity',
        'cart_price',
        'product_id',
        'size'
    ];
    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
