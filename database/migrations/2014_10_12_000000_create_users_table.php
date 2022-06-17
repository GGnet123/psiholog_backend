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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('login')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('type_id')->default(1);
            $table->string('lang')->nullable();
            $table->date('date_b')->nullable();
            $table->bigInteger('avatar_id')->nullable();
            $table->longText('note')->nullable();
            $table->integer('price')->nullable();
            $table->boolean('notify_all')->default(true);
            $table->boolean('notify_meditation')->default(true);
            $table->boolean('notify_app')->default(true);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
