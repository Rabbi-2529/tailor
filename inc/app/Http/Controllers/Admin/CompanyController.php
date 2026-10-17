<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Models\IglTailorUser;
use App\Models\IglTailorCompany;

class CompanyController extends Controller
{
    /* ============================================================
     |  REGISTRATION
     ============================================================ */
    public function CompanyRegistration(Request $request)
    {
        $submit_at = Carbon::now()->format('Y-m-d H:i:s');
        $com_id    = IglTailorCompany::count();
        $submit_by = Auth::user()->its_slno;
        $reg       = Carbon::now()->format('Y-m-d');

        $request->validate([
            'company'     => 'required',
            'email'       => 'required|unique:igl_tailor_users,its_email',
            'pass'        => 'required|min:5|max:64',
            'mobile'      => 'required|unique:igl_tailor_users,its_mobile',
            'address'     => 'required',
            'expire'      => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'upzila_id'   => 'required',
        ]);

        try {
            $company_registration_user = new IglTailorUser();
            $company_registration_user->its_username      = $request->company;
            $company_registration_user->its_email         = $request->email;
            $company_registration_user->its_password      = md5($request->pass);
            $company_registration_user->its_raw_password  = $request->pass;
            $company_registration_user->its_mobile        = $request->mobile;
            $company_registration_user->its_address       = $request->address;
            $company_registration_user->its_status        = 1;
            $company_registration_user->its_user_type     = 2;
            $company_registration_user->its_submit_by     = $submit_by;
            $company_registration_user->its_submit_at     = $submit_at;
            $company_registration_user->save();

            $company_registration = new IglTailorCompany();
            $company_registration->its_company_com_id        = $com_id + 1;
            $company_registration->its_company_login_id      = $company_registration_user->its_slno;
            $company_registration->its_company_phone         = $request->phone;
            $company_registration->its_company_fax_no        = $request->fax;
            $company_registration->its_company_division_id   = $request->division_id;
            $company_registration->its_company_district_id   = $request->district_id;
            $company_registration->its_company_upzila_id     = $request->upzila_id;
            $company_registration->its_company_zip_code      = $request->zip;
            $company_registration->its_company_business_type = $request->b_type;
            $company_registration->its_company_website       = $request->website;
            $company_registration->its_company_open_time     = $request->open;
            $company_registration->its_company_close_time    = $request->close;
            $company_registration->its_company_type          = $request->c_type;
            $company_registration->its_company_taxable       = $request->tax;
            $company_registration->its_company_reg_date      = $reg;
            $company_registration->its_company_expire_date   = $request->expire;
            $company_registration->its_company_sender_id     = $request->sender_id;
            $company_registration->its_company_api_key       = $request->api_key;
            $company_registration->its_company_submit_by     = $submit_by;
            $company_registration->its_company_submit_at     = $submit_at;
            $company_registration->save();

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with(['err' => $e->getMessage()]);
        }

        // SMS
        $message = "Thanks for choosing IGL Tailor Solution.
                    \nYour Company Registration Successfully.\nUsername:" . $request->mobile . "\nPassword:" .
                    $request->pass . "Login URL: http://tailor.iglweb.com/";
        $message  = rawurlencode($message);
        $number   = $request->mobile;
        $senderId = "8801844532630";
        $apikey   = config('services.sms.api_key');
        $client   = new \GuzzleHttp\Client();
        $url      = "http://sms.iglweb.com/api/v1/send?api_key=" . $apikey . "&contacts=" . $number . "&senderid=" . $senderId . "&msg=" . $message;
        $res      = $client->request('GET', $url);
        $ret      = $res->getBody();

        return redirect()->back()->with(['company' => 'Company Registered Successfully']);
    }

    /* ============================================================
     |  MOBILE EXIST
     ============================================================ */
    public function mobile_number_exist(Request $request)
    {
        $exist_no = IglTailorUser::where('its_mobile', $request->mobile)->first();
        return !empty($exist_no) ? "true" : "false";
    }

    /* ============================================================
     |  AJAX — Load company data for edit modal
     ============================================================ */
    public function CompanyEditAjax(Request $request)
    {
        $user = IglTailorUser::with('CompanyDetailsUser')
                    ->where('its_user_type', 2)
                    ->where('its_slno', $request->id)
                    ->first();

        if (!$user) {
            return response()->json(['status' => false, 'msg' => 'Company not found']);
        }

        $company = $user->CompanyDetailsUser;

        return response()->json([
            'status' => true,
            'data'   => [
                'user_id'     => $user->its_slno,
                'company'     => $user->its_username,
                'email'       => $user->its_email,
                'mobile'      => $user->its_mobile,
                'address'     => $user->its_address,

                'phone'       => $company?->its_company_phone,
                'fax'         => $company?->its_company_fax_no,
                'website'     => $company?->its_company_website,
                'zip'         => $company?->its_company_zip_code,
                'division_id' => $company?->its_company_division_id,
                'district_id' => $company?->its_company_district_id,
                'upzila_id'   => $company?->its_company_upzila_id,
                'b_type'      => $company?->its_company_business_type,
                'c_type'      => $company?->its_company_type,
                'open'        => $company?->its_company_open_time,
                'close'       => $company?->its_company_close_time,
                'tax'         => $company?->its_company_taxable,
                'expire'      => $company?->its_company_expire_date,
                'sender_id'   => $company?->its_company_sender_id,
                'api_key'     => $company?->its_company_api_key,
            ],
        ]);
    }

    /* ============================================================
     |  UPDATE — Save edited company
     ============================================================ */
    public function CompanyUpdate(Request $request)
    {
        $request->validate([
            'user_id'     => 'required|exists:igl_tailor_users,its_slno',
            'company'     => 'required',
            'email'       => 'required|unique:igl_tailor_users,its_email,' . $request->user_id . ',its_slno',
            'mobile'      => 'required|unique:igl_tailor_users,its_mobile,' . $request->user_id . ',its_slno',
            'address'     => 'required',
            'expire'      => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'upzila_id'   => 'required',
        ]);

        $submit_at = Carbon::now()->format('Y-m-d H:i:s');
        $submit_by = Auth::user()->its_slno;

        try {
            /* ---- Update USER ---- */
            $user = IglTailorUser::findOrFail($request->user_id);
            $user->its_username = $request->company;
            $user->its_email    = $request->email;
            $user->its_mobile   = $request->mobile;
            $user->its_address  = $request->address;

            if ($request->filled('pass')) {
                $user->its_password     = md5($request->pass);
                $user->its_raw_password = $request->pass;
            }

            $user->its_submit_by = $submit_by;
            $user->its_submit_at = $submit_at;
            $user->save();

            /* ---- Update / create COMPANY DETAILS ---- */
            $company = IglTailorCompany::firstOrNew([
                'its_company_login_id' => $user->its_slno
            ]);

            if (!$company->exists) {
                $company->its_company_com_id = IglTailorCompany::count() + 1;
            }

            $company->its_company_phone         = $request->phone;
            $company->its_company_fax_no        = $request->fax;
            $company->its_company_division_id   = $request->division_id;
            $company->its_company_district_id   = $request->district_id;
            $company->its_company_upzila_id     = $request->upzila_id;
            $company->its_company_zip_code      = $request->zip;
            $company->its_company_business_type = $request->b_type;
            $company->its_company_website       = $request->website;
            $company->its_company_open_time     = $request->open;
            $company->its_company_close_time    = $request->close;
            $company->its_company_type          = $request->c_type;
            $company->its_company_taxable       = $request->tax;
            $company->its_company_expire_date   = $request->expire;
            $company->its_company_sender_id     = $request->sender_id;
            $company->its_company_api_key       = $request->api_key;
            $company->its_company_submit_by     = $submit_by;
            $company->its_company_submit_at     = $submit_at;
            $company->save();

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with(['err' => $e->getMessage()]);
        }

        return redirect()->route('admin.company-list')
                         ->with(['company_updated' => 'Company updated successfully']);
    }
}