<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\NotificationSendController;

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
    return view('welcome');
});

Route::resource('posts',PostController::class);



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'],function(){
    Route::get('/fcm', [NotificationSendController::class, 'index']);
    Route::post('/store-token', [NotificationSendController::class, 'updateDeviceToken'])->name('store.token');
    Route::post('/send-web-notification', [NotificationSendController::class, 'sendNotification'])->name('send.web-notification');
});

