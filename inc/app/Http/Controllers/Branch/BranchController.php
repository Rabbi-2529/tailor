<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IglTailorPriceList;
use App\Models\IglTailorUser;
use App\Models\IglTailorUserUser;
use App\Models\IglTailorCustomer;
use App\Models\IglTailorBranch;
use App\Models\IglTailorSupplier;
use App\Models\IglTailorAddOrder;
use App\Models\IglTailorOrderStatusCheck;
use Carbon\Carbon;
use Auth;
use Session;


class BranchController extends Controller
{
    public function index()
    {   

        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;
        $current_date = Carbon::now()->format('Y-m-d');
        $submit_by = Auth::User()->its_slno;
        $check_order_id = IglTailorOrderStatusCheck::where('its_com_id',$com)
                                                   ->where('its_bran_id',$bran)
                                                   ->pluck('its_order_id')
                                                   ->toArray();
        if($check_order_id == null){
            $check_order_id = [];
        }
        else{
            $check_order_id;
        }

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

        $processing = IglTailorAddOrder::where('its_add_order_com_id', $com)
                                        ->where('its_add_order_bran_id', $bran)
                                        ->whereNotIn('its_add_order_order_id', $check_order_id)
                                        ->where('its_add_order_status',3)
                                        ->count();

        $pending = IglTailorAddOrder::where('its_add_order_com_id', $com)
                                        ->where('its_add_order_bran_id', $bran)
                                        ->whereNotIn('its_add_order_order_id', $check_order_id)
                                        ->whereIn('its_add_order_status', [1])
                                        ->count();

        $receive = IglTailorAddOrder::with('order_total_amount')
                                    ->where('its_add_order_com_id', $com)
                                    ->where('its_add_order_bran_id', $bran)
                                    ->where('its_add_order_status', 2)
                                    ->count();
        return view('branch.pages.index',compact('total_user','total_customers','total_suppliers','total_order','today_order','processing', 'pending', 'receive'));
    }

    public function price_update()
    {
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;
        
        $prices = IglTailorPriceList::where('its_price_list_com_id',$com)
                                    ->where('its_price_list_bran_id',$bran)
                                    ->first();
        if(isset($prices))
        {
            return view('branch.pages.price_update',compact('prices'));
        }
        else
        {
            $prices = '';
            return view('branch.pages.price_update',compact('prices'));
        }
    }
    public function priceUpdateInsert(Request $request)
    {
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;
        $submit_at = Carbon::now()->format('Y-m-d H:i:s');
        $submit_by = Auth::user()->its_slno;

        $price_update = IglTailorPriceList::where('its_price_list_com_id',$com)
                                        ->where('its_price_list_bran_id',$bran)
                                        ->first();

        if (empty($price_update)) {
            $price_update = new IglTailorPriceList();
            $price_update->its_price_list_com_id = $com;
            $price_update->its_price_list_bran_id = $bran;
            $price_update->its_price_list_submit_at = $submit_at;
            $price_update->its_price_list_submit_by = $submit_by;

            $message = "Price Added Successfully";
        }
        elseif (!empty($price_update)) {
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

        return view('branch.pages.ajax.price_edit_ajax',compact('priceUpdate'));
    }
    public function priceEdit(Request $request)
    {
        $submit_at = Carbon::now()->format('Y-m-d H:i:s');
        $submit_by = Auth::user()->its_slno;

        $priceEdit = IglTailorPriceList::where('its_price_list_slno',$request->price_id)->first();
        $priceEdit->its_price_list_name = $request->name;
        $priceEdit->its_price_list_price = $request->price;
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
    public function logoAddress()
    {
        $branch_addres = Auth::user()->its_address;

        return view('branch.pages.logoAddress',compact('branch_addres'));
    }
    public function logoAddressInsert(Request $request)
    {
      
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;

        $update_by = Auth::user()->its_slno;
        $update_at = Carbon::now()->format('Y-m-d H:i:s');

        IglTailorUser::where('its_slno',Auth::user()->its_slno)->update([
            'its_address'   => $request->address,
            'its_update_by' => $update_by,
            'its_update_at' => $update_at,
        ]);
        

        if ($request->hasFile('image')) 
        {
            $old_logo = Auth::user()->BranchDetailsUser->its_branch_com_logo;
            
            if (!empty($old_logo) && file_exists(public_path($old_logo))) {
                unlink(public_path($old_logo));
            }


            $img_url = '';

            $files = $request->file('image');
            $extension = $request->file('image')->getClientOriginalExtension();
            $name = 'upload_' . time() . '.' . $extension;
            $destinationPath = 'assets/uploads/branch';
            $files->move($destinationPath, $name);
            $img_url = $destinationPath. "/" .$name;

            IglTailorBranch::where('its_branch_id',$bran)->update([
                'its_branch_com_logo'  => $img_url,
                'its_branch_update_by' => $update_by,
                'its_branch_update_at' => $update_at,
            ]);
        }

        return back()->with('sucess','Information Update');
    }
}
