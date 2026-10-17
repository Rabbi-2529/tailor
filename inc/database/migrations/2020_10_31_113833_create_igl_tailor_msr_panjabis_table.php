<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorMsrPanjabisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_msr_panjabis', function (Blueprint $table) {
            $table->bigIncrements('its_panjabi_msr_slno');
            $table->unsignedInteger('its_panjabi_msr_com_id');
            $table->unsignedInteger('its_panjabi_msr_bran_id');
            $table->unsignedInteger('its_panjabi_msr_user_id')->nullable();
            $table->string('its_panjabi_msr_cus_mobile');
            $table->string('its_panjabi_product_name');
            $table->string('its_panjabi_product_qty');
            $table->string('its_panjabi_msr_long')->nullable();
            $table->string('its_panjabi_msr_body')->nullable();
            $table->string('its_panjabi_msr_body_loose')->nullable();
            $table->string('its_panjabi_msr_belly')->nullable();
            $table->string('its_panjabi_msr_belly_loose')->nullable();
            $table->string('its_panjabi_msr_hip')->nullable();
            $table->string('its_panjabi_msr_hip_loose')->nullable();
            $table->string('its_panjabi_msr_shoulder')->nullable();
            $table->string('its_panjabi_msr_neck')->nullable();
            $table->string('its_panjabi_msr_hand_long')->nullable();
            $table->string('its_panjabi_msr_muhuri')->nullable();
            $table->string('its_panjabi_msr_plet')->nullable();
            $table->string('its_panjabi_msr_collar_type')->nullable();
            $table->string('its_panjabi_msr_collar_size')->nullable();
            $table->string('its_panjabi_msr_pocket')->nullable();
            $table->string('its_panjabi_msr_inner_pocket')->nullable();
            $table->date('its_panjabi_msr_date');
            $table->string('its_panjabi_msr_catalog_no')->nullable();
            $table->string('its_panjabi_msr_others')->nullable();
            $table->unsignedInteger('its_panjabi_msr_submit_by')->nullable();
            $table->dateTime('its_panjabi_msr_submit_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igl_tailor_msr_panjabis');
    }
}
