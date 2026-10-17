<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class IglTailorInventoryDetails extends Model
{
    protected $table = 'igl_tailor_inventory_details';
    protected $fillable = 
    [
        'its_inv_det_com_id',
        'its_inv_det_bran_id',
        'its_inv_det_user_id',
        'its_inv_det_party_id',
        'its_inv_det_pro_id',
        'its_inv_det_invoice_id',
        'its_inv_det_buy_qty',
        'its_inv_det_sell_qty',
        'its_inv_det_buy_paid',
        'its_inv_det_sell_paid',
        'its_inv_det_buy_price',
        'its_inv_det_sell_price',
        'its_inv_det_deal_type',
        'its_inv_det_entry_date',
        'its_inv_det_exp_date',
        'its_inv_det_submit_by',
        'its_inv_det_submit_at',
    ];
    protected $primaryKey = 'its_inv_det_slno';
    public $incrementing = true;
    public $timestamps = false;

    public function productDetails(){
        return $this->belongsTo(IglTailorInvProduct::Class,'its_inv_det_pro_id','its_inv_pro_slno');
    }
    public function supplier(){
        return $this->belongsTo('App\Models\IglTailorSupplier','its_inv_det_party_id','its_sup_slno');
    }
    public function customer(){
        return $this->belongsTo(IglTailorCustomer::Class,'its_inv_det_party_id','its_cus_slno');
    }
    
    public static function total_quantity($product_id)
    {
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;

        return IglTailorInventoryDetails::select(DB::raw('SUM(its_inv_det_buy_qty) as buy_qty'),DB::raw('SUM(its_inv_det_sell_qty) as sell_qty'))
                                        ->where('its_inv_det_com_id',$com)
                                        ->where('its_inv_det_bran_id',$bran)
                                        ->where('its_inv_det_pro_id',$product_id)
                                        ->groupBy('its_inv_det_pro_id')
                                        ->get();
    }
    public static function user_total_quantity($product_id)
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;

        return IglTailorInventoryDetails::select(DB::raw('SUM(its_inv_det_buy_qty) as buy_qty'),DB::raw('SUM(its_inv_det_sell_qty) as sell_qty'))
                                        ->where('its_inv_det_com_id',$com)
                                        ->where('its_inv_det_bran_id',$bran)
                                        ->where('its_inv_det_pro_id',$product_id)
                                        ->groupBy('its_inv_det_pro_id')
                                        ->get();
    }
    public static function buy_total_amount($inovice_id)
    {
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;

        return IglTailorInventoryDetails::where('its_inv_det_com_id',$com)
                                        ->where('its_inv_det_bran_id',$bran)
                                        ->where('its_inv_det_invoice_id',$inovice_id)
                                        ->where('its_inv_det_deal_type',3)
                                        ->sum(DB::raw('its_inv_det_buy_price * its_inv_det_buy_qty'));
        
                             
    }
    public static function sale_total_amount($inovice_id)
    {   
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;
        
        return IglTailorInventoryDetails::where('its_inv_det_com_id',$com)
                                        ->where('its_inv_det_bran_id',$bran)
                                        ->where('its_inv_det_invoice_id',$inovice_id)
                                        ->where('its_inv_det_deal_type',4)
                                        ->sum(DB::raw('its_inv_det_sell_price * its_inv_det_sell_qty'));
        
                             
    }
    public static function user_buy_total_amount($inovice_id)
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;

        return IglTailorInventoryDetails::where('its_inv_det_com_id',$com)
                                        ->where('its_inv_det_bran_id',$bran)
                                        ->where('its_inv_det_invoice_id',$inovice_id)
                                        ->where('its_inv_det_deal_type',3)
                                        ->sum(DB::raw('its_inv_det_buy_price * its_inv_det_buy_qty'));
        
                             
    }
    public static function user_sale_total_amount($inovice_id)
    {   
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        
        return IglTailorInventoryDetails::where('its_inv_det_com_id',$com)
                                        ->where('its_inv_det_bran_id',$bran)
                                        ->where('its_inv_det_invoice_id',$inovice_id)
                                        ->where('its_inv_det_deal_type',4)
                                        ->sum(DB::raw('its_inv_det_sell_price * its_inv_det_sell_qty'));
        
                             
    }

}
