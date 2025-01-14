<?php

namespace App\Jobs;

use App\Events\TimerStateChange;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Cache;
use App\Events\TimerUpdate;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Room;
use App\Services\TimerService;

class RunTimer implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue;

    private const BROADCAST_INTERVAL = 4;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private string $roomId
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Return if there is no timer in cache
            if (!$timer = Cache::get($this->roomId)) {
                return;
            }

            // Return if the timer is not running
            if ($timer['state'] !== 'running') {
                return;
            }

            // Return if the room doesn't exist anymore
            if (!Room::find($this->roomId)) {
                return;
            }


            $currentTime = now()->timestamp;
            $remaining = max(0, $timer['remaining'] - ($currentTime - $timer['last_broadcast']));


            // When the timer is over
            if ($remaining <= 0) {
                $room = Room::find($this->roomId);

                // End the room
                if ($room->current_sprint === $room->number_of_sprints && $room->current_phase === 'backlog_refinement') {
                    $room->current_phase = null;
                    $room->completed_at = now();
                    $room->is_playing = false;
                    $room->save();
                    broadcast(new TimerStateChange($this->roomId, 'stopped', 0, 0));
                    Cache::forget($this->roomId);
                    return;
                }


                // Increment the sprint if it's the end of the sprint (phase backlog refinement)
                if ($room->current_phase === 'backlog_refinement' && $room->current_sprint < $room->number_of_sprints) {
                    $room->current_sprint++;
                }

                // Increment the phase of the timer
                $room->current_phase = $room->nextPhase();
                $room->save();
                
                $timer = new TimerService($this->roomId);
                $nextPhaseDuration = $room->getPhaseDuration();
                $room->time_remaining_in_phase = $nextPhaseDuration * 60;
                $room->save();

                // Start the next phase
                if ($nextPhaseDuration > 0) {
                    $timer->start($nextPhaseDuration);
                } else {
                    error_log("Invalid phase duration: " . $nextPhaseDuration);
                }
                return;
            }


            // Broadcast only if timer still running
            if ($remaining > 0) {
                Cache::put($this->roomId, array_merge($timer, [
                    'remaining' => $remaining,
                    'last_broadcast' => $currentTime
                ]));
                broadcast(new TimerUpdate($this->roomId, $remaining));

                static::dispatch($this->roomId)
                    ->delay(now()->addSeconds(min(self::BROADCAST_INTERVAL, $remaining)));
            }
        } catch (\Exception $e) {
            error_log("Timer error: " . $e->getMessage());
        }
    }
}
