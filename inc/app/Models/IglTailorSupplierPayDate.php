<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IglTailorSupplierPayDate extends Model
{
    protected $fillable = 
    [
        'its_com_id',
        'its_bran_id',
        'its_user_id',
        'its_sup_id',
        'its_payment_type',
        'its_amount',
        'its_payment_date',
        'its_submit_by',
        'its_submit_at',
        'its_update_by',
        'its_update_at',
    ];
    public $timestamps = false;

    function supplier_info(){
        return $this->hasOne(IglTailorSupplier::Class,'its_sup_slno','its_sup_id')->select('its_sup_slno','its_sup_name');
    }
}
