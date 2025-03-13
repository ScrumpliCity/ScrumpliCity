<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class UserStory extends Model
{
    use HasUlids;

    public function sprint()
    {
        return $this->belongsTo(Sprint::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    protected $fillable = [
        'title',
        'description',
        'story_points'
    ];
}
