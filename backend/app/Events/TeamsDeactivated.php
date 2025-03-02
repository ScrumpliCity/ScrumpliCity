<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;

class TeamsDeactivated implements ShouldBroadcastNow
{
    use SerializesModels;

    public function __construct(
        public string $roomId
    ) {
    }

    public function broadcastOn()
    {
        return new Channel('rooms.' . $this->roomId);
    }
}