<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Room;

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
            // Return if the room doesn't exist anymore
            if (!$room = Room::find($this->roomId)) {
                return;
            }
            $room = Room::find($this->roomId);

            // make sure the room is not currently running and the roomcode already exists
            if (
                $room->completed_at == null &&
                $room->is_playing == false && $room->roomcode != null
            ) {
                // Deactivate all teams in the room
                $room->teams()->update(['active' => false]);
                // Remove roomcode to prevent rejoining
                $room->roomcode = null;
                $room->save();
                return;
            }
        } catch (\Exception $e) {
            error_log("Deactivate Teams error: " . $e->getMessage());
        }
    }
}