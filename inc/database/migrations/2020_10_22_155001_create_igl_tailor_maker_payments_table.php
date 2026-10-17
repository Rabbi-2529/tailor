<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorMakerPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_maker_payments', function (Blueprint $table) {
            $table->bigIncrements('its_maker_payment_slno');
            $table->unsignedInteger('its_maker_order_com_id');
            $table->unsignedInteger('its_maker_order_bran_id');
            $table->unsignedInteger('its_maker_order_user_id')->nullable();
            $table->unsignedInteger('its_maker_maker_id');
            $table->string('its_maker_debit_amount');
            $table->string('its_maker_bonus_amount')->nullable();
            $table->date('its_maker_payment_date');
            $table->text('its_maker_payment_details');
            $table->unsignedInteger('its_maker_payment_submit_by');
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
        Schema::dropIfExists('igl_tailor_maker_payments');
    }
}
