<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class IglTailorUser extends Authenticatable
{
    protected $fillable = 
    [
        'its_username',
        'its_email',
        'its_password',
        'its_raw_password',
        'its_mobile',
        'its_address',
        'its_status',
        'its_user_type',
        'its_submit_by',
        'its_submit_at',
        'its_update_by',
        'its_update_at',
    ];
    protected $dates = 
    [
        'its_submit_at',
        'its_update_at'
    ];
    protected $primaryKey = 'its_slno';
    protected $table = 'igl_tailor_users';
    public $incrementing = true;
    public $timestamps = false;

    public function CompanyDetailsUser(){
        return $this->hasOne('App\Models\IglTailorCompany','its_company_login_id','its_slno');
    }
    public function BranchDetailsUser(){
        return $this->hasOne('App\Models\IglTailorBranch','its_branch_login_id','its_slno');
    }

    public function UserDetails(){
        return $this->hasOne('App\Models\IglTailorUserUser','its_user_login_id','its_slno');
    }

    public function WorkerDetails(){
        return $this->hasOne('App\Models\IglTailorMaker','its_maker_login_id','its_slno');
    }

    

    

}
