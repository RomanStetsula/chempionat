<?php

namespace App\Http\Controllers\Admin;

use App\Models\Calendar;
use App\Models\League_table;
use App\Models\League;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Traits\TeamsForSelectTrait;
use App\Http\Controllers\Traits\FillCalendarTeamsTrait;
use App\Http\Controllers\Traits\UpdTableData;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CalendarController extends Controller
{
    use TeamsForSelectTrait;
    use FillCalendarTeamsTrait;
    use UpdTableData;

    const ADD = 1;
    const DELETE = -1;

    /**
     * CalendarController constructor.
     * @param Calendar $calendar
     * @param League_table $league_table
     * @param League $league
     */
    public function __construct(Calendar $calendar, League_table $league_table, League $league)
    {
        $this->calendar = $calendar;
        $this->league_table = $league_table;
        $this->league = $league;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $calendar = $this->calendar->where('league_id', $id)// записи з календаря
            ->orderBy('round', 'asc')
            ->get();

        $teams = $this->league_table->where('league_id', $id)//Команди ліги
            ->join('teams', 'league_tables.team_id', '=', 'teams.id')
            ->select('teams.id', 'teams.table_name', 'teams.logo')
            ->get();

        if (count($teams) > 1) {
            $teams_select = $this->teamsForSelect($teams);    //method in trait
        } else {
            Session::flash('message', 'Щоб додати матчі в календар, додайте команди в таблицю!');
            return Redirect::to('admin-league/' . $id);
        }

        $league = $this->league->find($id);

        $calendarWithTeamsNames = $this->fillCalendarTeams($calendar, $teams);

        $calendar_rounds = $this->calRounds($calendarWithTeamsNames);
        $calendar = array_reverse($calendar_rounds, true);

        return view('admin.calendar.calendar', compact('league', 'calendar', 'teams', 'teams_select'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $validator = $this->matchValidate($request);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }

        $calendar = $this->calendar->where('round', $request->round)// ігри раунду з календаря
            ->where('league_id', $request->league_id)
            ->get();

        foreach ($calendar as $match) {
            if ($match->home_team_id == $request->home_team || $match->home_team_id == $request->away_team ||
                $match->away_team_id == $request->home_team || $match->away_team_id == $request->away_team
            ) {

                return Redirect::back()
                    ->withErrors(['error' => ['Одна або обидві команди уже мають матч у цьому раунді!']])
                    ->withInput();
            };
        }

        $game = $this->calendar;
        $game->fill($request->input());
        $date = Carbon::createFromFormat('d.m.Y', $request->date);
        $game->date = $date;
        $game->save();

        Session::flash('message', 'Гру створено');

        return Redirect::back();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $game = $this->calendar->find($id);

        $home_team = $this->league_table->where('league_id', $game->league_id)
            ->where('team_id', $game->home_team_id)
            ->first();

        $away_team = $this->league_table->where('league_id', $game->league_id)
            ->where('team_id', $game->away_team_id)
            ->first();

        if (!($game->home_team_goals === null || $game->away_team_goals === null)) {
            $this->UpdTableData($game, $home_team, $away_team, self::DELETE); // видаляєм старий результат $add =-1
            $home_team->save();
            $away_team->save();
        }

        $game->delete();

        Session::flash('message', 'Гра видалена!');

        return Redirect::back();
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $validator = $this->resultValidate($request);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator);
        }

        $game = $this->calendar->find($id);

        $home_team = $this->league_table->where('league_id', $request->league_id)
            ->where('team_id', $request->home_team_id)
            ->first();

        $away_team = $this->league_table->where('league_id', $request->league_id)
            ->where('team_id', $request->away_team_id)
            ->first();

        if ($game->home_team_goals !== null && $game->away_team_goals !== null) {
            $this->UpdTableData($game, $home_team, $away_team, self::DELETE); // видаляєм старий результат $add =-1
        }
        $this->UpdTableData($request, $home_team, $away_team, self::ADD); // додаємо новий результат $add ='1'

        $home_team->save();
        $away_team->save();

        $game->fill($request->input());
        $game->confirmed = 1;
        $game->save();

        Session::flash('message', 'Результат додано');

        return Redirect::back();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function clearResult($id)
    {
        $game = $this->calendar->find($id);

        if (!($game->home_team_goals === null || $game->away_team_goals === null)) {
            $home_team = $this->league_table->where('league_id', $game->league_id)
                ->where('team_id', $game->home_team_id)
                ->first();

            $away_team = $this->league_table->where('league_id', $game->league_id)
                ->where('team_id', $game->away_team_id)
                ->first();

            $this->UpdTableData($game, $home_team, $away_team, self::DELETE);
            $home_team->save();
            $away_team->save();


            $game->home_team_goals = null;
            $game->away_team_goals = null;
            $game->add_result_user_id = null;
            $game->submit1_user_id = null;
            $game->submit2_user_id = null;
            $game->confirmed = null;
            $game->save();
        }

        Session::flash('message', 'Результат видалено');

        return Redirect::back();
    }

    /**
     * @param $request
     * @return mixed
     */
    private function matchValidate($request)
    {
        $rules = [
            'date' => 'required',
            'round' => 'required',
            'home_team_id' => 'required',
            'away_team_id' => 'required'];

        $validator = Validator::make($request->all(), $rules);
        return $validator;
    }

    /**
     * @param $request
     * @return mixed
     */
    private function resultValidate($request)
    {
        $rules = [
            'home_team_goals' => 'required',
            'away_team_goals' => 'required'];

        $validator = Validator::make($request->all(), $rules);
        return $validator;
    }
}
