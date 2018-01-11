<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\Team;
use App\Http\Controllers\Traits\TeamsForSelectTrait;

class PlayerController extends Controller
{
    use TeamsForSelectTrait;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __construct(Player $player, Team $team)
    {
        $this->player = $player;
        $this->team = $team;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $players = $this->player->paginate(20);

        return view('player.all', ['players'=>$players]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id){

        $player = $this->player->where('user_id', $id)
            ->first();

        if(!$player){
           return redirect('player/create');
        }

        return view('player.show', ['player'=>$player]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){

        $teams = $this->team->all();
        $teams_select = $this->teamsForSelect($teams);

        return view('player.create', ['teams_select' => $teams_select]);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request){
        $player = $this->player->fill($request->input());
        $player->birth = $request->birth_year.'-'.$request->birth_month.'-'.$request->birth_day;
        $player->user_id = auth()->user()->id;
        $player->save();

        return view('player.show', ['player'=>$player]);
    }


}
