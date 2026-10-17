<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IglTailorMsrSafari extends Model
{
    protected $fillable = 
    [
        'its_safari_measure_com_id',
        'its_safari_measure_bran_id',
        'its_safari_measure_user_id',
        'its_safari_measure_cus_mobile',
        'its_safari_measure_long',
        'its_safari_measure_body',
        'its_safari_measure_body_loose',
        'its_safari_measure_belly',
        'its_safari_measure_belly_loose',
        'its_safari_measure_hip',
        'its_safari_measure_hip_loose',
        'its_safari_measure_shoulder',
        'its_safari_measure_cross_back',
        'its_safari_measure_neck',
        'its_safari_measure_hand_long',
        'its_safari_measure_hand_cuff',
        'its_safari_measure_plet',
        'its_safari_measure_collar',
        'its_safari_measure_collar_size',
        'its_safari_measure_pocket',
        'its_safari_measure_back_side',
        'its_safari_measure_inner_pocket',
        'its_safari_measure_type',
        'its_safari_measure_date',
        'its_safari_measure_catalog_no',
        'its_safari_measure_others',
        'its_safari_measure_submit_by',
        'its_safari_measure_submit_at',
    ];
    protected $primaryKey = 'its_safari_measure_slno';
    public $incrementing = true;
    public $timestamps = false;
}
