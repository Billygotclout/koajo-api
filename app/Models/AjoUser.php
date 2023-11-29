<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AjoUser extends Model
{
    protected $table = 'ajo_users';
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'group_id',
        'order_no',
        'payment_status'
    ];

    protected $casts = [
        'payment_status'=> 'array'
    ];
    public function ajo(){
        $this->belongsTo(Ajo::class);
    }
    public function user(){
        $this->belongsTo(User::class);
    }
}
