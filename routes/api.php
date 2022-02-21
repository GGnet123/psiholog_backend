<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::group(['prefix' => 'v1'], function () {
    Route::post('login', [\App\Http\Controllers\v1\AuthController::class, 'login']);

    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::get('logout', [\App\Http\Controllers\v1\AuthController::class, 'logout']);
        Route::get('user', [\App\Http\Controllers\v1\AuthController::class, 'user']);

        Route::group(['prefix' => 'services'], function () {
            Route::group(['prefix' => 'uploader'], function () {
                Route::post('music', [\App\Http\Controllers\v1\Services\UploaderFileController::class, 'music']);
                Route::post('video', [\App\Http\Controllers\v1\Services\UploaderFileController::class, 'video']);
                Route::post('image', [\App\Http\Controllers\v1\Services\UploaderFileController::class, 'image']);
                Route::delete('{file}', [\App\Http\Controllers\v1\Services\UploaderFileController::class, 'destroy']);
            });
        });
    });


    Route::group(['prefix' => 'registration'], function () {
        Route::post('step1', [\App\Http\Controllers\v1\RegistrationController::class, 'step1']);
        Route::post('resendPin', [\App\Http\Controllers\v1\RegistrationController::class, 'resendPin']);
        Route::post('step2', [\App\Http\Controllers\v1\RegistrationController::class, 'step2']);
    });
});