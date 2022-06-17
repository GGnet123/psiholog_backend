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
        Schema::table('content_main_gallery', function (Blueprint $table) {
            $table->string('google_drive_music')->nullable();
            $table->string('google_drive_video')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('content_main_gallery', function (Blueprint $table) {
            $table->dropColumn('google_drive_music');
            $table->dropColumn('google_drive_video');
        });
    }
};
