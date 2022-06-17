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
        Schema::create('log_record', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('record_id');
            $table->integer('status_id');
            $table->integer('is_moved')->default(false);
            $table->integer('is_canceled')->default(false);
            $table->bigInteger('user_id');
            $table->json('record_json')->nullable();
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
        Schema::dropIfExists('log_record');
    }
};
