<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;

class IglTailorAddOrder extends Model
{
    protected $table = 'igl_tailor_add_orders';
    protected $fillable = 
    [
        'its_add_order_com_id',
        'its_add_order_bran_id',
        'its_add_order_user_id',
        'its_add_order_cus_id',
        'its_add_order_order_id',
        'its_add_order_receive_date',
        'its_add_order_delivery_date',
        'its_add_order_total_price',
        'its_add_order_status',
        'its_add_order_bran_order',
        'its_add_order_submit_by',
        'its_add_order_submit_at',
    ];
    protected $primaryKey = 'its_add_order_slno';
    public $incrementing = true;
    public $timestamps = false;

    public function customer_name()
    {
        return $this->belongsTo(IglTailorCustomer::Class,'its_add_order_cus_id','its_cus_slno')
                    ->select('its_cus_slno','its_cus_name','its_cus_mobile')->orderBy('its_cus_name');
    }
    public function maker_name()
    {
        return $this->belongsTo(IglTailorMaker::Class,'its_add_order_maker_id','its_maker_slno')
                                            ->select('its_maker_slno','its_maker_name','its_maker_mobile');
    }
    public function order_total_amount()
    {   
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;

        return $this->belongsTo(IglTailorAccount::Class,'its_add_order_order_id','acc_ord_id')
                                                ->where('acc_bran_id',$bran)
                                                ->where('acc_status',1);
    }
    public function user_order_total_amount()
    {   
        $bran = Auth::user()->UserDetails->its_user_bran_id;

        return $this->belongsTo(IglTailorAccount::Class,'its_add_order_order_id','acc_ord_id')
                                                ->where('acc_bran_id',$bran)
                                                ->where('acc_status',1);
    }
    public static function order_count($order_id)
    {   
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;

        return  IglTailorAddOrder::select('its_add_order_status',DB::raw('count(its_add_order_order_id) as count_order'))
                                 ->where('its_add_order_bran_id',$bran)
                                 ->where('its_add_order_order_id',$order_id)
                                 ->first();
    }
    public static function order_status_count($order_id,$order_status)
    {   
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;
       
        return IglTailorAddOrder::select('its_add_order_status',DB::raw('count(its_add_order_status) as count_status'))
                                 ->where('its_add_order_bran_id',$bran)
                                 ->where('its_add_order_order_id',$order_id)
                                 ->where('its_add_order_status',$order_status)
                                 ->first();   
    }
    public static function user_order_count($order_id)
    {   
        $bran = Auth::user()->UserDetails->its_user_bran_id;

        return  IglTailorAddOrder::select('its_add_order_status',DB::raw('count(its_add_order_order_id) as count_order'))
                                 ->where('its_add_order_bran_id',$bran)
                                 ->where('its_add_order_order_id',$order_id)
                                 ->first();
    }
    public static function user_order_status_count($order_id,$order_status)
    {   
        $bran = Auth::user()->UserDetails->its_user_bran_id;
       
        return IglTailorAddOrder::select('its_add_order_status',DB::raw('count(its_add_order_status) as count_status'))
                                 ->where('its_add_order_bran_id',$bran)
                                 ->where('its_add_order_order_id',$order_id)
                                 ->where('its_add_order_status',$order_status)
                                 ->first();   
    }
    public static function receive_qty($product_name)
    {   
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;
        
        return  IglTailorAddOrder::select(
                                            'its_add_product_name',DB::raw('SUM(its_add_product_quantity) as receive_quantity')
                                        )
                                        ->where('its_add_order_bran_id',$bran)
                                        ->where('its_add_product_name',$product_name)
                                        ->get();
    }
    public static function complete_qty($product_name)
    {   
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;
        
        return  IglTailorAddOrder::select(
                                            'its_add_product_name',DB::raw('SUM(its_add_product_quantity) as complete_quantity')
                                        )
                                        ->where('its_add_order_bran_id',$bran)
                                        ->where('its_add_product_name',$product_name)
                                        ->whereIn('its_add_order_status',[4,5])
                                        ->get();
    }
    public static function income_spend($product_name)
    {   
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;
        
        return IglTailorAddOrder::select(
                                            '*',DB::raw('SUM(its_add_maker_cost_amount *its_add_product_quantity) as maker_cost')
                                        )
                                        ->where('its_add_order_bran_id',$bran)
                                        ->where('its_add_product_name',$product_name)
                                        ->get();
                                            
    }
    public static function user_receive_qty($product_name)
    {   
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        
        return  IglTailorAddOrder::select(
                                            'its_add_product_name',DB::raw('SUM(its_add_product_quantity) as receive_quantity')
                                        )
                                        ->where('its_add_order_bran_id',$bran)
                                        ->where('its_add_product_name',$product_name)
                                        ->get();
    }
    public static function user_complete_qty($product_name)
    {   
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        
        return  IglTailorAddOrder::select(
                                            'its_add_product_name',DB::raw('SUM(its_add_product_quantity) as complete_quantity')
                                        )
                                        ->where('its_add_order_bran_id',$bran)
                                        ->where('its_add_product_name',$product_name)
                                        ->whereIn('its_add_order_status',[4,5])
                                        ->get();
    }
    public static function user_income_spend($product_name)
    {   
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        
        return IglTailorAddOrder::select(
                                            '*',DB::raw('SUM(its_add_maker_cost_amount *its_add_product_quantity) as maker_cost')
                                        )
                                        ->where('its_add_order_bran_id',$bran)
                                        ->where('its_add_product_name',$product_name)
                                        ->get();
                                            
    }

}
