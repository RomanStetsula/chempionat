<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\TeamsForSelectTrait;

class UserController extends Controller
{
    use TeamsForSelectTrait;

    /**
     * UserController constructor.
     * @param User $user
     * @param Team $team
     */
    public function __construct(User $user, Team $team)
    {
        $this->user = $user;
        $this->team = $team;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = $this->user->paginate(50);

        $teams = $this->team->all();

        foreach ($users as $user) {
            if ($user->admin_team_id) {
                foreach ($teams as $team) {
                    if ($user->admin_team_id == $team->id) {
                        $user->team = $team->table_name;
                        $user->team_logo = $team->small_logo;
                        break;
                    }
                }
            }
        }

        return view('admin.users.all', compact('users'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $user = $this->user->find($id);

        $all_teams = $this->team->all();

        $teams = $this->teamsForSelect($all_teams);

        return view('admin.users.show', compact('user', 'teams'));
    }

    /**
     * @param Request $request
     */
    public function toggleUserBan(Request $request)
    {
        $user = $this->user->find($request->user_id);
        $user->ban = $request->checked;
        $user->save();
    }

    /**
     * @param Request $request
     */
    public function toggleUserAdmin(Request $request)
    {
        $user = $this->user->find($request->user_id);
        $user->is_admin = $request->checked;
        $user->save();
    }

}
