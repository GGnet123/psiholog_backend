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
        Schema::create('timetable_plan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->integer('day_num')->nullable();
            for ($i = 0; $i < 24; $i++){
                $table->boolean('hour_' . str_pad($i, 2, '0', STR_PAD_LEFT))->default(false);
            }
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
        Schema::dropIfExists('timetable_plan');
    }
};
