<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IglTailorTemporaryProductSale extends Model
{
    protected $fillable = [
        'its_tem_pro_sale_slno',
        'its_com_id',
        'its_bran_id',
        'its_user_id',
        'its_product_id',
        'its_price',
        'its_qty',
        'its_total_price',
        'its_submit_by',
        'its_submit_at',
    ];
    public $timestamps = false;

    public function product(){
        return $this->belongsTo(IglTailorInvProduct::Class,'its_product_id','its_inv_pro_slno');
    }
}
