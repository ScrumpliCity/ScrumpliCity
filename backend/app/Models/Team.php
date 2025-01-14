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
     * The relationships that should touch parent timestamps.
     *
     * @var array
     */
    protected $touches = ['room'];

    /**
     * Get the relations that should trigger broadcasting.
     *
     * @return array<string>
     */
    protected function broadcastsRelations(): array
    {
        return ['members', 'members.user', 'room'];
    }

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
        return match ($event) {
            'created' => [
                new Channel('rooms.' . $this->room->id)
            ],
            'updated' => [
                new Channel('rooms.' . $this->room->id),
                new Channel('team.' . $this->id)
            ],
            default => [
                new Channel('team.' . $this->id)
            ]
        };
    }

    /**
     * Get the data to broadcast for the model.
     *
     * @return array<string, mixed>
     */
    public function broadcastWith(string $event): array
    {
        return match ($event) {
            'created' => ['title' => $this->title],
            default => ['model' => $this],
        };
    }
}
