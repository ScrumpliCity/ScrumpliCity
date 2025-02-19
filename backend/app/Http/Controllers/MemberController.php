<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Member;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


class MemberController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $team = Team::findOrFail($request->session()->get('team'));
        return response()->json($team->members);
    }

    public function delete(Team $team, Member $member): JsonResponse
    {
        Gate::authorize('delete', $member);
        $member->delete();
        return response()->json(null, 204);
    }

    public function update(Team $team, Member $member): JsonResponse
    {
        Gate::authorize('update', $member);

        $validated = request()->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|in:Product Owner,Scrum Master,Developer|max:255'
        ]);
        $member->update($validated);
        return response()->json($member);
    }
}
