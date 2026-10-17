<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use App\Models\IglTailorUser;
use App\Models\IglTailorBranch;
use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;


class BranchController extends Controller
{
    public function branch_registration(){
        $divisions = Division::orderBy('name')->get();
        return view('company.branch_reg',compact('divisions'));
    }
    public function districtNameShow(Request $request)
    {
        $division_id = $request->division_id;
        $stringTOsend = "<option>Select One</option>";

        $districts = District::where('division_id',$division_id)->orderBy('name')->get();

        foreach ($districts as $district) {
            $stringTOsend .= "<option value='".$district->id."'>".$district->name."</option>";
        }
        echo $stringTOsend;
    }
    public function upazilaNameShow(Request $request)
    {
        $district_id = $request->district_id;
        $stringTOsend = "<option>Select One</option>";

        $upazilas = Upazila::where('district_id',$district_id)->orderBy('name')->get();

        foreach ($upazilas as $upazila) {
            $stringTOsend .= "<option value='".$upazila->id."'>".$upazila->name."</option>";
        }
        echo $stringTOsend;
    }
    public function BranchRegistrationInsert(Request $request)
     {
         if(isset($request->message)){
            $message = implode(',',array_values($request->message));
        }

        $com_id = Auth::user()->CompanyDetailsUser->its_company_slno;
        $bran_id = IglTailorBranch::orderBy('its_branch_id','DESC')->first();

        $submit_by = Auth::user()->its_slno;
        $submit_at = Carbon::now()->format('Y-m-d H:i:s');
        $reg = Carbon::now()->format('Y-m-d');

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:igl_tailor_users,its_email',
            'pass' => 'required|min:3|max:64',
            'mobile' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'upzila_id' => 'required',
            'address' => 'required',
            'person' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $branch_registration_user = new IglTailorUser();
            $branch_registration_user->its_username = $request->name;
            $branch_registration_user->its_email = $request->email;
            $branch_registration_user->its_password = md5($request->pass);
            $branch_registration_user->its_raw_password = $request->pass;
            $branch_registration_user->its_mobile = $request->mobile;
            $branch_registration_user->its_address = $request->address;
            $branch_registration_user->its_status = 1;
            $branch_registration_user->its_user_type = 4;
            $branch_registration_user->its_submit_by = $submit_by;
            $branch_registration_user->its_submit_at = $submit_at;
            $branch_registration_user->save();

            $branch_registration = new IglTailorBranch();
            $branch_registration->its_branch_id = $bran_id->its_branch_id + 1;
            $branch_registration->its_branch_login_id = $branch_registration_user->its_slno;
            $branch_registration->its_branch_com_id = $com_id;
            $branch_registration->its_branch_phone = $request->phone;
            $branch_registration->its_branch_fax_no = $request->fax;  
            $branch_registration->its_branch_division_id = $request->division_id;
            $branch_registration->its_branch_district_id = $request->district_id;
            $branch_registration->its_branch_upzila_id = $request->upzila_id;
            $branch_registration->its_branch_zip_code = $request->zip;
            $branch_registration->its_branch_taxable = $request->tax;
            $branch_registration->its_branch_business_type = $request->b_type;
            $branch_registration->its_branch_website = $request->website;
            $branch_registration->its_branch_open_time = $request->open;
            $branch_registration->its_branch_close_time = $request->close;
            $branch_registration->its_branch_reg_date = $reg;
            $branch_registration->its_branch_sender_id = $request->senderId;
            $branch_registration->its_branch_api_key = $request->api_key;
            $branch_registration->its_branch_message_status = $message;
            $branch_registration->its_branch_person_name = $request->person;
            $branch_registration->its_branch_order_no = $request->order;
            $branch_registration->its_branch_submit_by = $submit_by;
            $branch_registration->its_branch_submit_at = $submit_at;
            $branch_registration->save();

        } 
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with(['err' => $e->getMessage()]);
        }
        DB::commit();
        
        // SMS Integration
        $message = "Thanks for choosing IGL Tailor Solution.
                    \nYour Branch Registration Successfully.\nUsername:". $request->mobile ."\nPassword:". $request->pass;

        $message = rawurlencode($message);
        $number = $request->mobile;
        $senderId = "8801844532630";
        $apikey = config('services.sms.api_key');
        $client = new \GuzzleHttp\Client();
        $url = "http://sms.iglweb.com/api/v1/send?api_key=".$apikey."&contacts=".$number."&senderid=".$senderId."&msg=".$message;
        
        $res = $client->request('GET', $url);
        $ret = $res->getBody();


        return redirect()->back()->with(['branch' => 'Branch Registered Successfully']);
     }
     public function mobile_number_exist(Request $request){
        $exist_no = IglTailorUser::where('its_mobile',$request->mobile)
                                ->first();
        if (!empty($exist_no)) {
            return "true";
        }else {
            return "false";
        }
     }
    public function branch_list(){
        $com_id = Auth::user()->CompanyDetailsUser->its_company_slno;

        $branches = IglTailorBranch::with('BranchDetails')
                                    ->where('its_branch_com_id',$com_id)
                                    ->get();

        return view('company.branch_list',compact('branches'));
    }
}
