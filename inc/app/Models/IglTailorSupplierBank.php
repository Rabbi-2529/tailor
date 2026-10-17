<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IglTailorSupplierBank extends Model
{
    protected $table = 'igl_tailor_supplier_banks';
    protected $fillable = 
    [
        'its_branch_name',
        'its_sup_id',
        'its_bank_id',
        'its_bank_acc_name',
        'its_acc_no',
        'its_submit_by',
        'its_submit_at',
    ];
    protected $primaryKey = 'its_supbank_slno';
    public $incrementing = true;
    public $timestamps = false;

    function bank_info(){
        return $this->hasOne(IglTailorBank::Class,'its_bank_slno','its_bank_id');
    }


}
