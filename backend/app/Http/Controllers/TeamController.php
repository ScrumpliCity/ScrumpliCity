<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Team;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

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
            return response()->json(null, 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $team->update($validated);
        return response()->json($team);
    }

    public function destroy(Request $request, Team $team): JsonResponse
    {
        Gate::authorize('delete', $team);
        $team->delete();
        return response()->json(null, 204);
    }

    //set active field to true on rejoin
    public function rejoin(Request $request, Team $team): JsonResponse
    {
        Gate::authorize('update', $team);
        $team->update(['active' => true]);
        return response()->json($team);
    }

    public function setMembers(Request $request, Team $team): JsonResponse
    {
        if ($request->session()->get('team') != $team->id) {
            return response()->noContent(403);
        }

        $validated = $request->validate([
            'new_members' => 'required|array',
            'new_members.*.name' => 'required|string|max:255',
            'new_members.*.role' => 'required|string|in:Product Owner,Scrum Master,Developer|max:255'
        ]);

        $team = Team::findOrFail($request->session()->get('team'));

        // Update existing members with duplicate unique roles to Developer
        foreach (['Product Owner', 'Scrum Master'] as $role) {
            if (collect($validated['new_members'])->contains('role', $role)) {
                $team->members()
                    ->where('role', $role)
                    ->update(['role' => 'Developer']);
            }
        }

        // Create new members
        foreach ($validated['new_members'] as $memberData) {
            $member = $team->members()->create($memberData);
            $member->save();
        }

        return response()->json($team);
    }

    public function addMember(Request $request, Team $team): JsonResponse
    {
        Gate::authorize('update', $team);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|in:Product Owner,Scrum Master,Developer|max:255'
        ]);

        $member = $team->members()->create($validated);
        $member->save();

        return response()->json($member);
    }
}