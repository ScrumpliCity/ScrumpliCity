<?php

namespace App\Models;

use App\Models\Team;
use Illuminate\Database\Eloquent\BroadcastsEvents;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Broadcasting\Channel;

class Member extends Model
{
    use HasUlids;
    use BroadcastsEvents;

    /**
     * Get the team that the team member is in.
     */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'role'];

    /**
     * Get the channels that model events should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(string $event): array
    {
        return [
                new Channel('rooms.' . $this->team->room->id),
                new Channel('team.' . $this->team->id)];
    }

}
