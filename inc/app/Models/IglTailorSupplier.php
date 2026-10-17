<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IglTailorSupplier extends Model
{
    protected $table = 'igl_tailor_suppliers';
    protected $fillable = 
    [
        'its_sup_com_id',
        'its_sup_bran_id',
        'its_sup_user_id',
        'its_sup_sup_id',
        'its_sup_name',
        'its_sup_address',
        'its_sup_mobile',
        'its_sup_phone',
        'its_sup_email',
        'its_sup_website',
        'its_sup_complain_number',
        'its_sup_due_balance',
        'its_sup_status',
        'its_sup_date',
        'its_sup_submit_by',
        'its_sup_submit_at',
        'its_sup_update_by',
        'its_sup_update_at',
    ];
    protected $primaryKey = 'its_sup_slno';
    public $incrementing = true;
    public $timestamps = false;
}
