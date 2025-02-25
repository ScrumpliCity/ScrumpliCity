<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Team;
use App\Models\UserStory;
use Illuminate\Http\Request;

class UserStoryController extends Controller
{
    public function store(string $requestTeamId, string $sprintNumber)
    {
        $teamId = session()->get('team');
        $team = Team::findOrFail($teamId);

        if ($sprintNumber != $team->room->current_sprint) return response(null, 403);

        $sprint = $team->sprints()->where('sprint_number', $sprintNumber)->first();

        return response()->json($sprint->user_stories()->create());
    }

    public function update(string $requestTeamId, string $sprintNumber, string $storyId, Request $request)
    {
        $teamId = session()->get('team');
        $team = Team::findOrFail($teamId);
        $story = UserStory::findOrFail($storyId);

        if ($sprintNumber != $team->room->current_sprint) return response(null, 403);
        if ($story->sprint->team_id != $team->id) return response(null, 403);

        $validated = $request->validate([
            'title' => 'string|min:0|max:255',
            'description' => 'string|min:0|max:1000',
            'story_points' => 'nullable|integer|min:0|max:999|'
        ]);

        $requestMemberId = $request->member_id;
        if ($requestMemberId) {
            $member = Member::findOrFail($requestMemberId);
            if ($team->id != $member->team_id) return response(null, 403);
            $story->member_id = $member->id;
        }

        $story->update($validated);

        return response()->json($story);
    }

    public function delete(string $requestTeamId, string $sprintNumber, string $storyId)
    {
        $teamId = session()->get('team');
        $team = Team::findOrFail($teamId);
        $story = UserStory::find($storyId);

        if ($sprintNumber != $team->room->current_sprint) return response(null, 403);
        if ($story->sprint->team_id != $team->id) return response(null, 403);

        $story->delete();

        return response()->noContent();
    }
}
