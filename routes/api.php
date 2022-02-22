<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::group(['prefix' => 'v1'], function () {
    Route::post('login', [\App\Http\Controllers\v1\AuthController::class, 'login']);

    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::get('logout', [\App\Http\Controllers\v1\AuthController::class, 'logout']);

        Route::group(['prefix' => 'main'], function () {
            Route::group(['prefix' => 'lib-specialization'], function () {
                Route::get('/', [\App\Http\Controllers\v1\Main\LibSpecializationController::class, 'index']);
                Route::get('{item}', [\App\Http\Controllers\v1\Main\LibSpecializationController::class, 'item']);
            });
        });

        Route::group(['prefix' => 'services'], function () {
            Route::group(['prefix' => 'uploader'], function () {
                Route::post('music', [\App\Http\Controllers\v1\Services\UploaderFileController::class, 'music']);
                Route::post('video', [\App\Http\Controllers\v1\Services\UploaderFileController::class, 'video']);
                Route::post('image', [\App\Http\Controllers\v1\Services\UploaderFileController::class, 'image']);
                Route::delete('{file}', [\App\Http\Controllers\v1\Services\UploaderFileController::class, 'destroy']);
            });
        });

        Route::group(['prefix' => 'profile'], function(){
            Route::group(['prefix' => 'doctor'], function () {
                Route::get('data', [\App\Http\Controllers\v1\Profile\Doctor\DoctorProfileController::class, 'data']);
                Route::post('data', [\App\Http\Controllers\v1\Profile\Doctor\DoctorProfileController::class, 'save']);
                Route::post('change-lang', [\App\Http\Controllers\v1\Profile\Doctor\DoctorProfileController::class, 'lang']);


                Route::group(['prefix' => 'specialization'], function () {
                    Route::get('/', [\App\Http\Controllers\v1\Profile\Doctor\DoctorSpecializationController::class, 'index']);
                    Route::post('/', [\App\Http\Controllers\v1\Profile\Doctor\DoctorSpecializationController::class, 'manyAdd']);
                });

                Route::group(['prefix' => 'video'], function () {
                    Route::get('/', [\App\Http\Controllers\v1\Profile\Doctor\DoctorVideoController::class, 'index']);
                    Route::post('/', [\App\Http\Controllers\v1\Profile\Doctor\DoctorVideoController::class, 'save']);
                    Route::delete('{user_video}', [\App\Http\Controllers\v1\Profile\Doctor\DoctorVideoController::class, 'destroy']);
                });
            });

            Route::group(['prefix' => 'user'], function () {
                Route::get('data', [\App\Http\Controllers\v1\Profile\User\UserProfileController::class, 'data']);
                Route::post('data', [\App\Http\Controllers\v1\Profile\User\UserProfileController::class, 'save']);
                Route::post('change-lang', [\App\Http\Controllers\v1\Profile\User\UserProfileController::class, 'lang']);
            });

        });
    });


    Route::group(['prefix' => 'registration'], function () {
        Route::post('step1', [\App\Http\Controllers\v1\RegistrationController::class, 'step1']);
        Route::post('resendPin', [\App\Http\Controllers\v1\RegistrationController::class, 'resendPin']);
        Route::post('step2', [\App\Http\Controllers\v1\RegistrationController::class, 'step2']);

        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::post('step3-doctor', [\App\Http\Controllers\v1\RegistrationController::class, 'step3Doctor']);
            Route::post('step3-user', [\App\Http\Controllers\v1\RegistrationController::class, 'step3User']);

        });
    });
});