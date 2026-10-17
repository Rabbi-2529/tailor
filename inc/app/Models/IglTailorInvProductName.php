<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IglTailorInvProductName extends Model
{
    protected $table = 'igl_tailor_inv_product_names';
    protected $fillable = 
    [
        'its_proname_com_id',
        'its_proname_bran_id',
        'its_proname_user_id',
        'its_proname_sup_id',
        'its_proname_group_id',
        'its_proname_type_id',
        'its_proname_product_name',
        'its_proname_product_desc',
        'its_proname_submit_by',
        'its_proname_submit_at',
        'its_proname_update_by',
        'its_proname_update_by',
    ];
    protected $primaryKey = 'its_proname_slno';
    public $incrementing = true;
    public $timestamps = false;

    public function supplier_name(){
        return $this->hasOne(IglTailorSupplier::Class,'its_sup_slno','its_proname_sup_id')->select('its_sup_slno','its_sup_name');
    }
    public function groupName(){
        return $this->belongsTo('App\Models\IglTailorInvProductGroup','its_proname_group_id','its_inv_progrp_slno');
    }
    public function type_name(){
        return $this->belongsTo(IglTailorInvProductType::Class,'its_proname_type_id','its_protype_slno');
    }
    public function productDetailspro(){
        return $this->hasOne('App\Models\IglTailorInventoryDetails','its_inv_det_pro_id','its_proname_slno');
    }
    public static function product_info($product_name_id){
       
        return IglTailorInvProductName::where('its_proname_slno',$product_name_id)
                                        ->first();
    }
}
