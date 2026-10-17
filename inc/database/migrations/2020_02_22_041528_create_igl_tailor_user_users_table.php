<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorUserUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_user_users', function (Blueprint $table) {
            $table->bigIncrements('its_user_slno');
            $table->integer('its_user_com_id');
            $table->tinyInteger('its_user_login_id');
            $table->tinyInteger('its_user_bran_id');
            $table->tinyInteger('its_user_user_id');
            $table->string('its_user_user_city');
            $table->unsignedInteger('its_user_zip_code')->nullable();
            $table->dateTime('its_user_reg_date');
            $table->string('its_user_pic')->nullable();
            $table->string('its_user_ref_name')->nullable();
            $table->string('its_user_ref_mobile')->nullable();
            $table->string('its_user_status',20);
            $table->string('its_user_permission_status',150)->nullable();
            $table->unsignedInteger('its_user_submit_by')->nullable();
            $table->dateTime('its_user_submit_at')->nullable();
            $table->unsignedInteger('its_user_update_by')->nullable();
            $table->dateTime('its_user_update_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igl_tailor_user_users');
    }
}
