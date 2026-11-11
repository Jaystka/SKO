<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Materials extends Model
{
    use HasFactory;

    protected $table = 'materials';
    protected $primaryKey = 'material_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['material_id', 'material', 'material_desc'];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'material_id', 'material_id');
    }
}
