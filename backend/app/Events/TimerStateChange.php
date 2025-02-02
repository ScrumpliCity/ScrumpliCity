<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;

class TimerStateChange implements ShouldBroadcastNow
{
    use SerializesModels;

    public function __construct(
        public string $roomId,
        public string $state,
        public int $remainingSeconds,
        public int $totalSeconds
    ) {}

    public function broadcastOn()
    {
        return new Channel('timer.' . $this->roomId);
    }
}
