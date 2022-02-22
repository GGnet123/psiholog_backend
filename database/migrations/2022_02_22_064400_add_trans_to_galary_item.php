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
        Schema::table('music_galary', function (Blueprint $table) {
            $table->string('name_en')->nullable();
        });

        Schema::table('video_galary', function (Blueprint $table) {
            $table->string('name_en')->nullable();
        });
    }

    public function down()
    {

        Schema::table('music_galary', function (Blueprint $table) {
            $table->dropColumn('name_en');
        });

        Schema::table('video_galary', function (Blueprint $table) {
            $table->dropColumn('name_en');
        });
    }
};
