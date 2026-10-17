<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\IglTailorUser;
use App\Models\IglTailorCompany;
use App\Models\IglTailorBranch;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('login');
    }

    public function processLogin(Request $request)
    {

        $request->validate([
            'email' => 'required:email',
            'pass' => 'required|min:4'
        ]);

        $current_date = Carbon::now()->format('Y-m-d');

        $user = IglTailorUser::where('its_email',$request->email)
                              ->orWhere('its_mobile',$request->email)
                              ->where('its_raw_password',$request->pass)->first();

        if(!empty($user)){

            Auth::login($user);
            
            if (Auth::user()->its_user_type == 1) {
                return redirect()->route('admin.dash')->with(['admin' => 'Welcome To IGL Tailor Solution']);
            }
            elseif (Auth::user()->its_user_type == 2) 
            {
                $company_info = IglTailorCompany::where('its_company_login_id',Auth::user()->its_slno)->first();

                // Admin Create Company Login Condition
                if($company_info->its_company_status == 2){
                    Auth::logout();
                    return redirect()->route('login')->with(['err' => 'Your Company Suspend']);
                }
                else{
                    if($company_info->its_company_expire_date >= $current_date){
                        return redirect()->route('company.dashboard')->with(['company' => 'Welcome To IGL Tailor Solution']);
                    }
                    else{
                        Auth::logout();
                        return redirect()->route('login')->with(['err' => 'You Are Licence Expired']);
                    }
                }
            }
            elseif (Auth::user()->its_user_type == 4) 
            {
                $branch_info = IglTailorBranch::where('its_branch_login_id',Auth::user()->its_slno)->first();

                // Company Create Branch Login Condition
                if($branch_info->its_branch_expire_date == ""){

                    $expire_date = IglTailorCompany::where('its_company_slno',$branch_info->its_branch_com_id)->first()->its_company_expire_date;   

                    if($expire_date >= $current_date){
                        return redirect()->route('branch.dashboard')->with(['branch' => 'Welcome To IGL Tailor Solution']);
                    }
                    else{
                        Auth::logout();
                        return redirect()->route('login')->with(['err' => 'Your Company Licence Expired']);
                    }
                }
                else
                { 
                    // Admin Create Branch Login Condition
                    if($branch_info->its_branch_status == 2)
                    {   
                        Auth::logout();
                        return redirect()->route('login')->with(['err' => 'Your Branch Suspend']);
                    }
                    else{
                        if(isset($branch_info->its_branch_expire_date) && $branch_info->its_branch_expire_date >= $current_date){
                            return redirect()->route('branch.dashboard')->with(['branch' => 'Welcome To IGL Tailor Solution']);
                        }
                        else{
                            Auth::logout();
                            return redirect()->route('login')->with(['err' => 'You Are Licence Expired']);
                        }
                    }
                }
            }
            elseif (Auth::user()->its_user_type == 5) 
            {
                // Branch Create User Login Condition
                if($user->its_status == 1){
                    return redirect()->route('user.dashboard')->with(['user' => 'Welcome To IGL Tailor Solution']);
                }
                elseif($user->its_status == 0){
                    Auth::logout();
                    return redirect()->route('login')->with(['err' => 'You Are Inactive']);
                }
            }
            elseif (Auth::user()->its_user_type == 6) {
                return redirect()->route('user.dashboard')->with(['user' => 'Welcome To IGL Tailor Solution']);
            }
        }
        else {
            return redirect()->back()->with(['err' => 'Information Wrong']);
        }
        
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with(['logout' => 'You Are Logged Out!']);
    }
}
