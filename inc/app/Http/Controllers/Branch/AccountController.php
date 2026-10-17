<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IglTailorInventoryDetails;
use App\Models\IglTailorAccount;
use Carbon\Carbon;
use Auth;
use DB;

class AccountController extends Controller
{
    public function accountStatement()
    {
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;

        $start_date = Carbon::now()->startOfMonth()->toDateString();
        $end_date = Carbon::now()->endOfMonth()->toDateString();

        $account_statements = IglTailorAccount::where('acc_com_id',$com)
                                               ->where('acc_bran_id',$bran)
                                               ->where('acc_pay_date','>=', $start_date)
                                               ->where('acc_pay_date','<=', $end_date)
                                               ->WhereIn('acc_status',[1,2,4,6])
                                               ->get();

        $customer_discount = IglTailorAccount::where('acc_com_id',$com)
                                               ->where('acc_bran_id',$bran)
                                               ->where('acc_pay_date','>=', $start_date)
                                               ->where('acc_pay_date','<=', $end_date)
                                               ->where('acc_status',3)
                                               ->sum('acc_credit');

        $supplier_discount = IglTailorAccount::where('acc_com_id',$com)
                                               ->where('acc_bran_id',$bran)
                                               ->where('acc_pay_date','>=', $start_date)
                                               ->where('acc_pay_date','<=', $end_date)
                                               ->where('acc_status',7)
                                               ->sum('acc_debit');

        return view('branch.account.account_statement',compact('account_statements','customer_discount','supplier_discount','start_date','end_date'));
    }
    public function searcAccountStatement(Request $request)
    {
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;

        $start_date = $request->start_date;
        $end_date   = $request->end_date;

        $account_statements = IglTailorAccount::where('acc_com_id',$com)
                                               ->where('acc_bran_id',$bran)
                                               ->where('acc_pay_date','>=', $start_date)
                                               ->where('acc_pay_date','<=', $end_date)
                                               ->WhereIn('acc_status',[1,2,4,6])
                                               ->get();

        $customer_discount = IglTailorAccount::where('acc_com_id',$com)
                                               ->where('acc_bran_id',$bran)
                                               ->where('acc_pay_date','>=', $start_date)
                                               ->where('acc_pay_date','<=', $end_date)
                                               ->where('acc_status',3)
                                               ->sum('acc_credit');

        $supplier_discount = IglTailorAccount::where('acc_com_id',$com)
                                               ->where('acc_bran_id',$bran)
                                               ->where('acc_pay_date','>=', $start_date)
                                               ->where('acc_pay_date','<=', $end_date)
                                               ->where('acc_status',7)
                                               ->sum('acc_debit');

        return view('branch.account.ajax.search_account_statement',compact('account_statements','customer_discount','supplier_discount','start_date','end_date'));
    }
    public function BuyStatement()
    {
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;


        $buyStatement = IglTailorInventoryDetails::where('its_inv_det_com_id',$com)
                                                 ->where('its_inv_det_bran_id',$bran)
                                                 ->where('its_inv_det_deal_type',3)
                                                 ->groupBy('its_inv_det_invoice_id')
                                                 ->orderBy('its_inv_det_slno','desc')
                                                 ->get();

        return view('branch.account.buy_statement',compact('buyStatement'));
    }
    public function buyStatementAjax(Request $request)
    {
       $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
       $bran = Auth::user()->BranchDetailsUser->its_branch_id;

        $buy_statements = IglTailorInventoryDetails::where('its_inv_det_com_id',$com)
                                                 ->where('its_inv_det_bran_id',$bran)
                                                 ->where('its_inv_det_invoice_id',$request->invoice_id)
                                                 ->where('its_inv_det_deal_type',3)
                                                 ->get();

        return view('branch.account.ajax.buy_statement_ajax',compact('buy_statements'));
    }
    public function SellStatement()
    {
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;

        $sale_statements = IglTailorInventoryDetails::with('customer')->where('its_inv_det_com_id',$com)
                                                    ->where('its_inv_det_bran_id',$bran)
                                                    ->where('its_inv_det_deal_type',4)
                                                    ->groupBy('its_inv_det_invoice_id')
                                                    ->orderBy('its_inv_det_slno','desc')
                                                    ->get();

        return view('branch.account.sell_statement',compact('sale_statements'));
    }
    public function saleStatementAjax(Request $request)
    {
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;

        $sale_statements = IglTailorInventoryDetails::where('its_inv_det_com_id',$com)
                                                    ->where('its_inv_det_bran_id',$bran)
                                                    ->where('its_inv_det_invoice_id',$request->invoice_id)
                                                    ->where('its_inv_det_deal_type',4)
                                                    ->get();

        return view('branch.account.ajax.sale_statement_ajax',compact('sale_statements'));
    }
}
