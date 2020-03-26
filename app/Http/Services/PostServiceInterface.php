<?php


namespace App\Http\Services;


use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

interface PostServiceInterface
{
    /**
     * @param int $id
     *
     * @throws \Exception
     * @return Post
     */
    public function getPostById(int $id): Post;

    /**
     * @param int|null $page
     * @return Collection
     */
    public function getAllPosts(int $page = null): Collection;

    /**
     * @throws \Exception
     * @param array $posrData
     * @return int
     */
    public function createPost(array $posrData): int;

    /**
     * @throws \Exception
     * @param int $id
     * @param array $postData
     * @return int
     */
    public function updatePost(int $id, array $postData): int;

    /**
     * @throws \Exception
     * @param int $id
     */
    public function deletePost(int $id): void;
}
