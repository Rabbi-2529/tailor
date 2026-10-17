<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IglTailorMsrPanjabi extends Model
{
    protected $fillable = 
    [
        'its_panjabi_msr_com_id',
        'its_panjabi_msr_bran_id',
        'its_panjabi_msr_user_id',
        'its_panjabi_msr_cus_mobile',
        'its_panjabi_msr_long',
        'its_panjabi_msr_body',
        'its_panjabi_msr_body_loose',
        'its_panjabi_msr_belly',
        'its_panjabi_msr_belly_loose',
        'its_panjabi_msr_hip',
        'its_panjabi_msr_hip_loose',
        'its_panjabi_msr_shoulder',
        'its_panjabi_msr_neck',
        'its_panjabi_msr_hand_long',
        'its_panjabi_msr_muhuri',
        'its_panjabi_msr_plet',
        'its_panjabi_msr_collar_type',
        'its_panjabi_msr_collar_size',
        'its_panjabi_msr_pocket',
        'its_panjabi_msr_inner_pocket',
        'its_panjabi_msr_date',
        'its_panjabi_msr_catalog_no',
        'its_panjabi_msr_others',
        'its_panjabi_msr_submit_by',
        'its_panjabi_msr_submit_at',
    ];
    protected $primaryKey = 'its_panjabi_msr_slno';
    public $incrementing = true;
    public $timestamps = false;
}
