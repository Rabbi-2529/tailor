<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorInventoryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_inventory_details', function (Blueprint $table) {
            $table->bigIncrements('its_inv_det_slno');
            $table->unsignedInteger('its_inv_det_com_id');
            $table->unsignedInteger('its_inv_det_bran_id');
            $table->unsignedInteger('its_inv_det_user_id')->nullable();
            $table->unsignedInteger('its_inv_det_party_id')->comment('supplier_id,customer_id');
            $table->unsignedInteger('its_inv_det_pro_id')->nullable()->comment('1=shirt,2=pant,3=blazer,4=photua,5=panjabi,6=payjama,7=safari,8=mojib cort,9=kable,10=koti');
            $table->string('its_inv_det_invoice_id');
            $table->string('its_inv_det_buy_qty')->nullable();
            $table->string('its_inv_det_sell_qty')->nullable();
            $table->string('its_inv_det_buy_paid')->nullable();
            $table->string('its_inv_det_sell_paid')->nullable();
            $table->string('its_inv_det_buy_price')->nullable();
            $table->string('its_inv_det_sell_price')->nullable();
            $table->tinyInteger('its_inv_det_deal_type')->comment('1=service sell,2=service buy,3=product buy,4=product sell,5=order price,6=customer discount,7=maker bonus,8=product discount');
            $table->date('its_inv_det_entry_date');
            $table->date('its_inv_det_exp_date')->nullable();
            $table->unsignedInteger('its_inv_det_submit_by')->nullable();
            $table->dateTime('its_inv_det_submit_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igl_tailor_inventory_details');
    }
}
