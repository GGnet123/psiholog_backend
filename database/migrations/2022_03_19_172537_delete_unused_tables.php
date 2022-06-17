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
        Schema::dropIfExists('balancer');
        Schema::dropIfExists('music_galary');
        Schema::dropIfExists('music_galary_cat');
        Schema::dropIfExists('video_galary');
        Schema::dropIfExists('video_galary_cat');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('balancer', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_done')->default(false);
            $table->boolean('is_canceled')->default(false);
            $table->bigInteger('user_id');
            $table->integer('sum');
            $table->integer('record_id')->nullable();
            $table->integer('subscription_id')->nullable();
            $table->boolean('need_returned')->default(false);
            $table->boolean('is_returned')->default(false);
            $table->timestamps();
        });
        Schema::create('music_galary_cat', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->bigInteger('photo_id')->nullable();
            $table->boolean('is_free')->default(true);
            $table->timestamps();
        });
        Schema::create('music_galary', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->bigInteger('music_id')->nullable();
            $table->bigInteger('photo_id')->nullable();
            $table->bigInteger('cat_id')->nullable();
            $table->boolean('is_free')->default(true);
            $table->timestamps();
        });
        Schema::create('video_galary_cat', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->bigInteger('photo_id')->nullable();
            $table->boolean('is_free')->default(true);
            $table->timestamps();
        });
        Schema::create('video_galary', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->bigInteger('video_id')->nullable();
            $table->bigInteger('photo_id')->nullable();
            $table->bigInteger('cat_id')->nullable();
            $table->boolean('is_free')->default(true);
            $table->timestamps();
        });
    }
};
