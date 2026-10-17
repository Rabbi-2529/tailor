<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IglTailorBranch extends Model
{
    protected $table = 'igl_tailor_branches';
    protected $fillable = 
    [
        'its_branch_id',
        'its_branch_login_id',
        'its_branch_com_id',
        'its_branch_phone',
        'its_branch_fax_no',
        'its_branch_city',
        'its_branch_zip_code',
        'its_branch_com_logo',
        'its_branch_taxable',
        'its_branch_business_type',
        'its_branch_website',
        'its_branch_open_time',
        'its_branch_close_time',
        'its_branch_reg_date',
        'its_branch_expire_date',
        'its_branch_sender_id',
        'its_branch_api_key',
        'its_branch_message_time',
        'its_branch_person_name',
        'its_branch_order_no',
        'its_branch_submit_by',
        'its_branch_submit_at',
        'its_branch_update_by',
        'its_branch_update_at',
    ];
    protected $primaryKey = 'its_branch_slno';
    public $incrementing = true;
    public $timestamps = false;

    public function BranchDetails(){
        return $this->belongsTo('App\Models\IglTailorUser','its_branch_login_id','its_slno');
    }
    public function CompanyDetailsBranch(){
        return $this->belongsTo('App\Models\IglTailorCompany','its_branch_com_id','its_company_slno');
    }




    
}
