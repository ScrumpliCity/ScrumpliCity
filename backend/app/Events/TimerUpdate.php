<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;

class TimerUpdate implements ShouldBroadcastNow
{
    use SerializesModels;

    public string $roomId;
    public int $remainingSeconds;

    public function __construct(string $roomId, int $remainingSeconds)
    {
        $this->roomId = $roomId;
        $this->remainingSeconds = $remainingSeconds;
    }

    public function broadcastOn()
    {
        return new Channel('timer.' . $this->roomId);
    }
}
