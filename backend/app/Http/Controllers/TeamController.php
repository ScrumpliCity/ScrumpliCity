<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Team;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function join(Request $request): JsonResponse {
        $roomcode = $request->input('code');
        $room = Room::find('roomcode', $roomcode)->first();
        $team = new Team();
        $team->room = $room;
        $team->save();
        $request->session->put('team', $team->id);
        return response()->json($room);
    }

    public function show(Request $request, Team $team): JsonResponse {
        if ($request->session->get('team') != $team->id) {
            return  response()->noContent(403);
        }
        return response()->json($team);
    }

    public function update(Request $request, Team $team): JsonResponse {
        if ($request->session->get('team') != $team->id) {
            return  response()->noContent(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $team->update($validated);
        return response()->json($team);
    }

}
