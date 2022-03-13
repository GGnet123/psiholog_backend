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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('balancer');
    }
};
