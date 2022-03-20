<?php

use App\Http\Controllers\Admin\Content\FaqController;
use App\Http\Controllers\Admin\Content\TermOfUseController;
use App\Http\Controllers\Admin\Finance\TransactionController;
use App\Http\Controllers\Admin\Lib\LibSpecializationController;
use App\Http\Controllers\Admin\Main\ClaimController;
use App\Http\Controllers\Admin\Main\DoctorController;
use App\Http\Controllers\Admin\Main\SubscriptionController;
use App\Http\Controllers\Admin\Main\SupportController;
use App\Http\Controllers\Admin\Main\UserController;
use App\Http\Controllers\Admin\Record\RecordController;
use Illuminate\Support\Facades\Route;
use Hmurich\Swagger\Controllers\SwaggerViewController;

Route::get('swagger/ui', [SwaggerViewController::class, 'index']);

Route::get('/', function(){
    return redirect()->route('admin_index');
});

Route::group(['prefix' => 'admin/login'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\LoginController::class, 'index'])->name('admin_login');
    Route::post('/', [\App\Http\Controllers\Admin\LoginController::class, 'login'])->name('admin_login_check');
});


Route::group(['prefix' => 'admin', 'middleware' => ['auth_admin']], function () {
    Route::get('/', [\App\Http\Controllers\Admin\IndexController::class, 'index'])->name('admin_index');

    Route::group(['prefix' => 'finance'], function () {
        Route::group(['prefix' => 'transaction'], function () {
            Route::get('/', [TransactionController::class, 'index'])->name('admin_transaction');
            Route::get('show/{item}', [TransactionController::class, 'view'])->name('admin_transaction_show');
            Route::get('cancel/{item}', [TransactionController::class, 'cancel'])->name('admin_transaction_cancel');
        });
    });


    Route::group(['prefix' => 'record'], function () {
        Route::group(['prefix' => 'record'], function () {
            Route::get('/', [RecordController::class, 'index'])->name('admin_record');
            Route::get('show/{item}', [RecordController::class, 'view'])->name('admin_record_show');
        });
    });

    Route::group(['prefix' => 'main'], function () {

        Route::group(['prefix' => 'subscription'], function () {
            Route::get('/', [SubscriptionController::class, 'index'])->name('admin_subscription');
            Route::get('show/{item}', [SubscriptionController::class, 'view'])->name('admin_subscription_show');
        });

        Route::group(['prefix' => 'users'], function () {
            Route::get('/', [UserController::class, 'index'])->name('admin_main_user');
            Route::get('show/{item}', [UserController::class, 'view'])->name('admin_main_user_show');
            Route::get('block/{item}', [UserController::class, 'blocked'])->name('admin_main_user_block');
            Route::get('block-seance/{item}', [UserController::class, 'blockedSeance'])->name('admin_main_user_block_seance');
        });

        Route::group(['prefix' => 'doctor'], function () {
            Route::get('/', [DoctorController::class, 'index'])->name('admin_doctor');
            Route::get('show/{item}', [DoctorController::class, 'view'])->name('admin_doctor_show');
            Route::get('block/{item}', [DoctorController::class, 'blocked'])->name('admin_doctor_block');
            Route::get('block-seance/{item}', [DoctorController::class, 'blockedSeance'])->name('admin_doctor_block_seance');
        });

        Route::group(['prefix' => 'support'], function(){
            Route::get('/', [SupportController::class, 'index'])->name('admin_support');
            Route::get('show/{item}', [SupportController::class, 'view'])->name('admin_support_show');
            Route::post('show/{item}', [SupportController::class, 'save'])->name('admin_support_save');

        });

        Route::group(['prefix' => 'claim'], function(){
            Route::get('/', [ClaimController::class, 'index'])->name('admin_claim');
            Route::get('show/{item}', [ClaimController::class, 'view'])->name('admin_claim_show');
            Route::get('close/{item}', [ClaimController::class, 'save'])->name('admin_claim_close');

        });


    });

    Route::group(['prefix' => 'content'], function () {
        Route::group(['prefix' => 'faq'], function () {
            Route::get('/', [FaqController::class, 'index'])->name('admin_faq');
            Route::get('create', [FaqController::class, 'create'])->name('admin_faq_create');
            Route::post('create', [FaqController::class, 'saveCreate'])->name('admin_faq_create_save');
            Route::get('update/{item}', [FaqController::class, 'update'])->name('admin_faq_update');
            Route::post('update/{item}', [FaqController::class, 'saveUpdate'])->name('admin_faq_update_save');
            Route::get('show/{item}', [FaqController::class, 'view'])->name('admin_faq_show');
            Route::get('delete/{item}', [FaqController::class, 'delete'])->name('admin_faq_delete');
        });

        Route::group(['prefix' => 'term-of-use'], function () {
            Route::get('/', [TermOfUseController::class, 'index'])->name('admin_term');
            Route::post('/', [TermOfUseController::class, 'save'])->name('admin_term_save');
        });
    });


    Route::group(['prefix' => 'lib'], function () {
        Route::group(['prefix' => 'specialization'], function () {
            Route::get('/', [LibSpecializationController::class, 'index'])->name('admin_lib_spec');
            Route::get('create', [LibSpecializationController::class, 'create'])->name('admin_lib_spec_create');
            Route::post('create', [LibSpecializationController::class, 'saveCreate'])->name('admin_lib_spec_create_save');
            Route::get('update/{item}', [LibSpecializationController::class, 'update'])->name('admin_lib_spec_update');
            Route::post('update/{item}', [LibSpecializationController::class, 'saveUpdate'])->name('admin_lib_spec_update_save');
            Route::get('show/{item}', [LibSpecializationController::class, 'view'])->name('admin_lib_spec_show');
            Route::get('delete/{item}', [LibSpecializationController::class, 'delete'])->name('admin_lib_spec_delete');
        });
    });

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('admin_profile');
        Route::post('/', [\App\Http\Controllers\Admin\ProfileController::class, 'save'])->name('admin_profile_save');
    });

    Route::get('logout', [\App\Http\Controllers\Admin\LoginController::class, 'logout'])->name('admin_logout');


    Route::group(['prefix' => 'sample'], function () {
        Route::get('video', [\App\Http\Controllers\Admin\Sample\VideoCallController::class, 'index'])->name('sample_video');
        Route::get('video/token', [\App\Http\Controllers\Admin\Sample\VideoCallController::class, 'token']);

        Route::get('sms', [\App\Http\Controllers\Admin\Sample\SmsController::class, 'index'])->name('sample_sms');
        Route::post('sms', [\App\Http\Controllers\Admin\Sample\SmsController::class, 'save'])->name('sample_sms_save');

        Route::get('firebase-auth', [\App\Http\Controllers\Admin\Sample\FirebaseAuthController::class, 'index'])->name('sample_firebase_auth');
        Route::any('cloud-pay', [\App\Http\Controllers\Admin\Sample\CloudPaymentController::class, 'index'])->name('sample_pay');
        Route::get('cloud-pay/charge', [\App\Http\Controllers\Admin\Sample\CloudPaymentController::class, 'charge'])->name('sample_pay_charge');
        Route::get('cloud-pay/chargefree', [\App\Http\Controllers\Admin\Sample\CloudPaymentController::class, 'chargefree'])->name('sample_pay_chargefree');
        Route::get('cloud-pay/secure-form', [\App\Http\Controllers\Admin\Sample\CloudPaymentController::class, 'secure'])->name('sample_pay_secure');
        Route::get('cloud-pay/token', [\App\Http\Controllers\Admin\Sample\CloudPaymentController::class, 'token'])->name('sample_pay_token');
        Route::get('cloud-pay/return', [\App\Http\Controllers\Admin\Sample\CloudPaymentController::class, 'returnPay'])->name('sample_pay_return');
        Route::get('cloud-pay/refund', [\App\Http\Controllers\Admin\Sample\CloudPaymentController::class, 'transactionsRefund'])->name('sample_pay_refund');
    });
});

Route::any('cloud-pay', [\App\Http\Controllers\Admin\Sample\CloudPaymentController::class, 'index'])->name('sample_pay');

