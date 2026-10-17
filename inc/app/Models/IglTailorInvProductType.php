<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IglTailorInvProductType extends Model
{
    protected $table = 'igl_tailor_inv_product_types';
    protected $fillable = 
    [
        'its_protype_com_id',
        'its_protype_bran_id',
        'its_protype_user_id',
        'its_protype_group_id',
        'its_protype_name',
        'its_protype_date',
        'its_protype_submit_by',
        'its_protype_submit_at',
        'its_protype_update_by',
        'its_protype_update_at',
    ];
    protected $primaryKey = 'its_protype_slno';
    public $incrementing = true;
    public $timestamps = false;

    public function groupInfo(){
        return $this->belongsTo(IglTailorInvProductGroup::Class,'its_protype_group_id','its_inv_progrp_slno');
    }
}
