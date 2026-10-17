<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use App\Models\IglTailorUser;
use App\Models\IglTailorBranch;
use App\Models\IglTailorCompany;
use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;

class BranchController extends Controller
{
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
    public function BranchRegistration(Request $request)
    {
        
        if(isset($request->message)){
            $message = implode(',',array_values($request->message));
        }
        else{
            $message = "";
        }

        $bran_id = IglTailorBranch::count();
        $com_id = IglTailorCompany::count();
        
        $submit_at = Carbon::now()->format('Y-m-d H:i:s');
        $submit_by = Auth::user()->its_slno;
        $reg = Carbon::now()->format('Y-m-d');
        
        $request->validate([
            'b_name' => 'required',
            'c_name' => 'required',
            'b_email' => 'required|unique:igl_tailor_users,its_email',
            'c_email' => 'required|unique:igl_tailor_users,its_email',
            'pass' => 'required|min:3|max:64',
            'mobile' => 'required',
            'c_mobile' => 'required',
            'address' => 'required',
            'person' => 'required',
            'expire' => 'required',
            'logo' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'upzila_id' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $company_registration_user = new IglTailorUser();
            $company_registration_user->its_username = $request->c_name;
            $company_registration_user->its_email = $request->c_email;
            $company_registration_user->its_password = md5($request->pass);
            $company_registration_user->its_raw_password = $request->pass;
            $company_registration_user->its_mobile = $request->c_mobile;
            $company_registration_user->its_address = $request->address;
            $company_registration_user->its_status = 1;
            $company_registration_user->its_user_type = 2;
            $company_registration_user->its_submit_by = $submit_by;
            $company_registration_user->its_submit_at = $submit_at;
            $company_registration_user->save();

            $branch_registration_user = new IglTailorUser();
            $branch_registration_user->its_username = $request->b_name;
            $branch_registration_user->its_email = $request->b_email;
            $branch_registration_user->its_password = md5($request->pass);
            $branch_registration_user->its_raw_password = $request->pass;
            $branch_registration_user->its_mobile = $request->mobile;
            $branch_registration_user->its_address = $request->address;
            $branch_registration_user->its_status = 1;
            $branch_registration_user->its_user_type = 4;
            $branch_registration_user->its_submit_by = $submit_by;
            $branch_registration_user->its_submit_at = $submit_at;
            $branch_registration_user->save();

            $company_registration = new IglTailorCompany();
            $company_registration->its_company_com_id = $com_id + 1;
            $company_registration->its_company_login_id = $company_registration_user->its_slno ;
            $company_registration->its_company_phone = $request->phone;
            $company_registration->its_company_fax_no = $request->fax;
            $company_registration->its_company_division_id = $request->division_id;
            $company_registration->its_company_district_id = $request->district_id;
            $company_registration->its_company_upzila_id = $request->upzila_id;
            $company_registration->its_company_zip_code = $request->zip;
            $company_registration->its_company_business_type = $request->b_type;
            $company_registration->its_company_website = $request->website;
            $company_registration->its_company_open_time = $request->open;
            $company_registration->its_company_close_time = $request->close;
            $company_registration->its_company_taxable = $request->tax;
            $company_registration->its_company_reg_date = $reg;
            $company_registration->its_company_expire_date = $request->expire;
            $company_registration->its_company_sender_id = $request->senderId;
            $company_registration->its_company_api_key = $request->api_key;
            $company_registration->its_company_submit_by = $submit_by;
            $company_registration->its_company_submit_at = $submit_at;
            $company_registration->save();

            $branch_registration = new IglTailorBranch();
            $branch_registration->its_branch_id = $bran_id + 1;
            $branch_registration->its_branch_login_id = $branch_registration_user->its_slno;
            $branch_registration->its_branch_com_id = $company_registration->its_company_com_id;
            $branch_registration->its_branch_phone = $request->phone;
            $branch_registration->its_branch_fax_no = $request->fax;
            $branch_registration->its_branch_division_id = $request->division_id;
            $branch_registration->its_branch_district_id = $request->district_id;
            $branch_registration->its_branch_upzila_id = $request->upzila_id;
            $branch_registration->its_branch_zip_code = $request->zip;
            if ($request->hasFile('logo')) {
                $files = $request->file('logo');
                $extension = $request->file('logo')->getClientOriginalExtension();
                $name = 'upload_' . time() . '.' . $extension;
                $destinationPath = 'assets/uploads/branch';
                $files->move($destinationPath, $name);
                $img_url = $destinationPath. "/" .$name;
            }
            $branch_registration->its_branch_com_logo = $img_url;
            $branch_registration->its_branch_taxable = $request->tax;
            $branch_registration->its_branch_business_type = $request->b_type;
            $branch_registration->its_branch_website = $request->website;
            $branch_registration->its_branch_open_time = $request->open;
            $branch_registration->its_branch_close_time = $request->close;
            $branch_registration->its_branch_reg_date = $reg;
            $branch_registration->its_branch_expire_date = $request->expire;
            $branch_registration->its_branch_sender_id = $request->senderId;
            $branch_registration->its_branch_api_key   = $request->api_key;
            $branch_registration->its_branch_message_status = $message;
            $branch_registration->its_branch_person_name = $request->person;
            $branch_registration->its_branch_order_no = $request->order;
            $branch_registration->its_branch_submit_by = $submit_by;
            $branch_registration->its_branch_submit_at = $submit_at;
            $branch_registration->save();


        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with(['err' => $e->getMessage()]);
        }
        DB::commit();

        // SMS Implement 
        
        $message = "Thanks for choosing IGL Tailor Solution.
                    \nYour Branch Registration Successfully.\nUsername:". $request->mobile ."\nPassword:".
                    $request->pass ."Login URL: http://tailor.iglweb.com/";

        $message = rawurlencode($message);
        $number  = $request->mobile;
        $senderId = "8801844532630";
        $apikey = config('services.sms.api_key');
        $client = new \GuzzleHttp\Client();
        $url = "http://sms.iglweb.com/api/v1/send?api_key=".$apikey."&contacts=".$number."&senderid=".$senderId."&msg=".$message;
        $res = $client->request('GET', $url);
        $ret = $res->getBody();

        return redirect()->back()->with(['branch' => 'Registered Successfully']);
        
    }
}
