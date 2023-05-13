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
            $table->boolean('need_subscription')->default(false);
        });
        Schema::table('content_main_gallery_cat', function (Blueprint $table) {
            $table->boolean('need_subscription')->default(false);
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
            $table->dropColumn('need_subscription');
        });
        Schema::table('content_main_gallery_cat', function (Blueprint $table) {
            $table->dropColumn('need_subscription');
        });
    }
};
