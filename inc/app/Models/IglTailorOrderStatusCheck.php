<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IglTailorOrderStatusCheck extends Model
{
    
    protected $fillable = 
    [
        'its_com_id',
        'its_bran_id',
        'its_user_id',
        'its_order_id',
        'its_order_id_wat',
        'its_submit_by',
    ];
    
}
