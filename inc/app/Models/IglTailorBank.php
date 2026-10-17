<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IglTailorBank extends Model
{
    protected $table = 'igl_tailor_banks';
    protected $fillable = 
    [
        'its_bank_name',
        'its_bank_status'
    ];
    protected $primaryKey = 'its_bank_slno';
    public $incrementing = true;
    public $timestamps = false;
}
