<?php

use Illuminate\Support\Facades\Route;
use Hmurich\Swagger\Controllers\SwaggerViewController;

Route::get('swagger/ui', [SwaggerViewController::class, 'index']);