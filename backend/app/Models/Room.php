<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Room extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'name',
        'number_of_sprints',
        'sprint_duration',
        'build_phase_duration',
        'planning_duration',
        'review_duration',
    ];

    /**
     * Get the user that owns the room.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the duration of a specific phase or current phase
     * @param string|null $phase The phase to get duration for. If null, uses current phase.
     * @return int Duration in minutes
     */
    public function getPhaseDuration(?string $phase = null): int
    {
        $phase = $phase ?? $this->current_phase;
        return match ($phase) {
            'planning' => $this->planning_duration,
            'build_phase' => $this->build_phase_duration,
            'review' => $this->review_duration,
            'backlog_refinement' => 1,
            default => 0,
        };
    }


    /**
     * Get the next phase of this room
     */
    public function nextPhase(): string
    {
        $phases = [
            "planning",
            "build_phase",
            "review",
            "backlog_refinement",
        ];

        $currentPhase = $this->current_phase;
        $currentPhaseIndex = array_search($currentPhase, $phases);
        $nextPhaseIndex = $currentPhaseIndex + 1;
        if ($nextPhaseIndex >= count($phases)) {
            $nextPhaseIndex = 0;
        }

        return $phases[$nextPhaseIndex];
    }

    /**
     * Get the number of teams in this room
     */
    protected function teamCount(): Attribute
    {
        return new Attribute(
            get: fn() => $this->teams()->count(),
        );
    }

    /**
     * Get the teams for the room.
     */
    public function teams()
    {
        return $this->hasMany(Team::class);
    }
}
