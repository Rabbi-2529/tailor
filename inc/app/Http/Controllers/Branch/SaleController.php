<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IglTailorInvProduct;
use App\Models\IglTailorCustomer;
use App\Models\IglTailorTemporaryProductSale;
use App\Models\IglTailorInventoryDetails;
use App\Models\IglTailorInvProductGroup;
use App\Models\IglTailorOrderStatusCheck;
use App\Models\IglTailorBranch;
use App\Models\IglTailorAccount;
use Carbon\Carbon;
use Auth;
use Session;

class SaleController extends Controller
{
    public function saleProduct()
    {
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $submit_by = Auth::user()->its_slno;

        $products = IglTailorInvProduct::with('productGrouppro','productTypepro')
                                       ->where('its_inv_pro_com_id',$com)
                                       ->where('its_inv_pro_bran_id',$bran)
                                       ->get();

        $customers = IglTailorCustomer::where('its_cus_com_id',$com)
                                      ->orderBy('its_cus_name')
                                      ->get();    

        $pro_groups = IglTailorInvProductGroup::where('its_inv_progrp_com_id',$com)
                                              ->where('its_inv_progrp_bran_id',$bran)
                                              ->orderBy('its_inv_progrp_name')
                                              ->get();    

        
        return view('branch.sale.product_sale',compact('products','customers','pro_groups'));
    }
    public function typeName(Request $request)
    {
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;

        $pro_types = IglTailorInvProduct::with('productTypepro')->where('its_inv_pro_com_id',$com)
                                        ->where('its_inv_pro_bran_id',$bran)
                                        ->where('its_inv_pro_group',$request->group_id)
                                        ->groupBy('its_inv_pro_type')
                                        ->get(); 

        return view('branch.sale.ajax.product_type_ajax',compact('pro_types'));
    }
    public function productSearch(Request $request)
    {
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;

        $products = IglTailorInvProduct::with('productGrouppro','productTypepro')
                                       ->where('its_inv_pro_com_id',$com)
                                       ->where('its_inv_pro_bran_id',$bran)
                                       ->where('its_inv_pro_group',$request->pro_group_id)
                                       ->where('its_inv_pro_type',$request->pro_type_id)
                                       ->get();

        return view('branch.sale.ajax.product_search_ajax',compact('products'));
    }
    public function addToCart(Request $request)
    {
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;

        $submit_at = Carbon::now()->format('Y-m-d H:i:s');
        $submit_by = Auth::user()->its_slno;

        $total_qty_price = $request->quantity * $request->price;

       // Order Information Insert of Temporary Table
        if(
            IglTailorTemporaryProductSale::where('its_com_id',$com)
                                          ->where('its_bran_id',$bran)
                                          ->where('its_product_id',$request->product_id)
                                          ->where('its_submit_by',$submit_by)
                                          ->where('status',2)
                                          ->exists()
        )
        {
            IglTailorTemporaryProductSale::where('its_com_id',$com)->where('its_bran_id',$bran)->where('its_product_id',$request->product_id)
                                         ->where('its_submit_by',$submit_by)
                                         ->where('status',2)
                                         ->update([
                                             'its_qty'         => $request->quantity,
                                             'its_total_price' => $total_qty_price,
                                          ]);
        }
        else{
            $cartTemporary                  =  new IglTailorTemporaryProductSale();
            $cartTemporary->its_com_id      =  $com;
            $cartTemporary->its_bran_id     =  $bran;
            $cartTemporary->its_product_id  =  $request->product_id;
            $cartTemporary->its_price       =  $request->price;
            $cartTemporary->its_qty         =  $request->quantity;
            $cartTemporary->its_total_price =  $total_qty_price;
            $cartTemporary->status          =   2;
            $cartTemporary->its_submit_by   =  $submit_by;
            $cartTemporary->its_submit_at   =  $submit_at;
            $cartTemporary->save();
        }

       return response()->json('success');
    }
    public function getCartContent()
    {   
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $submit_by = Auth::user()->its_slno;

        $product_sales = IglTailorTemporaryProductSale::with('product')->where('its_com_id',$com)
                                                       ->where('its_bran_id',$bran)
                                                       ->where('status',2)
                                                       ->where('its_submit_by',$submit_by)
                                                       ->get();

        return view('branch.sale.ajax.add_to_cart_ajax',compact('product_sales'));
    }
    public function getCartDelete($temp_id)
    {   
        $carDelete = IglTailorTemporaryProductSale::where('its_tem_pro_sale_slno',$temp_id)->delete();

        return redirect()->back();
    }
    public function saleProductInvoice(Request $request)
    {   
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $submit_by = Auth::user()->its_slno;

         $message = ([
            'customer_id.required' => "Select Customer Name",
        ]);

        $request->validate([
            'customer_id' => 'required',
        ],$message);

        $invoice_static_value = "445".$com.$bran."0000";
          
        $invoice_check = IglTailorInventoryDetails::where('its_inv_det_com_id',$com)
                                                   ->where('its_inv_det_bran_id',$bran)
                                                   ->where('its_inv_det_deal_type',4)
                                                   ->count();
        if($invoice_check == 0)
        {
            $invoice_initial = $invoice_static_value.$invoice_check + 1;

            if (
                IglTailorTemporaryProductSale::where('its_com_id',$com)->where('its_bran_id',$bran)->where('its_sale_invoice_no',$invoice_initial)
                                             ->where('status',2)->where('its_submit_by','!=',$submit_by)->exists()
            ) 

            {
                $invoice_check =  IglTailorTemporaryProductSale::where('its_com_id',$com)->where('its_bran_id',$bran)->where('its_sale_invoice_no',$invoice_initial)
                                                               ->where('status',2)->where('its_submit_by', '!=',$submit_by)->max('its_sale_invoice_no');
                                                            
                // Static Value String Length
                $count_invoice_value = strlen($invoice_static_value);
                // Current Invoice Value
                $current_invoice = substr($invoice_check,$count_invoice_value);
                // Invoice Value Increment
                $invoice = $invoice_static_value.$current_invoice + 1;
            
            }
            else{
                $invoice = $invoice_static_value.$invoice_check + 1;
            }

        }
        else{
            if(
                IglTailorTemporaryProductSale::where('its_com_id',$com)->where('its_bran_id',$bran)->where('status',2)->where('its_submit_by','!=',$submit_by)->exists()
            )
            {
                $invoice_check =  IglTailorTemporaryProductSale::where('its_com_id',$com)->where('its_bran_id',$bran)->where('status',2)
                                                               ->where('its_submit_by', '!=',$submit_by)->max('its_sale_invoice_no');
                // Static Value String Length
                $count_invoice_value = strlen($invoice_static_value);
                // Current Invoice Value
                $current_invoice = substr($invoice_check,$count_invoice_value);
                // Invoice Value Increment
                $invoice = $invoice_static_value.$current_invoice + 1 ;
            }
            else{
                    // Inventory Details Table 
                    $invoice_check = IglTailorInventoryDetails::where('its_inv_det_com_id',$com)->where('its_inv_det_bran_id',$bran)->where('its_inv_det_deal_type',4)
                                                              ->max('its_inv_det_invoice_id');
                    // Static Value String Length
                    $count_invoice_value = strlen($invoice_static_value);
                    // Current Invoice Value
                    $current_invoice = substr($invoice_check,$count_invoice_value);
                    // Invoice Value Increment
                     $invoice = $invoice_static_value.$current_invoice + 1 ;
                } 
        }

    
        
        // Session Data Insert
        Session::put('sale_invoice_no',$invoice);
        Session::put('sale_customer_id',$request->customer_id);

        if($request->group_id && $request->type_id){
            // Session Data Insert
            Session::put('sale_group_id',$request->group_id);
            Session::put('sale_type_id',$request->type_id);
        }

       
        $discount = $request->discount;
        $total_amount = $request->total_amount;


        if(IglTailorTemporaryProductSale::where('its_com_id',$com)->where('its_bran_id',$bran)->where('its_submit_by',$submit_by)->where('status',2)->exists())
        {
            IglTailorTemporaryProductSale::where('its_com_id',$com)->where('its_bran_id',$bran)->where('its_submit_by',$submit_by)->where('status',2)->update([
                'its_sale_invoice_no' => $invoice,
                'its_supplier_id' => $request->customer_id,
            ]);
        }

        $temp_pro_sales = IglTailorTemporaryProductSale::where('its_com_id',$com)
                                                       ->where('its_bran_id',$bran)
                                                       ->where('its_submit_by',$submit_by)
                                                       ->where('status',2)
                                                       ->get();

        $customer_info = IglTailorCustomer::where('its_cus_slno',$request->customer_id)->first();

        return view('branch.sale.product_sale_invoice',compact('temp_pro_sales','customer_info','discount','total_amount'));
    }
    public function saleProductInvoiceInsert(Request $request)
    {   
        // Session Sale Discount Forget
        Session::forget('sale_product_discount');

        $bran = Auth::user()->BranchDetailsUser->its_branch_id;
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $submit_by = Auth::user()->its_slno;

        $bran = Auth::user()->BranchDetailsUser->its_branch_id;
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $submit_by = Auth::user()->its_slno;
        $submit_at = Carbon::now()->format('Y-m-d H:i:s');
        $entry = Carbon::now()->format('Y-m-d');

        $invoice_no = $request->invoice_no;
        $customer_id = $request->customer_id;
        $total_amount = $request->total_amount;
        $discount = $request->discount;

        if($discount > 0){
            $total_amount = $request->total_amount + $discount;
        }
        // Amount Insert from Account Table
        $account                   = new IglTailorAccount();
        $account->acc_com_id       = $com;
        $account->acc_bran_id      = $bran;
        $account->acc_ord_id       = $invoice_no;
        $account->acc_customer_id  = $customer_id;
        $account->acc_credit       = '';
        $account->acc_debit        = $total_amount;
        $account->acc_pay_date     = Carbon::now()->format('Y-m-d');
        $account->acc_description  = 'Customer Buy For Product';
        $account->acc_status       = 1;
        $account->save();

        if($request->discount > 0){
            // Session Sale Discount Put
            Session::put('sale_product_discount', $discount);
            // Discount Insert from Account Table
            $account = new IglTailorAccount();
            $account->acc_com_id      = $com;
            $account->acc_bran_id     = $bran;
            $account->acc_ord_id      = $invoice_no;
            $account->acc_customer_id = $customer_id;
            $account->acc_credit      = $discount;
            $account->acc_debit       = 0;
            $account->acc_pay_date    = Carbon::now()->format('Y-m-d');
            $account->acc_description = 'Customer Discount';
            $account->acc_status      = 3;
            $account->save();
        }

        // Temporay Table Data Catch
        $temp_sales = IglTailorTemporaryProductSale::where('its_com_id',$com)
                                                ->where('its_bran_id',$bran)
                                                ->where('status',2)
                                                ->where('its_submit_by',$submit_by)
                                                ->get();

        foreach($temp_sales as $temp_sale)
        {
            Session::put('sale_invoice_customer_id',$temp_sale->its_supplier_id);
            // Proudct Information Insert from Inventory Details Table
            $productBuy = new IglTailorInventoryDetails();
            $productBuy->its_inv_det_com_id       = $com;
            $productBuy->its_inv_det_bran_id      = $bran;
            $productBuy->its_inv_det_party_id     = $customer_id;
            $productBuy->its_inv_det_pro_id       = $temp_sale->its_product_id;
            $productBuy->its_inv_det_invoice_id   = $invoice_no;
            $productBuy->its_inv_det_sell_qty     = $temp_sale->its_qty;
            $productBuy->its_inv_det_sell_price   = $temp_sale->its_price;
            $productBuy->its_inv_det_deal_type    = 4;
            $productBuy->its_inv_det_entry_date   = $entry;
            $productBuy->its_inv_det_submit_by    = $submit_by;
            $productBuy->its_inv_det_submit_at    = $submit_at;
            $productBuy->save();
       
            IglTailorTemporaryProductSale::where('its_tem_pro_sale_slno',$temp_sale->its_tem_pro_sale_slno)->delete();
        } 
        // Session Data Delete
        Session::forget('sale_customer_id');
        
        return response()->json('success');
    }
    public function saleInvoiceGenerate($invoice_no)
    {   
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $submit_by = Auth::user()->its_slno;

        $invoice_no =  base64_decode($invoice_no);

        $branch_information = IglTailorBranch::where('its_branch_login_id',Auth::user()->its_slno)->first();
        $login_information = Auth::user();

        // Sale Single Information
        $single_sale_info = IglTailorInventoryDetails::with('customer')->where('its_inv_det_com_id',$com)
                                                      ->where('its_inv_det_bran_id',$bran)
                                                      ->where('its_inv_det_invoice_id',$invoice_no)
                                                      ->where('its_inv_det_party_id',Session::get('sale_invoice_customer_id'))
                                                      ->where('its_inv_det_submit_by',$submit_by)
                                                      ->first();
        // Sale  Information
        $sale_product_info = IglTailorInventoryDetails::with('productDetails')->where('its_inv_det_com_id',$com)
                                                      ->where('its_inv_det_bran_id',$bran)
                                                      ->where('its_inv_det_invoice_id',$invoice_no)
                                                      ->where('its_inv_det_party_id',Session::get('sale_invoice_customer_id'))
                                                      ->where('its_inv_det_submit_by',$submit_by)
                                                      ->get();

        // Customer Total Due Calculation
        $total_debit_amount = IglTailorAccount::where('acc_bran_id',$bran)
                                               ->where('acc_customer_id',Session::get('sale_invoice_customer_id'))
                                               ->where('acc_status',1)
                                               ->sum('acc_debit');

        $total_credit_amount = IglTailorAccount::where('acc_bran_id',$bran)
                                                ->where('acc_customer_id',Session::get('sale_invoice_customer_id'))
                                                ->whereIn('acc_status',[2,3])
                                                ->sum('acc_credit');

        $total_due = $total_debit_amount - $total_credit_amount;

        if(Session::has('sale_group_id') || Session::has('sale_type_id')){
            // Session Data Delete
            Session::forget('sale_group_id');
            Session::forget('sale_type_id');
        }


        return view('branch.sale.finish_order_print',compact('branch_information','login_information','single_sale_info','sale_product_info','total_due'));
    }
    public function saleProductInvoiceClose()
    {   
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $submit_by = Auth::user()->its_slno;

        // Temporay Table Data Catch
        $temp_sales = IglTailorTemporaryProductSale::where('its_com_id',$com)
                                                ->where('its_bran_id',$bran)
                                                ->where('status',2)
                                                ->where('its_submit_by',$submit_by)
                                                ->get();
        foreach($temp_sales as $temp_sale)
        {
            IglTailorTemporaryProductSale::where('its_tem_pro_sale_slno',$temp_sale->its_tem_pro_sale_slno)->delete();
        } 
        // Invoice No Delete
        IglTailorOrderStatusCheck::where('its_com_id',$com)->where('its_bran_id',$bran)->where('its_sale_invoice_no',Session::get('sale_invoice_no'))
                                 ->where('its_submit_by',$submit_by)
                                 ->delete();

        // Session Data Delete
        Session::forget('sale_invoice_no');
        Session::forget('sale_customer_id');

        if(Session::has('sale_group_id') || Session::has('sale_type_id')){
            // Session Data Delete
            Session::forget('sale_group_id');
            Session::forget('sale_type_id');
        }
    }
}
