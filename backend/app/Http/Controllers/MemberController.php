<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MemberController extends Controller
{
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
        $team->members()->delete();

        foreach ($validated['new_members'] as $memberData) {
            $member = $team->members()->create($memberData);
            $member->save();
        }

        return response()->json($team);
    }

    public function index(Request $request): JsonResponse
    {
        $team = Team::findOrFail($request->session()->get('team'));
        return response()->json($team->members);
    }
}
