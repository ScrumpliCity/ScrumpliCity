<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Team;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function join(Request $request): JsonResponse
    {
        $roomcode = $request->input('code');
        $room = Room::where('roomcode', $roomcode)->firstOrFail();
        $team = $room->teams()->create();
        $team->save();
        $request->session()->put('team', $team->id);
        return response()->json($team);
    }

    public function show(Request $request): JsonResponse
    {
        $teamId = $request->session()->get('team');
        return response()->json(Team::findOrFail($teamId));
    }

    public function update(Request $request, Team $team): JsonResponse
    {
        if ($request->session()->get('team') != $team->id) {
            return  response()->noContent(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $team->update($validated);
        return response()->json($team);
    }
}
