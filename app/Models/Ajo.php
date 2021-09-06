<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ajo extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount',
        'status',
        'user_id'
     ];
}
