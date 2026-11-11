<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShopDisplays extends Model
{
    use HasFactory;

    protected $table = 'shopdisplays';
    protected $primaryKey = 'display_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['display_id', 'brand_id', 'number'];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brands::class, 'brand_id', 'brand_id');
    }
}
