<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorMakerOrderInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_maker_order_information', function (Blueprint $table) {
            $table->bigIncrements('its_maker_order_slno');
            $table->unsignedInteger('its_maker_order_com_id');
            $table->unsignedInteger('its_maker_order_bran_id');
            $table->unsignedInteger('its_maker_order_user_id')->nullable();
            $table->unsignedInteger('its_maker_order_maker_slno');
            $table->unsignedInteger('its_maker_order_add_order_slno');
            $table->unsignedInteger('its_maker_order_order_id');
            $table->string('its_maker_order_maker_delivery_date');
            $table->string('its_maker_order_maker_delivery_status',10)->comment('0=received,1=complete,2=not given maker');
            $table->unsignedInteger('its_maker_order_submit_by');
            $table->unsignedInteger('its_maker_order_update_by')->nullable();
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
        Schema::dropIfExists('igl_tailor_maker_order_information');
    }
}
