<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorMsrShirtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_msr_shirts', function (Blueprint $table) {
            $table->bigIncrements('its_shirt_msr_slno');
            $table->unsignedInteger('its_shirt_msr_com_id');
            $table->unsignedInteger('its_shirt_msr_bran_id');
            $table->unsignedInteger('its_shirt_msr_user_id')->nullable();
            $table->string('its_shirt_msr_cus_mobile')->nullable();
            $table->string('its_shirt_product_name');
            $table->string('its_shirt_product_qty');
            $table->string('its_shirt_msr_long')->nullable();
            $table->string('its_shirt_msr_body')->nullable();
            $table->string('its_shirt_msr_body_loose')->nullable();
            $table->string('its_shirt_msr_bally')->nullable();
            $table->string('its_shirt_msr_bally_loose')->nullable();
            $table->string('its_shirt_msr_hip')->nullable();
            $table->string('its_shirt_msr_hip_loose')->nullable();
            $table->string('its_shirt_msr_shoulder')->nullable();
            $table->string('its_shirt_msr_neck')->nullable();
            $table->string('its_shirt_msr_hand_long')->nullable();
            $table->string('its_shirt_msr_hand_moja')->nullable();
            $table->string('its_shirt_msr_hand_kunu')->nullable();
            $table->string('its_shirt_msr_hand_cuff')->nullable();
            $table->string('its_shirt_msr_types')->nullable();
            $table->string('its_shirt_msr_plet')->nullable();
            $table->string('its_shirt_msr_collar')->nullable();
            $table->string('its_shirt_msr_collar_size')->nullable();
            $table->string('its_shirt_msr_cuff_size')->nullable();
            $table->string('its_shirt_msr_pocket')->nullable();
            $table->string('its_shirt_msr_pocket_inner')->nullable();
            $table->date('its_shirt_msr_date')->nullable();
            $table->string('its_shirt_msr_catalog_no')->nullable();
            $table->string('its_shirt_msr_others')->nullable();
            $table->dateTime('its_shirt_msr_submit_at')->nullable();
            $table->unsignedInteger('its_shirt_msr_submit_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igl_tailor_msr_shirts');
    }
}
