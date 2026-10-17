<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IglTailorManager extends Model
{
    protected $table = 'igl_tailor_managers';
    protected $fillable = 
    [
        'its_manager_id',
        'its_manager_phone',
        'its_manager_fax_no',
        'its_manager_submit_by',
        'its_manager_submit_at',
        'its_manager_update_by',
        'its_manager_update_at',
    ];
    protected $primaryKey = 'its_manager_slno';
    public $incrementing = true;
    public $timestamps = false;
}
