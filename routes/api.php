<?php

use App\Http\Controllers\Api\v1\Auth\JWTAuthController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1',

], function ($router) {

    /* Auth */
    $router->post('login', [JWTAuthController::class, 'login']);
    $router->post('register', [JWTAuthController::class, 'register']);
    $router->post('logout', [JWTAuthController::class, 'logout']);
    $router->post('refresh', [JWTAuthController::class, 'refresh']);
    $router->get('/user-profile', [JWTAuthController::class, 'userProfile']);
});
