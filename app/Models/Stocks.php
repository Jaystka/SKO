<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stocks extends Model
{
    use HasFactory;
    protected $primaryKey = 'stock_id';
    protected $fillable = [
        'stock_id',
        'product_id',
        'size',
        'total_stock'
    ];
    public $incrementing = false;

    protected $table = 'stocks';
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
