<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Services\Post\PostServiceInterface;

class PostController extends Controller
{
    private $postService;

    /**
     * @param PostServiceInterface $postService
     */
    public function __construct(PostServiceInterface $postService)
    {
        $this->middleware('verify.notguest')->only('store', 'update', 'destroy', 'like', 'unlike');
        $this->postService = $postService;
    }

    /**
     * 振り返り投稿を全件取得して返却.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->postService->getAllPosts();
    }

    /**
     * ユーザーがお気に入りしている振り返り投稿を取得して返却.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLikePosts()
    {
        return $this->postService->getLikePosts();
    }

    /**
     * 新たな振り返り投稿を作成して返却.
     *
     * @param \Illuminate\Http\PostRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $validated = $request->validated();

        return $this->postService->createPost($validated);
    }

    /**
     * ID番目の振り返り投稿を取得して返却.
     *
     * @param int $postId
     *
     * @return \Illuminate\Http\Response
     */
    public function show(int $postId)
    {
        return $this->postService->getPostById($postId);
    }

    /**
     * 振り返り投稿を更新して返却.
     *
     * @param \Illuminate\Http\PostRequest $request
     * @param int                          $postId
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, int $postId)
    {
        $validated = $request->validated();

        return $this->postService->updatePost($postId, $validated);
    }

    /**
     * 振り返り投稿を削除.
     *
     * @param int $postId
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $postId)
    {
        return $this->postService->deletePost($postId);
    }

    /**
     * 振り返り投稿をお気に入り登録して返却.
     *
     * @param int $postId
     *
     * @return \Illuminate\Http\Response
     */
    public function like(int $postId)
    {
        return $this->postService->likePost($postId);
    }

    /**
     * 振り返り投稿のお気に入りを解除.
     *
     * @param int $postId
     *
     * @return \Illuminate\Http\Response
     */
    public function unlike(int $postId)
    {
        return $this->postService->unlikePost($postId);
    }
}
