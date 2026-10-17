<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IglTailorCustomer extends Model
{
    protected $table = 'igl_tailor_customers';
    protected $fillable = 
    [
        'its_cus_com_id',
        'its_cus_bran_id',
        'its_cus_user_id',
        'its_cus_customer_id',
        'its_cus_name',
        'its_cus_email',
        'its_cus_address',
        'its_cus_mobile',
        'its_cus_blood',
        'its_cus_nid',
        'its_cus_birthdate',
        'its_cus_reference',
        'its_cus_status',
        'its_cus_reg_date',
        'its_cus_pic',
    ];
    protected $primaryKey = 'its_cus_slno';
    public $incrementing = true;
    public $timestamps = false;

    
}
