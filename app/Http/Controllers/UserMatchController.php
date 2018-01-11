<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\Calendar;
use Carbon\Carbon;


class UserMatchController extends Controller
{
    /**
     * UserMatchController constructor.
     * @param Calendar $calendar
     */
    public function __construct(Calendar $calendar)
    {
        $this->calendar = $calendar;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function addGame(Request $request)
    {

        if ($request->home_team_id == $request->away_team_id) {
            return Redirect::back()
                ->withErrors(['error' => ['Виберіть різні команди!']])
                ->withInput();
        }

        $validator = $this->matchValidate($request);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }

        $calendar = $this->calendar->where('round', $request->round)// ігри раунду з календаря
            ->where('leagve_id', $request->leagve_id)
            ->get();

        foreach ($calendar as $match) {
            if ($match->home_team_id == $request->home_team_id || $match->home_team_id == $request->away_team_id ||
                $match->away_team_id == $request->home_team_id || $match->away_team_id == $request->away_team_id
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
        $game->add_game_user_id = $request->user()->id;
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
        if (Auth::user()) {
            if (Auth::user()->id == $game->add_game_user_id && $game->home_team_goals === null) {
                $game->delete();
                Session::flash('message', 'Гра видалена!');
            } else {
                Session::flash('message', 'Недостатньо прав!');
            }
            return Redirect::back();
        }
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
}