<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IglTailorInvProductGroup extends Model
{
    protected $table = 'igl_tailor_inv_product_groups';
    protected $fillable = 
    [
        'its_inv_progrp_com_id',
        'its_inv_progrp_bran_id',
        'its_inv_progrp_user_id',
        'its_inv_progrp_name',
        'its_inv_progrp_regdate',
        'its_inv_progrp_submit_by',
        'its_inv_progrp_submit_at',
        'its_inv_progrp_update_by',
        'its_inv_progrp_update_at',
    ];
    protected $primaryKey = 'its_inv_progrp_slno';
    public $incrementing = true;
    public $timestamps = false;

    public function ProGroupByDetailsCom(){
        return $this->belongsTo('App\Models\IglTailorCompany','its_inv_progrp_com_id','its_company_slno');
    }
    public function ProGroupByDetailsBra(){
        return $this->belongsTo('App\Models\IglTailorBranch','its_inv_progrp_bran_id','its_branch_slno');
    }
    public function UserUserDetails(){
        return $this->hasOne(IglTailorUserUser::Class,'its_user_user_id','its_inv_progrp_user_id');
    }

    public static function UserInfo($user_login_id){
        return IglTailorUser::select('its_username')->where('its_slno',$user_login_id)->first();
    }

    
}
