<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brands extends Model
{
    use HasFactory;

    protected $table = 'brands';
    protected $primaryKey = 'brand_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['brand_id', 'brand'];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'brand_id', 'brand_id');
    }
}
