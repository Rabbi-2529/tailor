<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IglTailorMsrPayjama extends Model
{
    protected $fillable = 
    [
        'its_payjama_measure_com_id',
        'its_payjama_measure_bran_id',
        'its_payjama_measure_user_id',
        'its_payjama_measure_cus_mobile',
        'its_payjama_measure_long',
        'its_payjama_measure_komor',
        'its_payjama_measure_hip',
        'its_payjama_measure_hip_loose',
        'its_payjama_measure_muhuri',
        'its_payjama_measure_thigh',
        'its_payjama_measure_fly',
        'its_payjama_measure_high',
        'its_payjama_measure_pocket',
        'its_payjama_measure_date',
        'its_payjama_measure_catalog_no',
        'its_payjama_measure_others',
        'its_payjama_measure_submit_by',
        'its_payjama_measure_submit_at',
    ];
    protected $primaryKey = 'its_payjama_measure_slno';
    public $incrementing = true;
    public $timestamps = false;
}
