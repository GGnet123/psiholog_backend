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
        Schema::create('email_registration', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->boolean('accepted')->nullable();
            $table->string('pin')->nullable();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('email')->unique()->nullable();
            $table->string('login')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_registration');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('email');
        });
    }
};
