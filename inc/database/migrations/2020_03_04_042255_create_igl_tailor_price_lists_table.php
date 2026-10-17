<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorPriceListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_price_lists', function (Blueprint $table) {
            $table->bigIncrements('its_price_list_slno');
            $table->unsignedInteger('its_price_list_com_id');
            $table->unsignedInteger('its_price_list_bran_id');
            $table->unsignedInteger('its_price_list_user_id')->nullable();
            $table->string('its_price_list_shirt')->nullable();
            $table->string('its_price_list_pant')->nullable();
            $table->string('its_price_list_blazer')->nullable();
            $table->string('its_price_list_panjabi')->nullable();
            $table->string('its_price_list_payjama')->nullable();
            $table->string('its_price_list_safari')->nullable();
            $table->string('its_price_list_photua')->nullable();
            $table->string('its_price_list_mojib_cort')->nullable();
            $table->string('its_price_list_kable')->nullable();
            $table->string('its_price_list_koti')->nullable();
            $table->dateTime('its_price_list_submit_at')->nullable();
            $table->unsignedInteger('its_price_list_submit_by')->nullable();
            $table->dateTime('its_price_list_update_at')->nullable();
            $table->unsignedInteger('its_price_list_update_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igl_tailor_price_lists');
    }
}
