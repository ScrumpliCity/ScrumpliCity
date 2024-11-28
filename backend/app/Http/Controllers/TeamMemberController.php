<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;



class TeamMemberController extends Controller
{
    public function add(Request $request): JsonResponse
    {
        $team = Team::findOrFail($request->session()->get('team'));
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|in:Product Owner,Scrum Master,Developer|max:255',
        ]);

        $team->members()->create($validated);
        $team->save();
        return response()->json($team);
    }

    public function delete(Request $request, Team $team, string $memberId): JsonResponse
    {
        $team = Team::findOrFail($request->session()->get('team'));
        $team->members()->findOrFail($memberId)->delete();
        $team->save();
        return response()->json($team);
    }
}
