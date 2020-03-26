<?php


namespace App\Http\Services;


use App\Http\Repositories\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class PostService implements PostServiceInterface
{
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @param int $id
     *
     * @return Post
     * @throws \Exception
     */
    public function getPostById(int $id): Post
    {
        $post = $this->postRepository->findById($id);
        if (!$post) {
            throw new \Exception('Post not found');
        }
        return $post;
    }

    /**
     * @param int|null $page
     * @return Collection
     */
    public function getAllPosts(int $page = null): Collection
    {
        // TODO: Implement getAllPosts() method.
    }

    /**
     * @param array $posrData
     * @return int
     * @throws \Exception
     */
    public function createPost(array $postData): int
    {
        $existedPost = $this->postRepository->findByTitle($postData['title']);
        if ($existedPost) {
            throw new \Exception('Post already exists with title');
        }
    }

    /**
     * @param int $id
     * @param array $postData
     * @return int
     * @throws \Exception
     */
    public function updatePost(int $id, array $postData): int
    {
        $post = $this->postRepository->findById($id);
        $this->postRepository->save($post, $postData);

        return $post->id;
    }

    /**
     * @param int $id
     * @throws \Exception
     */
    public function deletePost(int $id): void
    {
        // TODO: Implement deletePost() method.
    }

}
