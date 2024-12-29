<?php

namespace App\Models;

use Illuminate\Broadcasting\Channel;
use Illuminate\Database\Eloquent\BroadcastsEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Team extends Model
{
    use HasFactory;
    use HasUlids;
    use BroadcastsEvents;


    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['room:id,roomcode,number_of_sprints,sprint_duration,planning_duration,review_duration,user_id'];

    /**
     * Get the room that the team is in.
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }


    public function members()
    {
        return $this->hasMany(Member::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name'];

    /**
     * Get the channels that model events should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(string $event): array
    {
        return [
            new Channel('team.' . $this->id)
        ];
    }
}
