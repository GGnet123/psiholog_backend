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
        Schema::create('music_galary', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->bigInteger('music_id')->nullable();
            $table->bigInteger('photo_id')->nullable();
            $table->bigInteger('cat_id')->nullable();
            $table->boolean('is_free')->default(true);
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
        Schema::dropIfExists('music_galary');
    }
};
