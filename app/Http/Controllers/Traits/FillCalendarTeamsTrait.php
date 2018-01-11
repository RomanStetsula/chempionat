<?php

namespace App\Http\Controllers\Traits;

use Carbon\Carbon;

trait FillCalendarTeamsTrait
{
    //--------------Добавляємо  в масив  $calendar назви команд і присвоюємо голам команд значення " " якщо голів немає-----------------------------
    /**
     * @param $calendar
     * @param $teams
     * @return mixed
     */
    public function fillCalendarTeams($calendar, $teams)
    {
        for ($i = 0; $i < count($calendar); $i++) {
            $find1 = false;
            $find2 = false;
            foreach ($teams as $team) {
                if (!$find1 && ($team->id == $calendar[$i]->home_team_id)) {
                    $calendar[$i]->home_team_name = $team->table_name;
                    $calendar[$i]->home_team_logo = $team->small_logo;
                    $find1 = true;
                } else if (!$find2 && ($team->id == $calendar[$i]->away_team_id)) {
                    $calendar[$i]->away_team_name = $team->table_name;
                    $calendar[$i]->away_team_logo = $team->small_logo;
                    $find2 = true;
                }
                if ($find1 && $find2) {
                    break;
                }
            }
            if ($calendar[$i]->home_team_goals === null && $calendar[$i]->away_team_goals === null) {
                $calendar[$i]->home_team_goals = '';
                $calendar[$i]->away_team_goals = '';
            }
            $date = Carbon::createFromFormat('Y-m-d', $calendar[$i]->date);
            $calendar[$i]->date = $date->format('d.m.Y');
        }
        return $calendar;
    }

    //--------------Створення нового масиву з масивами раундів(турів)-----------------------------

    /**
     * @param $calendar
     * @return array
     */
    public function calRounds($calendar)
    {
        $calendar_rounds = [];
        for ($i = 0; $i < count($calendar); $i++) {
            $calendar_rounds[$calendar[$i]->round][$i] = $calendar[$i];
        }
        return $calendar_rounds;
    }

}