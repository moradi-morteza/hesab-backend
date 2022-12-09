<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::post('/login-mobile',[LoginController::class,'loginMobile'])->name('login-mobile');
Route::post('/check-login-mobile-verify',[LoginController::class,'checkLoginMobileVerify'])->name('check-login-mobile-verify');
Route::post('/request-mobile-verify-code',[LoginController::class,'requestMobileVerifyCode'])->name('request-mobile-verify-code');

Route::get('/', [PageController::class, 'index']);

Route::get('/app', [PageController::class, 'index'])->name('app');
Route::get('/app/{any}', [PageController::class, 'app'])->where('any', '.*');

Route::get('/admin', [PageController::class, 'admin'])->name('admin');
Route::get('/admin/{any}', [PageController::class, 'admin'])->where('any', '.*');

Route::get('/develop', [PageController::class, 'develop'])->name('develop');
Route::get('/login-admin', [PageController::class, 'loginAdmin'])->name('login-admin');
