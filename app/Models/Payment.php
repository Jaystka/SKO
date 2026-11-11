<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $primaryKey = 'payment_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'payment_id',
        'transaction_id',
        'customer_id',
        'cart_id',
        'product_id',
        'size',
        'qty',
        'total_price',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'qty' => 'integer',
            'total_price' => 'integer',
        ];
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'transaction_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
