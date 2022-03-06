<?php

use App\Http\Controllers\Admin\Content\FaqController;
use App\Http\Controllers\Admin\Lib\LibSpecializationController;
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
});
