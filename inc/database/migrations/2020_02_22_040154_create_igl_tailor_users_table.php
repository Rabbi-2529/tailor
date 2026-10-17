<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_users', function (Blueprint $table) {
            $table->bigIncrements('its_slno');
            $table->string('its_username');
            $table->string('its_email');
            $table->string('its_password');
            $table->string('its_raw_password');
            $table->string('its_mobile');
            $table->string('its_address');
            $table->unsignedInteger('its_status')->default('1');
            $table->tinyInteger('its_user_type')->comment('1=root,2=company,3=manager,4=branch,5=user');
            $table->unsignedInteger('its_submit_by')->nullable();
            $table->dateTime('its_submit_at')->nullable();
            $table->unsignedInteger('its_update_by')->nullable();
            $table->dateTime('its_update_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igl_tailor_users');
    }
}
