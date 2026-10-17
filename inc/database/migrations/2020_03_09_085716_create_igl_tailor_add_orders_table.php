<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorAddOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_add_orders', function (Blueprint $table) {
            $table->bigIncrements('its_add_order_slno');
            $table->unsignedInteger('its_add_order_com_id');
            $table->unsignedInteger('its_add_order_bran_id');
            $table->unsignedInteger('its_add_order_user_id')->nullable();
            $table->unsignedInteger('its_add_order_cus_id');
            $table->integer('its_add_order_temp_id');
            $table->integer('its_add_order_maker_id')->nullable();
            $table->string('its_add_maker_cost_amount')->nullable();
            $table->integer('its_add_order_order_id');
            $table->string('its_add_product_name');
            $table->string('its_add_product_quantity');
            $table->string('its_add_product_price');
            $table->string('its_add_order_total_price');
            $table->date('its_add_order_receive_date');
            $table->date('its_add_order_delivery_date')->nullable();
            $table->tinyInteger('its_add_order_status')->comment('1=pending,2=receive,3=processing,4=complete,5=delivery,0=given_all_in_maker');
            $table->unsignedInteger('its_add_order_measure_id');
            // $table->string('its_add_order_bran_order')->nullable();
            $table->unsignedInteger('its_add_order_submit_by');
            $table->dateTime('its_add_order_submit_at');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igl_tailor_add_orders');
    }
}
