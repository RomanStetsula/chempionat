<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Traits\FillCalendarTeamsTrait;
use Illuminate\Database\Eloquent\Collection;

class BaseController extends Controller
{
    use FillCalendarTeamsTrait;
    
    /**
     * @var
     */
    public $league;

    /**
     * @var
     */
    public $team;

    /**
     * @var
     */
    public $post;

    /**
     * @var
     */
    public $league_table;

    /**
     * @var
     */
    public $calendar;

    /**
     * leagues that will be displayed in left sibebar menu.
     * @var
     */
    public $leagues;

    /**
     * matches that will be displayed in right sibebar.
     * @var
     */
    public $sideMatches;

    /**
     * BaseController constructor.
     */
    public function __construct($league, $team, $post, $league_table, $calendar)
    {
        $this->league = $league;
        $this->team = $team;
        $this->post = $post;
        $this->league_table = $league_table;
        $this->calendar = $calendar;

        $this->leagues = $this->getActiveLeagues();
        $this->sideMatches = $this->getRightSideBarMatches($this->leagues);
    }

    /**
     * Get active leagues
     *
     * @return mixed
     */
    public function getActiveLeagues()
    {
        $leagues = $this->league
            ->where('show', 1)
            ->orderBy('rank', 'asc')
            ->orderBy('league_name', 'asc')
            ->get();

        return $leagues;
    }

    /**
     * Get right sidebar matches of active leagues.
     *
     * @param $leagues
     * @return mixed
     */
    public function getRightSideBarMatches($leagues)
    {
        $day_of_week = jddayofweek(cal_to_jd(CAL_GREGORIAN, date("m"), date("d"), date("Y")), 0);

        $i = 0;
        if($leagues->first()){
            while (isset($leagues[$i]) && $leagues[$i]->rank < 6) { //6 основні команди

                $teams[$i] = $this->getLeagueTeams($leagues[$i]->id);

                $last_round[$i] = $this->getRound($leagues[$i]->id, $operator = '<');
                $next_round[$i] = $this->getRound($leagues[$i]->id, $operator = '>=');

                //show next rounds on Friday-Sunday
                if (isset($last_round[$i])) {
                    $round[$i] = $last_round[$i];
                    if (isset($next_round[$i]) && ($day_of_week > 4 || $day_of_week == 0)) {
                        $round[$i] = $next_round[$i];
                    }
                } else {
                    if (isset($next_round[$i])) {
                        $round[$i] = $next_round[$i];
                    }
                }

                if (isset($round[$i])) {
                    $matches[$leagues[$i]->league_name] = $this->getRoundMatches($leagues[$i]->id, $round[$i], $teams[$i]);
                }
                $i++;
            }

            if (isset($matches)) {
                return $matches;

            }
        }

        return null;
    }

    /**
     * Get teams of league by league id
     * 
     * @param $id
     * @return mixed
     */
    public function getLeagueTeams($id)
    {
        $league_teams = $this->league_table
            ->where('league_id', $id)
            ->join('teams', 'league_tables.team_id', '=', 'teams.id')
            ->select('teams.id', 'teams.table_name', 'teams.logo', 'teams.small_logo')
            ->get();

        return $league_teams;
    }

    /**
     * Get last or next round
     * 
     * @param $id
     * @param $operator
     * @return mixed
     */
    public function getRound($id, $operator)
    {
        $current_date = date("Y-m-d");

        $sort = ($operator == '>=')?'asc':'desc';

        $round = $this->calendar
            ->where([['date', $operator, $current_date], ['league_id', $id]])
            ->select('round')
            ->orderBy('date', $sort)
            ->first();

        if ($round) {
            return $round->round;
        }
    }

    /**
     *Get calendar matches 
     *
     * @param $id
     * @param $round
     * @param $league_teams
     * @return array
     */
    public function getRoundMatches($id, $round, $league_teams)
    {
        $cal_matches = $this->calendar
            ->where([['round', $round], ['league_id', $id]])
            ->get();

        $matches = $this->fillCalendarTeams($cal_matches, $league_teams);

        return $matches->all();

    }

    /**
     * Get table of league by league id
     * 
     * @param $id
     * @return Collection
     */
    public function getLeagueTable($id)
    {
        $league_table = $this->league_table
            ->where('league_id', $id)
            ->join('teams', 'league_tables.team_id', '=', 'teams.id')
            ->select('league_tables.*', 'teams.table_name', 'teams.small_logo')
            ->orderBy('points', 'desc')
            ->orderBy('odds', 'desc')
            ->get();

        return $league_table;
    }
}
