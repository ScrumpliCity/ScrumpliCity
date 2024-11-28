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
}
