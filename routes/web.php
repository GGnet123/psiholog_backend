<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    dd(
      env('DB_HOST'),
        env('DB_PORT'),
        env('DB_DATABASE'),
        env('DB_USERNAME'),
        env('DB_PASSWORD'),
    );
    return view('welcome');
});
