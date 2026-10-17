<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorSupplierBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_supplier_banks', function (Blueprint $table) {
            $table->bigIncrements('its_supbank_slno');
            $table->string('its_branch_name');
            $table->integer('its_sup_id');
            $table->integer('its_bank_id');
            $table->string('its_bank_acc_name');
            $table->string('its_acc_no');
            $table->unsignedInteger('its_submit_by')->nullable();
            $table->dateTime('its_submit_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igl_tailor_supplier_banks');
    }
}
