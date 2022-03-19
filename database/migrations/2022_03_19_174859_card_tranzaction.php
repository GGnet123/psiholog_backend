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
        Schema::create('card_transaction', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('credit_card_id');
            $table->bigInteger('user_id');
            $table->string('transaction_id')->nullable();
            $table->json('last_request')->nullable();
            $table->json('last_response')->nullable();
            $table->integer('type')->nullable();
            $table->bigInteger('subscription_id')->nullable();
            $table->bigInteger('record_id')->nullable();
            $table->boolean('is_done')->nullable();
            $table->boolean('is_returned')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card_transaction');
    }
};
