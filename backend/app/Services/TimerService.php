<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use App\Jobs\RunTimer;
use App\Events\TimerStateChange;
use App\Models\Room;

class TimerService
{
    private int $duration;

    public function __construct(private string $roomId) {}

    /**
     * Start a timer for a room
     */
    public function start(int $duration): void
    {
        if ($duration < 0) {
            return;
        }

        $room = Room::find($this->roomId);

        if ($room->completed_at) {
            return;
        }

        $this->duration = $duration * 60;

        // Account for shorter phase time after stop
        $remaining = $room && $room->time_remaining_in_phase ? min($room->time_remaining_in_phase, $duration * 60) : $duration * 60;
        if ($room) {
            $room->time_remaining_in_phase = null;
            $room->last_play_start = now();
            $room->save();
        }


        Cache::put("timer." . $this->roomId, [
            'remaining' => $remaining,
            'duration' => $this->duration,
            'state' => 'running',
            'last_broadcast' => now()->timestamp
        ]);

        broadcast(new TimerStateChange($this->roomId, 'running', $remaining, $this->duration));
        RunTimer::dispatch($this->roomId);
    }


    /**
     * Stop this timer
     */
    public function stop(): void
    {
        $this->withLock(function () {
            $timer = Cache::get("timer." . $this->roomId);
            if ($timer) {
                $duration = $timer['duration'] ?? $this->duration;
                Cache::put("timer." . $this->roomId, array_merge($timer, [
                    'remaining' => 0,
                    'state' => 'stopped',
                ]));

                $room = Room::find($this->roomId);
                if ($room) {
                    $room->time_remaining_in_phase =
                    max(0, $timer['remaining'] - (now()->timestamp - $timer['last_broadcast']));
                    $room->last_play_end = now();
                    $room->save();
                }

                broadcast(new TimerStateChange($this->roomId, 'stopped', 0, $duration));
            }
        });
    }


    /**
     * Pause this timer
     */
    public function pause(): void
    {
        $this->withLock(function () {
            $timer = Cache::get("timer." . $this->roomId);
            if (!$timer || $timer['state'] !== 'running') {
                return;
            }

            $timer['state'] = 'paused';
            $currentTime = now();
            $timer['remaining'] = max(0, $timer['remaining'] - ($currentTime->timestamp - $timer['last_broadcast']));
            $timer['last_broadcast'] = $currentTime->timestamp;
            Cache::put("timer." . $this->roomId, $timer);

            $room = Room::find($this->roomId);
            if ($room) {
                $room->time_remaining_in_phase = $timer['remaining'];
                $room->save();
            }

            broadcast(new TimerStateChange($this->roomId, 'paused', $timer['remaining'], $timer['duration']));
        });
    }

    /**
     * Resume this timer
     */
    public function resume(): void
    {
        $this->withLock(function () {
            $timer = Cache::get("timer." . $this->roomId);
            if (!$timer || $timer['state'] !== 'paused') {
                return;
            }

            $timer['state'] = 'running';
            $timer['last_broadcast'] = now()->timestamp;
            Cache::put("timer." . $this->roomId, $timer);

            broadcast(new TimerStateChange($this->roomId, 'running', $timer['remaining'], $timer['duration']));

            RunTimer::dispatch($this->roomId);
        });
    }

    private function withLock(callable $callback)
    {
        $lock = Cache::lock("timer_lock." . $this->roomId, 5);

        try {
            if ($lock->get(2)) {
                return $callback();
            }
            return false;
        } finally {
            optional($lock)->release();
        }
    }
}
