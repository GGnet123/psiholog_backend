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
        Schema::table('timetable_plan', function (Blueprint $table) {
            $table->dropColumn('day_num');
            $table->boolean('day_01')->default(false);
            $table->boolean('day_02')->default(false);
            $table->boolean('day_03')->default(false);
            $table->boolean('day_04')->default(false);
            $table->boolean('day_05')->default(false);
            $table->boolean('day_06')->default(false);
            $table->boolean('day_07')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('timetable_plan', function (Blueprint $table) {
            $table->integer('day_num')->nullable();
            $table->dropColumn('day_01');
            $table->dropColumn('day_02');
            $table->dropColumn('day_03');
            $table->dropColumn('day_04');
            $table->dropColumn('day_05');
            $table->dropColumn('day_06');
            $table->dropColumn('day_07');
        });
    }
};
