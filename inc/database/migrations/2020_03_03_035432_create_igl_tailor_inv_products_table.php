<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorInvProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_inv_products', function (Blueprint $table) {
            $table->bigIncrements('its_inv_pro_slno');
            $table->unsignedInteger('its_inv_pro_com_id');
            $table->unsignedInteger('its_inv_pro_bran_id');
            $table->unsignedInteger('its_inv_pro_user_id')->nullable();
            $table->unsignedInteger('its_inv_pro_sup_id');
            $table->unsignedInteger('its_inv_pro_group');
            $table->unsignedInteger('its_inv_pro_product_name');
            $table->unsignedInteger('its_inv_pro_type');
            $table->string('its_inv_pro_buy_price');
            $table->string('its_inv_pro_sell_price');
            $table->unsignedInteger('its_inv_pro_short')->nullable();
            $table->date('its_inv_pro_reg_date');
            $table->unsignedInteger('its_inv_pro_submit_by')->nullable();
            $table->dateTime('its_inv_pro_submit_at')->nullable();
            $table->unsignedInteger('its_inv_pro_update_by')->nullable();
            $table->dateTime('its_inv_pro_update_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igl_tailor_inv_products');
    }
}
