<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IglTailorMsrBlazer extends Model
{
    protected $fillable = 
    [
        'its_blazer_measure_com_id',
        'its_blazer_measure_bran_id',
        'its_blazer_measure_user_id',
        'its_blazer_measure_cus_mobile',
        'its_blazer_measure_long',
        'its_blazer_measure_body',
        'its_blazer_measure_belly',
        'its_blazer_measure_hip',
        'its_blazer_measure_shoulder',
        'its_blazer_measure_hand_long',
        'its_blazer_measure_hand_muhuri',
        'its_blazer_measure_cross_back',
        'its_blazer_measure_button_num',
        'its_blazer_measure_nepel',
        'its_blazer_measure_side',
        'its_blazer_measure_catalog_no',
        'its_blazer_measure_others',
        'its_blazer_measure_date',
        'its_blazer_measure_best',
        'its_blazer_measure_under',
        'its_blazer_measure_submit_by',
        'its_blazer_measure_submit_at',
    ];
    protected $primaryKey = 'its_blazer_measure_slno';
    public $incrementing = true;
    public $timestamps = false;
}
