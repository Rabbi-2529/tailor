<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorMsrPhotuasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_msr_photuas', function (Blueprint $table) {
            $table->bigIncrements('its_photua_measure_slno');
            $table->unsignedInteger('its_photua_measure_com_id');
            $table->unsignedInteger('its_photua_measure_bran_id');
            $table->unsignedInteger('its_photua_measure_user_id')->nullable();
            $table->string('its_photua_measure_cus_mobile')->nullable();
            $table->string('its_photua_product_name');
            $table->string('its_photua_product_qty');
            $table->string('its_photua_measure_long')->nullable();
            $table->string('its_photua_measure_body')->nullable();
            $table->string('its_photua_measure_body_loose')->nullable();
            $table->string('its_photua_measure_belly')->nullable();
            $table->string('its_photua_measure_hip')->nullable();
            $table->string('its_photua_measure_shoulder')->nullable();
            $table->string('its_photua_measure_neck')->nullable();
            $table->string('its_photua_measure_hand_long')->nullable();
            $table->string('its_photua_measure_hand_moja')->nullable();
            $table->string('its_photua_measure_hand_kunu')->nullable();
            $table->string('its_photua_measure_hand_cuff')->nullable();
            $table->string('its_photua_measure_types')->nullable();
            $table->string('its_photua_measure_plet')->nullable();
            $table->string('its_photua_measure_collar')->nullable();
            $table->string('its_photua_measure_collar_size')->nullable();
            $table->string('its_photua_measure_cuff_size')->nullable();
            $table->string('its_photua_measure_pocket')->nullable();
            $table->string('its_photua_measure_pocket_inner')->nullable();
            $table->string('its_photua_measure_open')->nullable();
            $table->date('its_photua_measure_date');
            $table->string('its_photua_measure_catalog_no')->nullable();
            $table->string('its_photua_measure_others')->nullable();
            $table->dateTime('its_photua_measure_submit_at')->nullable();
            $table->unsignedInteger('its_photua_measure_submit_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igl_tailor_msr_photuas');
    }
}
