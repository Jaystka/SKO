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
        'cart_id',
        'status',
        'payment_method',
        'expedition',
        'date'
    ];
    public $incrementing = false;

    protected $table = 'payment';
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
