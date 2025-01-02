<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Sprint extends Model
{
    use HasUlids;

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function user_stories()
    {
        return $this->hasMany(UserStory::class);
    }


    protected $fillable = [
        'name',
        'goal'
    ];
}
