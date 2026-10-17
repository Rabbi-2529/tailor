<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorMakersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_makers', function (Blueprint $table) {
            $table->bigIncrements('its_maker_slno');
            $table->integer('its_maker_com_id');
            $table->integer('its_maker_bran_id');
            $table->integer('its_maker_login_id');
            $table->string('its_maker_name');
            $table->string('its_maker_mobile');
            $table->date('its_maker_birth_date');
            $table->string('its_maker_nid')->nullable();
            $table->string('its_maker_image');
            $table->date('its_maker_date');
            $table->string('its_maker_ref_name')->nullable();
            $table->string('its_maker_ref_mobile')->nullable();
            $table->unsignedInteger('its_maker_submit_by')->nullable();
            $table->dateTime('its_maker_submit_at')->nullable();
            $table->unsignedInteger('its_maker_update_by')->nullable();
            $table->dateTime('its_maker_update_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igl_tailor_makers');
    }
}
