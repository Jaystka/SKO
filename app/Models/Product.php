<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'product_id';
    protected $fillable = [
        'product_id',
        'brand_id',
        'category',
        'price',
        'image',
        'product_desc',
        'slug'
    ];
    public $incrementing = false;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'product'
            ]
        ];
    }

    public function stocks()
    {
        return $this->hasMany(Stocks::class, 'product_id');
    }
}
