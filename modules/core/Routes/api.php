<?php

use Core\Controllers\Api\AppLogController;
use Core\Controllers\Api\CoreController;
use Core\Controllers\Api\ExporterController;
use Core\Controllers\Api\RolePermissionController;
use Core\Controllers\Api\SettingController;
use Core\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

/* Localization for javascript and vuejs
    below route return all lang variables in resources/lang/*.php as json for use in vuejs
*/

Route::get('/js/lang.js', [CoreController::class,'getLangJs']);

// users [ apiResources not work in modules!]
Route::get('users',[UserController::class,'index']);
Route::get('user/{id}',[UserController::class,'read']);
Route::post('users',[UserController::class,'store']);
Route::put('users/{id}',[UserController::class,'update']);
Route::delete('users/{id}',[UserController::class,'destroy']);
Route::get('destroy_user_profile/{id}',[UserController::class,'removeProfileImage']);
Route::get('me',[UserController::class,'me']);

// files
Route::post('upload_to_temp',[CoreController::class,'upload_to_temp']);
Route::delete('attachments/{id}',[CoreController::class,'destroy_attachment']);

// roles
//Route::get('user_roles',[RolePermissionController::class,'index']);
//Route::get('user_role/{id}',[RolePermissionController::class,'read']);
//Route::post('user_roles',[RolePermissionController::class,'store']);
//Route::put('user_roles/{id}',[RolePermissionController::class,'update']);
//Route::delete('user_roles/{id}',[RolePermissionController::class,'destroy']);
//Route::get('permissions',[RolePermissionController::class,'get_permissions']);

// logs
Route::get('app_actions',[CoreController::class,'app_actions']);
Route::get('logs',[AppLogController::class,'index']);

// export
Route::post('export',[ExporterController::class,'export']);

Route::get('settings',[SettingController::class,'index']);
Route::put('settings',[SettingController::class,'update']);
