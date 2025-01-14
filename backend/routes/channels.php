<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\Room;
use App\Models\User;

Broadcast::routes(['middleware' => ['auth:sanctum']]);

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});