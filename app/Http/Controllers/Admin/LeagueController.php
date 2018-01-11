<?php

namespace App\Http\Controllers\Admin;

use App\Models\League;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class LeagueController extends Controller
{
    /**
     * LeagueController constructor.
     * @param League $league
     */
    public function __construct(League $league)
    {
        $this->league = $league;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $leagues = $this->league->orderBy('season', 'desc')
            ->orderBy('rank', 'asc')
            ->orderBy('league_name', 'asc')
            ->paginate(10);
        
        return view('admin.leagues.all', compact('leagues'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
//        try {
//            $user = Auth::user();
//            $this->authorize('isUserAdmin', $user);
//        } catch (AuthorizationException $e) {
//            Session::flash('message', ' Access denied. You do not have rights');
//            return redirect('teams');
//        }
        return view('admin.leagues.createEdit');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {

//    $rules = array(
//        'name' => 'required|regex:/^[(A-zА-Яа-яїйі0-9)]{3,20}$/',
//    );
//
//    $validator = Validator::make($request->all(), $rules);
//    if ($validator->fails()) {
//      return Redirect::to('eagves/create')
//                      ->withErrors($validator)
//                      ->withInput();
//    } else {
        $this->league->create($request->input());

        Session::flash('message', 'Ліга успішно створена');

        return Redirect::to('admin-leagues');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
//        try {
//            $user = Auth::user();
//            $this->authorize('isUserAdmin', $user);
//        } catch (AuthorizationException $e) {
//            Session::flash('message', ' Access denied. You do not have rights');
//            return redirect('/books');
//        }
        $league = $this->league->find($id);

        return view('admin.leagues.createEdit', array('league' => $league));
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $league = $this->league->find($id);
        $league->fill($request->input());
        $league->save();
        Session::flash('message', 'Ліга успішно відредагована');

        return Redirect::to('admin-leagues');
    }

    /**
     * @param Request $request
     */
    public function toggleLeagueShow(Request $request)
    {
        $league = $this->league->find($request->league_id);
        $league->show = $request->checked;
        $league->save();
    }

}
