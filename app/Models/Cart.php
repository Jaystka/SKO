<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Cart extends Model
{
    use HasFactory;

    public const STATUS_UNSELECTED = '0';
    public const STATUS_SELECTED = '1';
    public const STATUS_ORDERED = '2';

    public const MAX_QUANTITY = 100;

    protected $primaryKey = 'cart_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'cart_id',
        'customer_id',
        'quantity',
        'cart_price',
        'product_id',
        'size',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'cart_price' => 'integer',
            // Kolom status di DB lama bisa bertipe int; normalisasi ke string.
            'status' => 'string',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Cart $cart) {
            if (! $cart->cart_id) {
                $cart->cart_id = (string) Str::ulid();
            }
        });
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }
}
