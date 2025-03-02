<?php

namespace App\Services;

use App\Jobs\DeactivateTeams;

class RoomService
{

    public function __construct(private string $roomId)
    {
    }

    /**
     * Deactive teams and roomcode on room stop
     */
    public function deactivateTeamsAndRoomcode(): void
    {
        DeactivateTeams::dispatch($this->roomId)
            ->delay(now()->addMinutes(1));
    }
}