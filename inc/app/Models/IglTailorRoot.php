<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IglTailorRoot extends Model
{
    protected $table = 'igl_tailor_roots';
    protected $filliable = 
    [
        'its_root_id',
        'its_root_login_id',
        'its_root_phone',
        'its_root_faxno',
        'its_root_lastloginip',
    ];
    protected $primaryKey = 'its_root_slno';
    public $incrementing = true;
    public $timestamps = false;
}
