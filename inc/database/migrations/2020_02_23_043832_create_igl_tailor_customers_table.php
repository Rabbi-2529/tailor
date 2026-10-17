<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_customers', function (Blueprint $table) {
            $table->bigIncrements('its_cus_slno');
            $table->integer('its_cus_com_id');
            $table->string('its_cus_bran_id');
            $table->tinyInteger('its_cus_user_id');
            $table->tinyInteger('its_cus_customer_id');
            $table->string('its_cus_name');
            $table->string('its_cus_email')->nullable();
            $table->string('its_cus_address');
            $table->string('its_cus_mobile');
            $table->string('its_cus_blood')->nullable();
            $table->integer('its_cus_nid')->nullable();
            $table->date('its_cus_birthdate')->nullable();
            $table->string('its_cus_reference')->nullable();
            $table->tinyInteger('its_cus_status');
            $table->date('its_cus_reg_date');
            $table->string('its_cus_pic')->nullable();
            $table->unsignedInteger('its_cus_submit_by')->nullable();
            $table->dateTime('its_cus_submit_at')->nullable();
            $table->unsignedInteger('its_cus_update_by')->nullable();
            $table->dateTime('its_cus_update_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igl_tailor_customers');
    }
}
