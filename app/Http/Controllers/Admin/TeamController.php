<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;

class TeamController extends Controller
{
    /**
     * TeamController constructor.
     * @param Team $team
     */
    public function __construct(Team $team)
    {
        $this->team = $team;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $teams = $this->team->paginate(20);
        
        return view('admin.teams.all', compact('teams'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $team = $this->team->find($id);
        
        return view('admin.teams.show', compactarray('team'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.teams.create');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $validator = $this->teamValidate($request);

        if ($validator->fails()) {
            return Redirect::to('admin-teams/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $team = $this->team;
            $this->saveTeam($team, $request);

            Session::flash('message', 'Команда створена! ');

            return Redirect::to('admin-teams');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $team = $this->team->find($id);

        return view('admin.teams.edit', compact('team'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $validator = $this->teamValidate($request);

        if ($validator->fails()) {
            return Redirect::to('admin-teams/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            $team = $this->team->find($id);

            $this->deleteOldImg($team, $request);
            $this->saveTeam($team, $request);

            Session::flash('message', 'Команда відредагована успішно!');

            return Redirect::to('admin-teams');
        }

    }

    /**
     * @param $team
     * @param $request
     */
    protected function saveTeam($team, $request)
    {

        if (count($request->files)) {
            $url_img = $this->saveImg($request->files);
        }
        $team->fill($request->input());
        if (isset($url_img['logo'])) {
            $team->logo = $url_img['logo'];
            $filename = explode('/images/uploads/teams/logos/', $team->logo);
            $name = explode('.', $filename[1]);
            $name = $name[0] . '_sm.' . $name[1];

            Image::make($_SERVER['DOCUMENT_ROOT'] . $team->logo)
                ->resize(null, 50, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($_SERVER['DOCUMENT_ROOT'] . '/images/uploads/teams/logos/small/' . $name);

            $team->small_logo = '/images/uploads/teams/logos/small/' . $name;
        }

        if (isset($url_img['foto'])) {
            $team->foto = $url_img['foto'];
        }
        $team->save();
    }

    /**
     * @param $team
     * @param $request
     */
    protected function deleteOldImg($team, $request)
    {
        if (($request->file('logo'))) {
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . $team->logo && $team->logo)) {
                unlink($_SERVER['DOCUMENT_ROOT'] . $team->logo);
            }
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . $team->small_logo && $team->small_logo)) {
                unlink($_SERVER['DOCUMENT_ROOT'] . $team->small_logo);
            }
        }
        if (($request->file('foto')) && !(is_null($team->foto))) {
            unlink($_SERVER['DOCUMENT_ROOT'] . $team->foto);
        }
    }

    /**
     * @param $images
     * @return mixed
     */
    protected function saveImg($images)
    {
        foreach ($images as $key => $file) {
            $f_name = $file->getClientOriginalName(); //получаем iмя файла
            if ($key == 'logo') {
                $folder = "/images/uploads/teams/logos/";
            } else {
                $folder = "/images/uploads/teams/fotos/";
            }
            $url_img[$key] = $folder . $f_name;
            $root = $_SERVER['DOCUMENT_ROOT'] . $folder;       // місце зберігання картинок
            $file->move($root, $f_name);                      //перемещаем файл в папку
        }
        if (isset($url_img)) {
            return $url_img;
        }
    }

    /**
     * @param $request
     * @return mixed
     */
    private function teamValidate($request)
    {
        $rules = array(
            'name' => 'required|between:4, 25',
            'city' => 'required|between:3, 20',
            'table_name' => 'required|between:4, 20'
        );
        $validator = Validator::make($request->all(), $rules);
        return $validator;
    }
}