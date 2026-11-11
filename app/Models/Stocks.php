<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stocks extends Model
{
    use HasFactory;

    protected $table = 'stocks';
    protected $primaryKey = 'stock_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['stock_id', 'product_id', 'size', 'total_stock'];

    protected function casts(): array
    {
        return ['total_stock' => 'integer'];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
