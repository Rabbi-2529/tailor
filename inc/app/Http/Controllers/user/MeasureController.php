<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IglTailorCustomer;
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
use App\Models\IglTailorPriceList;
use App\Models\IglTailorTemporary;
use App\Models\IglTailorBranch;
use App\Models\IglTailorAccount;
use App\Models\IglTailorUser;
use App\Models\IglTailorUserUser;
use App\Models\IglTailorCompany;
use Carbon\Carbon;
use Session;
use Auth;
use DB;

class MeasureController extends Controller
{
    public function takeMeasure(Request $request)
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $user = Auth::user()->UserDetails->its_user_user_id;
        $submit_by = Auth::user()->its_slno;
        
        $check_product_name = IglTailorTemporary::where('its_temp_com_id',$com)
                                                ->where('its_temp_bran_id',$bran)
                                                ->where('its_temp_user_id',$user)
                                                ->where('its_temp_submit_by',$submit_by)
                                                ->pluck('its_temp_pname')
                                                ->toArray();

        $temp_slNos = IglTailorTemporary::where('its_temp_com_id',$com)
                                        ->where('its_temp_bran_id',$bran)
                                        ->where('its_temp_user_id',$user)
                                        ->where('its_temp_submit_by',$submit_by)
                                        ->pluck('its_temp_slno')
                                        ->toArray();

        if(isset($request->customer_id) && isset($request->order_id))
        {
            // Temporary Table Order ID and Customer Id Insert
           foreach($request->temp_slNo as $temp_slNo)
            {
                IglTailorTemporary::where('its_temp_slno',$temp_slNo)->update([
                    'its_temp_order_id' => $request->order_id,
                    'its_temp_customer_id' => $request->customer_id,
                ]); 
            } 
        }
        // Order Panding Value Insert
        Session::put('order_panding','Order Panding');

        // Catch The Customer Id and Order Id from Temporary Table 
        $temporary_info = IglTailorTemporary::first();

        if(isset($temporary_info)){
             $order_id = $temporary_info->its_temp_order_id;
             $customer_id = $temporary_info->its_temp_customer_id;
        }
        else{
             $order_id = '';
             $customer_id = '';
        }

        // Customer Old Measure ID Catch  
        $check_customer_shirt = IglTailorAddOrder::select('its_add_order_slno')
                                                  ->where('its_add_order_com_id',$com)
                                                  ->where('its_add_order_bran_id',$bran)
                                                  ->where('its_add_order_cus_id',$customer_id)
                                                  ->where('its_add_product_name',"Shirt")
                                                  ->latest('its_add_order_submit_at')
                                                  ->first();
        // Customer Old Measure ID Catch
        $check_customer_pant = IglTailorAddOrder::select('its_add_order_slno')
                                                 ->where('its_add_order_com_id',$com)
                                                 ->where('its_add_order_bran_id',$bran)
                                                 ->where('its_add_order_cus_id',$customer_id)
                                                 ->where('its_add_product_name',"Pant")
                                                 ->latest('its_add_order_submit_at')
                                                 ->first();
        // Customer Old Measure ID Catch
        $check_customer_blazer = IglTailorAddOrder::select('its_add_order_slno')
                                                  ->where('its_add_order_com_id',$com)
                                                  ->where('its_add_order_bran_id',$bran)
                                                  ->where('its_add_order_cus_id',$customer_id)
                                                  ->where('its_add_product_name',"Blazer")
                                                  ->latest('its_add_order_submit_at')
                                                  ->first();
        // Customer Old Measure ID Catch
        $check_customer_panjabi = IglTailorAddOrder::select('its_add_order_slno')
                                                    ->where('its_add_order_com_id',$com)
                                                    ->where('its_add_order_bran_id',$bran)
                                                    ->where('its_add_order_cus_id',$customer_id)
                                                    ->where('its_add_product_name',"Panjabi")
                                                    ->latest('its_add_order_submit_at')
                                                    ->first();
        // Customer Old Measure ID Catch
        $check_customer_payjama = IglTailorAddOrder::select('its_add_order_slno')
                                                    ->where('its_add_order_com_id',$com)
                                                    ->where('its_add_order_bran_id',$bran)
                                                    ->where('its_add_order_cus_id',$customer_id)
                                                    ->where('its_add_product_name',"Payjama")
                                                    ->latest('its_add_order_submit_at')
                                                    ->first();
        // Customer Old Measure ID Catch
        $check_customer_safari = IglTailorAddOrder::select('its_add_order_slno')
                                                   ->where('its_add_order_com_id',$com)
                                                   ->where('its_add_order_bran_id',$bran)
                                                   ->where('its_add_order_cus_id',$customer_id)
                                                   ->where('its_add_product_name',"Safari")
                                                   ->latest('its_add_order_submit_at')
                                                   ->first();
        // Customer Old Measure ID Catch
        $check_customer_photua = IglTailorAddOrder::select('its_add_order_slno')
                                                    ->where('its_add_order_com_id',$com)
                                                    ->where('its_add_order_bran_id',$bran)
                                                    ->where('its_add_order_cus_id',$customer_id)
                                                    ->where('its_add_product_name',"Photua")
                                                    ->latest('its_add_order_submit_at')
                                                    ->first();
        // Customer Old Measure ID Catch
        $check_customer_mojibcort = IglTailorAddOrder::select('its_add_order_slno')
                                                      ->where('its_add_order_com_id',$com)
                                                      ->where('its_add_order_bran_id',$bran)
                                                      ->where('its_add_order_cus_id',$customer_id)
                                                      ->where('its_add_product_name',"Mojib Cort")
                                                      ->latest('its_add_order_submit_at')
                                                      ->first();
        // Customer Old Measure ID Catch
        $check_customer_kable = IglTailorAddOrder::select('its_add_order_slno')
                                                  ->where('its_add_order_com_id',$com)
                                                  ->where('its_add_order_bran_id',$bran)
                                                  ->where('its_add_order_cus_id',$customer_id)
                                                  ->where('its_add_product_name',"Kable")
                                                  ->latest('its_add_order_submit_at')
                                                  ->first();
        // Customer Old Measure ID Catch
        $check_customer_koti = IglTailorAddOrder::select('its_add_order_slno')
                                                 ->where('its_add_order_com_id',$com)
                                                 ->where('its_add_order_bran_id',$bran)
                                                 ->where('its_add_order_cus_id',$customer_id)
                                                 ->where('its_add_product_name',"Koti")
                                                 ->latest('its_add_order_submit_at')
                                                 ->first();
                                                 
        $customer_info = IglTailorCustomer::where('its_cus_com_id',$com)->where('its_cus_bran_id',$bran)->where('its_cus_slno',$customer_id)->first();
         
        // Checking Condition for Measurement
        if(isset($check_customer_shirt)){

            if(Session::has('oldShirtMeasuermentDelete')){
                Session::forget('oldShirtMeasuerment');
            }
            else{
                Session::put('shirtMeasureId', $check_customer_shirt->its_add_order_slno);
                Session::put('oldShirtMeasuerment', "Check Measurment and Save");
            }
        }
        if(isset($check_customer_pant)){

            if (Session::has('oldPantMeasuermentDelete')){
                Session::forget('oldPantMeasuerment');
            } 
            else {
                Session::put('pantMeasureId', $check_customer_pant->its_add_order_slno);
                Session::put('oldPantMeasuerment', "Check Measurment and Save");
            }
        }
        if(isset($check_customer_blazer)){

            if (Session::has('oldBlazerMeasuermentDelete')){
                Session::forget('oldBlazerMeasuerment');
            } 
            else {
                Session::put('blazerMeasureId', $check_customer_blazer->its_add_order_slno);
                Session::put('oldBlazerMeasuerment', "Check Measurment and Save");    
            }
        }
        if(isset($check_customer_panjabi)){

            if (Session::has('oldPanjabiMeasuermentDelete')){
                Session::forget('oldPanjabiMeasuerment');
            } 
            else {
                Session::put('panjabiMeasureId', $check_customer_panjabi->its_add_order_slno);
                Session::put('oldPanjabiMeasuerment', "Check Measurment and Save");    
            }
        }
        if(isset($check_customer_payjama)){

            if (Session::has('oldPayjamaMeasuermentDelete')){
                Session::forget('oldPayjamaMeasuerment');
            } 
            else {
                Session::put('payjamaMeasureId', $check_customer_payjama->its_add_order_slno);
                Session::put('oldPayjamaMeasuerment', "Check Measurment and Save");    
            }
        }
        if(isset($check_customer_safari)){

            if (Session::has('oldSafariMeasuermentDelete')){
                Session::forget('oldSafariMeasuerment');
            } 
            else {
                Session::put('safariMeasureId', $check_customer_safari->its_add_order_slno);
                Session::put('oldSafariMeasuerment', "Check Measurment and Save");      
            }
        }
        if(isset($check_customer_photua)){

            if (Session::has('oldPhotuaMeasuermentDelete')){
                Session::forget('oldPhotuaMeasuerment');
            } 
            else {
                Session::put('photuaMeasureId', $check_customer_photua->its_add_order_slno);
                Session::put('oldPhotuaMeasuerment', "Check Measurment and Save");
            }
        }
        if(isset($check_customer_mojibcort)){

            if (Session::has('oldMojibCortMeasuermentDelete')){
                Session::forget('oldMojibCortMeasuerment');
            } 
            else {
                Session::put('mojibCortMeasureId', $check_customer_mojibcort->its_add_order_slno);
                Session::put('oldMojibCortMeasuerment', "Check Measurment and Save"); 
            }
        }
        if(isset($check_customer_kable)){

            if (Session::has('oldKableMeasuermentDelete')){
                Session::forget('oldKableMeasuerment');
            } 
            else{
                Session::put('kableMeasureId', $check_customer_kable->its_add_order_slno);
                Session::put('oldKableMeasuerment', "Check Measurment and Save");
            }
            
        }
        if(isset($check_customer_koti)){

            if (Session::has('oldKotiMeasuermentDelete')){
                Session::forget('oldKotiMeasuerment');
            } 
            else {
                Session::put('kotiMeasureId', $check_customer_koti->its_add_order_slno);
                Session::put('oldKotiMeasuerment', "Check Measurment and Save");
            } 
        }

       
        return view('user.pages.take_measure',compact('temp_slNos','customer_info','customer_id','order_id','check_product_name'));
    }
    public function shirtMeasurement(Request $request)
    {
        Session::put('oldShirtMeasuermentDelete', 'delete');

        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $user = Auth::user()->UserDetails->its_user_user_id;
        $submit_at = Carbon::now()->format('Y-m-d H:i:s');

        $cus_mobile = IglTailorCustomer::where('its_cus_com_id',$com)
                                       ->where('its_cus_slno',$request->customer)
                                       ->first();

        $submit = Carbon::now()->format('Y-m-d');
        $submit_by = Auth::user()->its_slno;

        DB::beginTransaction();
        try {
            $shirtMeasure = new IglTailorMsrShirt();
            $shirtMeasure->its_shirt_msr_com_id = $com;
            $shirtMeasure->its_shirt_msr_bran_id = $bran;
            $shirtMeasure->its_shirt_msr_user_id = $user;
            $shirtMeasure->its_shirt_msr_cus_mobile = $cus_mobile->its_cus_mobile;
            $shirtMeasure->its_shirt_product_name = $request->p_name;
            $shirtMeasure->its_shirt_product_qty = $request->qty;
            $shirtMeasure->its_shirt_msr_long = $request->long;
            $shirtMeasure->its_shirt_msr_body = $request->body;
            $shirtMeasure->its_shirt_msr_body_loose = $request->body_loose;
            $shirtMeasure->its_shirt_msr_bally = $request->bally;
            $shirtMeasure->its_shirt_msr_bally_loose = $request->bally_loose;
            $shirtMeasure->its_shirt_msr_hip = $request->hip;
            $shirtMeasure->its_shirt_msr_hip_loose = $request->hip_loose;
            $shirtMeasure->its_shirt_msr_shoulder = $request->shoulder;
            $shirtMeasure->its_shirt_msr_neck = $request->neck;
            $shirtMeasure->its_shirt_msr_hand_long = $request->hand_long;
            $shirtMeasure->its_shirt_msr_hand_moja = $request->hand_moja;
            $shirtMeasure->its_shirt_msr_hand_kunu = $request->hand_kunu;
            $shirtMeasure->its_shirt_msr_hand_cuff = $request->hand_cuff;
            $shirtMeasure->its_shirt_msr_types = $request->type;
            $shirtMeasure->its_shirt_msr_plet = $request->plet;
            $shirtMeasure->its_shirt_msr_collar = $request->collar;
            $shirtMeasure->its_shirt_msr_collar_size = $request->collar_size;
            $shirtMeasure->its_shirt_msr_cuff_size = $request->cuff_size;
            $shirtMeasure->its_shirt_msr_pocket = $request->pocket;
            $shirtMeasure->its_shirt_msr_pocket_inner = $request->inner_pocket;
            $shirtMeasure->its_shirt_msr_date = $submit;
            $shirtMeasure->its_shirt_msr_catalog_no = $request->catalog;
            $shirtMeasure->its_shirt_msr_others = $request->others;
            $shirtMeasure->its_shirt_msr_submit_at = $submit_at;
            $shirtMeasure->its_shirt_msr_submit_by = $submit_by;
            // dd($shirtMeasure);
            $shirtMeasure->save();

            // Temporary Id Catch
            $its_add_temp_id = IglTailorTemporary::where('its_temp_pname','shirt')->first();

            if(
                !IglTailorAddOrder::where('its_add_order_com_id',$com)
                                  ->where('its_add_order_bran_id',$bran)
                                  ->where('its_add_order_user_id',$user)
                                  ->where('its_add_order_order_id',$request->order_id)
                                  ->where('its_add_product_name',$request->p_name)
                                  ->exists()
            )
            {
                $addOrder = new IglTailorAddOrder();
                $addOrder->its_add_order_com_id = $com;
                $addOrder->its_add_order_bran_id = $bran;
                $addOrder->its_add_order_user_id = $user;
                $addOrder->its_add_order_cus_id = $request->customer;
                $addOrder->its_add_order_measure_id = $shirtMeasure->its_shirt_msr_slno;
                $addOrder->its_add_order_order_id = $request->order_id;
                $addOrder->its_add_order_temp_id = $its_add_temp_id->its_temp_slno;
                $addOrder->its_add_product_name = $request->p_name;
                $addOrder->its_add_product_quantity = $its_add_temp_id->its_temp_qty;
                $addOrder->its_add_product_price = $its_add_temp_id->its_temp_price;
                $addOrder->its_add_order_total_price = $its_add_temp_id->its_temp_total_price;
                $addOrder->its_add_order_receive_date = $submit;
                $addOrder->its_add_order_delivery_date = NULL;
                $addOrder->its_add_order_status = 2;
                $addOrder->its_add_order_submit_by = $submit_by;
                $addOrder->its_add_order_submit_at = $submit_at;
                $addOrder->save();

                Session::put('shirtMeasureId',$addOrder->its_add_order_slno);
            }
        } 
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['err' => $e->getMessage()]);
        }
        DB::commit();
        
        return redirect()->back();
    }
    public function pantMeasurement(Request $request)
    {
        Session::put('oldPantMeasuermentDelete', 'delete');

        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $user = Auth::user()->UserDetails->its_user_user_id;
        $submit_at = Carbon::now()->format('Y-m-d H:i:s');

        $cus_mobile = IglTailorCustomer::where('its_cus_com_id',$com)
                                       ->where('its_cus_slno',$request->customer)
                                       ->first();

        $submit = Carbon::now()->format('Y-m-d');
        $submit_by = Auth::user()->its_slno;

        DB::beginTransaction();
        try {
            $pantMeasure = new IglTailorMsrPant();
            $pantMeasure->its_pant_measure_com_id = $com;
            $pantMeasure->its_pant_measure_bran_id = $bran;
            $pantMeasure->its_pant_measure_user_id = $user;
            $pantMeasure->its_pant_measure_cus_mobile = $cus_mobile->its_cus_mobile;
            $pantMeasure->its_pant_product_name = $request->p_name;
            $pantMeasure->its_pant_product_qty = $request->qty;
            $pantMeasure->its_pant_measure_long = $request->long;
            $pantMeasure->its_pant_measure_komor = $request->komor;
            $pantMeasure->its_pant_measure_hip = $request->hip;
            $pantMeasure->its_pant_measure_mohuri = $request->muhuri;
            $pantMeasure->its_pant_measure_thigh = $request->thigh;
            $pantMeasure->its_pant_measure_high = $request->high;
            $pantMeasure->its_pant_measure_fly = $request->fly;
            $pantMeasure->its_pant_measure_kuci = $request->kuci;
            $pantMeasure->its_pant_measure_pocket_type = $request->pocket;
            $pantMeasure->its_pant_measure_pocket_backside = $request->back_pocket;
            $pantMeasure->its_pant_measure_pocket_inner = $request->inner_pocket;
            $pantMeasure->its_pant_measure_muhuri_type = $request->mohuri_type;
            $pantMeasure->its_pant_measure_loop = $request->loop;
            $pantMeasure->its_pant_measure_loop_size = $request->loop_size;
            $pantMeasure->its_pant_measure_date = $submit;
            $pantMeasure->its_pant_measure_catalog_no = $request->catalog;
            $pantMeasure->its_pant_measure_others = $request->others;
            $pantMeasure->its_pant_measure_submit_by = $submit_by;
            $pantMeasure->its_pant_measure_submit_at = $submit_at;
            // dd($shirtMeasure);
            $pantMeasure->save();

            // Temporary Id Catch
            $its_add_temp_id = IglTailorTemporary::where('its_temp_pname','pant')->first();

            if(
                !IglTailorAddOrder::where('its_add_order_com_id',$com)
                                  ->where('its_add_order_bran_id',$bran)
                                  ->where('its_add_order_user_id',$user)
                                  ->where('its_add_order_order_id',$request->order_id)
                                  ->where('its_add_product_name',$request->p_name)
                                  ->exists()
            )
            {
                $addOrder = new IglTailorAddOrder();
                $addOrder->its_add_order_com_id = $com;
                $addOrder->its_add_order_bran_id = $bran;
                $addOrder->its_add_order_user_id = $user;
                $addOrder->its_add_order_cus_id = $request->customer;
                $addOrder->its_add_order_measure_id = $pantMeasure->its_pant_measure_slno;
                $addOrder->its_add_order_order_id = $request->order_id;
                $addOrder->its_add_order_temp_id = $its_add_temp_id->its_temp_slno;
                $addOrder->its_add_product_name = $request->p_name;
                $addOrder->its_add_product_quantity = $its_add_temp_id->its_temp_qty;
                $addOrder->its_add_product_price = $its_add_temp_id->its_temp_price;
                $addOrder->its_add_order_total_price = $its_add_temp_id->its_temp_total_price;
                $addOrder->its_add_order_receive_date = $submit;
                $addOrder->its_add_order_delivery_date = NULL;
                $addOrder->its_add_order_status = 2;
                $addOrder->its_add_order_submit_by = $submit_by;
                $addOrder->its_add_order_submit_at = $submit_at;
                $addOrder->save();

                Session::put('pantMeasureId',$addOrder->its_add_order_slno);
            }
        } 
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['err' => $e->getMessage()]);
        }
        DB::commit();

        return redirect()->back();
    }
    public function blazerMeasurement(Request $request)
    {
        Session::put('oldBlazerMeasuermentDelete', 'delete');
        
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $user = Auth::user()->UserDetails->its_user_user_id;
        $submit_at = Carbon::now()->format('Y-m-d H:i:s');

        $cus_mobile = IglTailorCustomer::where('its_cus_com_id',$com)
                                       ->where('its_cus_slno',$request->customer)
                                       ->first();

        $submit = Carbon::now()->format('Y-m-d');
        $submit_by = Auth::user()->its_slno;

        DB::beginTransaction();
        try {
            $blazerMeasure = new IglTailorMsrBlazer();
            $blazerMeasure->its_blazer_measure_com_id = $com;
            $blazerMeasure->its_blazer_measure_bran_id = $bran;
            $blazerMeasure->its_blazer_measure_user_id = $user;
            $blazerMeasure->its_blazer_measure_cus_mobile = $cus_mobile->its_cus_mobile;
            $blazerMeasure->its_blazer_product_name = $request->p_name;
            $blazerMeasure->its_blazer_product_qty = $request->qty;
            $blazerMeasure->its_blazer_measure_long = $request->long;
            $blazerMeasure->its_blazer_measure_body = $request->body;
            $blazerMeasure->its_blazer_measure_belly = $request->belly;
            $blazerMeasure->its_blazer_measure_hip = $request->hip;
            $blazerMeasure->its_blazer_measure_shoulder = $request->shoulder;
            $blazerMeasure->its_blazer_measure_hand_long = $request->hand_long;
            $blazerMeasure->its_blazer_measure_hand_muhuri = $request->hand_muhuri;
            $blazerMeasure->its_blazer_measure_cross_back = $request->cross_back;
            $blazerMeasure->its_blazer_measure_button_num = $request->button;
            $blazerMeasure->its_blazer_measure_nepel = $request->nepel;
            $blazerMeasure->its_blazer_measure_side = $request->open;
            $blazerMeasure->its_blazer_measure_catalog_no = $request->catalog;
            $blazerMeasure->its_blazer_measure_others = $request->others;
            $blazerMeasure->its_blazer_measure_date = $submit;
            $blazerMeasure->its_blazer_measure_best = $request->best;
            $blazerMeasure->its_blazer_measure_under = $request->bottom;
            $blazerMeasure->its_blazer_measure_submit_by = $submit_by;
            $blazerMeasure->its_blazer_measure_submit_at = $submit_at;
            // dd($shirtMeasure);
            $blazerMeasure->save();

            // Temporary Id Catch
            $its_add_temp_id = IglTailorTemporary::where('its_temp_pname','blazer')->first();

            if(
                !IglTailorAddOrder::where('its_add_order_com_id',$com)
                                  ->where('its_add_order_bran_id',$bran)
                                  ->where('its_add_order_user_id',$user)
                                  ->where('its_add_order_order_id',$request->order_id)
                                  ->where('its_add_product_name',$request->p_name)
                                  ->exists()
            )
            {
                $addOrder = new IglTailorAddOrder();
                $addOrder->its_add_order_com_id = $com;
                $addOrder->its_add_order_bran_id = $bran;
                $addOrder->its_add_order_user_id = $user;
                $addOrder->its_add_order_cus_id = $request->customer;
                $addOrder->its_add_order_measure_id = $blazerMeasure->its_blazer_measure_slno;
                $addOrder->its_add_order_order_id = $request->order_id;
                $addOrder->its_add_order_temp_id = $its_add_temp_id->its_temp_slno;
                $addOrder->its_add_product_name = $request->p_name;
                $addOrder->its_add_product_quantity = $its_add_temp_id->its_temp_qty;
                $addOrder->its_add_product_price = $its_add_temp_id->its_temp_price;
                $addOrder->its_add_order_total_price = $its_add_temp_id->its_temp_total_price;
                $addOrder->its_add_order_receive_date = $submit;
                $addOrder->its_add_order_delivery_date = NULL;
                $addOrder->its_add_order_status = 2;
                $addOrder->its_add_order_submit_by = $submit_by;
                $addOrder->its_add_order_submit_at = $submit_at;
                $addOrder->save();

                Session::put('blazerMeasureId',$addOrder->its_add_order_slno);
            }
        } 
        catch (\Exception $e) 
        {
            DB::rollback();
            return redirect()->back()->with(['err' => $e->getMessage()]);
        }
        DB::commit();

        return redirect()->back();
    }
    public function panjabiMeasurement(Request $request)
    {
        Session::put('oldPanjabiMeasuermentDelete', 'delete');

        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $user = Auth::user()->UserDetails->its_user_user_id;
        $submit_at = Carbon::now()->format('Y-m-d H:i:s');

        $cus_mobile = IglTailorCustomer::where('its_cus_com_id',$com)
                                       ->where('its_cus_slno',$request->customer)
                                       ->first();

        $submit = Carbon::now()->format('Y-m-d');
        $submit_by = Auth::user()->its_slno;

        DB::beginTransaction();
        try {
            $panjabiMeasure = new IglTailorMsrPanjabi();
            $panjabiMeasure->its_panjabi_msr_com_id = $com;
            $panjabiMeasure->its_panjabi_msr_bran_id = $bran;
            $panjabiMeasure->its_panjabi_msr_user_id = $user;
            $panjabiMeasure->its_panjabi_msr_cus_mobile = $cus_mobile->its_cus_mobile;
            $panjabiMeasure->its_panjabi_product_name = $request->p_name;
            $panjabiMeasure->its_panjabi_product_qty = $request->qty;
            $panjabiMeasure->its_panjabi_msr_long = $request->long;
            $panjabiMeasure->its_panjabi_msr_body = $request->body;
            $panjabiMeasure->its_panjabi_msr_body_loose = $request->body_loose;
            $panjabiMeasure->its_panjabi_msr_belly = $request->belly;
            $panjabiMeasure->its_panjabi_msr_belly_loose = $request->belly_loose;
            $panjabiMeasure->its_panjabi_msr_hip = $request->hip;
            $panjabiMeasure->its_panjabi_msr_hip_loose = $request->hip_loose;
            $panjabiMeasure->its_panjabi_msr_shoulder = $request->shoulder;
            $panjabiMeasure->its_panjabi_msr_neck = $request->neck;
            $panjabiMeasure->its_panjabi_msr_hand_long = $request->hand_long;
            $panjabiMeasure->its_panjabi_msr_muhuri = $request->muhuri;
            $panjabiMeasure->its_panjabi_msr_plet = $request->plet;
            $panjabiMeasure->its_panjabi_msr_collar_type = $request->collar_type;
            $panjabiMeasure->its_panjabi_msr_collar_size = $request->collar_size;
            $panjabiMeasure->its_panjabi_msr_pocket = $request->pocket;
            $panjabiMeasure->its_panjabi_msr_inner_pocket = $request->inner_pocket;
            $panjabiMeasure->its_panjabi_msr_date = $submit;
            $panjabiMeasure->its_panjabi_msr_catalog_no = $request->catalog;
            $panjabiMeasure->its_panjabi_msr_others = $request->others;
            $panjabiMeasure->its_panjabi_msr_submit_by = $submit_by;
            $panjabiMeasure->its_panjabi_msr_submit_at = $submit_at;
            // dd($shirtMeasure);
            $panjabiMeasure->save();

            // Temporary Id Catch
            $its_add_temp_id = IglTailorTemporary::where('its_temp_pname','panjabi')->first();
            
            if(
                !IglTailorAddOrder::where('its_add_order_com_id',$com)
                                  ->where('its_add_order_bran_id',$bran)
                                  ->where('its_add_order_user_id',$user)
                                  ->where('its_add_order_order_id',$request->order_id)
                                  ->where('its_add_product_name',$request->p_name)
                                  ->exists()
            )
            {
                $addOrder = new IglTailorAddOrder();
                $addOrder->its_add_order_com_id = $com;
                $addOrder->its_add_order_bran_id = $bran;
                $addOrder->its_add_order_user_id = $user;
                $addOrder->its_add_order_cus_id = $request->customer;
                $addOrder->its_add_order_measure_id = $panjabiMeasure->its_panjabi_msr_slno;
                $addOrder->its_add_order_order_id = $request->order_id;
                $addOrder->its_add_order_temp_id = $its_add_temp_id->its_temp_slno;
                $addOrder->its_add_product_name = $request->p_name;
                $addOrder->its_add_product_quantity = $its_add_temp_id->its_temp_qty;
                $addOrder->its_add_product_price = $its_add_temp_id->its_temp_price;
                $addOrder->its_add_order_total_price = $its_add_temp_id->its_temp_total_price;
                $addOrder->its_add_order_receive_date = $submit;
                $addOrder->its_add_order_delivery_date = NULL;
                $addOrder->its_add_order_status = 2;
                $addOrder->its_add_order_submit_by = $submit_by;
                $addOrder->its_add_order_submit_at = $submit_at;
                $addOrder->save();

                Session::put('panjabiMeasureId',$addOrder->its_add_order_slno);
            }
        } 
        catch (\Exception $e) 
        {
            DB::rollback();
            return redirect()->back()->with(['err' => $e->getMessage()]);
        }
        DB::commit();

        return redirect()->back();
    }
    public function payjamaMeasurement(Request $request)
    {
        Session::put('oldPayjamaMeasuermentDelete', 'delete');
        
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $user = Auth::user()->UserDetails->its_user_user_id;
        $submit_at = Carbon::now()->format('Y-m-d H:i:s');

        $cus_mobile = IglTailorCustomer::where('its_cus_com_id',$com)
                                       ->where('its_cus_slno',$request->customer)
                                       ->first();

        $submit = Carbon::now()->format('Y-m-d');
        $submit_by = Auth::user()->its_slno;

        DB::beginTransaction();
        try {
            $payjamaMeasure = new IglTailorMsrPayjama();
            $payjamaMeasure->its_payjama_measure_com_id = $com;
            $payjamaMeasure->its_payjama_measure_bran_id = $bran;
            $payjamaMeasure->its_payjama_measure_user_id = $user;
            $payjamaMeasure->its_payjama_measure_cus_mobile = $cus_mobile->its_cus_mobile;
            $payjamaMeasure->its_payjama_product_name = $request->p_name;
            $payjamaMeasure->its_payjama_product_qty = $request->qty;
            $payjamaMeasure->its_payjama_measure_long = $request->long;
            $payjamaMeasure->its_payjama_measure_komor = $request->komor;
            $payjamaMeasure->its_payjama_measure_hip = $request->hip;
            $payjamaMeasure->its_payjama_measure_hip_loose = $request->hip_loose;
            $payjamaMeasure->its_payjama_measure_muhuri = $request->muhuri;
            $payjamaMeasure->its_payjama_measure_thigh = $request->thigh;
            $payjamaMeasure->its_payjama_measure_fly = $request->fly;
            $payjamaMeasure->its_payjama_measure_high = $request->high;
            $payjamaMeasure->its_payjama_measure_pocket = $request->pocket;
            $payjamaMeasure->its_payjama_measure_date = $submit;
            $payjamaMeasure->its_payjama_measure_catalog_no = $request->catalog;
            $payjamaMeasure->its_payjama_measure_others = $request->others;
            $payjamaMeasure->its_payjama_measure_submit_by = $submit_by;
            $payjamaMeasure->its_payjama_measure_submit_at = $submit_at;
            // dd($shirtMeasure);
            $payjamaMeasure->save();

            // Temporary Id Catch
            $its_add_temp_id = IglTailorTemporary::where('its_temp_pname','payjama')->first();

            if(
                !IglTailorAddOrder::where('its_add_order_com_id',$com)
                                  ->where('its_add_order_bran_id',$bran)
                                  ->where('its_add_order_user_id',$user)
                                  ->where('its_add_order_order_id',$request->order_id)
                                  ->where('its_add_product_name',$request->p_name)
                                  ->exists()
            )
            {
                $addOrder = new IglTailorAddOrder();
                $addOrder->its_add_order_com_id = $com;
                $addOrder->its_add_order_bran_id = $bran;
                $addOrder->its_add_order_user_id = $user;
                $addOrder->its_add_order_cus_id = $request->customer;
                $addOrder->its_add_order_measure_id = $payjamaMeasure->its_payjama_measure_slno;
                $addOrder->its_add_order_order_id = $request->order_id;
                $addOrder->its_add_order_temp_id = $its_add_temp_id->its_temp_slno;
                $addOrder->its_add_product_name = $request->p_name;
                $addOrder->its_add_product_quantity = $its_add_temp_id->its_temp_qty;
                $addOrder->its_add_product_price = $its_add_temp_id->its_temp_price;
                $addOrder->its_add_order_total_price = $its_add_temp_id->its_temp_total_price;
                $addOrder->its_add_order_receive_date = $submit;
                $addOrder->its_add_order_delivery_date = NULL;
                $addOrder->its_add_order_status = 2;
                $addOrder->its_add_order_submit_by = $submit_by;
                $addOrder->its_add_order_submit_at = $submit_at;
                $addOrder->save();

                Session::put('payjamaMeasureId',$addOrder->its_add_order_slno);
            }
        } 
        catch (\Exception $e) 
        {
            DB::rollback();
            return redirect()->back()->with(['err' => $e->getMessage()]);
        }
        DB::commit();

        return redirect()->back();
    }
    public function safariMeasurement(Request $request)
    {
        Session::put('oldSafariMeasuermentDelete', 'delete');
        
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $user = Auth::user()->UserDetails->its_user_user_id;
        $submit_at = Carbon::now()->format('Y-m-d H:i:s');

        $cus_mobile = IglTailorCustomer::where('its_cus_com_id',$com)
                                       ->where('its_cus_slno',$request->customer)
                                       ->first();

        $submit = Carbon::now()->format('Y-m-d');
        $submit_by = Auth::user()->its_slno;

        DB::beginTransaction();
        try {
            $safariMeasure = new IglTailorMsrSafari();
            $safariMeasure->its_safari_measure_com_id = $com;
            $safariMeasure->its_safari_measure_bran_id = $bran;
            $safariMeasure->its_safari_measure_user_id = $user;
            $safariMeasure->its_safari_measure_cus_mobile = $cus_mobile->its_cus_mobile;
            $safariMeasure->its_safari_product_name = $request->p_name;
            $safariMeasure->its_safari_product_qty = $request->qty;
            $safariMeasure->its_safari_measure_long = $request->long;
            $safariMeasure->its_safari_measure_body = $request->body;
            $safariMeasure->its_safari_measure_body_loose = $request->body_loose;
            $safariMeasure->its_safari_measure_belly = $request->belly;
            $safariMeasure->its_safari_measure_belly_loose = $request->belly_loose;
            $safariMeasure->its_safari_measure_hip = $request->hip;
            $safariMeasure->its_safari_measure_hip_loose = $request->hip_loose;
            $safariMeasure->its_safari_measure_shoulder = $request->shoulder;
            $safariMeasure->its_safari_measure_cross_back = $request->cross_back;
            $safariMeasure->its_safari_measure_neck = $request->neck;
            $safariMeasure->its_safari_measure_hand_long = $request->hand_long;
            $safariMeasure->its_safari_measure_hand_cuff = $request->cuff;
            $safariMeasure->its_safari_measure_plet = $request->plet;
            $safariMeasure->its_safari_measure_collar = $request->collar;
            $safariMeasure->its_safari_measure_collar_size = $request->collar_size;
            $safariMeasure->its_safari_measure_pocket = $request->pocket;
            $safariMeasure->its_safari_measure_back_side = $request->back_side;
            $safariMeasure->its_safari_measure_inner_pocket = $request->inner_pocket;
            $safariMeasure->its_safari_measure_type = $request->type;
            $safariMeasure->its_safari_measure_date = $submit;
            $safariMeasure->its_safari_measure_catalog_no = $request->catalog;
            $safariMeasure->its_safari_measure_others = $request->others;
            $safariMeasure->its_safari_measure_submit_by = $submit_by;
            $safariMeasure->its_safari_measure_submit_at = $submit_at;
            // dd($shirtMeasure);
            $safariMeasure->save();

            // Temporary Id Catch
            $its_add_temp_id = IglTailorTemporary::where('its_temp_pname','safari')->first();

            if(
                !IglTailorAddOrder::where('its_add_order_com_id',$com)
                                  ->where('its_add_order_bran_id',$bran)
                                  ->where('its_add_order_user_id',$user)
                                  ->where('its_add_order_order_id',$request->order_id)
                                  ->where('its_add_product_name',$request->p_name)
                                  ->exists()
            )
            {
                $addOrder = new IglTailorAddOrder();
                $addOrder->its_add_order_com_id = $com;
                $addOrder->its_add_order_bran_id = $bran;
                $addOrder->its_add_order_user_id = $user;
                $addOrder->its_add_order_cus_id = $request->customer;
                $addOrder->its_add_order_measure_id = $safariMeasure->its_safari_measure_slno;
                $addOrder->its_add_order_order_id = $request->order_id;
                $addOrder->its_add_order_temp_id = $its_add_temp_id->its_temp_slno;
                $addOrder->its_add_product_name = $request->p_name;
                $addOrder->its_add_product_quantity = $its_add_temp_id->its_temp_qty;
                $addOrder->its_add_product_price = $its_add_temp_id->its_temp_price;
                $addOrder->its_add_order_total_price = $its_add_temp_id->its_temp_total_price;
                $addOrder->its_add_order_receive_date = $submit;
                $addOrder->its_add_order_delivery_date = NULL;
                $addOrder->its_add_order_status = 2;
                $addOrder->its_add_order_submit_by = $submit_by;
                $addOrder->its_add_order_submit_at = $submit_at;
                $addOrder->save();

                Session::put('safariMeasureId',$addOrder->its_add_order_slno);
            }
        } 
        catch (\Exception $e) 
        {
            DB::rollback();
            return redirect()->back()->with(['err' => $e->getMessage()]);
        }
        DB::commit();

        return redirect()->back();
    }
    public function photuaMeasurement(Request $request)
    {
        Session::put('oldPhotuaMeasuermentDelete', 'delete');

        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $user = Auth::user()->UserDetails->its_user_user_id;
        $submit_at = Carbon::now()->format('Y-m-d H:i:s');

        $cus_mobile = IglTailorCustomer::where('its_cus_com_id',$com)
                                       ->where('its_cus_slno',$request->customer)
                                       ->first();

        $submit = Carbon::now()->format('Y-m-d');
        $submit_by = Auth::user()->its_slno;

        DB::beginTransaction();
        try {
            $photuaMeasure = new IglTailorMsrPhotua();
            $photuaMeasure->its_photua_measure_com_id = $com;
            $photuaMeasure->its_photua_measure_bran_id = $bran;
            $photuaMeasure->its_photua_measure_user_id = $user;
            $photuaMeasure->its_photua_measure_cus_mobile = $cus_mobile->its_cus_mobile;
            $photuaMeasure->its_photua_product_name = $request->p_name;
            $photuaMeasure->its_photua_product_qty = $request->qty;
            $photuaMeasure->its_photua_measure_long = $request->long;
            $photuaMeasure->its_photua_measure_body = $request->body;
            $photuaMeasure->its_photua_measure_body_loose = $request->body_loose;
            $photuaMeasure->its_photua_measure_belly = $request->belly;
            $photuaMeasure->its_photua_measure_hip = $request->hip;
            $photuaMeasure->its_photua_measure_shoulder = $request->shoulder;
            $photuaMeasure->its_photua_measure_neck = $request->neck;
            $photuaMeasure->its_photua_measure_hand_long = $request->hand_long;
            $photuaMeasure->its_photua_measure_hand_moja = $request->hand_moja;
            $photuaMeasure->its_photua_measure_hand_kunu = $request->hand_kunu;
            $photuaMeasure->its_photua_measure_hand_cuff = $request->hand_cuff;
            $photuaMeasure->its_photua_measure_types = $request->type;
            $photuaMeasure->its_photua_measure_plet = $request->plet;
            $photuaMeasure->its_photua_measure_collar = $request->collar;
            $photuaMeasure->its_photua_measure_collar_size = $request->collar_size;
            $photuaMeasure->its_photua_measure_cuff_size = $request->cuff_size;
            $photuaMeasure->its_photua_measure_pocket = $request->pocket;
            $photuaMeasure->its_photua_measure_pocket_inner = $request->inner_pocket;
            $photuaMeasure->its_photua_measure_open = $request->open;
            $photuaMeasure->its_photua_measure_date = $submit;
            $photuaMeasure->its_photua_measure_catalog_no = $request->catalog;
            $photuaMeasure->its_photua_measure_others = $request->others;
            $photuaMeasure->its_photua_measure_submit_at = $submit_at;
            $photuaMeasure->its_photua_measure_submit_by = $submit_by;
            // dd($shirtMeasure);
            $photuaMeasure->save();

            // Temporary Id Catch
            $its_add_temp_id = IglTailorTemporary::where('its_temp_pname','photua')->first();
            
            if(
                !IglTailorAddOrder::where('its_add_order_com_id',$com)
                                  ->where('its_add_order_bran_id',$bran)
                                  ->where('its_add_order_user_id',$user)
                                  ->where('its_add_order_order_id',$request->order_id)
                                  ->where('its_add_product_name',$request->p_name)
                                  ->exists()
            )
            {
                $addOrder = new IglTailorAddOrder();
                $addOrder->its_add_order_com_id = $com;
                $addOrder->its_add_order_bran_id = $bran;
                $addOrder->its_add_order_user_id = $user;
                $addOrder->its_add_order_cus_id = $request->customer;
                $addOrder->its_add_order_measure_id = $photuaMeasure->its_photua_measure_slno;
                $addOrder->its_add_order_order_id = $request->order_id;
                $addOrder->its_add_order_temp_id = $its_add_temp_id->its_temp_slno;
                $addOrder->its_add_product_name = $request->p_name;
                $addOrder->its_add_product_quantity = $its_add_temp_id->its_temp_qty;
                $addOrder->its_add_product_price = $its_add_temp_id->its_temp_price;
                $addOrder->its_add_order_total_price = $its_add_temp_id->its_temp_total_price;
                $addOrder->its_add_order_receive_date = $submit;
                $addOrder->its_add_order_delivery_date = NULL;
                $addOrder->its_add_order_status = 2;
                $addOrder->its_add_order_submit_by = $submit_by;
                $addOrder->its_add_order_submit_at = $submit_at;
                $addOrder->save();

                Session::put('photuaMeasureId',$addOrder->its_add_order_slno);
            }
        } 
        catch (\Exception $e) 
        {
            DB::rollback();
            return redirect()->back()->with(['err' => $e->getMessage()]);
        }
        DB::commit();

        return redirect()->back();
    }
    public function mojibCortMeasurement(Request $request)
    {
        Session::put('oldMojibCortMeasuermentDelete', 'delete');
        
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $user = Auth::user()->UserDetails->its_user_user_id;
        $submit_at = Carbon::now()->format('Y-m-d H:i:s');
        
        $cus_mobile = IglTailorCustomer::where('its_cus_com_id',$com)
                                       ->where('its_cus_slno',$request->customer)
                                       ->first();

        $submit = Carbon::now()->format('Y-m-d');
        $submit_by = Auth::user()->its_slno;

        DB::beginTransaction();
        try {
            $mojibCortMeasure = new IglTailorMsrMojibCort();
            $mojibCortMeasure->its_mojibcort_measure_com_id = $com;
            $mojibCortMeasure->its_mojibcort_measure_bran_id = $bran;
            $mojibCortMeasure->its_mojibcort_measure_user_id = $user;
            $mojibCortMeasure->its_mojibcort_measure_cus_mobile = $cus_mobile->its_cus_mobile;
            $mojibCortMeasure->its_mojibcort_product_name = $request->p_name;
            $mojibCortMeasure->its_mojibcort_product_qty = $request->qty;
            $mojibCortMeasure->its_mojibcort_measure_long = $request->long;
            $mojibCortMeasure->its_mojibcort_measure_body = $request->body;
            $mojibCortMeasure->its_mojibcort_measure_body_loose = $request->body_loose;
            $mojibCortMeasure->its_mojibcort_measure_belly = $request->belly;
            $mojibCortMeasure->its_mojibcort_measure_belly_loose = $request->belly_loose;
            $mojibCortMeasure->its_mojibcort_measure_hip = $request->hip;
            $mojibCortMeasure->its_mojibcort_measure_hip_loose = $request->hip_loose;
            $mojibCortMeasure->its_mojibcort_measure_shoulder = $request->shoulder;
            $mojibCortMeasure->its_mojibcort_measure_neck = $request->neck;
            $mojibCortMeasure->its_mojibcort_measure_collar = $request->collar;
            $mojibCortMeasure->its_mojibcort_measure_pocket = $request->pocket;
            $mojibCortMeasure->its_mojibcort_measure_inner_pocket = $request->inner_pocket;
            $mojibCortMeasure->its_mojibcort_measure_open = $request->open;
            $mojibCortMeasure->its_mojibcort_measure_catalog_no = $request->catalog;
            $mojibCortMeasure->its_mojibcort_measure_others = $request->others;
            $mojibCortMeasure->its_mojibcort_measure_date = $submit;
            $mojibCortMeasure->its_mojibcort_measure_submit_by = $submit_by;
            $mojibCortMeasure->its_mojibcort_measure_submit_at = $submit_at;
            // dd($shirtMeasure);
            $mojibCortMeasure->save();

            // Temporary Id Catch
            $its_add_temp_id = IglTailorTemporary::where('its_temp_pname','mojib_cort')->first();

            if(
                !IglTailorAddOrder::where('its_add_order_com_id',$com)
                                  ->where('its_add_order_bran_id',$bran)
                                  ->where('its_add_order_user_id',$user)
                                  ->where('its_add_order_order_id',$request->order_id)
                                  ->where('its_add_product_name',$request->p_name)
                                  ->exists()
            )
            {
                $addOrder = new IglTailorAddOrder();
                $addOrder->its_add_order_com_id = $com;
                $addOrder->its_add_order_bran_id = $bran;
                $addOrder->its_add_order_user_id = $user;
                $addOrder->its_add_order_cus_id = $request->customer;
                $addOrder->its_add_order_measure_id = $mojibCortMeasure->its_mojibcort_measure_slno;
                $addOrder->its_add_order_order_id = $request->order_id;
                $addOrder->its_add_order_temp_id = $its_add_temp_id->its_temp_slno;
                $addOrder->its_add_product_name = $request->p_name;
                $addOrder->its_add_product_quantity = $its_add_temp_id->its_temp_qty;
                $addOrder->its_add_product_price = $its_add_temp_id->its_temp_price;
                $addOrder->its_add_order_total_price = $its_add_temp_id->its_temp_total_price;
                $addOrder->its_add_order_receive_date = $submit;
                $addOrder->its_add_order_delivery_date = NULL;
                $addOrder->its_add_order_status = 2;
                $addOrder->its_add_order_submit_by = $submit_by;
                $addOrder->its_add_order_submit_at = $submit_at;
                $addOrder->save();

                Session::put('mojibCortMeasureId',$addOrder->its_add_order_slno);
            }
        } 
        catch (\Exception $e) 
        {
            DB::rollback();
            return redirect()->back()->with(['err' => $e->getMessage()]);
        }
        DB::commit();

        return redirect()->back();
    }
    public function kableMeasurement(Request $request)
    {
        Session::put('oldKableMeasuermentDelete', 'delete');
        
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $user = Auth::user()->UserDetails->its_user_user_id;
        $submit_at = Carbon::now()->format('Y-m-d H:i:s');

        $cus_mobile = IglTailorCustomer::where('its_cus_com_id',$com)
                                        ->where('its_cus_slno',$request->customer)
                                        ->first();

        $submit = Carbon::now()->format('Y-m-d');
        $submit_by = Auth::user()->its_slno;

        DB::beginTransaction();
        try {
            $KableMeasure = new IglTailorMsrKable();
            $KableMeasure->its_kable_measure_com_id = $com;
            $KableMeasure->its_kable_measure_bran_id = $bran;
            $KableMeasure->its_kable_measure_user_id = $user;
            $KableMeasure->its_kable_measure_cus_mobile = $cus_mobile->its_cus_mobile;
            $KableMeasure->its_kable_product_name = $request->p_name;
            $KableMeasure->its_kable_product_qty = $request->qty;
            $KableMeasure->its_kable_measure_long = $request->long;
            $KableMeasure->its_kable_measure_body = $request->body;
            $KableMeasure->its_kable_measure_body_loose = $request->body_loose;
            $KableMeasure->its_kable_measure_belly = $request->belly;
            $KableMeasure->its_kable_measure_belly_loose = $request->bally_loose;
            $KableMeasure->its_kable_measure_hip = $request->hip;
            $KableMeasure->its_kable_measure_hip_loose = $request->hip_loose;
            $KableMeasure->its_kable_measure_shoulder = $request->shoulder;
            $KableMeasure->its_kable_measure_neck = $request->neck;
            $KableMeasure->its_kable_measure_hand_long = $request->hand_long;
            $KableMeasure->its_kable_measure_plet = $request->plate;
            $KableMeasure->its_kable_measure_muhuri = $request->muhuri;
            $KableMeasure->its_kable_measure_collar_type = $request->collar_type;
            $KableMeasure->its_kable_measure_collar_size = $request->collar;
            $KableMeasure->its_kable_measure_pocket = $request->pocket;
            $KableMeasure->its_kable_measure_date = $submit;
            $KableMeasure->its_kable_measure_catalog_no = $request->catalog;
            $KableMeasure->its_kable_measure_others = $request->others;
            $KableMeasure->its_kable_measure_submit_by = $submit_by;
            $KableMeasure->its_kable_measure_submit_at = $submit_at;
            // dd($shirtMeasure);
            $KableMeasure->save();

            // Temporary Id Catch
            $its_add_temp_id = IglTailorTemporary::where('its_temp_pname','kable')->first();

            if(
                !IglTailorAddOrder::where('its_add_order_com_id',$com)
                                  ->where('its_add_order_bran_id',$bran)
                                  ->where('its_add_order_user_id',$user)
                                  ->where('its_add_order_order_id',$request->order_id)
                                  ->where('its_add_product_name',$request->p_name)
                                  ->exists()
            )
            {
                $addOrder = new IglTailorAddOrder();
                $addOrder->its_add_order_com_id = $com;
                $addOrder->its_add_order_bran_id = $bran;
                $addOrder->its_add_order_user_id = $user;
                $addOrder->its_add_order_cus_id = $request->customer;
                $addOrder->its_add_order_measure_id = $KableMeasure->its_kable_measure_slno;
                $addOrder->its_add_order_order_id = $request->order_id;
                $addOrder->its_add_order_temp_id = $its_add_temp_id->its_temp_slno;
                $addOrder->its_add_product_name = $request->p_name;
                $addOrder->its_add_product_quantity = $its_add_temp_id->its_temp_qty;
                $addOrder->its_add_product_price = $its_add_temp_id->its_temp_price;
                $addOrder->its_add_order_total_price = $its_add_temp_id->its_temp_total_price;
                $addOrder->its_add_order_receive_date = $submit;
                $addOrder->its_add_order_delivery_date = NULL;
                $addOrder->its_add_order_status = 2;
                $addOrder->its_add_order_submit_by = $submit_by;
                $addOrder->its_add_order_submit_at = $submit_at;
                $addOrder->save();

                Session::put('kableMeasureId',$addOrder->its_add_order_slno);
            }
        } 
        catch (\Exception $e) 
        {
            DB::rollback();
            return redirect()->back()->with(['err' => $e->getMessage()]);
        }
        DB::commit();

        return redirect()->back();
    }
    public function kotiMeasurement(Request $request)
    {
        Session::put('oldKotiMeasuermentDelete', 'delete');

        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $user = Auth::user()->UserDetails->its_user_user_id;
        $submit_at = Carbon::now()->format('Y-m-d H:i:s');

        $cus_mobile = IglTailorCustomer::where('its_cus_com_id',$com)
                                        ->where('its_cus_slno',$request->customer)
                                        ->first();

        $submit = Carbon::now()->format('Y-m-d');
        $submit_by = Auth::user()->its_slno;

        DB::beginTransaction();
        try {
            $kotiMeasure = new IglTailorMsrKoti();
            $kotiMeasure->its_koti_measure_com_id = $com;
            $kotiMeasure->its_koti_measure_bran_id = $bran;
            $kotiMeasure->its_koti_measure_user_id = $user;
            $kotiMeasure->its_koti_measure_cus_mobile = $cus_mobile->its_cus_mobile;
            $kotiMeasure->its_koti_product_name = $request->p_name;
            $kotiMeasure->its_koti_product_qty = $request->qty;
            $kotiMeasure->its_koti_measure_long = $request->long;
            $kotiMeasure->its_koti_measure_body = $request->body;
            $kotiMeasure->its_koti_measure_body_loose = $request->body_loose;
            $kotiMeasure->its_koti_measure_belly = $request->belly;
            $kotiMeasure->its_koti_measure_belly_loose = $request->belly_loose;
            $kotiMeasure->its_koti_measure_hip = $request->hip;
            $kotiMeasure->its_koti_measure_hip_loose = $request->hip_loose;
            $kotiMeasure->its_koti_measure_shoulder = $request->shoulder;
            $kotiMeasure->its_koti_measure_pocket = $request->pocket;
            $kotiMeasure->its_koti_measure_belt = $request->belt;
            $kotiMeasure->its_koti_measure_catalog_no = $request->catalog;
            $kotiMeasure->its_koti_measure_others = $request->others;
            $kotiMeasure->its_koti_measure_date = $submit;
            $kotiMeasure->its_koti_measure_submit_at = $submit_at;
            $kotiMeasure->its_koti_measure_submit_by = $submit_by;
            // dd($shirtMeasure);
            $kotiMeasure->save();

            // Temporary Id Catch
            $its_add_temp_id = IglTailorTemporary::where('its_temp_pname','koti')->first();
            
           if(
                !IglTailorAddOrder::where('its_add_order_com_id',$com)
                                  ->where('its_add_order_bran_id',$bran)
                                  ->where('its_add_order_user_id',$user)
                                  ->where('its_add_order_order_id',$request->order_id)
                                  ->where('its_add_product_name',$request->p_name)
                                  ->exists()
           )
           {
                $addOrder = new IglTailorAddOrder();
                $addOrder->its_add_order_com_id = $com;
                $addOrder->its_add_order_bran_id = $bran;
                $addOrder->its_add_order_user_id = $user;
                $addOrder->its_add_order_cus_id = $request->customer;
                $addOrder->its_add_order_measure_id = $kotiMeasure->its_koti_measure_slno;
                $addOrder->its_add_order_order_id = $request->order_id;
                $addOrder->its_add_order_temp_id = $its_add_temp_id->its_temp_slno;
                $addOrder->its_add_product_name = $request->p_name;
                $addOrder->its_add_product_quantity = $its_add_temp_id->its_temp_qty;
                $addOrder->its_add_product_price = $its_add_temp_id->its_temp_price;
                $addOrder->its_add_order_total_price = $its_add_temp_id->its_temp_total_price;
                $addOrder->its_add_order_receive_date = $submit;
                $addOrder->its_add_order_delivery_date = NULL;
                $addOrder->its_add_order_status = 2;
                $addOrder->its_add_order_submit_by = $submit_by;
                $addOrder->its_add_order_submit_at = $submit_at;
                $addOrder->save();

                Session::put('kotiMeasureId',$addOrder->its_add_order_slno);
           }
        } 
        catch (\Exception $e) 
        {
            DB::rollback();
            return redirect()->back()->with(['err' => $e->getMessage()]);
        }
        DB::commit();

        return redirect()->back();     
    }
    public function finishOrderPrint($order_id)
    {
        $order_id = base64_decode($order_id);
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $user = Auth::user()->UserDetails->its_user_user_id;
        $submit_by = Auth::user()->its_slno;

        $branch_information = IglTailorBranch::where('its_branch_id',$bran)->first();
        $branch_details = IglTailorUser::where('its_slno',$branch_information->its_branch_login_id)->first();

        // Order Information with Order Id 
         $order_inform = IglTailorAddOrder::where('its_add_order_com_id',$com) 
                                          ->where('its_add_order_bran_id',$bran)
                                          ->where('its_add_order_user_id',$user)
                                          ->where('its_add_order_order_id',$order_id)
                                          ->where('its_add_order_submit_by',$submit_by)
                                          ->get();
        // Order Single Information
         $single_order_info =  IglTailorAddOrder::with('customer_name')
                                                ->where('its_add_order_com_id',$com)
                                                ->where('its_add_order_bran_id',$bran)
                                                ->where('its_add_order_user_id',$user)
                                                ->where('its_add_order_order_id',$order_id)
                                                ->where('its_add_order_submit_by',$submit_by)
                                                ->first();
        // Order Total Amount 
        $total_amount = IglTailorAddOrder::where('its_add_order_com_id',$com)
                                         ->where('its_add_order_bran_id',$bran)
                                         ->where('its_add_order_order_id',$order_id)
                                         ->where('its_add_order_user_id',$user)
                                         ->where('its_add_order_submit_by',$submit_by)
                                         ->sum('its_add_order_total_price');    
       
        // // SMS Implement 
        $message_send_status = IglTailorBranch::where('its_branch_id',$bran)->first(); // User for Branch Information

         // User With Company Information
        $company_info = IglTailorCompany::where('its_company_com_id',$com)->first();
        
        if(isset($message_send_status->its_branch_message_status)){

            $explode_message_status = explode(',',$message_send_status->its_branch_message_status);

            if(in_array(1, $explode_message_status) && isset($company_info->its_company_sender_id)  && isset($company_info->its_company_api_key))
            {
                $customer_info = IglTailorCustomer::where('its_cus_slno',$single_order_info->its_add_order_cus_id)->first();
        
                $message = "Your Order Placed Successfully.\nOrder No: ". $order_id .
                        "\nPrice: ". $total_amount .".00"." Tk".
                        "\nDelivery Date: ". $single_order_info->its_add_order_delivery_date;
                        
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
        
        // Customer Total Due Calculation
        $total_debit_amount = IglTailorAccount::where('acc_com_id',$com)
                                              ->where('acc_bran_id',$bran)
                                              ->where('acc_customer_id',$single_order_info->its_add_order_cus_id)
                                              ->where('acc_status',1)
                                              ->sum('acc_debit');

        $total_credit_amount = IglTailorAccount::where('acc_com_id',$com)
                                               ->where('acc_bran_id',$bran)
                                               ->where('acc_customer_id',$single_order_info->its_add_order_cus_id)
                                               ->whereIn('acc_status',[2,3])
                                               ->sum('acc_credit');

        $total_due = $total_debit_amount - $total_credit_amount;

        return view('user.pages.finish_order_print',compact('order_inform','single_order_info','branch_information','branch_details','total_due'));
    }
    public function deliveryDate(Request $request)
    {   
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $user = Auth::user()->UserDetails->its_user_user_id;
        $submit_by = Auth::user()->its_slno;

        // Temporary Id
        $temp_slNos = json_decode($request->temp_slNo);

        // Delivery Date Update
        foreach($temp_slNos as $temp_slNo)
        {
            $delivery = IglTailorAddOrder::where('its_add_order_temp_id',$temp_slNo)->update([
                 'its_add_order_user_id'       => $user,
                'its_add_order_delivery_date' => $request->delivery_date,
            ]);
        }
        // Temporary Date Delete
        foreach($temp_slNos as $temp_slNo)
        {
            IglTailorTemporary::where('its_temp_slno',$temp_slNo)->delete();
        }
        // Order Total Amount Insert
        $total_amount = IglTailorAddOrder::where('its_add_order_com_id',$com)
                                         ->where('its_add_order_bran_id',$bran)
                                         ->where('its_add_order_user_id',$user)
                                         ->where('its_add_order_order_id',$request->order_id)
                                         ->where('its_add_order_submit_by',$submit_by)
                                         ->sum('its_add_order_total_price');
        
        if(
            ! IglTailorAccount::where('acc_com_id',$com)
                              ->where('acc_bran_id',$bran)
                              ->where('acc_user_id',$user)
                              ->where('acc_ord_id',$request->order_id)
                              ->where('acc_submit_by',$submit_by)->exists()
        )
        {
            $account                   = new IglTailorAccount();
            $account->acc_com_id       = $com;
            $account->acc_bran_id      = $bran;
            $account->acc_user_id      = $user;
            $account->acc_ord_id       = $request->order_id;
            $account->acc_customer_id  = $request->customer_id;
            $account->acc_credit       = '';
            $account->acc_debit        = $total_amount;
            $account->acc_pay_date     = Carbon::now()->format('Y-m-d');
            $account->acc_description  = 'Customer Buy';
            $account->acc_status       = 1;
            $account->acc_submit_by    = $submit_by;
            $account->save();
        }
        // Delete Add Order Serial Number
        Session::forget('shirtMeasureId');
        Session::forget('pantMeasureId');
        Session::forget('blazerMeasureId');
        Session::forget('panjabiMeasureId');
        Session::forget('payjamaMeasureId');
        Session::forget('safariMeasureId');
        Session::forget('photuaMeasureId');
        Session::forget('mojibCortMeasureId');
        Session::forget('kableMeasureId');
        Session::forget('kotiMeasureId');
        // Old Measure ID delete
        Session::forget("oldShirtMeasuermentDelete");
        Session::forget("oldPantMeasuermentDelete");
        Session::forget("oldBlazerMeasuermentDelete");
        Session::forget("oldPanjabiMeasuermentDelete");
        Session::forget("oldPayjamaMeasuermentDelete");
        Session::forget("oldSafariMeasuermentDelete");
        Session::forget("oldPhotuaMeasuermentDelete");
        Session::forget("oldMojibCortMeasuermentDelete");
        Session::forget("oldKableMeasuermentDelete");
        Session::forget("oldKotiMeasuermentDelete");

        Session::forget("oldShirtMeasuerment");
        Session::forget("oldPantMeasuerment");
        Session::forget("oldBlazerMeasuerment");
        Session::forget("oldPanjabiMeasuerment");
        Session::forget("oldPayjamaMeasuerment");
        Session::forget("oldSafariMeasuerment");
        Session::forget("oldPhotuaMeasuerment");
        Session::forget("oldMojibCortMeasuerment");
        Session::forget("oldKableMeasuerment");
        Session::forget("oldKotiMeasuerment");

        //Order Panding Delete
        Session::forget('order_panding');
            
        return redirect()->route('user.order.order-now')->with(['order' => 'Order Place Successfully']);
    }

}
