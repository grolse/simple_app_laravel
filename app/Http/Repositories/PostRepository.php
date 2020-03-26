<?php


namespace App\Http\Repositories;


use App\Models\Post;

class PostRepository implements PostRepositoryInterface
{
    /** @var Post */
    private $model;

    public function __construct()
    {
        $this->model = app()->make(Post::class);
    }

    public function findById(int $id): ?Post
    {
        return $this->model->find($id);
    }

    public function findByTitle(string $title): ?Post
    {
        return $this->model->where('title', '=', $title)->first();
    }

    public function save(Post $post, array $data)
    {
        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->save();
    }


}
