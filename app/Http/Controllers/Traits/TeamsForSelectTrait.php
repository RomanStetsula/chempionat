<?php

namespace App\Http\Controllers\Traits;

trait TeamsForSelectTrait
{
    /**
     * @param $all_teams
     * @return array
     */
    public function teamsForSelect($all_teams)
    {
        $teams = [];
        foreach ($all_teams as $team) {
            $teams[$team->id] = $team->table_name;   //масив для селект
        }
        return $teams;
    }
}
