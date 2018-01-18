<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\League;
use App\Models\Post;
use App\Models\League_table;
use App\Models\Calendar;
use App\Http\Controllers\Traits\TeamsForSelectTrait;

class AppController extends BaseController
{
    use TeamsForSelectTrait;

    /**
     * AppController constructor.
     * @param Team $team
     * @param League $league
     * @param Post $post
     * @param League_table $league_table
     * @param Calendar $calendar
     */
    public function __construct(    League $league,
                                    Team $team,
                                    Post $post,
                                    League_table $league_table,
                                    Calendar $calendar
    )
    {
        parent::__construct($league, $team, $post, $league_table, $calendar);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function main()
    {
        $posts = $this->post
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
        
        $league = $this->leagues->first();

        $league_table = $league?$this->getLeagueTable($league->id):null;

        return view('layouts.app', compact('leagues_menu', 'posts', 'league', 'league_table'))
            ->with('leagues_menu', $this->leagues)
            ->with('sideMatches', $this->sideMatches);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function news()
    {
        $posts = $this->post
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('news', compact('posts'))
            ->with('leagues_menu', $this->leagues)
            ->with('sideMatches', $this->sideMatches);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function shownews($id)
    {
        $post = $this->post->find($id);

        return view('show_news', compact('post'))
            ->with('leagues_menu', $this->leagues)
            ->with('sideMatches', $this->sideMatches);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function leagueTable($id)
    {
        $league = $this->league->find($id);

        $league_table = $this->getLeagueTable($id);

        $league_teams = $this->getLeagueTeams($id);

        $last_round = $this->getRound($id, $operator = '<=');

        $last_matches = $last_round?$this->getRoundMatches($id, $last_round, $league_teams):[];

        $next_round = count($last_matches)?$last_matches[0]->round + 1:$this->getRound($id, $operator = '>');

        $next_matches = $next_round?$this->getRoundMatches($id, $next_round, $league_teams):[];

        return view('leagueTable', compact('league', 'league_table', 'next_matches', 'last_matches'))
            ->with('leagues_menu', $this->leagues)
            ->with('sideMatches', $this->sideMatches);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function calendar($id)
    {
        $league = $this->league->find($id);

        $league_teams = $this->getLeagueTeams($id);

        $teams_select = $this->teamsForSelect($league_teams);

        $calendar = $this->calendar
            ->where('league_id', $id)
            ->orderBy('round', 'asc')
            ->get();

        $fill_calendar = $this->fillCalendarTeams($calendar, $league_teams);

        $calendar = $this->calRounds($fill_calendar);

        return view('calendar', compact('league', 'calendar', 'teams_select', 'calendar'))
            ->with('leagues_menu', $this->leagues)
            ->with('sideMatches', $this->sideMatches);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function team($id)
    {
        $team = $this->team->find($id);

        return view('team', compact('team'))
            ->with('leagues_menu', $this->leagues)
            ->with('sideMatches', $this->sideMatches);
    }

}
