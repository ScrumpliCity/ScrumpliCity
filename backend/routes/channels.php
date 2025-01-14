<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\Room;
use App\Models\User;

Broadcast::routes(['middleware' => ['auth:sanctum']]);

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Broadcast::channel('rooms.{roomId}', function (User $user, string $roomId) {
//     error_log("User: " . $user->id . " Room: " . $roomId);
//     $room = Room::where('id', $roomId)->first();
//     if (!$room) {
//         return false;
//     }
//     return $user->id === $room->user_id;
// });

// Private channel for rooms
Broadcast::channel('rooms.{roomId}', function (User $user, Room $room) {
    error_log("User: " . $user->id . " Room: " . $room . " Channel: private-rooms." . $room);

    $authorized = $user->id === $room->user_id;
    error_log($authorized . " = authorized");
    
    return $authorized;
});