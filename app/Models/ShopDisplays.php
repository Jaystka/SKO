<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopDisplays extends Model
{
    use HasFactory;
    protected $primaryKey = 'display_id';
    protected $fillable = [
        'display_id',
        'brand_id',
        'number'
    ];

    protected $table = 'ShopDisplays';

    public $incrementing = false;
}
