<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
use App\Models\IglTailorUserUser;
use App\Models\IglTailorUser;

class UserController extends Controller
{
    public function UserRegistration()
    {
        return view('branch.user.user_registration');
    }
    public function UserRegistrationInsert(Request $request){

        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_slno;

        $submit_by = Auth::user()->its_slno;
        $submit_at = Carbon::now()->format('Y-m-d H:i:s'); 
        $reg = Carbon::now()->format('Y-m-d');
        // User Serial
        $serial = IglTailorUserUser::count();

        $message = ([
            'user.required' => "You Can't Skip This Field",
            'email.required' => "You Can't Skip This Field",
            'pass.required' => "You Can't Skip This Field",
            'mobile.required' => "You Can't Skip This Field",
            'address.required' => "You Can't Skip This Field",
            'city.required' => "You Can't Skip This Field",
            'status.required' => "You Can't Skip This Field",
        ]);
        $request->validate([
            'user' => 'required',
            'email' => 'required',
            'pass' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'city' => 'required',
            'status' => 'required',
        ],$message);

        $img_url = '';

        DB::beginTransaction();
        try {
            $user_registration_user = new IglTailorUser();
            $user_registration_user->its_username = $request->user;
            $user_registration_user->its_email = $request->email;
            $user_registration_user->its_password = md5($request->pass);
            $user_registration_user->its_raw_password = $request->pass;
            $user_registration_user->its_mobile = $request->mobile;
            $user_registration_user->its_address = $request->address;
            $user_registration_user->its_status = $request->status;
            $user_registration_user->its_user_type = 5;
            $user_registration_user->its_submit_by = $submit_by;
            $user_registration_user->its_submit_at = $submit_at;
            $user_registration_user->save();

            $user_registration = new IglTailorUserUser();
            $user_registration->its_user_com_id = $com;
            $user_registration->its_user_login_id = $user_registration_user->its_slno;
            $user_registration->its_user_bran_id = $bran;
            $user_registration->its_user_user_id = $serial + 1;
            $user_registration->its_user_user_city = $request->city;
            $user_registration->its_user_zip_code = $request->zip;
            $user_registration->its_user_reg_date = $reg;

            if ($request->hasFile('logo')) {
                $files = $request->file('logo');
                $extension = $request->file('logo')->getClientOriginalExtension();
                $name = 'upload_' . time() . '.' . $extension;
                $destinationPath = 'assets/uploads/branch/user';
                $files->move($destinationPath, $name);
                $img_url = $destinationPath. "/" .$name;
            }

            $user_registration->its_user_pic = $img_url;
            $user_registration->its_user_ref_name = $request->ref_name;
            $user_registration->its_user_ref_mobile = $request->ref_mobile;
            $user_registration->its_user_status = $request->status;
            $user_registration->its_user_submit_by = $submit_by;
            $user_registration->its_user_submit_at = $submit_at;
            $user_registration->save();
        } 
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['err' => $e->getMessage()]);
        }
        DB::commit();

        return redirect()->back()->with(['user' => 'User Registered Successfully']);
    }
    public function mobile_number_exist(Request $request)
    {
        $exist_no = IglTailorUser::where('its_mobile',$request->mobile)
                                ->first();
        if (!empty($exist_no)) {
            return "true";
        }else {
            return "false";
        }
    }
    public function UserList()
    {
        $com = Auth::user()->BranchDetailsUser->its_branch_com_id;
        $bran = Auth::user()->BranchDetailsUser->its_branch_id;

        $users = IglTailorUserUser::with('UserDetailsUser')->where('its_user_com_id',$com)
                                  ->where('its_user_bran_id',$bran)
                                  ->get();
                                  
        return view('branch.user.user_list',compact('users'));
    }
    public function UserEdit($user_id)
    {
        $user_id = base64_decode($user_id);
        
        $user = IglTailorUserUser::with('UserDetailsUser')
                                  ->where('its_user_slno',$user_id)
                                  ->first();         

        return view('branch.user.user_edit',compact('user'));
    }
    public function mobile_exist_edit(Request $request)
    {
        $exist_no = IglTailorUser::where('its_slno','!=',$request->user_login_id)
                                  ->where('its_mobile',$request->mobile)
                                  ->first();
        if (!empty($exist_no)) {
            return "true";
        }else {
            return "false";
        }
    }
    public function UserRegistrationUpdate(Request $request)
    {
        $update_by = Auth::user()->its_slno;
        $update_at = Carbon::now()->format('Y-m-d H:i:s');
        $reg = Carbon::now()->format('Y-m-d');

        $message = ([
            'user.required'    => "You Can't Skip This Field",
            'email.required'   => "You Can't Skip This Field",
            'pass.required'    => "You Can't Skip This Field",
            'mobile.required'  => "You Can't Skip This Field",
            'address.required' => "You Can't Skip This Field",
            'city.required'    => "You Can't Skip This Field",
            'status.required'  => "You Can't Skip This Field",
        ]);

        $request->validate([
            'user'    => 'required',
            'email'   => 'required',
            'pass'    => 'required',
            'mobile'  => 'required',
            'address' => 'required',
            'city'    => 'required',
            'status'  => 'required',
        ],$message);

        IglTailorUser::where('its_slno',$request->user_login_id)->update([
            'its_username' => $request->user,
            'its_email' => $request->email,
            'its_password' => md5($request->pass),
            'its_raw_password' => $request->pass,
            'its_mobile' => $request->mobile,
            'its_address' => $request->address,
            'its_status' => $request->status,
            'its_update_by' => $update_by,
            'its_update_at' => $update_at,
        ]);

        IglTailorUserUser::where('its_user_login_id',$request->user_login_id)->update([
            'its_user_user_city' => $request->city,
            'its_user_zip_code' => $request->zip,
            'its_user_reg_date' => $reg,
            'its_user_ref_name' => $request->ref_name,
            'its_user_ref_mobile' => $request->ref_mobile,
            'its_user_status' => $request->status,
            'its_user_update_by' => $update_by,
            'its_user_update_at' => $update_at,
         ]);
       
        
        if ($request->hasFile('logo')) 
        {   
            // Old Picture name
            $login_pic = IglTailorUserUser::where('its_user_login_id',$request->user_login_id)->first()->its_user_pic;

            // Unlink Old Picture 
            if($login_pic != ""){
                unlink($login_pic);
            }

            $files = $request->file('logo');
            $extension = $request->file('logo')->getClientOriginalExtension();
            $name = 'upload_' . time() . '.' . $extension;
            $destinationPath = 'assets/uploads/branch/user';
            $files->move($destinationPath, $name);
            $img_url = $destinationPath. "/" .$name;

            IglTailorUserUser::where('its_user_login_id',$request->user_login_id)->update([
                'its_user_pic' => $img_url,
            ]);
        }

        return back()->with('success','User Information Update');
    }
    public function UserMenuPermission($user_slno)
    {   
        $user_slno = base64_decode($user_slno);
        $user_info = IglTailorUserUser::where('its_user_slno',$user_slno)->first();

        return view('branch.user.user_menu_permission',compact('user_slno','user_info'));
    }
    public function UserMenuPermissionInsert(Request $request)
    {   
        if(isset($request->permission_status)){
            $permission_status = implode(',',array_values($request->permission_status));
        }
        else{
            $permission_status = "";
        }
        
        IglTailorUserUser::where('its_user_slno',$request->user_slno)->update([
            'its_user_permission_status' => $permission_status,
        ]);

        return back()->with('permission','User Permission');
    }
    
    
    
}
