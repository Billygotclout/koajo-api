<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AjoGroups extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'creator_user_id',
        'creator_firstname',
        'members_id',
        'members_order_no',
        'amount'
    ];
    

    protected $casts = [
        'members_id' => 'array',
        'members_order_no' => 'array',
    ];

    
    public function ajo(){
        $this->belongsTo(Ajo::class);
    }

}
