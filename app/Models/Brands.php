<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
