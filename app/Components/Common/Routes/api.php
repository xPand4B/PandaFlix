<?php

use App\Components\Common\Helper\ComponentHelper;
use App\Components\Common\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::post(
    'register', [AuthController::class, 'register']
)->name('register');

Route::post(
    'login', [AuthController::class, 'login']
)->name('login');

/*
|--------------------------------------------------------------------------
| API Routes - v1.0
|--------------------------------------------------------------------------
*/
Route::prefix('v1')->group(function ()
{
    /*
    |--------------------------------------------------------------------------
    | Component routes
    |--------------------------------------------------------------------------
    */
    $api_routes = ComponentHelper::getFilesByName('api.php');

    foreach ($api_routes as $route_file) {
        require $route_file;
    }
});
