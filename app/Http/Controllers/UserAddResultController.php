<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\League_table;
use App\Models\Calendar;
use App\Http\Controllers\Traits\UpdTableData;


class UserAddResultController extends Controller
{
    public function __construct(Calendar $calendar, League_table $league_table)
    {
        $this->calendar = $calendar;
        $this->league_table = $league_table;
    }

    use UpdTableData;

    /**
     * @param Request $request
     * @return mixed
     */
    public function updateResult(Request $request)
    {

        $validator = $this->resultValidate($request);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator);
        }
        $game = $this->calendar->find($request->game_id);

        $home_team = $this->league_table->where('league_id', $game->league_id)
            ->where('team_id', $game->home_team_id)
            ->first();

        $away_team = $this->league_table->where('league_id', $game->league_id)
            ->where('team_id', $game->away_team_id)
            ->first();

        if (!($game->home_team_goals === null || $game->away_team_goals === null)) {
            $this->UpdTableData($game, $home_team, $away_team, $add = -1); // видаляєм старий результат $add =-1
        }
        $this->UpdTableData($request, $home_team, $away_team, $add = 1); // додаємо новий результат $add ='1'

        $home_team->save();
        $away_team->save();

        $game->fill($request->input());
        $game->add_result_user_id = $request->user()->id;
        $game->save();

        return Redirect::back();
    }

    /**
     * @param Request $request
     * @return string
     */
    public function confirmResult(Request $request)
    {
        $game = $this->calendar->find($request->game_id);

        if (Auth::user()->is_admin) {
            $game->confirmed = 1;
            $game->save();
            return 'Підтверджено!';
        }
        if ($game->home_team_goals === null || $game->away_team_goals === null) {
            return 'Рахунок невідомий';
        }
        if ($game->confirmed == null && $game->add_result_user_id) {
            switch (null) {
                case $game->submit1_user_id:
                    if ($game->add_result_user_id != Auth::user()->id) {
                        $game->submit1_user_id = Auth::user()->id;
                    } else {
                        return 'Не потрібно підтверджувати власно введений результат';
                    }
                    break;
                case $game->submit2_user_id:
                    if ($game->submit1_user_id != Auth::user()->id) {
                        $game->submit2_user_id = Auth::user()->id;
                        $game->confirmed = 1;
                    } else {
                        return 'Ви уже підтверджували цей результат';
                    }
                    break;
            }
        }
        $game->save();
        return 'Дякуємо за співпрацю!)))';
    }

    /**
     * @param $request
     * @return mixed
     */
    private function resultValidate($request)
    {
        $rules = [
            'home_team_goals' => 'required',
            'away_team_goals' => 'required',
            'game_id' => 'required'];

        $validator = Validator::make($request->all(), $rules);
        return $validator;
    }
}