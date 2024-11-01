<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Team extends Model
{
    use HasFactory;
    use HasUlids;

    /**
     * Get the room that the team is in.
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}