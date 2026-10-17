<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorInvProductNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_inv_product_names', function (Blueprint $table) {
            $table->bigIncrements('its_proname_slno');
            $table->unsignedInteger('its_proname_com_id');
            $table->unsignedInteger('its_proname_bran_id');
            $table->unsignedInteger('its_proname_user_id')->nullable();
            $table->unsignedInteger('its_proname_sup_id')->nullable();
            $table->unsignedInteger('its_proname_group_id');
            $table->unsignedInteger('its_proname_type_id');
            $table->string('its_proname_product_name');
            $table->string('its_proname_product_desc');
            $table->unsignedInteger('its_proname_submit_by')->nullable();
            $table->dateTime('its_proname_submit_at')->nullable();
            $table->unsignedInteger('its_proname_update_by')->nullable();
            $table->dateTime('its_proname_update_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igl_tailor_inv_product_names');
    }
}
