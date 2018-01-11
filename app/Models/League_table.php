<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class League_table extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'team_id',
        'games',
        'wins',
        'draws',
        'losts',
        'scores',
        'missed',
        'odds',
        'points',
        'league_id'
    ];
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the teams of league.
     */
    public function teams()
    {
        return $this->hasMany('App\Models\Team');
    }
}
