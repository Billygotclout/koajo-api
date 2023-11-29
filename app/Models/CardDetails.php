<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardDetails extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'user_id',
        "first_6digits",
        "last_4digits",
        "expiry",
        "type",
        "token",
        "email"
    ];
}
