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
        $post = $this->postRepository->getPostById($postId);
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

        // if(!$allposts->isEmpty()) {
        //     $processPosts = collect();
        //     $allposts->each(function($post) use ($processPosts) {
        //         $processPost = $this->processPost($post);
        //         $processPosts->push($processPost);
        //     });
        // } else {
        //     return response()->json('', Response::HTTP_OK);
        // }
        // $processPostsを返す
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

        // $processPosts = collect();
        // $likePosts->each(function($post) use ($processPosts) {
        //     $processPost = $this->processPost($post);
        //     $processPosts->push($processPost);
        // });

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

        // $processPost = $this->processPost($post);

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

        // $post = $this->postRepository->getPostById($postId);
        // $processPost = $this->processPost($post);

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

    //   $post = $this->postRepository->getPostById($postId);
    //   $processPost = $this->processPost($post);

      return response()->json($this->postRepository->getPostById($postId), Response::HTTP_CREATED);
    }

    public function unlikePost(int $postId): JsonResponse
    {
      $this->postRepository->unlikePost($postId);
      return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    // /**
    //  * postにユーザーネームを付与して返却する
    //  *
    //  * @param Post $post
    //  * @return void
    //  */
    // protected function processPost(Post $post) {
    //     return $processPost = [
    //         'id' => $post->id,
    //         'name' => $post->user->name,
    //         'good_description' => $post->good_description,
    //         'bad_description' => $post->bad_description,
    //         'self_evaluation' => $post->self_evaluation,
    //         'updated_at' => $post->updated_at,
    //     ];
    // }
}
