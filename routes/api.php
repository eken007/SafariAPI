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
Route::post('/register', [\App\Http\Controllers\Api\PassportController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Api\PassportController::class, 'login']);
Route::post('/send-email', [\App\Http\Controllers\ConfirmationMailController::class, 'sendEmail']);


Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Api\PassportController::class, 'logout']);
    Route::get('/articles', [\App\Http\Controllers\ArticleController::class, 'index'])->middleware('api.admin');
});
