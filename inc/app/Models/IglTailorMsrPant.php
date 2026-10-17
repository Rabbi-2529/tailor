<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IglTailorMsrPant extends Model
{
    protected $fillable = 
    [
        'its_pant_measure_com_id',
        'its_pant_measure_bran_id',
        'its_pant_measure_user_id',
        'its_pant_measure_cus_mobile',
        'its_pant_measure_long',
        'its_pant_measure_komor',
        'its_pant_measure_hip',
        'its_pant_measure_mohuri',
        'its_pant_measure_thigh',
        'its_pant_measure_high',
        'its_pant_measure_fly',
        'its_pant_measure_kuci',
        'its_pant_measure_pocket_type',
        'its_pant_measure_pocket_backside',
        'its_pant_measure_pocket_inner',
        'its_pant_measure_muhuri_type',
        'its_pant_measure_loop',
        'its_pant_measure_loop_size',
        'its_pant_measure_date',
        'its_pant_measure_catalog_no',
        'its_pant_measure_others',
        'its_pant_measure_submit_by',
        'its_pant_measure_submit_at',
    ];
    protected $primaryKey = 'its_pant_measure_slno';
    public $incrementing = true;
    public $timestamps = false;
}
