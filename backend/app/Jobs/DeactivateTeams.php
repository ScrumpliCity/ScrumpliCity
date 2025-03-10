<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Room;
use App\Events\TeamsDeactivated;

class DeactivateTeams implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private string $roomId
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $room = Room::find($this->roomId);
            // Return if the room doesn't exist anymore or if the room is currently running and the roomcode already exists
            if (
                !$room || ($room->completed_at !== null &&
                    $room->is_playing == true && $room->roomcode = null)
            ) {
                return;
            }

            // Deactivate all teams in the room
            $room->teams()->update(['active' => false]);
            // Remove roomcode to prevent rejoining
            $room->roomcode = null;
            $room->save();
            // Broadcast on room channel through event TeamsDeactivated
            broadcast(new TeamsDeactivated($this->roomId));

        } catch (\Exception $e) {
            error_log("Deactivate Teams error: " . $e->getMessage());
        }
    }
}