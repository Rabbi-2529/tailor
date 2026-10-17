<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_accounts', function (Blueprint $table) {
            $table->bigIncrements('acc_slno');
            $table->unsignedInteger('acc_com_id');
            $table->unsignedInteger('acc_bran_id');
            $table->unsignedInteger('acc_user_id')->nullable();
            $table->string('acc_ord_id')->nullable()->comment('order_id,Invoice_no');
            $table->unsignedInteger('acc_customer_id')->comment('customer_id,maker_id,supplier_id');
            $table->integer('acc_credit')->nullable();
            $table->integer('acc_debit')->nullable();
            $table->date('acc_pay_date')->nullable();
            $table->text('acc_description')->nullable();
            $table->string('acc_deal_type')->default(1);
            $table->string('acc_status')->comment('1=customer_buy,2=collection(customer),3=customer_discount,4=maker,5=maker_bonus,6=supplier,7=supplier_discount,8=other_cost');
            $table->unsignedInteger('acc_submit_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igl_tailor_accounts');
    }
}
