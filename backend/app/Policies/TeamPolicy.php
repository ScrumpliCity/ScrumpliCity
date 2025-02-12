<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Team;

class TeamPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Team $team): bool
    {
        return $user->id === $team->room->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Team $team): bool
    {
        return $user->id === $team->room->user_id;
    }
}
