<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::post('login', [\App\Http\Controllers\v1\AuthController::class, 'login']);

    Route::group(['prefix' => 'registration'], function () {
        Route::post('step1', [\App\Http\Controllers\v1\RegistrationController::class, 'step1']);
        Route::post('step2', [\App\Http\Controllers\v1\RegistrationController::class, 'step2']);

        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::post('step3-doctor', [\App\Http\Controllers\v1\RegistrationController::class, 'step3Doctor']);
            Route::post('step3-user', [\App\Http\Controllers\v1\RegistrationController::class, 'step3User']);
        });
    });

    Route::group(['prefix' => 'restore-password'], function () {
        Route::post('step1', [\App\Http\Controllers\v1\RestorePasswordController::class, 'step1']);
        Route::post('step2', [\App\Http\Controllers\v1\RestorePasswordController::class, 'step2']);
        Route::post('step3', [\App\Http\Controllers\v1\RestorePasswordController::class, 'step3']);
    });

    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::get('logout', [\App\Http\Controllers\v1\AuthController::class, 'logout']);

        Route::group(['prefix' => 'main'], function () {
            Route::group(['prefix' => 'galary-video'], function () {
                Route::get('/', [\App\Http\Controllers\v1\Main\VideoGalaryController::class, 'index']);
                Route::get('{item}', [\App\Http\Controllers\v1\Main\VideoGalaryController::class, 'item']);
            });

            Route::group(['prefix' => 'galary-music'], function () {
                Route::get('/', [\App\Http\Controllers\v1\Main\MusicGalaryController::class, 'index']);
                Route::get('{item}', [\App\Http\Controllers\v1\Main\MusicGalaryController::class, 'item']);
            });

            Route::group(['prefix' => 'lib-music'], function () {
                Route::get('/', [\App\Http\Controllers\v1\Main\LibMusicGalaryController::class, 'index']);
                Route::get('{item}', [\App\Http\Controllers\v1\Main\LibMusicGalaryController::class, 'item']);
            });

            Route::group(['prefix' => 'lib-video'], function () {
                Route::get('/', [\App\Http\Controllers\v1\Main\LibVideoGalaryController::class, 'index']);
                Route::get('{item}', [\App\Http\Controllers\v1\Main\LibVideoGalaryController::class, 'item']);
            });


            Route::group(['prefix' => 'support'], function () {
                Route::get('/', [\App\Http\Controllers\v1\Main\SupportController::class, 'index']);
                Route::get('{item}', [\App\Http\Controllers\v1\Main\SupportController::class, 'item']);
                Route::post('/', [\App\Http\Controllers\v1\Main\SupportController::class, 'save']);
            });

            Route::group(['prefix' => 'faq'], function () {
                Route::get('/', [\App\Http\Controllers\v1\Main\FaqController::class, 'index']);
                Route::get('{item}', [\App\Http\Controllers\v1\Main\FaqController::class, 'item']);
            });

            Route::group(['prefix' => 'lib-specialization'], function () {
                Route::get('/', [\App\Http\Controllers\v1\Main\LibSpecializationController::class, 'index']);
                Route::get('{item}', [\App\Http\Controllers\v1\Main\LibSpecializationController::class, 'item']);
            });

            Route::group(['prefix' => 'term-of-use'], function () {
                Route::get('/', [\App\Http\Controllers\v1\Main\TermOfUseController::class, 'index']);
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
            Route::group(['prefix' => 'doctor', 'middleware' => ['auth_doctor']], function () {
                Route::get('data', [\App\Http\Controllers\v1\Profile\Doctor\DoctorProfileController::class, 'data']);
                Route::post('data', [\App\Http\Controllers\v1\Profile\Doctor\DoctorProfileController::class, 'save']);
                Route::post('change-lang', [\App\Http\Controllers\v1\Profile\Doctor\DoctorProfileController::class, 'lang']);
                Route::post('check-password', [\App\Http\Controllers\v1\Profile\Doctor\DoctorProfileController::class, 'checkOldPassword']);
                Route::post('change-password', [\App\Http\Controllers\v1\Profile\Doctor\DoctorProfileController::class, 'changePassword']);


                Route::group(['prefix' => 'specialization'], function () {
                    Route::get('/', [\App\Http\Controllers\v1\Profile\Doctor\DoctorSpecializationController::class, 'index']);
                    Route::post('/', [\App\Http\Controllers\v1\Profile\Doctor\DoctorSpecializationController::class, 'manyAdd']);
                });

                Route::group(['prefix' => 'video'], function () {
                    Route::get('/', [\App\Http\Controllers\v1\Profile\Doctor\DoctorVideoController::class, 'index']);
                    Route::post('/', [\App\Http\Controllers\v1\Profile\Doctor\DoctorVideoController::class, 'save']);
                    Route::delete('{user_video}', [\App\Http\Controllers\v1\Profile\Doctor\DoctorVideoController::class, 'destroy']);
                });

                Route::group(['prefix' => 'certificat'], function () {
                    Route::get('/', [\App\Http\Controllers\v1\Profile\Doctor\DoctorCertificatController::class, 'index']);
                    Route::post('/', [\App\Http\Controllers\v1\Profile\Doctor\DoctorCertificatController::class, 'save']);
                    Route::delete('{user_certificat}', [\App\Http\Controllers\v1\Profile\Doctor\DoctorCertificatController::class, 'destroy']);
                });
            });

            Route::group(['prefix' => 'user', 'middleware' => ['auth_user']], function () {
                Route::get('data', [\App\Http\Controllers\v1\Profile\User\UserProfileController::class, 'data']);
                Route::post('data', [\App\Http\Controllers\v1\Profile\User\UserProfileController::class, 'save']);
                Route::post('change-lang', [\App\Http\Controllers\v1\Profile\User\UserProfileController::class, 'lang']);
                Route::post('check-password', [\App\Http\Controllers\v1\Profile\User\UserProfileController::class, 'checkOldPassword']);
                Route::post('change-password', [\App\Http\Controllers\v1\Profile\User\UserProfileController::class, 'changePassword']);
            });

        });
    });



});