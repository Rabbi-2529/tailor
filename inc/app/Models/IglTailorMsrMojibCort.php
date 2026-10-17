<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IglTailorMsrMojibCort extends Model
{
    protected $fillable = 
    [
        'its_mojibcort_measure_com_id',
        'its_mojibcort_measure_bran_id',
        'its_mojibcort_measure_user_id',
        'its_mojibcort_measure_cus_mobile',
        'its_mojibcort_measure_long',
        'its_mojibcort_measure_body',
        'its_mojibcort_measure_body_loose',
        'its_mojibcort_measure_belly',
        'its_mojibcort_measure_belly_loose',
        'its_mojibcort_measure_hip',
        'its_mojibcort_measure_hip_loose',
        'its_mojibcort_measure_shoulder',
        'its_mojibcort_measure_neck',
        'its_mojibcort_measure_collar',
        'its_mojibcort_measure_pocket',
        'its_mojibcort_measure_inner_pocket',
        'its_mojibcort_measure_open',
        'its_mojibcort_measure_catalog_no',
        'its_mojibcort_measure_others',
        'its_mojibcort_measure_date',
        'its_mojibcort_measure_submit_by',
        'its_mojibcort_measure_submit_at',
    ];
    protected $primaryKey = 'its_mojibcort_measure_slno';
    public $incrementing = true;
    public $timestamps = false;
}
