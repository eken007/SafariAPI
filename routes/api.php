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
Route::post('/send-email-password', [\App\Http\Controllers\ResetPasswordMailController::class, 'sendEmail']);
Route::put('/resetpassword/{id}', [\App\Http\Controllers\Api\PassportController::class, 'resetpassword']);






Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Api\PassportController::class, 'logout']);

    // route des films

    Route::get('/films', [\App\Http\Controllers\FilmsController::class, 'index']);
    Route::get('/searchfilms/{titre}', [\App\Http\Controllers\FilmsController::class, 'search']);
    Route::get('/allfilms', [\App\Http\Controllers\FilmsController::class, 'allFilms']);
    Route::post('/savefilm', [\App\Http\Controllers\FilmsController::class, 'store'])->middleware('api.admin');
    Route::post('/saveacteurfilm', [\App\Http\Controllers\FilmsController::class, 'saveacteur'])->middleware('api.admin');
    Route::delete('/deleteacteurfilm/{id}', [\App\Http\Controllers\FilmsController::class, 'deleteacteur'])->middleware('api.admin');
    Route::post('/savegenrefilm', [\App\Http\Controllers\FilmsController::class, 'savegenre'])->middleware('api.admin');
    Route::delete('/deletegenrefilm/{id}', [\App\Http\Controllers\FilmsController::class, 'deletegenre'])->middleware('api.admin');
    Route::get('/searchfilms/{titre?}', [\App\Http\Controllers\FilmsController::class, 'search']);
    Route::delete('/deletefilm/{id}', [\App\Http\Controllers\FilmsController::class, 'deletefilm'])->middleware('api.admin');
    Route::put('/activepublicite/{video}', [\App\Http\Controllers\AllRubriquesController::class, 'activepublicite'])->middleware('api.admin');

    // route des series

    Route::get('/series', [\App\Http\Controllers\SerieController::class, 'index']);
    Route::get('/allseries', [\App\Http\Controllers\SerieController::class, 'allSeries']);
    Route::post('/saveserie', [\App\Http\Controllers\SerieController::class, 'store'])->middleware('api.admin');
    Route::post('/saveacteurserie', [\App\Http\Controllers\SerieController::class, 'saveacteur'])->middleware('api.admin');
    Route::post('/savegenreserie', [\App\Http\Controllers\SerieController::class, 'savegenre'])->middleware('api.admin');
    Route::post('/savesaisonserie', [\App\Http\Controllers\SerieController::class, 'savesaison'])->middleware('api.admin');
    Route::delete('/deletesaisonserie/{id}', [\App\Http\Controllers\SerieController::class, 'deletesaison'])->middleware('api.admin');
    Route::post('/saveepisodeserie', [\App\Http\Controllers\SerieController::class, 'saveepisode'])->middleware('api.admin');
    Route::get('/searchserie/{titre?}', [\App\Http\Controllers\SerieController::class, 'search']);
    Route::delete('/deleteserie/{id}', [\App\Http\Controllers\SerieController::class, 'deleteserie'])->middleware('api.admin');
    Route::delete('/deletegenreserie/{id}', [\App\Http\Controllers\SerieController::class, 'deletegenre'])->middleware('api.admin');
    Route::delete('/deleteacteurserie/{id}', [\App\Http\Controllers\SerieController::class, 'deleteacteur'])->middleware('api.admin');
    Route::delete('/deleteepisodeserie/{id}', [\App\Http\Controllers\SerieController::class, 'deleteepisode'])->middleware('api.admin');

    // route des series novelas

    Route::post('/saveserienovelas', [\App\Http\Controllers\SerieController::class, 'savenovelas'])->middleware('api.admin');
    Route::get('/allnovelas', [\App\Http\Controllers\SerieController::class, 'allnovelas']);
    Route::get('/searchnovelas/{titre?}', [\App\Http\Controllers\SerieController::class, 'searchnovelas']);
    Route::delete('/deletenovelas/{id}', [\App\Http\Controllers\SerieController::class, 'deletenovelas'])->middleware('api.admin');

    // route des web series

    Route::post('/savewebserie', [\App\Http\Controllers\SerieController::class, 'savewebserie'])->middleware('api.admin');
    Route::get('/allwebserie', [\App\Http\Controllers\SerieController::class, 'allwebserie']);
    Route::get('/searchwebserie/{titre?}', [\App\Http\Controllers\SerieController::class, 'searchwebserie']);
    Route::delete('/deletewebserie/{id}', [\App\Http\Controllers\SerieController::class, 'deletewebserie'])->middleware('api.admin');

    // routes concernant toutes les rubriques

    Route::get('/search', [\App\Http\Controllers\AllRubriquesController::class, 'search']);
    
    Route::get('/publicite', [\App\Http\Controllers\AllRubriquesController::class, 'publicite']);
    Route::get('/detailpage/{id}', [\App\Http\Controllers\AllRubriquesController::class, 'detailpage']);
    Route::get('/episodes/{id}', [\App\Http\Controllers\AllRubriquesController::class, 'episodes']);
    Route::get('/similaire/{id}', [\App\Http\Controllers\AllRubriquesController::class, 'similaire']);
    Route::get('/statistique', [\App\Http\Controllers\AllRubriquesController::class, 'statistique'])->middleware('api.admin');
    Route::delete('/deleteuser/{id}', [\App\Http\Controllers\Api\PassportController::class, 'destroy'])->middleware('api.admin');
    Route::put('/edituser', [\App\Http\Controllers\Api\PassportController::class, 'edit'])->middleware('api.admin');
    Route::get('/allepisodes/{id}', [\App\Http\Controllers\AllRubriquesController::class, 'allepisodes']);
    
    
});
