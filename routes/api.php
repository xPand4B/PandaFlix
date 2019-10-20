<?php

use App\Components\Category\CategoryApiController;
use App\Components\Collection\CollectionApiController;
use App\Components\Episode\EpisodeApiController;
use App\Components\Movie\MovieApiController;
use App\Components\Serie\SerieApiController;
use App\Components\User\UserApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes - v1.0
|--------------------------------------------------------------------------
*/
Route::prefix('v1')->group(function () {
    /*
    |--------------------------------------------------------------------------
    | Category Routes
    |--------------------------------------------------------------------------
    */
    Route::apiResource('category', CategoryApiController::class);

    /*
    |--------------------------------------------------------------------------
    | Collection Routes
    |--------------------------------------------------------------------------
    */
    Route::apiResource('collection', CollectionApiController::class);

    /*
    |--------------------------------------------------------------------------
    | Episode Routes
    |--------------------------------------------------------------------------
    */
    Route::apiResource('episode', EpisodeApiController::class);

    /*
    |--------------------------------------------------------------------------
    | Movie Routes
    |--------------------------------------------------------------------------
    */
    Route::apiResource('movie', MovieApiController::class);

    /*
    |--------------------------------------------------------------------------
    | Serie Routes
    |--------------------------------------------------------------------------
    */
    Route::apiResource('serie', SerieApiController::class);

    /*
    |--------------------------------------------------------------------------
    | User Routes
    |--------------------------------------------------------------------------
    */
    Route::apiResource('user', UserApiController::class);
});
