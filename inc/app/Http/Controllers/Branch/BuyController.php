<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IglTailorSupplier;
use App\Models\IglTailorInvProductName;
use App\Models\IglTailorInvProduct;
use App\Models\IglTailorInventoryDetails;
use App\Models\IglTailorTemporaryProductSale;
use App\Models\IglTailorAccount;
use App\Models\IglTailorBranch;
use Carbon\Carbon;
use Session;
use Auth;

class BuyController extends Controller
{
    public function productBuy()
    {   
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;
        $current_date = Carbon::now()->format('Y-m-d');

        $suppliers = IglTailorSupplier::where('its_sup_com_id',$com)
                                      ->where('its_sup_bran_id',$bran)
                                      ->orderBy('its_sup_slno','desc')
                                      ->get();  

        $product_lists = IglTailorInvProduct::with('productNamepro','productGrouppro','productTypepro')
                                            ->where('its_inv_pro_com_id',$com)
                                            ->where('its_inv_pro_bran_id',$bran)
                                            ->get();                                                         

        return view('branch.buy.buy_product',compact('suppliers','current_date','product_lists'));
    }
   
    public function supplierProductShow(Request $request)
    {
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;
        Session::put('supplier_id',$request->supplier_id);

        $supplier_info = IglTailorSupplier::where('its_sup_slno',$request->supplier_id)->first();

        if($supplier_info->its_sup_status == 2){
            $product_lists = IglTailorInvProduct::with('productNamepro','productGrouppro','productTypepro')
                                            ->where('its_inv_pro_com_id',$com)
                                            ->where('its_inv_pro_bran_id',$bran)
                                            ->where('its_inv_pro_sup_id',$request->supplier_id)
                                            ->get();
        }
        else{
            $product_lists = IglTailorInvProduct::with('productNamepro','productGrouppro','productTypepro')
                                            ->where('its_inv_pro_com_id',$com)
                                            ->where('its_inv_pro_bran_id',$bran)
                                            ->get();
        }
    
        return view('branch.buy.ajax.product_list',compact('product_lists'));
    }
    public function addToCart(Request $request)
    {
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;
        $submit_by = Auth::user()->its_slno;
        $submit_at = Carbon::now()->format('Y-m-d H:i:s');
        
        $total_price = $request->product_price * $request->product_qty;

        if(
            IglTailorTemporaryProductSale::where('its_com_id',$com)
                                         ->where('its_bran_id',$bran)
                                         ->where('its_product_id',$request->product_id)
                                         ->where('its_submit_by',$submit_by)
                                         ->where('status',1)->exists()
        )
        {
            IglTailorTemporaryProductSale::where('its_com_id',$com)
                                         ->where('its_bran_id',$bran)
                                         ->where('its_product_id',$request->product_id)
                                         ->where('its_submit_by',$submit_by)
                                         ->where('status',1)
                                ->update([
                                    'its_price'       => $request->product_price,
                                    'its_qty'         => $request->product_qty,
                                    'its_total_price' => $total_price,
                                ]);

            return back();
        }
        else{
            $temProductSale = new IglTailorTemporaryProductSale();
            $temProductSale->its_com_id      = $com;
            $temProductSale->its_bran_id     = $bran;
            $temProductSale->its_product_id  = $request->product_id;
            $temProductSale->its_price       = $request->product_price;
            $temProductSale->its_qty         = $request->product_qty;
            $temProductSale->its_total_price = $total_price;
            $temProductSale->status          = 1;
            $temProductSale->its_submit_by   = $submit_by;
            $temProductSale->its_submit_at   = $submit_at;
            $temProductSale->save();

            return back();
        }
    }
    public function cartProductShow()
    {
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;
        $submit_by = Auth::user()->its_slno;
        
        $product_buy = IglTailorTemporaryProductSale::with('product')->where('its_com_id',$com)
                                                    ->where('its_bran_id',$bran)
                                                    ->where('status',1)
                                                    ->where('its_submit_by',$submit_by)
                                                    ->get();
            
            
        return view('branch.buy.ajax.product_buy_list',compact('product_buy'));
    }
    public function cartProductDelete(Request $request)
    {
        IglTailorTemporaryProductSale::where('its_tem_pro_sale_slno',$request->temp_sale_slno)->delete();
        return back();
    }
    public function buyProductInvoice(Request $request)
    {
        $message = ([
            'supplier_id.required' => "Select Supplier Name",
            'invoice_no.required' => "Enter Your Invoice No",
            'issue_date.required' => "Enter Issue Date",
        ]);

        $request->validate([
            'supplier_id' => 'required',
            'invoice_no' => 'required',
            'issue_date' => 'required',
        ],$message);

        // Session Date Insert  
        Session::put('invoice_no',$request->invoice_no);
        Session::put('issue_date',$request->issue_date);

        $bran = Auth::user()->BranchDetailsUser->its_branch_id;
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $submit_by = Auth::user()->its_slno;

        // Check Invoice for Inventory Details Table  
        if(IglTailorInventoryDetails::where('its_inv_det_com_id',$com)->where('its_inv_det_invoice_id',$request->invoice_no)->exists())
        {
            return back()->with('alerady_insert','Alerady Invoice No Insert');
        }

        if(IglTailorTemporaryProductSale::where('its_bran_id',$bran)->where('its_submit_by',$submit_by)->where('status',1)->exists())
        {
            IglTailorTemporaryProductSale::where('its_bran_id',$bran)->where('its_submit_by',$submit_by)->where('status',1)->update([
                'its_supplier_id' => $request->supplier_id,
            ]);
        }

        $temp_pro_buy = IglTailorTemporaryProductSale::where('its_bran_id',$bran)
                                                     ->where('its_submit_by',$submit_by)
                                                     ->where('status',1)
                                                     ->get();

        $supplier_info = IglTailorSupplier::where('its_sup_slno',$request->supplier_id)->first();

        return view('branch.buy.buy_product_invoice',compact('temp_pro_buy','supplier_info'));
    }
    public function buyProductInvoiceInsert()
    {
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;
        
        $submit_at = Carbon::now()->format('Y-m-d H:i:s');
        $submit_by = Auth::user()->its_slno;

        $supplier_id = Session::get('supplier_id');
        $invoice_no  = Session::get('invoice_no');
        $issue_date  = Session::get('issue_date');
        
         // Sub Temporary Table Date Total Price
        $total_price = IglTailorTemporaryProductSale::where('its_bran_id',$bran)
                                                    ->where('its_submit_by',$submit_by)
                                                    ->where('status',1)
                                                    ->sum('its_total_price');

        // Account Table Invoice Amount Insert
        $account = new IglTailorAccount();
        $account->acc_com_id      = $com;
        $account->acc_bran_id     = $bran;
        $account->acc_ord_id      = $invoice_no;
        $account->acc_customer_id = $supplier_id;
        $account->acc_credit      = $total_price;
        $account->acc_debit       = 0;
        $account->acc_pay_date    = Carbon::now()->format('Y-m-d');
        $account->acc_description = 'Supplier Credit';
        $account->acc_status      = 6;
        $account->save();
       
       
        // Get Temporary Table Date
        $temp_pro_sales = IglTailorTemporaryProductSale::where('its_bran_id',$bran)
                                                       ->where('its_submit_by',$submit_by)
                                                       ->where('status',1)
                                                       ->get();

        foreach ($temp_pro_sales as $temp_pro)
        {
            // Inventory Details Table Invoice Information Insert
            $productBuy = new IglTailorInventoryDetails();
            $productBuy->its_inv_det_com_id     = $com;
            $productBuy->its_inv_det_bran_id    = $bran;
            $productBuy->its_inv_det_party_id   = $temp_pro->its_supplier_id;
            $productBuy->its_inv_det_pro_id     = $temp_pro->its_product_id;
            $productBuy->its_inv_det_invoice_id = $invoice_no;
            $productBuy->its_inv_det_buy_qty    = $temp_pro->its_qty;
            $productBuy->its_inv_det_buy_price  = $temp_pro->its_price;
            $productBuy->its_inv_det_deal_type  = 3;
            $productBuy->its_inv_det_entry_date = $issue_date;
            $productBuy->its_inv_det_submit_by  = $submit_by;
            $productBuy->its_inv_det_submit_at  = $submit_at;
            $productBuy->save();
            
            //Delet Item 
            IglTailorTemporaryProductSale::where('its_tem_pro_sale_slno',$temp_pro->its_tem_pro_sale_slno)->delete();
        }
       
        Session::forget('supplier_id');
        Session::forget('invoice_no');
        Session::forget('issue_date');

        return response()->json('success');
    }

    public function buyProductInvoiceClose()
    {
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;
        $submit_by = Auth::user()->its_slno;

        // Delete Temporary Table Date
        $temp_pro_sales = IglTailorTemporaryProductSale::where('its_bran_id',$bran)
                                                       ->where('its_submit_by',$submit_by)
                                                       ->where('status',1)
                                                       ->get();     
        foreach ($temp_pro_sales as $temp_pro)
        {
            IglTailorTemporaryProductSale::where('its_tem_pro_sale_slno',$temp_pro->its_tem_pro_sale_slno)->delete();
        }    

        Session::forget('supplier_id');
        Session::forget('invoice_no');
        Session::forget('issue_date');

        return back()->with('invoice_close','Invoice Close');
    }
}
