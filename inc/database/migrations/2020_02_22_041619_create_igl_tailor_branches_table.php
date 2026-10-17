<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_branches', function (Blueprint $table) {
            $table->bigIncrements('its_branch_slno');
            $table->integer('its_branch_id');
            $table->tinyInteger('its_branch_login_id');
            $table->integer('its_branch_com_id');
            $table->string('its_branch_phone')->nullable();
            $table->string('its_branch_fax_no')->nullable();
            $table->integer('its_branch_division_id');
            $table->integer('its_branch_district_id');
            $table->integer('its_branch_upzila_id');
            $table->integer('its_branch_zip_code')->nullable();
            $table->string('its_branch_com_logo')->nullable();
            $table->tinyInteger('its_branch_taxable')->nullable();
            $table->string('its_branch_business_type')->nullable();
            $table->string('its_branch_website')->nullable();
            $table->time('its_branch_open_time')->nullable();
            $table->time('its_branch_close_time')->nullable();
            $table->date('its_branch_reg_date');
            $table->date('its_branch_expire_date');
            $table->string('its_branch_sender_id')->nullable();
            $table->string('its_branch_api_key')->nullable();
            $table->string('its_branch_person_name');
            $table->integer('its_branch_order_no')->nullable();
            $table->string('its_branch_status',20)->default(1);
            $table->string('its_branch_message_status')->nullable();
            $table->unsignedInteger('its_branch_submit_by');
            $table->dateTime('its_branch_submit_at');
            $table->unsignedInteger('its_branch_update_by')->nullable();
            $table->dateTime('its_branch_update_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igl_tailor_branches');
    }
}
