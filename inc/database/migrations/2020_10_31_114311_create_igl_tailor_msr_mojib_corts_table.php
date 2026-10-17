<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIglTailorMsrMojibCortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igl_tailor_msr_mojib_corts', function (Blueprint $table) {
            $table->bigIncrements('its_mojibcort_measure_slno');
            $table->unsignedInteger('its_mojibcort_measure_com_id');
            $table->unsignedInteger('its_mojibcort_measure_bran_id');
            $table->unsignedInteger('its_mojibcort_measure_user_id')->nullable();
            $table->string('its_mojibcort_measure_cus_mobile')->nullable();
            $table->string('its_mojibcort_product_name');
            $table->string('its_mojibcort_product_qty');
            $table->string('its_mojibcort_measure_long')->nullable();
            $table->string('its_mojibcort_measure_body')->nullable();
            $table->string('its_mojibcort_measure_body_loose')->nullable();
            $table->string('its_mojibcort_measure_belly')->nullable();
            $table->string('its_mojibcort_measure_belly_loose')->nullable();
            $table->string('its_mojibcort_measure_hip')->nullable();
            $table->string('its_mojibcort_measure_hip_loose')->nullable();
            $table->string('its_mojibcort_measure_shoulder')->nullable();
            $table->string('its_mojibcort_measure_neck')->nullable();
            $table->string('its_mojibcort_measure_collar')->nullable();
            $table->string('its_mojibcort_measure_pocket')->nullable();
            $table->string('its_mojibcort_measure_inner_pocket')->nullable();
            $table->string('its_mojibcort_measure_open')->nullable();
            $table->string('its_mojibcort_measure_catalog_no')->nullable();
            $table->string('its_mojibcort_measure_others')->nullable();
            $table->date('its_mojibcort_measure_date');
            $table->unsignedInteger('its_mojibcort_measure_submit_by')->nullable();
            $table->dateTime('its_mojibcort_measure_submit_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igl_tailor_msr_mojib_corts');
    }
}
