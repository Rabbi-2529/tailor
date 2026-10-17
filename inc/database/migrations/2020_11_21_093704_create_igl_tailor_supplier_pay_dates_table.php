<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorSupplierPayDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_supplier_pay_dates', function (Blueprint $table) {
            $table->bigIncrements('its_sup_pay_date_id');
            $table->unsignedInteger('its_com_id');
            $table->unsignedInteger('its_bran_id');
            $table->unsignedInteger('its_user_id')->nullable();
            $table->unsignedInteger('its_sup_id');
            $table->string('its_payment_type');
            $table->string('its_amount');
            $table->date('its_payment_date');
            $table->unsignedInteger('its_submit_by');
            $table->dateTime('its_submit_at');
            $table->unsignedInteger('its_update_by')->nullable();
            $table->dateTime('its_update_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igl_tailor_supplier_pay_dates');
    }
}
