<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IglTailorMaker extends Model
{
    protected $fillable = 
    [
        'its_maker_com_id',
        'its_maker_bran_id',
        'its_maker_login_id',
        'its_maker_name',
        'its_maker_birth_date',
        'its_maker_nid',
        'its_maker_image',
        'its_maker_date',
        'its_maker_ref_name',
        'its_maker_ref_mobile',
        'its_maker_submit_by',
        'its_maker_submit_at',
        'its_maker_update_by',
        'its_maker_update_at'
    ];
    protected $table = 'igl_tailor_makers';
    protected $primaryKey = 'its_maker_slno';
    public $incrementing = true;
    public $timestamps = false;

    public function WorkerDetailsUser(){
        return $this->belongsTo('App\Models\IglTailorUser','its_maker_login_id','its_slno');
    }

    public function maker_credit_amount(){
        return $this->belongsTo(IglTailorMakerCreditAmount::Class,'its_maker_slno','its_maker_credit_maker_id');
    }
    public function maker_payment_amount(){
        return $this->hasMany(IglTailorMakerPayment::Class,'its_maker_maker_id');
    }



}
