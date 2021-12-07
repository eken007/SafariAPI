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
Route::post('/send-email/{code}/{email}', [\App\Http\Controllers\ConfirmationMailController::class, 'sendEmail']);


Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Api\PassportController::class, 'logout']);

    // route des films

    Route::get('/films', [\App\Http\Controllers\FilmsController::class, 'index'])->middleware('api.admin');
    Route::post('/savefilm', [\App\Http\Controllers\FilmsController::class, 'store'])->middleware('api.admin');
    Route::post('/saveacteurfilm', [\App\Http\Controllers\FilmsController::class, 'saveacteur'])->middleware('api.admin');
    Route::post('/savegenrefilm', [\App\Http\Controllers\FilmsController::class, 'savegenre'])->middleware('api.admin');

    // route des series

    Route::get('/series', [\App\Http\Controllers\FilmsController::class, 'index'])->middleware('api.admin');
    Route::post('/saveserie', [\App\Http\Controllers\SerieController::class, 'store'])->middleware('api.admin');
    Route::post('/saveacteurserie', [\App\Http\Controllers\SerieController::class, 'saveacteur'])->middleware('api.admin');
    Route::post('/savegenreserie', [\App\Http\Controllers\SerieController::class, 'savegenre'])->middleware('api.admin');
    Route::post('/savesaisonserie/{id}', [\App\Http\Controllers\SerieController::class, 'savesaison'])->middleware('api.admin');
    Route::post('/saveepisodeserie/{id}', [\App\Http\Controllers\SerieController::class, 'saveepisode'])->middleware('api.admin');
});
