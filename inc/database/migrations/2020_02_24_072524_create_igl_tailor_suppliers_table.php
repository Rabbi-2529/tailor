<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_suppliers', function (Blueprint $table) {
            $table->bigIncrements('its_sup_slno');
            $table->integer('its_sup_com_id');
            $table->integer('its_sup_bran_id');
            $table->integer('its_sup_user_id')->nullable();
            $table->integer('its_sup_sup_id');
            $table->string('its_sup_name');
            $table->string('its_sup_address');
            $table->string('its_sup_person');
            $table->string('its_sup_mobile');
            $table->string('its_sup_phone')->nullable();
            $table->string('its_sup_email')->nullable();
            $table->string('its_sup_website')->nullable();
            $table->string('its_sup_complain_number')->nullable();
            $table->string('its_sup_due_balance')->nullable();
            $table->tinyInteger('its_sup_status')->comment('1=local,2=global');
            $table->date('its_sup_date');
            $table->unsignedInteger('its_sup_submit_by')->nullable();
            $table->dateTime('its_sup_submit_at')->nullable();
            $table->unsignedInteger('its_sup_update_by')->nullable();
            $table->dateTime('its_sup_update_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igl_tailor_suppliers');
    }
}
