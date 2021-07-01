<?php

use App\Http\Controllers\Api\v1\Auth\JWTAuthController;
use App\Http\Controllers\Api\v1\Sms\SmsController;
use App\Http\Controllers\Api\v1\User\UserController;
use Illuminate\Support\Facades\Route;

Route::group([
//    'middleware' => 'api',
    'prefix' => 'v1',

], function ($router) {

    /* Auth */
    $router->post('login', [JWTAuthController::class, 'login'])->name('auth.login');
    $router->post('register', [JWTAuthController::class, 'register'])->name('auth.register');
    $router->post('logout', [JWTAuthController::class, 'logout'])->name('auth.logout');
    $router->post('refresh', [JWTAuthController::class, 'refresh'])->name('auth.refresh');

    /* User */
    $router->group(['prefix' => 'user'], function ($router){
        $router->get('index', [UserController::class, 'index'])->name('user.index');
        $router->get('profile', [UserController::class, 'userProfile'])->name('user.profile');
    });

    /* Sms */
    $router->group(['prefix' => 'sms'], function ($router){
        $router->post('/send', [SmsController::class, 'send'])->name('sms.send');
    });

});
