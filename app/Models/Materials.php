<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
