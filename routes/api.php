<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


    Route::prefix('user')->group(function() {
        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::post('/profile/update', [\App\Http\Controllers\API\AuthController::class, 'profileUpdate']);
            Route::post('/change-password', [\App\Http\Controllers\API\AuthController::class, 'changePassword']);
        });
    });

    
    Route::prefix('user')->group(function() {
        Route::post('/register', [\App\Http\Controllers\API\AuthController::class, 'register']);
        Route::post('/login', [\App\Http\Controllers\API\AuthController::class, 'login']);
        Route::post('/verify_otp', [\App\Http\Controllers\API\AuthController::class, 'verifyOtp']);
        Route::post('/resend_otp', [\App\Http\Controllers\API\AuthController::class, 'resendOtp']);
        Route::post('/password/forgot', [\App\Http\Controllers\API\AuthController::class, 'sendPasswordResetLink'])->middleware('throttle:5,1');
        Route::post('/password/verify_otp', [\App\Http\Controllers\API\AuthController::class, 'verifyForgotPasswordOtp']);

    });
