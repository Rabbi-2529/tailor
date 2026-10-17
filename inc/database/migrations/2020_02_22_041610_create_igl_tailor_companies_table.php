<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_companies', function (Blueprint $table) {
            $table->bigIncrements('its_company_slno');
            $table->integer('its_company_com_id');
            $table->tinyInteger('its_company_login_id');
            $table->string('its_company_phone')->nullable();
            $table->string('its_company_fax_no')->nullable();
            $table->integer('its_company_division_id');
            $table->integer('its_company_district_id');
            $table->integer('its_company_upzila_id');
            $table->integer('its_company_zip_code')->nullable();
            $table->string('its_company_business_type')->nullable();
            $table->string('its_company_website')->nullable();
            $table->time('its_company_open_time')->nullable();
            $table->time('its_company_close_time')->nullable();
            $table->string('its_company_type')->nullable();
            $table->unsignedInteger('its_company_taxable')->nullable();
            $table->date('its_company_reg_date');
            $table->date('its_company_expire_date');
            $table->string('its_company_sender_id')->nullable();
            $table->string('its_company_api_key')->nullable();
            $table->string('its_company_status',20)->default(1);
            $table->unsignedInteger('its_company_submit_by')->nullable();
            $table->dateTime('its_company_submit_at')->nullable();
            $table->unsignedInteger('its_company_update_by')->nullable();
            $table->dateTime('its_company_update_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igl_tailor_companies');
    }
}
