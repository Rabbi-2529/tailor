<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorMsrPayjamasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_msr_payjamas', function (Blueprint $table) {
            $table->bigIncrements('its_payjama_measure_slno');
            $table->unsignedInteger('its_payjama_measure_com_id');
            $table->unsignedInteger('its_payjama_measure_bran_id');
            $table->unsignedInteger('its_payjama_measure_user_id')->nullable();
            $table->string('its_payjama_measure_cus_mobile')->nullable();
            $table->string('its_payjama_product_name');
            $table->string('its_payjama_product_qty');
            $table->string('its_payjama_measure_long')->nullable();
            $table->string('its_payjama_measure_komor')->nullable();
            $table->string('its_payjama_measure_hip')->nullable();
            $table->string('its_payjama_measure_hip_loose')->nullable();
            $table->string('its_payjama_measure_muhuri')->nullable();
            $table->string('its_payjama_measure_thigh')->nullable();
            $table->string('its_payjama_measure_fly')->nullable();
            $table->string('its_payjama_measure_high')->nullable();
            $table->string('its_payjama_measure_pocket')->nullable();
            $table->date('its_payjama_measure_date');
            $table->string('its_payjama_measure_catalog_no')->nullable();
            $table->string('its_payjama_measure_others')->nullable();
            $table->unsignedInteger('its_payjama_measure_submit_by')->nullable();
            $table->dateTime('its_payjama_measure_submit_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igl_tailor_msr_payjamas');
    }
}
