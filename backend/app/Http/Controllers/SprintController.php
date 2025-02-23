<?php

namespace App\Http\Controllers;

use App\Models\Sprint;
use App\Models\Team;
use Illuminate\Http\Request;

class SprintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $requestTeamId, string $sprintNumber)
    {
        $teamId = session()->get('team');
        $team = Team::findOrFail($teamId);

        if ($sprintNumber != $team->room->current_sprint) return response(null, 403);

        return $team->sprints()
            ->where('sprint_number', $sprintNumber)
            ->first();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(string $requestTeamId, string $sprintNumber)
    {
        $teamId = session()->get('team');
        $team = Team::findOrFail($teamId);

        if ($sprintNumber != $team->room->current_sprint) return response(null, 403);

        $velocity = $sprintNumber == 1 ? null :
            $team
            ->sprints()
            ->where('sprint_number', '<', $sprintNumber)
            ->join('user_stories', 'sprints.id', '=', 'user_stories.sprint_id')
            ->where('completed', true)
            ->sum('story_points')
            / ($sprintNumber - 1);

        $newSprint = new Sprint();
        $newSprint->sprint_number = $sprintNumber;
        $newSprint->velocity = $velocity;

        $team->sprints()->save($newSprint);

        return $newSprint;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $paramTeamId, string $sprintNumber)
    {
        $teamId = session()->get('team');
        $team = Team::findOrFail($teamId);

        if ($sprintNumber != $team->room->current_sprint) return response(null, 403);

        $sprint = $team->sprints()->where('sprint_number', $sprintNumber)->first();

        $validated = $request->validate([
            'name' => 'string|max:255',
            'goal' => 'string|max:1000',
        ]);

        $sprint->update($validated);
        return $sprint;
    }
}
