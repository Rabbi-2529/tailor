<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorOrderStatusChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_order_status_checks', function (Blueprint $table) {
            $table->bigIncrements('its_order_status_slno');
            $table->unsignedInteger('its_com_id');
            $table->unsignedInteger('its_bran_id');
            $table->unsignedInteger('its_user_id')->nullable();
            $table->integer('its_order_id')->nullable();
            $table->integer('its_order_id_wat')->nullable();
            $table->unsignedInteger('its_submit_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igl_tailor_order_status_checks');
    }
}
