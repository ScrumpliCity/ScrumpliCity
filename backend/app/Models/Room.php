<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Room extends Model
{
    use HasFactory;
    use HasUlids;
    
    protected $fillable = [
        'name',
        'number_of_sprints',
        'sprint_duration',
    ];

    /**
     * Get the user that owns the room.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

