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

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['user_stories.member'];

    protected $fillable = [
        'name',
        'goal'
    ];
}
