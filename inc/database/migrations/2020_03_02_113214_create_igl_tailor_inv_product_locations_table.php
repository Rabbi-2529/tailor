<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorInvProductLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_inv_product_locations', function (Blueprint $table) {
            $table->bigIncrements('its_inv_proloc_slno');
            $table->unsignedInteger('its_inv_proloc_com_id');
            $table->unsignedInteger('its_inv_proloc_bran_id');
            $table->unsignedInteger('its_inv_proloc_user_id')->nullable();
            $table->unsignedInteger('its_inv_proloc_group_id');
            $table->unsignedInteger('its_inv_proloc_type_id');
            $table->unsignedInteger('its_inv_proloc_product_id');
            $table->string('its_inv_proloc_block')->nullable();
            $table->string('its_inv_proloc_self')->nullable();
            $table->dateTime('its_inv_proloc_submit_at')->nullable();
            $table->unsignedInteger('its_inv_proloc_submit_by')->nullable();
            $table->dateTime('its_inv_proloc_update_at')->nullable();
            $table->unsignedInteger('its_inv_proloc_update_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igl_tailor_inv_product_locations');
    }
}
