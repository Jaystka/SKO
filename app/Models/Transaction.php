<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $primaryKey = 'transaction_id';
    protected $fillable = [
        'transaction_id',
        'customer_id',
        'product_id',
        'total_payment',
        'status',
        'expedition',
        'address',
        'time',
        'updated_at',
        'created_at',
        'snap_token'
    ];
    public $incrementing = false;
}
