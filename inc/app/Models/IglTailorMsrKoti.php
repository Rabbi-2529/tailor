<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IglTailorMsrKoti extends Model
{
    protected $fillable = 
    [
        'its_koti_measure_com_id',
        'its_koti_measure_bran_id',
        'its_koti_measure_user_id',
        'its_koti_measure_cus_mobile',
        'its_koti_measure_long',
        'its_koti_measure_body',
        'its_koti_measure_body_loose',
        'its_koti_measure_belly',
        'its_koti_measure_belly_loose',
        'its_koti_measure_hip',
        'its_koti_measure_hip_loose',
        'its_koti_measure_shoulder',
        'its_koti_measure_neck',
        'its_koti_measure_pocket',
        'its_koti_measure_belt',
        'its_koti_measure_catalog_no',
        'its_koti_measure_others',
        'its_koti_measure_date',
        'its_koti_measure_submit_at',
        'its_koti_measure_submit_by',
    ];
    protected $primaryKey = 'its_koti_measure_slno';
    public $incrementing = true;
    public $timestamps = false;
}
