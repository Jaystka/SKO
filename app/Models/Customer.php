<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'customer_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'customer_id',
        'name',
        'username',
        'email',
        'password',
        'phone',
        'address',
        'profile_picture',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class, 'customer_id', 'customer_id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'customer_id', 'customer_id');
    }

    /** Nama tampilan: nama lengkap bila ada, jika tidak username. */
    public function getDisplayNameAttribute(): string
    {
        return $this->name ?: $this->username;
    }

    public function getAvatarUrlAttribute(): string
    {
        return asset($this->profile_picture ?: 'dist/img/pp.png');
    }
}
