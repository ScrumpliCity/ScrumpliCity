<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


Artisan::command('get-api-token', function () {
    $user = User::first();
    $user->tokens()->delete();
    $this->comment("Generating your API token for: " . $user->email . " id: " . $user->id);
    $token = $user->createToken('API Token')->plainTextToken;
    $this->comment('Your API token is: ' . $token);
})->purpose('Get API token for the current user');