<?php

namespace App\Services\Post;

use App\Models\Post;
use App\Repositories\Post\PostRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PostService implements PostServiceInterface
{
    private $postRepository;

    /**
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * id番目の振り返り投稿を取得し、responseをjsonに整形
     *
     * @param int $postId
     * @return JsonResponse
     */
    public function getPostById(int $postId): JsonResponse
    {
        $post = $this->postRepository->getPostById();
        return response()->json($post, Response::HTTP_OK);
    }

    /**
     * 振り返り投稿を全件取得し、responseをjsonに整形
     *
     * @return JsonResponse
     */
    public function getAllPosts(): JsonResponse
    {
        $allposts = $this->postRepository->getAllPosts();
        return response()->json($allPosts, Response::HTTP_OK);
    }

    /**
     * お気に入りした振り返り記録を取得
     *
     * @return JsonResponse
     */
    public function getLikePosts(): JsonResponse
    {
        $likePosts =  $this->postRepository->getLikePosts();
        return response()->json($likePosts, Response::HTTP_OK);
    }

    /**
     * 新たな振り返り投稿を作成し、responseをjsonに整形
     *
     * @param array $postDetails
     * @return JsonResponse
     */
    public function createPost(array $postDetails): JsonResponse
    {
        $post = $this->postRepository->createPost($postDetails);
        return response()->json($post, Response::HTTP_CREATED);
    }

    /**
     * 振り返り投稿を更新し、responseをjsonに整形
     *
     * @param integer $postId
     * @param array $postDetails
     * @return JsonResponse
     */
    public function updatePost(int $postId, array $postDetails): JsonResponse
    {
        $this->postRepository->updatePost($postId, $postDetails);
        return response()->json($this->postRepository->getPostById($postId), Response::HTTP_CREATED);
    }

    /**
     * 振り返り投稿を削除し、responseをjsonに整形
     *
     * @param integer $postId
     * @return JsonResponse
     */
    public function deletePost(int $postId): JsonResponse
    {
        $this->postRepository->deletePost($postId);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function likePost(int $postId): JsonResponse
    {
      $this->postRepository->likePost($postId);
      return response()->json($this->postRepository->getPostById($postId), Response::HTTP_CREATED);
    }

    public function unlikePost(int $postId): JsonResponse
    {
      $this->postRepository->unlikePost($postId);
      return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
