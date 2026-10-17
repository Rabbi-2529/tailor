<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorBankTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_bank_transactions', function (Blueprint $table) {
            $table->bigIncrements('its_bank_tran_slno');
            $table->unsignedInteger('its_bank_tran_com_id');
            $table->unsignedInteger('its_bank_tran_bran_id');
            $table->unsignedInteger('its_bank_tran_user_id')->nullable();
            $table->unsignedInteger('its_bank_tran_bank_id');
            $table->string('its_bank_tran_account_no');
            $table->string('its_bank_tran_debit')->default(0);
            $table->string('its_bank_tran_credit');
            $table->date('its_bank_tran_date');
            $table->string('its_bank_tran_desc')->nullable();
            $table->string('its_bank_tran_ref')->nullable()->comment('1=collect(customer),2=customer_discount,3=supplier,4=supplier_discount,5=bank_deposit,6=bank_withdraw,7=maker,8=maker_discount');
            $table->dateTime('its_bank_tran_submit_at')->nullable();
            $table->unsignedInteger('its_bank_tran_submit_by')->nullable();
            $table->dateTime('its_bank_tran_update_at')->nullable();
            $table->unsignedInteger('its_bank_tran_update_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igl_tailor_bank_transactions');
    }
}
