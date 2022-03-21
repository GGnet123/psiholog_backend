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
        Schema::create('content_main_gallery', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cat_id')->nullable();
            $table->string('type')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->bigInteger('music_id')->nullable();
            $table->bigInteger('video_id')->nullable();
            $table->bigInteger('image_id')->nullable();
            $table->bigInteger('doctor_id')->nullable();
            $table->timestamps();
        });

        Schema::create('content_main_gallery_cat', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('type')->nullable();
            $table->bigInteger('image_id')->nullable();
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
        Schema::dropIfExists('content_main_gallery');
        Schema::dropIfExists('content_main_gallery_cat');
    }
};
