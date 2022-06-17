<?php

use App\Models\Record\RecordDoctor;
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
            $table->integer('status_id')->default(RecordDoctor::CREATED_STATUS);
            $table->boolean('is_canceled')->default(false);
            $table->boolean('is_moved')->default(false);
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
