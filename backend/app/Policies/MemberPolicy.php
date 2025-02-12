<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Team;
use App\Models\Member;


class MemberPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Member $member): bool
    {
        return $user->id === $member->team->room->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Member $member): bool
    {
        return $user->id === $member->team->room->user_id;
    }
}
