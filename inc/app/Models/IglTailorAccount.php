<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class IglTailorAccount extends Model
{
    protected $fillable = 
    [
        'acc_com_id',
        'acc_bran_id',
        'acc_usr_id',
        'acc_customer_id',
        'acc_credit',
        'acc_debit',
        'acc_pay_date',
        'acc_description',
        'acc_deal_type',
        'acc_status',
        'acc_submit_by',
    ];
    
    public $timestamps = false;

    public static function total_debit_price($customerId){
        
        return IglTailorAccount::select('acc_debit',DB::raw('SUM(acc_debit) as total_val'))
                            ->where('acc_customer_id',$customerId)
                            ->where('acc_status',1)
                            ->groupBy('acc_customer_id')
                            ->get();
    }
    public static function total_credit_price($customerId){
        
        return IglTailorAccount::select('acc_credit',DB::raw('SUM(acc_credit) as total_val'))
                                ->where('acc_customer_id',$customerId)
                                ->whereIn('acc_status',[2,3])
                                ->groupBy('acc_customer_id')
                                ->get();
    }
    public static function total_balance($customerId){

        return IglTailorAccount::select('*',DB::raw('SUM(acc_credit) as total_credit'),DB::raw('SUM(acc_debit) as total_debit'))
                                ->where('acc_customer_id',$customerId)
                                ->whereIn('acc_status',[1,2,3])
                                ->groupBy('acc_customer_id')
                                ->get();
    }
    public static function maker_total_credit($maker_id){

        return IglTailorAccount::select(DB::raw('SUM(acc_credit) as total_credit'))
                                ->where('acc_customer_id',$maker_id)
                                ->where('acc_status',4)
                                ->groupBy('acc_customer_id')
                                ->get();
    }
    public static function maker_total_debit($maker_id){

        return IglTailorAccount::select(DB::raw('SUM(acc_debit) as total_debit'))
                                ->where('acc_customer_id',$maker_id)
                                ->where('acc_status',4)
                                ->groupBy('acc_customer_id')
                                ->get();
    }
    public static function maker_total_balance($maker_id){

        return IglTailorAccount::select(DB::raw('SUM(acc_credit) as total_credit'),DB::raw('SUM(acc_debit) as total_debit'))
                                ->where('acc_customer_id',$maker_id)
                                ->where('acc_status',4)
                                ->groupBy('acc_customer_id')
                                ->get();
    }
    public static function sup_debit_amount($supplier_id){

        return IglTailorAccount::select(DB::raw('SUM(acc_debit) as debit_amount'))
                                ->where('acc_customer_id',$supplier_id)
                                ->whereIn('acc_status',[6,7])
                                ->groupBy('acc_customer_id')
                                ->get();
    }
    public static function sup_credit_amount($supplier_id){

        return IglTailorAccount::select(DB::raw('SUM(acc_credit) as credit_amount'))
                                ->where('acc_customer_id',$supplier_id)
                                ->where('acc_status',6)
                                ->groupBy('acc_customer_id')
                                ->get();
    }
    public static function sup_balance_amount($supplier_id){

        return IglTailorAccount::select(DB::raw('SUM(acc_credit) as total_credit'),DB::raw('SUM(acc_debit) as total_debit'))
                                ->where('acc_customer_id',$supplier_id)
                                ->whereIn('acc_status',[6,7])
                                ->groupBy('acc_customer_id')
                                ->get();
    }


}
