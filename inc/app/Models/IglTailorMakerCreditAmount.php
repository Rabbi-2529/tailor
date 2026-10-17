<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IglTailorMakerCreditAmount extends Model
{
    function maker_name()
    {
        return $this->belongsTo(IglTailorMaker::Class,'its_maker_credit_maker_id','its_maker_slno')
                                            ->select('its_maker_slno','its_maker_name');
    }

    public $timestamps = false;

    protected $fillable = [
        'its_maker_credit_com_id',
        'its_maker_credit_bran_id',
        'its_maker_credit_maker_id',
        'its_maker_credit_order_id',
        'its_maker_credit_amount',
        'its_maker_credit_submit_by',
        'its_maker_credit_update_by',
    ];
}
