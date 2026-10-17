<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IglTailorTemporary extends Model
{
    protected $table = 'igl_tailor_temporaries';
    protected $fillable = 
    [
        'its_temp_com_id',
        'its_temp_service',
        'its_temp_order_id',
        'its_temp_pname',
        'its_temp_price',
        'its_temp_total_price',
        'its_temp_qty',
        'its_temp_order_id',
        'its_temp_customer_id',
        'its_temp_submit_by',
        'ita_temp_submit_at',
    ];
    protected $primaryKey = 'its_temp_slno';
    public $incrementing = true;
    public $timestamps = false;
}
