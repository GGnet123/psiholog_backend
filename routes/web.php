<?php

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
    Route::get('logout', [\App\Http\Controllers\Admin\LoginController::class, 'logout'])->name('admin_logout');
});
