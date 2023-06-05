<?php

use App\Http\Controllers\Admin\Content\FaqController;
use App\Http\Controllers\Admin\Content\Galary\AffirmationController;
use App\Http\Controllers\Admin\Content\Galary\AudioBookCatController;
use App\Http\Controllers\Admin\Content\Galary\AudioBookController;
use App\Http\Controllers\Admin\Content\Galary\MantraController;
use App\Http\Controllers\Admin\Content\Galary\MeditationAudioController;
use App\Http\Controllers\Admin\Content\Galary\MeditationCatController;
use App\Http\Controllers\Admin\Content\Galary\MeditationController;
use App\Http\Controllers\Admin\Content\Galary\NatureController;
use App\Http\Controllers\Admin\Content\Galary\NightStoryCatController;
use App\Http\Controllers\Admin\Content\Galary\NightStoryController;
use App\Http\Controllers\Admin\Content\Galary\SleepController;
use App\Http\Controllers\Admin\Content\Galary\TalkToMeController;
use App\Http\Controllers\Admin\Content\Galary\VdohController;
use App\Http\Controllers\Admin\Content\Galary\YogaController;
use App\Http\Controllers\Admin\Content\Galary\YogatoMeCatController;
use App\Http\Controllers\Admin\Content\TermOfUseController;
use App\Http\Controllers\Admin\Finance\TransactionController;
use App\Http\Controllers\Admin\Lib\LibSpecializationController;
use App\Http\Controllers\Admin\Main\ClaimController;
use App\Http\Controllers\Admin\Main\CouponController;
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
    Route::get('stat', [\App\Http\Controllers\Admin\IndexController::class, 'stat'])->name('admin_stat');
    Route::post('save-file', [\App\Http\Controllers\Admin\IndexController::class, 'saveFile'])->name('admin_save_file');

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
            Route::get('cancel/{item}', [RecordController::class, 'cancel'])->name('admin_record_cancel');
        });
    });

    Route::group(['prefix' => 'main'], function () {

        Route::group(['prefix' => 'subscription'], function () {
            Route::get('/', [SubscriptionController::class, 'index'])->name('admin_subscription');
            Route::get('show/{item}', [SubscriptionController::class, 'view'])->name('admin_subscription_show');
        });

        Route::group(['prefix' => 'users'], function () {
            Route::get('/', [UserController::class, 'index'])->name('admin_main_user');
            Route::get('toggle-doctor/{item}', [UserController::class, 'toggleDoctor'])->name('admin_main_user_toggle_doctor');
            Route::get('show/{item}', [UserController::class, 'view'])->name('admin_main_user_show');
            Route::get('block/{item}', [UserController::class, 'blocked'])->name('admin_main_user_block');
            Route::get('block-seance/{item}', [UserController::class, 'blockedSeance'])->name('admin_main_user_block_seance');
        });

        Route::group(['prefix' => 'coupons'], function () {
            Route::get('/', [CouponController::class, 'index'])->name('admin_coupons');
            Route::get('create', [CouponController::class, 'create'])->name('admin_coupons_create');
            Route::post('create', [CouponController::class, 'saveCreate'])->name('admin_coupons_create_save');
            Route::get('delete/{item}', [CouponController::class, 'delete'])->name('admin_coupons_delete');
        });

        Route::group(['prefix' => 'doctor'], function () {
            Route::get('/', [DoctorController::class, 'index'])->name('admin_doctor');
            Route::get('show/{item}', [DoctorController::class, 'view'])->name('admin_doctor_show');
            Route::get('edit/{item}', [DoctorController::class, 'edit'])->name('admin_doctor_edit');
            Route::post('update/{item}', [DoctorController::class, 'update'])->name('admin_doctor_update');
            Route::get('block/{item}', [DoctorController::class, 'blocked'])->name('admin_doctor_block');
            Route::get('block-seance/{item}', [DoctorController::class, 'blockedSeance'])->name('admin_doctor_block_seance');
            Route::get('approve-seance/{item}', [DoctorController::class, 'approveDoctor'])->name('admin_doctor_approve_seance');

            Route::post('set-timetable-time', [DoctorController::class, 'setTimeTableTime'])->name('admin_doctor_set_time_table');
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


    Route::group(['prefix' => 'galary'], function () {
        Route::group(['prefix' => 'affirmation'], function () {
            Route::get('/', [AffirmationController::class, 'index'])->name('admin_gal_affirmation');
            Route::get('create', [AffirmationController::class, 'create'])->name('admin_gal_affirmation_create');
            Route::post('create', [AffirmationController::class, 'saveCreate'])->name('admin_gal_affirmation_create_save');
            Route::get('update/{item}', [AffirmationController::class, 'update'])->name('admin_gal_affirmation_update');
            Route::post('update/{item}', [AffirmationController::class, 'saveUpdate'])->name('admin_gal_affirmation_update_save');
            Route::get('show/{item}', [AffirmationController::class, 'view'])->name('admin_gal_affirmation_show');
            Route::get('delete/{item}', [AffirmationController::class, 'delete'])->name('admin_gal_affirmation_delete');
        });

        Route::group(['prefix' => 'mantra'], function () {
            Route::get('/', [MantraController::class, 'index'])->name('admin_gal_mantra');
            Route::get('create', [MantraController::class, 'create'])->name('admin_gal_mantra_create');
            Route::post('create', [MantraController::class, 'saveCreate'])->name('admin_gal_mantra_create_save');
            Route::get('update/{item}', [MantraController::class, 'update'])->name('admin_gal_mantra_update');
            Route::post('update/{item}', [MantraController::class, 'saveUpdate'])->name('admin_gal_mantra_update_save');
            Route::get('show/{item}', [MantraController::class, 'view'])->name('admin_gal_mantra_show');
            Route::get('delete/{item}', [MantraController::class, 'delete'])->name('admin_gal_mantra_delete');
        });

        Route::group(['prefix' => 'medaudio'], function () {
            Route::get('/', [MeditationAudioController::class, 'index'])->name('admin_gal_med_audio');
            Route::get('create', [MeditationAudioController::class, 'create'])->name('admin_gal_med_audio_create');
            Route::post('create', [MeditationAudioController::class, 'saveCreate'])->name('admin_gal_med_audio_create_save');
            Route::get('update/{item}', [MeditationAudioController::class, 'update'])->name('admin_gal_med_audio_update');
            Route::post('update/{item}', [MeditationAudioController::class, 'saveUpdate'])->name('admin_gal_med_audio_update_save');
            Route::get('show/{item}', [MeditationAudioController::class, 'view'])->name('admin_gal_med_audio_show');
            Route::get('delete/{item}', [MeditationAudioController::class, 'delete'])->name('admin_gal_med_audio_delete');
        });

        Route::group(['prefix' => 'meditems'], function () {
            Route::get('/', [MeditationController::class, 'index'])->name('admin_gal_meditation');
            Route::get('create', [MeditationController::class, 'create'])->name('admin_gal_meditation_create');
            Route::post('create', [MeditationController::class, 'saveCreate'])->name('admin_gal_meditation_create_save');
            Route::get('update/{item}', [MeditationController::class, 'update'])->name('admin_gal_meditation_update');
            Route::post('update/{item}', [MeditationController::class, 'saveUpdate'])->name('admin_gal_meditation_update_save');
            Route::get('show/{item}', [MeditationController::class, 'view'])->name('admin_gal_meditation_show');
            Route::get('delete/{item}', [MeditationController::class, 'delete'])->name('admin_gal_meditation_delete');
        });

        Route::group(['prefix' => 'nature'], function () {
            Route::get('/', [NatureController::class, 'index'])->name('admin_gal_nature');
            Route::get('create', [NatureController::class, 'create'])->name('admin_gal_nature_create');
            Route::post('create', [NatureController::class, 'saveCreate'])->name('admin_gal_nature_create_save');
            Route::get('update/{item}', [NatureController::class, 'update'])->name('admin_gal_nature_update');
            Route::post('update/{item}', [NatureController::class, 'saveUpdate'])->name('admin_gal_nature_update_save');
            Route::get('show/{item}', [NatureController::class, 'view'])->name('admin_gal_nature_show');
            Route::get('delete/{item}', [NatureController::class, 'delete'])->name('admin_gal_nature_delete');
        });

        Route::group(['prefix' => 'sleep'], function () {
            Route::get('/', [SleepController::class, 'index'])->name('admin_gal_sleep');
            Route::get('create', [SleepController::class, 'create'])->name('admin_gal_sleep_create');
            Route::post('create', [SleepController::class, 'saveCreate'])->name('admin_gal_sleep_create_save');
            Route::get('update/{item}', [SleepController::class, 'update'])->name('admin_gal_sleep_update');
            Route::post('update/{item}', [SleepController::class, 'saveUpdate'])->name('admin_gal_sleep_update_save');
            Route::get('show/{item}', [SleepController::class, 'view'])->name('admin_gal_sleep_show');
            Route::get('delete/{item}', [SleepController::class, 'delete'])->name('admin_gal_sleep_delete');
        });

        Route::group(['prefix' => 'talk-to-me'], function () {
            Route::get('/', [TalkToMeController::class, 'index'])->name('admin_gal_talk_to_me');
            Route::get('create', [TalkToMeController::class, 'create'])->name('admin_gal_talk_to_me_create');
            Route::post('create', [TalkToMeController::class, 'saveCreate'])->name('admin_gal_talk_to_me_create_save');
            Route::get('update/{item}', [TalkToMeController::class, 'update'])->name('admin_gal_talk_to_me_update');
            Route::post('update/{item}', [TalkToMeController::class, 'saveUpdate'])->name('admin_gal_talk_to_me_update_save');
            Route::get('show/{item}', [TalkToMeController::class, 'view'])->name('admin_gal_talk_to_me_show');
            Route::get('delete/{item}', [TalkToMeController::class, 'delete'])->name('admin_gal_talk_to_me_delete');
        });

        Route::group(['prefix' => 'vdoh'], function () {
            Route::get('/', [VdohController::class, 'index'])->name('admin_gal_vdoh');
            Route::get('create', [VdohController::class, 'create'])->name('admin_gal_vdoh_create');
            Route::post('create', [VdohController::class, 'saveCreate'])->name('admin_gal_vdoh_create_save');
            Route::get('update/{item}', [VdohController::class, 'update'])->name('admin_gal_vdoh_update');
            Route::post('update/{item}', [VdohController::class, 'saveUpdate'])->name('admin_gal_vdoh_update_save');
            Route::get('show/{item}', [VdohController::class, 'view'])->name('admin_gal_vdoh_show');
            Route::get('delete/{item}', [VdohController::class, 'delete'])->name('admin_gal_vdoh_delete');
        });

        Route::group(['prefix' => 'yogaitems'], function () {
            Route::get('/', [YogaController::class, 'index'])->name('admin_gal_yoga');
            Route::get('create', [YogaController::class, 'create'])->name('admin_gal_yoga_create');
            Route::post('create', [YogaController::class, 'saveCreate'])->name('admin_gal_yoga_create_save');
            Route::get('update/{item}', [YogaController::class, 'update'])->name('admin_gal_yoga_update');
            Route::post('update/{item}', [YogaController::class, 'saveUpdate'])->name('admin_gal_yoga_update_save');
            Route::get('show/{item}', [YogaController::class, 'view'])->name('admin_gal_yoga_show');
            Route::get('delete/{item}', [YogaController::class, 'delete'])->name('admin_gal_yoga_delete');
        });

        Route::group(['prefix' => 'yogacat'], function () {
            Route::get('/', [YogatoMeCatController::class, 'index'])->name('yoga_cat');
            Route::get('create', [YogatoMeCatController::class, 'create'])->name('yoga_cat_create');
            Route::post('create', [YogatoMeCatController::class, 'saveCreate'])->name('yoga_cat_create_save');
            Route::get('update/{item}', [YogatoMeCatController::class, 'update'])->name('yoga_cat_update');
            Route::post('update/{item}', [YogatoMeCatController::class, 'saveUpdate'])->name('yoga_cat_update_save');
            Route::get('show/{item}', [YogatoMeCatController::class, 'view'])->name('yoga_cat_show');
            Route::get('delete/{item}', [YogatoMeCatController::class, 'delete'])->name('yoga_cat_delete');
        });

        Route::group(['prefix' => 'medcat'], function () {
            Route::get('/', [MeditationCatController::class, 'index'])->name('meditation_cat');
            Route::get('create', [MeditationCatController::class, 'create'])->name('meditation_cat_create');
            Route::post('create', [MeditationCatController::class, 'saveCreate'])->name('meditation_cat_create_save');
            Route::get('update/{item}', [MeditationCatController::class, 'update'])->name('meditation_cat_update');
            Route::post('update/{item}', [MeditationCatController::class, 'saveUpdate'])->name('meditation_cat_update_save');
            Route::get('show/{item}', [MeditationCatController::class, 'view'])->name('meditation_cat_show');
            Route::get('delete/{item}', [MeditationCatController::class, 'delete'])->name('meditation_cat_delete');
        });



        Route::group(['prefix' => 'cataudiobook'], function () {
            Route::get('/', [AudioBookCatController::class, 'index'])->name('audio_book_cat');
            Route::get('create', [AudioBookCatController::class, 'create'])->name('audio_book_cat_create');
            Route::post('create', [AudioBookCatController::class, 'saveCreate'])->name('audio_book_cat_create_save');
            Route::get('update/{item}', [AudioBookCatController::class, 'update'])->name('audio_book_cat_update');
            Route::post('update/{item}', [AudioBookCatController::class, 'saveUpdate'])->name('audio_book_cat_update_save');
            Route::get('show/{item}', [AudioBookCatController::class, 'view'])->name('audio_book_cat_show');
            Route::get('delete/{item}', [AudioBookCatController::class, 'delete'])->name('audio_book_cat_delete');
        });



        Route::group(['prefix' => 'catnightstory'], function () {
            Route::get('/', [NightStoryCatController::class, 'index'])->name('night_story_cat');
            Route::get('create', [NightStoryCatController::class, 'create'])->name('night_story_cat_create');
            Route::post('create', [NightStoryCatController::class, 'saveCreate'])->name('night_story_cat_create_save');
            Route::get('update/{item}', [NightStoryCatController::class, 'update'])->name('night_story_cat_update');
            Route::post('update/{item}', [NightStoryCatController::class, 'saveUpdate'])->name('night_story_cat_update_save');
            Route::get('show/{item}', [NightStoryCatController::class, 'view'])->name('night_story_cat_show');
            Route::get('delete/{item}', [NightStoryCatController::class, 'delete'])->name('night_story_cat_delete');
        });

        Route::group(['prefix' => 'audiobook'], function () {
            Route::get('/', [AudioBookController::class, 'index'])->name('audio_book');
            Route::get('create', [AudioBookController::class, 'create'])->name('audio_book_create');
            Route::post('create', [AudioBookController::class, 'saveCreate'])->name('audio_book_create_save');
            Route::get('update/{item}', [AudioBookController::class, 'update'])->name('audio_book_update');
            Route::post('update/{item}', [AudioBookController::class, 'saveUpdate'])->name('audio_book_update_save');
            Route::get('show/{item}', [AudioBookController::class, 'view'])->name('audio_book_show');
            Route::get('delete/{item}', [AudioBookController::class, 'delete'])->name('audio_book_delete');
        });

        Route::group(['prefix' => 'nightstory'], function () {
            Route::get('/', [NightStoryController::class, 'index'])->name('night_story');
            Route::get('create', [NightStoryController::class, 'create'])->name('night_story_create');
            Route::post('create', [NightStoryController::class, 'saveCreate'])->name('night_story_create_save');
            Route::get('update/{item}', [NightStoryController::class, 'update'])->name('night_story_update');
            Route::post('update/{item}', [NightStoryController::class, 'saveUpdate'])->name('night_story_update_save');
            Route::get('show/{item}', [NightStoryController::class, 'view'])->name('night_story_show');
            Route::get('delete/{item}', [NightStoryController::class, 'delete'])->name('night_story_delete');
        });

    });

    Route::get('logout', [\App\Http\Controllers\Admin\LoginController::class, 'logout'])->name('admin_logout');


    Route::group(['prefix' => 'sample'], function () {
        Route::get('video', [\App\Http\Controllers\Admin\Sample\VideoCallController::class, 'index'])->name('sample_video');
        Route::get('video/token', [\App\Http\Controllers\Admin\Sample\VideoCallController::class, 'token']);

        Route::get('sms', [\App\Http\Controllers\Admin\Sample\SmsController::class, 'index'])->name('sample_sms');
        Route::post('sms', [\App\Http\Controllers\Admin\Sample\SmsController::class, 'save'])->name('sample_sms_save');


        Route::any('fcm', [\App\Http\Controllers\Admin\Sample\FcmTokenSampleController::class, 'index']);
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

