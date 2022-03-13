<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('record_doctor', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id');
            $table->bigInteger('doctor_id');
            $table->integer('sum');
            $table->date('record_date');
            $table->time('record_time');
            $table->integer('status_id');
            $table->boolean('is_canceled');
            $table->boolean('is_moved');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('record_doctor');
    }
};
