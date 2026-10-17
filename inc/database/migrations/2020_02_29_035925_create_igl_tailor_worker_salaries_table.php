<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorWorkerSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_worker_salaries', function (Blueprint $table) {
            $table->bigIncrements('its_worker_slno');
            $table->integer('its_worker_com_id');
            $table->integer('its_worker_bran_id');
            $table->string('its_worker_shirt')->nullable();
            $table->string('its_worker_pant')->nullable();
            $table->string('its_worker_blazer')->nullable();
            $table->string('its_worker_panjabi')->nullable();
            $table->string('its_worker_payjama')->nullable();
            $table->string('its_worker_safari')->nullable();
            $table->string('its_worker_photua')->nullable();
            $table->string('its_worker_mojib_cort')->nullable();
            $table->string('its_worker_kable')->nullable();
            $table->string('its_worker_koti')->nullable();
            $table->unsignedInteger('its_worker_submit_by')->nullable();
            $table->dateTime('its_worker_submit_at')->nullable();
            $table->unsignedInteger('its_worker_update_by')->nullable();
            $table->dateTime('its_worker_update_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igl_tailor_worker_salaries');
    }
}
