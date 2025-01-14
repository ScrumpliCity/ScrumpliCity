<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;

class TimerStateChange implements ShouldBroadcastNow
{
    use SerializesModels;

    public string $roomId;
    public string $state;
    public int $remainingSeconds;
    public int $totalSeconds;

    public function __construct(string $roomId, string $state, int $remainingSeconds, int $totalSeconds)
    {
        $this->roomId = $roomId;
        $this->state = $state;
        $this->remainingSeconds = $remainingSeconds;
        $this->totalSeconds = $totalSeconds;
    }

    public function broadcastOn()
    {
        return new Channel('timer.' . $this->roomId);
    }
}
