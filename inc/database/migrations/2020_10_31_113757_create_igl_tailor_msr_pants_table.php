<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorMsrPantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_msr_pants', function (Blueprint $table) {
            $table->bigIncrements('its_pant_measure_slno');
            $table->unsignedInteger('its_pant_measure_com_id');
            $table->unsignedInteger('its_pant_measure_bran_id');
            $table->unsignedInteger('its_pant_measure_user_id')->nullable();
            $table->string('its_pant_measure_cus_mobile')->nullable();
            $table->string('its_pant_product_name');
            $table->string('its_pant_product_qty');
            $table->string('its_pant_measure_long')->nullable();
            $table->string('its_pant_measure_komor')->nullable();
            $table->string('its_pant_measure_hip')->nullable();
            $table->string('its_pant_measure_mohuri')->nullable();
            $table->string('its_pant_measure_thigh')->nullable();
            $table->string('its_pant_measure_high')->nullable();
            $table->string('its_pant_measure_fly')->nullable();
            $table->string('its_pant_measure_kuci')->nullable();
            $table->string('its_pant_measure_pocket_type')->nullable();
            $table->string('its_pant_measure_pocket_backside')->nullable();
            $table->string('its_pant_measure_pocket_inner')->nullable();
            $table->string('its_pant_measure_muhuri_type')->nullable();
            $table->string('its_pant_measure_loop')->nullable();
            $table->string('its_pant_measure_loop_size')->nullable();
            $table->date('its_pant_measure_date');
            $table->string('its_pant_measure_catalog_no')->nullable();
            $table->string('its_pant_measure_others')->nullable();
            $table->unsignedInteger('its_pant_measure_submit_by')->nullable();
            $table->dateTime('its_pant_measure_submit_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igl_tailor_msr_pants');
    }
}
