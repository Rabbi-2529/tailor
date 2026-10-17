<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class IglTailorBankTransaction extends Model
{
    protected $table = 'igl_tailor_bank_transactions';
    protected $fillable = 
    [
        'its_bank_tran_com_id',
        'its_bank_tran_bran_id',
        'its_bank_tran_bank_id',
        'its_bank_tran_account_no',
        'its_bank_tran_debit',
        'its_bank_tran_credit',
        'its_bank_tran_date',
        'its_bank_tran_ref',
        'its_bank_tran_submit_at',
        'its_bank_tran_submit_by',
        'its_bank_tran_update_at',
        'its_bank_tran_update_by',
    ];
    protected $primaryKey = 'its_bank_tran_slno';
    public $incrementing = true;
    public $timestamps = false;

    public static function bank_balance($bank_id)
    {
        return  IglTailorBankTransaction::select(DB::raw('SUM(its_bank_tran_credit) as credit_amount'),DB::raw('SUM(its_bank_tran_debit) as debit_amount'))
                                            ->where('its_bank_tran_bank_id',$bank_id)
                                            ->groupBy('its_bank_tran_bank_id')
                                            ->get();
    }
   
}
