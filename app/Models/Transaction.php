<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    use HasFactory;

    /** Status Midtrans yang berarti pembayaran sudah diterima. */
    public const PAID_STATUSES = ['settlement', 'capture'];

    protected $primaryKey = 'transaction_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'transaction_id',
        'customer_id',
        'recipient_name',
        'recipient_phone',
        'address',
        'expedition',
        'snap_token',
        'status',
        'payment_method',
        'total_payment',
        'paid_at',
    ];

    protected function casts(): array
    {
        return [
            'total_payment' => 'integer',
            'paid_at' => 'datetime',
        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'transaction_id', 'transaction_id');
    }

    public function isPaid(): bool
    {
        return in_array($this->status, self::PAID_STATUSES, true);
    }

    /** Label status dalam Bahasa Indonesia untuk ditampilkan. */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'settlement', 'capture' => 'Lunas',
            'pending' => 'Menunggu Pembayaran',
            'expire' => 'Kedaluwarsa',
            'cancel' => 'Dibatalkan',
            'deny', 'failure' => 'Gagal',
            'refund', 'partial_refund' => 'Dikembalikan',
            default => ucfirst((string) $this->status),
        };
    }
}
