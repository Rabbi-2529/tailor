<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IglTailorPriceList;
use App\Models\IglTailorCustomer;
use App\Models\IglTailorTemporary;
use Carbon\Carbon;
use Session;
use Auth;
use Cart;

class OrderController extends Controller
{
    public function orderNow()
    {
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;

        $price = IglTailorPriceList::where('its_price_list_com_id',$com)
                                    ->where('its_price_list_bran_id',$bran)
                                    ->first();
        
        $customers = IglTailorCustomer::where('its_cus_com_id',$com)
                                      ->orderBy('its_cus_name')
                                      ->get();
    
        return view('branch.pages.add_sell_order',compact('price','customers'));
    }
    public function orderAddToCart(Request $request){
        try {
            if (empty($request->service)) {
                return 410;
            }
            if (empty($request->quantity)) {
                return 411;
            }
            if (empty($request->price)) {
                return 412;
            }

            $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
            $bran = Auth::user()->BranchDetailsUser->its_branch_id;

            $submit_at = Carbon::now()->format('Y-m-d H:i:s');
            $submit_by = Auth::user()->its_slno;

            $total_qty_price = $request->quantity * $request->price;
            
            // check service added or not
            $cartTemporary = IglTailorTemporary::where('its_temp_com_id', $com)
                                                ->where('its_temp_bran_id', $bran)
                                                ->where('its_temp_service', $request->service)
                                                ->where('its_temp_submit_by', $submit_by)
                                                ->first();

            if (empty($cartTemporary)) {
                $cartTemporary = new IglTailorTemporary();
                $cartTemporary->its_temp_service = $request->service;
                $cartTemporary->its_temp_submit_by = $submit_by;
                $cartTemporary->its_temp_submit_at = $submit_at;
            }

            $cartTemporary->its_temp_com_id = $com;
            $cartTemporary->its_temp_bran_id = $bran;
            $cartTemporary->its_temp_pname = $request->service;
            $cartTemporary->its_temp_price = $request->price;
            $cartTemporary->its_temp_total_price = $total_qty_price;
            $cartTemporary->its_temp_qty = $request->quantity;
            $cartTemporary->save();
            return 200;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        
    }
    public function getCartContent()
    {
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;
        $submit_by = Auth::user()->its_slno;
        
        $cart_content = IglTailorTemporary::where('its_temp_com_id', $com)
                                                 ->where('its_temp_bran_id',$bran)
                                                 ->where('its_temp_submit_by',$submit_by)
                                                 ->get();

        return view('branch.pages.ajax.get_cart_content', compact('cart_content'));
    }
    public function getCartContentDelete($id){

        $carDelete = IglTailorTemporary::where('its_temp_slno',$id)->first();
        $carDelete->delete();

        return redirect()->back();
    }
}
