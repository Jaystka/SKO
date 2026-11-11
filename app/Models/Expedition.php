<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expedition extends Model
{
    protected $table = 'expeditions';
    protected $primaryKey = 'expedition';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['expedition'];
}
