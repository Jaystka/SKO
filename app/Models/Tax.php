<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    protected $table = 'tax';
    protected $primaryKey = 'tax_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['tax_id', 'tax'];

    protected function casts(): array
    {
        return ['tax' => 'integer'];
    }
}
