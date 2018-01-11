<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Player extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'birth',
        'full_name',
        'ava',
        'height',
        'weight',
        'position',
        'short_position',
        'team_id',
        'number'
    ];

}
