<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});


Route::post('/logout', [UserController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


Route::get('/oauth/microsoft', [UserController::class, 'getMicrosoftURL']);

Route::get('/oauth/microsoft/callback', [UserController::class, 'handleMicrosoftToken']);
