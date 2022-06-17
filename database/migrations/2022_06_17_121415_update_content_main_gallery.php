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
            $table->text('notification_ru')->nullable();
            $table->text('notification_en')->nullable();
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
            $table->dropColumn('notification_ru');
            $table->dropColumn('notification_en');
        });
    }
};
