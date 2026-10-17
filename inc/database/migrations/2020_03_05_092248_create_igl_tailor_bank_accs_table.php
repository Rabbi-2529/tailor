<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorBankAccsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_bank_accs', function (Blueprint $table) {
            $table->bigIncrements('its_bank_acc_slno');
            $table->unsignedInteger('its_bank_acc_com_id');
            $table->unsignedInteger('its_bank_acc_bran_id');
            $table->unsignedInteger('its_bank_acc_bank_name');
            $table->string('its_bank_acc_branch_name');
            $table->string('its_bank_acc_acc_no');
            $table->date('its_bank_acc_open_date');
            $table->tinyInteger('its_bank_acc_status')->default(1);
            $table->dateTime('its_bank_acc_submit_at')->nullable();
            $table->unsignedInteger('its_bank_acc_submit_by')->nullable();
            $table->dateTime('its_bank_acc_update_by')->nullable();
            $table->unsignedInteger('its_bank_acc_update_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igl_tailor_bank_accs');
    }
}
