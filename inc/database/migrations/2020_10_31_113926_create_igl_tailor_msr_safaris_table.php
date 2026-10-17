<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorMsrSafarisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_msr_safaris', function (Blueprint $table) {
            $table->bigIncrements('its_safari_measure_slno');
            $table->unsignedInteger('its_safari_measure_com_id');
            $table->unsignedInteger('its_safari_measure_bran_id');
            $table->unsignedInteger('its_safari_measure_user_id')->nullable();
            $table->string('its_safari_measure_cus_mobile')->nullable();
            $table->string('its_safari_product_name');
            $table->string('its_safari_product_qty');
            $table->string('its_safari_measure_long')->nullable();
            $table->string('its_safari_measure_body')->nullable();
            $table->string('its_safari_measure_body_loose')->nullable();
            $table->string('its_safari_measure_belly')->nullable();
            $table->string('its_safari_measure_belly_loose')->nullable();
            $table->string('its_safari_measure_hip')->nullable();
            $table->string('its_safari_measure_hip_loose')->nullable();
            $table->string('its_safari_measure_shoulder')->nullable();
            $table->string('its_safari_measure_cross_back')->nullable();
            $table->string('its_safari_measure_neck')->nullable();
            $table->string('its_safari_measure_hand_long')->nullable();
            $table->string('its_safari_measure_hand_cuff')->nullable();
            $table->string('its_safari_measure_plet')->nullable();
            $table->string('its_safari_measure_collar')->nullable();
            $table->string('its_safari_measure_collar_size')->nullable();
            $table->string('its_safari_measure_pocket')->nullable();
            $table->string('its_safari_measure_back_side')->nullable();
            $table->string('its_safari_measure_inner_pocket')->nullable();
            $table->string('its_safari_measure_type')->nullable();
            $table->date('its_safari_measure_date');
            $table->string('its_safari_measure_catalog_no')->nullable();
            $table->string('its_safari_measure_others')->nullable();
            $table->unsignedInteger('its_safari_measure_submit_by')->nullable();
            $table->dateTime('its_safari_measure_submit_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igl_tailor_msr_safaris');
    }
}
