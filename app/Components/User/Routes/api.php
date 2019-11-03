<?php

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
    | User Routes
    |--------------------------------------------------------------------------
    */
    Route::apiResource('user', UserApiController::class);
});
