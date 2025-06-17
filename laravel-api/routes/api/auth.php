<?php


use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ForceJsonResponseMiddleware;


Route::prefix('auth')
    ->middleware(ForceJsonResponseMiddleware::class)
    ->group(function () {
        Route::post('admin', [AuthController::class, 'login'])->name('admin_login');
        Route::post('reset_intent', [AuthController::class, 'resetIntent']);
        Route::get('validate_reset_token/{token}', [AuthController::class, 'validateResetToken']);
        Route::post('reset_password', [AuthController::class, 'resetPassword']);

        //Admin

        Route::middleware(['auth:sanctum'])->group(function () {
            Route::get('admin/check', function (Request $request) {
                return $request->user();
            });

            Route::get('admin/logout', [AuthController::class, 'logout']);
        });
    });
