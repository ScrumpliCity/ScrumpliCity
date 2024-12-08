<?php

namespace App\Models;

use App\Models\Team;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasUlids;

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
}
