<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorMsrKablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_msr_kables', function (Blueprint $table) {
            $table->bigIncrements('its_kable_measure_slno');
            $table->unsignedInteger('its_kable_measure_com_id');
            $table->unsignedInteger('its_kable_measure_bran_id');
            $table->unsignedInteger('its_kable_measure_user_id')->nullable();
            $table->string('its_kable_measure_cus_mobile')->nullable();
            $table->string('its_kable_product_name');
            $table->string('its_kable_product_qty');
            $table->string('its_kable_measure_long')->nullable();
            $table->string('its_kable_measure_body')->nullable();
            $table->string('its_kable_measure_body_loose')->nullable();
            $table->string('its_kable_measure_belly')->nullable();
            $table->string('its_kable_measure_belly_loose')->nullable();
            $table->string('its_kable_measure_hip')->nullable();
            $table->string('its_kable_measure_hip_loose')->nullable();
            $table->string('its_kable_measure_shoulder')->nullable();
            $table->string('its_kable_measure_neck')->nullable();
            $table->string('its_kable_measure_hand_long')->nullable();
            $table->string('its_kable_measure_muhuri')->nullable();
            $table->string('its_kable_measure_plet')->nullable();
            $table->string('its_kable_measure_collar_type')->nullable();
            $table->string('its_kable_measure_collar_size')->nullable();
            $table->string('its_kable_measure_pocket')->nullable();
            $table->date('its_kable_measure_date');
            $table->string('its_kable_measure_catalog_no')->nullable();
            $table->string('its_kable_measure_others')->nullable();
            $table->unsignedInteger('its_kable_measure_submit_by')->nullable();
            $table->dateTime('its_kable_measure_submit_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igl_tailor_msr_kables');
    }
}
