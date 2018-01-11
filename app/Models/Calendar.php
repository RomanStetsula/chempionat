<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'league_id',
        'round',
        'home_team_id',
        'away_team_id',
        'home_team_goals',
        'away_team_goals',
        'confirmed'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;
}
