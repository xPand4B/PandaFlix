<?php

use App\Components\User\Http\Controllers\UserApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Auth Routes
|--------------------------------------------------------------------------
*/
//Route::middleware('auth:api')->group(function()
//{
    $namePrefix = 'user';

    /*
    |--------------------------------------------------------------------------
    | User routes
    |--------------------------------------------------------------------------
    */
    Route::get(
        'users', [UserApiController::class, 'index']
    )->name($namePrefix.'.index');

    Route::post(
        'users', [UserApiController::class, 'store']
    )->name($namePrefix.'.store');

    Route::get(
        'users/{user}', [UserApiController::class, 'show']
    )->name($namePrefix.'.show');

    Route::match(['PUT', 'PATCH'],
        'users/{user}', [UserApiController::class, 'update']
    )->name($namePrefix.'.update');

    Route::delete(
        'users/{user}', [UserApiController::class, 'destroy']
    )->name($namePrefix.'.destroy');
//});
