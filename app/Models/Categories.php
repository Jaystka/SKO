<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    use HasFactory;
    protected $primaryKey = 'category_id';
    protected $fillable = [
        'category_id',
        'category',
        'category_desc'
    ];
    public $incrementing = false;
}
