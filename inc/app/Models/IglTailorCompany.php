<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IglTailorCompany extends Model
{
    protected $table = 'igl_tailor_companies';
    protected $fillable = 
    [
        'its_company_com_id',
        'its_company_login_id',
        'its_company_phone',
        'its_company_fax_no',
        'its_company_city',
        'its_company_zip_code',
        'its_company_business_type',
        'its_company_website',
        'its_company_open_time',
        'its_company_close_time',
        'its_company_type',
        'its_company_taxable',
        'its_company_reg_date',
        'its_company_expire_date',
        'its_company_sender_id',
        'its_company_api_key',
        'its_company_submit_by',
        'its_company_submit_at',
        'its_company_update_by',
        'its_company_update_at',
    ];
    protected $primaryKey = 'its_company_slno';
    public $incrementing = true;
    public $timestamps = false;

    public function CompanyDetails(){
        return $this->belongsTo('App\Models\IglTailorUser','its_company_login_id','its_slno');
    }
}
