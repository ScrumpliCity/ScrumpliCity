<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\JsonResponse;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): Response
    {
        $request->authenticate();

        $request->session()->regenerate();

        return response()->noContent();
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }

    public function getMicrosoftURL(): JsonResponse
    {


        // Socialite::driver('microsoft')->redirect();
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
