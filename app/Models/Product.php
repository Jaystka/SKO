<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $primaryKey = 'category_id';
    protected $fillable = [
        'category_id',
        'category',
        'category_desc'
    ];
    public $incrementing = false;
}

class Materials extends Model
{
    use HasFactory;
    protected $primaryKey = 'material_id';
    protected $fillable = [
        'material_id',
        'material',
        'material_desc'
    ];
    public $incrementing = false;
}
class Brands extends Model
{
    use HasFactory;
    protected $primaryKey = 'brand_id';
    protected $fillable = [
        'brand_id',
        'brand'
    ];
    public $incrementing = false;
}

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'product_id';
    protected $fillable = [
        'product_id',
        'brand_id',
        'series',
        'price',
        'category_id',
        'description',
        'material_id',
        'image',
        'slug'
    ];
    public $incrementing = false;
    protected $keyType = 'string';

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

    public function stock()
    {
        return $this->hasMany(Stock::class, 'product_id');
    }
}
