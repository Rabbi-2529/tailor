<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorInvProductTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_inv_product_types', function (Blueprint $table) {
            $table->bigIncrements('its_protype_slno');
            $table->unsignedInteger('its_protype_com_id');
            $table->unsignedInteger('its_protype_bran_id');
            $table->unsignedInteger('its_protype_user_id')->nullable();
            $table->unsignedInteger('its_protype_group_id');
            $table->string('its_protype_name');
            $table->date('its_protype_date');
            $table->unsignedInteger('its_protype_submit_by')->nullable();
            $table->dateTime('its_protype_submit_at')->nullable();
            $table->unsignedInteger('its_protype_update_by')->nullable();
            $table->dateTime('its_protype_update_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igl_tailor_inv_product_types');
    }
}
