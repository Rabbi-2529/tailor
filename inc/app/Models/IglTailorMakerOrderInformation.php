<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IglTailorMakerOrderInformation extends Model
{
    function maker_name()
    {
        return $this->belongsTo(IglTailorMaker::Class,'its_maker_order_maker_slno','its_maker_slno')
                    ->select('its_maker_slno','its_maker_name');
    }

    protected $fillable = ['its_maker_order_maker_slno','its_maker_order_maker_delivery_date'];
}