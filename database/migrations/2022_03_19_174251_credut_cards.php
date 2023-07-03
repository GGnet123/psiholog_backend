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
        Schema::create('credit_cards', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->text('card_crypto')->nullable();
            $table->text('card_token')->nullable();
            $table->boolean('is_accepted')->default(false);
            $table->boolean('is_3d_secure')->default(false);
            $table->boolean('is_active')->default(false);
            $table->boolean('is_removed')->default(false);
            $table->json('last_response')->nullable();
            $table->text('note')->nullable();
            $table->string('first_symbol')->nullable();
            $table->string('last_symbol')->nullable();
            $table->string('email')->nullable();
            $table->json('data_to_check_3d_secure')->nullable();
            $table->string('ip')->nullable();
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
        Schema::dropIfExists('credit_cards');
    }
};
