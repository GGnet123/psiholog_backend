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
        Schema::create('faq', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('name_en')->nullable();
            $table->text('note')->nullable();
            $table->text('note_en')->nullable();
            $table->timestamps();
        });

        Schema::create('faq_stat', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('faq_id');
            $table->bigInteger('user_id');
            $table->boolean('is_good')->nullable();
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
        Schema::dropIfExists('faq');
        Schema::dropIfExists('faq_stat');
    }
};
