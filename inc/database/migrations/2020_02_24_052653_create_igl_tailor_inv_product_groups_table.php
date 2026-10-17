<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorInvProductGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_inv_product_groups', function (Blueprint $table) {
            $table->bigIncrements('its_inv_progrp_slno');
            $table->integer('its_inv_progrp_com_id');
            $table->integer('its_inv_progrp_bran_id');
            $table->integer('its_inv_progrp_user_id')->nullable();
            $table->string('its_inv_progrp_name');
            $table->date('its_inv_progrp_regdate');
            $table->unsignedInteger('its_inv_progrp_submit_by')->nullable();
            $table->dateTime('its_inv_progrp_submit_at')->nullable();
            $table->unsignedInteger('its_inv_progrp_update_by')->nullable();
            $table->dateTime('its_inv_progrp_update_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igl_tailor_inv_product_groups');
    }
}
