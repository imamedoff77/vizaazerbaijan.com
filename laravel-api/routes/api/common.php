<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\DynamicFetchController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ForceJsonResponseMiddleware;


Route::get('/test', [TestController::class, 'index']);
Route::post('/test', [TestController::class, 'index']);
Route::prefix('common')
    ->middleware([ForceJsonResponseMiddleware::class])
    ->group(function () {

        // Dynamic Fetch

        Route::post('dynamic-fetch', [DynamicFetchController::class, 'fetch']);

        Route::get('initial_data', [ContactController::class, 'initial_data']);
        Route::get('countries', [ContactController::class, 'countries']);
    });
