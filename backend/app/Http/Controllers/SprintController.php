<?php

namespace App\Http\Controllers;

use App\Models\Sprint;
use App\Models\Team;
use Illuminate\Http\Request;

class SprintController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $requestTeamId, string $sprintNumber)
    {
        $teamId = session()->get('team');
        $team = Team::findOrFail($teamId);

        if ($sprintNumber != $team->room->current_sprint && $sprintNumber != ($team->room->current_sprint + 1)) {
            return response(null, 403);
        }

        $sprint = $team->sprints()->where('sprint_number', $sprintNumber)->first();
        
        if (!$sprint) {
            $velocity = $sprintNumber == 1 ? null :
                $team->sprints()
                ->where('sprint_number', '<', $sprintNumber)
                ->join('user_stories', 'sprints.id', '=', 'user_stories.sprint_id')
                ->where('completed', true)
                ->sum('story_points') / ($sprintNumber - 1);

            $sprint = new Sprint();
            $sprint->sprint_number = $sprintNumber;
            $sprint->velocity = $velocity;
            $team->sprints()->save($sprint);
        } else if (!$request->input('preserve_user_stories')) { // When the sprint is newly created, preserve_user_stories wouldn't have any impact since there aren't any user stories anyway and therefore the new sprint is excluded from this condition -> else if 
            $sprint->user_stories()->delete();
        }

        if ($request->input('preserve_user_stories')) {
            $this->copyIncompleteStories($team, $sprintNumber, $sprint);
        }

        $sprint->refresh();
        return $sprint;
    }


    private function copyIncompleteStories(Team $team, int $sprintNumber, Sprint $targetSprint)
    {
        $previousSprint = $team->sprints()
            ->where('sprint_number', $sprintNumber - 1)
            ->first();

        if (!$previousSprint) {
            return;
        }

        // Clear all US of the target sprint so that there are no duplicates
        if ($targetSprint->user_stories()->exists()) {
            $targetSprint->user_stories()->delete();
        }

        $incompleteStories = $previousSprint->user_stories()
            ->where('completed', false)
            ->get();

        foreach ($incompleteStories as $story) {
            $targetSprint->user_stories()->create([
                'title' => $story->title,
                'description' => $story->description,
                'story_points' => $story->story_points,
                'member_id' => $story->member_id,
                'completed' => false
            ]);
        }
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
