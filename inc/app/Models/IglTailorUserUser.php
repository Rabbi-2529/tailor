<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IglTailorUserUser extends Model
{
    protected $table = 'igl_tailor_user_users';
    protected $fillable = 
    [
        'its_user_com_id',
        'its_user_login_id',
        'its_user_bran_id',
        'its_user_user_id',
        'its_user_user_city',
        'its_user_zip_code',
        'its_user_reg_date',
        'its_user_pic',
        'its_user_ref_name',
        'its_user_ref_mobile',
        'its_user_status',
        'its_user_permission_status',
        'its_user_submit_by',
        'its_user_submit_at',
        'its_user_update_by',
        'its_user_update_at',
    ];
    protected $primaryKey = 'its_user_slno';
    public $incrementing = true;
    public $timestamps = false;

    public function UserDetailsUser(){
        return $this->belongsTo('App\Models\IglTailorUser','its_user_login_id','its_slno');
    }

    public function BranchDetailsUserUser(){
        return $this->belongsTo('App\Models\IglTailorBranch','its_user_bran_id','its_branch_slno');
    }
    public function CompanyDetailsUserUser(){
        return $this->belongsTo('App\Models\IglTailorCompany','its_user_com_id','its_company_slno');
    }
}
