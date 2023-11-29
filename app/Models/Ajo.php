<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ajo extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'ajo_amount',
        'number_of_people',
        'order_number',
        'payment_schedule',
        'type',
        'status',
        'user_id',
        'code',

    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function ajoUsers()
    {
        return $this->hasMany(AjoUser::class, 'user_id');
    }
}
