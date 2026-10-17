<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IglTailorPriceList extends Model
{
    protected $table = 'igl_tailor_price_lists';
    protected $fillable = 
    [
        'its_price_list_com_id',
        'its_price_list_bran_id',
        'its_price_list_shirt',
        'its_price_list_pant',
        'its_price_list_blazer',
        'its_price_list_panjabi',
        'its_price_list_payjama',
        'its_price_list_safari',
        'its_price_list_photua',
        'its_price_list_mojib_cort',
        'its_price_list_kable',
        'its_price_list_koti',
        'its_price_list_submit_at',
        'its_price_list_submit_by',
        'its_price_list_update_at',
        'its_price_list_update_by',
    ];
    protected $primaryKey = 'its_price_list_slno';
    public $incrementing = true;
    public $timestamps = false;
}
