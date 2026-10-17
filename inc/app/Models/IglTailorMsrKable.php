<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IglTailorMsrKable extends Model
{
    protected $fillable = 
    [
        'its_kable_measure_com_id',
        'its_kable_measure_bran_id',
        'its_kable_measure_user_id',
        'its_kable_measure_cus_mobile',
        'its_kable_measure_long',
        'its_kable_measure_body',
        'its_kable_measure_body_loose',
        'its_kable_measure_belly',
        'its_kable_measure_belly_loose',
        'its_kable_measure_hip',
        'its_kable_measure_hip_loose',
        'its_kable_measure_shoulder',
        'its_kable_measure_neck',
        'its_kable_measure_hand_long',
        'its_kable_measure_muhuri',
        'its_kable_measure_plet',
        'its_kable_measure_collar_type',
        'its_kable_measure_collar_size',
        'its_kable_measure_pocket',
        'its_kable_measure_date',
        'its_kable_measure_catalog_no',
        'its_kable_measure_others',
        'its_kable_measure_submit_by',
        'its_kable_measure_submit_at',
    ];
    protected $primaryKey = 'its_kable_measure_slno';
    public $incrementing = true;
    public $timestamps = false;
}
