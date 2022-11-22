<?php
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\stimulsoft\Controllers\StimulsoftController;

Auth::routes([
    'register' => false, // Registration Routes...
    'verify' => false,   // Email Verification Routes...
]);
Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/develop', [HomeController::class, 'develop'])->name('develop');
Route::get('/{any}', [HomeController::class, 'index'])->where('any', '.*');
