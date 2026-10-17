<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IglTailorWorkerSalary;
use App\Models\IglTailorAddOrder;
use App\Models\IglTailorAccount;
use Carbon\Carbon;
use Auth;
use DB;

class CostController extends Controller
{
    public function setMakingCost()
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;

        $costs = IglTailorWorkerSalary::where('its_worker_com_id',$com)
                                      ->where('its_worker_bran_id',$bran)
                                      ->first();  
        if(isset($costs))
        {
            return view('user.cost.set_making_cost',compact('costs'));
        }   
        else{
            $costs = '';
            return view('user.cost.set_making_cost',compact('costs'));
        }                      
    }
    public function CostSetting(Request $request)
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $user = Auth::user()->UserDetails->its_user_user_id;

        $submit_at = Carbon::now()->format('Y-m-d H:i:s');
        $submit_by = Auth::user()->its_slno;
        
        $cost_set = IglTailorWorkerSalary::where('its_worker_com_id', $com)
            ->where('its_worker_bran_id', $bran)
            ->first();
        if (!empty($cost_set)) {
            $cost_set->its_worker_update_by = $submit_by;
            $cost_set->its_worker_update_at = $submit_at;

            $return_msg = "Cost Updated Successfully";
        } else {
            $cost_set = new IglTailorWorkerSalary();
            $cost_set->its_worker_com_id = $com;
            $cost_set->its_worker_bran_id = $bran;
            $cost_set->its_worker_submit_by = $submit_by;
            $cost_set->its_worker_submit_at = $submit_at;

            $return_msg = "Cost Added Successfully";
        }
        
        $cost_set->its_worker_shirt = $request->shirt;
        $cost_set->its_worker_pant = $request->pant;
        $cost_set->its_worker_blazer = $request->blazer;
        $cost_set->its_worker_panjabi = $request->panjabi;
        $cost_set->its_worker_payjama = $request->payjama;
        $cost_set->its_worker_safari = $request->safari;
        $cost_set->its_worker_photua = $request->photua;
        $cost_set->its_worker_mojib_cort = $request->mojib_cort;
        $cost_set->its_worker_kable = $request->kable;
        $cost_set->its_worker_koti = $request->koti;
        $cost_set->save();

        return redirect()->back()->with(['cost' => $return_msg]);   
    }
    public function totalIncomeSpend()
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        
        
        $total_income_spends = IglTailorAddOrder::where('its_add_order_com_id',$com)
                                                ->where('its_add_order_bran_id',$bran)
                                                ->groupBy('its_add_product_name')
                                                ->orderBy('its_add_order_slno','asc')
                                                ->get();

        return view('user.cost.total_income_spend',compact('total_income_spends'));
    }
    public function expend()
    {
        $current_date = Carbon::now()->format('Y-m-d');
        return view('user.cost.expend',compact('current_date'));
    }
    public function expendInsert(Request $request)
    {
        $request->validate([
            'total_amount' => 'required',
            'desc' => 'required',
            'payment_date' => 'required',
        ]);

        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $user = Auth::user()->UserDetails->its_user_user_id;
        $submit_by = Auth::user()->its_slno;
       
        $account                   = new IglTailorAccount();
        $account->acc_com_id       = $com;
        $account->acc_bran_id      = $bran;
        $account->acc_user_id      = $user;
        $account->acc_customer_id  = 0;
        $account->acc_credit       = '';
        $account->acc_debit        = $request->total_amount;
        $account->acc_pay_date     = $request->payment_date;
        $account->acc_description  = $request->desc;
        $account->acc_status       = 8;
        $account->acc_submit_by    = $submit_by;
        $account->save();

        return back()->with('success','Payment');
    }
}
