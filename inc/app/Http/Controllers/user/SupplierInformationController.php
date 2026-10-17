<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Models\IglTailorSupplier;
use App\Models\IglTailorSupplierBank;
use App\Models\IglTailorSupplierPayDate;
use App\Models\IglTailorUserUser;
use App\Models\IglTailorBank;
use App\Models\IglTailorBankAcc;
use App\Models\IglTailorAccount;
use App\Models\IglTailorBankTransaction;
use DB;

class SupplierInformationController extends Controller
{
    public function add(){
        return view('user.supplier.add');
    }
    public function SupplierAdd(Request $request)
    {
        $submit_by = Auth::user()->its_slno;
        $submit_at = Carbon::now()->format('Y-m-d H:i:s');
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $user = Auth::user()->UserDetails->its_user_user_id;
        $reg = Carbon::now()->format('Y-m-d');

        $message = ([
            'name.required' => "You Couldn't Skip This Field!",
            'address.required' => "You Couldn't Skip This Field!",
            'person.required' => "You Couldn't Skip This Field!",
            'mobile.required' => "You Couldn't Skip This Field!",
            'status.required' => "You Couldn't Skip This Field!"
        ]);
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'person' => 'required',
            'mobile' => 'required',
            'status' => 'required',
        ],$message);
        
        $serial = IglTailorSupplier::count();

        $supplier = new IglTailorSupplier();
        $supplier->its_sup_com_id = $com;
        $supplier->its_sup_bran_id = $bran;
        $supplier->its_sup_user_id = $user;
        $supplier->its_sup_sup_id = $serial + 1;
        $supplier->its_sup_name = $request->name;
        $supplier->its_sup_address = $request->address;
        $supplier->its_sup_person = $request->person;
        $supplier->its_sup_mobile = $request->mobile;
        $supplier->its_sup_phone = $request->phone;
        $supplier->its_sup_email = $request->email;
        $supplier->its_sup_website = $request->website;
        $supplier->its_sup_complain_number = $request->complain;
        $supplier->its_sup_due_balance = $request->due_bal;
        $supplier->its_sup_status = $request->status;
        $supplier->its_sup_date = $reg;
        $supplier->its_sup_submit_by = $submit_by;
        $supplier->its_sup_submit_at = $submit_at;
        $supplier->save();

        if(isset($request->due_bal)){
            $account = new IglTailorAccount();
            $account->acc_com_id      = $com;
            $account->acc_bran_id     = $bran;
            $account->acc_customer_id = $supplier->its_sup_slno;
            $account->acc_credit      = $request->due_bal;
            $account->acc_debit       = '';
            $account->acc_description = "Supplier Credit";
            $account->acc_status      = 6;
            $account->acc_submit_by   = $submit_by;
            $account->save();
        }

        return redirect()->back()->with(['supplier' => 'Supplier Information Insert']);
    }

    public function ViewSupplier()
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;

        $suppliers = IglTailorSupplier::where('its_sup_com_id',$com)
                                      ->where('its_sup_bran_id',$bran)
                                      ->orderBy('its_sup_slno','desc')
                                      ->get();

        return view('user.supplier.view_supplier',compact('suppliers'));
    }
    public function UpdateSupplier($sup_slno)
    {
        $supplier_id = base64_decode($sup_slno);
        $supplier_info = IglTailorSupplier::where('its_sup_slno',$supplier_id)->first();

        return view('user.supplier.update_supplier',compact('supplier_info'));
    }
    public function UpdateInfoInsert(Request $request)
    {
        $update_by = Auth::user()->its_slno;
        $update_at = Carbon::now()->format('Y-m-d H:i:s');

        IglTailorSupplier::where('its_sup_slno',$request->its_sup_slno)->update([
            'its_sup_name'       => $request->name,
            'its_sup_address'    => $request->address,
            'its_sup_person'     => $request->person,
            'its_sup_mobile'     => $request->mobile,
            'its_sup_phone'      => $request->phone,
            'its_sup_email'      => $request->email,
            'its_sup_website'    => $request->website,
            'its_sup_complain_number' => $request->complain,
            'its_sup_due_balance' => $request->due_bal,
            'its_sup_status'      => $request->status,
            'its_sup_update_by'   => $update_by,
            'its_sup_update_at'   => $update_at,
        ]);

        return back()->with('update','Supplier Informaton Update');
    }
    public function delete($sup_slno)
    {
        $supplier_id = base64_decode($sup_slno);

        IglTailorSupplier::where('its_sup_slno',$supplier_id)->delete();
        
        return back()->with('delete','Supplier Informaton Delete');
    }
    public function AddBank()
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;

        $suppliers = IglTailorSupplier::where('its_sup_com_id',$com)
                                       ->where('its_sup_bran_id',$bran)
                                       ->orderBy('its_sup_sup_id','DESC')
                                       ->get();

        $banks = IglTailorBank::orderBy('its_bank_name')->get();

        return view('user.supplier.add_bank',compact('suppliers','banks'));
    }
    public function AddBankInsert(Request $request)
    {
        $submit_by = Auth::user()->its_slno;
        $submit_at = Carbon::now()->format('Y-m-d H:i:s');

        $message = ([
            'sup_name.required' => "You Couldn't Skip This Field",
            'b_name.required' => "You Couldn't Skip This Field",
            'br_name.required' => "You Couldn't Skip This Field",
            'ac_name.required' => "You Couldn't Skip This Field",
            'ac_no.required' => "You Couldn't Skip This Field",
        ]);

        $request->validate([
            'sup_name' => 'required',
            'b_name' => 'required',
            'br_name' => 'required',
            'ac_name' => 'required',
            'ac_no' => 'required',
        ],$message);

        $add_bank = new IglTailorSupplierBank();
        $add_bank->its_branch_name   = $request->br_name;
        $add_bank->its_sup_id        = $request->sup_name;
        $add_bank->its_bank_id       = $request->b_name;
        $add_bank->its_bank_acc_name = $request->ac_name;
        $add_bank->its_acc_no        = $request->ac_no;
        $add_bank->its_submit_by     = $submit_by;
        $add_bank->its_submit_at     = $submit_at;
        $add_bank->save();

        return redirect()->back()->with(['sup_bank' => 'Supplier Bank Added']);
    }
    
    public function BankDetails(Request $request)
    {
        $its_sup_slno = base64_decode($request->its_sup_slno);
        $bank_details = IglTailorSupplierBank::where('its_sup_id',$its_sup_slno)->get();

        return view('user.supplier.ajax.supplier_bank_details',compact('bank_details'));
    }
    public function PaymentDate()
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;

        $suppliers = IglTailorSupplier::select('its_sup_slno','its_sup_name')
                                       ->where('its_sup_com_id',$com)
                                       ->where('its_sup_bran_id',$bran)
                                       ->orderBy('its_sup_sup_id','DESC')
                                       ->get();

        return view('user.supplier.payment_date',compact('suppliers'));
    }
    public function PaymentDateInsert(Request $request)
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $user = Auth::user()->UserDetails->its_user_user_id;

        $submit_by = Auth::user()->its_slno;
        $submit_at = Carbon::now()->format('Y-m-d H:i:s');

        $message = ([
            'sup_name.required' => "You Can't Skip This Field",
            'p_type.required' => "You Can't Skip This Field",
            'amount.required' => "You Can't Skip This Field",
            'pay_date.required' => "You Can't Skip This Field",
        ]);
        $request->validate([
            'sup_name' => 'required',
            'p_type' => 'required',
            'amount' => 'required',
            'pay_date' => 'required',
        ],$message);

        $payment = new IglTailorSupplierPayDate();
        $payment->its_com_id = $com;
        $payment->its_bran_id = $bran;
        $payment->its_user_id = $user;
        $payment->its_sup_id = $request->sup_name;
        $payment->its_payment_type = $request->p_type;
        $payment->its_amount = $request->amount;
        $payment->its_payment_date = $request->pay_date;
        $payment->its_submit_by = $submit_by;
        $payment->its_submit_at = $submit_at;
        $payment->save();

        return redirect()->back()->with(['payment_date' => 'Payment Date Added']);
    }
    public function ViewPaymentDate()
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;

        $supplier_pay_dates = IglTailorSupplierPayDate::with('supplier_info')->where('its_com_id',$com)
                                                      ->where('its_bran_id',$bran)
                                                      ->orderBy('its_sup_pay_date_id','DESC')
                                                      ->get();


        return view('user.supplier.view_payment_date',compact('supplier_pay_dates'));
    }
    public function PaymentDateUpdateInfo(Request $request)
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;

        $suppliers = IglTailorSupplier::select('its_sup_slno','its_sup_name')
                                      ->where('its_sup_com_id',$com)
                                      ->where('its_sup_bran_id',$bran)
                                      ->orderBy('its_sup_sup_id','DESC')
                                      ->get();

        $sup_pay_date_id = base64_decode($request->sup_pay_date_id);

        $pay_date_info = IglTailorSupplierPayDate::where('its_sup_pay_date_id',$sup_pay_date_id)->first();

        return view('user.supplier.ajax.sup_pay_date_update_info',compact('pay_date_info','suppliers'));
    }
    public function PaymentDateUpdate(Request $request)
    {
        $update_by = Auth::user()->its_slno;
        $update_at =  Carbon::now()->format('Y-m-d H:i:s');

        $message = ([
            'sup_name.required' => "You Can't Skip This Field",
            'p_type.required' => "You Can't Skip This Field",
            'amount.required' => "You Can't Skip This Field",
            'pay_date.required' => "You Can't Skip This Field",
        ]);
        $request->validate([
            'sup_name' => 'required',
            'p_type' => 'required',
            'amount' => 'required',
            'pay_date' => 'required',
        ],$message);

        IglTailorSupplierPayDate::where('its_sup_pay_date_id',$request->pay_date_id)->update([
            'its_sup_id'       => $request->sup_name,
            'its_payment_type' => $request->p_type,
            'its_amount'       => $request->amount,
            'its_payment_date' => $request->pay_date,
            'its_update_by'    => $update_by,
            'its_update_at'    => $update_at,
        ]);

        return redirect()->back()->with(['payment_date_update' => 'Payment Date Update']);
    }
    public function PaymentDateDelete($sup_pay_date_id)
    {
        $sup_pay_date_id = base64_decode($sup_pay_date_id);

        IglTailorSupplierPayDate::where('its_sup_pay_date_id',$sup_pay_date_id)->delete();

        return redirect()->back()->with(['payment_date_delete' => 'Payment Date Delete']);
    }
    public function payment()
    {
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;

        $banks = IglTailorBankAcc::with('bankName')->where('its_bank_acc_com_id',$com)
                                  ->where('its_bank_acc_bran_id',$bran)
                                  ->get();

        $suppliers = IglTailorSupplier::where('its_sup_com_id',$com)
                                      ->where('its_sup_bran_id',$bran)
                                      ->orderBy('its_sup_slno','desc')
                                      ->get();

        $current_date = Carbon::now()->format('Y-m-d');

        return view('user.supplier.payment',compact('suppliers','banks','current_date'));
    }
    public function payableAmount(Request $request)
    {   
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        
        $supplier_credit = IglTailorAccount::where('acc_com_id',$com)
                               ->where('acc_bran_id',$bran)
                               ->where('acc_customer_id',$request->supplier_id)
                               ->where('acc_status',6)
                               ->sum('acc_credit');
        $supplier_debit = IglTailorAccount::where('acc_com_id',$com)
                               ->where('acc_bran_id',$bran)
                               ->where('acc_customer_id',$request->supplier_id)
                               ->where('acc_status',6)
                               ->sum('acc_debit');

        return $supplier_credit - $supplier_debit;
    }
    public function paymentInsert(Request $request)
    {
        $request->validate([
            'supplier_id'  => 'required',
            'bank_id'      => 'required',
            'acc_no_id'    => 'required',
            'amount'       => 'required|numeric',
            'total_amount' => 'required|numeric',
            'payment_date' => 'required',
            'desc'         => 'required',
        ]);

        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $user = Auth::user()->UserDetails->its_user_user_id;
        $submit_by = Auth::user()->its_slno;

        $account = new IglTailorAccount();
        $account->acc_com_id      = $com;
        $account->acc_bran_id     = $bran;
        $account->acc_user_id     = $user;
        $account->acc_customer_id = $request->supplier_id;
        $account->acc_credit      = '';
        $account->acc_debit       = $request->total_amount;
        $account->acc_pay_date    = $request->payment_date;
        $account->acc_description = $request->desc;
        $account->acc_status      = 6;
        $account->acc_submit_by   = $submit_by;
        $account->save();

        if(isset($request->discount))
        {
            $account = new IglTailorAccount();
            $account->acc_com_id      = $com;
            $account->acc_bran_id     = $bran;
            $account->acc_user_id     = $user;
            $account->acc_customer_id = $request->supplier_id;
            $account->acc_credit      = '';
            $account->acc_debit       = $request->discount;
            $account->acc_pay_date    = $request->payment_date;
            $account->acc_description = 'Supplier Discount';
            $account->acc_status      = 7;
            $account->acc_submit_by   = $submit_by;
            $account->save();
        }

        $bankTransaction =  new IglTailorBankTransaction();
        $bankTransaction->its_bank_tran_com_id  = $com;
        $bankTransaction->its_bank_tran_bran_id = $bran; 
        $bankTransaction->its_bank_tran_user_id = $user;
        $bankTransaction->its_bank_tran_bank_id = $request->bank_id; 
        $bankTransaction->its_bank_tran_account_no = $request->acc_no_id;
        $bankTransaction->its_bank_tran_debit = $request->total_amount;
        $bankTransaction->its_bank_tran_credit = 0;
        $bankTransaction->its_bank_tran_date = $request->payment_date;
        $bankTransaction->its_bank_tran_desc = $request->desc;
        $bankTransaction->its_bank_tran_ref =  3;
        $bankTransaction->its_bank_tran_submit_at = $request->payment_date;
        $bankTransaction->its_bank_tran_submit_by = $submit_by;
        $bankTransaction->save();

        if(isset($request->discount))
        {
            $bankTransaction = new IglTailorBankTransaction();
            $bankTransaction->its_bank_tran_com_id = $com;
            $bankTransaction->its_bank_tran_bran_id = $bran;
            $bankTransaction->its_bank_tran_user_id = $user;
            $bankTransaction->its_bank_tran_bank_id = $request->bank_id;
            $bankTransaction->its_bank_tran_account_no = $request->acc_no_id;
            $bankTransaction->its_bank_tran_debit = $request->discount;
            $bankTransaction->its_bank_tran_credit = 0;
            $bankTransaction->its_bank_tran_date = $request->payment_date;
            $bankTransaction->its_bank_tran_desc = 'Supplier Discount';
            $bankTransaction->its_bank_tran_ref = 4;
            $bankTransaction->its_bank_tran_submit_at = $request->payment_date;
            $bankTransaction->its_bank_tran_submit_by = $submit_by;
            $bankTransaction->save();
        }
        
       return back()->with('success','Supplier Payment');
    }
    public function SupplierStatement()
    {   
        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;

        $suppliers = IglTailorSupplier::where('its_sup_com_id',$com)
                                      ->where('its_sup_bran_id',$bran)
                                      ->orderBy('its_sup_slno','desc')
                                      ->get(['its_sup_slno','its_sup_name']);

        return view('user.supplier.statement',compact('suppliers'));
    }
    public function ViewStatementDetails($sup_id)
    {   
        $sup_id = base64_decode($sup_id);
         $bran = Auth::user()->UserDetails->its_user_bran_id;

        $supplier_accounts = IglTailorAccount::where('acc_bran_id',$bran)
                                              ->where('acc_customer_id',$sup_id)
                                              ->whereIn('acc_status',[6,7,8])
                                              ->get();


        $supplier_discount = IglTailorAccount::select(DB::raw('SUM(acc_debit) as acc_debit'))
                                ->where('acc_customer_id',$sup_id)
                                ->where('acc_status',7)
                                ->groupBy('acc_customer_id')
                                ->get();                                      

         return view('user.supplier.statement_details',compact('supplier_accounts','supplier_discount'));
    }

}
