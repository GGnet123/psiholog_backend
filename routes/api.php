<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::group(['prefix' => 'v1'], function () {
    Route::post('login', [\App\Http\Controllers\v1\AuthController::class, 'login']);

    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::get('logout', [\App\Http\Controllers\v1\AuthController::class, 'logout']);
        Route::get('user', [\App\Http\Controllers\v1\AuthController::class, 'user']);


    });
});