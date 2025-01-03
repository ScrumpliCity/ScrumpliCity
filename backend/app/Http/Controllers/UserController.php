<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
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

    public function updateName(Request $request): JsonResponse {
        $user = $request->user();

        $validated = $request->validate([
            'name' => "required|string|max:100|regex:/^[^\n\r]*$/"
        ]);

        $user->update($validated);
        return response()->json($user);
    }

    public function profilePicture(Request $request): Response
    {
        $user = $request->user();

        $cacheKey = "user_profile_picture_{$user->id}";

        // Check if the profile picture is cached
        if (Cache::has($cacheKey)) {
            $cachedImage = Cache::get($cacheKey);
            return response($cachedImage, 200)
                ->header('Content-Type', 'image/jpeg');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $user->microsoft_token,
        ])->get('https://graph.microsoft.com/v1.0/me/photos/48x48/$value');

        if ($response->successful()) {
            $imageData = $response->body();
            Cache::put($cacheKey, $imageData, 86400); // Cache for 24 hours

            return response($response->body(), 200)
                ->header('Content-Type', 'image/jpeg')
                ->header('Cache-Control', 'max-age=86400'); // Tell browser to cache for 24h as well
        } else {
            return response()->noContent(500);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function logout(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
