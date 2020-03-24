<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private const USER_ID = 1;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'title' => 'required',
                'content' => 'required'
            ]);

            $post = new Post();
            $post->title = $request->get('title');
            $post->content = $request->get('content');
            $post->user_id = self::USER_ID;
            $post->save();

            return redirect(route('posts.index'));

        } catch (\Exception $e) {
            return redirect(route('posts.create'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$post = Post::findOrFail($id);

        /** @var Builder $qb */
        $qb = Post::where('id', $id);
        $post = $qb->first();

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'title' => 'required',
                'content' => 'required'
            ]);

            /** @var Post $post */
            $post = Post::findOrFail($id);
            $post->title = $request->get('title');
            $post->content = $request->get('content');
            $post->save();

            return redirect(route('posts.show', ['post' => $id]));
        } catch (\Exception $exception) {
            return redirect(route('posts.edit', ['post' => $id]));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /** @var Post $post */
        $post = Post::findOrFail($id);

        $post->delete();
        return redirect(route('posts.index'));
    }
}
