<?php

use App\Http\Controllers\Api\OtpController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'pagination');
    Route::post('/register', 'register');
    Route::post('/users/update', 'updateUser');
    Route::post('/users/search', 'findUser');
    Route::get('/users/{id}', 'show');
});
Route::controller(SubscriptionController::class)->group(function () {
    Route::get('/subscriptions', 'pagination');
    Route::post('/subscriptions/create', 'create');
    Route::get('/subscriptions/user/{user_id}', 'mySubscriptions');
    Route::post('/subscriptions/{id}', 'edit');
    Route::get('/subscriptions/{id}', 'show');
});

Route::controller(OtpController::class)->group(function () {
    Route::post('/otp-send/{id}', 'sendOtp');
    Route::post('/otp-check/{id}', 'checkOTP');
});
