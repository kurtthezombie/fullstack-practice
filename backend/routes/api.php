<?php

use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [LoginController::class,'logout'])->middleware('auth:sanctum');
});

Route::post('login', [LoginController::class,'login']);


Route::post('signup', [UserController::class,'store']);

Route::get('reload-captcha',[CaptchaController::class, 'reloadCaptcha']);
Route::post('post',[CaptchaController::class, 'post']);