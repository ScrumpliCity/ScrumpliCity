<?php

use App\Http\Controllers\MemberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SprintController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('rooms', RoomController::class)->only(['index', 'store', 'show', 'update', 'destroy'])->middleware('auth:sanctum');

Route::post('/rooms/{room}/roomcode', [RoomController::class, 'generateRoomCode'])->middleware('auth:sanctum');

Route::post('/team/join', [TeamController::class, 'join']);

Route::get('/team/me', [TeamController::class, 'show']);

Route::post('/team/{team}', [TeamController::class, 'update']);

Route::post('/team/{team}/members', [MemberController::class, 'setMembers']);

Route::get('/team/me/members', [MemberController::class, 'index']);

Route::post('/team/{team}/sprints/{sprintNumber}', [SprintController::class, 'store']); // create sprint
Route::patch('/team/{team}/sprints/{sprintNumber}', [SprintController::class, 'update']); // update sprint

Route::get('/user/profile-picture', [UserController::class, 'profilePicture'])->middleware('auth:sanctum'); //
