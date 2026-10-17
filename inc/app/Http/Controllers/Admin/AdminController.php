<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IglTailorUser;
use App\Models\IglTailorCompany;
use App\Models\IglTailorBranch;
use App\Models\Division;
use Carbon\Carbon;
use Auth;

class AdminController extends Controller
{
    public function index()
    {
        $company_count = IglTailorCompany::all()->count();
        $branch_count = IglTailorBranch::all()->count();
        
        $companies = IglTailorCompany::with('CompanyDetails')->get();

        // foreach($companies as $company)
        // {
        //     $year = explode('-',$company->its_company_expire_date)[0];
        //     $month = explode('-',$company->its_company_expire_date)[1];
        //     $date = explode('-',$company->its_company_expire_date)[2];

        //     $substring_day = $date - 7;
        //     $final_date = $year.'-'.$month.'-'.$substring_day;
            
        //     if($final_date == Carbon::now()->format('Y-m-d')){

        //         // SMS Implement 
        //         $message = "Thanks for choosing IGL Tailor Solution.
        //                     \nYour Company Registration Expiry After 7 Days.";

                        
        //         $message = rawurlencode($message);
        //         $number  = $company->CompanyDetails->its_mobile;
        //         $senderId = "8801844532630";
        //         $apikey = config('services.sms.api_key');
        //         $client = new \GuzzleHttp\Client();
        //         $url = "http://sms.iglweb.com/api/v1/send?api_key=".$apikey."&contacts=".$number."&senderid=".$senderId."&msg=".$message;
        //         $res = $client->request('GET', $url);
        //         $ret = $res->getBody();
        //     }
        // }

        return view('admin.pages.index',compact('company_count','branch_count'));
    }
    public function company_registration()
    {
        $divisions = Division::orderBy('name')->get();
        return view('admin.company_registration',compact('divisions'));
    }
    public function comapny_list()
    {   
        $current_date = Carbon::now()->format('Y-m-d');
        $companies = IglTailorUser::where('its_user_type',2)->get();

        return view('admin.company_list',compact('companies','current_date'));
    }
    public function company_suspend_unsuspend(Request $request)
    {
        $company_status = IglTailorCompany::select('its_company_login_id','its_company_status')
                                            ->where('its_company_login_id',$request->company_id)
                                            ->first();

        $login_information = IglTailorUser::where('its_slno',$request->company_id)->first();

        if($company_status->its_company_status == 1){
            IglTailorCompany::where('its_company_login_id',$request->company_id)->update([
                'its_company_status' => 2,
                'its_company_update_by' => Auth::User()->its_slno,
                'its_company_update_at' => Carbon::now(),
            ]);

            // SMS Implement 
            $message = "Thanks for choosing IGL Tailor Solution.
                        \nYour Company Suspend.";
                    
            $message = rawurlencode($message);
            $number  = $login_information->its_mobile;
            $senderId = "8801844532630";
            $apikey = config('services.sms.api_key');
            $client = new \GuzzleHttp\Client();
            $url = "http://sms.iglweb.com/api/v1/send?api_key=".$apikey."&contacts=".$number."&senderid=".$senderId."&msg=".$message;
            $res = $client->request('GET', $url);
            $ret = $res->getBody();    

            return back()->with('suspend','Company Suspend Successfully');
        }
        else{
            IglTailorCompany::where('its_company_login_id',$request->company_id)->update([
                'its_company_status' => 1,
                'its_company_update_by' => Auth::User()->its_slno,
                'its_company_update_at' => Carbon::now(),
            ]);

            // SMS Implement 
            $message = "Thanks for choosing IGL Tailor Solution.
                        \nYour Company Continue.";

                    
            $message = rawurlencode($message);
            $number  = $login_information->its_mobile;
            $senderId = "8801844532630";
            $apikey = config('services.sms.api_key');
            $client = new \GuzzleHttp\Client();
            $url = "http://sms.iglweb.com/api/v1/send?api_key=".$apikey."&contacts=".$number."&senderid=".$senderId."&msg=".$message;
            $res = $client->request('GET', $url);
            $ret = $res->getBody();    
    
            return back()->with('unsuspend','Company Continue Successfully');
        }
        
    }
    public function company_active(Request $request)
    {
        $login_information = IglTailorUser::where('its_slno',$request->company_id)->first();
        
        IglTailorCompany::where('its_company_login_id',$request->company_id)->update([
            'its_company_expire_date' => $request->expired_date,
            'its_company_update_by' => Auth::User()->its_slno,
            'its_company_update_at' => Carbon::now(),
        ]);
        
        // SMS Implement 
        $message = "Thanks for choosing IGL Tailor Solution.
                    \nYour Company Active.".
                    "\nActive Date: ".Carbon::now()->format('Y-m-d').
                    "\nExpiry Date: ".$request->expired_date;
                
        $message = rawurlencode($message);
        $number  = $login_information->its_mobile;
        $senderId = "8801844532630";
        $apikey = config('services.sms.api_key');
        $client = new \GuzzleHttp\Client();
        $url = "http://sms.iglweb.com/api/v1/send?api_key=".$apikey."&contacts=".$number."&senderid=".$senderId."&msg=".$message;
        $res = $client->request('GET', $url);
        $ret = $res->getBody();  

        return back()->with('company_active','Company Active Successfully');
    }
    public function branch_registration()
    {
        $divisions = Division::orderBy('name')->get();
        return view('admin.branch_registration',compact('divisions'));
    }
    public function branch_list()
    {
        $current_date = Carbon::now()->format('Y-m-d');
        $branches = IglTailorUser::with('BranchDetailsUser')->where('its_user_type',4)->get();

        return view('admin.branch_list',compact('branches','current_date'));
    }
    public function branch_suspend_unsuspend(Request $request)
    {
        $branch_status = IglTailorBranch::select('its_branch_login_id','its_branch_status')
                                    ->where('its_branch_login_id',$request->branch_id)
                                    ->first();

        $login_information = IglTailorUser::where('its_slno',$request->branch_id)->first();

        if($branch_status->its_branch_status == 1){

            IglTailorBranch::where('its_branch_login_id',$request->branch_id)->update([
                'its_branch_status' => 2,
                'its_branch_update_by' => Auth::User()->its_slno,
                'its_branch_update_at' => Carbon::now(),
            ]);

            // SMS Implement 
            $message = "Thanks for choosing IGL Tailor Solution.
                        \nYour Branch Suspend.";
                    
            $message = rawurlencode($message);
            $number  = $login_information->its_mobile;
            $senderId = "8801844532630";
            $apikey = config('services.sms.api_key');
            $client = new \GuzzleHttp\Client();
            $url = "http://sms.iglweb.com/api/v1/send?api_key=".$apikey."&contacts=".$number."&senderid=".$senderId."&msg=".$message;
            $res = $client->request('GET', $url);
            $ret = $res->getBody();   

            return back()->with('suspend','Branch Suspend Successfully');
        }
        else{
            IglTailorBranch::where('its_branch_login_id',$request->branch_id)->update([
                'its_branch_status' => 1,
                'its_branch_update_by' => Auth::User()->its_slno,
                'its_branch_update_at' => Carbon::now(),
            ]);

            // SMS Implement 
            $message = "Thanks for choosing IGL Tailor Solution.
                        \nYour Branch Continue.";
                    
            $message = rawurlencode($message);
            $number  = $login_information->its_mobile;
            $senderId = "8801844532630";
            $apikey = config('services.sms.api_key');
            $client = new \GuzzleHttp\Client();
            $url = "http://sms.iglweb.com/api/v1/send?api_key=".$apikey."&contacts=".$number."&senderid=".$senderId."&msg=".$message;
            $res = $client->request('GET', $url);
            $ret = $res->getBody(); 

            return back()->with('unsuspend','Branch Continue Successfully');
        }
    }
    public function branch_active(Request $request)
    {
        $login_information = IglTailorUser::where('its_slno',$request->branch_id)->first();

        IglTailorBranch::where('its_branch_login_id',$request->branch_id)->update([
            'its_branch_expire_date' => $request->expired_date,
        ]);

        // SMS Implement 
        $message = "Thanks for choosing IGL Tailor Solution.
                    \nYour Branch Active.".
                    "\nActive Date: ".Carbon::now()->format('Y-m-d').
                    "\nExpiry Date: ".$request->expired_date;
                
        $message = rawurlencode($message);
        $number  = $login_information->its_mobile;
        $senderId = "8801844532630";
        $apikey = config('services.sms.api_key');
        $client = new \GuzzleHttp\Client();
        $url = "http://sms.iglweb.com/api/v1/send?api_key=".$apikey."&contacts=".$number."&senderid=".$senderId."&msg=".$message;
        $res = $client->request('GET', $url);
        $ret = $res->getBody();   

        return back()->with('branch_active','Branch Active Successfully');
    }
}
