<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dash\LoginController;
use App\Http\Controllers\dash\ProfileController;
use App\Http\Controllers\dash\DashboardController;
use App\Http\Controllers\dash\OtpController;
use App\Http\Controllers\dash\SubscriptionController;
use App\Http\Controllers\dash\MyMessageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::controller(MyMessageController::class)->group(function () {
    Route::post('/recieve-messages', 'recieveMessages');
});
Route::group(['prefix' => Mcamara\LaravelLocalization\Facades\LaravelLocalization::setLocale().'/dash',
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    'as' => 'dash.'], function () {

    Route::get('/login',[LoginController::class, 'getLogin'])->name('login-page');
    Route::post('/send-login',[LoginController::class, 'postLogin'])->name('login');

    Route::group(['middleware'=>'auth:web'],function () {
        Route::get('/logout',[LoginController::class, 'logout'])->name('logout');
        Route::get('/',[DashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile',[ProfileController::class, 'profile'])->name('profile');
        Route::resource('/subscriptions',SubscriptionController::class)->only(['index', 'show', 'edit', 'update']);
        Route::get('/otps',[OtpController::class, 'index'])->name('otps.index');

    });
});
