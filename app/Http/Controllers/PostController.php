<?php

namespace App\Http\Controllers;

use App\Http\Services\PostService;
use App\Http\Services\PostServiceInterface;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use function GuzzleHttp\Psr7\str;

class PostController extends Controller
{
    private const USER_ID = 1;

    /** @var PostServiceInterface */
    private $postService;

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        /** @var Category $category */
        $category = Category::where('categories.id', 1)
            ->join('posts', 'categories.id', '=', 'posts.category_id')
            ->first();

        //Lazy Loading
        //Eager loading

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

        $post = $this->fetchPostOrFail($id);

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
        $post = $this->fetchPostOrFail($id);

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

            $this->postService->updatePost($id, $request->all());

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

    private function fetchPostOrFail(int $id)
    {
        try {
            return $this->postService->getPostById($id);
        } catch (\Exception $e) {
            abort(Response::HTTP_NOT_FOUND, $e->getMessage());
        }
    }
}
