<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('rooms', RoomController::class)->only(['index', 'store', 'show', 'update', 'destroy'])->middleware('auth:sanctum');

Route::post('/rooms/{room}/roomcode', [RoomController::class, 'generateRoomCode'])->middleware('auth:sanctum');

Route::post('/team/join', [TeamController::class, 'join']);

Route::get('/team/{team}', [TeamController::class], 'get');

Route::get('/user/profile-picture', [UserController::class, 'profilePicture'])->middleware('auth:sanctum');
