<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

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
        'size',
        'status',
        'updated_at',
        'created_at'
    ];

    public $incrementing = false; // Nonaktifkan auto-increment
    protected $keyType = 'string'; // Ubah tipe kunci menjadi string

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->cart_id) {
                $model->cart_id = (string) Uuid::generate(4);
            }
        });
    }
}
