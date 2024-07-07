<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $timestamps = false;
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

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // public function payment()
    // {
    //     return $this->hasMany(Payment::class, 'cart_id');
    // }
}
