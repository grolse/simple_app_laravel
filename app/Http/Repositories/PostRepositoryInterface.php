<?php


namespace App\Http\Repositories;


use App\Models\Post;

interface PostRepositoryInterface
{
    public function findById(int $id): ?Post;
    public function findByTitle(string $title): ?Post;
    public function save(Post $post, array $data);
}
