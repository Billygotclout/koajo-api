<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'amount',
        'type',
        'method',
        'status',
        'reference',
        'transferred_to',
        'from',
        "payment_id"
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function fromUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'from');
    }

    public function toUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'transferred_to');
    }
}
