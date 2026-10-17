<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\IglTailorBank;
use App\Models\IglTailorBankAcc;
use App\Models\IglTailorAccount;
use App\Models\IglTailorCustomer;
use App\Models\IglTailorAddOrder;
use App\Models\IglTailorBloodGroup;
use App\Models\IglTailorBankTransaction;
use App\Models\IglTailorCompany;
use Carbon\Carbon;
use Auth;
use Session;
use DB;


class CustomersController extends Controller
{
    public function CustomerRegistration()
    {
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;

        $bloods = IglTailorBloodGroup::all();
        $cus_ref = IglTailorCustomer::where('its_cus_com_id',$com)->where('its_cus_bran_id',$bran)->get();

        return view('branch.customers.customer_registration',compact('bloods','cus_ref'));
    }

    public function CustomerMobileNumberExist(Request $request)
    {
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;

        $exist_no = IglTailorCustomer::where('its_cus_com_id',$com)
                                     ->where('its_cus_mobile',$request->mobile)
                                     ->first();
        if (!empty($exist_no)) {
            return "true";
        }else {
            return "false";
        }
    }
    public function CustomerRegistrationInsert(Request $request){
        
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;
        
        $serial = IglTailorCustomer::count();
        
        $submit_by = Auth::user()->its_slno;
        $submit_at = Carbon::now()->format('Y-m-d H:i:s');
        $reg = Carbon::now()->format('Y-m-d');
        $img_url = '';
        
        $message = ([
            'name.required' => 'Name Field is Required',
            'mobile.required' => 'Mobile Field is Required',
            'address.required' => 'Address Field is Required',
        ]);
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'address' => 'required',
        ],$message);
        try {
            $customer_registration = new IglTailorCustomer();
            $customer_registration->its_cus_com_id = $com;
            $customer_registration->its_cus_bran_id = $bran;
            $customer_registration->its_cus_customer_id = $serial + 1;
            $customer_registration->its_cus_name = $request->name;
            $customer_registration->its_cus_email = $request->email;
            $customer_registration->its_cus_address = $request->address;
            $customer_registration->its_cus_mobile = $request->mobile;
            $customer_registration->its_cus_blood = $request->blood_group;
            $customer_registration->its_cus_nid = $request->nid;
            $customer_registration->its_cus_birthdate = $request->birth;
            $customer_registration->its_cus_reference = $request->referrence;
            $customer_registration->its_cus_status = 1;
            $customer_registration->its_cus_reg_date = $reg;
            if ($request->hasFile('image')) {
                $files = $request->file('image');
                $extension = $request->file('image')->getClientOriginalExtension();
                $name = 'upload_' . time() . '.' . $extension;
                $destinationPath = 'assets/uploads/customer';
                $files->move($destinationPath, $name);
                $img_url = $destinationPath. "/" .$name;
            }
            $customer_registration->its_cus_pic = $img_url;
            $customer_registration->its_cus_submit_by = $submit_by;
            $customer_registration->its_cus_submit_at = $submit_at;
            $customer_registration->save();
        } 
        catch (\Exception $e) {
           return redirect()->back()->with(['err' => $e->getMessage()]);
        }
        return redirect()->back()->with(['customer' => 'Customer Registered Successfully']);
        
    }
    public function CustomerInsertFromCompany(Request $request)
    {
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;

        // Customer Table Multiple Branch Id Insert
        $customer_info = IglTailorCustomer::where('its_cus_com_id',$com)
                                          ->where('its_cus_mobile',$request->mobile)
                                          ->first();


        if($customer_info->its_cus_bran_id == $bran){
            return response()->json('already_customer_insert');
        }
        else{
            $explode_branch_id = explode(',',$customer_info->its_cus_bran_id);

            if(in_array($bran, $explode_branch_id)){
                return response()->json('already_customer_insert');
            }
            else{
                IglTailorCustomer::where('its_cus_slno',$customer_info->its_cus_slno)->update([
                    'its_cus_bran_id' => $customer_info->its_cus_bran_id.','.$bran,
                ]);
        
                return response()->json('customer_insert');
            }
        }
    }
    public function AllCustomer(){

        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;
        
        $customers = IglTailorCustomer::where('its_cus_com_id',$com)
                                      ->where('its_cus_status',1)
                                      ->orderBy('its_cus_slno','desc')
                                      ->get();

        return view('branch.customers.all_customers',compact('customers'));
    }
    public function CustomerOrderStatus($its_cus_slno){

        $its_cus_slno = base64_decode($its_cus_slno);

        $customer_info = IglTailorCustomer::select('its_cus_name')->where('its_cus_slno',$its_cus_slno)->first();
        
        $customer_order_ids = IglTailorAddOrder::with('order_total_amount')
                                               ->where('its_add_order_cus_id',$its_cus_slno)
                                               ->distinct(['its_add_order_order_id'])
                                               ->get(['its_add_order_order_id']);
       
    
        return view('branch.customers.customer_order_status',compact('customer_order_ids','customer_info'));
    }
    public function CustomerOrderDetails($its_order_id)
    {
        $its_order_id = base64_decode($its_order_id);

        $customer_id = IglTailorAddOrder::select('its_add_order_cus_id')
                                        ->where('its_add_order_order_id',$its_order_id)
                                        ->first();
        
        $order_id_inform = IglTailorAddOrder::select('its_add_product_name','its_add_product_quantity')
                                            ->where('its_add_order_order_id',$its_order_id)
                                            ->get();
        

        return view('branch.customers.customer_order_details',compact('order_id_inform','customer_id'));
    }
    public function Payments()
    {
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;
        
        $banks = IglTailorBankAcc::with('bankName')->where('its_bank_acc_com_id',$com)
                                  ->where('its_bank_acc_bran_id',$bran)
                                  ->get();


        $customers = IglTailorCustomer::select('its_cus_slno','its_cus_bran_id','its_cus_name','its_cus_mobile')
                                        ->where('its_cus_com_id',$com)
                                        ->where('its_cus_status',1)
                                        ->orderBy('its_cus_slno','desc')
                                        ->get();

        $current_date = Carbon::now()->format('Y-m-d');

        return view('branch.customers.payments',compact('customers','banks','current_date','bran'));
    }
    public function CustomerPayableAmount(Request $request)
    {
        // Customer Payable Amount Show
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;

        $total_debit_amount = IglTailorAccount::where('acc_com_id',$com)
                                               ->where('acc_bran_id',$bran)
                                               ->where('acc_customer_id',$request->customer_id)
                                               ->where('acc_status',1)
                                               ->sum('acc_debit');

        $total_credit_amount = IglTailorAccount::where('acc_com_id',$com)
                                                ->where('acc_bran_id',$bran)
                                                ->where('acc_customer_id',$request->customer_id)
                                                ->whereIn('acc_status',[2,3])
                                                ->sum('acc_credit');

        if(isset($total_credit_amount))
        {
            if($total_debit_amount > $total_credit_amount){

                $payable_amount = $total_debit_amount - $total_credit_amount;
                return $payable_amount;
            }
            else{
                return 0;
            }
        }
        else{
            return $total_debit_amount;
        }
    }
    public function CustomerPayment(Request $request)
    {
        $request->validate([
            'acc_no'       => 'required',
            'bank_id'      => 'required',
            'customer_id'  => 'required',
            'amount'       => 'required|numeric',
            'total_amount' => 'required|numeric',
            'description'  => 'required',
        ]);
        
        $total_amount = explode('.',$request->total_amount)[0];
        $previus_due = explode('.',$request->previus_due)[0];

        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;
        $submit_by = Auth::user()->its_slno;

        // Account Table  
        $account = new IglTailorAccount();
        $account->acc_com_id      = $com;
        $account->acc_bran_id     = $bran;
        $account->acc_customer_id = $request->customer_id;
        $account->acc_credit      = $total_amount;
        $account->acc_debit       = '';
        $account->acc_pay_date    = $request->payment_date;
        $account->acc_description = $request->description;
        $account->acc_status      = 2;
        $account->acc_submit_by   = $submit_by;
        $account->save();

        if(isset($request->discount))
        {
            $account = new IglTailorAccount();
            $account->acc_com_id       = $com;
            $account->acc_bran_id      = $bran;
            $account->acc_customer_id  = $request->customer_id;
            $account->acc_credit       = $request->discount;
            $account->acc_debit        = 0;
            $account->acc_pay_date     = $request->payment_date;
            $account->acc_description  = 'Customer Discount';
            $account->acc_status       = 3;
            $account->acc_submit_by    = $submit_by;
            $account->save();
        }

        // Bank Transcation Table
        $bankTransaction =  new IglTailorBankTransaction();
        $bankTransaction->its_bank_tran_com_id   = $com;
        $bankTransaction->its_bank_tran_bran_id  = $bran; 
        $bankTransaction->its_bank_tran_bank_id  = $request->bank_id; 
        $bankTransaction->its_bank_tran_account_no = $request->acc_no;
        $bankTransaction->its_bank_tran_debit    = 0;
        $bankTransaction->its_bank_tran_credit   = $total_amount;
        $bankTransaction->its_bank_tran_date     = $request->payment_date;
        $bankTransaction->its_bank_tran_desc	 =  $request->description;
        $bankTransaction->its_bank_tran_ref      =  1;
        $bankTransaction->its_bank_tran_submit_at = $request->payment_date;
        $bankTransaction->its_bank_tran_submit_by = $submit_by;
        $bankTransaction->save();

        if(isset($request->discount))
        {
            $bankTransaction = new IglTailorBankTransaction();
            $bankTransaction->its_bank_tran_com_id  = $com;
            $bankTransaction->its_bank_tran_bran_id = $bran;
            $bankTransaction->its_bank_tran_bank_id = $request->bank_id;
            $bankTransaction->its_bank_tran_account_no = $request->acc_no;
            $bankTransaction->its_bank_tran_debit  = 0;
            $bankTransaction->its_bank_tran_credit = $request->discount;
            $bankTransaction->its_bank_tran_date   = $request->payment_date;
            $bankTransaction->its_bank_tran_desc   = 'Customer Discount';
            $bankTransaction->its_bank_tran_ref    = 2;
            $bankTransaction->its_bank_tran_submit_at = $request->payment_date;
            $bankTransaction->its_bank_tran_submit_by = $submit_by;
            $bankTransaction->save();
        }
        // SMS Implement

        $message_send_status = Auth::user()->BranchDetailsUser->its_branch_message_status; // Branch Information
        $explode_message_status = explode(',',$message_send_status);

        $company_info = IglTailorCompany::where('its_company_com_id',$com)->first();        

        if(in_array(4, $explode_message_status) && isset($company_info->its_company_sender_id)  && isset($company_info->its_company_api_key))
        {
            $customer_info = IglTailorCustomer::where('its_cus_slno',$request->customer_id)->first();
            $due_amount = $previus_due - $total_amount;

            if(isset($request->discount)){
                $message = "Your Payment Successfully.".
                           "\nPayable Amount: " . $previus_due.".00".
                           "\nPayment Amount: " . $total_amount.".00".
                           "\nDiscount Amount: ". $request->discount.".00".
                           "\nDue Amount: "     . $due_amount.".00".
                           "\nPayment Date: "   . $request->payment_date;
            }
            else{
                $message = "Your Payment Successfully.".
                            "\nPayable Amount: ". $previus_due.".00".
                            "\nPayment Amount: ". $total_amount.".00".
                            "\nDue Amount: "    . $due_amount.".00".
                            "\nPayment Date: "  . $request->payment_date;
            }          
                       
            $message  = rawurlencode($message);
            $number   = $customer_info->its_cus_mobile;
            $senderId = $company_info->its_company_sender_id;
            $apikey   =  $company_info->its_company_api_key;
            $client = new \GuzzleHttp\Client();
            $url = "http://sms.iglweb.com/api/v1/send?api_key=".$apikey."&contacts=".$number."&senderid=".$senderId."&msg=".$message;
            $res = $client->request('GET', $url);
            $ret = $res->getBody();
        }

        
        return redirect()->back()->with('payment_success','Customer Payment');
    }
    public function CustomerStatements(){

        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;


        $customerIds = IglTailorCustomer::select('its_cus_slno','its_cus_bran_id','its_cus_name','its_cus_customer_id')
                                        ->where('its_cus_com_id',$com)
                                        ->orderBy('its_cus_slno','desc')
                                        ->get();

                                        
        $account_inform = IglTailorAccount::select('*',DB::raw('SUM(acc_credit) as total_credit'),DB::raw('SUM(acc_debit) as total_debit'))
                                           ->where('acc_com_id',$com)
                                           ->where('acc_bran_id',$bran)
                                           ->whereIn('acc_status',[1,2,3])
                                           ->get();

        return view('branch.customers.view_customer_statements',compact('customerIds','account_inform'));
    }
    public function CustomerStatementsDetails($customer_id){

        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;

        $customer_id = base64_decode($customer_id);

        $customer_info = IglTailorCustomer::select('its_cus_slno','its_cus_name')
                                            ->where('its_cus_com_id',$com)
                                            ->where('its_cus_slno',$customer_id)
                                            ->first();

        $account_infor = IglTailorAccount::where('acc_bran_id',$bran)
                                          ->where('acc_customer_id',$customer_id)
                                          ->whereIn('acc_status',[1,2,3])
                                          ->get();
                                          
        $discount_amount = IglTailorAccount::where('acc_bran_id',$bran)
                                            ->where('acc_customer_id',$customer_id)
                                            ->where('acc_status',3)
                                            ->sum('acc_credit');
            
        return view('branch.customers.view_customer_statements_details',compact('customer_info','account_infor','discount_amount'));
    }
}
