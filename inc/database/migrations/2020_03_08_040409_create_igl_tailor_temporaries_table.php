<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorTemporariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_temporaries', function (Blueprint $table) {
            $table->bigIncrements('its_temp_slno');
            $table->unsignedInteger('its_temp_com_id');
            $table->unsignedInteger('its_temp_bran_id');
            $table->unsignedInteger('its_temp_user_id')->nullable();
            $table->string('its_temp_service');
            $table->string('its_temp_pname');
            $table->string('its_temp_price');
            $table->string('its_temp_total_price');
            $table->string('its_temp_qty');
            $table->string('its_temp_order_id')->nullable();
            $table->string('its_temp_customer_id')->nullable();
            $table->unsignedInteger('its_temp_submit_by')->nullable();
            $table->dateTime('its_temp_submit_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igl_tailor_temporaries');
    }
}
