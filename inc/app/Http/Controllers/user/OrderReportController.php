<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IglTailorAccount;
use App\Models\IglTailorAddOrder;
use App\Models\IglTailorMsrShirt;
use App\Models\IglTailorMsrPant;
use App\Models\IglTailorMsrBlazer;
use App\Models\IglTailorMsrPanjabi;
use App\Models\IglTailorMsrPayjama;
use App\Models\IglTailorMsrSafari;
use App\Models\IglTailorMsrPhotua;
use App\Models\IglTailorMsrMojibCort;
use App\Models\IglTailorMsrKable;
use App\Models\IglTailorMsrKoti;
use App\Models\IglTailorTemporary;
use App\Models\IglTailorCustomer;
use App\Models\IglTailorMaker;
use App\Models\IglTailorWorkerSalary;
use App\Models\IglTailorMakerPayment;
use App\Models\IglTailorMakerCreditAmount;
use App\Models\IglTailorMakerOrderInformation;
use App\Models\IglTailorOrderStatusCheck;
use App\Models\IglTailorUserUser;
use App\Models\IglTailorBranch;
use App\Models\IglTailorCompany;
use Carbon\Carbon;
use Session;
use Auth;

class OrderReportController extends Controller
{
    public function receiving()
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $user = Auth::user()->UserDetails->its_user_user_id;
        $submit_by = Auth::user()->its_slno;

        $recieves = IglTailorAddOrder::with('order_total_amount')
                                     ->where('its_add_order_com_id',$com)
                                     ->where('its_add_order_bran_id',$bran)
                                     ->where('its_add_order_user_id',$user)
                                     ->where('its_add_order_submit_by',$submit_by)
                                     ->where('its_add_order_status',2)
                                     ->orderBy('its_add_order_order_id','desc')
                                     ->groupBy('its_add_order_order_id')
                                     ->get();

        return view('user.order_report.receive',compact('recieves'));
    }
    public function receiveOrderView($order_order_id)
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $user = Auth::user()->UserDetails->its_user_user_id;
        $submit_by = Auth::user()->its_slno;
        $order_order_id = base64_decode($order_order_id);

        $makers_infom = IglTailorMaker::select('its_maker_slno','its_maker_name','its_maker_mobile')
                                        ->where('its_maker_com_id',$com)
                                        ->where('its_maker_bran_id',$bran)
                                        ->orderBy('its_maker_name')
                                        ->get();

        $order_info = IglTailorAddOrder::select('its_add_order_slno','its_add_order_order_id','its_add_product_name','its_add_product_quantity','its_add_order_delivery_date')
                                              ->where('its_add_order_com_id',$com)
                                              ->where('its_add_order_bran_id',$bran)
                                              ->where('its_add_order_user_id',$user)
                                              ->where('its_add_order_order_id',$order_order_id)
                                              ->where('its_add_order_submit_by',$submit_by)
                                              ->orderBy('its_add_product_name')
                                              ->get();

        $single_order_info = IglTailorAddOrder::with('customer_name')->select('its_add_order_slno','its_add_order_order_id','its_add_order_cus_id','its_add_order_delivery_date')
                                                ->where('its_add_order_com_id',$com)
                                                ->where('its_add_order_bran_id',$bran)
                                                ->where('its_add_order_user_id',$user)
                                                ->where('its_add_order_order_id',$order_order_id)
                                                ->where('its_add_order_submit_by',$submit_by)
                                                ->first();

        return view('user.order_report.receive_order_view',compact('makers_infom','order_info','single_order_info'));
    }
    public function deliveryDateChange(Request $request)
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $user = Auth::user()->UserDetails->its_user_user_id;
        $submit_by = Auth::user()->its_slno;
        
        if (isset($request->new_delivery_date))
        {
            IglTailorAddOrder::where('its_add_order_com_id',$com)->where('its_add_order_bran_id',$bran)
                             ->where('its_add_order_user_id',$user)
                             ->where('its_add_order_order_id',$request->order_id)
                             ->where('its_add_order_submit_by',$submit_by)
                             ->update([
                                'its_add_order_delivery_date' => $request->new_delivery_date
                             ]);
        }
        return redirect()->back()->with('change_success','Delivery Date Change');
    }
    public function makerSetForOrder(Request $request)
    {

        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $user = Auth::user()->UserDetails->its_user_user_id;
        $submit_by = Auth::user()->its_slno;

        if(
             !IglTailorMakerOrderInformation::where('its_maker_order_com_id',$com)
                                            ->where('its_maker_order_bran_id',$bran)
                                            ->where('its_maker_order_user_id',$user)
                                            ->where('its_maker_order_add_order_slno',$request->its_add_order_slno)
                                            ->where('its_maker_order_submit_by',$submit_by)
                                            ->exists()
        )
        {
            IglTailorMakerOrderInformation::insert([
                'its_maker_order_com_id' =>$com,
                'its_maker_order_bran_id' => $bran,
                'its_maker_order_user_id' => $user,
                'its_maker_order_maker_slno' => $request->its_maker_slno,
                'its_maker_order_add_order_slno' => $request->its_add_order_slno,
                'its_maker_order_order_id' => $request->its_add_order_id,
                'its_maker_order_maker_delivery_date' => $request->maker_delivery_date,
                'its_maker_order_maker_delivery_status' => 0,
                'its_maker_order_submit_by' => $submit_by,
                'created_at' => Carbon::now(),
            ]);
    
            $worker_salary = IglTailorWorkerSalary::where('its_worker_com_id',$com)
                                                  ->where('its_worker_bran_id',$bran)
                                                  ->first();           
            
            if($request->its_add_product_name == 'Shirt')
            {
                IglTailorAddOrder::where('its_add_order_slno',$request->its_add_order_slno)->update([
                    'its_add_order_maker_id' => $request->its_maker_slno,
                    'its_add_maker_cost_amount' => $worker_salary->its_worker_shirt,
                    'its_add_order_status' => 3,
                ]);
            }
            else if($request->its_add_product_name == 'Pant')
            {
                IglTailorAddOrder::where('its_add_order_slno',$request->its_add_order_slno)->update([
                    'its_add_order_maker_id' => $request->its_maker_slno,
                    'its_add_maker_cost_amount' => $worker_salary->its_worker_pant,
                    'its_add_order_status' => 3,
                ]);
            }
            else if($request->its_add_product_name == 'Blazer')
            {
                IglTailorAddOrder::where('its_add_order_slno',$request->its_add_order_slno)->update([
                    'its_add_order_maker_id' => $request->its_maker_slno,
                    'its_add_maker_cost_amount' => $worker_salary->its_worker_blazer,
                    'its_add_order_status' => 3,
                ]);
            }
            else if($request->its_add_product_name == 'Panjabi')
            {
                IglTailorAddOrder::where('its_add_order_slno',$request->its_add_order_slno)->update([
                    'its_add_order_maker_id' => $request->its_maker_slno,
                    'its_add_maker_cost_amount' => $worker_salary->its_worker_panjabi,
                    'its_add_order_status' => 3,
                ]);
            }
            else if($request->its_add_product_name == 'Payjama')
            {
                IglTailorAddOrder::where('its_add_order_slno',$request->its_add_order_slno)->update([
                    'its_add_order_maker_id' => $request->its_maker_slno,
                    'its_add_maker_cost_amount' => $worker_salary->its_worker_payjama,
                    'its_add_order_status' => 3,
                ]);
            }
            else if($request->its_add_product_name == 'Safari')
            {
                IglTailorAddOrder::where('its_add_order_slno',$request->its_add_order_slno)->update([
                    'its_add_order_maker_id' => $request->its_maker_slno,
                    'its_add_maker_cost_amount' => $worker_salary->its_worker_safari,
                    'its_add_order_status' => 3,
                ]);
            }
            else if($request->its_add_product_name == 'Photua')
            {
                IglTailorAddOrder::where('its_add_order_slno',$request->its_add_order_slno)->update([
                    'its_add_order_maker_id' => $request->its_maker_slno,
                    'its_add_maker_cost_amount' => $worker_salary->its_worker_photua,
                    'its_add_order_status' => 3,
                ]);
            }
            else if($request->its_add_product_name == 'Mojib Cort')
            {
                IglTailorAddOrder::where('its_add_order_slno',$request->its_add_order_slno)->update([
                    'its_add_order_maker_id' => $request->its_maker_slno,
                    'its_add_maker_cost_amount' => $worker_salary->its_worker_mojib_cort,
                    'its_add_order_status' => 3,
                ]);
            }
            else if($request->its_add_product_name == 'Kable')
            {
                IglTailorAddOrder::where('its_add_order_slno',$request->its_add_order_slno)->update([
                    'its_add_order_maker_id' => $request->its_maker_slno,
                    'its_add_maker_cost_amount' => $worker_salary->its_worker_kable,
                    'its_add_order_status' => 3,
                ]);
            }
            else if($request->its_add_product_name == 'Koti')
            {
                IglTailorAddOrder::where('its_add_order_slno',$request->its_add_order_slno)->update([
                    'its_add_order_maker_id' => $request->its_maker_slno,
                    'its_add_maker_cost_amount' => $worker_salary->its_worker_koti,
                    'its_add_order_status' => 3,
                ]);
            }
        }

        $order_table_total_order = IglTailorAddOrder::where('its_add_order_com_id',$com)
                                                    ->where('its_add_order_bran_id',$bran)
                                                    ->where('its_add_order_user_id',$user)
                                                    ->where('its_add_order_order_id',$request->its_add_order_id)
                                                    ->where('its_add_order_submit_by',$submit_by)
                                                    ->count();

        $maker_order_table_total_order = IglTailorMakerOrderInformation::where('its_maker_order_com_id',$com)
                                                                        ->where('its_maker_order_bran_id',$bran)
                                                                        ->where('its_maker_order_user_id',$user)
                                                                        ->where('its_maker_order_order_id',$request->its_add_order_id)
                                                                        ->where('its_maker_order_submit_by',$submit_by)
                                                                        ->count();
        
        if($order_table_total_order == $maker_order_table_total_order)
        {
            IglTailorOrderStatusCheck::where('its_com_id',$com)
                                     ->where('its_bran_id',$bran)
                                     ->where('its_user_id',$user)
                                     ->where('its_order_id',$request->its_add_order_id)
                                     ->where('its_submit_by',$submit_by)
                                     ->delete();
        }
        else
        {
            if(
               ! IglTailorOrderStatusCheck::where('its_com_id',$com)
                                          ->where('its_bran_id',$bran)
                                          ->where('its_user_id',$user)
                                          ->where('its_order_id',$request->its_add_order_id)
                                          ->where('its_submit_by',$submit_by)
                                          ->exists()
           )
           {
                $IglTailorOrderStatus = new IglTailorOrderStatusCheck();
                $IglTailorOrderStatus->its_com_id       = $com;
                $IglTailorOrderStatus->its_bran_id      = $bran;
                $IglTailorOrderStatus->its_user_id      = $user;
                $IglTailorOrderStatus->its_order_id     = $request->its_add_order_id;
                $IglTailorOrderStatus->its_order_id_wat = $request->its_add_order_id;
                $IglTailorOrderStatus->its_submit_by    = $submit_by;
                $IglTailorOrderStatus->save();
           }
        }
        return redirect()->back();
    }
    function makerUpdateForOrder(Request $request)
    {
        $update_by = Auth::user()->its_slno;

        IglTailorMakerOrderInformation::where('its_maker_order_add_order_slno',$request->its_add_order_slno)->update([
            'its_maker_order_maker_slno' => $request->its_maker_slno,
            'its_maker_order_maker_delivery_date' => $request->maker_delivery_date,
            'its_maker_order_update_by' => $update_by,
        ]);

        IglTailorAddOrder::where('its_add_order_slno',$request->its_add_order_slno)->update([
            'its_add_order_maker_id' => $request->its_maker_slno,
        ]);

        return redirect()->back();
    }
    public function recieveAjax(Request $request)
    {
        $order = IglTailorAddOrder::where('its_add_order_slno',$request->order_id)->first();
    }
    public function processing()
    {   
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $user = Auth::user()->UserDetails->its_user_user_id;
        $submit_by = Auth::user()->its_slno;

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

        $processing = IglTailorAddOrder::with('order_total_amount')->where('its_add_order_com_id',$com)
                                        ->where('its_add_order_bran_id',$bran)
                                        ->where('its_add_order_user_id',$user)
                                        ->whereNotIn('its_add_order_order_id',$check_order_id)
                                        ->where('its_add_order_status',3)
                                        ->where('its_add_order_submit_by',$submit_by)
                                        ->distinct('its_add_order_order_id')
                                        ->orderBy('its_add_order_order_id','desc')
                                        ->get(['its_add_order_order_id']);

        return view('user.order_report.processing',compact('processing'));
    }
    public function processingOrderView($order_order_id)
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $user = Auth::user()->UserDetails->its_user_user_id;
        $submit_by = Auth::user()->its_slno;

        $order_order_id = base64_decode($order_order_id);

        $makers_infom = IglTailorMaker::select('its_maker_slno','its_maker_name','its_maker_mobile')
                                       ->where('its_maker_com_id',$com)
                                       ->where('its_maker_bran_id',$bran)
                                       ->orderBy('its_maker_name')
                                       ->get();

        $order_info =  IglTailorAddOrder::select('its_add_order_slno','its_add_order_order_id','its_add_product_name','its_add_product_quantity','its_add_order_delivery_date')
                                        ->where('its_add_order_bran_id',$bran)
                                        ->where('its_add_order_user_id',$user)
                                        ->where('its_add_order_order_id',$order_order_id)
                                        ->where('its_add_order_submit_by',$submit_by)
                                        ->orderBy('its_add_product_name')
                                        ->get();

        $single_order_info = IglTailorAddOrder::with('customer_name')->select('its_add_order_slno','its_add_order_order_id','its_add_order_cus_id','its_add_order_delivery_date')
                                            ->where('its_add_order_bran_id',$bran)
                                            ->where('its_add_order_user_id',$user)
                                            ->where('its_add_order_order_id',$order_order_id)
                                            ->where('its_add_order_submit_by',$submit_by)
                                            ->first();

        return view('user.order_report.processing_order_view',compact('makers_infom','order_info','single_order_info'));
    }
    public function waitForComplete()
    {   
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;

        $check_order_id = IglTailorOrderStatusCheck::where('its_com_id',$com)
                                                   ->where('its_bran_id',$bran)
                                                   ->pluck('its_order_id_wat')
                                                   ->toArray();
        if($check_order_id == null){
            $check_order_id = [];
        }
        else{
            $check_order_id;
        }

        $waitForComplete = IglTailorAddOrder::where('its_add_order_com_id',$com)
                                            ->where('its_add_order_bran_id',$bran)
                                            ->whereNotIn('its_add_order_order_id',$check_order_id)
                                            ->whereIn('its_add_order_status',[3,4])
                                            ->orderBy('its_add_order_slno','desc')
                                            ->get();

        return view('user.order_report.waiting_for_complete',compact('waitForComplete'));
    }
    public function realDataForWaiting()
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;

        $check_order_id = IglTailorOrderStatusCheck::where('its_com_id',$com)
                                                   ->where('its_bran_id',$bran)
                                                   ->pluck('its_order_id_wat')
                                                   ->toArray();
        if($check_order_id == null){
            $check_order_id = [];
        }
        else{
            $check_order_id;
        }

        $waitForComplete = IglTailorAddOrder::where('its_add_order_com_id',$com)
                                            ->where('its_add_order_bran_id',$bran)
                                            ->whereNotIn('its_add_order_order_id',$check_order_id)
                                            ->whereIn('its_add_order_status',[3,4])
                                            ->orderBy('its_add_order_slno','desc')
                                            ->get();

        return view('user.order_report.ajax.real_data_for_waiting',compact('waitForComplete'));
    }
    public function completeStatusChange(Request $request)
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $user = Auth::user()->UserDetails->its_user_user_id;
        $submit_by = Auth::user()->its_slno;
        $update_by = Auth::user()->its_slno;
        $date = Carbon::now()->format('Y-m-d');

        $add_order_status = IglTailorAddOrder::where('its_add_order_com_id',$com)
                                             ->where('its_add_order_bran_id',$bran)
                                             ->where('its_add_order_slno',$request->add_order_slNo)
                                             ->first();

        

        if ($add_order_status->its_add_order_status == 3) {
            IglTailorAddOrder::where('its_add_order_slno',$request->add_order_slNo)->update([
                'its_add_order_status' => 4,
            ]);

            IglTailorMakerOrderInformation::where('its_maker_order_add_order_slno',$request->add_order_slNo)->update([
                'its_maker_order_maker_delivery_status' => 1,
            ]);
        } 

        if (
            IglTailorMakerCreditAmount::where('its_maker_credit_com_id',$com)
                                      ->where('its_maker_credit_bran_id',$bran)
                                      ->where('its_maker_credit_user_id',$user)
                                      ->where('its_maker_credit_order_id',$add_order_status->its_add_order_order_id)
                                      ->where('its_maker_credit_maker_id',$add_order_status->its_add_order_maker_id)
                                      ->where('its_maker_credit_submit_by',$submit_by)
                                      ->exists()
        ) 
        {
            
            $total_credit_amount = IglTailorMakerCreditAmount::where('its_maker_credit_com_id',$com)
                                                             ->where('its_maker_credit_bran_id',$bran)
                                                             ->where('its_maker_credit_user_id',$user)
                                                             ->where('its_maker_credit_order_id',$add_order_status->its_add_order_order_id)
                                                             ->where('its_maker_credit_maker_id',$add_order_status->its_add_order_maker_id)
                                                             ->where('its_maker_credit_submit_by',$submit_by)
                                                             ->first()->its_maker_credit_amount;
           

            if ($add_order_status->its_add_product_name == 'Shirt') {

                $new_amount = $add_order_status->its_add_product_quantity * $add_order_status->its_add_maker_cost_amount;

                IglTailorMakerCreditAmount::where('its_maker_credit_com_id',$com)->where('its_maker_credit_bran_id',$bran)->where('its_maker_credit_user_id',$user)->where('its_maker_credit_order_id',$add_order_status->its_add_order_order_id)->where('its_maker_credit_maker_id',$add_order_status->its_add_order_maker_id)->update([
                        'its_maker_credit_amount' => $total_credit_amount + $new_amount,
                        'its_maker_credit_update_by' => $update_by,
                ]);

            }     
            elseif ($add_order_status->its_add_product_name == 'Pant') {

                $new_amount = $add_order_status->its_add_product_quantity * $add_order_status->its_add_maker_cost_amount;

                IglTailorMakerCreditAmount::where('its_maker_credit_com_id',$com)->where('its_maker_credit_bran_id',$bran)->where('its_maker_credit_user_id',$user)->where('its_maker_credit_order_id',$add_order_status->its_add_order_order_id)->where('its_maker_credit_maker_id',$add_order_status->its_add_order_maker_id)->update([
                        'its_maker_credit_amount' => $total_credit_amount + $new_amount,
                        'its_maker_credit_update_by' => $update_by,
                ]);
            }
            elseif ($add_order_status->its_add_product_name == 'Blazer') {

                $new_amount = $add_order_status->its_add_product_quantity * $add_order_status->its_add_maker_cost_amount;

                IglTailorMakerCreditAmount::where('its_maker_credit_com_id',$com)->where('its_maker_credit_bran_id',$bran)->where('its_maker_credit_user_id',$user)->where('its_maker_credit_order_id',$add_order_status->its_add_order_order_id)->where('its_maker_credit_maker_id',$add_order_status->its_add_order_maker_id)->update([
                        'its_maker_credit_amount' => $total_credit_amount + $new_amount,
                        'its_maker_credit_update_by' => $update_by,
                ]);
            }
            elseif ($add_order_status->its_add_product_name == 'Panjabi') {

                $new_amount = $add_order_status->its_add_product_quantity * $add_order_status->its_add_maker_cost_amount;

                IglTailorMakerCreditAmount::where('its_maker_credit_com_id',$com)->where('its_maker_credit_bran_id',$bran)->where('its_maker_credit_user_id',$user)->where('its_maker_credit_order_id',$add_order_status->its_add_order_order_id)->where('its_maker_credit_maker_id',$add_order_status->its_add_order_maker_id)->update([
                        'its_maker_credit_amount' => $total_credit_amount + $new_amount,
                        'its_maker_credit_update_by' => $update_by,
                ]);
            }
            elseif ($add_order_status->its_add_product_name == 'Payjama') {

                $new_amount = $add_order_status->its_add_product_quantity * $add_order_status->its_add_maker_cost_amount;

                IglTailorMakerCreditAmount::where('its_maker_credit_com_id',$com)->where('its_maker_credit_bran_id',$bran)->where('its_maker_credit_user_id',$user)->where('its_maker_credit_order_id',$add_order_status->its_add_order_order_id)->where('its_maker_credit_maker_id',$add_order_status->its_add_order_maker_id)->update([
                        'its_maker_credit_amount' => $total_credit_amount + $new_amount,
                        'its_maker_credit_update_by' => $update_by,
                ]);
            }
            elseif ($add_order_status->its_add_product_name == 'Safari') {

                $new_amount = $add_order_status->its_add_product_quantity * $add_order_status->its_add_maker_cost_amount;

                IglTailorMakerCreditAmount::where('its_maker_credit_com_id',$com)->where('its_maker_credit_bran_id',$bran)->where('its_maker_credit_user_id',$user)->where('its_maker_credit_order_id',$add_order_status->its_add_order_order_id)->where('its_maker_credit_maker_id',$add_order_status->its_add_order_maker_id)->update([
                        'its_maker_credit_amount' => $total_credit_amount + $new_amount,
                        'its_maker_credit_update_by' => $update_by,
                ]);
            }
            elseif ($add_order_status->its_add_product_name == 'Photua') {

                $new_amount = $add_order_status->its_add_product_quantity * $add_order_status->its_add_maker_cost_amount;

                IglTailorMakerCreditAmount::where('its_maker_credit_com_id',$com)->where('its_maker_credit_bran_id',$bran)->where('its_maker_credit_user_id',$user)->where('its_maker_credit_order_id',$add_order_status->its_add_order_order_id)->where('its_maker_credit_maker_id',$add_order_status->its_add_order_maker_id)->update([
                        'its_maker_credit_amount' => $total_credit_amount + $new_amount,
                        'its_maker_credit_update_by' => $update_by,
                ]);
            }
            elseif ($add_order_status->its_add_product_name == 'Mojib Cort') {

                $new_amount = $add_order_status->its_add_product_quantity * $add_order_status->its_add_maker_cost_amount;

                IglTailorMakerCreditAmount::where('its_maker_credit_com_id',$com)->where('its_maker_credit_bran_id',$bran)->where('its_maker_credit_user_id',$user)->where('its_maker_credit_order_id',$add_order_status->its_add_order_order_id)->where('its_maker_credit_maker_id',$add_order_status->its_add_order_maker_id)->update([
                        'its_maker_credit_amount' => $total_credit_amount + $new_amount,
                        'its_maker_credit_update_by' => $update_by,
                ]);
            }
            elseif ($add_order_status->its_add_product_name == 'Kable') {

                $new_amount = $add_order_status->its_add_product_quantity * $add_order_status->its_add_maker_cost_amount;

                IglTailorMakerCreditAmount::where('its_maker_credit_com_id',$com)->where('its_maker_credit_bran_id',$bran)->where('its_maker_credit_user_id',$user)->where('its_maker_credit_order_id',$add_order_status->its_add_order_order_id)->where('its_maker_credit_maker_id',$add_order_status->its_add_order_maker_id)->update([
                        'its_maker_credit_amount' => $total_credit_amount + $new_amount,
                        'its_maker_credit_update_by' => $update_by,
                ]);
            }
            elseif ($add_order_status->its_add_product_name == 'Koti') {

                $new_amount = $add_order_status->its_add_product_quantity * $add_order_status->its_add_maker_cost_amount;

                IglTailorMakerCreditAmount::where('its_maker_credit_com_id',$com)->where('its_maker_credit_bran_id',$bran)->where('its_maker_credit_user_id',$user)->where('its_maker_credit_order_id',$add_order_status->its_add_order_order_id)->where('its_maker_credit_maker_id',$add_order_status->its_add_order_maker_id)->update([
                        'its_maker_credit_amount' => $total_credit_amount + $new_amount,
                        'its_maker_credit_update_by' => $update_by,
                ]);
            }
        }
        else{

            $IglTailorMakerCreditAmount = new IglTailorMakerCreditAmount();
            
            $IglTailorMakerCreditAmount->its_maker_credit_com_id   = $com;
            $IglTailorMakerCreditAmount->its_maker_credit_bran_id  = $bran;
            $IglTailorMakerCreditAmount->its_maker_credit_user_id  = $user;
            $IglTailorMakerCreditAmount->its_maker_credit_order_id = $add_order_status->its_add_order_order_id;
            $IglTailorMakerCreditAmount->its_maker_credit_maker_id = $add_order_status->its_add_order_maker_id;

            if ($add_order_status->its_add_product_name == 'Shirt') {

               $IglTailorMakerCreditAmount->its_maker_credit_amount = $add_order_status->its_add_product_quantity * $add_order_status->its_add_maker_cost_amount;
            }
            elseif ($add_order_status->its_add_product_name == 'Pant') {

                $IglTailorMakerCreditAmount->its_maker_credit_amount = $add_order_status->its_add_product_quantity * $add_order_status->its_add_maker_cost_amount;
            }
            elseif ($add_order_status->its_add_product_name == 'Blazer') {

                $IglTailorMakerCreditAmount->its_maker_credit_amount = $add_order_status->its_add_product_quantity * $add_order_status->its_add_maker_cost_amount;
            }
            elseif ($add_order_status->its_add_product_name == 'Panjabi') {

                $IglTailorMakerCreditAmount->its_maker_credit_amount = $add_order_status->its_add_product_quantity * $add_order_status->its_add_maker_cost_amount;
            }
            elseif ($add_order_status->its_add_product_name == 'Payjama') {

                $IglTailorMakerCreditAmount->its_maker_credit_amount = $add_order_status->its_add_product_quantity * $add_order_status->its_add_maker_cost_amount;
            }
            elseif ($add_order_status->its_add_product_name == 'Safari') {

                $IglTailorMakerCreditAmount->its_maker_credit_amount = $add_order_status->its_add_product_quantity * $add_order_status->its_add_maker_cost_amount;
            }
            elseif ($add_order_status->its_add_product_name == 'Photua') {

                $IglTailorMakerCreditAmount->its_maker_credit_amount = $add_order_status->its_add_product_quantity * $add_order_status->its_add_maker_cost_amount;
            }
            elseif ($add_order_status->its_add_product_name == 'Mojib Cort') {

                $IglTailorMakerCreditAmount->its_maker_credit_amount = $add_order_status->its_add_product_quantity * $add_order_status->its_add_maker_cost_amount;
            }
            elseif ($add_order_status->its_add_product_name == 'Kable') {

                $IglTailorMakerCreditAmount->its_maker_credit_amount = $add_order_status->its_add_product_quantity * $add_order_status->its_add_maker_cost_amount;
            }
            elseif ($add_order_status->its_add_product_name == 'Koti') {

                $IglTailorMakerCreditAmount->its_maker_credit_amount = $add_order_status->its_add_product_quantity * $add_order_status->its_add_maker_cost_amount;
            }

            $IglTailorMakerCreditAmount->its_maker_credit_submit_by = $submit_by;
            $IglTailorMakerCreditAmount->save();
        }

        $order_table_total_order = IglTailorAddOrder::where('its_add_order_com_id',$com)
                                                    ->where('its_add_order_bran_id',$bran)
                                                    ->where('its_add_order_order_id',$add_order_status->its_add_order_order_id)
                                                    ->count();
        
        $order_table_order_complete = IglTailorAddOrder::where('its_add_order_com_id',$com)
                                                       ->where('its_add_order_bran_id',$bran)
                                                       ->where('its_add_order_order_id',$add_order_status->its_add_order_order_id)
                                                       ->where('its_add_order_status',4)
                                                       ->count();
    
        if($order_table_total_order == $order_table_order_complete)
        {
            IglTailorOrderStatusCheck::where('its_com_id',$com)
                                     ->where('its_bran_id',$bran)
                                     ->where('its_user_id',$user)
                                     ->where('its_order_id',$add_order_status->its_add_order_order_id)
                                     ->where('its_submit_by',$submit_by)
                                     ->delete();

            $maker_credit_amount = IglTailorMakerCreditAmount::where('its_maker_credit_com_id',$com)
                                                             ->where('its_maker_credit_bran_id',$bran)
                                                             ->where('its_maker_credit_user_id',$user)
                                                             ->where('its_maker_credit_order_id',$add_order_status->its_add_order_order_id)
                                                             ->where('its_maker_credit_maker_id',$add_order_status->its_add_order_maker_id)
                                                             ->where('its_maker_credit_submit_by',$submit_by)
                                                             ->first();

            $account = new IglTailorAccount();
            $account->acc_com_id = $com;
            $account->acc_bran_id = $bran;
            $account->acc_ord_id = $add_order_status->its_add_order_order_id;
            $account->acc_customer_id = $add_order_status->its_add_order_maker_id;
            $account->acc_credit =  $maker_credit_amount->its_maker_credit_amount;
            $account->acc_debit  = '';
            $account->acc_pay_date = $date;
            $account->acc_description = 'Maker Credit';
            $account->acc_submit_by = $submit_by;
            $account->acc_status = 4;
            $account->save();

            // SMS Implement 
            $message_send_status = IglTailorBranch::where('its_branch_id',$bran)->first(); // User for Branch Information

            $com = Auth::user()->UserDetails->its_user_com_id; // User With Company Information
            $company_info = IglTailorCompany::where('its_company_com_id',$com)->first();
            
            if(isset($message_send_status->its_branch_message_status))
            {
                $explode_message_status = explode(',',$message_send_status->its_branch_message_status);

                if(in_array(2, $explode_message_status) && isset($company_info->its_company_sender_id)  && isset($company_info->its_company_api_key))
                {
                    $customer_info = IglTailorCustomer::where('its_cus_slno',$add_order_status->its_add_order_cus_id)->first();
            
                    $message = "Your Order Completed Successfully.\nOrder No: ". $add_order_status->its_add_order_order_id;
                            
                    $message  = rawurlencode($message);
                    $number   = $customer_info->its_cus_mobile;
                    $senderId = $company_info->its_company_sender_id;
                    $apikey   = $company_info->its_company_api_key;
                    $client = new \GuzzleHttp\Client();
                    $url = "http://sms.iglweb.com/api/v1/send?api_key=".$apikey."&contacts=".$number."&senderid=".$senderId."&msg=".$message;
                    $res = $client->request('GET', $url);
                    $ret = $res->getBody();
                }
            }
        }
        else
        {
            if(
               ! IglTailorOrderStatusCheck::where('its_com_id',$com)
                                          ->where('its_bran_id',$bran)
                                          ->where('its_user_id',$user)
                                          ->where('its_order_id',$add_order_status->its_add_order_order_id)
                                          ->where('its_submit_by',$submit_by)
                                          ->exists()
           )
           {
                $IglTailorOrderStatus = new IglTailorOrderStatusCheck();
                $IglTailorOrderStatus->its_com_id       = $com;
                $IglTailorOrderStatus->its_bran_id      = $bran;
                $IglTailorOrderStatus->its_user_id      = $user;
                $IglTailorOrderStatus->its_order_id     = $add_order_status->its_add_order_order_id;
                $IglTailorOrderStatus->its_order_id_wat = 0;
                $IglTailorOrderStatus->its_submit_by    = $submit_by;
                $IglTailorOrderStatus->save();
           }
        }

    }
    public function realDataForComplete(){
         
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;

        $completeforDelivery = IglTailorAddOrder::where('its_add_order_com_id',$com)
                                            ->where('its_add_order_bran_id',$bran)
                                            ->where('its_add_order_status',4)
                                            ->orWhere('its_add_order_status',5)
                                            ->get();

        return view('user.order_report.ajax.real_data_for_complete',compact('completeforDelivery'));
    }
    public function orderDetails()
    {
        return view('user.order_report.show_order_details');
    }
    public function searchOrderDetails(Request $request)
    {
        $order_id = $request->order_id;
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;

       $searcResult = IglTailorAddOrder::where('its_add_order_com_id',$com)
                                        ->where('its_add_order_bran_id',$bran)
                                        ->where('its_add_order_order_id',$request->order_id)
                                        ->get();
       
        return view('user.order_report.show_order_details',compact('searcResult','order_id'));
   
    }
    public function orderList()
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $user = Auth::user()->UserDetails->its_user_user_id;
        $submit_by = Auth::user()->its_slno;
        
        Session::forget('tab_bar_active');
        Session::forget('delivery_status');

        $start_date = Carbon::now()->startOfMonth()->toDateString();
        $end_date = Carbon::now()->endOfMonth()->toDateString();

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

        $recieves = IglTailorAddOrder::with('customer_name')->where('its_add_order_com_id',$com)
                                        ->where('its_add_order_bran_id',$bran)
                                        ->where('its_add_order_status',2)
                                        ->distinct('its_add_order_order_id')
                                        ->orderBy('its_add_order_order_id','desc')
                                        ->get(['its_add_order_cus_id','its_add_order_user_id','its_add_order_order_id','its_add_order_receive_date','its_add_order_delivery_date']);


        $processing = IglTailorAddOrder::with('customer_name')->where('its_add_order_com_id',$com)
                                        ->where('its_add_order_bran_id',$bran)
                                        ->whereNotIn('its_add_order_order_id',$check_order_id)
                                        ->where('its_add_order_status',3)
                                        ->distinct('its_add_order_order_id')
                                        ->orderBy('its_add_order_order_id','desc')
                                        ->get(['its_add_order_cus_id','its_add_order_user_id','its_add_order_order_id','its_add_order_receive_date','its_add_order_delivery_date']);

        $completes = IglTailorAddOrder::with('customer_name','order_total_amount')->where('its_add_order_com_id',$com)
                                        ->where('its_add_order_bran_id',$bran)
                                        ->whereNotIn('its_add_order_order_id',$check_order_id)
                                        ->where('its_add_order_status',4)
                                        ->distinct('its_add_order_order_id')
                                        ->orderBy('its_add_order_order_id','desc')
                                        ->get(['its_add_order_cus_id','its_add_order_user_id','its_add_order_order_id','its_add_order_receive_date','its_add_order_delivery_date']);


        $deliveries = IglTailorAddOrder::with('customer_name')->where('its_add_order_com_id',$com)
                                        ->where('its_add_order_bran_id',$bran)
                                        ->where('its_add_order_status',5)
                                        ->distinct('its_add_order_order_id')
                                        ->orderBy('its_add_order_order_id','desc')
                                        ->get(['its_add_order_cus_id','its_add_order_user_id','its_add_order_order_id','its_add_order_receive_date','its_add_order_delivery_date']);
                                         

        return view('user.order_report.order_list',compact('recieves','processing','completes','deliveries','start_date','end_date'));
    }
    public function deliveryStatus(Request $request)
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;

        $delivery_status = IglTailorAddOrder::where('its_add_order_com_id',$com)
                                            ->where('its_add_order_bran_id',$bran)
                                            ->where('its_add_order_order_id',$request->order_id)
                                            ->get();

        foreach($delivery_status as $delivery)
        {
            IglTailorAddOrder::where('its_add_order_com_id',$com)
                             ->where('its_add_order_bran_id',$bran)
                             ->where('its_add_order_order_id',$delivery->its_add_order_order_id)
                             ->update([
                                'its_add_order_status' => 5,
                             ]);
        }
        
        // SMS Implement
        $message_send_status = IglTailorBranch::where('its_branch_id',$bran)->first();

        $company_info = IglTailorCompany::where('its_company_com_id',$com)->first();

        if(isset($message_send_status->its_branch_message_status))
        {
            $explode_message_status = explode(',',$message_send_status->its_branch_message_status);

            if(in_array(3, $explode_message_status) && isset($company_info->its_company_sender_id)  && isset($company_info->its_company_api_key))
            {
                $customer_slno = IglTailorAddOrder::where('its_add_order_bran_id',$bran)->where('its_add_order_order_id',$order_id)->first();
                $customer_info = IglTailorCustomer::where('its_cus_slno',$customer_slno->its_add_order_cus_id)->first();
        
                $message = "Your Order Delivery Successfully.\nOrder No: ". $order_id;
                        
                $message  = rawurlencode($message);
                $number   = $customer_info->its_cus_mobile;
                $senderId = $company_info->its_company_sender_id;
                $apikey   = $company_info->its_company_api_key;
                $client = new \GuzzleHttp\Client();
                $url = "http://sms.iglweb.com/api/v1/send?api_key=".$apikey."&contacts=".$number."&senderid=".$senderId."&msg=".$message;
                $res = $client->request('GET', $url);
                $ret = $res->getBody();
            }
        }
        
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

        $completes = IglTailorAddOrder::with('customer_name','order_total_amount')->where('its_add_order_com_id',$com)
                                        ->where('its_add_order_bran_id',$bran)
                                        ->whereNotIn('its_add_order_order_id',$check_order_id)
                                        ->where('its_add_order_status',4)
                                        ->distinct('its_add_order_order_id')
                                        ->orderBy('its_add_order_order_id','desc')
                                        ->get(['its_add_order_cus_id','its_add_order_bran_id','its_add_order_user_id','its_add_order_order_id','its_add_order_receive_date','its_add_order_delivery_date']);

        return view('user.order_report.ajax.real_data_for_delivery',compact('completes'));
    }
    public function searchDeliveryOrder(Request $request)
    {
 
        $start_date_time = $request->start_date;
        $end_date_time = $request->end_date;

        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;

        $deliveries = IglTailorAddOrder::with('customer_name')->where('its_add_order_com_id',$com)
                                        ->where('its_add_order_bran_id',$bran)
                                        ->where('its_add_order_status',5)
                                        ->where('its_add_order_receive_date','>=', $start_date_time)
                                        ->where('its_add_order_receive_date','<=', $end_date_time)
                                        ->distinct('its_add_order_order_id')
                                        ->orderBy('its_add_order_order_id','desc')
                                        ->get(['its_add_order_cus_id','its_add_order_bran_id','its_add_order_user_id','its_add_order_order_id','its_add_order_receive_date','its_add_order_delivery_date']);                                

        return view('user.order_report.ajax.search_delivery_order',compact('deliveries'));
    }
    public function realDataDeliveryOrder()
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;

        $deliveries = IglTailorAddOrder::with('customer_name')->where('its_add_order_com_id',$com)
                                        ->where('its_add_order_bran_id',$bran)
                                        ->where('its_add_order_status',5)
                                        ->distinct('its_add_order_order_id')
                                        ->orderBy('its_add_order_order_id','desc')
                                        ->get(['its_add_order_cus_id','its_add_order_bran_id','its_add_order_user_id','its_add_order_order_id','its_add_order_receive_date','its_add_order_delivery_date']);
                                         
        return view('user.order_report.ajax.search_delivery_order',compact('deliveries'));
    }
    public function makeStandardPrint($product_name, $maker_order_slno)
    {
        $maker_order_slno = base64_decode($maker_order_slno);

        if($product_name == 'Shirt'){

            $maker_order_info = IglTailorMakerOrderInformation::with('maker_name')->where('its_maker_order_slno',$maker_order_slno)->first();
            $order_info = IglTailorAddOrder::select('its_add_order_slno','its_add_order_delivery_date','its_add_order_measure_id')
                                            ->where('its_add_order_slno',$maker_order_info->its_maker_order_add_order_slno)->first();

            $shirt_measure_info = IglTailorMsrShirt::where('its_shirt_msr_slno',$order_info->its_add_order_measure_id)->first();

            return view('user.order_report.make_print.standard_print.shirt_invoice',compact('maker_order_info','order_info','shirt_measure_info'));
        }
        elseif($product_name == 'Pant'){
            $maker_order_info = IglTailorMakerOrderInformation::with('maker_name')->where('its_maker_order_slno',$maker_order_slno)->first();
            $order_info = IglTailorAddOrder::select('its_add_order_slno','its_add_order_delivery_date','its_add_order_measure_id')
                                            ->where('its_add_order_slno',$maker_order_info->its_maker_order_add_order_slno)->first();

            $pant_measure_info = IglTailorMsrPant::where('its_pant_measure_slno',$order_info->its_add_order_measure_id)->first();  

            return view('user.order_report.make_print.standard_print.pant_invoice',compact('maker_order_info','order_info','pant_measure_info'));
        }
        elseif($product_name == 'Blazer'){
            $maker_order_info = IglTailorMakerOrderInformation::with('maker_name')->where('its_maker_order_slno',$maker_order_slno)->first();
            $order_info = IglTailorAddOrder::select('its_add_order_slno','its_add_order_delivery_date','its_add_order_measure_id')
                                            ->where('its_add_order_slno',$maker_order_info->its_maker_order_add_order_slno)->first();

            $blazer_measure_info = IglTailorMsrBlazer::where('its_blazer_measure_slno',$order_info->its_add_order_measure_id)->first();  

            return view('user.order_report.make_print.standard_print.blazer_invoice',compact('maker_order_info','order_info','blazer_measure_info'));
        }
        elseif($product_name == 'Panjabi'){
            $maker_order_info = IglTailorMakerOrderInformation::with('maker_name')->where('its_maker_order_slno',$maker_order_slno)->first();
            $order_info = IglTailorAddOrder::select('its_add_order_slno','its_add_order_delivery_date','its_add_order_measure_id')
                                            ->where('its_add_order_slno',$maker_order_info->its_maker_order_add_order_slno)->first();

            $panjabi_measure_info = IglTailorMsrPanjabi::where('its_panjabi_msr_slno',$order_info->its_add_order_measure_id)->first();  

            return view('user.order_report.make_print.standard_print.panjabi_invoice',compact('maker_order_info','order_info','panjabi_measure_info'));
        }
        elseif($product_name == 'Payjama'){
            $maker_order_info = IglTailorMakerOrderInformation::with('maker_name')->where('its_maker_order_slno',$maker_order_slno)->first();
            $order_info = IglTailorAddOrder::select('its_add_order_slno','its_add_order_delivery_date','its_add_order_measure_id')
                                            ->where('its_add_order_slno',$maker_order_info->its_maker_order_add_order_slno)->first();

            $payjama_measure_info = IglTailorMsrPayjama::where('its_payjama_measure_slno',$order_info->its_add_order_measure_id)->first();  
                                
            return view('user.order_report.make_print.standard_print.payjama_invoice',compact('maker_order_info','order_info','payjama_measure_info'));
        }
        elseif($product_name == 'Safari'){
            $maker_order_info = IglTailorMakerOrderInformation::with('maker_name')->where('its_maker_order_slno',$maker_order_slno)->first();
            $order_info = IglTailorAddOrder::select('its_add_order_slno','its_add_order_delivery_date','its_add_order_measure_id')
                                            ->where('its_add_order_slno',$maker_order_info->its_maker_order_add_order_slno)->first();

            $safari_measure_info = IglTailorMsrSafari::where('its_safari_measure_slno',$order_info->its_add_order_measure_id)->first(); 
            
            return view('user.order_report.make_print.standard_print.safari_invoice',compact('maker_order_info','order_info','safari_measure_info'));
        }
        elseif($product_name == 'Photua'){
            $maker_order_info = IglTailorMakerOrderInformation::with('maker_name')->where('its_maker_order_slno',$maker_order_slno)->first();
            $order_info = IglTailorAddOrder::select('its_add_order_slno','its_add_order_delivery_date','its_add_order_measure_id')
                                            ->where('its_add_order_slno',$maker_order_info->its_maker_order_add_order_slno)->first();

            $photua_measure_info = IglTailorMsrPhotua::where('its_photua_measure_slno',$order_info->its_add_order_measure_id)->first(); 

            return view('user.order_report.make_print.standard_print.photua_invoice',compact('maker_order_info','order_info','photua_measure_info'));
        }
        elseif($product_name == 'Mojib Cort'){
            $maker_order_info = IglTailorMakerOrderInformation::with('maker_name')->where('its_maker_order_slno',$maker_order_slno)->first();
            $order_info = IglTailorAddOrder::select('its_add_order_slno','its_add_order_delivery_date','its_add_order_measure_id')
                                            ->where('its_add_order_slno',$maker_order_info->its_maker_order_add_order_slno)->first();

            $mojibcort_measure_info = IglTailorMsrMojibCort::where('its_mojibcort_measure_slno',$order_info->its_add_order_measure_id)->first(); 

            return view('user.order_report.make_print.standard_print.mojib_cort_invoice',compact('maker_order_info','order_info','mojibcort_measure_info'));
        }
        elseif($product_name == 'Kable'){
            $maker_order_info = IglTailorMakerOrderInformation::with('maker_name')->where('its_maker_order_slno',$maker_order_slno)->first();
            $order_info = IglTailorAddOrder::select('its_add_order_slno','its_add_order_delivery_date','its_add_order_measure_id')
                                            ->where('its_add_order_slno',$maker_order_info->its_maker_order_add_order_slno)->first();

            $kable_measure_info = IglTailorMsrKable::where('its_kable_measure_slno',$order_info->its_add_order_measure_id)->first(); 

            return view('user.order_report.make_print.standard_print.kable_invoice',compact('maker_order_info','order_info','kable_measure_info'));
        }
        elseif($product_name == 'Koti'){
            $maker_order_info = IglTailorMakerOrderInformation::with('maker_name')->where('its_maker_order_slno',$maker_order_slno)->first();
            $order_info = IglTailorAddOrder::select('its_add_order_slno','its_add_order_delivery_date','its_add_order_measure_id')
                                            ->where('its_add_order_slno',$maker_order_info->its_maker_order_add_order_slno)->first();

            $koti_measure_info = IglTailorMsrKoti::where('its_koti_measure_slno',$order_info->its_add_order_measure_id)->first(); 

            return view('user.order_report.make_print.standard_print.koti_invoice',compact('maker_order_info','order_info','koti_measure_info'));
        }
    }
    public function makeClassicalPrint($product_name, $maker_order_slno)
    {
        $maker_order_slno = base64_decode($maker_order_slno);

        if($product_name == 'Shirt'){

            $maker_order_info = IglTailorMakerOrderInformation::with('maker_name')->where('its_maker_order_slno',$maker_order_slno)->first();
            $order_info = IglTailorAddOrder::select('its_add_order_slno','its_add_order_delivery_date','its_add_order_measure_id')
                                            ->where('its_add_order_slno',$maker_order_info->its_maker_order_add_order_slno)->first();

            $shirt_measure_info = IglTailorMsrShirt::where('its_shirt_msr_slno',$order_info->its_add_order_measure_id)->first();

            return view('user.order_report.make_print.classical_print.shirt_invoice',compact('maker_order_info','order_info','shirt_measure_info'));
        }
        elseif($product_name == 'Pant'){
            $maker_order_info = IglTailorMakerOrderInformation::with('maker_name')->where('its_maker_order_slno',$maker_order_slno)->first();
            $order_info = IglTailorAddOrder::select('its_add_order_slno','its_add_order_delivery_date','its_add_order_measure_id')
                                            ->where('its_add_order_slno',$maker_order_info->its_maker_order_add_order_slno)->first();

            $pant_measure_info = IglTailorMsrPant::where('its_pant_measure_slno',$order_info->its_add_order_measure_id)->first();  

            return view('user.order_report.make_print.classical_print.pant_invoice',compact('maker_order_info','order_info','pant_measure_info'));
        }
        elseif($product_name == 'Blazer'){
            $maker_order_info = IglTailorMakerOrderInformation::with('maker_name')->where('its_maker_order_slno',$maker_order_slno)->first();
            $order_info = IglTailorAddOrder::select('its_add_order_slno','its_add_order_delivery_date','its_add_order_measure_id')
                                            ->where('its_add_order_slno',$maker_order_info->its_maker_order_add_order_slno)->first();

            $blazer_measure_info = IglTailorMsrBlazer::where('its_blazer_measure_slno',$order_info->its_add_order_measure_id)->first();  

            return view('user.order_report.make_print.classical_print.blazer_invoice',compact('maker_order_info','order_info','blazer_measure_info'));
        }
        elseif($product_name == 'Panjabi'){
            $maker_order_info = IglTailorMakerOrderInformation::with('maker_name')->where('its_maker_order_slno',$maker_order_slno)->first();
            $order_info = IglTailorAddOrder::select('its_add_order_slno','its_add_order_delivery_date','its_add_order_measure_id')
                                            ->where('its_add_order_slno',$maker_order_info->its_maker_order_add_order_slno)->first();

            $panjabi_measure_info = IglTailorMsrPanjabi::where('its_panjabi_msr_slno',$order_info->its_add_order_measure_id)->first();  

            return view('user.order_report.make_print.classical_print.panjabi_invoice',compact('maker_order_info','order_info','panjabi_measure_info'));
        }
        elseif($product_name == 'Payjama'){
            $maker_order_info = IglTailorMakerOrderInformation::with('maker_name')->where('its_maker_order_slno',$maker_order_slno)->first();
            $order_info = IglTailorAddOrder::select('its_add_order_slno','its_add_order_delivery_date','its_add_order_measure_id')
                                            ->where('its_add_order_slno',$maker_order_info->its_maker_order_add_order_slno)->first();

            $payjama_measure_info = IglTailorMsrPayjama::where('its_payjama_measure_slno',$order_info->its_add_order_measure_id)->first();  
                                
            return view('user.order_report.make_print.classical_print.payjama_invoice',compact('maker_order_info','order_info','payjama_measure_info'));
        }
        elseif($product_name == 'Safari'){
            $maker_order_info = IglTailorMakerOrderInformation::with('maker_name')->where('its_maker_order_slno',$maker_order_slno)->first();
            $order_info = IglTailorAddOrder::select('its_add_order_slno','its_add_order_delivery_date','its_add_order_measure_id')
                                            ->where('its_add_order_slno',$maker_order_info->its_maker_order_add_order_slno)->first();

            $safari_measure_info = IglTailorMsrSafari::where('its_safari_measure_slno',$order_info->its_add_order_measure_id)->first(); 
            
            return view('user.order_report.make_print.classical_print.safari_invoice',compact('maker_order_info','order_info','safari_measure_info'));
        }
        elseif($product_name == 'Photua'){
            $maker_order_info = IglTailorMakerOrderInformation::with('maker_name')->where('its_maker_order_slno',$maker_order_slno)->first();
            $order_info = IglTailorAddOrder::select('its_add_order_slno','its_add_order_delivery_date','its_add_order_measure_id')
                                            ->where('its_add_order_slno',$maker_order_info->its_maker_order_add_order_slno)->first();

            $photua_measure_info = IglTailorMsrPhotua::where('its_photua_measure_slno',$order_info->its_add_order_measure_id)->first(); 

            return view('user.order_report.make_print.classical_print.photua_invoice',compact('maker_order_info','order_info','photua_measure_info'));
        }
        elseif($product_name == 'Mojib Cort'){
            $maker_order_info = IglTailorMakerOrderInformation::with('maker_name')->where('its_maker_order_slno',$maker_order_slno)->first();
            $order_info = IglTailorAddOrder::select('its_add_order_slno','its_add_order_delivery_date','its_add_order_measure_id')
                                            ->where('its_add_order_slno',$maker_order_info->its_maker_order_add_order_slno)->first();

            $mojibcort_measure_info = IglTailorMsrMojibCort::where('its_mojibcort_measure_slno',$order_info->its_add_order_measure_id)->first(); 

            return view('user.order_report.make_print.classical_print.mojib_cort_invoice',compact('maker_order_info','order_info','mojibcort_measure_info'));
        }
        elseif($product_name == 'Kable'){
            $maker_order_info = IglTailorMakerOrderInformation::with('maker_name')->where('its_maker_order_slno',$maker_order_slno)->first();
            $order_info = IglTailorAddOrder::select('its_add_order_slno','its_add_order_delivery_date','its_add_order_measure_id')
                                            ->where('its_add_order_slno',$maker_order_info->its_maker_order_add_order_slno)->first();

            $kable_measure_info = IglTailorMsrKable::where('its_kable_measure_slno',$order_info->its_add_order_measure_id)->first(); 

            return view('user.order_report.make_print.classical_print.kable_invoice',compact('maker_order_info','order_info','kable_measure_info'));
        }
        elseif($product_name == 'Koti'){
            $maker_order_info = IglTailorMakerOrderInformation::with('maker_name')->where('its_maker_order_slno',$maker_order_slno)->first();
            $order_info = IglTailorAddOrder::select('its_add_order_slno','its_add_order_delivery_date','its_add_order_measure_id')
                                            ->where('its_add_order_slno',$maker_order_info->its_maker_order_add_order_slno)->first();

            $koti_measure_info = IglTailorMsrKoti::where('its_koti_measure_slno',$order_info->its_add_order_measure_id)->first(); 

            return view('user.order_report.make_print.classical_print.koti_invoice',compact('maker_order_info','order_info','koti_measure_info'));
        }
    }
    public function totalOrder()
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;

        $total_order = IglTailorAddOrder::with('order_total_amount')
                                        ->where('its_add_order_com_id',$com)
                                        ->where('its_add_order_bran_id',$bran)
                                        ->groupBy('its_add_order_order_id')
                                        ->orderBy('its_add_order_order_id','desc')
                                        ->get();

        return view('user.order_report.total_order',compact('total_order'));
    }
    public function todayOrder()
    {   
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $current_date = Carbon::now()->format('Y-m-d');
        
        $today_order = IglTailorAddOrder::with('order_total_amount')
                                        ->where('its_add_order_com_id',$com)
                                        ->where('its_add_order_bran_id',$bran)
                                        ->where('its_add_order_receive_date',$current_date)
                                        ->groupBy('its_add_order_order_id')
                                        ->orderBy('its_add_order_order_id','desc')
                                        ->get();

        return view('user.order_report.today_order',compact('today_order'));
    }
}
