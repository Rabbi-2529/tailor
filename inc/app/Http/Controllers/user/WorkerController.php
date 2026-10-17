<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IglTailorMakerOrderInformation;
use App\Models\IglTailorUser;
use App\Models\IglTailorMaker;
use App\Models\IglTailorAccount;
use App\Models\IglTailorBankAcc;
use App\Models\IglTailorAddOrder;
use App\Models\IglTailorWorkerSalary;
use App\Models\IglTailorMakerPayment;
use App\Models\IglTailorMakerCreditAmount;
use App\Models\IglTailorMakerPaymentMode;
use App\Models\IglTailorBankTransaction;
use App\Models\IglTailorUserUser;
use Carbon\Carbon;
use Session;
use Auth;

class WorkerController extends Controller
{
    public function MakerRegistration(){
        return view('user.worker.maker_registration');
    }

    public function MakerRegistrationInsert(Request $request)
    {
        $submit_by = Auth::user()->its_slno;
        $submit_at = Carbon::now()->format('Y-m-d H:i:s');
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $com = Auth::user()->UserDetails->its_user_com_id;
        $date = Carbon::now()->format('Y-m-d');
        $message = ([
            'name.required' => 'Name Field is Required',
            'email.required' => 'Email Field is Required',
            'mobile.required' => 'Mobile Field is Required',
            'pass.required' => 'Password Field is Required',
            'birth.required' => 'Birth-Date Field is Required',
            'address.required' => 'Address Field is Required',
            'image.required' => 'Image Field is Required',
        ]);
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'pass' => 'required',
            'birth' => 'required',
            'address' => 'required',
            'image' => 'required',
        ],$message);
        try {
            $maker_registration_user = new IglTailorUser();
            $maker_registration_user->its_username = $request->name;
            $maker_registration_user->its_email = $request->email;
            $maker_registration_user->its_password = md5($request->pass);
            $maker_registration_user->its_raw_password = $request->pass;
            $maker_registration_user->its_mobile = $request->mobile;
            $maker_registration_user->its_address = $request->address;
            $maker_registration_user->its_status = 1;
            $maker_registration_user->its_user_type = 6;
            $maker_registration_user->its_submit_by = $submit_by;
            $maker_registration_user->its_submit_at = $submit_at;
            $maker_registration_user->save();

            $maker_registration = new IglTailorMaker();
            $maker_registration->its_maker_com_id = $com;
            $maker_registration->its_maker_bran_id = $bran;
            $maker_registration->its_maker_login_id = $maker_registration_user->its_slno;
            $maker_registration->its_maker_name = $request->name;
            $maker_registration->its_maker_mobile = $request->mobile;
            $maker_registration->its_maker_birth_date = $request->birth;
            $maker_registration->its_maker_nid = $request->nid;
            if ($request->hasFile('image')) {
                $files = $request->file('image');
                $extension = $request->file('image')->getClientOriginalExtension();
                $name = 'upload_' . time() . '.' . $extension;
                $destinationPath = 'assets/uploads/maker';
                $files->move($destinationPath, $name);
                $img_url = $destinationPath. "/" .$name;
            }
            $maker_registration->its_maker_image = $img_url;
            $maker_registration->its_maker_date = $date;
            $maker_registration->its_maker_ref_name = $request->ref_name;
            $maker_registration->its_maker_ref_mobile = $request->ref_mobile;
            $maker_registration->its_maker_submit_by = $submit_by;
            $maker_registration->its_maker_submit_at = $submit_at;
            $maker_registration->save();
        } catch (\Exception $e) {
            return redirect()->back()->with(['err' => $e->getMessage()]);
        }
        return redirect()->back()->with(['maker' => 'Maker Registered Successfully']);
    }

    public function MakerPayment()
    {
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $com = Auth::user()->UserDetails->its_user_com_id;
        $current_date = Carbon::now()->format('Y-m-d');

        $banks = IglTailorBankAcc::with('bankName')->where('its_bank_acc_com_id',$com)
                                  ->where('its_bank_acc_bran_id',$bran)
                                  ->get();

        $maker_payments = IglTailorMakerCreditAmount::with('maker_name')
                                                    ->where('its_maker_credit_bran_id',$bran)
                                                    ->orderBy('its_maker_credit_slno','desc')
                                                    ->groupBy('its_maker_credit_maker_id')
                                                    ->get();

        return view('user.worker.maker_payment',compact('maker_payments','current_date','banks'));
    }
    public function MakerPayableAmount(Request $request)
    {
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $com = Auth::user()->UserDetails->its_user_com_id;
        
        $its_maker_credit_amount = IglTailorMakerCreditAmount::where('its_maker_credit_com_id',$com)
                                                             ->where('its_maker_credit_bran_id',$bran)
                                                             ->where('its_maker_credit_maker_id',$request->maker_credit_maker_id)
                                                             ->sum('its_maker_credit_amount'); 

        if(IglTailorMakerPayment::where('its_maker_order_bran_id',$bran)->where('its_maker_maker_id',$request->maker_credit_maker_id)->exists())
        {
            $maker_payment_amount = IglTailorMakerPayment::where('its_maker_order_com_id',$com)
                                                         ->where('its_maker_order_bran_id',$bran)
                                                         ->where('its_maker_maker_id',$request->maker_credit_maker_id)
                                                         ->sum('its_maker_debit_amount');
            
            return $its_maker_credit_amount - $maker_payment_amount;
        } 
        else 
        {
            return $its_maker_credit_amount;
        }
    }
    public function MakerPaymentInsert(Request $request)
    {
        $request->validate([
            'maker_credit_maker_id' => 'required',
            'payment_amount' => 'required',
            'bank_id'        => 'required',
            'acc_no'         => 'required',
            'payment_date'   => 'required',
            'description'    => 'required',
        ]);

        $com = Auth::user()->UserDetails->its_user_com_id;
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $user = Auth::user()->UserDetails->its_user_user_id;
        $submit_by = Auth::user()->its_slno;


        $last_insert_id = IglTailorMakerPayment::insertGetId([
            'its_maker_order_com_id'      => $com,
            'its_maker_order_bran_id'     => $bran,
            'its_maker_order_user_id'     => $user,
            'its_maker_maker_id'          => $request->maker_credit_maker_id,
            'its_maker_debit_amount'      => $request->payment_amount,
            'its_maker_bonus_amount'      => $request->bonus_amount,
            'its_maker_payment_date'      => $request->payment_date,
            'its_maker_payment_details'   => $request->description,
            'its_maker_payment_submit_by' => $submit_by,
            'created_at'                  => Carbon::now(),
        ]);

        IglTailorMakerPaymentMode::insert([
            'payment_mode_com_id'       => $com,
            'payment_mode_bran_id'      => $bran,
            'payment_mode_user_id'      => $user,
            'payment_mode_maker_pay_id' => $last_insert_id,
            'payment_mode_maker_id'     => $request->maker_credit_maker_id,
            'payment_mode_bank_id'      => $request->bank_id,
            'payment_mode_bank_acc_id'  => $request->acc_no,
            'payment_mode_submit_date'  => $request->payment_date,
            'payment_mode_submit_by'    => $submit_by,
        ]);

        $account = new IglTailorAccount();
        $account->acc_com_id      = $com;
        $account->acc_bran_id     = $bran;
        $account->acc_user_id     = $user;
        $account->acc_customer_id = $request->maker_credit_maker_id;
        $account->acc_credit      = '';
        $account->acc_debit       = $request->payment_amount;
        $account->acc_pay_date    = $request->payment_date;
        $account->acc_description = $request->description;
        $account->acc_status      = 4;
        $account->acc_submit_by   = $submit_by;
        $account->save();

        if (isset($request->bonus_amount)) {
            $account = new IglTailorAccount();
            $account->acc_com_id      = $com;
            $account->acc_bran_id     = $bran;
            $account->acc_user_id     = $user;
            $account->acc_customer_id = $request->maker_credit_maker_id;
            $account->acc_credit      = '';
            $account->acc_debit       = $request->bonus_amount;
            $account->acc_pay_date    = $request->payment_date;
            $account->acc_description = 'Maker Bonus';
            $account->acc_status      = 5;
            $account->acc_submit_by   = $submit_by;
            $account->save();
        } 

        $bankTransaction = new IglTailorBankTransaction();
        $bankTransaction->its_bank_tran_com_id = $com;
        $bankTransaction->its_bank_tran_bran_id = $bran;
        $bankTransaction->its_bank_tran_user_id = $user;
        $bankTransaction->its_bank_tran_bank_id = $request->bank_id;
        $bankTransaction->its_bank_tran_account_no = $request->acc_no;
        $bankTransaction->its_bank_tran_debit = $request->payment_amount;
        $bankTransaction->its_bank_tran_credit = 0;
        $bankTransaction->its_bank_tran_date = $request->payment_date;
        $bankTransaction->its_bank_tran_desc = $request->description;
        $bankTransaction->its_bank_tran_ref = 7;
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
            $bankTransaction->its_bank_tran_account_no = $request->acc_no;
            $bankTransaction->its_bank_tran_debit = $request->bonus_amount;
            $bankTransaction->its_bank_tran_credit = 0;
            $bankTransaction->its_bank_tran_date = $request->payment_date;
            $bankTransaction->its_bank_tran_desc = 'Maker Bonus';
            $bankTransaction->its_bank_tran_ref = 8;
            $bankTransaction->its_bank_tran_submit_at = $request->payment_date;
            $bankTransaction->its_bank_tran_submit_by = $submit_by;
            $bankTransaction->save();
        }

       return back()->with('payment_success','Maker Payment Successfully');
    }
    public function MakerPendingPayment(){

        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $com = Auth::user()->UserDetails->its_user_com_id;
        
        $start_date = Carbon::now()->startOfMonth()->toDateString();
        $end_date = Carbon::now()->endOfMonth()->toDateString();

        $makers_infom = IglTailorMaker::select('its_maker_slno','its_maker_name','its_maker_mobile')
                                        ->where('its_maker_com_id',$com)
                                        ->where('its_maker_bran_id',$bran)
                                        ->orderBy('its_maker_slno','desc')
                                        ->get();

        return view('user.worker.maker_pending_payment',compact('start_date','end_date','makers_infom'));
    }
    public function searchMakerPendingPayment(Request $request)
    {
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $com = Auth::user()->UserDetails->its_user_com_id;

        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $maker_slno = $request->maker_slno;

        $makers_infom = IglTailorMaker::select('its_maker_slno','its_maker_name','its_maker_mobile')
                                        ->where('its_maker_com_id',$com)
                                        ->where('its_maker_bran_id',$bran)
                                        ->orderBy('its_maker_slno','desc')
                                        ->get();
        
        $shirt_complete = IglTailorAddOrder::where('its_add_order_maker_id',$request->maker_slno)
                          ->where('its_add_product_name','Shirt')->whereIn('its_add_order_status',[4,5])
                          ->where('its_add_order_receive_date','>=',$request->start_date)->where('its_add_order_receive_date','<=',$request->end_date)
                          ->get();

        $shirt_incomplete = IglTailorAddOrder::where('its_add_order_maker_id',$request->maker_slno)
                          ->where('its_add_product_name','Shirt')->where('its_add_order_status',3)
                          ->where('its_add_order_receive_date','>=',$request->start_date)->where('its_add_order_receive_date','<=',$request->end_date)
                          ->get();
        
        $pant_complete = IglTailorAddOrder::where('its_add_order_maker_id',$request->maker_slno)
                          ->where('its_add_product_name','Pant')->whereIn('its_add_order_status',[4,5])
                          ->where('its_add_order_receive_date','>=',$request->start_date)->where('its_add_order_receive_date','<=',$request->end_date)
                          ->get();
                          
        $pant_incomplete = IglTailorAddOrder::where('its_add_order_maker_id',$request->maker_slno)
                          ->where('its_add_product_name','Pant')->where('its_add_order_status',3)
                          ->where('its_add_order_receive_date','>=',$request->start_date)->where('its_add_order_receive_date','<=',$request->end_date)
                          ->get();

        $blazer_complete = IglTailorAddOrder::where('its_add_order_maker_id',$request->maker_slno)
                          ->where('its_add_product_name','Blazer')->whereIn('its_add_order_status',[4,5])
                          ->where('its_add_order_receive_date','>=',$request->start_date)->where('its_add_order_receive_date','<=',$request->end_date)
                          ->get();
                          
        $blazer_incomplete = IglTailorAddOrder::where('its_add_order_maker_id',$request->maker_slno)
                          ->where('its_add_product_name','Blazer')->where('its_add_order_status',3)
                          ->where('its_add_order_receive_date','>=',$request->start_date)->where('its_add_order_receive_date','<=',$request->end_date)
                          ->get();
                          
                          
        $panjabi_complete = IglTailorAddOrder::where('its_add_order_maker_id',$request->maker_slno)
                          ->where('its_add_product_name','Panjabi')->whereIn('its_add_order_status',[4,5])
                          ->where('its_add_order_receive_date','>=',$request->start_date)->where('its_add_order_receive_date','<=',$request->end_date)
                          ->get();
                          
        $panjabi_incomplete = IglTailorAddOrder::where('its_add_order_maker_id',$request->maker_slno)
                          ->where('its_add_product_name','Panjabi')->where('its_add_order_status',3)
                          ->where('its_add_order_receive_date','>=',$request->start_date)->where('its_add_order_receive_date','<=',$request->end_date)
                          ->get();
                          
        $payjama_complete = IglTailorAddOrder::where('its_add_order_maker_id',$request->maker_slno)
                          ->where('its_add_product_name','Payjama')->whereIn('its_add_order_status',[4,5])
                          ->where('its_add_order_receive_date','>=',$request->start_date)->where('its_add_order_receive_date','<=',$request->end_date)
                          ->get();
                          
        $payjama_incomplete = IglTailorAddOrder::where('its_add_order_maker_id',$request->maker_slno)
                          ->where('its_add_product_name','Payjama')->where('its_add_order_status',3)
                          ->where('its_add_order_receive_date','>=',$request->start_date)->where('its_add_order_receive_date','<=',$request->end_date)
                          ->get();
                          
                          
        $safari_complete = IglTailorAddOrder::where('its_add_order_maker_id',$request->maker_slno)
                          ->where('its_add_product_name','Safari')->whereIn('its_add_order_status',[4,5])
                          ->where('its_add_order_receive_date','>=',$request->start_date)->where('its_add_order_receive_date','<=',$request->end_date)
                          ->get();
                          
        $safari_incomplete = IglTailorAddOrder::where('its_add_order_maker_id',$request->maker_slno)
                          ->where('its_add_product_name','Safari')->where('its_add_order_status',3)
                          ->where('its_add_order_receive_date','>=',$request->start_date)->where('its_add_order_receive_date','<=',$request->end_date)
                          ->get();
                          
        $photua_complete = IglTailorAddOrder::where('its_add_order_maker_id',$request->maker_slno)
                          ->where('its_add_product_name','Photua')->whereIn('its_add_order_status',[4,5])
                          ->where('its_add_order_receive_date','>=',$request->start_date)->where('its_add_order_receive_date','<=',$request->end_date)
                          ->get();
                          
        $photua_incomplete = IglTailorAddOrder::where('its_add_order_maker_id',$request->maker_slno)
                          ->where('its_add_product_name','Photua')->where('its_add_order_status',3)
                          ->where('its_add_order_receive_date','>=',$request->start_date)->where('its_add_order_receive_date','<=',$request->end_date)
                          ->get();
                          
                    
        $mojibcort_complete = IglTailorAddOrder::where('its_add_order_maker_id',$request->maker_slno)
                          ->where('its_add_product_name','Mojib Cort')->whereIn('its_add_order_status',[4,5])
                          ->where('its_add_order_receive_date','>=',$request->start_date)->where('its_add_order_receive_date','<=',$request->end_date)
                          ->get();
                          
        $mojibcort_incomplete = IglTailorAddOrder::where('its_add_order_maker_id',$request->maker_slno)
                          ->where('its_add_product_name','Mojib Cort')->where('its_add_order_status',3)
                          ->where('its_add_order_receive_date','>=',$request->start_date)->where('its_add_order_receive_date','<=',$request->end_date)
                          ->get();
                          
                          
        $kable_complete = IglTailorAddOrder::where('its_add_order_maker_id',$request->maker_slno)
                          ->where('its_add_product_name','Kable')->whereIn('its_add_order_status',[4,5])
                          ->where('its_add_order_receive_date','>=',$request->start_date)->where('its_add_order_receive_date','<=',$request->end_date)
                          ->get();
                          
        $kable_incomplete = IglTailorAddOrder::where('its_add_order_maker_id',$request->maker_slno)
                          ->where('its_add_product_name','Kable')->where('its_add_order_status',3)
                          ->where('its_add_order_receive_date','>=',$request->start_date)->where('its_add_order_receive_date','<=',$request->end_date)
                          ->get();
                          
                          
        $koti_complete = IglTailorAddOrder::where('its_add_order_maker_id',$request->maker_slno)
                          ->where('its_add_product_name','Koti')->whereIn('its_add_order_status',[4,5])
                          ->where('its_add_order_receive_date','>=',$request->start_date)->where('its_add_order_receive_date','<=',$request->end_date)
                          ->get();
                          
        $koti_incomplete = IglTailorAddOrder::where('its_add_order_maker_id',$request->maker_slno)
                          ->where('its_add_product_name','Koti')->where('its_add_order_status',3)
                          ->where('its_add_order_receive_date','>=',$request->start_date)->where('its_add_order_receive_date','<=',$request->end_date)
                          ->get();
                          
        $maker_payment_paid = IglTailorMakerPayment::where('its_maker_maker_id',$request->maker_slno)->sum('its_maker_debit_amount');
        $maker_bonus = IglTailorMakerPayment::where('its_maker_maker_id',$request->maker_slno)->sum('its_maker_bonus_amount');
                  
        return view('user.worker.maker_pending_payment',compact('start_date','end_date','makers_infom','shirt_complete',
        'shirt_incomplete','pant_complete','pant_incomplete','blazer_complete','blazer_incomplete','panjabi_complete','panjabi_incomplete',
        'payjama_complete','payjama_incomplete','safari_complete','safari_incomplete','photua_complete','photua_incomplete','maker_bonus',
        'mojibcort_complete','mojibcort_incomplete','kable_complete','kable_incomplete','koti_complete','koti_incomplete','maker_slno','maker_payment_paid'));

    }
    public function Statement()
    {
        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $com = Auth::user()->UserDetails->its_user_com_id;
       
        $makers_infom = IglTailorMaker::select('its_maker_slno','its_maker_name','its_maker_mobile')
                                        ->where('its_maker_com_id',$com)
                                        ->where('its_maker_bran_id',$bran)
                                        ->orderBy('its_maker_slno','desc')
                                        ->get();    
                       
        return view('user.worker.statement',compact('makers_infom'));
    }
    public function StatementView($maker_slno)
    {
        $maker_slno = base64_decode($maker_slno);

        $bran = Auth::user()->UserDetails->its_user_bran_id;
        $com = Auth::user()->UserDetails->its_user_com_id;

        $maker_name = IglTailorMaker::where('its_maker_slno',$maker_slno)->first();

        $maker_accounting = IglTailorAccount::where('acc_customer_id',$maker_slno)
                                            ->where('acc_status',4)
                                            ->get();

        $maker_bonus = IglTailorAccount::where('acc_customer_id',$maker_slno)
                                        ->where('acc_status',5)
                                        ->sum('acc_debit');
                                    
        return view('user.worker.statement_view',compact('maker_accounting','maker_name','maker_bonus'));
    }
    public function StatementDetails($maker_slno,$order_id){
       
        $maker_slno = base64_decode($maker_slno);
        $order_id = base64_decode($order_id);;

        $maker_info = IglTailorMaker::select('its_maker_slno','its_maker_name')
                                    ->where('its_maker_slno',$maker_slno)
                                    ->first();

        $maker_order_infor = IglTailorAddOrder::where('its_add_order_order_id',$order_id)
                                              ->whereIn('its_add_order_status',[4,5])
                                              ->get();

        

        return view('user.worker.statement_details',compact('maker_order_infor','maker_info','order_id'));
    }
}
