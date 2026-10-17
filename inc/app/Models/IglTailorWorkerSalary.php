<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IglTailorWorkerSalary extends Model
{
    protected $table = 'igl_tailor_worker_salaries';
    protected $fillable = 
    [
        'its_worker_com_id',
        'its_worker_bran_id',
        'its_worker_shirt',
        'its_worker_pant',
        'its_worker_blazer',
        'its_worker_panjabi',
        'its_worker_payjama',
        'its_worker_safari',
        'its_worker_photua',
        'its_worker_mojib_cort',
        'its_worker_kable',
        'its_worker_koti',
        'its_worker_submit_by',
        'its_worker_submit_at',
        'its_worker_update_by',
        'its_worker_update_at',
    ];
    protected $primaryKey = 'its_worker_slno';
    public $incrementing = true;
    public $timestamps = false;
}
