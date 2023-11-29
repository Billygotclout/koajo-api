<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerIdentification extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'customer_id'
    ];

}
