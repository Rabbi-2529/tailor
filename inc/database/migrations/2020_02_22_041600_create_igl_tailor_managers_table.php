<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_managers', function (Blueprint $table) {
            $table->bigIncrements('its_manager_slno');
            $table->string('its_manager_phone')->nullable();
            $table->string('its_manager_fax_no')->nullable();
            $table->unsignedInteger('its_manager_submit_by')->nullable();
            $table->dateTime('its_manager_submit_at')->nullable();
            $table->unsignedInteger('its_manager_update_by')->nullable();
            $table->dateTime('its_manager_update_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igl_tailor_managers');
    }
}
