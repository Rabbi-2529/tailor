<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IglTailorMsrPhotua extends Model
{
    protected $fillable =
    [
        'its_photua_measure_com_id',
        'its_photua_measure_bran_id',
        'its_photua_measure_user_id',
        'its_photua_measure_cus_mobile',
        'its_photua_measure_long',
        'its_photua_measure_body',
        'its_photua_measure_body_loose',
        'its_photua_measure_belly',
        'its_photua_measure_hip',
        'its_photua_measure_shoulder',
        'its_photua_measure_neck',
        'its_photua_measure_hand_long',
        'its_photua_measure_hand_moja',
        'its_photua_measure_hand_kunu',
        'its_photua_measure_hand_cuff',
        'its_photua_measure_types',
        'its_photua_measure_plet',
        'its_photua_measure_collar',
        'its_photua_measure_collar_size',
        'its_photua_measure_cuff_size',
        'its_photua_measure_pocket',
        'its_photua_measure_pocket_inner',
        'its_photua_measure_open',
        'its_photua_measure_date',
        'its_photua_measure_catalog_no',
        'its_photua_measure_others',
        'its_photua_measure_submit_at',
        'its_photua_measure_submit_by',
    ];
    protected $primaryKey = 'its_photua_measure_slno';
    public $incrementing = true;
    public $timestamps = false;
}
