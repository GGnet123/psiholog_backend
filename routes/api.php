<?php

use App\Http\Controllers\v1\FavoriteController;
use App\Http\Controllers\v1\Finance\CreditCardController;
use App\Http\Controllers\v1\Main\CouponController;
use App\Http\Controllers\v1\Main\SubscriptionController;
use App\Http\Controllers\v1\MainPage\GalaryController;
use App\Http\Controllers\v1\Record\ManageRecordController;
use App\Http\Controllers\v1\Record\RecordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::post('login', [\App\Http\Controllers\v1\AuthController::class, 'login']);
    Route::post('firebase-login', [\App\Http\Controllers\v1\FirebaseAuthController::class, 'login']);
    Route::get('contract', [\App\Http\Controllers\v1\Services\UploaderFileController::class, 'contract']);
    Route::group(['prefix' => 'registration'], function () {
        Route::post('step1', [\App\Http\Controllers\v1\RegistrationController::class, 'step1']);
        Route::post('step1-email', [\App\Http\Controllers\v1\RegistrationController::class, 'step1Email']);
        Route::post('step2', [\App\Http\Controllers\v1\RegistrationController::class, 'step2']);
        Route::post('step2-email', [\App\Http\Controllers\v1\RegistrationController::class, 'step2Email']);

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


    Route::post('check-login', [\App\Http\Controllers\v1\CreatePasswordController::class, 'checkLogin']);

    Route::group(['middleware' => ['auth:sanctum']], function () {

        Route::post('change-login', [\App\Http\Controllers\v1\Profile\User\UserProfileController::class, 'changePhone']);

        Route::post('create-password', [\App\Http\Controllers\v1\CreatePasswordController::class, 'save']);
        Route::post('create-password/check-login', [\App\Http\Controllers\v1\CreatePasswordController::class, 'checkLogin']);


        Route::post('save-fcm-token', [\App\Http\Controllers\v1\FcmTokenController::class, 'save']);

        Route::group(['prefix' => 'main-page'], function () {
            Route::group(['prefix' => 'galary'], function () {
                Route::get('/', [GalaryController::class, 'index']);
                Route::get('cats', [GalaryController::class, 'cats']);
                Route::get('types', [GalaryController::class, 'types']);
                Route::get('mainPage', [GalaryController::class, 'mainPage']);


                Route::get('favorite/items', [GalaryController::class, 'favoriteItems']);
                Route::get('favorite/cats', [GalaryController::class, 'favoriteCats']);
            });
        });

        Route::group(['prefix' => 'favorite'], function () {
            Route::get('ar-type', [FavoriteController::class, 'getArType']);
            Route::post('save', [FavoriteController::class, 'save']);
            Route::post('rate', [FavoriteController::class, 'rate']);
            Route::delete('delete', [FavoriteController::class, 'delete']);
        });

        Route::group(['prefix' => 'finance'], function () {
            Route::group(['prefix' => 'credit-card'], function () {
                Route::get('/', [CreditCardController::class, 'index']);
                Route::get('show/{item}', [CreditCardController::class, 'item']);
                Route::get('active', [CreditCardController::class, 'active']);
                Route::post('create', [CreditCardController::class, 'create']);
                Route::post('switch/{id}', [CreditCardController::class, 'switchActiveCard']);
                Route::delete('remove/{item}', [CreditCardController::class, 'remove']);
            });
        });

        Route::group(['prefix' => 'record'], function () {
            Route::group(['prefix' => 'manage'], function () {
                Route::get('free-hour/{doctor}', [ManageRecordController::class, 'getDoctorFreeHour']);
                Route::post('create-record/{doctor}', [ManageRecordController::class, 'createRecord']);
                Route::post('approve-record/{record}', [ManageRecordController::class, 'approveRecord']);
                Route::post('decline-record/{record}', [ManageRecordController::class, 'declineRecord']);
                Route::post('start-seance-record/{record}', [ManageRecordController::class, 'startSeanceRecord']);
                Route::get('get-agora-data/{record}', [ManageRecordController::class, 'getAgoraData']);
                Route::post('finish-record/{record}', [ManageRecordController::class, 'finishRecord']);
                Route::post('move-record/{record}', [ManageRecordController::class, 'moveRecord']);
                Route::post('cancel-record/{record}', [ManageRecordController::class, 'cancelRecord']);
            });


            Route::group(['prefix' => 'record'], function () {
                Route::get('ar-status', [RecordController::class, 'getArStatus']);
                Route::get('doctor-record', [RecordController::class, 'doctorRecords']);
                Route::get('customer-record', [RecordController::class, 'customerRecords']);
                Route::get('show/{record}', [RecordController::class, 'show']);

            });
        });

        Route::group(['prefix' => 'main'], function () {
            Route::group(['prefix' => 'subscription'], function () {
                Route::get('/', [SubscriptionController::class, 'index']);
                Route::post('/', [SubscriptionController::class, 'create']);
                Route::delete('/', [SubscriptionController::class, 'cancelSubscription']);
            });

            Route::group(['prefix' => 'coupon'], function () {
                Route::post('/buy', [CouponController::class, 'buy']);
                Route::get('/', [CouponController::class, 'getUserCoupons']);
            });

            Route::group(['prefix' => 'support'], function () {
                Route::get('/', [\App\Http\Controllers\v1\Main\SupportController::class, 'index']);
                Route::get('{item}', [\App\Http\Controllers\v1\Main\SupportController::class, 'item']);
                Route::post('/', [\App\Http\Controllers\v1\Main\SupportController::class, 'save']);
            });

            Route::group(['prefix' => 'faq'], function () {
                Route::get('/', [\App\Http\Controllers\v1\Main\FaqController::class, 'index']);
                Route::get('{item}', [\App\Http\Controllers\v1\Main\FaqController::class, 'item']);
                Route::post('/vote/{item}', [\App\Http\Controllers\v1\Main\FaqController::class, 'vote']);
            });

            Route::group(['prefix' => 'lib-specialization'], function () {
                Route::get('/', [\App\Http\Controllers\v1\Main\LibSpecializationController::class, 'index']);
                Route::get('{item}', [\App\Http\Controllers\v1\Main\LibSpecializationController::class, 'item']);
            });

            Route::group(['prefix' => 'term-of-use'], function () {
                Route::get('/', [\App\Http\Controllers\v1\Main\TermOfUseController::class, 'index']);
            });


            Route::group(['prefix' => 'doctors'], function () {
                Route::get('/', [\App\Http\Controllers\v1\Main\DoctorController::class, 'index']);
                Route::get('favorite/items', [\App\Http\Controllers\v1\Main\DoctorController::class, 'favorite']);
                Route::get('{item}', [\App\Http\Controllers\v1\Main\DoctorController::class, 'item']);
            });


            Route::group(['prefix' => 'claim'], function () {
                Route::get('/', [\App\Http\Controllers\v1\Main\ClaimController::class, 'index']);
                Route::get('{item}', [\App\Http\Controllers\v1\Main\ClaimController::class, 'item']);
                Route::post('/', [\App\Http\Controllers\v1\Main\ClaimController::class, 'save']);
            });


        });

        Route::group(['prefix' => 'services'], function () {
            Route::group(['prefix' => 'uploader'], function () {
                Route::post('dropbox', [\App\Http\Controllers\v1\Services\UploaderFileController::class, 'dropbox']);
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


                Route::group(['prefix' => 'timetable-plan'], function () {
                    Route::get('/', [\App\Http\Controllers\v1\Profile\Doctor\DoctorTimetablePlanController::class, 'index']);
                    Route::post('/', [\App\Http\Controllers\v1\Profile\Doctor\DoctorTimetablePlanController::class, 'save']);
                });

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

    Route::post('accept-3d-secure/{item}', [CreditCardController::class, 'checkSecure'])->name('check_3d_pay');
});



