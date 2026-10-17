<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IglTailorBankAcc extends Model
{
    protected $table = 'igl_tailor_bank_accs';
    protected $fillable = 
    [
        'its_bank_acc_com_id',
        'its_bank_acc_bran_id',
        'its_bank_acc_bank_name',
        'its_bank_acc_branch_name',
        'its_bank_acc_acc_no',
        'its_bank_acc_open_date',
        'its_bank_acc_status',
        'its_bank_acc_submit_at',
        'its_bank_acc_submit_by',
        'its_bank_acc_update_at',
        'its_bank_acc_update_by',
    ];
    protected $primaryKey = 'its_bank_acc_slno';
    public $incrementing = true;
    public $timestamps = false;

    public function bankName(){
        return $this->belongsTo('App\Models\IglTailorBank','its_bank_acc_bank_name','its_bank_slno');
    }
}
