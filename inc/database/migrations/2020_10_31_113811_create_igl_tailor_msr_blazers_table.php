<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorMsrBlazersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_msr_blazers', function (Blueprint $table) {
            $table->bigIncrements('its_blazer_measure_slno');
            $table->unsignedInteger('its_blazer_measure_com_id');
            $table->unsignedInteger('its_blazer_measure_bran_id');
            $table->unsignedInteger('its_blazer_measure_user_id')->nullable();
            $table->string('its_blazer_measure_cus_mobile')->nullable();
            $table->string('its_blazer_product_name');
            $table->string('its_blazer_product_qty');
            $table->string('its_blazer_measure_long')->nullable();
            $table->string('its_blazer_measure_body')->nullable();
            $table->string('its_blazer_measure_belly')->nullable();
            $table->string('its_blazer_measure_hip')->nullable();
            $table->string('its_blazer_measure_shoulder')->nullable();
            $table->string('its_blazer_measure_hand_long')->nullable();
            $table->string('its_blazer_measure_hand_muhuri')->nullable();
            $table->string('its_blazer_measure_cross_back')->nullable();
            $table->string('its_blazer_measure_button_num')->nullable();
            $table->string('its_blazer_measure_nepel')->nullable();
            $table->string('its_blazer_measure_side')->nullable();
            $table->string('its_blazer_measure_catalog_no')->nullable();
            $table->string('its_blazer_measure_others')->nullable();
            $table->date('its_blazer_measure_date');
            $table->string('its_blazer_measure_best')->nullable();
            $table->string('its_blazer_measure_under')->nullable();
            $table->unsignedInteger('its_blazer_measure_submit_by')->nullable();
            $table->dateTime('its_blazer_measure_submit_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igl_tailor_msr_blazers');
    }
}
