<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
use Carbon\Carbon;
use Session;
use Auth;

class MeasureUpdateController extends Controller
{
    function updateShirtMeasure(Request $request)
    {
        Session::put('oldShirtMeasuermentDelete', 'delete');

        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;
        
        $submit_at = Carbon::now()->format('Y-m-d H:i:s');
        $submit_by = Auth::user()->its_slno;
        $submit = Carbon::now()->format('Y-m-d');

        $order_info = IglTailorAddOrder::select('its_add_order_slno','its_add_order_measure_id')
                                        ->where('its_add_order_slno',$request->shirt_measure_order_slno)
                                        ->first();

        $shirt_info = IglTailorMsrShirt::select('its_shirt_msr_slno')
                                        ->where('its_shirt_msr_slno',$order_info->its_add_order_measure_id)
                                        ->first();

        IglTailorMsrShirt::where('its_shirt_msr_slno',$shirt_info->its_shirt_msr_slno)->update([
            'its_shirt_msr_long' => $request->long,
            'its_shirt_msr_body' => $request->body,
            'its_shirt_msr_body_loose' => $request->body_loose,
            'its_shirt_msr_bally' => $request->bally,
            'its_shirt_msr_bally_loose' => $request->bally_loose,
            'its_shirt_msr_hip' => $request->hip,
            'its_shirt_msr_hip_loose' => $request->hip_loose,
            'its_shirt_msr_shoulder' => $request->shoulder,
            'its_shirt_msr_neck' => $request->neck,
            'its_shirt_msr_hand_long' => $request->hand_long,
            'its_shirt_msr_hand_moja' => $request->hand_moja,
            'its_shirt_msr_hand_kunu' => $request->hand_kunu,
            'its_shirt_msr_hand_cuff' => $request->hand_cuff,
            'its_shirt_msr_types' => $request->type,
            'its_shirt_msr_plet' => $request->plet,
            'its_shirt_msr_collar' => $request->collar,
            'its_shirt_msr_collar_size' => $request->collar_size,
            'its_shirt_msr_cuff_size' => $request->cuff_size,
            'its_shirt_msr_pocket' => $request->pocket,
            'its_shirt_msr_pocket_inner' => $request->inner_pocket,
            'its_shirt_msr_catalog_no' => $request->catalog,
            'its_shirt_msr_others' => $request->others,
            'its_shirt_msr_submit_at' => $submit_at,
            'its_shirt_msr_submit_by' => $submit_by,
        ]);

        // Temporary Id Catch
        $its_add_temp_id = IglTailorTemporary::where('its_temp_pname','shirt')->first();

        if(!IglTailorAddOrder::where('its_add_order_bran_id',$bran)->where('its_add_order_order_id',$request->order_id)->where('its_add_product_name',$request->p_name)->exists())
        {
            $addOrder = new IglTailorAddOrder();
            $addOrder->its_add_order_com_id = $com;
            $addOrder->its_add_order_bran_id = $bran;
            $addOrder->its_add_order_cus_id = $request->customer;
            $addOrder->its_add_order_measure_id = $order_info->its_add_order_measure_id;
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

        return redirect()->back();
    }
    function updatePantMeasure(Request $request)
    {
        Session::put('oldPantMeasuermentDelete', 'delete');

        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;

        $submit_at = Carbon::now()->format('Y-m-d H:i:s');
        $submit_by = Auth::user()->its_slno;
        $submit = Carbon::now()->format('Y-m-d');

        $order_info = IglTailorAddOrder::select('its_add_order_slno','its_add_order_measure_id')
                                        ->where('its_add_order_slno', $request->pant_measure_order_slno)
                                        ->first();

        $pant_info  = IglTailorMsrPant::select('its_pant_measure_slno')
                                        ->where('its_pant_measure_slno', $order_info->its_add_order_measure_id)
                                        ->first();

        IglTailorMsrPant::where('its_pant_measure_slno',$pant_info->its_pant_measure_slno)->update([
            'its_pant_measure_long' => $request->long,
            'its_pant_measure_komor' => $request->komor,
            'its_pant_measure_hip' => $request->hip,
            'its_pant_measure_mohuri' => $request->muhuri,
            'its_pant_measure_thigh' => $request->thigh,
            'its_pant_measure_high' => $request->high,
            'its_pant_measure_fly' => $request->fly,
            'its_pant_measure_kuci' => $request->kuci,
            'its_pant_measure_pocket_type' => $request->pocket,
            'its_pant_measure_pocket_backside' => $request->back_pocket,
            'its_pant_measure_pocket_inner' => $request->inner_pocket,
            'its_pant_measure_muhuri_type' => $request->mohuri_type,
            'its_pant_measure_loop' => $request->loop,
            'its_pant_measure_loop_size' => $request->loop_size,
            'its_pant_measure_catalog_no' => $request->catalog,
            'its_pant_measure_others' => $request->others,
            'its_pant_measure_submit_at' => $submit_at,
            'its_pant_measure_submit_by' => $submit_by,
        ]);

        // Temporary Id Catch
        $its_add_temp_id = IglTailorTemporary::where('its_temp_pname','pant')->first();

        if(!IglTailorAddOrder::where('its_add_order_bran_id',$bran)->where('its_add_order_order_id',$request->order_id)->where('its_add_product_name',$request->p_name)->exists())
        {
            $addOrder = new IglTailorAddOrder();
            $addOrder->its_add_order_com_id = $com;
            $addOrder->its_add_order_bran_id = $bran;
            $addOrder->its_add_order_cus_id = $request->customer;
            $addOrder->its_add_order_measure_id = $order_info->its_add_order_measure_id;
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

        return redirect()->back();
    }
    function updateBlazerMeasure(Request $request)
    {   
        Session::put('oldBlazerMeasuermentDelete', 'delete');

        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;

        $submit_at = Carbon::now()->format('Y-m-d H:i:s');
        $submit_by = Auth::user()->its_slno;
        $submit = Carbon::now()->format('Y-m-d');

        $order_info = IglTailorAddOrder::select('its_add_order_slno','its_add_order_measure_id')
                                        ->where('its_add_order_slno', $request->blazer_measure_order_slno)
                                        ->first();

        $blazer_info  = IglTailorMsrBlazer::select('its_blazer_measure_slno')
                                        ->where('its_blazer_measure_slno', $order_info->its_add_order_measure_id)
                                        ->first();

        IglTailorMsrBlazer::where('its_blazer_measure_slno',$blazer_info->its_blazer_measure_slno)->update([
            'its_blazer_measure_long' => $request->long,
            'its_blazer_measure_body' => $request->body,
            'its_blazer_measure_belly' => $request->belly,
            'its_blazer_measure_hip' => $request->hip,
            'its_blazer_measure_shoulder' => $request->shoulder,
            'its_blazer_measure_hand_long' => $request->hand_long,
            'its_blazer_measure_hand_muhuri' => $request->hand_muhuri,
            'its_blazer_measure_cross_back' => $request->cross_back,
            'its_blazer_measure_button_num' => $request->button,
            'its_blazer_measure_nepel' => $request->nepel,
            'its_blazer_measure_side' => $request->open,
            'its_blazer_measure_catalog_no' => $request->catalog,
            'its_blazer_measure_others' => $request->others,
            'its_blazer_measure_best' => $request->best,
            'its_blazer_measure_under' => $request->bottom,
            'its_blazer_measure_submit_by' => $submit_by,
            'its_blazer_measure_submit_at' => $submit_at,
        ]);

        // Temporary Id Catch
        $its_add_temp_id = IglTailorTemporary::where('its_temp_pname','blazer')->first();

        if(!IglTailorAddOrder::where('its_add_order_bran_id',$bran)->where('its_add_order_order_id',$request->order_id)->where('its_add_product_name',$request->p_name)->exists())
        {
            $addOrder = new IglTailorAddOrder();
            $addOrder->its_add_order_com_id = $com;
            $addOrder->its_add_order_bran_id = $bran;
            $addOrder->its_add_order_cus_id = $request->customer;
            $addOrder->its_add_order_measure_id = $order_info->its_add_order_measure_id;
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

        return redirect()->back();
    }
    function updatePanjabiMeasure(Request $request)
    {
        Session::put('oldPanjabiMeasuermentDelete', 'delete');

        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;

        $submit_at = Carbon::now()->format('Y-m-d H:i:s');
        $submit_by = Auth::user()->its_slno;
        $submit = Carbon::now()->format('Y-m-d');

        $order_info = IglTailorAddOrder::select('its_add_order_slno','its_add_order_measure_id')
                                        ->where('its_add_order_slno', $request->panjabi_measure_order_slno)
                                        ->first();

        $panjabi_info = IglTailorMsrPanjabi::select('its_panjabi_msr_slno')
                                            ->where('its_panjabi_msr_slno', $order_info->its_add_order_measure_id)
                                            ->first();

        IglTailorMsrPanjabi::where('its_panjabi_msr_slno',$panjabi_info->its_panjabi_msr_slno)->update([
            'its_panjabi_msr_long' => $request->long,
            'its_panjabi_msr_body' => $request->body,
            'its_panjabi_msr_body_loose' => $request->body_loose,
            'its_panjabi_msr_belly' => $request->belly,
            'its_panjabi_msr_belly_loose' => $request->belly_loose,
            'its_panjabi_msr_hip' => $request->hip,
            'its_panjabi_msr_hip_loose' => $request->hip_loose,
            'its_panjabi_msr_shoulder' => $request->shoulder,
            'its_panjabi_msr_neck' => $request->neck,
            'its_panjabi_msr_hand_long' => $request->hand_long,
            'its_panjabi_msr_muhuri' => $request->muhuri,
            'its_panjabi_msr_plet' => $request->plet,
            'its_panjabi_msr_collar_type' => $request->collar_type,
            'its_panjabi_msr_collar_size' => $request->collar_size,
            'its_panjabi_msr_pocket' => $request->pocket,
            'its_panjabi_msr_inner_pocket' => $request->inner_pocket,
            'its_panjabi_msr_catalog_no' => $request->catalog,
            'its_panjabi_msr_others' => $request->others,
            'its_panjabi_msr_submit_by' => $submit_by,
            'its_panjabi_msr_submit_at' => $submit_at,
        ]);

        // Temporary Id Catch
        $its_add_temp_id = IglTailorTemporary::where('its_temp_pname','panjabi')->first();
        
        if(!IglTailorAddOrder::where('its_add_order_bran_id',$bran)->where('its_add_order_order_id',$request->order_id)->where('its_add_product_name',$request->p_name)->exists())
        {
            $addOrder = new IglTailorAddOrder();
            $addOrder->its_add_order_com_id = $com;
            $addOrder->its_add_order_bran_id = $bran;
            $addOrder->its_add_order_cus_id = $request->customer;
            $addOrder->its_add_order_measure_id = $order_info->its_add_order_measure_id;
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
             
        return redirect()->back();
    }
    function updatePayjamaMeasure(Request $request)
    {   
        Session::put('oldPayjamaMeasuermentDelete', 'delete');

        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;

        $submit_at = Carbon::now()->format('Y-m-d H:i:s');
        $submit_by = Auth::user()->its_slno;
        $submit = Carbon::now()->format('Y-m-d');

        $order_info = IglTailorAddOrder::select('its_add_order_slno','its_add_order_measure_id')
                                        ->where('its_add_order_slno', $request->payjama_measure_order_slno)
                                        ->first();

        $payjama_info = IglTailorMsrPayjama::select('its_payjama_measure_slno')
                                        ->where('its_payjama_measure_slno', $order_info->its_add_order_measure_id)
                                        ->first();

        IglTailorMsrPayjama::where('its_payjama_measure_slno',$payjama_info->its_payjama_measure_slno)->update([
            'its_payjama_measure_long' => $request->long,
            'its_payjama_measure_komor' => $request->komor,
            'its_payjama_measure_hip' => $request->hip,
            'its_payjama_measure_hip_loose' => $request->hip_loose,
            'its_payjama_measure_muhuri' => $request->muhuri,
            'its_payjama_measure_thigh' => $request->thigh,
            'its_payjama_measure_fly' => $request->fly,
            'its_payjama_measure_high' => $request->high,
            'its_payjama_measure_pocket' => $request->pocket,
            'its_payjama_measure_catalog_no' => $request->catalog,
            'its_payjama_measure_others' => $request->others,
            'its_payjama_measure_submit_by' => $submit_by,
            'its_payjama_measure_submit_at' => $submit_at,
        ]);

         // Temporary Id Catch
        $its_add_temp_id = IglTailorTemporary::where('its_temp_pname','payjama')->first();

        if(!IglTailorAddOrder::where('its_add_order_bran_id',$bran)->where('its_add_order_order_id',$request->order_id)->where('its_add_product_name',$request->p_name)->exists())
        {
            $addOrder = new IglTailorAddOrder();
            $addOrder->its_add_order_com_id = $com;
            $addOrder->its_add_order_bran_id = $bran;
            $addOrder->its_add_order_cus_id = $request->customer;
            $addOrder->its_add_order_measure_id = $order_info->its_add_order_measure_id;
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

        return redirect('branch/measure/take-measure');
    }
    function updateSafariMeasure(Request $request)
    {
        Session::put('oldSafariMeasuermentDelete', 'delete');

        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;

        $submit_at = Carbon::now()->format('Y-m-d H:i:s');
        $submit_by = Auth::user()->its_slno;
        $submit = Carbon::now()->format('Y-m-d');
	
        $order_info = IglTailorAddOrder::select('its_add_order_slno','its_add_order_measure_id')
                                        ->where('its_add_order_slno', $request->safari_measure_order_slno)
                                        ->first();

        $safari_info = IglTailorMsrSafari::select('its_safari_measure_slno')
                                        ->where('its_safari_measure_slno', $order_info->its_add_order_measure_id)
                                        ->first();

        IglTailorMsrSafari::where('its_safari_measure_slno',$safari_info->its_safari_measure_slno)->update([
            'its_safari_measure_long' => $request->long,
            'its_safari_measure_body' => $request->body,
            'its_safari_measure_body_loose' => $request->body_loose,
            'its_safari_measure_belly' => $request->belly,
            'its_safari_measure_belly_loose' => $request->belly_loose,
            'its_safari_measure_hip' => $request->hip,
            'its_safari_measure_hip_loose' => $request->hip_loose,
            'its_safari_measure_shoulder' => $request->shoulder,
            'its_safari_measure_cross_back' => $request->cross_back,
            'its_safari_measure_neck' => $request->neck,
            'its_safari_measure_hand_long' => $request->hand_long,
            'its_safari_measure_hand_cuff' => $request->cuff,
            'its_safari_measure_plet' => $request->plet,
            'its_safari_measure_collar' => $request->collar,
            'its_safari_measure_collar_size' => $request->collar_size,
            'its_safari_measure_pocket' => $request->pocket,
            'its_safari_measure_back_side' => $request->back_side,
            'its_safari_measure_inner_pocket' => $request->inner_pocket,
            'its_safari_measure_type' => $request->type,
            'its_safari_measure_catalog_no' => $request->catalog,
            'its_safari_measure_others' => $request->others,
            'its_safari_measure_submit_by' => $submit_by,
            'its_safari_measure_submit_at' => $submit_at,
        ]);

        // Temporary Id Catch
        $its_add_temp_id = IglTailorTemporary::where('its_temp_pname','safari')->first();

        if(!IglTailorAddOrder::where('its_add_order_bran_id',$bran)->where('its_add_order_order_id',$request->order_id)->where('its_add_product_name',$request->p_name)->exists())
        {
            $addOrder = new IglTailorAddOrder();
            $addOrder->its_add_order_com_id = $com;
            $addOrder->its_add_order_bran_id = $bran;
            $addOrder->its_add_order_cus_id = $request->customer;
            $addOrder->its_add_order_measure_id = $order_info->its_add_order_measure_id;
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

        return redirect()->back();
    }
    function updatePhotuaMeasure(Request $request)
    {
        Session::put('oldPhotuaMeasuermentDelete', 'delete');

        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;

        $submit_at = Carbon::now()->format('Y-m-d H:i:s');
        $submit_by = Auth::user()->its_slno;
        $submit = Carbon::now()->format('Y-m-d');

        $order_info = IglTailorAddOrder::select('its_add_order_slno','its_add_order_measure_id')
                                        ->where('its_add_order_slno', $request->photua_measure_order_slno)
                                        ->first();

        $photua_info = IglTailorMsrPhotua::select('its_photua_measure_slno')
                                            ->where('its_photua_measure_slno', $order_info->its_add_order_measure_id)
                                            ->first();

        IglTailorMsrPhotua::where('its_photua_measure_slno',$photua_info->its_photua_measure_slno)->update([
            'its_photua_measure_long' => $request->long,
            'its_photua_measure_body' => $request->body,
            'its_photua_measure_body_loose' => $request->body_loose,
            'its_photua_measure_belly' => $request->belly,
            'its_photua_measure_hip' => $request->hip,
            'its_photua_measure_shoulder' => $request->shoulder,
            'its_photua_measure_neck' => $request->neck,
            'its_photua_measure_hand_long' => $request->hand_long,
            'its_photua_measure_hand_moja' => $request->hand_moja,
            'its_photua_measure_hand_kunu' => $request->hand_kunu,
            'its_photua_measure_hand_cuff' => $request->hand_cuff,
            'its_photua_measure_types' => $request->type,
            'its_photua_measure_plet' => $request->plet,
            'its_photua_measure_collar' => $request->collar,
            'its_photua_measure_collar_size' => $request->collar_size,
            'its_photua_measure_cuff_size' => $request->cuff_size,
            'its_photua_measure_pocket' => $request->pocket,
            'its_photua_measure_pocket_inner' => $request->inner_pocket,
            'its_photua_measure_open' => $request->open,
            'its_photua_measure_catalog_no' => $request->catalog,
            'its_photua_measure_others' => $request->others,
            'its_photua_measure_submit_at' => $submit_at,
            'its_photua_measure_submit_by' => $submit_by,
        ]);

        // Temporary Id Catch
        $its_add_temp_id = IglTailorTemporary::where('its_temp_pname','photua')->first();
        
        if(!IglTailorAddOrder::where('its_add_order_bran_id',$bran)->where('its_add_order_order_id',$request->order_id)->where('its_add_product_name',$request->p_name)->exists())
        {
            $addOrder = new IglTailorAddOrder();
            $addOrder->its_add_order_com_id = $com;
            $addOrder->its_add_order_bran_id = $bran;
            $addOrder->its_add_order_cus_id = $request->customer;
            $addOrder->its_add_order_measure_id = $order_info->its_add_order_measure_id;
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

        return redirect()->back();
    }
    function updateMojibcortMeasure(Request $request)
    {
        Session::put('oldMojibCortMeasuermentDelete', 'delete');
        
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;

        $submit_at = Carbon::now()->format('Y-m-d H:i:s');
        $submit_by = Auth::user()->its_slno;
        $submit = Carbon::now()->format('Y-m-d');

        $order_info = IglTailorAddOrder::select('its_add_order_slno','its_add_order_measure_id')
                                        ->where('its_add_order_slno', $request->mojib_cort_measure_order_slno)
                                        ->first();

        $mojibcort_info = IglTailorMsrMojibCort::select('its_mojibcort_measure_slno')
                                                ->where('its_mojibcort_measure_slno', $order_info->its_add_order_measure_id)
                                                ->first();

        IglTailorMsrMojibCort::where('its_mojibcort_measure_slno',$mojibcort_info->its_mojibcort_measure_slno)->update([
            'its_mojibcort_measure_long' => $request->long,
            'its_mojibcort_measure_body' => $request->body,
            'its_mojibcort_measure_body_loose' => $request->body_loose,
            'its_mojibcort_measure_belly' => $request->belly,
            'its_mojibcort_measure_belly_loose' => $request->belly_loose,
            'its_mojibcort_measure_hip' => $request->hip,
            'its_mojibcort_measure_hip_loose' => $request->hip_loose,
            'its_mojibcort_measure_shoulder' => $request->shoulder,
            'its_mojibcort_measure_neck' => $request->neck,
            'its_mojibcort_measure_collar' => $request->collar,
            'its_mojibcort_measure_pocket' => $request->pocket,
            'its_mojibcort_measure_inner_pocket' => $request->inner_pocket,
            'its_mojibcort_measure_open' => $request->open,
            'its_mojibcort_measure_catalog_no' => $request->catalog,
            'its_mojibcort_measure_others' => $request->others,
            'its_mojibcort_measure_submit_at' => $submit_at,
            'its_mojibcort_measure_submit_by' => $submit_by,
        ]);

        // Temporary Id Catch
        $its_add_temp_id = IglTailorTemporary::where('its_temp_pname','mojib_cort')->first();

        if(!IglTailorAddOrder::where('its_add_order_bran_id',$bran)->where('its_add_order_order_id',$request->order_id)->where('its_add_product_name',$request->p_name)->exists())
        {
            $addOrder = new IglTailorAddOrder();
            $addOrder->its_add_order_com_id = $com;
            $addOrder->its_add_order_bran_id = $bran;
            $addOrder->its_add_order_cus_id = $request->customer;
            $addOrder->its_add_order_measure_id = $order_info->its_add_order_measure_id;
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

        return redirect()->back();
    }
    function updateKableMeasure(Request $request)
    {
        Session::put('oldKableMeasuermentDelete', 'delete');

        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;

        $submit_at = Carbon::now()->format('Y-m-d H:i:s');
        $submit_by = Auth::user()->its_slno;
        $submit = Carbon::now()->format('Y-m-d');

        $order_info = IglTailorAddOrder::select('its_add_order_slno','its_add_order_measure_id')
                                        ->where('its_add_order_slno', $request->kable_measure_order_slno)
                                        ->first();

        $mojibcort_info = IglTailorMsrKable::select('its_kable_measure_slno')
                                            ->where('its_kable_measure_slno', $order_info->its_add_order_measure_id)
                                            ->first();

        IglTailorMsrKable::where('its_kable_measure_slno',$mojibcort_info->its_kable_measure_slno)->update([
            'its_kable_measure_long' => $request->long,
            'its_kable_measure_body' => $request->body,
            'its_kable_measure_body_loose' => $request->body_loose,
            'its_kable_measure_belly' => $request->belly,
            'its_kable_measure_belly_loose' => $request->bally_loose,
            'its_kable_measure_hip' => $request->hip,
            'its_kable_measure_hip_loose' => $request->hip_loose,
            'its_kable_measure_shoulder' => $request->shoulder,
            'its_kable_measure_neck' => $request->neck,
            'its_kable_measure_hand_long' => $request->hand_long,
            'its_kable_measure_plet' => $request->plate,
            'its_kable_measure_muhuri' => $request->muhuri,
            'its_kable_measure_collar_type' => $request->collar_type,
            'its_kable_measure_collar_size' => $request->collar,
            'its_kable_measure_pocket' => $request->pocket,
            'its_kable_measure_catalog_no' => $request->catalog,
            'its_kable_measure_others' => $request->others,
            'its_kable_measure_submit_at' => $submit_at,
            'its_kable_measure_submit_by' => $submit_by,
        ]);

        // Temporary Id Catch
        $its_add_temp_id = IglTailorTemporary::where('its_temp_pname','kable')->first();

        if(!IglTailorAddOrder::where('its_add_order_bran_id',$bran)->where('its_add_order_order_id',$request->order_id)->where('its_add_product_name',$request->p_name)->exists())
        {
            $addOrder = new IglTailorAddOrder();
            $addOrder->its_add_order_com_id = $com;
            $addOrder->its_add_order_bran_id = $bran;
            $addOrder->its_add_order_cus_id = $request->customer;
            $addOrder->its_add_order_measure_id = $order_info->its_add_order_measure_id;
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

        return redirect()->back();
    }
    function updateKotiMeasure(Request $request)
    {
        Session::put('oldKotiMeasuermentDelete', 'delete');

        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;

        $submit_at = Carbon::now()->format('Y-m-d H:i:s');
        $submit_by = Auth::user()->its_slno;
        $submit = Carbon::now()->format('Y-m-d');

        $order_info = IglTailorAddOrder::select('its_add_order_slno','its_add_order_measure_id')
                                        ->where('its_add_order_slno', $request->koti_measure_order_slno)
                                        ->first();

        $koti_info = IglTailorMsrKoti::select('its_koti_measure_slno')
                                        ->where('its_koti_measure_slno', $order_info->its_add_order_measure_id)
                                        ->first();

        IglTailorMsrKoti::where('its_koti_measure_slno',$koti_info->its_koti_measure_slno)->update([
            'its_koti_measure_long' => $request->long,
            'its_koti_measure_body' => $request->body,
            'its_koti_measure_body_loose' => $request->body_loose,
            'its_koti_measure_belly' => $request->belly,
            'its_koti_measure_belly_loose' => $request->belly_loose,
            'its_koti_measure_hip' => $request->hip,
            'its_koti_measure_hip_loose' => $request->hip_loose,
            'its_koti_measure_shoulder' => $request->shoulder,
            'its_koti_measure_pocket' => $request->pocket,
            'its_koti_measure_belt' => $request->belt,
            'its_koti_measure_catalog_no' => $request->catalog,
            'its_koti_measure_others' => $request->others,
            'its_koti_measure_submit_at' => $submit_at,
            'its_koti_measure_submit_by' => $submit_by,
        ]);

        // Temporary Id Catch
        $its_add_temp_id = IglTailorTemporary::where('its_temp_pname','koti')->first();

        if(!IglTailorAddOrder::where('its_add_order_bran_id',$bran)->where('its_add_order_order_id',$request->order_id)->where('its_add_product_name',$request->p_name)->exists())
        {
            $addOrder = new IglTailorAddOrder();
            $addOrder->its_add_order_com_id = $com;
            $addOrder->its_add_order_bran_id = $bran;
            $addOrder->its_add_order_cus_id = $request->customer;
            $addOrder->its_add_order_measure_id = $order_info->its_add_order_measure_id;
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

        return redirect()->back();
    }

}
