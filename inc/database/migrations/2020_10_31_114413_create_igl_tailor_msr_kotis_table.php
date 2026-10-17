<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorMsrKotisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_msr_kotis', function (Blueprint $table) {
            $table->bigIncrements('its_koti_measure_slno');
            $table->unsignedInteger('its_koti_measure_com_id');
            $table->unsignedInteger('its_koti_measure_bran_id');
            $table->unsignedInteger('its_koti_measure_user_id')->nullable();
            $table->string('its_koti_measure_cus_mobile')->nullable();
            $table->string('its_koti_product_name');
            $table->string('its_koti_product_qty');
            $table->string('its_koti_measure_long')->nullable();
            $table->string('its_koti_measure_body')->nullable();
            $table->string('its_koti_measure_body_loose')->nullable();
            $table->string('its_koti_measure_belly')->nullable();
            $table->string('its_koti_measure_belly_loose')->nullable();
            $table->string('its_koti_measure_hip')->nullable();
            $table->string('its_koti_measure_hip_loose')->nullable();
            $table->string('its_koti_measure_shoulder')->nullable();
            $table->string('its_koti_measure_neck')->nullable();
            $table->string('its_koti_measure_pocket')->nullable();
            $table->string('its_koti_measure_belt')->nullable();
            $table->string('its_koti_measure_catalog_no')->nullable();
            $table->string('its_koti_measure_others')->nullable();
            $table->date('its_koti_measure_date');
            $table->dateTime('its_koti_measure_submit_at')->nullable();
            $table->unsignedInteger('its_koti_measure_submit_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igl_tailor_msr_kotis');
    }
}
