<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class IglTailorCustomerPayment extends Model
{
    protected $fillable =
    [
        'its_customer_com_id',
        'its_customer_bran_id',
        'its_customer_user_id',
        'its_customer_customer_id',
        'its_customer_credit_amount',
        'its_customer_discount_amount',
        'its_customer_balance_amount',
        'its_customer_payment_date',
        'its_customer_payment_details',
        'its_customer_payment_submit_by',
    ];
  
}
