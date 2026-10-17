<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IglTailorPriceList;
use App\Models\IglTailorUser;
use App\Models\IglTailorUserUser;
use App\Models\IglTailorCustomer;
use App\Models\IglTailorBranch;
use App\Models\IglTailorSupplier;
use App\Models\IglTailorAddOrder;
use Carbon\Carbon;
use Auth;
use Session;

class UserController extends Controller
{
    public function index()
    {   
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        
        $current_date = Carbon::now()->format('Y-m-d');

        $total_user = IglTailorUserUser::where('its_user_com_id',$com)
                                       ->where('its_user_bran_id',$bran)
                                       ->count();

        $total_customers = IglTailorCustomer::where('its_cus_com_id',$com)
                                            ->where('its_cus_bran_id',$bran)
                                            ->count();

        $total_suppliers = IglTailorSupplier::where('its_sup_com_id',$com)
                                            ->where('its_sup_bran_id',$bran)
                                            ->count();

        $total_order = IglTailorAddOrder::where('its_add_order_com_id',$com)
                                        ->where('its_add_order_bran_id',$bran)
                                        ->distinct('its_add_order_order_id')
                                        ->count();

        $today_order = IglTailorAddOrder::where('its_add_order_com_id',$com)
                                        ->where('its_add_order_bran_id',$bran)
                                        ->where('its_add_order_receive_date',$current_date)
                                        ->distinct('its_add_order_order_id')
                                        ->count();

        return view('user.pages.index',compact('total_user','total_customers','total_suppliers','total_order','today_order'));
    }
    public function price_update()
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        
        $prices = IglTailorPriceList::where('its_price_list_com_id',$com)
                                    ->where('its_price_list_bran_id',$bran)
                                    ->first();
        if(isset($prices))
        {
            return view('user.pages.price_update',compact('prices'));
        }
        else
        {
            $prices = '';
            return view('user.pages.price_update',compact('prices'));
        }
    }
    public function priceUpdateInsert(Request $request)
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $user = Auth::user()->UserDetails->its_user_user_id;

        $submit_at = Carbon::now()->format('Y-m-d H:i:s');
        $submit_by = Auth::user()->its_slno;

        $price_update = IglTailorPriceList::where('its_price_list_com_id',$com)
                                        ->where('its_price_list_bran_id',$bran)
                                        ->first();

        if (empty($price_update)) {
            $price_update = new IglTailorPriceList();
            $price_update->its_price_list_com_id = $com;
            $price_update->its_price_list_bran_id = $bran;
            $price_update->its_price_list_user_id = $user;
            $price_update->its_price_list_submit_at = $submit_at;
            $price_update->its_price_list_submit_by = $submit_by;

            $message = "Price Added Successfully";
        }
        elseif (!empty($price_update)) {
            $price_update->its_price_list_user_id   = $user;
            $price_update->its_price_list_update_at = $submit_at;
            $price_update->its_price_list_update_by = $submit_by;

            $message = "Price Updated Successfully";
        }
        
        $price_update->its_price_list_shirt = $request->shirt;
        $price_update->its_price_list_pant = $request->pant;
        $price_update->its_price_list_blazer = $request->blazer;
        $price_update->its_price_list_panjabi = $request->panjabi;
        $price_update->its_price_list_payjama = $request->payjama;
        $price_update->its_price_list_mojib_cort = $request->mojib_cort;
        $price_update->its_price_list_safari = $request->safari;
        $price_update->its_price_list_photua = $request->photua;
        $price_update->its_price_list_kable = $request->kable;
        $price_update->its_price_list_koti = $request->koti;
        $price_update->save();

        return redirect()->back()->with(['price_update' => $message]);
    }
    public function priceUpdateAjax(Request $request)
    {
        $priceUpdate = IglTailorPriceList::where('its_price_list_slno',$request->price_id)->first();

        return view('user.pages.ajax.price_edit_ajax',compact('priceUpdate'));
    }
    public function priceEdit(Request $request)
    {
        $submit_at = Carbon::now()->format('Y-m-d H:i:s');
        $submit_by = Auth::user()->its_slno;
        $user = Auth::user()->UserDetails->its_user_user_id;

        $priceEdit = IglTailorPriceList::where('its_price_list_slno',$request->price_id)->first();
        $priceEdit->its_price_list_user_id = $user;
        $priceEdit->its_price_list_name    = $request->name;
        $priceEdit->its_price_list_price   = $request->price;
        $priceEdit->its_price_list_update_at = $submit_at;
        $priceEdit->its_price_list_update_by = $submit_by;
        $priceEdit->save();

        return redirect()->back()->with(['price_up' => 'Price Updated Successfully']);
    }
    public function priceDelete($id)
    {
        $priceDelete = IglTailorPriceList::find($id);
        $priceDelete->delete();

        return redirect()->back()->with(['price_del' => 'Price Deleted!']);
    }
    
}
