<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IglTailorInvProductLocation extends Model
{
    protected $table = 'igl_tailor_inv_product_locations';
    protected $fillable = 
    [
        'its_inv_proloc_com_id',
        'its_inv_proloc_bran_id',
        'its_inv_proloc_user_id',
        'its_inv_proloc_group_id',
        'its_inv_proloc_type_id',
        'its_inv_proloc_product_id',
        'its_inv_proloc_block',
        'its_inv_proloc_self',
        'its_inv_proloc_entrydate',
        'its_inv_proloc_submit_at',
        'its_inv_proloc_submit_by',
        'its_inv_proloc_update_at',
        'its_inv_proloc_update_by',
    ];
    protected $primaryKey = 'its_inv_proloc_slno';
    public $incrementing = true;
    public $timestamps = false;

    public function groupInfo(){
        return $this->belongsTo(IglTailorInvProductGroup::Class,'its_inv_proloc_group_id','its_inv_progrp_slno');
    }
    public function typeInfo(){
        return $this->belongsTo(IglTailorInvProductType::Class,'its_inv_proloc_type_id','its_protype_slno');
    }
    public function productName(){
        return $this->belongsTo('App\Models\IglTailorInvProductName','its_inv_proloc_product_id','its_proname_slno');
    }
}
