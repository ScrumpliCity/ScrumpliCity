<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\JsonResponse;

class AuthenticatedSessionController extends Controller
{
    public function getMicrosoftURL(): JsonResponse
    {
        return response()->json([
            'url' => Socialite::driver('microsoft')->stateless()->redirect()->getTargetUrl()
        ]);
    }

    public function handleMicrosoftToken(): Response
    {
        $user = Socialite::driver('microsoft')->stateless()->user();

        $userModel = User::firstOrNew(
            [
                "email" => $user->getEmail(),
            ],
            [
                "name" => $user->getName(),
            ]
        );

        $userModel->microsoft_token = $user->token;
        $userModel->microsoft_id = $user->getId();

        $userModel->save();

        Auth::login($userModel);

        return response()->noContent();
    }
}
