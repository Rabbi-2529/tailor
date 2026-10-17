<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IglTailorBank;
use App\Models\IglTailorBankAcc;
use App\Models\IglTailorBankTransaction;
use Carbon\Carbon;
use Auth;
use DB;

class BankController extends Controller
{
    public function OpenBankStatement()
    {
        $banks = IglTailorBank::all();
        $current_date = Carbon::now()->format('Y-m-d');

        return view('branch.bank.open_bank_statement',compact('banks','current_date'));
    }
    public function bankAccountSubmit(Request $request)
    {
        $submit_by = Auth::user()->its_slno;
        $submit_at = Carbon::now()->format('Y-m-d H:i:s');

        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;

        $message = ([
            'branch.required' => "Branch Name is Required",
            'bank_Id.required' => "Bank Name is Required",
            'acc_no.required' => "Account No is Required",
            'open.required' => "You Need Mention Opening Date!",
        ]);
        $request->validate([
            'branch' => 'required',
            'bank_Id' => 'required',
            'acc_no' => 'required',
            'open' => 'required',
        ],$message);

        if(
            IglTailorBankAcc::where('its_bank_acc_com_id',$com)->where('its_bank_acc_bran_id',$bran)
                            ->where('its_bank_acc_bank_name',$request->bank_Id)->where('its_bank_acc_acc_no',$request->acc_no)
                            ->exists()
        )
        {
            return back()->with('error_entry','Bank Account No Insert');
        }
        else
        {
            $bankAccount = new IglTailorBankAcc();
            $bankAccount->its_bank_acc_com_id = $com;
            $bankAccount->its_bank_acc_bran_id = $bran;
            $bankAccount->its_bank_acc_branch_name = $request->branch;
            $bankAccount->its_bank_acc_bank_name = $request->bank_Id;
            $bankAccount->its_bank_acc_acc_no = $request->acc_no;
            $bankAccount->its_bank_acc_open_date = $request->open;
            $bankAccount->its_bank_acc_status = 1;
            $bankAccount->its_bank_acc_submit_at = $submit_at;
            $bankAccount->its_bank_acc_submit_by = $submit_by;
            $bankAccount->save();
        }
        

        return redirect()->back()->with(['bank_acc' => 'Bank Account Created']);
    }

    public function BankAccountList()
    {
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;

        $bankAccounts = IglTailorBankAcc::where('its_bank_acc_com_id',$com)
                                        ->where('its_bank_acc_bran_id',$bran)
                                        ->orderBy('its_bank_acc_slno','desc')
                                        ->get();

        return view('branch.bank.bank_account_list',compact('bankAccounts'));
    }
    public function bankAccountDelete($id)
    {
        $bank_account = IglTailorBankAcc::find($id);
        $bank_account->delete();
        return redirect()->back()->with(['acc_del' => 'Bank Account Deleted!']);
    }
    public function bankEditAjax(Request $request)
    {
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;

        $banks = IglTailorBank::all();
        $bank_edit = IglTailorBankAcc::where('its_bank_acc_slno',$request->bank_id)->first();
        return view('branch.bank.ajax.bank_edit_ajax',compact('banks','bank_edit'));
    }
    public function bankUpdate(Request $request)
    {
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;

        $update_at = Carbon::now()->format('Y-m-d H:i:s');
        $update_by = Auth::user()->its_slno;

        $request->validate([
            'branch' => 'required',
            'bank_Id' => 'required',
            'acc_no' => 'required',
        ]);

        if(IglTailorBankAcc::where('its_bank_acc_com_id',$com)->where('its_bank_acc_bran_id',$bran)->where('its_bank_acc_bank_name',$request->bank_Id)->where('its_bank_acc_slno','!=',$request->bank_acc_Id)->exists())
        {
            return back()->with('error_entry','Bank Account No Insert');
        }
        else
        {
            $bankUpdate = IglTailorBankAcc::where('its_bank_acc_slno',$request->bank_acc_Id)->first();
            $bankUpdate->its_bank_acc_bank_name = $request->bank_Id;
            $bankUpdate->its_bank_acc_branch_name = $request->branch;
            $bankUpdate->its_bank_acc_acc_no = $request->acc_no;
            $bankUpdate->its_bank_acc_update_at = $update_at;
            $bankUpdate->its_bank_acc_update_by = $update_by;
            $bankUpdate->save();
        }

        return redirect()->back()->with(['bank_up' => 'Bank Updated']);
    }
    public function BankDeposit()
    {
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;
        
        $banks = IglTailorBankAcc::with('bankName')->where('its_bank_acc_com_id',$com)
                                  ->where('its_bank_acc_bran_id',$bran)
                                  ->get();

        $current_date = Carbon::now()->format('Y-m-d');

        return view('branch.bank.bank_deposit',compact('banks','current_date'));
    }
    public function bankAccNoAjax(Request $request)
    {
        return IglTailorBankAcc::where('its_bank_acc_bank_name',$request->bank_id)->first()->its_bank_acc_acc_no;
    }
    public function bankDepositSubmit(Request $request)
    {
        $submit_by = Auth::user()->its_slno;
        $submit_at = Carbon::now()->format('Y-m-d H:i:s');

        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;

        $message = ([
            'bank.required' => "You Can't Skip This Field",
            'acc_no.required' => "You Can't Skip This Field",
            'deposit_amount.required' => "You Can't Skip This Field",
            'deposit_date.required' => "You Can't Skip This Field",
            'description.required' => "You Can't Skip This Field",
        ]);

        $request->validate([
            'bank' => 'required',
            'acc_no' => 'required',
            'deposit_amount' => 'required',
            'deposit_date' => 'required',
            'description' => 'required',
        ],$message);

        $bankDeposit = new IglTailorBankTransaction();
        $bankDeposit->its_bank_tran_com_id = $com;
        $bankDeposit->its_bank_tran_bran_id = $bran;
        $bankDeposit->its_bank_tran_bank_id = $request->bank;
        $bankDeposit->its_bank_tran_account_no = $request->acc_no;
        $bankDeposit->its_bank_tran_credit = $request->deposit_amount;
        $bankDeposit->its_bank_tran_debit = 0;
        $bankDeposit->its_bank_tran_date = $request->deposit_date;
        $bankDeposit->its_bank_tran_desc = $request->description;
        $bankDeposit->its_bank_tran_ref = 5;
        $bankDeposit->its_bank_tran_submit_at = $submit_at;
        $bankDeposit->its_bank_tran_submit_by = $submit_by;
        $bankDeposit->save();
        
        return redirect()->back()->with(['bank_deposit' => 'Amount Deposit In Bank']);
    }
    //End Bank Deposit

    //Bank Withdraw
    public function BankWithdraw()
    {
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;
        
        $banks = IglTailorBankAcc::with('bankName')->where('its_bank_acc_com_id',$com)
                                  ->where('its_bank_acc_bran_id',$bran)
                                  ->get();

        $current_date = Carbon::now()->format('Y-m-d');

        return view('branch.bank.bank_withdraw',compact('banks','current_date'));
    }
    public function bankWithdrawSubmit(Request $request)
    {
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;
        $submit_by = Auth::user()->its_slno;
        $submit_at = Carbon::now()->format('Y-m-d H:i:s');

        $message = ([
            'bank.required' => "You Can't Skip This Field",
            'acc_no.required' => "You Can't Skip This Field",
            'withdraw_amount.required' => "You Can't Skip This Field",
            'withdraw_date.required' => "You Can't Skip This Field",
            'description.required' => "You Can't Skip This Field",
        ]);

        $request->validate([
            'bank' => 'required',
            'acc_no' => 'required',
            'withdraw_amount' => 'required',
            'withdraw_date' => 'required',
            'description' => 'required',
        ],$message);

        $bankWithdraw = new IglTailorBankTransaction();
        $bankWithdraw->its_bank_tran_com_id     = $com;
        $bankWithdraw->its_bank_tran_bran_id    = $bran;
        $bankWithdraw->its_bank_tran_bank_id    = $request->bank;
        $bankWithdraw->its_bank_tran_account_no = $request->acc_no;
        $bankWithdraw->its_bank_tran_debit      = $request->withdraw_amount;
        $bankWithdraw->its_bank_tran_credit     = 0;
        $bankWithdraw->its_bank_tran_date       = $request->withdraw_date;
        $bankWithdraw->its_bank_tran_desc       = $request->description;
        $bankWithdraw->its_bank_tran_ref        = 6;
        $bankWithdraw->its_bank_tran_submit_at  = $submit_at;
        $bankWithdraw->its_bank_tran_submit_by  = $submit_by;
        $bankWithdraw->save();
        
        return redirect()->back()->with(['bank_withdraw' => 'Amount Withdrawn From Bank']);
    }
    //End Bank Withdraw

    public function CashTransfer()
    {   
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;
        
        $bank_names = IglTailorBankAcc::with('bankName')->where('its_bank_acc_com_id',$com)
                                  ->where('its_bank_acc_bran_id',$bran)
                                  ->get();

        return view('branch.bank.cash_transfer',compact('bank_names'));
    }
    public function BankAmount(Request $request)
    {   
        $bank_id = $request->bank_id;

        $credit_amount = IglTailorBankTransaction::where('its_bank_tran_bank_id',$bank_id)
                                                  ->sum('its_bank_tran_credit');
    
        $debit_amount = IglTailorBankTransaction::where('its_bank_tran_bank_id',$bank_id)
                                                 ->sum('its_bank_tran_debit');

        $total_amount = $credit_amount - $debit_amount;

        return $total_amount;

    }
    public function CheckBankAmount(Request $request)
    {   
        $input_amount = $request->amount;
        $from_bank_id = $request->from_bank_id;
        
        
        $check_credit_amount = IglTailorBankTransaction::where('its_bank_tran_bank_id',$from_bank_id)
                                                         ->sum('its_bank_tran_credit');

        $check_debit_amount = IglTailorBankTransaction::where('its_bank_tran_bank_id',$from_bank_id)
                                                         ->sum('its_bank_tran_debit');

        $total_amount = $check_credit_amount - $check_debit_amount;

        if($total_amount >= $input_amount){
            return ['available' => 'available'];
        }
        else{
             return ['insufficient' => 'insufficient'];
        }
    }
    public function CashTransferInsert(Request $request)
    {   
        $request->validate([
            'from_bank_id'   => 'required',
            'from_acc_no_id' => 'required',
            'to_bank_id'     => 'required',
            'to_acc_no_id'   => 'required',
            'amount'         => 'required',
            'description'    => 'required',
        ]);

        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;
        $submit_by = Auth::user()->its_slno;
        $submit_at = Carbon::now()->format('Y-m-d H:i:s');

        $from_bank_id = $request->from_bank_id;
        $from_acc_no_id = $request->from_acc_no_id;

        $to_bank_id = $request->to_bank_id;
        $to_acc_no_id = $request->to_acc_no_id;
    
      
        // Debit Amount For From
        $bankDeposit = new IglTailorBankTransaction();
        $bankDeposit->its_bank_tran_com_id = $com;
        $bankDeposit->its_bank_tran_bran_id = $bran;
        $bankDeposit->its_bank_tran_bank_id = $from_bank_id;
        $bankDeposit->its_bank_tran_account_no = $from_acc_no_id;
        $bankDeposit->its_bank_tran_debit = $request->amount;
        $bankDeposit->its_bank_tran_credit = 0;
        $bankDeposit->its_bank_tran_date = Carbon::now()->format('Y-m-d');
        $bankDeposit->its_bank_tran_desc = $request->description;
        $bankDeposit->its_bank_tran_ref = 7;
        $bankDeposit->its_bank_tran_submit_at = $submit_at;
        $bankDeposit->its_bank_tran_submit_by = $submit_by;
        $bankDeposit->save();
        // Credit Amount For To
        $bankDeposit = new IglTailorBankTransaction();
        $bankDeposit->its_bank_tran_com_id = $com;
        $bankDeposit->its_bank_tran_bran_id = $bran;
        $bankDeposit->its_bank_tran_bank_id = $to_bank_id;
        $bankDeposit->its_bank_tran_account_no = $to_acc_no_id;
        $bankDeposit->its_bank_tran_debit = 0;
        $bankDeposit->its_bank_tran_credit = $request->amount;
        $bankDeposit->its_bank_tran_date = Carbon::now()->format('Y-m-d');;
        $bankDeposit->its_bank_tran_desc = $request->description;
        $bankDeposit->its_bank_tran_ref = 7;
        $bankDeposit->its_bank_tran_submit_at = $submit_at;
        $bankDeposit->its_bank_tran_submit_by = $submit_by;
        $bankDeposit->save();
       

        return redirect()->back()->with(['cash_transfer' => 'Cash Transfer']);
    }
    // Start Bank Statement 
    public function BankStatement()
    {
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;

        $bank_accounts = IglTailorBankAcc::with('bankName')->where('its_bank_acc_com_id',$com)
                                          ->where('its_bank_acc_bran_id',$bran)
                                          ->get();                                         

        return view('branch.bank.bank_statement',compact('bank_accounts'));
    }
    public function BankStatementDetails($bank_id)
    {
        $bank_id = base64_decode($bank_id);
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;

        $statement_details = IglTailorBankTransaction::where('its_bank_tran_bran_id',$bran)
                                                      ->where('its_bank_tran_bank_id',$bank_id)
                                                      ->get();

        $bank_info = IglTailorBankAcc::with('bankName')->where('its_bank_acc_bran_id',$bran)
                                    ->where('its_bank_acc_bank_name',$bank_id)
                                    ->first();
                                          

        return view('branch.bank.bank_statement_details',compact('statement_details','bank_info'));
    }
    // End Bank Statement
}
