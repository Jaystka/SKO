<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    /** Ukuran yang dijual di toko. */
    public const SIZES = ['36', '37', '38', '39', '40', '41', '42', '43', '44', '45'];

    protected $primaryKey = 'product_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'product_id',
        'brand_id',
        'category_id',
        'material_id',
        'tax_id',
        'product',
        'series',
        'price',
        'image',
        'description',
        'slug',
        'rating',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'integer',
            'rating' => 'integer',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function stocks(): HasMany
    {
        return $this->hasMany(Stocks::class, 'product_id', 'product_id');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brands::class, 'brand_id', 'brand_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Categories::class, 'category_id', 'category_id');
    }

    public function material(): BelongsTo
    {
        return $this->belongsTo(Materials::class, 'material_id', 'material_id');
    }

    public function taxRate(): BelongsTo
    {
        return $this->belongsTo(Tax::class, 'tax_id', 'tax_id');
    }

    /** URL gambar produk, dengan fallback bila kosong. */
    public function getImageUrlAttribute(): string
    {
        return asset($this->image ?: 'dist/img/logosko.png');
    }
}
