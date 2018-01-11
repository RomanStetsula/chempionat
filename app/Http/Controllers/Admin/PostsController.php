<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    /**
     * PostsController constructor.
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = $this->post->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('admin.posts.all', compact('posts'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $post = $this->post->find($id);

        return view('admin.posts.show', compact('post'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $validator = $this->postValidate($request);

        if ($validator->fails()) {
            return Redirect::to('admin-news/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $post = $this->post;
            $post->fill($request->input());
            $post->thumbs_img = $this->getThumbsImg($request->main_img);
            $post->user_id = $request->user()->id;
            $post->created_at = date("y-m-d H:i:s");
            $post->save();

            Session::flash('message', 'Новина додана! ');

            return Redirect::to('admin-news');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $post = $this->post->find($id);

        return view('admin.posts.edit', compact('post'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $validator = $this->postValidate($request);

        if ($validator->fails()) {
            return Redirect::to('admin-news/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            $post = $this->post->find($id);
            $post->fill($request->input());
            $post->thumbs_img = $this->getThumbsImg($request->main_img);
            $post->user_id = $request->user()->id;
            $post->save();

            Session::flash('message', 'Новина відредагована успішно!');

            return Redirect::to('admin-news');
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->post->delete($id);

        Session::flash('message', 'Новина видалена!');

        return Redirect::to('admin-news');
    }

    /**
     * @param $path
     * @return mixed
     */
    private function getThumbsImg($path)
    {
        $pos = strrpos($path, '/');
        $thumbs_path = substr_replace($path, '/thumbs', $pos, 0);
        return $thumbs_path;
    }

    /**
     * @param $request
     * @return mixed
     */
    private function postValidate($request)
    {
        $rules = array(
            'title' => 'required|between:4,80',
            'subtitle' => 'required|between:4,150',
            'main_img' => 'required',
            'content' => 'required|min:50');

        $validator = Validator::make($request->all(), $rules);
        return $validator;
    }

}
