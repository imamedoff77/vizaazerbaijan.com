<?php

use App\Http\Controllers\VisaRequestController;
use App\Http\Middleware\ForceJsonResponseMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DynamicFetchController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\IsSuperAdmin;
use App\Http\Controllers\PagesController;


Route::middleware(['auth:sanctum', ForceJsonResponseMiddleware::class])
    ->prefix('admin')
    ->group(function () {

        Route::post('dynamic-fetch', [DynamicFetchController::class, 'fetch'])->name('admin.fetch');

        Route::prefix('visa')->group(function () {
            Route::post('/excel', [VisaRequestController::class, 'exportExcel']);
            Route::post('/{id}', [VisaRequestController::class, 'changeStatus']);
            Route::delete('/{id}', [VisaRequestController::class, 'delete'])
                ->middleware(IsSuperAdmin::class);
        });


        Route::prefix('contact')->group(function () {
            Route::post('/bulk-delete', [ContactController::class, 'bulkDelete'])
                ->middleware(IsSuperAdmin::class);
            Route::post('/{id}', [ContactController::class, 'read']);
            Route::delete('/{id}', [ContactController::class, 'delete'])
                ->middleware(IsSuperAdmin::class);
        });

        Route::prefix('users')
            ->middleware(IsSuperAdmin::class)
            ->group(function () {
                Route::post('/', [UsersController::class, 'save']);
                Route::post('/{id}', [UsersController::class, 'save']);
                Route::delete('/{id}', [UsersController::class, 'delete']);
            });

        Route::prefix('pages')
            ->middleware(IsSuperAdmin::class)
            ->group(function () {
                Route::post('/', [PagesController::class, 'save']);
                Route::get('/{id}', [PagesController::class, 'get']);
                Route::post('/{id}', [PagesController::class, 'save']);
                Route::delete('/{id}', [PagesController::class, 'delete']);
            });
    });


Route::get('/admin/visa/{id}/download', [VisaRequestController::class, 'downloadPassportFile']);
