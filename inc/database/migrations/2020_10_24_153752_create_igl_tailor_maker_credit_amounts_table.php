<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorMakerCreditAmountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_maker_credit_amounts', function (Blueprint $table) {
            $table->bigIncrements('its_maker_credit_slno');
            $table->unsignedInteger('its_maker_credit_com_id');
            $table->unsignedInteger('its_maker_credit_bran_id');
            $table->unsignedInteger('its_maker_credit_maker_id');
            $table->unsignedInteger('its_maker_credit_order_id');
            $table->integer('its_maker_credit_amount');
            $table->unsignedInteger('its_maker_credit_submit_by');
            $table->unsignedInteger('its_maker_credit_update_by')->nullable();
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
        Schema::dropIfExists('igl_tailor_maker_credit_amounts');
    }
}
