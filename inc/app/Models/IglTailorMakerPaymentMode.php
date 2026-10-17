<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IglTailorMakerPaymentMode extends Model
{
    public $timestamps = false;

    protected $fillable = 
    [
        'payment_mode_com_id',
        'payment_mode_bran_id',
        'payment_mode_user_id',
        'payment_mode_maker_pay_id',
        'payment_mode_maker_id',
        'payment_mode_bank_id',
        'payment_mode_bank_acc_id',
        'payment_mode_submit_date',
        'payment_mode_submit_by',
    ];
}
