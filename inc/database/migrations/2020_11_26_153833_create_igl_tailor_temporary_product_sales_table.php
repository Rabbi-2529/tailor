<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorTemporaryProductSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_temporary_product_sales', function (Blueprint $table) {
            $table->bigIncrements('its_tem_pro_sale_slno');
            $table->integer('its_com_id');
            $table->integer('its_bran_id');
            $table->integer('its_user_id')->nullable();
            $table->integer('its_supplier_id')->nullable();
            $table->string('its_sale_invoice_no')->nullable();
            $table->integer('its_product_id');
            $table->string('its_price')->nullable();
            $table->string('its_qty')->nullable();
            $table->string('its_total_price')->nullable();
            $table->boolean('status')->comment('1=product_buy, 2=product_sale');
            $table->unsignedInteger('its_submit_by');
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
        Schema::dropIfExists('igl_tailor_temporary_product_sales');
    }
}
