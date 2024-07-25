<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
    protected $primaryKey = 'transaction_id';
    protected $fillable = [
        'customer_id',
        'status',
        'payment_method',
        'expedition',
        'price_total'
    ];
    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = false;
}
