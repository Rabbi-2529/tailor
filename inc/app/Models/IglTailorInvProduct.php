<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IglTailorInvProduct extends Model
{
    protected $table = 'igl_tailor_inv_products';
    protected $fillable = 
    [
        'its_inv_pro_com_id',
        'its_inv_pro_bran_id',
        'its_inv_pro_user_id',
        'its_inv_pro_sup_id',
        'its_inv_pro_group',
        'its_inv_pro_product_name',
        'its_inv_pro_type',
        'its_inv_pro_buy_price',
        'its_inv_pro_sell_price',
        'its_inv_pro_short',
        'its_inv_pro_reg_date',
        'its_inv_pro_submit_by',
        'its_inv_pro_submit_at',
        'its_inv_pro_update_by',
        'its_inv_pro_update_at',
    ];
    protected $primaryKey = 'its_inv_pro_slno';
    public $incrementing = true;
    public $timestamps = false;

    public function productNamepro(){
        return $this->belongsTo('App\Models\IglTailorInvProductName','its_inv_pro_product_name','its_proname_slno');
    }
    public function productGrouppro(){
        return $this->belongsTo('App\Models\IglTailorInvProductGroup','its_inv_pro_group','its_inv_progrp_slno');
    }
    public function productTypepro(){
        return $this->belongsTo('App\Models\IglTailorInvProductType','its_inv_pro_type','its_protype_slno');
    }
    public function productSupplierpro(){
        return $this->belongsTo('App\Models\IglTailorSupplier','its_inv_pro_sup_id','its_sup_slno');
    }
}
