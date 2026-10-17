<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorMakerPaymentModesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_maker_payment_modes', function (Blueprint $table) {
            $table->bigIncrements('payemnt_mode_slno');
            $table->unsignedInteger('payment_mode_com_id');
            $table->unsignedInteger('payment_mode_bran_id');
            $table->unsignedInteger('payment_mode_user_id')->nullable();
            $table->integer('payment_mode_maker_pay_id');
            $table->integer('payment_mode_maker_id');
            $table->integer('payment_mode_bank_id');
            $table->integer('payment_mode_bank_acc_id');
            $table->date('payment_mode_submit_date');
            $table->integer('payment_mode_submit_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igl_tailor_maker_payment_modes');
    }
}
