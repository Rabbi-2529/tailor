<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IglTailorMakerPayment extends Model
{
    protected $fillable =
    [
        'its_maker_credit_amount',
        'its_maker_payment_update_by',
    ];

   function maker_name()
   {
        return $this->belongsTo(IglTailorMaker::Class,'its_maker_maker_id','its_maker_slno')
                    ->select('its_maker_slno','its_maker_name');
   }
 

}
