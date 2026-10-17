<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IglTailorBranch;
use App\Models\IglTailorCompany;
use Carbon\Carbon;
use Auth;
class CompanyController extends Controller
{
    public function index()
    {
        $com_id = Auth::user()->CompanyDetailsUser->its_company_slno;
        $branch = IglTailorBranch::where('its_branch_com_id',$com_id)->count();

        return view('company.pages.index',compact('branch'));
    }
    public function balance(){
        return view('company.balance');
    }
    public function sms_setup(){
        return view('company.sms_setup');
    }
    public function sms_setup_insert(Request $request)
    {   
        $update_by = Auth::user()->its_slno;
        $update_at = Carbon::now()->format('Y-m-d H:i:s');

        $message = ([
            'sender_id.required' => 'Enter Your Sender ID',
            'api_key.required' => 'Enter Your API Key',
        ]);
        $request->validate([
            'sender_id' => 'required',
            'api_key'   => 'required',
        ],$message);

        IglTailorCompany::where('its_company_login_id',Auth::User()->its_slno )->update([
            'its_company_sender_id' => $request->sender_id,
            'its_company_api_key'   => $request->api_key,
            'its_company_update_by' => $update_by,
            'its_company_update_at' => $update_at,
        ]);
        
        return back()->with('sms_setup','Sms Setup');
    }
}
