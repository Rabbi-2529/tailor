<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IglTailorMsrShirt extends Model
{
    protected $fillable = 
    [
        'its_shirt_msr_com_id',
        'its_shirt_msr_bran_id',
        'its_shirt_msr_user_id',
        'its_shirt_msr_cus_mobile',
        'its_shirt_msr_long',
        'its_shirt_msr_body',
        'its_shirt_msr_body_loose',
        'its_shirt_msr_bally',
        'its_shirt_msr_bally_loose',
        'its_shirt_msr_hip',
        'its_shirt_msr_hip_loose',
        'its_shirt_msr_shoulder',
        'its_shirt_msr_neck',
        'its_shirt_msr_hand_long',
        'its_shirt_msr_hand_moja',
        'its_shirt_msr_hand_kunu',
        'its_shirt_msr_hand_cuff',
        'its_shirt_msr_types',
        'its_shirt_msr_plet',
        'its_shirt_msr_collar',
        'its_shirt_msr_collar_size',
        'its_shirt_msr_cuff_size',
        'its_shirt_msr_pocket',
        'its_shirt_msr_pocket_inner',
        'its_shirt_msr_date',
        'its_shirt_msr_catalog_no',
        'its_shirt_msr_others',
        'its_shirt_msr_submit_at',
        'its_shirt_msr_submit_by',
    ];
    protected $primaryKey = 'its_shirt_msr_slno';
    public $incrementing = true;
    public $timestamps = false;
}
