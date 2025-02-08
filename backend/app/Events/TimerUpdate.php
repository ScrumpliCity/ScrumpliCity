<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;

class TimerUpdate implements ShouldBroadcastNow
{
    use SerializesModels;



    public function __construct(
        public string $roomId,
        public int $remainingSeconds
    ) {}

    public function broadcastOn()
    {
        return new Channel('timer.' . $this->roomId);
    }
}
