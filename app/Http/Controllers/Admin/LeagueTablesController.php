<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\League_table;
use App\Models\League;
use App\Models\Team;
use App\Models\Calendar;
use App\Http\Controllers\Traits\TeamsForSelectTrait;
use App\Http\Controllers\Controller;

class LeagueTablesController extends Controller
{

    use TeamsForSelectTrait;

    /**
     * LeagueTablesController constructor.
     * @param Calendar $calendar
     * @param League_table $league_table
     * @param League $league
     * @param Team $team
     */
    public function __construct(Calendar $calendar, League_table $league_table, League $league, Team $team)
    {
        $this->calendar = $calendar;
        $this->league_table = $league_table;
        $this->league = $league;
        $this->team = $team;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $league = $this->league->find($id);                            // лігa

        $league_teams = $this->league_table->where('league_id', $id)//Команди ліги
        ->join('teams', 'league_tables.team_id', '=', 'teams.id')
            ->select('league_tables.*', 'teams.table_name')
            ->orderBy('points', 'desc')
            ->orderBy('odds', 'desc')
            ->get();

        $all_teams = $this->team->all('id', 'table_name');
        if (count($all_teams)) {
            $all_teams = $this->teamsForSelect($all_teams);   // traits function

            return view('admin.league.show', compact('league', 'league_teams', 'all_teams'));
        } else {
            echo 'Спочатку створіть команди!';
        }
    }

    /**
     * Delete teams from league table
     * 
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $league_team = $this->league_table->where('id', $id)->first();

        $hasGames = $this->calendar->where([
                ['league_id', $league_team->league_id],
                ['home_team_id', $league_team->team_id]])
            ->orWhere([
                ['league_id', $league_team->league_id],
                ['away_team_id', $league_team->team_id]])
            ->first();

        if ($hasGames) {
            Session::flash('message', 'Команда не може бути видалена, тому що у неї є матчі у календарі. Спочатку видаліть матчі з календаря!');
            return redirect()->back();
        };

        $league_team->delete();

        Session::flash('message', 'Команда видалена!');
        return redirect()->back();
    }

    /**
     * Save selected teams in leagues table
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if ($request->teams_add) {
            foreach ($request->teams_add as $team) {
                $this->league_table->firstOrCreate(
                    ['team_id' => $team, 'league_id'=>$request->league_id]
                );
            }
            Session::flash('message', 'Команди добавлені!');
            return redirect()->back();
        } else {
            Session::flash('message', 'Не вибрано жодної команди!');
            return redirect()->back();
        }
    }

}
