<?php

namespace App\Http\Controllers\Traits;

trait UpdTableData
{
    //-------------- Внесення змін в турнірну таблицю -----------------------------
    /**
     * @param $game
     * @param $home_team
     * @param $away_team
     * @param $add
     */
    public function UpdTableData($game, $home_team, $away_team, $add)
    {
        $home_team->games += 1 * $add;
        $away_team->games += 1 * $add;
        $home_team->scores += $game->home_team_goals * $add;
        $away_team->scores += $game->away_team_goals * $add;
        $home_team->missed += $game->away_team_goals * $add;
        $away_team->missed += $game->home_team_goals * $add;
        $home_team->odds = $home_team->scores - $home_team->missed;
        $away_team->odds = $away_team->scores - $away_team->missed;
        if ($game->home_team_goals > $game->away_team_goals) {
            $home_team->wins += 1 * $add;
            $home_team->points += 3 * $add;
            $away_team->losts += 1 * $add;
        } elseif ($game->home_team_goals < $game->away_team_goals) {
            $away_team->wins += 1 * $add;
            $away_team->points += 3 * $add;
            $home_team->losts += 1 * $add;
        } else {
            $home_team->draws += 1 * $add;
            $away_team->draws += 1 * $add;
            $away_team->points += 1 * $add;
            $home_team->points += 1 * $add;
        }
    }
}