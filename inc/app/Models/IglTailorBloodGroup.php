<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IglTailorBloodGroup extends Model
{
    protected $table = 'igl_tailor_blood_groups';
    protected $fillable = 
    [
        'its_blood_group'
    ];
    protected $primaryKey = 'its_blood_slno';
    public $incrementing = true;
    public $timestamps = false;
}
