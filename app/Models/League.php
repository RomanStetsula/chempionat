<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'league_name',
        'season',
        'rank',
        'show'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

}
