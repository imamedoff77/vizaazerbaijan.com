<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ForceJsonResponseMiddleware;
use App\Http\Controllers\VisaRequestController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PagesController;


Route::prefix('main')
    ->middleware([ForceJsonResponseMiddleware::class])
    ->group(function () {

        Route::post('contact', [ContactController::class, 'save']);

        Route::prefix('visa')->group(function () {
            Route::post('/', [VisaRequestController::class, 'store']);
            Route::post('/check-status', [VisaRequestController::class, 'checkStatus']);
        });


        Route::prefix('pages')->group(function () {
            Route::get('for_slides', [PagesController::class, 'getForSlides']);
            Route::get('/{slug}', [PagesController::class, 'getBySlug']);
        });
    });
