<?php

use App\Http\Controllers\MemberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TimerController;

// User:
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/user/profile-picture', [UserController::class, 'profilePicture'])->middleware('auth:sanctum');



// Rooms:
Route::resource('rooms', RoomController::class)->only(['index', 'store', 'show', 'update', 'destroy'])->middleware('auth:sanctum');

Route::post('/rooms/{room}/roomcode', [RoomController::class, 'generateRoomCode'])->middleware('auth:sanctum');

Route::get('/rooms/{room}', [RoomController::class, 'showSingleRoom'])->middleware('auth:sanctum');

Route::patch('/rooms/{room}/playing-status', [RoomController::class, 'togglePlaying'])->middleware('auth:sanctum');



// Timer:
Route::post('/rooms/{room}/timer/start', [TimerController::class, 'start'])->middleware('auth:sanctum');

Route::post('/rooms/{room}/timer/pause', [TimerController::class, 'pause'])->middleware('auth:sanctum');

Route::post('/rooms/{room}/timer/resume', [TimerController::class, 'resume'])->middleware('auth:sanctum');

Route::post('/rooms/{room}/timer/stop', [TimerController::class, 'stop'])->middleware('auth:sanctum');



// Teams:
Route::post('/team/join', [TeamController::class, 'join']);

Route::get('/team/me', [TeamController::class, 'show']);

Route::post('/team/{team}', [TeamController::class, 'update']);

Route::delete('/team/{team}', [TeamController::class, 'destroy']);



// Team members:
Route::post('/team/{team}/members', [TeamController::class, 'setMembers']);

Route::put('/team/{team}/members', [TeamController::class, 'addMember'])->middleware('auth:sanctum');

Route::get('/team/me/members', [MemberController::class, 'index']);

Route::patch('/team/{team}/members/{member}', [MemberController::class, 'update'])->middleware('auth:sanctum');

Route::delete('/team/{team}/members/{member}', [MemberController::class, 'delete'])->middleware('auth:sanctum');
