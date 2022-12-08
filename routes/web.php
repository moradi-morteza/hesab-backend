<?php
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();


Route::get('/', [PageController::class, 'index']);

Route::get('/app', [PageController::class, 'index'])->name('app');
Route::get('/app/{any}', [PageController::class, 'app'])->where('any', '.*');

Route::get('/admin', [PageController::class, 'admin'])->name('app');
Route::get('/admin/{any}', [PageController::class, 'admin'])->where('any', '.*');

Route::get('/develop', [PageController::class, 'develop'])->name('develop');
