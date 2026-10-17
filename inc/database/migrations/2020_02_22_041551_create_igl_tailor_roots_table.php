<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorRootsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_roots', function (Blueprint $table) {
            $table->bigIncrements('its_root_slno');
            $table->tinyInteger('its_root_login_id');
            $table->string('its_root_phone')->nullable();
            $table->string('its_root_faxno')->nullable();
            $table->string('its_root_lastloginip');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igl_tailor_roots');
    }
}
